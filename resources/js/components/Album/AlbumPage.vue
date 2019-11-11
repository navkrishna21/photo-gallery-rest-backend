<template>
    
    <div class="container">
    	 <AddPicture v-if="authUser.id==album.data.user_id" @change="change" :albumid ="albumid"></AddPicture>
		 <main class="grid">
			  <div v-for="(photo,index1) in photos" :key="index1">
			  	<div v-if = "photo.data">
			  		<img  class="img"  :src="photo.data.url" alt="Sample photo">

			  		<div class="desc">
			  			<div>{{photo.data.name}}</div>
			  			<a :href="photo.data.url" class="btn btn-primary">view</a>
			  		</div>
			  	</div>	
			  </div>
		</main>
    </div>



</template>

<script>
	import AddPicture from './AddPicture'
    export default{
        
        components: {
              
              'AddPicture':AddPicture,

        },

        data(){
            
            return {
                
                isEditing: false,
                
                album: {type:Object} ,

                albumid:"",

                photos : {type:Array},
                
                authUser:{type:Object},
            };
        },

        mounted () {
            

            const token = localStorage.getItem('api_token')
            
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token


            if (token) {
                
                this.fetchAuthenticatedUser(token)
            
            }
            
            axios.get('/api/albums/' + this.$route.params.albumid).then(response => {   
	            	
	            	this.album = response.data.album_data
	            	this.photos = response.data.album_photos
	            	this.albumid = this.album.data.id;
            
            })

            


        },

        methods: {

            change(){

                this.$router.go() 

            },

            save() {
              
              
            
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


<style>
.grid { 
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  grid-gap: 20px;
  align-items: stretch;
  }
.grid img {
  border: 1px solid #ccc;
  box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
  max-width: 100%;
}
div.desc {
    padding: 15px;
    text-align: center;
}
</style>