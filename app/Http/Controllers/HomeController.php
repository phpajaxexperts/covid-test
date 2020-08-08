<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Theme;

class HomeController extends Controller
{
    public function bookTest(Request $request)
    {
        $testType = $request->testType;
        Theme::set('covid');
        return view('book-test', compact('testType'));
    }

}
