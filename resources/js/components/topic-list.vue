<template>
    <div>
        <h3>List of Topics</h3>
        <div class="alert alert-danger" v-if="has_error">
            <p>Error, unable to retrieve the list of topics.</p>
        </div>
        <table class="table">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Created by</th>
                <th scope="col">Created at</th>
            </tr>
            <tr v-for="topic in topics" v-bind:key="topic.id" style="margin-bottom: 5px;">
                <th scope="row">{{ topic.id }}</th>
                <td><router-link :to="`/saitynas/public/topics/${topic.id}`">{{ topic.title }}</router-link></td>
                <td>{{ topic.owner.name }}</td>
                <td>{{ topic.created_at}}</td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                has_error: false,
                topics: null
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