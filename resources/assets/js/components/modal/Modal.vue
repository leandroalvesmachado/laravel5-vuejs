<template>
    <div :id="nome" class="modal fade" tabindex="-1" role="dialog" :aria-labelledby="nome">
        <div class="modal-dialog modal-lg" role="doccumnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span></span>
                    </button>
                    <h4 class="modal-title">
                        {{ titulo }}
                    </h4>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <slot name="botoes"></slot>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['nome', 'titulo']
    }
</script>
