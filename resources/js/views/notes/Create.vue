<template>
    <div class="container">
        <div class="row justify-content-center mt-3 mb-4">
            <div class="col-lg-6 col-md-10">
                <h4 class="font-weight-bold">Create Your Note</h4>
                <hr class="my-3">
                <span class="d-inline-block mb-3">Your can setup your new note here.</span>
                <div v-if="successMessage" class="alert alert-primary" role="alert">
                    {{ successMessage }}
                </div>
                <div class="card">
                    <div class="card-header">
                        New Notes
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="store">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" v-model="form.title" id="title" class="form-control">
                                <span v-if="errorMessage.title" class="mt-2 text-danger">{{ errorMessage.title[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select v-model="form.subject" id="subject" class="form-control">
                                    <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
                                        {{ subject.name }}
                                    </option>
                                </select>
                                <span v-if="errorMessage.subject" class="mt-2 text-danger">{{ errorMessage.subject[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" rows="4" class="form-control"></textarea>
                                <span v-if="errorMessage.description" class="mt-2 text-danger">{{ errorMessage.description[0] }}</span>
                            </div>

                            <button type="submit" class="btn btn-success d-flex align-items-center">
                                <span class="text-white">Save</span>
                                <svg v-if="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="27px" height="27px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <rect x="17.5" y="30" width="15" height="40" fill="#dce4eb">
                                        <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
                                        <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
                                    </rect>
                                    <rect x="42.5" y="30" width="15" height="40" fill="#dce4eb">
                                        <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
                                        <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
                                    </rect>
                                    <rect x="67.5" y="30" width="15" height="40" fill="#dce4eb">
                                        <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                                        <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                                    </rect>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    subject: ''
                },
                subjects: [],
                successMessage: '',
                errorMessage: [],
                loading: false
            }
        },

        mounted() {
            this.getSubjects();
        },

        methods: {
            async getSubjects() {
                let response =  await axios.get('/api/subjects');
                if (response.status === 200) {
                    this.subjects = response.data;
                }
            },

            async store() {
                this.loading = true;
                try {
                    let response = await axios.post('/api/notes/create-new-note', this.form);

                    if(response.status === 200) {
                        this.form.title = '';
                        this.form.description = '';
                        this.form.subject = '';

                        this.errorMessage = [];
                        this.successMessage = response.data.message;

                        this.loading = false;
                    }
                } catch (e) {
                    this.errorMessage = e.response.data.errors;
                    this.loading = false;
                }
            }
        }
    }
</script>

<style>

</style>