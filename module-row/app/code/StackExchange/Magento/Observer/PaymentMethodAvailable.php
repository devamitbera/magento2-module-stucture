<?php


namespace StackExchange\Magento\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Sales\Api\OrderRepositoryInterface;

class PaymentMethodAvailable implements ObserverInterface
{

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder       
    ) {
        $this->orderRepository = $orderRepository;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        
        if($quote === null){
            return $this;
        }
        // return immedia when Customer id does not exits on Guest Checkout
        if($quote->getCustomerId() === null  && $quote->getCustomerId() < 1 ){
            return $this;
        }
        $hasCustomerProcessingOrders = $this
                ->getOrderCollectionByCustomerId($quote->getCustomerId());
        if($hasCustomerProcessingOrders  && 
                $observer->getEvent()->getMethodInstance()->getCode() == "banktransfer" )
        {
            $checkResult = $observer->getEvent()->getResult();
            $checkResult->setData('is_available', false);
        }
    }
    
    /**
     * Get Customer List of Processing order 
     * 
     * @param int $customerId
     * @return boolean
     */
    private function getOrderCollectionByCustomerId($customerId)
    {
        $filterBuilder1 =[]; $filterBuilder2 = [];
        
        $filterBuilder1[] = $this->filterBuilder->setField('status')
                ->setConditionType('eq')
                ->setValue('processing')->create(); 
        
        $filterBuilder2[] = $this->filterBuilder
            ->setField('customer_id')
             ->setConditionType('eq')
            ->setValue($customerId)->create();
       
        $searchCriteria = $this->searchCriteriaBuilder
                ->addFilters($filterBuilder1)
                ->addFilters($filterBuilder2)
                ->setCurrentPage(1)
                ->setPageSize(1)
                ->create();
        $orders = $this->orderRepository->getList($searchCriteria);
        if($orders->getTotalCount() >= 1 ){
            return  true;
        }
        return false;
        
    }
    
}