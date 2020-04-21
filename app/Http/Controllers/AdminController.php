<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Artigo;

class AdminController extends Controller
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
            ['titulo' => 'Admin', 'url' => ''],
        ];

        $totalUsuarios = User::count();
        $totalAutores = User::where('autor', 'S')->count();
        $totalArtigos = Artigo::count();
        $totalAdms = User::where('admin', 'S')->count();

        return view('admin', [
            'listaMigalhas' => json_encode($listaMigalhas),
            'totalUsuarios' => $totalUsuarios,
            'totalAutores' => $totalAutores,
            'totalArtigos' => $totalArtigos,
            'totalAdms' => $totalAdms
        ]);
    }
}
