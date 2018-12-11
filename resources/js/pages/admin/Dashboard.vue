<template>
    <div class="container">

        <div class="card card-default my-2">
            <div class="card-header">Admin Dashboard</div>
            <div class="card-body">
                Welcome to your administrator dashboard, {{ $auth.user().name }}
            </div>
        </div>

        <div class="card card-default">
            <div class="card-header">User list</div>
            <div class="card-body">
                <userList></userList>
            </div>
        </div>

    </div>
</template>
<script>
    import userList from '../../components/user-list.vue'
    export default {
        mounted() {
            //
        },
        components: {
            userList
        }
    }
</script>