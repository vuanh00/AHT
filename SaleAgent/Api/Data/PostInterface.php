<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\SaleAgent\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface PostInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID      = 'saleagent_id';
    const IDENTIFIER    = 'identifier';
    const ORDER_ID         = 'order_id';
    const ORDER_ITEM_ID         = 'order_item_id';
    const ORDER_ITEM_SKU         = 'order_item_sku';
    const ORDER_ITEM_PRICE         = 'order_item_price';
    const COMMISSION_TYPE         = 'commission_type';
    const COMMISSION_VALUE     = 'commission_value';

   
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

     /**
     * Get order id
     *
     * @return string|null
     */
    public function getOrderId();

    /**
     * Get order item id
     *
     * @return string|null
     */
    public function getItemId();

    /**
     * Get order item sku
     *
     * @return string|null
     */
    public function getSku();

    /**
     * Get order item price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Get commission type
     *
     * @return string|null
     */
    public function getType();

    /**
     * Get commission value
     *
     * @return string|null
     */
    public function getValue();

    /**
     * Set ID
     *
     * @param int $id
     * @return PostInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return Postnterface
     */
    public function setIdentifier($identifier);

    /**
     * Set order item id
     *
     * @param string $itemId
     * @return PostInterface
     */
    public function setItemId($itemId);

     /**
     * Set order id
     *
     * @param string $orderId
     * @return PostInterface
     */
    public function setOrderId($orderId);

    /**
     * Set order item sku
     *
     * @param string $sku
     * @return PostInterface
     */
    public function setSku($sku);

     /**
     * Set order item price
     *
     * @param string $price
     * @return PostInterface
     */
    public function setPrice($price);

     /**
     * Set commission type
     *
     * @param string $type
     * @return PostInterface
     */
    public function setType($type);

     /**
     * Set commisson value
     *
     * @param string $value
     * @return PostInterface
     */
    public function setValue($value);
}
