<?php
namespace AHT\Demo\Block;

class Create extends \Magento\Framework\View\Element\Template
{
 
    /**
     * @param \AHT\Demo\Model\PostFactory
     */
    private $postFactory;

    /**
     * @param \AHT\Demo\Model\PostRepository
     */
    private $postRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Demo\Model\PostFactory $postFactory,
        \AHT\Demo\Model\PostRepository $postRepository,
        array $data = []
    ) {
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context, $data);
    }
}
