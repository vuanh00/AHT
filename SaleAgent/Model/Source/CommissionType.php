<?php
namespace AHT\SaleAgent\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class CommissionType extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    const VALUE_FIXED = 'F';
    const VALUE_PERCENT ='P';
    const VALUE_NONE = 'N';
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('None'), 'value' => static::VALUE_NONE],
                ['label' => __('Fixed'), 'value' => static::VALUE_FIXED],
                ['label' => __('Percent'), 'value' => static::VALUE_PERCENT]
            ];
        }
        return $this->_options;
    }


}
