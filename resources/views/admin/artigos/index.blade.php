@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    <painel titulo="Lista de Artigos">
        <breadcrumb :lista="{{ $listaMigalhas }}"></breadcrumb>
        <!-- :titulos pois estou enviando um array, por padrão entende como string -->
        <tabela-lista
            :titulos="['#', 'Título', 'Descrição']"
            :itens="{{ $listaArtigos }}"
            ordem="desc"
            ordem-col="1"
            criar="{{ route('artigos.create') }}"
            editar="#editar"
            detalhe="#detalhe"
            deletar="#deletar"
            token="1234"
            modal="sim"
        />
    </painel>
</pagina>

<modal nome="adicionar">
    <painel titulo="Adicionar">
        <formulario css="" action="#" method="post" enctype="" token="">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição">
            </div>
            <button class="btn btn-info">Adicionar</button>
        </formulario>
    </painel>
</modal>

<modal nome="editar">
    <painel titulo="Editar">
        <formulario css="" action="#" method="post" enctype="" token="">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição">
            </div>
            <button class="btn btn-info">Atualizar</button>
        </formulario>
    </painel>
</modal>

<modal nome="deletar">
    <painel titulo="Deletar">
        <formulario css="" action="#" method="post" enctype="" token="">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição">
            </div>
            <button class="btn btn-info">Deletar</button>
        </formulario>
    </painel>
</modal>


@endsection
