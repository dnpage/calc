<?php

namespace App\Tests;

use App\SpecializedCalc2 as SpecializedCalc2;

class SpecializedCalc2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $data
     * @param $x
     * @param $y
     * @param $status
     *
     * @dataProvider inputProvider
     */
    public function testSpecializedCalc2($data, $x, $y, $status)
    {
        $calc = new SpecializedCalc2($data);
        $results = $calc->run();

        $this->assertEquals($x, $results['x']);
        $this->assertEquals($y, $results['y']);
        $this->assertEquals($status, $results['status']);
    }

    public function inputProvider()
    {
        return [
            [['a' => false, 'b' => false, 'c' => false, 'd' => 2, 'e' => 3, 'f' => 4], null, null, 'error'],
            [['a' => false, 'b' => false, 'c' => true,  'd' => 2, 'e' => 3, 'f' => 4], null, null, 'error'],
            [['a' => false, 'b' => true,  'c' => false, 'd' => 2, 'e' => 3, 'f' => 4], null, null, 'error'],
            [['a' => false, 'b' => true,  'c' => true,  'd' => 2, 'e' => 3, 'f' => 4], null, null, 'error'],
            [['a' => true,  'b' => false, 'c' => false, 'd' => 2, 'e' => 3, 'f' => 4], null, null, 'error'],
            [['a' => true,  'b' => false, 'c' => true,  'd' => 2, 'e' => 3, 'f' => 4], 's',  6.06, 'success'],
            [['a' => true,  'b' => true,  'c' => false, 'd' => 2, 'e' => 3, 'f' => 4], 't',  1.92, 'success'],
            [['a' => true,  'b' => true,  'c' => true,  'd' => 2, 'e' => 3, 'f' => 4], 'r',  1.98, 'success']
        ];
    }

}