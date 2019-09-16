<?php
namespace StackExchange\Magento\Plugin;

use Magento\Customer\Api\Data\CustomerInterface;

class AccountManagementPlugin 
{
    public function beforeCreateAccount(
        \Magento\Customer\Api\AccountManagementInterface $subject,
        CustomerInterface $customer,
        $password = null,
        $redirectUrl = ''
    ){
        // Set dump value to - to firstName and last Name
        if($customer->getFirstname() == null){
            $customer->setFirstname('-');
        }
        if($customer->getLastname() == null){
            $customer->setLastname('-');
        }       
        return [$customer,$password,$redirectUrl];
    }
}
