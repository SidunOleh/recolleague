<template>
    <div class="latest-sendings">
        
        <div class="h3">Recent requests to chat</div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">URI</th>
                    <th scope="col">Style</th>
                    <th scope="col">House type</th>
                    <th scope="col">Sent</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="indexSending in indexSendings.data">
                    <td>{{ indexSending.email}}</td>
                    <td>{{ indexSending.uri }}</td>
                    <td>{{ indexSending.style }}</td>
                    <td>{{ indexSending.house_type }}</td>
                    <td>{{ indexSending.sent }}</td>
                </tr>
            </tbody>
        </table>

        <Bootstrap5Pagination
            :data="indexSendings"
            @pagination-change-page="getIndexSendings"/>

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
            indexSendings: [],
        }
    },
    methods: {
        getIndexSendings(page = 1) {
            this.$emit('loading')
            axios.get(`/api/admin/chat-request/sendings/${page}`)
                .then(res => {
                    console.log(res)
                    this.indexSendings = res.data
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        }
    },
    mounted() {
        this.getIndexSendings()
    },
    unmounted() {
        this.$emit('loaded')
    }
}
</script>