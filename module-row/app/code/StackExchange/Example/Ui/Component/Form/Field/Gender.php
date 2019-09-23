<?php

namespace StackExchange\Example\Ui\Component\Form\Field;

use Magento\Framework\Data\OptionSourceInterface;

class Gender  implements OptionSourceInterface
{

    public function toOptionArray(): array {
        $options = [];
            $options[] = [
               'label' => __('Male'),
               'value' => 1,
            ];
            $options[] = [
               'label' => __('FeMale'),
               'value' => 2,
            ]; 
          $this->options = $options;    
         return $options;
    }

}
