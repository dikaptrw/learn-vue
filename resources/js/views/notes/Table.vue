<template>
    <div class="container">
        <div class="row justify-content-center my-2">
            <div class="col-lg-9">
                <h4 class="font-weight-bold">Table Of Notes</h4>
                <hr>
                <span class="d-inline-block mb-3">These is table of notes and you can manage them at anytime.</span>
                <div class="card">
                    <div class="card-body overflow-auto w-100 p-4">
                        <table class="table">
                            <thead class="borderless">
                                <tr>
                                    <th>Title</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="note in notes" :key="note.id">
                                    <td>
                                        <router-link :to="{ name: 'notes.show', params: { noteSlug: note.slug } }">
                                            {{ note.title }}
                                        </router-link>
                                    </td>
                                    <td>{{ note.subject }}</td>
                                    <td>{{ note.description }}</td>
                                    <td style="width: 130px; min-width: 130px;">{{ note.published }}</td>
                                    <td style="width: 150px; min-width: 150px;">
                                        <router-link :to="{ name: 'notes.edit', params: { noteSlug: note.slug } }" class="btn btn-info text-white">
                                            Edit
                                        </router-link>
                                        <DeleteNote :endpoint="note.slug"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DeleteNote from './Delete';
    export default {
        components: {
            DeleteNote
        },

        data() {
            return {
                notes: []
            }
        },

        mounted() {
            if (this.$route.params.isUpdated) {
                swal({
                    title: "Note Updated!",
                    text: "The note was successfully updated!",
                    icon: "success",
                    button: 'Ok'
                });
            }
            this.getNotes();
        },

        methods: {
            async getNotes() {
                let response = await axios.get('/api/notes');
                this.notes = response.data.data;
            }
        }
    }
</script>

<style>
    thead td, thead th {
        border: none !important;
    }
</style>