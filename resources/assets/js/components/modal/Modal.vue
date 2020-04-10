<template>
    <div :id="nome" class="modal fade" tabindex="-1" role="dialog" :aria-labelledby="nome">
        <div class="modal-dialog modal-lg" role="doccumnet">
            <div class="modal-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['nome']
    }
</script>
