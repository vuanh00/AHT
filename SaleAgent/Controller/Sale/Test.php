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
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\SaleAgent\Model\PostFactory $postFactory,
        \AHT\SaleAgent\Model\PostRepository $postRepository
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $post = $this->postFactory->create()->load(7);
        // $post->setId($order->getData('entity'));
        // $post->setId(1);
        $post->setData('order_id',1465656);
        $post->setData('order_item_id',"1");

        $post->setData('order_item_sku',"1");

        $post->setData('order_item_price',"1");

        $post->setData('commission_type'," KimHTVTYH Anh");

        $post->setData('commission_value',"2");
        echo"<pre>";
        print_r($post->getData());
        $post->save();

        // $this->postRepository->save($post);
        
        return $this->_pageFactory->create();
    }
}
