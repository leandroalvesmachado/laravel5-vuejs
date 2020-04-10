@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    <painel titulo="Dashboard">
        <breadcrumb :lista="{{ $listaMigalhas }}"></breadcrumb>
        <div class="row">
            <div class="col-md-4">
                <caixa 
                    qtd="80" 
                    titulo="Artigos" 
                    url="{{ route('artigos.index') }}" 
                    cor="orange" 
                    icone="ion ion-pie-graph"
                />
            </div>
            <div class="col-md-4">
                <caixa 
                    qtd="1500" 
                    titulo="Usuários"
                    url="#"
                    cor="blue"
                    icone="ion ion-person-stalker"
                />
            </div>
            <div class="col-md-4">
                <caixa
                    qtd="3" 
                    titulo="Autores"
                    url="#"
                    cor="red"
                    icone="ion ion-person"
                />
            </div>
        </div>
    </painel>
</pagina>


@endsection
