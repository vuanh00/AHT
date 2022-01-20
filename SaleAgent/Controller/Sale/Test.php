<?php
namespace AHT\SaleAgent\Controller\Sale;

class Test extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\SaleAgent\Model\PostFactory
     */
    private $postFactory;

    /**
     * @param \AHT\SaleAgent\Model\PostRepository
     */
    private $postRepository;

    /**
     * @param \AHT\SaleAgent\Model\ResourceModel\Post\Collection
     */
    private $collection;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\SaleAgent\Model\PostFactory $postFactory,
        \AHT\SaleAgent\Model\PostRepository $postRepository,
        \AHT\SaleAgent\Model\ResourceModel\Post\CollectionFactory $collection
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        $this->collection = $collection;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $abc = $this->collection->create();
        echo $abc->getSelect()->__toString();
       echo '<pre>';
       var_dump($abc->getData());
       die;
        return $this->_pageFactory->create();
    }
}
