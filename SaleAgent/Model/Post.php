<?php
namespace AHT\SaleAgent\Model;

use AHT\SaleAgent\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel implements IdentityInterface, PostInterface
{
    const CACHE_TAG = 'aht_saleagent_post';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'post';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AHT\SaleAgent\Model\ResourceModel\Post::class);
    }


    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG . '_' . $this->getIdentifier()];
    }

    /**
     * Retrieve order id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Retrieve Post identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return (string)$this->getData(self::IDENTIFIER);
    }

     /**
     * Retrieve order id
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Retrieve order item id
     *
     * @return int
     */
    public function getItemId()
    {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    /**
     * Retrieve order item sku
     *
     * @return int
     */
    public function getSku()
    {
        return $this->getData(self::ORDER_ITEM_SKU);
    }

    /**
     * Retrieve order item price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->getData(self::ORDER_ITEM_PRICE);
    }

    /**
     * Retrieve commission type
     *
     * @return int
     */
    public function getType()
    {
        return $this->getData(self::COMMISSION_TYPE);
    }

     /**
     * Retrieve commission value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->getData(self::COMMISSION_VALUE);
    }

     /**
     * Set ID
     *
     * @param int $id
     * @return PostInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return PostInterface
     */
    public function setIdentifier($identifier)
    {
        return $this->setData(self::IDENTIFIER, $identifier);
    }

     /**
     * Set order item id
     *
     * @param int $itemId
     * @return PostInterface
     */
    public function setItemId($itemId)
    {
        return $this->setData(self::ORDER_ITEM_ID, $itemId);
    }

     /**
     * Set order  id
     *
     * @param int $orderId
     * @return PostInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

     /**
     * Set order item sku
     *
     * @param int $sku
     * @return PostInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::ORDER_ITEM_SKU, $sku);
    }

     /**
     * Set order item price
     *
     * @param int $price
     * @return PostInterface
     */
    public function setPrice($price)
    {
        return $this->setData(self::ORDER_ITEM_PRICE, $price);
    }

     /**
     * Set commission type
     *
     * @param int $type
     * @return PostInterface
     */
    public function setType($type)
    {
        return $this->setData(self::COMMISSION_TYPE, $type);
    }

     /**
     * Set commission value
     *
     * @param int $value
     * @return PostInterface
     */
    public function setValue($value)
    {
        return $this->setData(self::COMMISSION_VALUE, $value);
    }
}
