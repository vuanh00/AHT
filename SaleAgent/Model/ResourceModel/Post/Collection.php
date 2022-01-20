<?php
namespace AHT\SaleAgent\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_saleagent_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\SaleAgent\Model\Post', 'AHT\SaleAgent\Model\ResourceModel\Post');
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        
        $this->getSelect()
        ->join(
            'sales_order_item as item',
            'main_table.order_id=item.order_id',
            array('item.name', 'main_table.order_item_sku', 'main_table.commission_type', 'main_table.commission_value') )
        ->join(
            'catalog_product_entity as cpe',
            'main_table.order_item_sku=cpe.sku',
            array('cpe.entity_id')
        )
        ->join(
            array( 'cpei' => 'catalog_product_entity_int', 'cpe' => 'catalog_product_entity'),
            'cpei.entity_id=cpe.entity_id',
            array('cpei.value')
        )
        ->join(
            array('eav' => 'eav_attribute'),
            'cpei.attribute_id=eav.attribute_id',
            array('eav.attribute_id', 'eav.attribute_code')
        )
        ->join(
            array( 'ce' => 'customer_entity'),
            'cpei.value=ce.entity_id',
            array('ce.entity_id as id_customer', 'ce.email')
        )
        ->join(
            array( 'cei' => 'customer_entity_int'),
            'ce.entity_id=cei.entity_id',
            array('cei.value as is_sale_agent')
        )
        ->where("eav.attribute_code='sale_agent_id'")
        ->where("cei.value=1")
        ;
        return $this;
        
    }
    // protected function _initSelect()
    // {   
    //     parent::_initSelect();
    //     $this->getSelect()
    //         ->joinleft('blog_comments as item',
    //             'main_table.post_id=item.post_id', 
    //             array('main_table.*', 'count(item.cmt_id) as sl',
    //             ))
    //             ->group('main_table.post_id');
    // }
}
