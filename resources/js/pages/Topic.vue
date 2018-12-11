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

        <CreatePost :topicId="topic_id" :bus="bus"></CreatePost>

        <div class="card card-default">
            <div class="card-body p-1">
                <posts v-if="topic" v-bind:topic_id="topic_id"></posts>
            </div>
        </div>

    </div>
</template>
<script>

    import { EventBus } from '../event-bus.js';
    import posts from '../components/posts'
    import CreatePost from '../components/post-form-create'

    export default {
        name: "Topic",
        data() {
            return {
                bus: this.bus,
                has_error: false,
                topic: null,
            }
        },
        mounted() {
            this.getTopic();
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
        },
        components: {
            posts,
            CreatePost,
        }
    }
</script>