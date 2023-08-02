<template>

    <div class="users">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Last request</th>
                    <th scope="col">Requests count</th>
                    <th scope="col">Payment method</th>
                    <th scope="col">Last four number</th>
                    <th scope="col">Registred</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data">
                    <td>{{ user.name}}</td>
                    <td>{{ user.email}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                role="switch" 
                                id="user-status" 
                                :checked="user.is_active"
                                @change="updateStatus(user.id)">
                        </div>
                    </td>
                    <td>{{ user.last_request }}</td>
                    <td>{{ user.requests_count }}</td>
                    <td>{{ user.pm_method }}</td>
                    <td>{{ user.pm_last_four }}</td>
                    <td>{{ user.registred }}</td>
                    <td 
                        class="delete-user text-danger"
                        title="Delete"
                        @click="deleteUser(user.id)">
                        x
                    </td>
                </tr>
            </tbody>
        </table>

        <Bootstrap5Pagination
            :data="users"
            @pagination-change-page="getUsers"/>

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
            users: [],
        }
    },
    methods: {
        getUsers(page = 1) {
            this.$emit('loading')
            axios.get(`/api/admin/users/${page}`)
                .then(res => {
                    console.log(res)
                    this.users = res.data
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
                .finally(() => {
                    this.$emit('loaded')
                })
        },
        updateStatus(userId) {
            axios.patch(`/api/admin/users/${userId}/status/update`)
        },
        deleteUser(userId) {
            if(! confirm('Are you sure?')) return

            axios.delete(`/api/admin/users/${userId}`)
                .then(res => {
                    this.users.data = 
                        this.users.data.filter(user => user.id != userId)
                })
        },
    },
    mounted() {
        this.getUsers()
    },
    unmounted() {
        this.$emit('loaded')
    },
}
</script>

<style scoped>
.users table {
    min-width: 1024px;
}
.delete-user {
    cursor: pointer;
}
</style>