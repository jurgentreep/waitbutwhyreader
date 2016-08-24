<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \stdClass;

class HomeController extends Controller
{
    public function index()
    {
        $article = new stdClass();
        $article->title = 'Wait But Why';
        return view('welcome', compact('article'));
    }
}
