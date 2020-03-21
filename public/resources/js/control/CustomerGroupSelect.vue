<template>
    <div class="form-group">
        <label for="customer-group">Группа</label>

        <select class="form-control" name="customer-group" id="customer-group" v-model="customer_group_id">
            <option v-for="group in groups" :value="group.ID">{{ group.NAME }}</option>
        </select>
    </div>
</template>

<script>
    import customerGroups from '../Domain/CustomerGroups';

    export default {
        name: "CustomerGroupSelect",
        props: ['customer_group_id'],
        data: function () {
            return {
                groups: customerGroups,
                // selected: this.customer_group_id,
            }
        }
    }
</script>

<style scoped>

</style>
