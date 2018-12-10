<template>
    <div>
        <h2>Topic</h2>
        <hr>
        <div v-if="topic" id="topic_info" class="topic_info">
            <h3>{{ topic.title }}</h3>
            <h4> Posted by {{ topic.owner.name }} at {{ topic.created_at }}</h4>
            <h5> {{ topic.body }} </h5>
        </div>

        <div class="alert alert-danger" v-if="has_error">
            <p>Error, unable to retrieve the list of topics.</p>
        </div>

        <hr>

        <div class="card card-default">
            <div class="card-header">Post list</div>
            <div class="card-body">
                <posts v-if="topic" v-bind:topic_id="topic_id"></posts>
            </div>
        </div>

    </div>
</template>
<script>

    import posts from '../components/posts'

    export default {
        name: "Topic",
        data() {
            return {
                has_error: false,
                topic: null,
            }
        },
        mounted() {
            this.getTopic()
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
            }
        },
        components: {
            posts,
        }
    }
</script>