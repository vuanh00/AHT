<?php
namespace AHT\SaleAgent\Model\ResourceModel\Post\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_saleagent_post_grid_collection';
    protected $_eventObject = 'post_grid_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\SaleAgent\Model\Post\Grid', 'AHT\SaleAgent\Model\ResourceModel\Post\Grid');
    }
    
    // protected function _initSelect()
    // {
    //     parent::_initSelect();
    //     $
    //     $this->getSelect()
    //     ->join()
    // }
}
