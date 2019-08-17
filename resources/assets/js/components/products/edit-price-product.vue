<template>
    <input type="number" :value="price" @keyup.enter="edit">
</template>

<script>
    import axios from 'axios';

    export default {
        name: "edit-price-product",
        props: {
            price: Number,
            endpoint: String,
        },
        methods: {
            edit(e) {
                axios.post(this.endpoint, {
                    price: e.target.value
                }).then(res => {
                    alert('Цена успешно изменена');
                }).catch(e => {
                    console.error(e);
                })
            }
        }
    }
</script>

<style scoped>

</style>