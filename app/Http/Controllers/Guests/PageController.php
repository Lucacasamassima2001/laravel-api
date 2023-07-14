<?php

namespace App\Http\Controllers\Guests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Guests\PageController;

class PageController extends Controller
{
    public function home(){
        return view('Guests/home');
    }
}
