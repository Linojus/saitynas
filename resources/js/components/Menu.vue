<template>

    <nav class="navbar navbar-expand-md fixed-top">

        <div class="container">
        <router-link class="navbar-brand" :to="{name: 'home'}">
            NewCoolCompany's forum
        </router-link>

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
            <ul class="navbar-nav mr-auto ">
                <!--
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                -->


                <!--LOGGED USER-->
                <li v-if="$auth.check(2)" v-for="(route, key) in routes.user" v-bind:key="route.path">
                    <router-link class="nav-link"  :to="{ name : route.path }" :key="key">
                        {{route.name}}
                    </router-link>
                </li>
                <!--LOGGED ADMIN-->
                <li v-if="$auth.check(1)" v-for="(route, key) in routes.admin" v-bind:key="route.path">
                    <router-link class="nav-link" :to="{ name : route.path }" :key="key">
                        {{route.name}}
                    </router-link>
                </li>

                {{ weed }}
            </ul>

            <ul class="navbar-nav ml-auto">

                <!--UNLOGGED-->

                <li v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                    <router-link class="nav-link"  :to="{ name : route.path }" :key="key">
                        {{route.name}}
                    </router-link>
                </li>

                <!--LOGOUT-->
                <li v-if="$auth.check()">
                    <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                </li>
            </ul>



        </div>
        </div>
    </nav>

</template>

<script>
    export default {
        data() {
            return {
                routes: {
                    // UNLOGGED
                    unlogged: [
                        {
                            name: 'Registration',
                            path: 'register'
                        },
                        {
                            name: 'Login',
                            path: 'login'
                        }
                    ],
                    // LOGGED USER
                    user: [
                        {
                            name: 'Dashboard',
                            path: 'dashboard'
                        }
                    ],
                    // LOGGED ADMIN
                    admin: [
                        {
                            name: 'Admin Dashboard',
                            path: 'admin.dashboard'
                        }
                    ]
                },
                weed: 'hahah weed man'
            }
        },
        mounted() {
            //
        }
    }
</script>
