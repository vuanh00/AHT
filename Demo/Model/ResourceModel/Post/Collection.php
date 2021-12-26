<?php
namespace AHT\Demo\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'demo_id';
    protected $_eventPrefix = 'aht_Demo_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Demo\Model\Post', 'AHT\Demo\Model\ResourceModel\Post');
    }
}
