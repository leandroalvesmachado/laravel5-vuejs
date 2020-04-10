@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    <painel titulo="Lista de Artigos">
        <!-- :titulos pois estou enviando um array, por padrão entende como string -->
        <tabela-lista
            :titulos="['#', 'Título', 'Descrição']"
            :itens="[[1, 'PHP OO', 'Curso de PHP'],[2, 'Vue JS', 'Curso de Vue']]"
            ordem="desc"
            ordem-col="1"
            criar="{{ route('artigos.create') }}"
            editar="#editar"
            detalhe="#detalhe"
            deletar="#deletar"
            token="1234"
        />
    </painel>
</pagina>

@endsection
