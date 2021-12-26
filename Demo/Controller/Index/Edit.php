<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Demo\Controller\Index;


class Edit extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_postFactory;

    /**
     * @param \Magento\Framework\App\RequestInterface
     */
    private $request;

	/**
	 * @param \AHT\demo\Model\PostRepository
	 */
	private $postRepository;

	/**
	 * @param \Magento\Framework\Registry
	 */
	private $_coreRegistry;

	/**
	 * @param \AHT\demo\Model\PostFactory
	 */
	private $postFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\RequestInterface $request,
		\AHT\demo\Model\PostRepository $postRepository,
		\Magento\Framework\Registry $coreRegistry,
		\AHT\demo\Model\PostFactory $postFactory
		)
	{
		$this->_pageFactory = $pageFactory;
        $this->request = $request;
		$this->postRepository = $postRepository;
		$this->_coreRegistry = $coreRegistry;
		$this->_postFactory = $postFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		 // 1. Get ID and create model
		 $id = $this->getRequest()->getParam('id');
 
		 // 2. Initial checking
		 $model = $this->_postFactory->create();
		 if ($id) {
			$model = $this->postRepository->getById($id);
			 if (!$this->postRepository->getById($id)) {
				 $this->messageManager->addErrorMessage(__('This block no longer exists.'));
				 /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
				 $resultRedirect = $this->resultRedirectFactory->create();
				 return $resultRedirect->setPath('*/*/');
			 }
		 }
 
		 $this->_coreRegistry->register('post_id', $id);
 
		 // 5. Build edit form
		 /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		 $resultPage = $this->_pageFactory->create();
		//  $resultPage->addBreadcrumb(
		// 	 $id ? __('Edit Post') : __('New Post'),
		// 	 $id ? __('Edit Post') : __('New Post')
		//  );
		 $resultPage->getConfig()->getTitle()->prepend(__('Posts'));
		 $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Post'));
		 return $resultPage;
	}
}