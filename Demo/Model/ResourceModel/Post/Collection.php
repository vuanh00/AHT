<?php
namespace AHT\Demo\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'demo_id';
    protected $_eventPrefix = 'aht_Demo_post_collection';
    protected $_eventObject = 'post_collection';

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->_init('AHT\Demo\Model\Post', 'AHT\Demo\Model\ResourceModel\Post');
        parent::__construct(
            $entityFactory, $logger, $fetchStrategy, $eventManager, $connection,
            $resource
        );
        $this->logger = $logger;
        $this->storeManager = $storeManager;
        $this->store = $this->storeManager->getStore();
        $this->storeId = $this->store->getId();
        print_r($this->storeId);//THIS PRINTS ON THE PAGE CORRECT STORE ID
    }

    protected function _initSelect()
    {

        parent::_initSelect();
        
        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('my_custom')], //2nd table name by which you want to join
            'main_table.my_id = secondTable.my_id AND secondTable.store = '.(int)$this->storeId, // HERE DOES NOT WORK! common column which available in both table
            '*' // '*' define that you want all column of 2nd table. if you want some particular column then you can define as ['column1','column2']
        );

    }
    
}
