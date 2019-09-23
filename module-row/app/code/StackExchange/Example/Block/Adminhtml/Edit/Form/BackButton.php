<?php
namespace StackExchange\Example\Block\Adminhtml\Edit\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class BackButton  extends GenericButton implements ButtonProviderInterface
{
   
    public function getButtonData(): array {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrlBuilder()->getUrl('*/*/listing')),
            'class' => 'back',
            'sort_order' => 10
        ];        
    }

}
