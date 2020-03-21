<template>


    <table class="table">
        <thead class=" text-primary">
        <th class="text-center hidden" v-if="false">
            Ид
        </th>
        <th class="text-center">
            Фио
        </th>
        <th  class="text-center">
            Телефон
        </th>
        <th  class="text-center">
            E-mail
        </th>
        <th class="text-center">
            Заказы
        </th>
        <th class="text-center">
            Сума заказов
        </th>
        </thead>

        <tbody ref="table_car">
        <tr class="row-hover-table" :class="{ active : active_el == user.id }" @click="activateTableRowCar(user.id ,$event)"  v-for="user in users" >
            <td class="text-center " v-if='false'> {{user.id}} </td>
            <td class="text-center">  {{user.name}} <br> {{user.fname}} <br> {{user.sname}} </td>
            <td class="text-center">{{user.phone}}</td>
            <td class="text-center">{{user.email}}</td>
            <td class="text-center">
                <a href="" class="green">0</a>-<a class="blue" href="">0</a>-<a class="red"
                href="">0</a>
            </td>
            <td class="text-center">0</td>
        </tr>
        </tbody>
    </table>

</template>

<script>
    import {eventEmitter} from "../app";

    export default {
        name: "CustomerTable",
        props:[
            'userlist'
        ],
        mounted() {
            this.users=this.userlist.data
        },
        created() {
            eventEmitter.$on('onCreatedDriverModel',(model)=>{
                this.users.unshift(model)
                this.clearActiveTableRow();
            });
            eventEmitter.$on('onUpdatedDriverModel',(model)=>{
                 let ind =_.findIndex(this.users, {id: model.id});
                if( ind > -1){
                    Vue.set(this.users, ind, model)
                 }
            });
        },
        data(){
            return  {
                active_el:0,
                users:{}
            }
        },
        methods:{
            // отмечаем цветом строку и шлем новую модел в CarForm
            activateTableRowCar(idRef,event){
                this.active_el = idRef;
                this.clearActiveTableRow();
                this.sentCarModelToForm(idRef);
            },
            clearActiveTableRow(){
                _.forEach(document.getElementsByClassName('row-hover-table'), function(elemento) {
                    elemento.classList.remove("active");
                });
            },
            sentCarModelToForm:function (idDriver) {
                axios.get('/customers/'+idDriver)
                    .then(function (resp) {
                        const randCustomerGroupId = Math.floor(Math.random() * 5);
                        // Vue.set(resp.data, propertyName, value):
                        resp.data['customer_group_id'] = randCustomerGroupId;
                        eventEmitter.$emit('onSelectCustomerModel',resp.data);
                    })
                    .catch(function (resp) {
                        console.log(resp)
                        thToaster.e('Some Error')
                    });
            },
        }
    }


</script>

<style scoped>
 .green{
     color: green;
 }
    .red{
        color: red;
    }
    .blue{
        color: blue;
    }
</style>
