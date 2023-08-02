<template>
    <div class="coupons">

        <div 
            class="btn btn-primary w-100 mb-3"
            @click="generateCoupon()">
            Generate Coupon
        </div>

        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">Coupon</th>
                    <th scope="col">User</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="coupon in coupons.data">
                    <td>{{ coupon.coupon}}</td>
                    <td>{{ coupon.user}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                role="switch" 
                                id="user-status" 
                                :checked="coupon.status"
                                @change="updateStatus(coupon.id)">
                        </div>
                    </td>
                    <td>{{ coupon.created_at }}</td>
                </tr>
            </tbody>

        </table>

        <Bootstrap5Pagination
            :data="coupons"
            @pagination-change-page="getCoupons"/>

    </div>
</template>

<script>
import { Bootstrap5Pagination } from 'laravel-vue-pagination'

export default {
    components: {
        Bootstrap5Pagination
    },
    data() {
        return {
            coupons: [],
        }
    },
    methods: {
        getCoupons(page = 1) {
            this.$emit('loading')
            axios.get(`/api/admin/coupons/${page}`)
                .then(res => {
                    this.coupons = res.data
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        },
        generateCoupon() {
            this.$emit('loading')
            axios.post('/api/admin/coupons')
                .then(res => {
                    this.coupons.data.unshift(res.data.data)
                })
                .catch(res => {
                    console.log(res)
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        },
        updateStatus(id) {
            axios.patch(`/api/admin/coupons/${id}/status/update`)
        },
    },
    mounted() {
        this.getCoupons()
    },
    unmounted() {
        this.$emit('loaded')
    },
}
</script>