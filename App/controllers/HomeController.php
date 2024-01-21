<?php

namespace App\controllers;

use App\App;

class HomeController
{
    public static function index()
    {
        return (new App)->view('home', ['title'=>'Home']);
    }
}
