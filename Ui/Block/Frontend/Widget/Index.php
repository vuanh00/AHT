<?php
namespace AHT\Ui\Block\Frontend\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
use AHT\Ui\Model\ResourceModel\Post\Grid\CollectionFactory;

class Index extends Template implements BlockInterface
{
    protected $_collection;
    public $_storeManager;
    public $_customerSession;

    public $helperData;

    public function __construct(
        CollectionFactory $postCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \AHT\Ui\Helper\Data $helperData,  
        array $data = []

    )
    {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession;
        $this->helperData = $helperData;
        $this->_collection =  $postCollectionFactory;
    }

    public function getDataBlocks()
    {

        $post = $this->_collection->create();    
        return $post;
    }

    public function getStoreManager(){
        return $this->_storeManager;
    }
    
    public function getHelper()
    {
        // $helper =  $this->helperData->getGeneralConfig('module_id/config/enable');
		// $display_test = $this->helperData->getGeneralConfig('module_id/config/display_text');
        // return [
        //  'enable' =>   $helper, 
        //     $display_test
        // ];

        $helper = [
            'helper' =>  $this->helperData->getGeneralConfig('module_id/config/enable'),
		    'display_test' => $this->helperData->getGeneralConfig('module_id/config/display_text')
        ];

        return $helper;
    }
   
    
}