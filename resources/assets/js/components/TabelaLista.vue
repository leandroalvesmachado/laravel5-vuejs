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
                        {{ i | formataData }}
                    </td>
                    <td v-if="detalhe || editar || deletar">
                        <form :id="index" v-if="deletar && token" :action="deletar + item.id" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">
                            
                            <a v-if="detalhe && !modal" :href="detalhe">Detalhe |</a>
                            <modal-link
                                v-if="detalhe && modal"
                                tipo="link"
                                nome="detalhe"
                                titulo="Detalhe"
                                css=""
                                :item="item"
                                :url="detalhe"
                            />
                            
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modal-link v-if="editar && modal" tipo="link" nome="editar" titulo="Editar" css="" :item="item" :url="editar"></modal-link>

                            <a href="#" @click="executaForm(index)">Deletar</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="detalhe && !modal" :href="detalhe">Detalhe |</a>
                            <modal-link v-if="detalhe && modal" tipo="link" nome="detalhe" titulo="Detalhe" css="" :item="item" :url="detalhe"></modal-link>
                            
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modal-link v-if="editar && modal" tipo="link" nome="editar" titulo="Editar" css="" :item="item" :url="editar"></modal-link>
                            
                            <a v-if="deletar" :href="deletar">Deletar</a>
                        </span>
                        <span v-if="token && !deletar">
                            <a v-if="detalhe && !modal" :href="detalhe">Detalhe |</a>
                            <modal-link v-if="detalhe && modal" tipo="link" nome="detalhe" titulo="Detalhe" css="" :item="item" :url="detalhe"></modal-link>

                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modal-link v-if="editar && modal" tipo="link" nome="editar" titulo="Editar" css="" :item="item" :url="editar"></modal-link>
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
        filters: {
            formataData(value) {
                if (!value) return '';
                value = value.toString();

                if (value.split('-').length == 3) {
                    value = value.split('-');
                    
                    return value[2] + '/' + value[1] + '/' + value[0];
                }

                return value;
            }
        },
        computed: {
            lista() {
                // metodo definido no vuex no store
                // this.$store.commit('setItens',{ opa:"ok" });
                let lista = this.itens.data;

                let ordem = this.ordemAux;
                let ordemCol = this.ordemAuxCol;

                // garantindo tipos dos valores
                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);

                if (ordem == 'asc') {
                    // metodo de ordenacao
                    lista.sort((a, b) => {
                        // ordenacao pela primira coluna
                        if (Object.values(a)[ordemCol] == Object.values(b)[ordemCol]) {
                            return 0;
                        }

                        return Object.values(a)[ordemCol] > Object.values(b)[ordemCol] ? 1 : -1;
                    });
                } else {
                    // metodo de ordenacao
                    lista.sort((a, b) => {
                        // ordenacao pela primira coluna
                        if (Object.values(a)[ordemCol] == Object.values(b)[ordemCol]) {
                            return 0;
                        }

                        return Object.values(a)[ordemCol] < Object.values(b)[ordemCol] ? 1 : -1;
                    });
                }

                if (this.buscar) {
                    return lista.filter(res => {
                        res = Object.values(res);
                        for (let index = 0; index < res.length; index++) {
                            if ((`${res[index] }`).toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                                return true;
                            }
                        }

                        return false;
                    });
                }

                return lista;
            }
        },
        methods: {
            executaForm(index) {
                console.log(index);
                return document.getElementById(index).submit();
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
