<?php
namespace AHT\SaleAgent\Plugin;

class CustomerInfo
{
    /**
     * @param \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) 
    {
        $this->customerRepository = $customerRepository;
        
    }
     public function afterGetFirstname(\Magento\Customer\Model\Data\Customer $subject, $result)
    {
        $saleAgent = $this->customerRepository->getById($subject->getId());
        $isSaleAgent = $saleAgent->getCustomAttribute('is_sale_agent')->getValue();
        if( $isSaleAgent == 1){
            $result = 'Sale Agent: ' . $result;
        }
        else
        {
            $result = str_replace('Sale Agent: ','', $result);
            return $result;
        }
        return $result;
    }
}
