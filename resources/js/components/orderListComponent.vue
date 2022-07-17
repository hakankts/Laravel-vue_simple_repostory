<template>        
    <div class="container">
        <div class="row justify-content-center">          
            <div class="col-md-12">
                <div v-for="item in items" :key="item.id" class="card col-md-4" style="float:left;">                
                <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ item.part_code }}</li>
                    <li class="list-group-item">{{ item.part_name }}</li>
                    <li class="list-group-item">{{ item.gross_price }}</li>                    
                    <li class="list-group-item">{{ item.last_price }}</li>                                        
                </ul>                
                <button id="show-modal" @click="openModal(item.id)" class="btn btn-warning">Detail</button>
            </div>
            </div>
            </div>
        </div> 
         <modalDetail :modalId="showModalId" v-if="showModal" @close="showModal = false">                
                    <h3 slot="header"></h3>
        </modalDetail>       
    </div>    
</template>

<script>
import axios from 'axios'

export default{
    data(){
        return{
            items:[],
            showModalId:0,
            showModal:false
        }
    },
    created(){
        this.getData();
    },
    methods:{
        getData(){
            axios.get('http://my.local/api/order_list')
            .then((response)=>{
                this.items = response.data;
            })
        },
        openModal: function(id){                   
                //console.log(id);
                this.showModalId = id;
                this.showModal=true;                                
            }   
    }
}    
</script>