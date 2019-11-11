    import Vue          from 'vue'
    import VueRouter    from 'vue-router'
    import VeeValidate from 'vee-validate'

// register vee validate plugin
    Vue.use(VeeValidate)

    Vue.use(VueRouter)

    import Temp          from './components/Temp'
    import App          from './App'
    import Register     from './components/Auth/Register'
    import LogInForm from './components/Auth/LogInForm'
    import UserProfile from './components/User/UserProfile'
    import AlbumPage from './components/Album/AlbumPage'
    import UsersList from './components/UsersList'


    const router = new VueRouter({
        
        mode: 'history',
        
        routes: [
            
            {
                path: '/register',
                name: 'register',
                component: Register,
            },

            {
                path: '/login',
                name: 'login',
                component: LogInForm
            },
            
            {
                path: '/users/:userid',
                component: UserProfile,
                props: true
            },
            {
                path: '/albums/:albumid',
                component: AlbumPage,
                name:AlbumPage,
                props: true
            }
            ,

             {
                path: '/users',
                component: UsersList,
                props: true
            }
            ,


        ],
    });

    const app = new Vue({
        el: '#app',
        components: { App },
        router,
    });
