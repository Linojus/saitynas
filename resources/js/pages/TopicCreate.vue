<template>
    <div id="TopicCreate" class="py-2">

        <div class="card card-default">

            <!--<input type="button" v-on:click="toggleCollapse" class="btn" value="show/hide"/> -->

            <div class="card-body">
                <form v-on:submit="saveForm()">
                    <div class="form-group">
                        <label class="control-label">Title</label>
                        <input type="text" v-model="form.title" class="form-control">
                        <label class="control-label">Content</label>
                        <textarea rows="8" class="form-control" placeholder="your topic content.." v-model="form.body"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-dark">Post</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</template>

<script>

    export default {
        name: "TopicCreate",

        data() {
            return {
                form: {
                    title: '',
                    body: '',
                }
            }
        },
        mounted() {
            //
        },
        methods: {

            saveForm() {
                event.preventDefault();
                var app = this;
                var createForm = app.form;
                axios.post(`/topics`, createForm)
                    .then(function (resp) {
                        app.$router.push({path: '/topics/' + resp.data.id});
                    })
                    .catch(function (resp) {
                        alert("Could not create your post");
                    });
            }
        }
    }
</script>
