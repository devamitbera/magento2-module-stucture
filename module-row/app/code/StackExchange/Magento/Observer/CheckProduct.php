<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace StackExchange\Magento\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class CheckProduct implements ObserverInterface {

    protected $_logger;
    protected $_storeManager;
    protected $messageManager;
    protected $productRepository;
    protected $_resultPageFactory;

    public function __construct(
            \Psr\Log\LoggerInterface $logger,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\Framework\Message\ManagerInterface $messageManager,
            \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->_logger = $logger;
        $this->_storeManager = $storeManager;
        $this->messageManager = $messageManager;
        $this->productRepository = $productRepository;
    }

    public function execute(Observer $observer) {
        $product = $observer->getEvent()->getProduct();
        if ($this->_ciicustomerHelper->isCustomerLoggedIn()) {
            try {
                //Exam Service Api data
                $productSku = $product->getSku();
                $source_sku = $this->checkProduct($productSku);
                if (isset($source_sku) && $source_sku != false) :
                    $message = "You can not buy this product";
                    $this->messageManager->addError(__($message));
                endif;
            } catch (\Exception $ex) {
                $this->_logger->info("Message " . $ex->getMessage());
            }
        }
        return $this;
    }

    public function checkProduct($productSku) {
        $connection = $this->getConnection();
        $sql = "select * from custom_table where sku='" . $productSku . "'";
        $resultProduct = $connection->query($sql);
        $resultQuery = $resultProduct->fetchAll();

        if (!empty($resultQuery)) {
            $parent_sku = $resultQuery[0]['parent_sku'];
            return true;
        } else {
            return false;
        }
    }

}
