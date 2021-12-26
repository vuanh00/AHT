<?php
namespace AHT\Ui\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'ui_id';
    protected $_eventPrefix = 'aht_ui_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Ui\Model\Post', 'AHT\Ui\Model\ResourceModel\Post');
    }
}
