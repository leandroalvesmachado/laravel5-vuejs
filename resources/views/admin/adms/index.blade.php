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
    <painel titulo="Lista de Adms">
        <breadcrumb :lista="{{ $listaMigalhas }}"></breadcrumb>
        <!-- :titulos pois estou enviando um array, por padrão entende como string -->
        <tabela-lista
            :titulos="['#', 'Nome', 'E-mail']"
            :itens="{{ json_encode($listaModelo) }}"
            ordem="desc"
            ordem-col="1"
            criar="{{ route('autores.create') }}"
            editar="/admin/adms"
            detalhe="/admin/adms"
            modal="sim"
        ></tabela-lista>
        <div align="center">
            {{ $listaModelo->links() }}
        </div>
        
    </painel>
</pagina>

<modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{ route('adms.store') }}" method="post" enctype="" token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="autor">Admin</label>
            <select class="form-control" name="admin" id="admin">
                <option value="">Escolha a opção</option>
                <option value="S" {{ (old('admin') && old('admin')) == 'S' ? 'selected' : '' }} {{ !old('admin') ? 'selected' : '' }}>Sim</option>
                <option value="N" {{ (old('admin') && old('admin')) == 'N' ? 'selected' : '' }}>Não</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Senha" value="{{ old('password') }}">
        </div>
    </formulario>
    <!-- slot definido no elemento -->
    <span slot="botoes">
        <!-- html5 atributo form indica qual formulario o elemento faz parte -->
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>
</modal>

<modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" :action="'/admin/adms/' + $store.state.item.id" method="post" enctype="" token="{{ csrf_token() }}">
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome" v-model="$store.state.item.name">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" v-model="$store.state.item.email">
        </div>
        <div class="form-group">
            <label for="autor">Admin</label>
            <select class="form-control" name="admin" id="admin" v-model="$store.state.item.admin">
                <option value="">Escolha a opção</option>
                <option value="S">Sim</option>
                <option value="N">Não</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
        </div>
    </formulario>
    <!-- slot definido no elemento -->
    <span slot="botoes">
        <!-- html5 atributo form indica qual formulario o elemento faz parte -->
        <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
</modal>

<modal nome="detalhe" :titulo="$store.state.item.name">
    <!-- No laravel para usar uma variavel js, usar @ na blade -->
    <p> @{{ $store.state.item.name }}</p>
    <p> @{{ $store.state.item.email }}</p>
</modal>


@endsection
