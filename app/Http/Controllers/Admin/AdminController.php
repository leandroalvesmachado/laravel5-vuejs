<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // js nao usar o array do php, converte pra json
        $listaMigalhas = [
            ['titulo' => 'Admin', 'url' => route('admin')],
            ['titulo' => 'Lista de Admns', 'url' => '']
        ];

        // paginacao
        $listaModelo = User::select('id', 'name', 'email')->where('admin', 'S')->paginate(2);

        return view('admin.adms.index', [
            'listaMigalhas' => json_encode($listaMigalhas),
            'listaModelo' => $listaModelo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $validacao = \Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($validacao->fails()) {
            // retorna com as mensagens de erros e campos que foram preenchidos
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $request->all();

        if (isset($data['password']) && $data['password'] != "") {
            $validacao = \Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,id,'.$id,
                'password' => 'required|string|min:6'
            ]);

            $data['password'] = bcrypt($data['password']);
        } else {
            $validacao = \Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,id,'.$id
            ]);

            unset($data['password']);
        }

        if ($validacao->fails()) {
            // retorna com as mensagens de erros e campos que foram preenchidos
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        
        User::find($id)->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }
}
