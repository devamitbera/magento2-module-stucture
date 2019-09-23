<?php
namespace StackExchange\Example\Block\Adminhtml\Edit\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class NewButton  extends GenericButton implements ButtonProviderInterface
{
   
    public function getButtonData(): array {
        return [
            'label' => __('Add A New Student'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrlBuilder()->getUrl('*/*/new')),
            'class' => 'save primary',
            'sort_order' => 12
        ];        
    }

}
