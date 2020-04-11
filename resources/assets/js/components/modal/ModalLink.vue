<template>
    <span>
        <span v-if="item">
            <button
                v-if="!tipo || (tipo != 'botao' && tipo != 'link')"
                type="button"
                :class="defineCss"
                data-toggle="modal"
                :data-target="defineTarget"
                @click="preencheFormulario()"
            >
                {{ titulo }}
            </button>
            <button
                v-if="tipo =='botao'"
                type="button"
                :class="defineCss"
                data-toggle="modal"
                :data-target="defineTarget"
                @click="preencheFormulario()"
            >
                {{ titulo }}
            </button>
            <a
                v-if="tipo =='link'" href="#"
                :class="defineCss"
                data-toggle="modal"
                :data-target="defineTarget"
                @click="preencheFormulario()"
            >
                {{ titulo }}
            </a>
        </span>
        <span v-else>
            <button v-if="!tipo || (tipo != 'botao' && tipo != 'link')" type="button" :class="defineCss" data-toggle="modal" :data-target="defineTarget">
            {{ titulo }}
            </button>
            <button v-if="tipo =='botao'" type="button" :class="defineCss" data-toggle="modal" :data-target="defineTarget">
                {{ titulo }}
            </button>
            <a v-if="tipo =='link'" href="#" :class="defineCss" data-toggle="modal" :data-target="defineTarget">
                {{ titulo }}
            </a>
        </span>
    </span>
</template>

<script>
    export default {
        props: ['tipo', 'nome', 'titulo', 'css', 'item'],
        computed: {
            defineCss() {
                if (this.tipo != "link") {
                    return this.css || 'btn btn-primary';
                }
            },
            defineTarget() {
                return `#${this.nome}`;
            }
        },
        methods: {
            preencheFormulario() {
                return this.$store.commit('setItem', this.item);
            }
        }
    }
</script>
