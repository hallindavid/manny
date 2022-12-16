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

    public function test_stripper_4()
    {
        $target = 'item:1|item:2|item:3 |item:4';
        $config = ['alpha', 'num', 'pipe'];
        $good = 'item1|item2|item3|item4';

        $this->assertEquals(Manny::stripper($target, $config), $good);
    }

    public function test_stripper_5()
    {
        $target = '..*public function test_stripper_5(),: void {}';
        $config = ['alpha', 'num', 'space','underscore', 'parenthesis', 'curly', 'colon'];
        $good = 'public function test_stripper_5(): void {}';

        $this->assertEquals(Manny::stripper($target, $config), $good);
    }

    public function test_stripper_6()
    {
        $target = '[Link59392030](link.com)';
        $config = ['alpha', 'dot', 'parenthesis', 'bracket'];
        $good = '[Link](link.com)';

        $this->assertEquals(Manny::stripper($target, $config), $good);
    }

    public function test_static_alias_keep_for_stripper()
    {
        $target = 'This is a test, keep only the alpha characters!';
        $config = ['alpha'];
        $good = 'Thisisatestkeeponlythealphacharacters';

        $this->assertEquals(Manny::keep($target, $config), $good);
    }

    public function test_it_still_works_if_you_forget_to_add_options()
    {
        $target = '#$This is a test, keep __only the alpha &^characters!';
        $good = 'This is a test, keep only the alpha characters';

        $this->assertEquals(Manny::keep($target), $good);
    }
}
