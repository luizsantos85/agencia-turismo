<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $state;
    private $totalPage = 10;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function index()
    {
        $title = 'Estados Brasileiros';
        $states = $this->state->get();

        return view('panel.states.index',compact('title','states'));
    }

    public function search(Request $request)
    {
        // $dataForm = $request->except('_token');
        $states = $this->state->search($request->keySearch, $this->totalPage);
        $title = "Resultado da pesquisa para: {$request->keySearch}";

        return view('panel.states.index',  compact('title', 'states'));
    }
}
