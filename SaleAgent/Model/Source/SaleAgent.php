<?php
namespace AHT\SaleAgent\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class SaleAgent extends AbstractSource implements SourceInterface, OptionSourceInterface
{

    /**
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory
    ){
        $this->collectionFactory = $collectionFactory;
    }
    
    public function getAllOptions()
    {
        $collection = $this->collectionFactory->create()
        ->addAttributeToSelect('*')
        ->addAttributeToFilter('is_sale_agent', array('eq' => '1'));
        $this->options = [];
        foreach ($collection as $customer) {
            // print_r($customer->getData());
            $data = [
                'label' => $customer->getFirstname().' '.$customer->getLastname(),
                'value' => $customer->getEntity_id()
            ];
            array_push($this->options, $data);
        }
        return $this->options;

    }

   
}
