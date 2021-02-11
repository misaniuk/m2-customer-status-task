<?php

namespace Mi\Status\ViewModel;

use \Magento\Customer\Model\Session;
use \Magento\Customer\Api\CustomerRepositoryInterface;

class Customer implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    protected $customerRepository;
    /**
     * @param \Magento\Catalog\Model\CustomerFactory  $customerFactory
     */
    public function __construct(
        Session $sessionCustomer,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->sessionCustomer = $sessionCustomer;
        $this->customerRepository = $customerRepository;
    }

    public function getCustomerMiStatus()
    {
        $customerId = $this->sessionCustomer->getId();

        return $this->getAttributeValue($customerId, 'customer_mi_status')->getValue();
    }

    public function getAttributeValue($customerId, $attrCode)
    {
        $customer = $this->customerRepository->getById($customerId);
        return $customer->getCustomAttribute($attrCode);
    }
}