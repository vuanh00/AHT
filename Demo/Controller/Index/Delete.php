<?php
namespace AHT\Demo\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\demo\Model\PostRepository
     */
    private $postRepository;

    /**
     * @param \AHT\demo\Model\PostFactory
     */
    private $postFactory;

    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \Magento\Framework\App\Cache\TypeListInterface
     */
    private $_cacheTypeList;

    /**
     * @param \Magento\Framework\App\Cache\Frontend\Pool
     */
    private $_cacheFrontendPool;

    /**
     * @param \Magento\Framework\Controller\ResultFactory
     */
    private $resultRedirect;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Demo\Model\PostRepository $postRepository,
        \AHT\Demo\Model\PostFactory $postFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Cache\TypeListInterface $_cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $_cacheFrontendPool,
        \Magento\Framework\Controller\ResultFactory $resultRedirect
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        $this->registry = $registry;
        $this->_cacheTypeList = $_cacheTypeList;
        $this->_cacheFrontendPool = $_cacheFrontendPool;
        $this->resultRedirect = $resultRedirect;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $post_id = $this->getRequest()->getParam('id');
		$this->postRepository->deleteById($post_id);
        
        // $types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
		// foreach ($types as $type) {
		//     $this->_cacheTypeList->cleanType($type);
		// }
		// foreach ($this->_cacheFrontendPool as $cacheFrontend) {
		//     $cacheFrontend->getBackend()->clean();
		// }
		
		$resultRedirect = $this->resultRedirectFactory->create();
		$resultRedirect->setPath('demo/index/index');
		return $resultRedirect;
    }
}
