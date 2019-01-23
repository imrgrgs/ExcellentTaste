<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $view = view('contact');

        return $view;
    }
}
