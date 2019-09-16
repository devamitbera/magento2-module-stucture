<?php
namespace StackExchange\Magento\Plugin\Controller\Result;

class LayoutPlugin 
{

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    const MY_SPECIFIC_LAYOUT_HANDLE = "stackexchange_example_orderview";
    
    public function __construct(
       \Magento\Framework\App\Request\Http $request  
    ) {
        
        $this->request = $request;
    }
    public function afterAddDefaultHandle(
      \Magento\Framework\View\Result\Layout $subject,
        $result    
    )
    {
        $this->request->getFullActionName();
        if($this->request->getFullActionName()  !== 'sales_order_view' ||
                $this->request->getParam('visited_from') !== 'orderview'){
             return $result;
        }
       // $subject->addHandle(self::MY_SPECIFIC_LAYOUT_HANDLE);
        return $result;
    }
}
