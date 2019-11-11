<template>
    <div class="container">
        <h2>User Information</h2>  
        
        <div>
        Username:
        <input type="text" ref="username" :value="user.username" :disabled="true"
               :class="{view: true}">
        </div>

        <div>
        First Name:
        <input type="text" ref="first_name" :value="user.first_name" :disabled="!isEditing"
               :class="{view: !isEditing}">
        </div>

        <div>
        Last Name:
        <input type="text" ref="last_name" :value="user.last_name" :disabled="!isEditing"
               :class="{view: !isEditing}">  
        </div>
        
        <div>
        Email:
        <input type="text" ref="email" :value="user.email" :disabled="!isEditing"
               :class="{view: !isEditing}">  
        </div>
        
        <button @click="isEditing = !isEditing" v-if="!isEditing && user.id==authUser.id">
        Edit
        </button>
        <button @click="save" v-else-if="isEditing">
        Save
        </button>

        <button v-if="isEditing" @click="isEditing = false">Cancel</button>

        <AddAlbum v-if="user.id==authUser.id" @change="change" ></AddAlbum>
        <Albums :albums="albums"></Albums>

        

    </div>
</template>

<script>

    import Albums from '../Albums';
    import AddAlbum from '../AddAlbum';
    export default{
        
        name: 'UserProfile',

        components: {
              
              'AddAlbum':AddAlbum,

              'Albums': Albums,
        },

        data(){
            
            return {
                
                isEditing: false,
                
                user: {type:Object} ,

                albums : {type:Array},
                
                authUser:{type:Object},
            };
        },

        mounted () {
            

            this.fetchUser(this.$route.params.userid)

            const token = localStorage.getItem('api_token')
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token


            if (token) {
                this.fetchAuthenticatedUser(token)
            }

           

        },

        methods: {

            change(){

                this.$router.go() 

            },

        
            save() {
              
              this.user.first_name = this.$refs['first_name'].value;
              this.user.last_name = this.$refs['last_name'].value;
              this.user.email = this.$refs['email'].value;
              this.isEditing = !this.isEditing;

              axios.put('/api/users/'+this.user.id, {
                        

                        first_name: this.user.first_name,
                        last_name: this.user.last_name,
                        email: this.user.email,
                        
                    })

                    .then(response => {

                        this.user = response.data
                    })
            },
            
            fetchUser (userid) {

                axios.get('/api/users/' + userid).then(response => {
                    
                    
                    this.user = response.data.data.user_data
                    this.albums = response.data.data.user_albums
                    

                })
            },
            
            fetchAuthenticatedUser (token) {
                axios
                    .get('/api/user', {
                        
                        headers: {
                            Authorization: 'Bearer '+ token
                        }

                    })
                    .then(response => {

                        this.authUser = response.data
                        
                    })
            }

        }
    }  
</script>