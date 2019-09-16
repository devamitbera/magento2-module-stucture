<?php

namespace StackExchange\Example\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    
    public function __construct(
            \Magento\Framework\App\Action\Context $context
     ) {
        parent::__construct($context);
    }

    public function execute() 
    {

       return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }

}
