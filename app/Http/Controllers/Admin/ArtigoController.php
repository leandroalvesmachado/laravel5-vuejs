<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artigo;
use Illuminate\Support\Facades\DB;

class ArtigoController extends Controller
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
            ['titulo' => 'Lista de Artigos', 'url' => '']
        ];

        // sem paginacao
        // $listaArtigos = Artigo::select('id', 'titulo', 'descricao', 'data')->get();

        // paginacao
        // $listaArtigos = Artigo::select('id', 'titulo', 'descricao','data', 'user_id')
        // ->paginate(2);

        // foreach ($listaArtigos as $key => $value) {
        //     $value->user_id = $value->user->name;
        //     unset($value->user);
        // }

        
        $listaArtigos = Artigo::listaArtigos(3);

        return view('admin.artigos.index', [
            'listaMigalhas' => json_encode($listaMigalhas),
            'listaArtigos' => $listaArtigos
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
            'titulo' => 'required',
            'descricao' => 'required',
            'conteudo' => 'required',
            'data' => 'required'
        ]);

        if ($validacao->fails()) {
            // retorna com as mensagens de erros e campos que foram preenchidos
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        // Artigo::create($data);

        // usuario logado
        $user = auth()->user;
        // dessa forma o artigo é criado ja inserindo o relacionamento do user_id
        $user->artigos()->create($data);

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
        return Artigo::find($id);
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
        $validacao = \Validator::make($data, [
            'titulo' => 'required',
            'descricao' => 'required',
            'conteudo' => 'required',
            'data' => 'required'
        ]);

        if ($validacao->fails()) {
            // retorna com as mensagens de erros e campos que foram preenchidos
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        
        // Artigo::find($id)->update($data);

        // usuario logado
        $user = auth()->user;
        // dessa forma o artigo é criado ja inserindo o relacionamento do user_id
        $user->artigos()->find($id)->update($data);

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
        Artigo::find($id)->delete();

        return redirect()->back();
    }
}
