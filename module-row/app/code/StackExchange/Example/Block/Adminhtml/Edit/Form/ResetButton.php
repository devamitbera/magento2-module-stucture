<?php
namespace StackExchange\Example\Block\Adminhtml\Edit\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton   extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData(): array 
    {
         return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'window.location.reload();',
            'sort_order' => 30
        ];       
    }

}
