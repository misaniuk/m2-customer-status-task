<?php
namespace Mi\Status\CustomerData;
use \Magento\Customer\CustomerData\SectionSourceInterface;

class StatusSection implements SectionSourceInterface
{
    protected $viewModel;

    public function __construct(
        \Mi\Status\ViewModel\Customer $viewModel
    ) {
        $this->viewModel = $viewModel;
    }

    public function getSectionData()
    {
    	return [
        	'status' => $this->viewModel->getCustomerMiStatus(),
    	];
    }
    
}