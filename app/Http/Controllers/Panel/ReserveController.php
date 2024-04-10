<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Models\User;

class ReserveController extends Controller
{
    private $reserve;
    protected $totalPage = 15;

    public function __construct(Reserve $reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Reservas de passagens aéreas';

        $reserves = $this->reserve->with(['user', 'flight.destination'])->paginate($this->totalPage);
        $status = $this->reserve->status();

        return view('panel.reserves.index',  compact('title', 'reserves','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de reservas de passagens';

        $users = User::pluck('name', 'id');
        $flights = Flight::with('destination')->get();
        $status = $this->reserve->status();

        return view('panel.reserves.create',  compact('title', 'users', 'flights', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();

        if($this->reserve->create($dataForm)){
            return redirect()
                ->route('reserves.index')
                ->with('success','Reserva criada com sucesso.');
        } else{
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Falha ao cadastrar.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\View
     */
    public function edit($id)
    {
        $title = 'Edição de reservas de passagens';
        $reserve = $this->reserve->with(['user', 'flight.destination'])->where('id',$id)->first();

        $user = $reserve->user;
        $flight = $reserve->flight;

        $status = $this->reserve->status();

        return view('panel.reserves.edit',  compact('title', 'reserve', 'status','user','flight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\View
     */
    public function update(Request $request, $id)
    {
        $reserve = $this->reserve->find($id);

        if ($reserve->changeStatus($request->status)) {
            return redirect()
                ->route('reserves.index')
                ->with('success', 'Status alterado com sucesso.');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Falha ao editar.');
        }
    }


    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        $reserves = $this->reserve->search($dataForm, $this->totalPage);
        $status = $this->reserve->status();

        // Mapear os valores dos campos de pesquisa para retornar no titulo
        $serchValues = array_map(function ($key, $value) use ($dataForm) {
            if ($key == 'date_flight' && !empty($dataForm['date_flight'])) {
                $value = date('d/m/Y', strtotime($value));
            }
            return $value ? "{$value}" : null;
        }, array_keys($dataForm), $dataForm);
        // Filtrar valores não nulos
        $filteredValues = array_filter($serchValues);
        // Concatenar os valores dos campos em uma string
        $searchString = implode(', ', $filteredValues);
        $title = "Resultados da pesquisa para: {$searchString}";

        return view('panel.reserves.index',  compact('title', 'reserves', 'dataForm','status'));
    }
}
