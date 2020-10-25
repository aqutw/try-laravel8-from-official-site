<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        echo <<<EOF
        \$this->middleware('auth');

        \$this->middleware('log')->only('index');

        \$this->middleware('subscribed')->except('store');
        EOF;
    }

    public function index()
    {
        echo 'user index.';
    }

}
