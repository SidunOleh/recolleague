<template>

    <div class="wrapper" ref="wrapper">

        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            Admin Panel
        </header>
        
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> 
                    <a href="/" class="nav_logo"> 
                        <i class='bx bx-layer nav_logo-icon'></i> 
                        <span class="nav_logo-name">REC</span> 
                    </a>
                    <div class="nav_list"> 

                        <router-link :to="{name: 'admin.dashboard'}" class="nav_link">
                            <i class='bx bx-grid-alt nav_icon'></i> 
                            <span class="nav_name">Dashboard</span> 
                        </router-link>

                        <router-link :to="{name: 'admin.chat-request.edit'}" class="nav_link">
                            <i class='bx bx-chat nav_icon'></i> 
                            <span class="nav_name">Chat request</span> 
                        </router-link>

                        <router-link :to="{name: 'admin.users.index'}" class="nav_link">
                            <i class='bx bx-user nav_icon'></i> 
                            <span class="nav_name">Users</span> 
                        </router-link>

                        <router-link :to="{name: 'admin.coupons.index'}" class="nav_link">
                            <i class='bx bxs-coupon nav_icon'></i> 
                            <span class="nav_name">Coupons</span> 
                        </router-link>

                        <router-link :to="{name: 'admin.content.edit'}" class="nav_link">
                            <i class='bx bx-data nav_icon'></i> 
                            <span class="nav_name">Content</span> 
                        </router-link>
                    
                    </div>
                </div> 
                <a class="nav_link logout" @click.prevent="logOut"> 
                    <i class='bx bx-log-out nav_icon'></i> 
                    <span class="nav_name">Log Out</span> 
                </a>
            </nav>
        </div>
        
        <div class="pt-3 pb-3">

            <router-view @loading="loading" @loaded="loaded" />
        
        </div>

    </div>
    
</template>

<script>
import router from '../../routes/admin-panel'

export default {
    methods: {
        loading() {
            this.$refs.wrapper.classList.add('loading')
        },
        loaded() {
            setTimeout(() => {
                this.$refs.wrapper.classList.remove('loading')
            }, 500)
        },
        logOut() {
            axios.post('/admin/logout')
                .then(res => {
                    localStorage.removeItem('auth')
                    router.push({name: 'admin.login'})
                })
                .catch(res => {
                    alert('Something goes wrong. Try again.')
                })
        },
    },
}
</script>

<style>
.logout {
    cursor: pointer;
}
</style>