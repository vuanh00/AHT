<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Demo\Model;

use AHT\Demo\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * CMS Post model
 *
 * @method Post setStoreId(int $storeId)
 * @method int getStoreId()
 */
class Post extends AbstractModel implements PostInterface, IdentityInterface
{
    /**
     * CMS Post cache tag
     */
    const CACHE_TAG = 'post_b';

    /**#@+
     * Post's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**#@-*/

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'post_Post';

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AHT\Demo\Model\ResourceModel\Post::class);
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
     * Retrieve Post id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::POST_ID);
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
     * Retrieve Post title
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    
    /**
     * Set ID
     *
     * @param int $id
     * @return PostInterface
     */
    public function setId($id)
    {
        return $this->setData(self::POST_ID, $id);
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
     * Set title
     *
     * @param string $title
     * @return PostInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

}
