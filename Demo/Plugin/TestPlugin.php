<?php
namespace AHT\Demo\Plugin;

class TestPlugin
{
    // public function beforeTest(\AHT\Demo\Controller\Index\Index $subject, $a=0, $b=0)
    // {
    //     $a = 10;
    //     $b = 10;
    //     return [$a, $b];
    // }
    // public function afterTest(\AHT\Demo\Controller\Index\Index $subject, $result)
    // {
    //    $result = $result +10;
    //     return $result;
    // }
    public function aroundTest(\AHT\Demo\Controller\Index\Index $subject, callable $proceed, $a=0, $b=0)
    {
       $a = 40;
       $b =10;
    //    $result = $proceed($a, $b);
        $result = $a * $b;
       return $result."hello";
    }
    // public function aroundAddProduct(
    //     \Magento\Checkout\Model\Cart $subject,
    //     \Closure $proceed,
    //     $productInfo,
    //     $requestInfo = null
    // ) {
    //     $requestInfo['qty'] = 10; // setting quantity to 10

        
    //     $result = $proceed($productInfo, $requestInfo);
    //     // change result here


    //     return $result;
    // }
}
