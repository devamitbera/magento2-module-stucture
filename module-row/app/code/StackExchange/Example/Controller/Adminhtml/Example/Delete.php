<?php


namespace StackExchange\Example\Controller\Adminhtml\Example;


class Delete  extends  \Magento\Backend\App\Action
{

    /**
     * Add ACL Resource TO this URL
     */
    
     const ADMIN_RESOURCE ="StackExchange_Example::example_delete";
      
    /**
     * @var \StackExchange\Example\Model\StudentFactor
     */
    private $studentFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \StackExchange\Example\Model\StudentFactory $studentFactory   
    ) {
        $this->studentFactory = $studentFactory; 
       parent::__construct($context);

    }
    
    public function execute() 
    {
        
      $resultRedirect = $this->resultRedirectFactory->create();   
     /**
      * Get Record id from Url parameters
      */  
        $id = $this->getRequest()->getParam('example_id');
        
        if($id){
            $studentModel = $this->studentFactory->create();
            $studentModel->load($id);
            /**
             * If getId() has value then means record exits
             */
            if($studentModel->getId()){
                
                try{
                    $studentModel->delete();
                    $this->messageManager->addSuccessMessage(__('The record has been delete successfully'));                    
                } catch (\Exception $ex) {
                    $this->messageManager->addErrorMessage(__('Something wento to wrong while Delete'));
                }

                // after delete Record ,return to Listing page
                return $resultRedirect->setPath('*/*/listing');
            }

        }
        $this->messageManager->addErrorMessage(__('The Record does not exits'));
        //  Return to Listing page
        return $resultRedirect->setPath('*/*/listing');       
    }

}
