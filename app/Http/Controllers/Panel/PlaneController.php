<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaneStoreUpdateFormRequest;
use App\Models\Brand;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    private $plane;
    protected $totalPage = 10;


    public function __construct(Plane $plane)
    {
        $this->plane = $plane;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de aviões';
        $planes = $this->plane->with('brand')->paginate($this->totalPage);

        return view('panel.planes.index', compact('title', 'planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de avião';

        $brands = Brand::pluck('name','id');

        $classes_planes = $this->plane->classes_planes();

        return view('panel.planes.create', compact('title', 'classes_planes', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaneStoreUpdateFormRequest $request)
    {
        $data = $request->except('_token');
        if(!$this->plane->create($data)){
            return redirect()->back()->with('error','Falha ao cadastrar')->withInput();
        }
        return redirect()->route('planes.index')->with('success','Cadastro realizado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detalhes do avião';
        $plane = $this->plane->find($id);

        return view();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Editar de avião';
        $plane = $this->plane->find($id);
        $brands = Brand::pluck('name', 'id');

        $classes_planes = $this->plane->classes_planes();

        if(!$plane){
            return redirect()->back()->with('error', 'Id não encontrado!');
        }

        return view('panel.planes.edit', compact('plane','title','brands','classes_planes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaneStoreUpdateFormRequest $request, $id)
    {
        $plane = $this->plane->find($id);
        $data = $request->except('_token');

        if (!$plane) {
            return redirect()->back()->with('error', 'Id não encontrado!');
        }

        if (!$plane->update($data)) {
            return redirect()->back()->with('error', 'Falha ao cadastrar')->withInput();
        }

        return redirect()->route('planes.index')->with('success', 'Atualização realizada com sucesso.');
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

    public function search(Request $request)
    {
        $dataForm = $request->except(['_token']);
        $data = $request->keySearch;
        $title = "Resultados da pesquisa para : {$data}";
        $planes = $this->plane->search($data, $this->totalPage);

        return view('panel.planes.index', compact('title', 'planes', 'dataForm'));
    }
}
