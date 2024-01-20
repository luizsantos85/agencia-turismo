<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\City;

class AirportController extends Controller
{
    private $airport, $city, $totalPage = 10;

    public function __construct(City $city, Airport $airport)
    {
        $this->city = $city;
        $this->airport = $airport;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cityId)
    {
        $city = $this->city->find($cityId);
        if (!$city) return redirect()->back();

        $title = "Aeroportos da cidade de {$city->name}";

        $airports = $city->airports()->paginate($this->totalPage);

        return view('panel.airports.index', compact('city', 'title', 'airports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cityId)
    {
        $city = $this->city->find($cityId);
        if (!$city) return redirect()->back();

        $title = "Cadastro de aeroporto na cidade de {$city->name}";

        $airports = $city->airports()->paginate($this->totalPage);

        return view('panel.airports.create', compact('city', 'title', 'airports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = $this->city->find($request->city_id);
        if(!$city){
            return redirect()->back()
                ->with('error', 'Cidade não encontrada.')
                ->withInput();
        }

        if ($this->airport->create($request->all())) {
            return redirect()->route('airports.index',$request->city_id)
                    ->with('success', 'Aeroporto cadastrado com sucesso.');
        }

        return redirect()->back()->with('error', 'Falha ao cadastrar.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cityId, $airportId
     * @return \Illuminate\Http\Response
     */
    public function edit($cityId,$airportId)
    {
        $airport = $this->airport->with('city')->findOrFail($airportId);
        $city = $airport->city;

        if(!$airport) return redirect()->back()->with('error','Aeroporto não encontrado.');

        $title = "Edição do {$airport->name}";

        return view('panel.airports.edit', compact('city', 'title', 'airport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCity, $idAirport)
    {
        $airport = $this->airport->find($idAirport);

        if (!$airport) {
            return redirect()->back()
                ->with('error', 'Aeroporto não encontrado.')
                ->withInput();
        }

        if ($airport->update($request->all())) {
            return redirect()->route('airports.index', $request->city_id)
                ->with('success', 'Aeroporto atualizado com sucesso.');
        }

        return redirect()->back()->with('error', 'Falha ao atualizar.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
