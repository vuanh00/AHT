<?php
namespace AHT\demo\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \AHT\demo\Model\PostRepository
     */
    private $postRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \AHT\demo\Model\PostRepository $postRepository,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->postRepository = $postRepository;
        parent::__construct($context, $data);
    }
    public function getPost()
    {         
        $id = $this->registry->registry('post_id');
        $post = $this->postRepository->getById($id);
        return $post;
    }
}
