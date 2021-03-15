<template>
    <div class="dropdown position-relative">
        <div
            aria-haspopup="true"
            :aria-expanded="isOpen"
            @click.prevent="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>

        <div class="nav-item dropdown-menu w-100" v-show="isOpen">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isOpen: false
            }
        },
        watch: {
            isOpen(isOpen) {
                if (isOpen) {
                    document.addEventListener('click', this.closeIfClickedOutside);
                }
            }
        },
        methods: {
            closeIfClickedOutside() {
                alert('handling');
            }
        }
    }
</script>

<style scoped>

</style>
