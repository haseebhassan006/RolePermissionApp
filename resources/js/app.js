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
import vue2Dropzone from 'vue2-dropzone'
import Swal from 'sweetalert2'
import moment from "moment";
Vue.use(Vuesax);
Vue.use(VueContentPlaceholders)
Vue.use(vue2Dropzone)
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
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import Vue from "vue";
window.moment = moment;
window.Swal = Swal;
Vue.filter("timeformat", function (value) {
    if (value) {
        return moment
            .utc(String(value))
            .local()
            .fromNow();
    }
});
Vue.filter("dateformat", function (value) {
    if (value) {
        return moment
            .utc(String(value))
            .local()
            .format('ll');
    }
});



const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            primary_color: "",
        };
    },
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
        alertNotification(position = 'top-right', border, title, description) {
            const noti = this.$vs.notification({
                progress: 'auto',
                border,
                position,
                title: title,
                text: ` ${description} `
            })
        },
        alertNotificationMessage(status, res) {
            switch (status) {
                case 500:
                    this.alertNotification('top-right', 'danger', `Oops, Something Went Wrong ${status} Error! `, res.message);
                    break;
                case 422:
                    this.alertNotification('top-right', 'danger', `Oops, Unprocessable Entity ${status} Error! `, res.message);

                    break;
                case 200:
                    this.alertNotification('top-right', 'success', `response ${status} successfully! `, res);
                    break;
                case 301:
                    this.alertNotification('top-right', 'success', `Oops, Unprocessable Entity ${status} Error! `, res);
                    break;
                case 401:
                    this.alertNotification('top-right', 'danger', `Unauthorized, Oops Unprocessable Entity  Entity ${status} Error! `, res.message);
                    this.logoutUser();
                    break;
                default:
                    break;
            }
        },
        deleteItem(url) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(url).then((res) => {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        return true;
                    }).catch((err) => {
                        this.$root.alertNotificationMessage(err.response.status, err.response.data);
                        //    console.log("erro",err.response.data.message);

                    });
                }
            });
        },
    }

});
