<?php

namespace AHT\Ui\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;


class Image extends \Magento\Ui\Component\Listing\Columns\Column
{


    /**
     * @var \PHPCuong\postSlider\Model\post
     */
    protected $post;
    protected $_storeManager;
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \PHPCuong\postSlider\Model\post $post
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \AHT\Ui\Model\Post $post,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->post = $_POST;
        $this->_storeManager = $storeManager;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $post = new \Magento\Framework\DataObject($item);
                $item[$fieldName . '_src'] = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)."aht/post/".$post['image'];
                $item[$fieldName . '_orig_src'] = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)."aht/post/".$post['image'];
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl("post/index/edit",
                    ['id' => $post['id']]
                );
                $item[$fieldName . '_alt'] = $post['name'];
            }
        }

        return $dataSource;
    }
}