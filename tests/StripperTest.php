<?php

require_once 'vendor/autoload.php';

use Manny\Manny;
use PHPUnit\Framework\TestCase;

class StripperTest extends TestCase
{
    public function test_stripper_1()
    {
        $target = 'With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!';
        $config = ['num', 'alpha', 'space'];
        $good = 'With only 510 hours of development Dave built Manny saving him atleast 10 seconds per day';

        $this->assertEquals(Manny::stripper($target, $config), $good);
    }

    public function test_stripper_2()
    {
        $target = 'With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!';
        $config = ['num'];
        $good = '51010';

        $this->assertEquals(Manny::stripper($target, $config), $good);
    }

    public function test_stripper_3()
    {
        $target = 'invoice: AQ&*(*&(* 12345';
        $config = ['alpha', 'num', 'colon'];
        $good = 'invoice:AQ12345';

        $this->assertEquals(Manny::stripper($target, $config), $good);
    }
}
