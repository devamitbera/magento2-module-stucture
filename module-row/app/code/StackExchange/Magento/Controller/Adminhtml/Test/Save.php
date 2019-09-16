<?php

namespace StackExchange\Magento\Controller\Adminhtml\Test;

class Save extends \Magento\Backend\App\Action 
{



    public function execute() {
        $resultRedirect = $this->resultRedirectFactory->create();
       

        return $resultRedirect->setPath('*/*/');
    }

}
