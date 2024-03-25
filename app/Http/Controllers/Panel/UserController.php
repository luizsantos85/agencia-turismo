<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;
    protected $totalPage = 10;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Gestão de Usuários';

        $users = $this->user->paginate($this->totalPage);

        return view('panel.users.index',  compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de novo usuário';
        return view('panel.users.create',  compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        if ($this->user->newUser($request))
            return redirect()->route('users.index')
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
        $user = $this->user->find($id);

        if (!$user)
            return redirect()->back()->with('error', 'Id não encontrado.');

        $title = "Detalhes do usuário";

        return view('panel.users.show', compact('title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        if (!$user)
            return redirect()->back()->with('error', 'Id não encontrado.');

        $title = "Editar usuário";

        return view('panel.users.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        $user = $this->user->find($id);

        if (!$user)
            return redirect()->back()->with('error', 'Id não encontrado.');

        $update = $user->updateUser($request);

        if ($update)
            return redirect()->route('users.index')
                ->with('success', 'Usuário atualizado com sucesso.');
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
        $user = $this->user->find($id);

        if (!$user)
            return redirect()
                ->back()
                ->with('error', 'Id não encontrado.');

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário deletado com sucesso.');
    }

    /**
     * Search item
     *
     * @param string $data
     * @return View
     */
    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        $users = $this->user->search($request->name, $this->totalPage);
        $title = "Buscou filtro para: {$request->name}";

        return view('panel.users.index',  compact('title', 'users', 'dataForm'));
    }
}
