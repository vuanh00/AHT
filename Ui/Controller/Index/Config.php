<?php
namespace AHT\Ui\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{
    protected $helperData;

    /**
     * @param \Magento\Framework\View\Result\PageFactory
     */
    private $pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\AHT\Ui\Helper\Data $helperData,
        \Magento\Framework\View\Result\PageFactory $pageFactory

	)
	{
		$this->helperData = $helperData;
        $this->pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{   
		// TODO: Implement execute() method.

		// echo $this->helperData->getGeneralConfig('module_id/config/enable');
		// echo $this->helperData->getGeneralConfig('module_id/config/display_text');
		return $this->pageFactory->create();

	}
	
}
