<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFlightFormRequest;
use App\Models\Airport;
use App\Models\Brand;
use App\Models\Flight;
use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $airports = Airport::pluck('name','id');

        return view('panel.flights.index', compact('title','flights','airports'));
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
    public function store(StoreUpdateFlightFormRequest $request)
    {
        $data = $request->except(('_token'));

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $fileName = uniqid(date('HisYmd'));
            $ext = $request->image->extension();
            $newFileName = "{$fileName}.{$ext}";

            if(!$request->file('image')->storeAs('flights', $newFileName)){
                return redirect()->back()
                    ->with('error', 'Falha no upload')
                    ->withInput();
            }

            $data['image'] = $newFileName;
        }

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
    public function update(StoreUpdateFlightFormRequest $request, $id)
    {
        $flight = $this->flight->find($id);
        $data = $request->except('_token');

        if (!$flight) {
            return redirect()->back()->with('error', 'Id não encontrado!');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if($flight->image){
                if (Storage::exists("flights/{$flight->image}")) {
                    Storage::delete("flights/{$flight->image}");
                }
            }

            $fileName = uniqid(date('HisYmd'));
            $ext = $request->image->extension();
            $newFileName = "{$fileName}.{$ext}";

            if (!$request->file('image')->storeAs('flights', $newFileName)) {
                return redirect()->back()
                    ->with('error', 'Falha no upload')
                    ->withInput();
            }

            $data['image'] = $newFileName;
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
        $dataForm = $request->except(['_token']);
        $flights = $this->flight->search($request, $this->totalPage);
        $airports = Airport::pluck('name', 'id');

        // Mapear os valores dos campos de pesquisa
        $serchValues = array_map(function($key,$value) use($airports, $request){
            if($key == 'date' && !empty($request->date)){
                $value = date('d/m/Y',strtotime($value));
            }
            if($key == 'origin' || $key == 'destination'){
                $airportName = $airports[$value] ?? null;
                $value = $airportName ? $airportName : null;
            }

            return $value ? "{$value}" : null;
        }, array_keys($dataForm), $dataForm);

        // Filtrar valores não nulos
        $filteredValues = array_filter($serchValues);
        // Concatenar os valores dos campos em uma string
        $searchString = implode(', ', $filteredValues);

        $title = "Resultados da pesquisa para: {$searchString}";


        return view('panel.flights.index', compact('title', 'flights', 'dataForm',  'airports'));
    }
}
