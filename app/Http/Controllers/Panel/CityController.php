<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $totalPage = 10;

    public function index($initials)
    {

        $title = "Cidades";
        $state = State::where('initials',$initials)->first()->load('cities');

        if(!$state) return redirect()->back();

        $cities = $state->cities()->paginate($this->totalPage);

        return view('panel.cities.index',compact('state','cities'));
    }

    public function search(Request $request, $initials)
    {
        // $dataForm = $request->except('_token');
        $state = State::where('initials', $initials)->first();
        if (!$state) return redirect()->back();

        $dataForm = $request->except('_token');
        $keySearch = $request->keySearch;

        $cities = $state->citiesSearch($keySearch, $this->totalPage);

        $title = "Resultado da pesquisa para: {$request->keySearch}";

        return view('panel.cities.index',  compact('title', 'cities','state','dataForm'));
    }
}
