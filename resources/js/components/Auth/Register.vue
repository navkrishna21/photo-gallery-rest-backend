<template>
  <div class="ui stackable three column centered grid container">
    <div class="column">
      <h2 class="ui dividing header">Sign Up, it's free!</h2>

      <Notification
        :message="notification.message"
        :type="notification.type"
        v-if="notification.message"
      />

      <form class="ui form" @submit.prevent="signup">
        
        <div class="field" :class="{ error: errors.has('first_name') }">
          <label>First Name</label>
          <input type="text" name="first_name" v-model="first_name" v-validate="'required'" placeholder="First Name">
          <span v-show="errors.has('first_name')" class="is-danger">{{ errors.first('first_name') }}</span>
        </div>

        <div class="field" :class="{ error: errors.has('last_name') }">
          <label>Last Name</label>
          <input type="text" name="last_name" v-model="last_name" v-validate="'required'" placeholder="Last Name">
          <span v-show="errors.has('last_name')" class="is-danger">{{ errors.first('last_name') }}</span>
        </div>

        <div class="field" :class="{ error: errors.has('username') }">
          <label>Username</label>
          <input type="text" name="username" :class="{'input': true, 'is-danger': errors.has('username') }" v-model="username" v-validate="'required'" placeholder="Username">
          <span v-show="errors.has('username')" class="is-danger">{{ errors.first('username') }}</span>
        </div>

        <div class="field" :class="{ error: errors.has('email') }">
          <label>Email</label>
          <input type="email" name="email" :class="{'input': true, 'is-danger': errors.has('email') }" v-model="email" v-validate="'required|email'" placeholder="Email">
          <span v-show="errors.has('email')" class="is-danger">{{ errors.first('email') }}</span>
        </div>

        <div class="field" :class="{ error: errors.has('password') }">
          <label>Password</label>
          <input type="password" name="password" :class="{'input': true, 'is-danger': errors.has('password') }" v-model="password" v-validate="'required|min:8'" placeholder="Password" ref="password">
          <span v-show="errors.has('password')" class="is-danger">{{ errors.first('password') }}</span>
        </div>

         <div class="field" :class="{ error: errors.has('password_confirmation') }">
          <label>Confirm Password</label>
          <input type="password" name="password_confirmation" :class="{'input': true, 'is-danger': errors.has('password_confirmation') }" v-model="password_confirmation" v-validate="'required|confirmed:password'" placeholder="Confirm Password" >
          <span v-show="errors.has('password_confirmation')" class="is-danger" data-vv-as="password">{{ errors.first('password_confirmation') }}</span>
        </div>

        <button class="fluid ui primary button" :disabled="!isFormValid">SIGN UP</button>

        <div class="ui hidden divider"></div>
      </form>

      <div class="ui divider"></div>

      <div class="ui column grid">
        <div class="center aligned column">
          <p>
            Got an account? <router-link to="/login">Log In</router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
    
    import Notification from '../Notification';

    export default {

        name: 'Register',
        
        components: {
            Notification,
        },

        data() {
            
            return {
                
                username : "",
                first_name : "",
                last_name : "",
                email : "",
                password : "",
                password_confirmation : "",
                
                notification: {
                    message: '',
                    type: '',
                },
            };
        },

        computed: {
            isFormValid() {
                return Object.keys(this.fields).every(key => this.fields[key].valid);
            },
        },
        
        beforeRouteEnter(to, from, next) {

            const token = localStorage.getItem('api_token');
            
            
            
            if(token){
            	
            	const id = localStorage.getItem('userid')
            	
            	return  next('/users/'+ id ) ;
            	
            }
            else
            	return next()
        },

        methods: {
            
            signup() {


                 axios.post('api/register', {
                        
                        username: this.username,
                        first_name: this.first_name,
                        last_name: this.last_name,
                        email: this.email,
                        password: this.password,
                        password_confirmation : this.password_confirmation,
                        
                      })

                    .then(response => {
                        
                        // save token in localstorage
                        
                        localStorage.setItem('api_token', response.data.data.api_token);

                        localStorage.setItem('userid', response.data.data.id);

                        // redirect to user home
                        this.$router.push('/users/' + response.data.data.id);
                    })

                    .catch(error => {
                        // display error notification
                        this.notification = Object.assign({}, this.notification, {
                            message: error.response.data.message,
                            type: error.response.data.status,
                        });
                    });
            },
        },
    };
</script>