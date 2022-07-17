<template>        
    <div class="container">
        <div class="row justify-content-center">          
            <div class="col-md-12">
                <div v-for="err in errors">                    
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ err }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                        
                </div> 
                <div class="card">
                    <div class="card-header">New Order </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="user_id" v-model="user_id">
                                <input type="text" class="form-control" v-model="part_code" placeholder="Part Code" aria-label="Parça Kodu">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="part_name" placeholder="Part Name" aria-label="Parça Adı">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="gross_price" placeholder="Price" aria-label="sitem">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="last_price" placeholder="Last Price" aria-label="gerçek">
                            </div>
                            <div class="col">                                
                                <input class="form-check-input" type="radio" name="order_status" v-model="order_status" value="1"> Yes
                                <input class="form-check-input" type="radio" name="order_status" v-model="order_status" value="2"> No
                                <input class="form-check-input" type="radio" name="order_status" v-model="order_status" value="3"> Cancel
                            </div>                            
                        </div>                                                
                    </div>
                    <div class="card-body">
                        <div class="row">
                             <div class="col">                                
                                <button @click="saveForm" type="button" class="btn btn-success">Tamam</button>
                            </div>   
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        props: ['app'],
        data(){
            return{
                errors:[],
                user_id: this.$userId, 
                part_code: null,
                part_name: null,
                gross_price: null,
                last_price: null,
                order_status: null,
                file: null
            }
        },
        mounted() {           
            
        },
        methods:{ 
            onChange(e) {
                this.file = e.target.files[0];
            },
            saveForm:function(){
                if( this.part_code && this.part_name){                                                            

                    axios.post('http://my.local/api/order_save',{
                        user_id : this.user_id,
                        part_code: this.part_code,
                        part_name: this.part_name,
                        gross_price: this.gross_price,
                        last_price: this.last_price,
                        order_status : this.order_status                        
                    }).then((response)=>{
                        this.errors = [];  
                        this.part_code='';    
                        this.part_name='';                      
                        this.gross_price='';
                        this.last_price='';        
                        return this.errors.push(response.data['message']);                        
                    })
                } else{                    
                    return this.errors.push('Eksik verileri giriniz.');
                }
            }
        }
    }
</script>
