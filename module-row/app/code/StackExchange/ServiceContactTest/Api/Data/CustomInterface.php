<?php

namespace StackExchange\ServiceContactTest\Api\Data;


interface CustomInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**
     * Getter function for Primary key field of your custom table
     * @return int
     */
    public function getId();
    
    /**
     * setter function for Primary key field of your custom table
     * 
     * @param int $id
     * @return void
     */
    public function setId($id);   
    
     /**
     * Getter function for is_seller key field of your custom table
     * @return int
     */
    public function getIsSeller();
    
    /**
     * setter function for is_seller field of your custom table
     * 
     * @param int $isSeller
     * @return void
     */
    public function setIsSeller($isSeller);    
}
