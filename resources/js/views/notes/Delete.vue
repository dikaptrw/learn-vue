<template>
    <button ref="deleteNote" @click.prevent="destroyNote" class="btn btn-danger text-white">
        Delete
    </button>
</template>

<script>
    export default {
        data() {
            return {
                'isDeleted': false
            }
        },

        props: ['endpoint'],
        
        mounted() {

        },

        methods: {
            async destroyNote() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then( async (willDelete) => {
                    if (willDelete) {
                        let response = await axios.delete(`/api/notes/${this.endpoint}/delete`);
                        if (response.status === 200) {

                            $(this.$refs.deleteNote).parent().parent().fadeOut('slow', function() {
                                $(this).remove();
                            });
                            swal({
                                title: "Note Deleted!",
                                text: "The note was successfully deleted!",
                                icon: "success",
                                button: 'Ok'
                            });
                        }
                    } else {
                        // swal("Cancel deleting, your note is safe!");
                    }
                });
            }
        }
    }
</script>

<style>
    .swal-modal .swal-text {
        text-align: center;
        padding: 0px 20px;
    }
    .swal-footer {
        text-align: center !important;
        margin-bottom: 15px;
    }
</style>