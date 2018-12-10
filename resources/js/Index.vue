<template>
    <div id="main">
        <header id="header">
            <navigationMenu></navigationMenu>
        </header>

        <div id="content" class="mt-5 pt-5">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>

        <nav class="navbar fixed-bottom navbar-light bg-faded" style="background: aqua">
            <a class="navbar-brand" href="#">Fixed bottom</a>
        </nav>
        <footer id="footer">

        </footer>
    </div>
</template>
<script>
    import navigationMenu from './components/Menu.vue'

    export default {
        data() {
            return {
                //
            }
        },
        components: {
            navigationMenu
        }
    }
</script>