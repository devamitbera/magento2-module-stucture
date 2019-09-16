<?php

/*
  * Collection Model Class .As Model and Resource model Class Name is Student
 *  That create name student folder at StackExchange\Example\Model\ResourceModel
 */

namespace StackExchange\Example\Model\ResourceModel\Student;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    
   /**
    * Map Model CLass and Resource mode Class at COllection Class
    */
    public function _construct()
    {
        $this->_init(
                \StackExchange\Example\Model\Student::class,
                 \StackExchange\Example\Model\ResourceModel\Student::class
                );
    }
    
}
