<?php

namespace StackExchange\Example\Controller\Adminhtml\Example;

use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \Magento\Backend\App\Action 
{

    const ADMIN_RESOURCE ="StackExchange_Example::example_edit";

    /**
     * @var Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \StackExchange\Example\Model\StudentFactory
     */
    private $studentFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \StackExchange\Example\Model\StudentFactory $studentFactory,
        DataPersistorInterface $dataPersistor   
    ) {
        $this->studentFactory = $studentFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
    }
    
    public function execute() 
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        
        if($data){
            $studentModel = $this->studentFactory->create();
            $id = $this->getRequest()->getParam('id');

            /**
             *  set Id null when new record creating
             */

            if(empty($data['id'])){
                $data['id'] = null;
            }

            if($id){
               $studentModel->load($id); 
            }

            
            $studentModel->setData($data);
            // Save Data using Model Save
            try{
               $studentModel->save();
               $this->messageManager->addSuccessMessage(__('Record SucessFully Update'));
               /**
                * Clear Data From dataPersistor variable is successfully save
                */
               $this->dataPersistor->clear('example_data');
               
               return $resultRedirect->setPath('*/*/edit', ['example_id' => $studentModel->getId() ]);
               
            } catch (\Exception $exception) {
                
                $this->messageManager->addExceptionMessage($exception,__('Something Went to Wrong While save data'));
            }
            /**
             * Send Post Data from Save to Edit page while any error happen on save of data
             */
            $this->dataPersistor->set('example_data',$data);
            return $resultRedirect->setPath('*/*/edit', ['example_id' =>$id ]);
            
        }
        // if post does not find then redirect to Listing page
        return $resultRedirect->setPath('*/*/listing');
    }

}
