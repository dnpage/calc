<?php

namespace App;

class SpecializedCalc2 extends BaseCalc
{
    protected function deriveX($a, $b, $c)
    {
        $x = null;
        if ($a && !$b && $c) {
            $x = 's';
        } elseif ($a && $b && $c) {
            $x = 'r';
        } elseif ($a && $b && !$c) {
            $x = 't';
        }
        return $x;
    }

    protected function deriveY($x, $d, $e, $f)
    {
        switch ($x) {
            case 's':
                $y = $f + $d + ($d * $e / 100);
                break;
            case 'r':
                $y = $d + ($d * ($e - $f) / 100);
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