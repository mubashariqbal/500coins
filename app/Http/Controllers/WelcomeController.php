<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function __invoke()
    {
        $data = [];
        return view('welcome', $data);
    }

}
