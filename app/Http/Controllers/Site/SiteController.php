<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $title = "Agência de Turismo";
        return view('site.home.index',compact('title'));
    }

    public function promotions()
    {
        $title = "Promoções";
        return view('site.promotions.list',compact('title'));
    }
}
