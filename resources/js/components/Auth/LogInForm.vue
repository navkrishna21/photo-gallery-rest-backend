<template>
  <div class="ui stackable three column centered grid container">
    <div class="column">
      <h2 class="ui dividing header">Log In</h2>

      <Notification
        :message="notification.message"
        :type="notification.type"
        v-if="notification.message"
      />

      <form class="ui form" @submit.prevent="login">
        <div class="field">
          <label>Email</label>
          <input type="email" name="email" v-model="email" placeholder="Email" required>
        </div>

        <div class="field">
          <label>Password</label>
          <input type="password" name="password" v-model="password" placeholder="Password" required>
        </div>

        <button class="fluid ui primary button">LOG IN</button>

        <div class="ui hidden divider"></div>
      </form>

      <div class="ui divider"></div>

      <div class="ui column grid">
        <div class="center aligned column">
          <p>
            Don't have an account? <router-link to="/register">Sign Up</router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import Notification from '../Notification'

    export default {
        name: 'LogInForm',
        components: {
            Notification
        },
        data () {
            return {
                email: '',
                password: '',
                notification: {
                    message: '',
                    type: ''
                }
            }
        },
        beforeRouteEnter (to, from, next) {
            const token = localStorage.getItem('api_token');
                      
            
            if(token){
            	
            	const id = localStorage.getItem('userid')
            	
            	return  next('/users/'+ id) ;
            	
            }
            else
            	return next()
        },
        methods: {
            login () {
                axios
                    .post('api/login', {
                        email: this.email,
                        password: this.password,
                    })
                    .then(response => {
                        // save token in localstorage
                        localStorage.setItem('api_token', response.data.data.api_token);

                        localStorage.setItem('userid', response.data.data.id);

                        // redirect to user home
                        this.$router.push('/users/' + response.data.data.id);
                    })
                    .catch(error => {
                        // clear form inputs
                        this.email = this.password = ''

                        // display error notification
                        this.notification = Object.assign({}, this.notification, {
                            message: error.response.data.message,
                            type: error.response.data.status
                        })
                    })
            }
        }
    }
</script>