<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        echo <<<EOF
        \$this->middleware('auth');

        \$this->middleware('log')->only('index');

        \$this->middleware('subscribed')->except('store');
        EOF;
    }*/

    /**
     * The user repository instance.
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        echo 'user index.';
    }

}
