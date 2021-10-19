<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathsController extends Controller
{
    public function add(Request $request) {
        // Extract the parameters from the request
        // http://localhost:1234/add?x=100&y=243
        $x = $request->input('x');
        $y = $request->input('y');

        // $x = $request->y;
        // $y = $request->y;

        // $x = $request['x'];
        // $y = $request['y'];

        return $x + $y;
    }

    public function sub($x, $y)
    {
        return $x;
    }
}
