<?php

namespace App\Controllers;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Slim\Views\PhpRenderer;
use App\BaseCalc as BaseCalc;
use App\SpecializedCalc1 as SpecializedCalc1;
use App\SpecializedCalc2 as SpecializedCalc2;

class HomeController
{
    private $renderer;

    public function __construct(PHPRenderer $renderer) {
        $this->renderer = $renderer;
    }

    public function index(Request $request, Response $response)
    {
        return 'Home Controller';
    }

    public function calc(Request $request, Response $response)
    {
        $input = $this->getCalcInput($request);

        if (count($input['errors']) > 0) {
            $output['errors'] = $input['errors'];
            return $response->withJson($output, 400);
        }

        $calc = new BaseCalc($input['data']);
        $output = $calc->run();

        return $response->withJson($output);
    }

    public function specializedCalc1(Request $request, Response $response)
    {
        $input = $this->getCalcInput($request);

        if (count($input['errors']) > 0) {
            $output['errors'] = $input['errors'];
            return $response->withJson($output, 400);
        }

        $calc = new SpecializedCalc1($input['data']);
        $output = $calc->run();

        return $response->withJson($output);
    }


    public function specializedCalc2(Request $request, Response $response)
    {
        $input = $this->getCalcInput($request);

        if (count($input['errors']) > 0) {
            $output['errors'] = $input['errors'];
            return $response->withJson($output, 400);
        }

        $calc = new SpecializedCalc2($input['data']);
        $output = $calc->run();

        return $response->withJson($output);
    }

    private function getCalcInput(Request $request)
    {
        $a = $request->getQueryParam('a') == 'true' ? true : false;
        $b = $request->getQueryParam('b') == 'true' ? true : false;
        $c = $request->getQueryParam('c') == 'true' ? true : false;
        $d = (int)$request->getQueryParam('d');
        $e = (int)$request->getQueryParam('e');
        $f = (int)$request->getQueryParam('f');

        $errors = [];
        if (!isset($a)) {
            $errors[] = 'a variable is missing';
        }
        if (!isset($b)) {
            $errors[] = 'b variable is missing';
        }
        if (!isset($c)) {
            $errors[] = 'c variable is missing';
        }
        if (empty($d) || !is_int($d)) {
            $errors[] = 'd variable is not an integer';
        }
        if (empty($e) || !is_int($e)) {
            $errors[] = 'e variable is not an integer';
        }
        if (empty($f) || !is_int($f)) {
            $errors[] = 'f variable is not an integer';
        }
        $input['errors'] = $errors;
        $input['data'] = compact('a', 'b', 'c', 'd', 'e', 'f');

        return $input;
    }


}