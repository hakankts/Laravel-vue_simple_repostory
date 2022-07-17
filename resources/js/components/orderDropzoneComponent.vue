<template>

    <div >

        <div >

            <div >

                <div >

                    <div >Laravel Vue JS File Upload Example - ItSolutionStuff.com</div>

                    <div >

                        <div v-if="success != ''"  role="alert">

                          {{success}}

                        </div>

                        <form @submit="formSubmit" enctype="multipart/form-data">

                        <strong>Name:</strong>

                        <input type="text"  v-model="name">

                        <strong>File:</strong>

                        <input type="file"  v-on:change="onFileChange">

                        <button >Submit</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>

    export default {

        mounted() {

            console.log('Component mounted.')

        },

        data() {

            return {

              name: '',

              file: '',

              success: ''

            };

        },

        methods: {

            onFileChange(e){

                console.log(e.target.files[0]);

                this.file = e.target.files[0];

            },

            formSubmit(e) {

                e.preventDefault();

                let currentObj = this;

                const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

                formData.append('file', this.file);

                axios.post('/formSubmit', formData, config)

                .then(function (response) {

                    currentObj.success = response.data.success;

                })

                .catch(function (error) {

                    currentObj.output = error;

                });

            }

        }

    }

</script>