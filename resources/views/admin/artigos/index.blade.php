@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    <painel titulo="Lista de Artigos">
        <!-- :titulos pois estou enviando um array, por padrão entende como string -->
        <tabela-lista
            :titulos="['#', 'Título', 'Descrição']"
            :itens="[[1, 'PHP', 's'],[2, 'PHP', 's']]"
            criar="{{ route('artigos.create') }}"
            editar="#editar"
            detalhe="#detalhe"
            deletar="#deletar"
            token="1234"
        />
    </painel>
</pagina>

@endsection
