<template>
    <div>
        <h3>List of posts</h3>
        <div class="alert alert-danger" v-if="has_error">
            <p>Error, unable to retrieve the list of posts.</p>
        </div>
        <table class="table">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Poster</th>
                <th scope="col">Body</th>
                <th scope="col">Posted at</th>
            </tr>
            <tr v-for="post in posts" v-bind:key="post.id" style="margin-bottom: 5px;">
                <th scope="row">{{ post.id }}</th>
                <td>{{ post.owner.name }}</td>
                <td>{{ post.body }}</td>
                <td>{{ post.created_at}}</td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                has_error: false,
                posts: null
            }
        },
        mounted() {
            this.getPosts()
        },
        props: ['topic_id'],
        methods: {
            getPosts() {
                this.$http({
                    url: `topics/${this.topic_id}/posts`,
                    method: 'GET'
                })
                    .then((res) => {
                        this.posts = res.data
                    }, () => {
                        this.has_error = true
                    })
            }
        }
    }
</script>