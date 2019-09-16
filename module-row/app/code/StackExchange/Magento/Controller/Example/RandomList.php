<?php

namespace StackExchange\Magento\Controller\Example;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Layout;
use Magento\Framework\Controller\ResultFactory;

class RandomList  extends \Magento\Framework\App\Action\Action
{
    
    public function execute() 
    {
         return $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);
    }

}
