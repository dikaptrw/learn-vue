<template>
        <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-lg-6 col-md-10">
                <h4 class="font-weight-bold">Edit Your Note</h4>
                <hr class="my-3">
                <span class="d-inline-block mb-3">Edit note "{{ noteTitle }}".</span>
                <div v-if="successMessage" class="alert alert-primary" role="alert">
                    {{ successMessage }}
                </div>
                <div class="card">
                    <div class="card-header">
                        Edit Note
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="update">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" v-model="form.title" id="title" class="form-control">
                                <span v-if="errorMessage.title" class="mt-2 text-danger">{{ errorMessage.title[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select @change="selectedSubject" id="subject" class="form-control">
                                    <option :value="form.subjectId" v-text="form.subject"></option>
                                    <template v-for="subject in subjects">
                                        <option v-if="subject.id !== form.subjectId" :key="subject.id" :value="subject.id">
                                            {{ subject.name }}
                                        </option>
                                    </template>
                                </select>
                                <span v-if="errorMessage.subject" class="mt-2 text-danger">{{ errorMessage.subject[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" rows="4" class="form-control"></textarea>
                                <span v-if="errorMessage.description" class="mt-2 text-danger">{{ errorMessage.description[0] }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
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
                form: [],
                subjects: [],
                errorMessage: [],
                noteTitle: '',
                successMessage: '',
                selected: ''
            }
        },

        mounted() {
            this.getNote();
            this.getSubjects();
        },

        methods: {
            async getNote() {
                let response = await axios.get('/api/notes/' + this.$route.params.noteSlug);
                this.form = response.data.data;
                this.noteTitle = response.data.data.title;
            },

            async getSubjects() {
                let response =  await axios.get('/api/subjects');
                if (response.status === 200) {
                    this.subjects = response.data;
                }
            },

            selectedSubject(e) {
                this.selected = e.target.value;
            },

            async update() {
                this.form['subject'] = this.selected || this.form.subjectId; 
                
                let response = await axios.patch(`/api/notes/${this.$route.params.noteSlug}/update`, this.form)

                if (response.status === 200) {
                    this.$router.push({name:'notes.table', params:{isUpdated:true}});
                }
            }
        }
    }
</script>