<?php
/**
 * Create edit page for Update data 
 */

namespace StackExchange\Example\Controller\Adminhtml\Example;


class Edit extends  \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \StackExchange\Example\Model\StudentFactory
     */
    private $studentFactory;

    /**
     * 
     * Add Acl Resource id For Permission at admin section
     */
    const ADMIN_RESOURCE ="StackExchange_Example::example_edit";
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \StackExchange\Example\Model\StudentFactory $studentFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry  
    ) {
        $this->studentFactory = $studentFactory;  
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;        
        parent::__construct($context);
    }

    public function execute() {
        
        /**
         * init Model using Model Factory
         */
        $studentModel= $this->studentFactory->create();
        /**
         * for  update a row data, we need  primary  field value
         * which URL param "example_id" = Database example table "id" field
         */ 
        $id = $this->getRequest()->getParam('example_id');
        if($id){
            /**
             * Load a record data from data using model
             */
            $studentModel->load($id);
            /**
             * Redirect to listing page if a record does not exit at database 
             * with request parameter
             */
            if(!$studentModel->getId()){
               $resultRedirect =  $this->resultRedirectFactory->create();
               return $resultRedirect->setPath('*/*/listing');
            }
            
        }
        /**
         * Save Model Data to a registry variable for future purpose
         * Variable name is user defined
         */
        $this->registry->register('example',$studentModel);
        
        $resultPage =$this->resultPageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Edit Page'));
        /**
         * Left menu Select
         */
        $resultPage->setActiveMenu('StackExchange_Example::menu');
        /**
         * Set Page title
         */
        
        $resultPage->getConfig()->getTitle()->prepend('Example Module');
        $pageTitltPrefix = __('Edit Page for %1',
                $studentModel->getId()?$studentModel->getName(): __('New entry')
                );
        $resultPage->getConfig()->getTitle()->prepend($pageTitltPrefix);
        return $resultPage;
        
    }

}
