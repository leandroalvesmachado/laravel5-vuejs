@extends('layouts.app')

@section('content')

<pagina tamanho="12">
    <painel titulo="Artigos">
        <p>
            <form class="form-inline text-center" action="{{ route('site') }}" method="get">
                <input type="search" class="form-controll" name="busca" placeholder="Buscar" value="{{ isset($busca) ? $busca : '' }}">
                <button class="btn btn-info">Buscar</button>
            </form>
        </p>
        <div class="row">
            @forelse ($lista as $key => $value)
            <artigo-card
                titulo="{{ str_limit($value->titulo, 40, "...") }}"
                descricao="{{ str_limit($value->descricao, 5, "...") }}"
                link="{{ route('artigo', [$value->id, str_slug($value->titulo)]) }}"
                imagem=""
                data="{{ $value->data }}"
                autor="{{ $value->autor }}"
                sm="6"
                md="4"
            >
            </artigo-card>
            @empty
            @endforelse
        </div>
        <div align="center">
            {{ $lista->links() }}
        </div>
    </painel>
</pagina>


@endsection
