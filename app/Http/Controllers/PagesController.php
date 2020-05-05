<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to FILO!';
        //return view('pages.index', compact('title'));
        
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'welcome to laravel';

        
        return view('pages.about')->with('title', $title);
    }

}
