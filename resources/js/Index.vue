<template>
    <div id="main">
        <header id="header">
            <navigationMenu></navigationMenu>
        </header>

        <div id="content" >
            <div class="container">
                <router-view></router-view>
            </div>
        </div>


        <footer id="footer">

            <nav class="navbar fixed-bottom navbar-light bg-faded">
                <div class="container">
                    <a class="navbar-brand" href="#">to Top <i class="fas fa-long-arrow-alt-up"></i> </a>
                    <a class="nav-link disabled d-none d-sm-block" target="_blank" href="https://github.com/Linojus/saitynas">
                        by Linas Juodvalkis IFF-5/9, ©{{ new Date().getFullYear() }}
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </nav>
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