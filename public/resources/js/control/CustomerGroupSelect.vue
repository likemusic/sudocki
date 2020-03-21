<template>
    <div class="form-group">
        <label for="customer_group_id">Группа пользователей</label>

        <select class="form-control" name="customer_group_id" id="customer_group_id" v-model="selected">
            <option value="">{{ empty }}</option>
            <option v-for="group in groups" :value="group.ID">{{ group.NAME }}</option>
        </select>
    </div>
</template>

<script>
    import customerGroups from '../Domain/CustomerGroups';

    export default {
        name: "CustomerGroupSelect",
        props: {
            'value': {
                type: Number,
                default: ''
            },
            'empty': {
                type: String,
                default: 'Выберите группу пользователей'
            }
        },
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
