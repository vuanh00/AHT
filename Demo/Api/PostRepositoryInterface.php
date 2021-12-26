<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Demo\Api;

/**
 * CMS Post CRUD interface.
 * @api
 * @since 100.0.2
 */
interface PostRepositoryInterface
{
    /**
     * Save Post.
     *
     * @param \AHT\Demo\Api\Data\PostInterface $Post
     * @return \AHT\Demo\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\AHT\Demo\Api\Data\PostInterface $Post);

    /**
     * Retrieve Post.
     *
     * @param int $PostId
     * @return \AHT\Demo\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($PostId);

    /**
     * Retrieve Posts matching the specified criteria.
     *
     *
     * @return \AHT\Demo\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList();

    /**
     * Delete Post.
     *
     * @param \AHT\Demo\Api\Data\PostInterface $Post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\AHT\Demo\Api\Data\PostInterface $Post);

    /**
     * Delete Post by ID.
     *
     * @param int $PostId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($PostId);
}
