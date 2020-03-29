<?php

require_once 'vendor/autoload.php';

use Manny\Manny;
use PHPUnit\Framework\TestCase;

class YoinkTest extends TestCase
{
    public function test_yoink_posted_example()
    {
        $postedArray = [
            'name' => 'John Doe',
            'email'=> 'jdoe@gmail.com',
            'id'   => '17',
        ];
        $keys = ['name', 'email'];

        $goodResult = [
            'name' => 'John Doe',
            'email'=> 'jdoe@gmail.com',
        ];

        $this->assertEquals(Manny::yoink($postedArray, $keys), $goodResult);
    }

    public function test_yoink_posted_example_set_defaults()
    {
        $postedArray = [
            'name'=> 'John Doe',
            'id'  => '17',
        ];
        $keys = ['name', 'email'];
        $defaults = [
            'name' => '',
            'email'=> 'jdoe@gmail.com',
        ];

        $goodResult = [
            'name' => 'John Doe',
            'email'=> 'jdoe@gmail.com',
        ];

        $this->assertEquals(Manny::yoink($postedArray, $keys, $defaults), $goodResult);
    }
}
