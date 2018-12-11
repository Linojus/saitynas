<template>
    <div id="TopicEdit" class="py-2">

        <div class="card card-default">

            <div class="card-body">
                <form v-on:submit.prevent="editPost">
                    <div class="form-group">
                        <label class="control-label">Title</label>
                        <input type="text" v-model="form.title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Content</label>
                        <textarea rows="10" class="form-control" v-model="form.body">form.body</textarea>
                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-dark">Save</button>
                        <router-link class="btn btn-danger" :to="{ name : 'topic', params: { topic_id: topic_id} }">
                            Cancel
                        </router-link>
                    </div>
                </form>
            </div>

        </div>
    </div>

</template>

<script>

    export default {
        name: "TopicEdit",
        data() {
            return {
                form: {
                    title: '',
                    body: '',
                }
            }
        },
        props: ['topic_id'],
        mounted() {
            this.getTopic();
        },
        methods: {

            getTopic() {
                this.$http({
                    url: `topics/${this.topic_id}`,
                    method: 'GET'
                })
                    .then((res) => {
                        this.topic = res.data;
                        this.form.title = res.data.title;
                        this.form.body = res.data.body;
                    }, () => {
                        this.has_error = true
                    })
            },
            editPost() {
                var app = this;
                axios.put(`/topics/${this.topic_id}` , { title: app.form.title ,body: app.form.body })
                    .then(function (resp) {
                        app.$router.push({path: `/topics/${app.topic_id}`});
                        alert("Successfully edited");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not edit topic");
                    });
            },
        }
    }
</script>
