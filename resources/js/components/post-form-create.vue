<template>
    <div id="post-create" class="py-2">

        <!--<button id="show-modal" @click="showModal = true">Show Modal</button>-->

        <successModal v-if="showModal" @close="showModal = false">
            <h3 slot="header">Reply successful</h3>
        </successModal>

        <div  class="card card-default">
            <div v-on:click="toggleCollapse" class="card-header text-right">
                Post a reply
                <i v-if="show" class="fas fa-arrow-down"></i>
                <i v-else class="fas fa-arrow-up"></i>
            </div>
            <!--<input type="button" v-on:click="toggleCollapse" class="btn" value="show/hide"/> -->
            <transition name="smooth">
                <div v-if="show" class="card-body">
                    <form v-on:submit="saveForm()">
                        <div class="form-group">
                            <!--<label class="control-label">Post body</label>-->
                            <!--<input type="text" v-model="form.body" class="form-control">-->
                            <textarea class="form-control" placeholder="your reply..." v-model="form.body"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-dark">Post</button>
                        </div>
                    </form>
                </div>
            </transition>
        </div>
    </div>

</template>

<script>

    import successModal from './modals/success';

    export default {
        name: "post-form-create",

        props: {
            // type, required and default are optional, you can reduce it to 'options: Object'
            topicId: {required: true},
        },
        data() {
            return {
                form: {
                    body: ''
                },
                showModal: false,
                show: false,
            }
        },
        methods: {

            toggle: function(todo){
                todo.done = !todo.done
            },
            toggleCollapse: function() {
                this.show = !this.show
            },

            saveForm() {
                event.preventDefault();
                var app = this;
                var createForm = app.form;
                axios.post(`/topics/${this.topicId}/posts`, createForm)
                    .then(function (resp) {
                        /*app.$router.push({path: '/'});*/
                        app.$parent.refreshPosts();
                        app.form.body = '';
                        app.showModal = true;
                        app.show = false;

                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your post");
                    });
            }
        },
        components: {
            successModal
        }

    }
</script>

<style scoped>

</style>