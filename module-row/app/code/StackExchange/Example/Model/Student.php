<?php

/**
 * Create model  name of Student
 */
namespace StackExchange\Example\Model;


class Student extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Map Resource Class At Model lass
     */
    public function _construct()
    {
        $this->_init(\StackExchange\Example\Model\ResourceModel\Student::class);
    }
}
