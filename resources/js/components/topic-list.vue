<template>
    <div id="topic_list">
        <div v-for="topic in topics" v-bind:key="topic.id" class="container">
            <div class="row topic">

                <div class="col-md-8">
                    <router-link :to="`/topics/${topic.id}`">
                        <img :src="frog_src" class="frog">{{ topic.title }}
                    </router-link>
                </div>

                <div class="col-md-4 text-right side-info">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-12">
                            by {{ topic.owner.name }}
                        </div>
                        <div class="col-md-12 col-sm-6 col-12">
                            at {{ topic.created_at}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--
        <div class="alert alert-danger" v-if="has_error">
            <p>Error, unable to retrieve the list of topics.</p>
        </div>
        <table class="table">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Created by</th>
                <th scope="col">Created at</th>
            </tr>
            <tr v-for="topic in topics" v-bind:key="topic.id" style="margin-bottom: 5px;">
                <td><router-link :to="`/saitynas/public/topics/${topic.id}`">{{ topic.title }}</router-link></td>
                <td>{{ topic.owner.name }}</td>
                <td>{{ topic.created_at}}</td>
            </tr>
        </table>
        -->
    </div>
</template>
<script>
    export default {
        data() {
            return {
                has_error: false,
                topics: null,
                frog_src: '/saitynas/public/svg/frog.svg',
            }
        },
        mounted() {
            this.getTopics()
        },
        methods: {
            getTopics() {
                this.$http({
                    url: `topics`,
                    method: 'GET'
                })
                    .then((res) => {
                        this.topics = res.data
                    }, () => {
                        this.has_error = true
                    })
            }
        }
    }
</script>