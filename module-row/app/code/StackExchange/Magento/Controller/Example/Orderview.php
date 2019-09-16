<?php

namespace StackExchange\Magento\Controller\Example;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Layout;
use Magento\Framework\Controller\ResultFactory;

class Orderview  extends \Magento\Framework\App\Action\Action
{
    
    public function execute() 
    {
        
        
       // $this->_view->loadLayout();
        //$this->_view->renderLayout();
        
        //$this->_view->addActionLayoutHandles(['']);
        
        
        $this->_forward(
                    'view', 
                        'order', 
                        'sales', 
                    [
                        'order_id' =>$this->getRequest()->getParam('order_id'),
                        'visited_from' => 'orderview'
                    ]
                );
        /*        
        $this->getRequest()->getParam('order_id');
        
        $request = $this->getRequest();
        $request->setModuleName('sales')->setControllerName('order')
                ->setActionName('view')
                ->setParam('order_id', $this->getRequest()->getParam('order_id'));
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, 
              'sales_view_',$this->getRequest()->getParam('order_id'));
       
        //  $resultForward=  $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $request->setDispatched(false);
        return $this;*/
    }

}
