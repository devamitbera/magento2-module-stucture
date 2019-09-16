<?php

namespace StackExchange\Magento\Model;


class ReadHandler implements \Magento\Framework\EntityManager\Operation\ExtensionInterface
{

    /**
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
     */
    private $stockRegistry;

    public function __construct(
    \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry     
    ) {
        
        $this->stockRegistry = $stockRegistry;
    }
    /**
     * Magento\CatalogInventory\Api\Data\StockItemInterface
     * @param type $product
     * @param type $arguments
     */
    public function execute($product, $arguments = [])
    {
        if ($product->getExtensionAttributes()->getStockItem() !== null) {
            return $product;
        }
        
        $stockItem =$this->stockRegistry->getStockItem($product->getId());
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setStockItem($stockItem);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;        
    }

}
