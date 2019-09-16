<?php


namespace StackExchange\Magento\Plugin\Controller\Order;

use Magento\Framework\View\Result\PageFactory;
use Magento\Sales\Controller\AbstractController\OrderLoaderInterface;

class ViewPlugin 
{

    /**
     * @var OrderLoaderInterface
     */
    private $orderLoader;


    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    private $resultLayoutFactory;

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    public function __construct(
        PageFactory $resultPageFactory,
       \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        OrderLoaderInterface  $orderLoader   
     ) {
        
         $this->resultPageFactory = $resultPageFactory;
         $this->resultLayoutFactory = $resultLayoutFactory;
         $this->orderLoader = $orderLoader;
    }
     public function aroundExecute(
        \Magento\Sales\Controller\Order\View $subject,
        \Closure $proceed    
     ) {
         if($subject->getRequest()->getParam('visited_from') == 'orderview'){
             
            $result = $this->orderLoader->load($subject->getRequest());
            if ($result instanceof \Magento\Framework\Controller\ResultInterface) {
                return $result;
            }
            
            $resultPage = $this->resultPageFactory->create();
            //$navigationBlock = $resultPage->getLayout()->getBlock('customer_account_navigation');
            
           //$resultPage->getLayout()->removeOutputElement('customer_account_navigation');
            //$resultLayout = $this->resultLayoutFactory->create();
           // $resultLayout->addDefaultHandle();
           // print_r($resultLayout->getLayout()->getUpdate()->asString());
            //exit;
            //$response = $resultLayout->getLayout()->getBlock('order.status')->toHtml();
            $response = $resultPage->getLayout()->getBlock('sales.order.view')->toHtml();
            return $subject->getResponse()->setBody($response);            
         }
         
         // run original  Method
         return $proceed();
    }

}
