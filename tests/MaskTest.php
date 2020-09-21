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

    public function test_partial_canadian_postal_code()
    {
        $target = 'KM';
        $config = 'A1A 1A1';
        $good = 'K';

        $this->assertEquals($good, Manny::mask($target, $config));
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

    public function test_partial_phone_mask()
    {
        //This one is important if someone is doing a phone mask and wants to have an optional extension
        // Eg. user enters 111-111-1111 and the mask is 111-111-1111 ext. 1111 - if you enter in 111-111-1111 it should return with that.

        $target = '111 111';
        $config = '111-111-1111';
        $good = '111-111';

        $this->assertEquals(Manny::mask($target, $config), $good);
    }
}
