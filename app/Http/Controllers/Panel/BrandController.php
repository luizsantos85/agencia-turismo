<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreUpdateFormRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $brand;

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
        $title = 'Gestão de Aviões';
        $brands = $this->brand->all();

        return view('panel.brands.index',  compact('title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de novo avião';

        return view('panel.brands.create',  compact('title'));
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
        //
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

        $title = "Editar avião: {$brand->name}";

        return view('panel.brands.edit', compact('title','brand'));
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
            ->with('success', 'Avião atualizado com sucesso.');
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
        //
    }
}
