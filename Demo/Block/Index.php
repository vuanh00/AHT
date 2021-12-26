<?php
namespace AHT\Demo\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    private $postFactory;
    private $postResponsitory;
    /**
     * @param \AHT\demo\Model\PostRepository
     */
    private $postReponsitory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        
        \AHT\demo\Model\PostRepository $postReponsitory,
        array $data = []
    ) {

        $this->postReponsitory = $postReponsitory;
        parent::__construct($context, $data);
    }

	public function getBlogInfo()
	{
		return __('AHT Demo module');
	}
	public function getPosts()
	{
		$collection = $this->postReponsitory->getList();
        
		// $collection = $post->getCollection();
		return $collection;
	}
}
