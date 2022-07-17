<template>
<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">          

            <div class="modal-body">                    
                <p v-if="data.image_name"> <img :key="data.image_name" :src="`/upload//${data.image_name}`" width="200px"> </p>        
                <p>ID: {{data.id}}</p>        
                <p>Code: {{data.part_code}}</p>
                <p>Name: {{data.part_name}}</p>
                <p>Price: {{data.gross_price}}</p>
                <p>Last Price: {{data.last_price}}</p>
            </div>
         
            <div>

                <div v-if="success != ''"  role="alert">

                    {{success}}

                </div>

                <form @submit="formSubmit" enctype="multipart/form-data">
                    
                    <input type="hidden" v-model="name">
                    <strong>File:</strong>
                    <input type="file"  v-on:change="onFileChange">
                    <button >Add</button>

                </form>

            </div>
          
          <div class="modal-footer">
            <slot name="footer">              
              <button class="modal-default-button" @click="$emit('close')">
                Close
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
    import axios from 'axios';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';

  export default {
      props:['modalId'], 
      components: {
        vueDropzone: vue2Dropzone
      },
      data(){
        return{
            data:[],
            product_id:'',
            name:'',           
            file: '',
            success: ''
        }
      },     
      created(){              
              axios.get('http://my.local/api/detailData/'+this.modalId )
                .then((response)=>{             
                    this.data = response.data;                      
                    //console.log(this.data);
                })

      },
      mounted(){
        //console.log(this.data);
      },
      methods: {

            onFileChange(e){

                console.log(this.data.id);               
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
                formData.append('product_id', this.data.id);              
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