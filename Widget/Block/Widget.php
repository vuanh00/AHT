<?php
 
namespace AHT\Widget\Block;
 
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
 
class Widget extends Template implements BlockInterface
{
    protected $_template = "sample.phtml";
}