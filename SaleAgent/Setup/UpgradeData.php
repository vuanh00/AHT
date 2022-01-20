<?php

namespace AHT\SaleAgent\Setup;

use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $CustomerSetupFactory;

    public function __construct(
        CustomerSetupFactory $CustomerSetupFactory,
        EavSetupFactory $eavSetupFactory
        )
    {
        $this->CustomerSetupFactory = $CustomerSetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.26') < 0) {

            $CustomerSetup = $this->CustomerSetupFactory->create(['setup' => $setup]);
            $CustomerSetup->addAttribute(
                'customer',
                'is_sale_agent',
                [
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Sale Agent',
                    'input' => 'boolean',
                    'required' => false,
                    'default' => 0,
                    'sortorder' => 3,
                     'system' => false,
                    'is_used_in_grid' => 1,   //setting grid options
                    'is_visible_in_grid' => 1,
                    'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class
                    // 'type' => 'int',
                    // 'label' => 'Sale Agent',
                    // 'input' => 'boolean',
                    // 'source' => '',
                    // 'value' => 0,
                    // 'default' => '',
                    // 'required' => false,
                    // 'visible' => false,
                    // 'user_defined' => true,
                    // 'sort_order' => 300,
                    // 'position' => 300,
                    // 'system' => false,
                    // 'is_used_in_grid' => false,
                    // 'is_visible_in_grid' => false,
                    // 'is_visible' => true,
                    // 'is_filterable_in_grid' => false,
                    // 'is_searchable_in_grid' => false,

                ]
            );
            $attribute = $CustomerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_sale_agent')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]]);

                $CustomerSetup->addAttributeToSet(
                    \Magento\Customer\Api\CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                    \Magento\Customer\Api\CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
                    null,
                    'is_sale_agent');

            $attribute->save();

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                'catalog_product',
                'commission_type',
                [
                    'type' => 'varchar',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Commission Type',
                    'input' => 'select',
                    'class' => '',
                    'source' => \AHT\SaleAgent\Model\Source\CommissionType::class,
                    'required' => true,
                    'user_defined' => false,
                    'default' => '',
                    'group' => 'Sale agent',
                    'is_used_in_grid' => 1,   //setting grid options
                    'is_visible_in_grid' => 1
                   
                ]
            );

          
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'sale_agent_id',
                [
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Sale Agent Id',
                    'input' => 'select',
                    'class' => '',
                     'source' => \AHT\SaleAgent\Model\Source\SaleAgent::class,
                    'required' => true,
                    'user_defined' => false,
                    'default' => '',
                    'group' => 'Sale agent',
                    'is_used_in_grid' => 1,   //setting grid options
                    'is_visible_in_grid' => 1
                ]
            );
           
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'commission_value',
                [
                    'type' => 'decimal',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Commission Value',
                    'input' => 'text',
                    'class' => '',
                    // 'source' => \AHT\SaleAgent\Model\Source\CommissionType::class,
                    'required' => true,
                    'user_defined' => false,
                    'default' => '',
                    'group' => 'Sale agent',
                    'is_used_in_grid' => 1,   //setting grid options
                    'is_visible_in_grid' => 1
                ]
            );
        }
        $setup->endSetup();
    }
}
