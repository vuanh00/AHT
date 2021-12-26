<?php
namespace AHT\Demo\Controller\Index;

class Create extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\Demo\Model\PostFactory
     */
    private $postFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */

     
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Demo\Model\PostFactory $postFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->postFactory = $postFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
