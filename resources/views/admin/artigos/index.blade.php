@extends('layouts.app')

@section('content')

<pagina tamanho="10">
    @if ($errors->all())
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" arial-label="Close"></button>
        @foreach ($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
        @endforeach
        </div>
    @endif
    <painel titulo="Lista de Artigos">
        <breadcrumb :lista="{{ $listaMigalhas }}"></breadcrumb>
        <!-- :titulos pois estou enviando um array, por padrão entende como string -->
        <tabela-lista
            :titulos="['#', 'Título', 'Descrição', 'Data']"
            :itens="{{ $listaArtigos }}"
            ordem="desc"
            ordem-col="1"
            criar="{{ route('artigos.create') }}"
            editar="#editar"
            detalhe="/admin/artigos"
            deletar="#deletar"
            token="1234"
            modal="sim"
        />
    </painel>
</pagina>

<modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{ route('artigos.store') }}" method="post" enctype="" token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value="{{ old('titulo') }}">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" value="{{ old('descricao') }}">
        </div>
        <div class="form-group">
            <label for="descricao">Conteúdo</label>
            <textarea class="form-control" name="conteudo" id="conteudo">{{ old('titulo') }}</textarea>
        </div>
        <div class="form-group">
            <label for="descricao">Data</label>
            <input type="datetime-local" class="form-control" name="data" id="data" value="{{ old('data') }}">
        </div>
    </formulario>
    <!-- slot definido no elemento -->
    <span slot="botoes">
        <!-- html5 atributo form indica qual formulario o elemento faz parte -->
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>
</modal>

<modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" action="#" method="put" enctype="multipart/form-data" token="">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" v-model="$store.state.item.titulo">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" v-model="$store.state.item.descricao">
        </div>
    </formulario>
    <!-- slot definido no elemento -->
    <span slot="botoes">
        <!-- html5 atributo form indica qual formulario o elemento faz parte -->
        <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
</modal>

<modal nome="detalhe" :titulo="$store.state.item.titulo">
    <!-- No laravel para usar uma variavel js, usar @ na blade -->
    <p> @{{ $store.state.item.descricao }}</p>
    <p> @{{ $store.state.item.conteudo }}</p>
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
