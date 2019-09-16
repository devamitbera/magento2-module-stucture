<?php
namespace StackExchange\Magento\Plugin;


class OrderItemPlugin {

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var \Magento\Sales\Api\Data\OrderItemExtensionFactory
     */
    private $orderItemExtensionFactory;

    public function __construct(
        \Magento\Sales\Api\Data\OrderItemExtensionFactory $orderItemExtensionFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager     
    ) {
        
        $this->orderItemExtensionFactory = $orderItemExtensionFactory;
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
    }
    public function afterGetExtensionAttributes(
        \Magento\Sales\Api\Data\OrderItemInterface $subject,
        $result
    ) {
        
        $imageUrl = $this->getProductImage($subject);
        if(!$imageUrl){
            return $result;
        }
        
        if($result=== null){
            $orderItemExtension =$this->orderItemExtensionFactory->create();
            $orderItemExtension->setProductImage($imageUrl);
            $subject->setExtensionAttributes($orderItemExtension);
        }else{
            $result->setProductImage($imageUrl);
        }
        
        return $result;
    }
    
    private function getProductImage($orderItem)
    {
        
        $productId = $orderItem->getProductId();
        $storeId = $orderItem->getStoreId();
        
        if($productId === null || $storeId === null){
            return false;
        }
        
        try{
            $product = $this->productRepository->getById($productId, false, $storeId);
            return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                    .'catalog/product' . $product->getImage();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $ex) {
            
        }
        return false;   
    }
}
