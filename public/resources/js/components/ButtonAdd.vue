<template>

    <div class="wrap">
        <vue-numeric-input v-on:input="changeNumeric"  v-model="count" :min="0" :max="1000" size="70px"></vue-numeric-input>
    </div>


</template>

<script>
    import {eventEmitter} from "../app";
    import VueNumericInput from 'vue-numeric-input'
    export default {
        components: {
            VueNumericInput
        },
        name: "ButtonAdd",
        props:['id','base_count','product'],
        created() {
            this.count= this.base_count;
            this.price= this.product.price;
          eventEmitter.$on('onRemoveModel',(model_id)=>{

              if(this.id===model_id){
                  // console.log('catch ', model_id)
              this.count=0;
              }
                    //this.car=dataCar;
            });
        },
        data() {
            return {
                count:0,
                price:false,
            }
        },
        methods:{
            changeNumeric:function(){
                // let tmp={id:11,name:'lorem lorem',count:24,price:25 }
                eventEmitter.$emit('onChangeNumberInput',{id: this.$props.id,name:this.$props.product.name, count:this.count,price:this.$props.product.price })
            },


            addToCart(e) {
                 e.preventDefault();
                let th = this
                var newCar = th.car;
                let thToaster = this.$toastr; // s,e,w,i .e("ERRROR"); .w("WARNING");.i("INFORMATION MESSAGE");
                axios.post('/cars', newCar)
                    .then(function (resp) {
                        thToaster.s(resp.data.message);
                        if(resp.data.status =='created'){
                            th.clearCar();
                        }
                            th.sentToTable(resp.data.model,resp.data.status)
                    })
                    .catch(function (resp) {
                        console.log(resp)
                        thToaster.e('Some Error')
                    });
            return false;
                },
            clearCar:function () {
                      this.car={number: '', model: '', trailer_id:'', brand: '', status_work: '', status_archive: '',};
            },
            sentToTable(carModel,status){

                if(status =='created'){
                    eventEmitter.$emit('onCreatedCarModel',carModel)
                }else if(status =='updated'){
                    eventEmitter.$emit('onUpdatedCarModel',carModel)
                }
            }

        },

    }

</script>

<style >
    .vue-numeric-input.updown {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .vue-numeric-input.updown .numeric-input {
        padding-right: 5px !important;
        padding-left: 5px !important;
    }
   .vue-numeric-input.updown .btn {
        background: #6fbbff !important;
    }
    .vue-numeric-input.updown .btn-increment {
        height: 1.5rem;
        width: 100%;
        right: 0 !important;
        left:0 !important;
        top: 0 !important;
        bottom: auto !important;
        padding: 0!important;

    }
    .vue-numeric-input.updown .btn-decrement {
        height: 1.5rem;
        width: 100%;
        left: 0 !important;
        right: 0 !important;
        top: auto !important;
        bottom: 0 !important;
        padding: 0!important;
    }
    .vue-numeric-input input{
        text-align:center!important;
    }

    .vue-numeric-input button{
        padding: 0!important;
    }
    .wrap{
        display: flex;
        justify-content: space-around;
        align-items: center;
    }


</style>
