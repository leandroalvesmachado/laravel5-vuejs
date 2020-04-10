<template>
    <div>
        <div class="form-inline">
            <a v-if="criar && !modal" :href="criar">Criar</a>
            <modal-link v-if="criar && modal" tipo="link" nome="adicionar" titulo="Criar" css=""></modal-link>
            <div class="form-group pull-right">
                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th v-for="(titulo, index) in titulos" :key="titulo" @click="ordenaColuna(index)" style="cursor: pointer;">
                        {{ titulo }}
                    </th>
                    <th v-if="detalhe || editar || deletar">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in lista" :key="index">
                    <td v-for="i in item" :key="i">
                        {{ i }}
                    </td>
                    <td v-if="detalhe || editar || deletar">
                        <form :id="index" v-if="deletar && token" :action="deletar">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">
                            <a v-if="detalhe" :href="detalhe">Detalhe |</a>
                            
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modal-link v-if="editar && modal" tipo="link" nome="editar" titulo="Editar" css=""></modal-link>

                            <a href="#" @onclick="executaForm(index)">Deletar</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="detalhe" :href="detalhe">Detalhe |</a>
                            
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modal-link v-if="editar && modal" tipo="link" nome="editar" titulo="Editar" css=""></modal-link>
                            
                            <a v-if="deletar" :href="deletar">Deletar</a>
                        </span>
                        <span v-if="token && !deletar">
                            <a v-if="detalhe" :href="detalhe">Detalhe |</a>

                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modal-link v-if="editar && modal" tipo="link" nome="editar" titulo="Editar" css=""></modal-link>
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
            'ordem',
            'ordemCol',
            'criar',
            'detalhe',
            'editar',
            'deletar',
            'token',
            'modal'
        ],
        data() {
            return {
                buscar: '',
                ordemAux: this.ordem || 'asc',
                ordemAuxCol: this.ordemCol || 0
            }
        },
        computed: {
            lista() {
                // metodo definido no vuex no store
                this.$store.commit('setItens',{ opa:"ok" });

                let ordem = this.ordemAux;
                let ordemCol = this.ordemAuxCol;

                // garantindo tipos dos valores
                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);

                if (ordem == 'asc') {
                    // metodo de ordenacao
                    this.itens.sort((a, b) => {
                        // ordenacao pela primira coluna
                        if (Object.values(a)[ordemCol] == Object.values(b)[ordemCol]) {
                            return 0;
                        }

                        return Object.values(a)[ordemCol] > Object.values(b)[ordemCol] ? 1 : -1;
                    });
                } else {
                    // metodo de ordenacao
                    this.itens.sort((a, b) => {
                        // ordenacao pela primira coluna
                        if (Object.values(a)[ordemCol] == Object.values(b)[ordemCol]) {
                            return 0;
                        }

                        return Object.values(a)[ordemCol] < Object.values(b)[ordemCol] ? 1 : -1;
                    });
                }

                if (this.buscar) {
                    return this.itens.filter(res => {
                        for (let index = 0; index < res.length; index++) {
                            if ((`${res[index] }`).toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                                return true;
                            }
                        }

                        return false;
                    });
                }

                return this.itens;
            }
        },
        methods: {
            executaForm(index) {
                document.getElementById(index).submit();
            },
            ordenaColuna(coluna) {
                this.ordemAuxCol = coluna;

                if (this.ordemAux.toLowerCase() == 'asc') {
                    this.ordemAux = 'desc';
                } else {
                    this.ordemAux = 'asc';
                }
            }
        }
    }
</script>
