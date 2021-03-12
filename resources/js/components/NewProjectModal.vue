<template>
    <form @submit.prevent="submit">
        <modal name="new-project" classes="p-5 rounded" height="auto">
            <h1 class="mb-3 text-center"><small>Let's Start Something New</small></h1>
            <div class="d-flex">
                <div class="flex-grow-1 mr-2">
                    <div class="mb-2">
                        <label for="title" class="d-block">Title</label>
                        <input
                            type="text"
                            id="title"
                            class="d-block w-100 p-2 rounded shadow-none"
                            :class="errors.title ? 'form-control is-invalid' : 'form-control'"
                            v-model="form.title">
                        <small class="text-danger" v-if="errors.title" v-text="errors.title[0]"></small>
                    </div>
                    <div class="mb-2">
                        <label for="title" class="d-block">Description</label>
                        <textarea
                            id="description"
                            class="form-control d-block w-100 py-1 px-2 rounded"
                            :class="errors.description ? 'form-control is-invalid' : 'form-control'"
                            rows="7"
                            v-model="form.description">
                        </textarea>
                        <small class="text-danger" v-if="errors.description" v-text="errors.description[0]"></small>
                    </div>
                </div>
                <div class="flex-grow-1 ml-2">
                    <div class="mb-2">
                        <label class="d-block">Need Some Tasks?</label>
                        <input
                            type="text"
                            class="form-control d-block w-100 mb-2 p-2 rounded"
                            placeholder="Task 1"
                            v-for="task in form.tasks"
                            v-model="task.body">
                    </div>
                    <button type="button" class="bg-transparent border-0 d-inline-flex align-items-center pl-0" @click="addTask">
                        <img src="/images/add.png" width="20px" alt="add-button" class="mr-1">
                        <span>Add New Task Field</span>
                    </button>
                </div>
            </div>
            <footer class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-info" @click="$modal.hide('new-project')">Cancel</button>
                <button type="submit" class="btn btn-info text-white ml-3">Create Project</button>
            </footer>
        </modal>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                        { body: '' },
                    ]
                },
                errors: {}
            }
        },
        methods: {
            addTask() {
                this.form.tasks.push({ body: '' });
            },
            // submit() {
            //     axios.post('/projects', this.form)
            //         .then(response => {
            //             location = response.data.message;
            //         })
            //         .catch(error => {
            //             this.errors = error.response.data.errors;
            //         });
            // },
            async submit() {
                try {
                    location = (await axios.post('/projects', this.form)).data.message;
                } catch (error) {
                    this.errors = error.response.data.errors;
                }
            }
        }
    }
</script>
