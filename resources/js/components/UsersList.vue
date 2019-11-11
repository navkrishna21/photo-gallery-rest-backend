<template>
    <div class="container">
       <h2>Users List</h2>
       
       <div v-for="(user,index2) in users" :key="index2" >
            <div v-if="user.data">
                <ul>
                    <li><a :href="`/users/${user.data.id}`">{{user.data.username}}</a></li>    
                </ul>
                 
            </div>
       </div>

       
           
       </a>
    </div>
</template>

<script>
    export default {

        name : 'UsersList',


        data(){
              return {
                
                users: '',
              
              }
            },
        
        mounted() {
            
            const token = localStorage.getItem('api_token')
            
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            
            axios.get('/api/users')
            .then(response => {   
                                  
                    this.users = response.data     
                    console.log(this.users)
            
            })
        }
    }
</script>
