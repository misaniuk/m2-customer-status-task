<?php
 
 
namespace Mi\Status\Setup\Patch\Data;
 
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Setup\CustomerSetup;
 
class StatusCustomerAttribute implements DataPatchInterface, PatchRevertableInterface
{
 
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var CustomerSetup
     */
    private $customerSetupFactory;
 
    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }
 
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'customer_mi_status',
            [
                'type' => 'varchar',
                'label' => 'Customer Mi Status',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 500,
                'system' => false,
                'backend' => ''
            ]
        );
         
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'customer_mi_status')->addData([
            'used_in_forms' => [
                'adminhtml_customer'
            ]
        ]);
        $attribute->save();
 
        $this->moduleDataSetup->getConnection()->endSetup();
    }
 
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'customer_mi_status');
 
        $this->moduleDataSetup->getConnection()->endSetup();
    }
 
    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
 
    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }
}