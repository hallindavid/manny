<?php

require_once 'vendor/autoload.php';

use Manny\Manny;
use PHPUnit\Framework\TestCase;

class PercentTest extends TestCase
{
    public function test_invalid()
    {
        $this->assertEquals(Manny::percent('hello', 'world'), 100);
    }

    public function test_normal()
    {
        $this->assertEquals(Manny::percent(1, '8', 1), '12.5');
    }
}
