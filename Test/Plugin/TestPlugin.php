<?php
namespace AHT\Test\Plugin;

class TestPlugin
{
    public function beforeTest(\AHT\Test\Controller\Index\Index $subject, $a=0, $b=0)
    {
        $a = 10;
        $b = 10;
        return [$a, $b];
    }
}
