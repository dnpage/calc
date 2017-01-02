<?php

namespace App;

class BaseCalc
{
    protected $a;
    protected $b;
    protected $c;
    protected $d;
    protected $e;
    protected $f;
    protected $calc_status;


    public function __construct($input_data)
    {
        $this->a = $input_data['a'];
        $this->b = $input_data['b'];
        $this->c = $input_data['c'];
        $this->d = $input_data['d'];
        $this->e = $input_data['e'];
        $this->f = $input_data['f'];
    }

    public function run()
    {
        $x = $this->deriveX($this->a, $this->b, $this->c);
        $y = $this->deriveY($x, $this->d, $this->e, $this->f);

        $answer['a'] = $this->a;
        $answer['b'] = $this->b;
        $answer['c'] = $this->c;
        $answer['d'] = $this->d;
        $answer['e'] = $this->e;
        $answer['f'] = $this->f;
        $answer['x'] = $x;
        $answer['y'] = $y;
        $answer['status'] = $this->getCalcStatus($x);

        return $answer;
    }

    protected function deriveX($a, $b, $c)
    {
        $x = null;
        if ($a && $b && !$c) {
            $x = 's';
        } elseif ($a && $b && $c) {
            $x = 'r';
        } elseif (!$a && $b && $c) {
            $x = 't';
        }
        return $x;
    }

    protected function deriveY($x, $d, $e, $f)
    {
        switch ($x) {
            case 's':
                $y = $d + ($d * $e / 100);
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

    protected function getCalcStatus($x)
    {
        return is_null($x) ? 'error' : 'success';
    }
}