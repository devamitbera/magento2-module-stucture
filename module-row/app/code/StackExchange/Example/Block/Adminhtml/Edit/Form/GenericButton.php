<?php


namespace StackExchange\Example\Block\Adminhtml\Edit\Form;


class GenericButton 
{

    /**
     * @var \Magento\Backend\Block\Widget\Context
     */
    private $context;

    /**
     * @var \StackExchange\Example\Model\StudentFactory
     */
    private $studentFactory;

    public function __construct(
        \StackExchange\Example\Model\StudentFactory $studentFactory,
        \Magento\Backend\Block\Widget\Context  $context
   ) {
       
       $this->studentFactory = $studentFactory;
       $this->context = $context;
    }
    public function getId()
    {
        
        /**
         * Get Url param  value
         */
        if($this->context->getRequest()->getParam('example_id')){
            $studentModel =$this->studentFactory->create();
            $studentModel->load($this->context->getRequest()->getParam('example_id'));
            
            return $studentModel->getId();
        }
        return false;
    }
    public function getUrlBuilder()
    {
        return $this->context->getUrlBuilder();
    }
}
