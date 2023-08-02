<template>
    <div class="latest-sendings">
        
        <div class="h3">Recent requests to chat</div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">URI</th>
                    <th scope="col">Style</th>
                    <th scope="col">Sent</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="latestSending in latestSendings">
                    <td>{{ latestSending.email}}</td>
                    <td>{{ latestSending.uri }}</td>
                    <td>{{ latestSending.style }}</td>
                    <td>{{ latestSending.sent }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default {
    data() {
        return {
            latestSendings: [],
        }
    },
    methods: {
        getLatestSendings() {
            this.$emit('loading')
            axios.get('/api/admin/chat-request/sendings/latest')
                .then(res => {
                    this.latestSendings = res.data.data
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
        this.getLatestSendings()
    },
    unmounted() {
        this.$emit('loaded')
    }
}
</script>