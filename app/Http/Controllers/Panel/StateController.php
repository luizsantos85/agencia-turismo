<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $state;

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

    public function search()
    {
        
    }
}
