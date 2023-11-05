<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Brand;
use App\Models\Flight;
use App\Models\Plane;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    private $flight;
    private $totalPage = 10;


    public function __construct(Flight $flight) {
        $this->flight = $flight;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Voos disponíveis";
        $flights = $this->flight->getItems($this->totalPage);

        return view('panel.flights.index', compact('title','flights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de voo';
        $planes = Plane::pluck('id','id');
        $airports = Airport::pluck('name','id');
        $brands = Brand::pluck('name', 'id');

        return view('panel.flights.create', compact('title','planes', 'airports', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(('_token'));
        if (!$this->flight->createFlight($data)) {
            return redirect()->back()->with('error', 'Falha ao cadastrar')->withInput();
        }
        return redirect()->route('flights.index')->with('success', 'Cadastro realizado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detalhes do voo';
        $flight = $this->flight->with(['origin', 'destination'])->find($id);

        if (!$flight) {
            return redirect()->back()->with('error', 'Id não encontrado.');
        }

        return view('panel.flights.show', compact('title', 'flight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edição de voo';
        $flight = $this->flight->find($id);

        $planes = Plane::pluck('id', 'id');
        $airports = Airport::pluck('name', 'id');

        if(!$flight){
            return redirect()->back()->with('error', 'Id não encontrado.');
        }

        return view('panel.flights.edit', compact('title', 'flight', 'airports', 'planes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flight = $this->flight->find($id);
        $data = $request->except('_token');

        if (!$flight) {
            return redirect()->back()->with('error', 'Id não encontrado!');
        }

        if (!$flight->update($data)) {
            return redirect()->back()->with('error', 'Falha ao cadastrar')->withInput();
        }

        return redirect()->route('flights.index')->with('success', 'Atualização realizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = $this->flight->find($id);
        if (!$flight) {
            return redirect()->back()->with('error', 'Id não encontrado!');
        }

        $flight->delete();
        return redirect()->route('flights.index')->with('success', 'Exclusão realizada com sucesso.');
    }

    public function search(Request $request)
    {
        dd($request->all());
        // $dataForm = $request->except(['_token']);
        // $data = $request->keySearch;
        // $title = "Resultados da pesquisa para: {$data}";
        // $planes = $this->plane->search($data, $this->totalPage);

        // return view('panel.planes.index', compact('title', 'planes', 'dataForm'));
    }
}
