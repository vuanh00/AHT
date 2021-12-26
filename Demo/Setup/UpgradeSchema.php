<?php

namespace AHT\Demo\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $installer = $setup;
            $installer->startSetup();

            $table = $installer->getConnection()
                ->newTable($installer->getTable('table_demo'))
                ->addColumn(
                    'demo_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Post ID'
                )
                ->addColumn(
                    'name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Demo Name'
                );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }
    }
}
