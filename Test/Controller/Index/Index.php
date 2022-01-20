<?php
namespace AHT\Test\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\Test\Model\PostFactory
     */
    private $postFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Test\Model\PostFactory $postFactory
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
        echo 'heelloo0';die();
        $this->test(3,4);
        // return $this->_pageFactory->create();
    }
    public function test($a, $b)
    {
        return $c = $a +$b;

    }
}