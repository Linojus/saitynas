<template>
    <div id="posts">

        <div v-if="posts">
            <div v-if="!posts.length" class="container">
                <div class="row">
                    <div class="col-12 p-2 text-center">
                        <h4>There are replies to this topic yet. </h4>
                        <h3>Be the first one!</h3>
                    </div>
                </div>
            </div>
            <div v-if="posts.length > 0" v-for="post, index in posts" v-bind:key="post.id" class="container ">
                <div class="row post">
                    <div class="col-12 post-header p-1 ">
                        <div class="row">
                            <div class="col-6">
                                {{ post.owner.name }}
                            </div>
                            <div class="col-6 text-right">
                                at {{ post.created_at }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 post-body py-3">
                        {{ post.body }}
                    </div>

                    <div v-if="$auth.check(1) || user_id == post.owner.id" class="col-12 post-footer text-right p-1 ">
                        edit /
                        <a href="#" class="delete-link" v-on:click="deletePost(post.id, index)"> Delete </a>
                    </div>
                </div>
            </div>

        </div>
        <!--
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

        -->

    </div>
</template>
<script>

    import {EventBus} from '../event-bus.js';

    export default {
        data() {
            return {
                has_error: false,
                posts: null,
                user_id: null
            }
        },
        mounted() {
            EventBus.$on('update_list', () => this.getPosts())
            this.getPosts();
            this.user_id = this.$auth.user().id;
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
            },
            deletePost(id, index) {
                if (confirm("Do you really want to delete this reply?")) {
                    var app = this;
                    axios.delete(`/topics/${this.topic_id}/posts/` + id)
                        .then(function (resp) {
                            app.posts.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        }
    }
</script>