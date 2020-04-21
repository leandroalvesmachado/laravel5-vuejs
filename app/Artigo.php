<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo', 'descricao', 'conteudo', 'data'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // metodo static não acessa o $this
    public static function listaArtigos($paginate) 
    {
        return Artigo::select('artigos.id','artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
            ->join('users', 'users.id', 'artigos.user_id')
            ->whereNull('deleted_at')
            ->paginate($paginate);
    }

    public static function listaArtigosSite($paginate, $busca = null) 
    {
        // so utilizar para colocar o usuario na consulta
        // filtrar artigos por usuario logado
        $user = auth()->user();
        // ->where('artigos.user_id', $user->id)
        
        if ($busca) {
            return Artigo::orWhere('titulo', 'like', '%'.$busca.'%')
                ->select('artigos.id','artigos.titulo', 'artigos.descricao', 'users.name as autor', 'artigos.data')
                ->join('users', 'users.id', 'artigos.user_id')
                ->where(function($query) use ($busca) {
                    $query->orWhere('titulo', 'like', '%'.$busca.'%')
                        ->orWhere('descricao', 'like', '%'.$busca.'%');
                })
                ->whereNull('deleted_at')
                ->orderBy('artigos.data', 'DESC')
                ->paginate($paginate);
        } else {
            return Artigo::select('artigos.id','artigos.titulo', 'artigos.descricao', 'users.name as autor', 'artigos.data')
                ->join('users', 'users.id', 'artigos.user_id')
                ->whereNull('deleted_at')
                ->orderBy('artigos.data', 'DESC')
                ->paginate($paginate);
        }
    }
}
