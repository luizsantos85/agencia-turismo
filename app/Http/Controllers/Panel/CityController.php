<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index($initials)
    {

        $title = "Cidades";
        $state = State::where('initials',$initials)->first();
        $cities = $state->cities;

        return view('panel.cities.index',compact('state','cities'));
    }
}
