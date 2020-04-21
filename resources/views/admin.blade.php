@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    <painel titulo="Dashboard">
        <breadcrumb :lista="{{ $listaMigalhas }}"></breadcrumb>
        <div class="row">
            @can('isAutor')
            <div class="col-md-4">
                <caixa 
                    qtd="{{ $totalArtigos }}"
                    titulo="Artigos"
                    url="{{ route('artigos.index') }}"
                    cor="orange" 
                    icone="ion ion-pie-graph"
                />
            </div>
            @endcan
            @can('isAdmin')
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
            <div class="col-md-4">
                <caixa
                    qtd="{{ $totalAdms }}"
                    titulo="Adms"
                    url="{{ route('adms.index') }}"
                    url="#"
                    cor="green"
                    icone="ion ion-person"
                />
            </div>
            @endcan
        </div>
    </painel>
</pagina>


@endsection
