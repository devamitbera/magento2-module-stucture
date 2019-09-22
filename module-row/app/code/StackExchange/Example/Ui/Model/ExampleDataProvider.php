<?php

namespace StackExchange\Example\Ui\Model;

use Magento\Framework\App\Request\DataPersistorInterface;
use StackExchange\Example\Model\ResourceModel\Student\CollectionFactory;

class ExampleDataProvider  extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{

    protected  $collection;
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CollectionFactory
     */
    private $studentCollectionFactory;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $studentCollectionFactory,    
        array $meta = array(),
        array $data = array(), 
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool = null
    ) {
        $this->studentCollectionFactory = $studentCollectionFactory;
        /**
         * It most important assign ColectionFactoty to collection
         */
        $this->collection  = $studentCollectionFactory->create(); 
        $this->dataPersistor = $dataPersistor;
        parent::__construct
                (
                $name,
                $primaryFieldName,
                $requestFieldName,
                $meta,
                $data,
                $pool
                );
      
    }
    public function getData()
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }
        
        $items = $this->collection->getItems();
        /**
         * @var \StackExchange\Example\Model\Student $student
         */
        foreach ($items as $student){
            $this->loadedData[$student->getId()] = $student->getData();
        }
        /**
         *  a variable to use future use for persist data from save Url
         */
       $data= $this->dataPersistor->get('example_data');
       /**
        * it use during new item create from New form
        */
        if(!empty($data)){
            $student = $this->collection->getNewEmptyItem();
            $student->setData($data);
            $this->loadedData[$student->getId()] = $student->getData();
            
            /**
             * Clear Previous One
             */
            $this->dataPersistor->clear('example_data');
        }
        return $this->loadedData;
    }
}
