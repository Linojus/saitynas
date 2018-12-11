<template>
    <div id="topic" class="container">

        <div v-if="topic" id="topic_info" class="topic-main">
            <div class="topic-main-title">{{ topic.title }}</div>
            <div class="topic-main-info"> Posted by {{ topic.owner.name }} at {{ topic.created_at }}</div>
            <div class="topic-main-body"> {{ topic.body }}</div>
        </div>

        <div class="alert alert-danger" v-if="has_error">
            <p>Error, unable to retrieve the list of topics.</p>
        </div>

        <hr>

        <div v-if=" topic && ($auth.check(1) || user_id == topic.owner.id)">

            <router-link class="edit-link" :to="{ name : 'topicEdit', params: { topic_id: topic_id} }">
                 Edit
            </router-link>
            /
            <a href="#" class="delete-link" v-on:click="deleteTopic"> Delete </a> this topic

            <hr>
        </div>

        <CreatePost :topicId="topic_id" :bus="bus"></CreatePost>

        <div class="card card-default">
            <div class="card-body p-1">
                <posts v-if="topic" v-bind:topic_id="topic_id"></posts>
            </div>
        </div>

    </div>
</template>
<script>

    import {EventBus} from '../event-bus.js';
    import posts from '../components/posts'
    import CreatePost from '../components/post-form-create'

    export default {
        name: "Topic",
        data() {
            return {
                bus: this.bus,
                has_error: false,
                topic: null,
                user_id: null,
            }
        },
        mounted() {
            this.getTopic();
            this.user_id = this.$auth.user().id;
        },
        props: ['topic_id'],
        methods: {
            getTopic() {
                this.$http({
                    url: `topics/${this.topic_id}`,
                    method: 'GET'
                })
                    .then((res) => {
                        this.topic = res.data
                    }, () => {
                        this.has_error = true
                    })
            },
            refreshPosts() {
                EventBus.$emit('update_list');
            },
            deleteTopic() {
                if (confirm("Do you really want to delete this reply?")) {
                    var app = this;
                    axios.delete(`/topics/` + app.topic_id)
                        .then(function (resp) {
                            app.$router.push({path: '/'});
                        })
                        .catch(function (resp) {
                            alert("Could not delete this topic");
                        });
                }
            },
        },
        components: {
            posts,
            CreatePost,
        }
    }
</script>