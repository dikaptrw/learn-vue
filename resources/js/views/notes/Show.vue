<template>
    <div>
        <div class="container">
            <div class="row justify-content-center my-2">
                <div class="col-lg-7">
                    <h4 class="mb-4">Note "{{ note.title }}"</h4>
                    <div class="card">
                        <div class="card-header">
                            {{ note.title }}
                        </div>
                        <div class="card-body">
                            <p>{{ note.description }}</p> 
                            
                            <small>{{ note.subject }} &middot; {{ note.published }}</small>
                        </div>
                    </div>
                    <router-link :to="{ name: 'home' }" class="d-block text-right mt-2">Back Home</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                note: []
            }
        },

        mounted() {
            this.getNote();
        },

        methods: {
            async getNote() {
                let response = await axios.get('/api/notes/' + this.$route.params.noteSlug);
                this.note = response.data.data;
            }
        }
    }
</script>