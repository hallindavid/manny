<?php

require_once 'vendor/autoload.php';

use Manny\Manny;
use PHPUnit\Framework\TestCase;

class MaskTest extends TestCase
{
    public function test_ssn()
    {
        $target = '123456789';
        $config = '111-11-1111';
        $good = '123-45-6789';

        $this->assertEquals(Manny::mask($target, $config), $good);
    }

    public function test_canadian_postal_code()
    {
        $target = 'K1M1M4';
        $config = 'A1A 1A1';
        $good = 'K1M 1M4';

        $this->assertEquals(Manny::mask($target, $config), $good);
    }

    public function test_phone_mask()
    {
        $target = '8008008000';
        $config = '(111) 111-1111';
        $good = '(800) 800-8000';

        $this->assertEquals(Manny::mask($target, $config), $good);
    }


    public function test_blank_entry_with_phone_formatting_mask()
    {
        $target = '';
        $config = '(111) 111-1111';
        $good = '';

        $this->assertEquals(Manny::mask($target, $config), $good);
    }
}
