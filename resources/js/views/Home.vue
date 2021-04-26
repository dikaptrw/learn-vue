<template>
    <div class="container">
        <div class="row flex-column align-items-center my-2">
            <div class="col-lg-7">
                <h4 class="font-weight-bold">All Notes</h4>
                <hr class="my-3">
                <span class="d-inline-block mb-3">These are all note.</span>
                <div v-for="note in notes" :key="note.id" @click.prevent="noteShow(note.slug)" class="card mb-4" aria-current="true" style="cursor: pointer;">
                    <div class="card-header">
                        <h5 class="my-2">{{ note.title }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">{{ note.description }}</p>
                        <small>{{ note.subject }}.</small> &middot;
                        <small>{{ note.published }}</small>
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
                notes: []
            }
        },

        mounted() {
            this.getNotes()
        },

        methods: {
            async getNotes() {
                let response = await axios.get('/api/notes');
                if (response.status === 200) {
                    this.notes = response.data.data;
                }
            },

            noteShow(noteSlug) {
                this.$router.push(`/notes/${noteSlug}`);
            }
        }
    }
</script>