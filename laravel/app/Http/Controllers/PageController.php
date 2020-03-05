<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Index management
class PageController extends Controller
{
    public function homePage()
    {
        return view('pages.index');
    }
}
