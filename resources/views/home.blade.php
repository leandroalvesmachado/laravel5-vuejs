@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    <painel titulo="Dashboard">
        <breadcrumb :lista="{{ $listaMigalhas }}"></breadcrumb>
        <div class="row">
            <div class="col-md-4">
                <caixa 
                    qtd="{{ $totalArtigos }}"
                    titulo="Artigos"
                    url="{{ route('artigos.index') }}"
                    cor="orange" 
                    icone="ion ion-pie-graph"
                />
            </div>
            <div class="col-md-4">
                <caixa 
                    qtd="{{ $totalUsuarios }}" 
                    titulo="Usuários"
                    url="{{ route('usuarios.index') }}"
                    cor="blue"
                    icone="ion ion-person-stalker"
                />
            </div>
            <div class="col-md-4">
                <caixa
                    qtd="{{ $totalAutores }}"
                    titulo="Autores"
                    url="{{ route('autores.index') }}"
                    url="#"
                    cor="red"
                    icone="ion ion-person"
                />
            </div>
        </div>
    </painel>
</pagina>


@endsection
