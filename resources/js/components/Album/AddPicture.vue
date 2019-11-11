<template>
  
  <div class="container">
    
    <h3>Add Picture</h3>

    <form class="ui form" @submit.prevent="submit">
  
      <div class="large-12 medium-12 small-12 cell">
  
        <label>Name
          <input type="text" v-model="name" id="name">
        </label>

        <label>Photo
          <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
        </label>

        <button>Add</button>
      
      </div>
      
    </form>
  
  </div>

</template>

<script>
  export default {
    /*
      Defines the data used by the component
    */
    props:{ 

      albumid : { 
        
        required: true, 
      
      }
    },

    name: 'AddPicture',

    data(){
      return {
        file: '',
        name: '',
      }
    },

    methods: {
    
      submit(){
        
            let formData = new FormData();

            
            formData.append('photo', this.file);
            
            formData.append('name', this.name);


            axios.post( '/api/albums/' + this.albumid +'/photos',
              
              formData,
              {
                
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              
              }
            
            )
            .then(function(){
            
              console.log('SUCCESS!!');

            
            })
            
            .catch(function(){
        
             console.log('FAILURE!!');
        
            });

            this.$emit('change')

      },

      

      /*
        Handles a change on the file upload
      */


      handleFileUpload(){
        
        this.file = this.$refs.file.files[0];
      
      }
    
    },

    created () {
            


            const token = localStorage.getItem('api_token')

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

      },
  
  }
</script>