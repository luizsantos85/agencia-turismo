<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreUpdateFormRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $brand;
    protected $totalPage = 10;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Gestão de Companhias Aéreas';

        $brands = $this->brand->paginate($this->totalPage);

        return view('panel.brands.index',  compact('title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de nova marca';
        return view('panel.brands.create-edit',  compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();

        if ($this->brand->create($dataForm))
            return redirect()->route('brands.index')
                ->with('success', 'Cadastro realizado com sucesso.');
        else
            return redirect()->back()
                ->with('error', 'Falha ao cadastrar.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->brand->find($id);

        if (!$brand)
            return redirect()->back()->with('error', 'Id não encontrado.');

        $title = "Detalhes da marca: {$brand->name}";

        return view('panel.brands.show', compact('title', 'brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brand->find($id);

        if(!$brand)
            return redirect()->back()->with('error', 'Id não encontrado.');

        $title = "Editar marca: {$brand->name}";

        return view('panel.brands.create-edit', compact('title','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandStoreUpdateFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $brand = $this->brand->find($id);

        if (!$brand)
            return redirect()->back()->with('error', 'Id não encontrado.');

        if ($brand->update($dataForm))
            return redirect()->route('brands.index')
                ->with('success', 'Marca atualizada com sucesso.');
        else
            return redirect()->back()
                ->with('error', 'Falha ao editar.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brand->find($id);

        if (!$brand)
            return redirect()->back()->with('error', 'Id não encontrado.');

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Marca deletada com sucesso.');
    }

    /**
     * Search item
     *
     * @param string $data
     * @return Response
     */
    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        $brands = $this->brand->search($request->name, $this->totalPage);
        $title = "Buscou filtro para: {$request->name}";

        return view('panel.brands.index',  compact('title', 'brands', 'dataForm'));
    }
}
