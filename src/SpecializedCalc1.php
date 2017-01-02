<?php

namespace App;

class SpecializedCalc1 extends BaseCalc
{
    protected function deriveY($x, $d, $e, $f)
    {
        switch ($x) {
            case 's':
                $y = $d + ($d * $e / 100);
                break;
            case 'r':
                $y = 2 * $d + ($d * $e / 100);
                break;
            case 't':
                $y = $d - ($d * $f / 100);
                break;
            default:
                $y = null;
                break;
        }
        return $y;
    }
}
