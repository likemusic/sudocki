<template>

    <div class="card card-plainxxx" style="position: fixed; width: auto; min-width: 17%;">
        <div class="card-header">
            <h4 class="card-title"> Корзина   :  <span class="sp-price">{{calculateTotal() }} </span>  </h4>
            <span class="green-color" v-if="currentDiscountSum">Вы економите {{ currentDiscountSum }}грн. <br></span>
            <span class="green-color" v-if="discount1.showDiscount">Для {{discount1.discountPercent}}% скидки  доберите товара на {{discount1.discountSum}} грн.</span>
            <span class="green-color" v-if="discount2.showDiscount">Для {{discount2.discountPercent}}% скидки  доберите товара на {{discount2.discountSum}} грн.</span>
            <span class="green-color" v-if="discount3.showDiscount">Для {{discount3.discountPercent}}% скидки  доберите товара на {{discount3.discountSum}} грн.</span>
        </div>


        <div class="card-body">
            <div class="container">
                <div class="row">

                    <form action="#" method="POST" @submit="saveForm" @submit.prevent="">
                        <div class="row">
                            <ul class="list-group" style="width: 100%;" >
                                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="model in models">
                                    <div class="f-b1"> {{model.name}} </div>
                                    <div class="f-b2">{{model.count}}x{{model.price}} </div>
                                    <div class="f-b3 d-flex justify-content-between align-items-center"> <span> {{model.count * model.price}} </span>  <button @click="removeModel(model.id)" type="button" class="btn btn-sm btn-icon "><i class="now-ui-icons ui-1_simple-remove"></i></button></div>
                                </li>
                            </ul>

                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <button type="submit"  v-if="models.length>0"      class="btn-primary btn">Добавить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    </div>


</template>

<script>
    import {eventEmitter} from "../app";
    import _ from 'lodash'

    export default {
        name: "Cart",
        props:[],
        created() {
            this.trailerlist={}
          eventEmitter.$on('onChangeNumberInput',(model)=>{
                  let ind =_.findIndex(this.models, {id: model.id});
                  if( ind > -1){
                      if(model.count){
                          Vue.set(this.models, ind, model)
                      }else{
                          this.models.splice(ind,1);
                      }
                  }else{
                       // let tmp={id:11,name:'lorem lorem',count:24,price:25 }
                      this.models.push(model)
                  }
            });
        },
        data() {
            return {
                models:[],
                discount1:{
                    discountSum:1000,
                    discountPercent:3,
                    showDiscount:true,
                },
                discount2:{
                    discountSum:2000,
                    discountPercent:5,
                    showDiscount:false,
                },
                discount3:{
                    discountSum:3000,
                    discountPercent:7,
                    showDiscount:false,
                },
                currentDiscountSum:0,
        }
        },
        methods:{
            calculateTotal:function(){
                let total=0;
                total= _.sumBy(this.models, function(m) { return (m.count*m.price); });
                return ( total-this.showDiscount(total))   .toFixed(2)+'грн.';
            },
            showDiscount:function(total){
               if(total>= this.discount3.discountSum){
                   this.discount2.showDiscount=false;
                   this.discount1.showDiscount=false;
                   this.discount3.showDiscount=false;
                  return  this.calculateShowDiscount(total, this.discount3.discountPercent)
               }else if(total>=this.discount2.discountSum){
                   this.discount2.showDiscount=false;
                   this.discount1.showDiscount=false;
                   this.discount3.showDiscount=true;
                  return  this.calculateShowDiscount(total, this.discount2.discountPercent)
               }else if(total>=this.discount1.discountSum){
                   this.discount2.showDiscount=true;
                   this.discount1.showDiscount=false;
                   this.discount3.showDiscount=false;
                   return  this.calculateShowDiscount(total, this.discount1.discountPercent)
               }else{
                   this.discount2.showDiscount=false;
                   this.discount1.showDiscount=true;
                   this.discount3.showDiscount=false;
                return    this.currentDiscountSum=0;
               }


            },
            calculateShowDiscount:  function(total,percent){
              return   this.currentDiscountSum=(total*percent /100 ).toFixed(2)
            },
            removeModel:function(id){
                let ind =_.findIndex(this.models, {id: id});
                if( ind > -1){
                    this.models.splice(ind,1);
                    eventEmitter.$emit('onRemoveModel',id);
                }
            },


            saveForm(e) {
                 e.preventDefault();
                let th = this
                let newModels = th.models;
                let thToaster = this.$toastr; // s,e,w,i .e("ERRROR"); .w("WARNING");.i("INFORMATION MESSAGE");
                axios.post('/orders', newModels)
                    .then(function (resp) {
                        thToaster.s(resp.data.message);
                        if(resp.data.status =='created'){
                            th.clearCart();
                        }
                         //   th.sentToTable(resp.data.model,resp.data.status)
                    })
                    .catch(function (resp) {
                        console.log(resp)
                        thToaster.e('Some Error')
                    });
            return false;
                },
            clearCart:function () {
                      this.models=[];
            },
            sentToTable(carModel,status){
                if(status =='created'){
                    eventEmitter.$emit('onCreatedCarModel',carModel)
                }else if(status =='updated'){
                    eventEmitter.$emit('onUpdatedCarModel',carModel)
                }



            }

        },
        computed:{}

    }

</script>

<style scoped>
.f-b1{
    flex-basis: 50%;
}
.f-b2{
    flex-basis: 20%;
}
.f-b3{
    flex-basis: 30%;
}
.btn.btn-sm.btn-icon{
    padding:0;
    margin:0;
}
.green-color{
    color: #336133;
    font-size: smaller;
}
</style>
