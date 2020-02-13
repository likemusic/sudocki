<template>

    <form action="#" method="POST" @submit="saveForm" @submit.prevent="">
        <div class="row">

            <div  class="container">
                <p v-if="discountInfo">{{discountInfo}} </p>
            </div>
            <ul class="list-group" style="width: 100%;" >
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="model in models">
                    <div class="f-b1"> {{model.name}} </div>
                    <div class="f-b2">{{model.quantity}}x{{model.price}} </div>
                    <div class="f-b3 d-flex justify-content-center"> <span> {{model.quantity * model.price}}грн. </span>
                    </div>
                </li>
            </ul>
        <div class="col-md-12" v-if="false">
            <div class="form-group pull-right">
                <button type="submit"       class="btn-primary btn">Save</button>
            </div>
        </div>
        </div>
    </form>
</template>

<script>
    import {eventEmitter} from "../app";
    export default {
        name: "OrderForm",
        props:[ ],
        created() {
          eventEmitter.$on('onSelectOrderModel',(dataModel)=>{
              this.clearModel();
              this.models=dataModel.detail;
              if(dataModel.discount_json){
                  let json=JSON.parse( dataModel.discount_json);
                  this.discountInfo= json.text
              }

            });
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                models:{},
                discountInfo:false,
            }
        },
        methods:{
            saveForm(e) {
                 e.preventDefault();
                },
            clearModel:function () {
                     this.models={}
                     this.discountInfo=false
            },

        },

    }

</script>

<style scoped>
    form{
        width: 100%;
    }
    .f-b1{
        flex-basis: 50%;
    }
    .f-b2{
        flex-basis: 20%;
    }
    .f-b3{
        flex-basis: 30%;
    }
</style>
