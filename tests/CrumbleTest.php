<?php

require_once 'vendor/autoload.php';

use Manny\Manny;
use PHPUnit\Framework\TestCase;

class CrumbleTest extends TestCase
{
    public function test_the_crumbler()
    {
        $target = '18008008000888';
        $config = [1, 3, 3, 4];
        $param = true;
        $good = ['1', '800', '800', '8000', '888'];

        $this->assertEquals(Manny::crumble($target, $config, $param), $good);
    }
}
