<template>
    <table class="table">
        <thead class=" text-primary">
        <p v-if="false">
            $table->integer('user_id')->nullable();
            $table->decimal('total',9,2)->default(0)->comment('Всего');
            $table->text('discount_json')->comment('Скидки');
            $table->integer('status')->default(0);
        </p>
        <th class="text-center">Ид</th>
        <th class="text-center">Дата</th>
        <th class="text-center">Сума</th>
        <th class="text-center">Состояние</th>
        </thead>
        <tbody ref="table_car">
        <tr class="row-hover-table" :class="{ active : active_el == order.id }" @click="activateTableRow(order.id ,$event)"  v-for="order in this.orders.data" >
            <td class="text-center">
                {{order.id}}
            </td>
            <td class="text-center">{{order.created_at}}</td>
            <td class="text-center">{{order.total}}</td>
            <td class="text-center">{{order.status | formatStatus }}</td>

        </tr>
        </tbody>
    </table>


</template>

<script>
    import {eventEmitter} from "../app";

    export default {
        name: "OrdersTable",
        props:[
            'orders',
        ],
        mounted() {
            //this.orders=this.orders.data
        },
        created() {
            // eventEmitter.$on('onCreatedDriverSalaryModel',(model)=>{
            //     let ind =_.findIndex(this.salariesList, {id: model.id});
            //     if( ind > -1){
            //         model.name= model.user.name
            //         Vue.set(this.salariesList, ind, model)
            //     }
            // });
            // eventEmitter.$on('onUpdatedDriverModel',(model)=>{
            //      let ind =_.findIndex(this.users, {id: model.id});
            //     if( ind > -1){
            //         Vue.set(this.users, ind, model)
            //      }
            // });
        },
        data(){
            return  {
                active_el:0,
            }
        },
        methods:{
            // отмечаем цветом строку и шлем новую модел в CarForm
            activateTableRow(idRef,event){
                this.active_el = idRef;
                this.clearActiveTableRow();
                this.sentModelToForm(idRef);
            },
            clearActiveTableRow(){
                _.forEach(document.getElementsByClassName('row-hover-table'), function(elemento) {
                    elemento.classList.remove("active");
                });
            },
            sentModelToForm:function (idModel) {
                axios.get('/orders/'+idModel)
                    .then(function (resp) {
                        eventEmitter.$emit('onSelectOrderModel',resp.data);
                        console.log(resp.data)
                    })
                    .catch(function (resp) {
                        console.log(resp)
                        thToaster.e('Some Error')
                    });
            },
        },
        filters:{
            formatStatus(status){
                // todo связать с конфигом
                     if(status===0){
                         return 'В обработке'
                     }
                if(status===1){
                    return 'Обработан'
                }
                    return '-----'
            }
        }
    }


</script>

<style scoped>

</style>
