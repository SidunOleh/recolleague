<template>
    <div class="login">
        <div class="login__form">
            <div class="form-group mb-3">
                <label for="email">
                    Email address
                </label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email"
                    placeholder="Enter email"
                    v-model="email">
            </div>
            <div class="form-group mb-4">
                <label for="password">
                    Password
                </label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    placeholder="Password"
                    v-model="password">
            </div>
            <button 
                type="submit" 
                class="btn btn-primary"
                @click="logIn">
                Enter
            </button>
        </div>
    </div>
</template>

<script>
import router from '../../../routes/admin-panel'

export default {
    data() {
        return {
            email: null,
            password: null,
        }
    },  
    methods: {
        async logIn() {
            await axios.get('/sanctum/csrf-cookie')
            axios.post('/admin/login', this.$data)
                .then(res => {
                    localStorage.setItem('auth', true)
                    router.push({name: 'admin.dashboard'})
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
        }
    },
}
</script>

<style scoped>
.login {
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
}
.login__form {
    background-color: white;
    padding: 20px 20px;
    border-radius: 10px;
}
</style>