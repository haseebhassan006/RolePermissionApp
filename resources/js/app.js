/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import router from "./router";
import VueContentPlaceholders from 'vue-content-placeholders'
import Vuesax from 'vuesax'
import Multiselect from 'vue-multiselect'
Vue.use(Vuesax);
Vue.use(VueContentPlaceholders)
Vue.component('multiselect', Multiselect)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import vuesax css
import 'vuesax/dist/vuesax.css'
import 'vue-multiselect/dist/vue-multiselect.min.css'

const app = new Vue({
    el: '#app',
    router,
    methods:{
        logoutUser() {
            axios.post('/logout').then((res) => {
                window.location.href = "/login";
            });
        },
        addTag (newTag) {
            const tag = {
              name: newTag,
              code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag)
            this.value.push(tag)
        },
    }

});
