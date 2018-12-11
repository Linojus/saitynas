<template>
    <div class="container">
        <div class="card card-default my-2">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                Welcome, {{ $auth.user().name }}
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                //
            }
        },
        mounted() {
            this.test();
        },
        components: {
            //
        },
        methods: {
            test() {
                console.log(this.$auth.user());
            }
        }
    }
</script>