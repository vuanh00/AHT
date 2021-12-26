<?php
namespace AHT\SaleAgent\Block;

class Header extends \Magento\Theme\Block\Html\Header
{
    /**
     * @param \Magento\Customer\Model\SessionFactory
     */
    private $sessionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        array $data = [] 
        
    ) 
    {
        $this->sessionFactory = $sessionFactory;
        parent::__construct($context, $data);
    }
    protected $_template = 'AHT_SaleAgent::header.phtml';
    
    public function isSaleAgent()
    {
        $saleAgent = $this->sessionFactory->create()->getCustomer()->getData('is_sale_agent');
        return $saleAgent;
    }
}
