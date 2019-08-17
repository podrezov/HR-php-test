<template>
    <div>
        <div v-if="loading" class="text-center" title="Loading settings">
            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
        </div>

        <div v-else style="margin-top: 35px">
            <div>
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" :class="{active: isActive('all')}">
                        <a @click="setActive('all')" style="cursor: pointer">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> Все заказы
                        </a>
                    </li>
                    <li role="presentation" :class="{active: isActive('past_due')}">
                        <a @click="setActive('past_due')" style="cursor: pointer">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Просроченные
                        </a>
                    </li>
                    <li role="presentation" :class="{active: isActive('current')}">
                        <a @click="setActive('current')" style="cursor: pointer">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Текущие
                        </a>
                    </li>
                    <li role="presentation" :class="{active: isActive('new')}">
                        <a @click="setActive('new')" style="cursor: pointer">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Новые
                        </a>
                    </li>
                    <li role="presentation" :class="{active: isActive('completed')}">
                        <a @click="setActive('completed')" style="cursor: pointer">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Завершенные
                        </a>
                    </li>
                </ul>
            </div>

            <all-orders v-if="isActive('all')"></all-orders>
            <past-due v-if="isActive('past_due')"></past-due>
            <current-orders v-if="isActive('current')"></current-orders>
            <new-orders v-if="isActive('new')"></new-orders>
            <completed-orders v-if="isActive('completed')"></completed-orders>
        </div>
    </div>
</template>

<script>
    import PastDue from "./orders/past-due";
    import AllOrders from "./orders/all-orders";
    import CurrentOrders from "./orders/current-orders";
    import NewOrders from "./orders/new-orders";
    import CompletedOrders from "./orders/completed-orders";

    export default {
        name: "OrdersComponent",
        data() {
            return {
                loading: false,
                activeTab: 'all',
            }
        },
        methods: {
            setActive(tab) {
                this.activeTab = tab;
            },

            isActive(tab) {
                return this.activeTab === tab;
            }
        },
        components: {
            CompletedOrders,
            NewOrders,
            CurrentOrders,
            AllOrders,
            PastDue
        },
    }
</script>

<style scoped>

</style>