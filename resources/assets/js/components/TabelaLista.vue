<template>
    <div>
        <div class="form-inline">
            <a v-if="criar" :href="criar">Criar</a>
            <div class="form-group pull-right">
                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th v-for="titulo in titulos" :key="titulo">
                        {{ titulo }}
                    </th>
                    <th v-if="detalhe || editar || deletar">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in itens" :key="index">
                    <td v-for="i in item" :key="i">
                        {{ i }}
                    </td>
                    <td v-if="detalhe || editar || deletar">
                        <form :id="index" v-if="deletar && token" :action="deletar">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">
                            <a v-if="detalhe" :href="detalhe">Detalhe |</a>
                            <a v-if="editar" :href="editar">Editar |</a>
                            <a href="#" @onclick="executaForm(index)">Deletar</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="detalhe" :href="detalhe">Detalhe |</a>
                            <a v-if="editar" :href="editar">Editar |</a>
                            <a v-if="deletar" :href="deletar">Deletar</a>
                        </span>
                        <span v-if="token && !deletar">
                            <a v-if="detalhe" :href="detalhe">Detalhe |</a>
                            <a v-if="editar" :href="editar">Editar |</a>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: [
            'titulos',
            'itens',
            'criar',
            'detalhe',
            'editar',
            'deletar',
            'token'
        ],
        data () {
            return {
                buscar: ''
            }
        },
        methods: {
            executaForm(index) {
                document.getElementById(index).submit();
            }
        }
    }
</script>
