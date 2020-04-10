<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            ['titulo' => 'Home', 'url' => route('home')],
            ['titulo' => 'Lista de Artigos', 'url' => '']
        ];

        $listaArtigos = [
            ['id' => 1, 'titulo' => 'PHP OO', 'descricao' => 'Curso de PHP OO'],
            ['id' => 2, 'titulo' => 'Vue JS', 'descricao' => 'Curso de Vue JS']
        ];

        return view('admin.artigos.index', [
            'listaMigalhas' => json_encode($listaMigalhas),
            'listaArtigos' => json_encode($listaArtigos)
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
        //
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
        //
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
