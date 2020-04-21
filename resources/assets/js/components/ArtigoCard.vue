<template>
    <div :class="'col-sm-'+ (sm || '6') + ' col-md-'+ (md || '4')">
        <div class="thumbnail">
            <img :src="imagem" alt="">
            <div class="caption">
                <small>{{ data | formataData }} - {{ autor }}</small>
                <h3>{{ titulo }}</h3>
                <p>{{ descricao }}</p>
                <p>
                    <a :href="link" class="btn btn-primary" role="button">Leia mais</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titulo', 'descricao', 'link', 'imagem', 'data', 'autor', 'sm', 'md'],
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
        }
    }
</script>
