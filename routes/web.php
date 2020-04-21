<?php

use App\Artigo;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $req) {
    if (isset($req->busca) && $req->busca != '') {
        $busca = $req->busca;
        $lista = Artigo::listaArtigosSite(3, $busca);
    } else {
        $lista = Artigo::listaArtigosSite(3);
        $busca = "";
    }

    return view('site', [
        'lista' => $lista,
        'busca' => $busca
    ]);
})->name('site');

Route::get('/artigo/{id}/{titulo?}', function ($id) {
    $artigo = Artigo::find($id);

    if ($artigo) {
        return view('artigo', [
            'artigo' => $artigo
        ]);
    }

    return redirect()->route('site');
})->name('artigo');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('can:isAutor');

// Route::group(['prefix' => 'admin'], function() {
// });

Route::middleware('auth')->prefix('admin')->namespace('Admin')->group(function() {
    // Actions Handled By Resource Controller
    // Verb	        URI	                    Action	Route Name
    // GET	        /photos	                index	photos.index
    // GET	        /photos/create	        create	photos.create
    // POST	        /photos	                store	photos.store
    // GET	        /photos/{photo}	        show	photos.show
    // GET	        /photos/{photo}/edit	edit	photos.edit
    // PUT/PATCH	/photos/{photo}	        update	photos.update
    // DELETE	    /photos/{photo}	        destroy	photos.destroy
    Route::resource('artigos', 'ArtigoController')->middleware('can:isAutor');
    Route::resource('usuarios', 'UsuarioController')->middleware('can:isAdmin');
    Route::resource('autores', 'AutorController')->middleware('can:isAdmin');
    Route::resource('adms', 'AdminController')->middleware('can:isAdmin');
});
