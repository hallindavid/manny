<?php

require_once 'vendor/autoload.php';

use Manny\Manny;
use PHPUnit\Framework\TestCase;

class PhoneHelperTest extends TestCase
{
    public function test_blank_string()
    {
        $this->assertEquals(Manny::phone(''), '');
    }

    public function test_1_char()
    {
        $this->assertEquals(Manny::phone('8'), '8');
    }

    public function test_4_char()
    {
        $this->assertEquals(Manny::phone('8008'), '800-8');
    }

    public function test_full()
    {
        $this->assertEquals(Manny::phone('8008008000'), '800-800-8000');
    }

    public function test_overflow()
    {
        $this->assertEquals(Manny::phone('8008008000123456'), '800-800-8000');
    }

    public function test_invalid()
    {
        $this->assertEquals(Manny::phone('Where in the World Is Carmen Sandiego?'), '');
    }

    public function test_custom_options()
    {
        $this->assertEquals(Manny::phone('800800800012', [
            'showCountryCode'         => true,
            'showAreaCode'            => false,
            'showExchange'            => true,
            'showLine'                => false,
            'showExtension'           => true,
            'prefix'                  => '-',
            'country_area_delimiter'  => '+',
            'area_exchange_delimiter' => 'T',
            'exchange_line_delimiter' => 'Q',
            'line_extension_delimiter'=> ' xt. ',
        ]), '-1T800 xt. 12');
    }
}
