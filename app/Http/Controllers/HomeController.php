<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Artigo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = [
            ['titulo' => 'Home', 'url' => route('home')]
        ];

        $totalUsuarios = User::count();
        $totalAutores = User::where('autor', 'S')->count();
        $totalArtigos = Artigo::count();

        return view('home', [
            'listaMigalhas' => json_encode($listaMigalhas),
            'totalUsuarios' => $totalUsuarios,
            'totalAutores' => $totalAutores,
            'totalArtigos' => $totalArtigos
        ]);
    }
}
