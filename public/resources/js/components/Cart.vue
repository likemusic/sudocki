<template>
    <form @submit="saveForm" @submit.prevent="" action="#" class="card card-plainxxx" method="POST">
        <div class="card-header">
            <h4 class="card-title"> Корзина : <span class="sp-price">{{calculateTotal() }} </span></h4>
            <span class="green-color" v-if="currentDiscountSum">Вы економите {{ currentDiscountSum }}грн. <br></span>
            <span class="green-color" v-if="discount1.showDiscount">Для {{discount1.discountPercent}}% скидки  доберите товара на {{discount1.discountSum}} грн.</span>
            <span class="green-color" v-if="discount2.showDiscount">Для {{discount2.discountPercent}}% скидки  доберите товара на {{discount2.discountSum}} грн.</span>
            <span class="green-color" v-if="discount3.showDiscount">Для {{discount3.discountPercent}}% скидки  доберите товара на {{discount3.discountSum}} грн.</span>
        </div>

        <div class="card-body p-0">
            <ul class="list-group" style="width: 100%;">
                <li class="list-group-item d-flex justify-content-between align-items-center p-0"
                    v-for="model in models">
                    <div class="f-b80 d-flex flex-wrap">
                        <div class="f f-b100">{{model.name}}</div>
                        <div class="f f-b50">{{model.count}}x{{model.price}}</div>
                        <div class="f f-b50">{{(model.count * model.price).toFixed(2)}}</div>
                    </div>
                    <div class="f f-b20 d-flex justify-content-between align-items-center">
                        <button @click="removeModel(model.id)" class="btn btn-sm btn-icon " type="button"><i
                            class="now-ui-icons ui-1_simple-remove"></i></button>
                    </div>
                </li>
            </ul>
        </div>

        <div class="card-footer text-right">
            <button class="btn-primary btn" type="submit" v-if="models.length>0">Добавить</button>
        </div>
    </form>
</template>

<script>
    import {eventEmitter} from "../app";
    import _ from 'lodash'

    export default {
        name: "Cart",
        props: [],
        created() {
            this.trailerlist = {}
            eventEmitter.$on('onChangeNumberInput', (model) => {
                let ind = _.findIndex(this.models, {id: model.id});
                if (ind > -1) {
                    if (model.count) {
                        Vue.set(this.models, ind, model)
                    } else {
                        this.models.splice(ind, 1);
                    }
                } else {
                    // let tmp={id:11,name:'lorem lorem',count:24,price:25 }
                    this.models.push(model)
                }
            });
        },
        data() {
            return {
                models: [],
                discount1: {
                    discountSum: 1000,
                    discountPercent: 3,
                    showDiscount: true,
                },
                discount2: {
                    discountSum: 2000,
                    discountPercent: 5,
                    showDiscount: false,
                },
                discount3: {
                    discountSum: 3000,
                    discountPercent: 7,
                    showDiscount: false,
                },
                currentDiscountSum: 0,
            }
        },
        methods: {
            calculateTotal: function () {
                let total = 0;
                total = _.sumBy(this.models, function (m) {
                    return (m.count * m.price);
                });
                return (total - this.showDiscount(total)).toFixed(2) + 'грн.';
            },
            showDiscount: function (total) {
                if (total >= this.discount3.discountSum) {
                    this.discount2.showDiscount = false;
                    this.discount1.showDiscount = false;
                    this.discount3.showDiscount = false;
                    return this.calculateShowDiscount(total, this.discount3.discountPercent)
                } else if (total >= this.discount2.discountSum) {
                    this.discount2.showDiscount = false;
                    this.discount1.showDiscount = false;
                    this.discount3.showDiscount = true;
                    return this.calculateShowDiscount(total, this.discount2.discountPercent)
                } else if (total >= this.discount1.discountSum) {
                    this.discount2.showDiscount = true;
                    this.discount1.showDiscount = false;
                    this.discount3.showDiscount = false;
                    return this.calculateShowDiscount(total, this.discount1.discountPercent)
                } else {
                    this.discount2.showDiscount = false;
                    this.discount1.showDiscount = true;
                    this.discount3.showDiscount = false;
                    return this.currentDiscountSum = 0;
                }


            },
            calculateShowDiscount: function (total, percent) {
                return this.currentDiscountSum = (total * percent / 100).toFixed(2)
            },
            removeModel: function (id) {
                let ind = _.findIndex(this.models, {id: id});
                if (ind > -1) {
                    this.models.splice(ind, 1);
                    eventEmitter.$emit('onRemoveModel', id);
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
                        if (resp.data.status == 'created') {
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
            clearCart: function () {
                this.models = [];
            },
            sentToTable(carModel, status) {
                if (status == 'created') {
                    eventEmitter.$emit('onCreatedCarModel', carModel)
                } else if (status == 'updated') {
                    eventEmitter.$emit('onUpdatedCarModel', carModel)
                }


            }

        },
        computed: {}

    }

</script>

<style scoped>
    .card-body {
        max-height: calc(100vh - 18em);
        overflow: auto;
    }

    .f {
        padding: 0.5em;
    }

    .f-b100 {
        flex-basis: 100%;
    }

    .f-b50 {
        flex-basis: 50%;
    }

    .f-b80 {
        flex-basis: 80%;
    }

    .f-b20 {
        flex-basis: 20%;
    }

    .f-b30 {
        flex-basis: 30%;
    }

    .btn.btn-sm.btn-icon {
        padding: 0;
        margin: 0;
    }

    .green-color {
        color: #336133;
        font-size: smaller;
    }
</style>
