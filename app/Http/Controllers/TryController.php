<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TryController extends Controller
{

    public function try1()
    {
        // Generating URLs...
        $url = route('profile', ['id'=>991]);

        // Generating Redirects...
        return redirect()->route('profile',
                        ['id'=>999]);

    }
}
