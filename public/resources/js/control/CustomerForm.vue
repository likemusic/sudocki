<template>

    <form action="#" method="POST" @submit="saveForm" @submit.prevent="">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fname">Фамилия</label>
                    <input type="text" class="form-control"  id="fname"  v-model="driver.fname" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control"  id="name"  v-model="driver.name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sname">Отчество</label>
                    <input type="text" class="form-control"  id="sname"  v-model="driver.sname" required>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" v-model="driver.email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <the-mask
                        class="form-control" v-model="driver.phone" type="tel" name="phone" required id="phone"  masked="masked"   placeholder="Телефон" data-reload-payment-form="true"
                        mask="+### (##) ###-##-##" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="certificate">Пароль</label>
                    <input type="text" class="form-control" name="certificate" v-model="driver.password" id="certificate">
                </div>
            </div>




        <div class="col-md-12">
            <div class="form-group pull-right">
                <button type="submit"       class="btn-primary btn">Save</button>
            </div>
        </div>
        </div>
    </form>
</template>

<script>
    import {eventEmitter} from "../app";
    import _ from "lodash";
    export default {
        name: "CustomerForm",
        props:[ ],
        created() {
          eventEmitter.$on('onSelectCustomerModel',(dataDriver)=>{
                    this.driver=dataDriver;
            });
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                driver:{
                    id: false,
                    name: '',
                    fname: '',
                    sname: '',
                    email: '',
                    phone: '',
                    certificate: '',
                    category: '',
                    address: '',
                },
                masked:true
            }
        },
        methods:{
            saveForm(e) {
                 e.preventDefault();
                let th = this
                var newDriver = th.driver;
                let thToaster = this.$toastr; // s,e,w,i .e("ERRROR"); .w("WARNING");.i("INFORMATION MESSAGE");
                axios.put('/customers/'+newDriver.id, newDriver)
                    .then(function (resp) {
                        if(resp.data.status =='warning'){
                            thToaster.w(resp.data.message);
                            return;
                        }
                        thToaster.s(resp.data.message);

                        if(resp.data.status =='created'){
                            th.clearModel();
                        }
                            th.sentToTable(resp.data.model,resp.data.status)
                    })
                    .catch(function (error) {
                        console.log(error.response.data)
                        let msg = _.values(error.response.data.errors)[0];
                        thToaster.e('Some Error ' +msg)
                    });
            return false;
                },
            clearModel:function () {
                     this.driver={name: '', email: '', phone: '', certificate: '', category: '', address: '',}
            },
            sentToTable(carModel,status){
                if(status =='created'){
                    eventEmitter.$emit('onCreatedDriverModel',carModel)
                }else if(status =='updated'){
                    eventEmitter.$emit('onUpdatedDriverModel',carModel)
                }
            }
        },

    }

</script>

<style scoped>

</style>
