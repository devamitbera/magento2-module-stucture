<?php
namespace StackExchange\Example\Block;


class Example extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \StackExchange\Example\Model\StudentFactory
     */
    private $studentFactory;

    /**
    * inject the model Class Factory for getting data
    */
  public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \StackExchange\Example\Model\StudentFactory $studentFactory,
          array $data = array()) 
    {
      parent::__construct($context, $data);
      $this->studentFactory = $studentFactory;
    }  
    
    public function getJohnInfo()
    {
        $studentModel = $this->studentFactory->create();
        
        /**
         * Using primary Id
         */
        $studentModel->load(1); //John Primary 
        
        return $studentModel;
    }
}
