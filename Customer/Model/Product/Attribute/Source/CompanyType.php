<?php
namespace AHT\Customer\Model\Product\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class CompanyType extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    const VALUE_MANUFACTURER = 'CBD Manufacturer';
    const VALUE_BRAND ='CBD Brand and Marketing company';
    const VALUE_EXTRACTOR = 'CBD Extractor';
    const VALUE_OTHER = 'Other';

    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('CBD Manufacturer'), 'value' => 1],
                ['label' => __('CBD Brand and Marketing company'), 'value' => 2],
                ['label' => __('CBD Extractor'), 'value' => 3],
                ['label' => __('Other'), 'value' => 4]

            ];
        }
        return $this->_options;
    }


}
