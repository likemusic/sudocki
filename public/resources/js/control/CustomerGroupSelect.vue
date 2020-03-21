<template>
    <div class="form-group">
        <label for="customer-group">Группа пользователей</label>

        <select class="form-control" name="customer-group" id="customer-group" v-model="selected">
            <option v-for="group in groups" :value="group.ID">{{ group.NAME }}</option>
        </select>
    </div>
</template>

<script>
    import customerGroups from '../Domain/CustomerGroups';

    export default {
        name: "CustomerGroupSelect",
        props: ['value'],
        data: function () {
            return {
                groups: customerGroups,
            }
        },
        computed: {
            selected: {
                get: function () {
                    return this.$props.value;
                },
                set: function (value) {
                    this.$emit('input', value)
                }
            }
        }
    }
</script>

<style scoped>

</style>
