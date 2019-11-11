<template>
    <div>
        
        <div class="ui bottom attached menu">
            <router-link class="item" to="/">
                <i class="home icon"></i>
            </router-link>
            <router-link class="item" :to="`/${user.username}`">Profile</router-link>
            <router-link class="item" to="/settings/profile">Settings</router-link>
            <a class="item"><i class="sign out icon"></i></a>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'UserSidebar',
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data () {
          
        },
        
    }
</script>