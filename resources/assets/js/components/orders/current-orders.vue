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

        <paginate
                v-model="currentPage"
                :page-count="lastPage"
                :page-range="10"
                :click-handler="paginate"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'">
        </paginate>
    </div>
</template>

<script>
    import axios from 'axios';
    import Paginate from 'vuejs-paginate'

    export default {
        name: "current-orders",
        data() {
            return {
                loading: false,
                orders: [],
                currentPage: 1,
                lastPage: 0,
            };
        },
        mounted() {
            this.getOrders();
        },
        methods: {
            getOrders() {
                this.loading = true;

                axios.get('/orders/current', {
                    params: {
                        page: this.currentPage
                    }
                }).then(res => {
                    this.orders = res.data.data;
                    this.currentPage = res.data.current_page;
                    this.lastPage = res.data.last_page;
                    this.loading = false;
                }).catch(e => {
                    console.error(e);
                })
            },
            paginate(page) {
                this.currentPage = page;
                this.getOrders();
            },
        },
        components: {
            Paginate,
        }
    }
</script>

<style scoped>

</style>