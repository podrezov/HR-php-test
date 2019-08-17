<template>
    <div class="table-responsive">
        <table class="table table-striped table-condensed table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Партнер</th>
                <th>Стоимость</th>
                <th>Продукты</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            <tr v-if="loading">
                <td colspan="5" class="text-center">
                    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                </td>
            </tr>
            <tr v-else v-for="order in orders">
                <td>
                    <a :href="'orders/' + order.id + '/edit'" target="_blank">{{ order.id }}</a>
                </td>
                <td>
                    {{ order.partner.name }}
                </td>
                <td>
                    {{ order.total_price }}
                </td>
                <td>
                    <li v-for="product in order.products">{{ product.name }} x {{ product.pivot.quantity }}</li>
                </td>
                <td>
                    {{ order.status }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "past-due",
        data() {
            return {
                loading: false,
                orders: [],
            };
        },
        mounted() {
            this.getOrders();
        },
        methods: {
            getOrders() {
                this.loading = true;

                axios.get('/orders/past-due')
                    .then(res => {
                        this.orders = res.data;
                        this.loading = false;
                    }).catch(e => {
                    console.error(e);
                })
            },
        },
    }
</script>

<style scoped>

</style>