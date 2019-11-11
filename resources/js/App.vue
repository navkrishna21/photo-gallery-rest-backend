<template>
    <div> 
        <!-- Right Side Of Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav"> 
             
              <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
              
              <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
              
              <a class="nav-link"   v-if="isLoggedIn" :href="`/users/${authUser.id}`">Profile</a>

              <a class="nav-link" href="/users">Users</a>

              <a class="nav-link" href="/"  v-if="isLoggedIn"  @click="logout" >Logout </a>

              
            
            </div>
          </div>
        </nav>
        
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data(){
            return {

                isLoggedIn : null,
                authUser:""

            }
        },
        mounted(){
            
            this.isLoggedIn = localStorage.getItem('api_token')
            if(this.isLoggedIn){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.isLoggedIn

                this.fetchAuthenticatedUser(this.isLoggedIn)
            }
        },
        methods:{

            

            fetchAuthenticatedUser (token) {
                axios
                    .get('/api/user', {

                    })
                    .then(response => {

                        this.authUser = response.data


                        
                    })
            },
            logout () {
                localStorage.removeItem('api_token')

                this.$router.push('/login')
            }
        }
    }
</script>

<style>
    
    body {
    
        background-color: #f7f7f7;
        
        padding-bottom: 50px;
    }

    .is-danger {
        color: #9f3a38;
    }
</style>
