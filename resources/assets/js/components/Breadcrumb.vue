<template>
    <ol class="breadcrumb">
        <li v-for="item in lista" :key="item.titulo">
            <a
                :class="defineClass"
                :href="item.url"
                v-if="item.url"
            >
                {{ item.titulo }}
            </a>
            <span v-if="!item.url">{{ item.titulo }}</span>
        </li>
    </ol>
</template>

<script>
    export default {
        props: ['lista'],
        computed: {
            defineClass() {
                return this.url ? 'active' : '';
            }
        }
    }
</script>
