<template>

    <div class="welcome">

        <div id="welcome_unlogged" v-if="!$auth.check()">
            <div class="text-center">
                <h1>Welcome</h1>
                <img :src="frog_src" class="frog">
                <h3>Please Register/Login to continue</h3>
            </div>
        </div>

        <div id="welcome_logged" v-if="$auth.check()">
            <div class="text-center">

                <div class="container">
                    <div class="row">
                        <div class="col-1 col-1 p-0 text-right align-self-center"><img
                                :src="'/saitynas/public/svg/frog.svg'" class="frog"></div>
                        <div class="col-10 align-self-center"><h1>Welcome to the forum</h1></div>
                        <div class="col-1 col-1 p-0 text-left align-self-center"><img
                                :src="'/saitynas/public/svg/frog.svg'" class="frog"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "welcome",
        data() {
            return {
                frog_src: '/saitynas/public/svg/frog.svg',
            }
        }
    }
</script>
