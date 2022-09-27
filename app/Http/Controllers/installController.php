<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class installController extends Controller
{
    public function artisanCommand()
    {
        $exitCode = \Artisan::call('migrate');
        return $exitCode;
    }
}
