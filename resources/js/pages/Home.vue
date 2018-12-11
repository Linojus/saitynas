<template>
    <div id="home" class="container">
        <welcome></welcome>

        <div class="card card-default" v-if="$auth.check()">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">

                        <div class="col-md-4 col-12">
                            Topics
                        </div>
                        <div class="col-md-8 col-12 text-right">
                            <router-link class="add-link" :to="{ name : 'topicCreate'}" >
                                <i class="fas fa-plus"></i> new topic
                            </router-link>
                        </div>

                    </div>
                </div>
                <div class="card-body py-1">

                </div>

                <topicList></topicList>

            </div>
        </div>
    </div>
</template>
<script>
    import topicList from '../components/topic-list.vue'
    import welcome from "../components/welcome.vue";

    export default {
        mounted() {
            //
        },
        components: {
            welcome,
            topicList
        },
        data: {
            image_src: '/svg/frog.svg',
        }
    }
</script>