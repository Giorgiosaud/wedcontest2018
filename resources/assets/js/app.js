
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component("Flash", require("./components/Flash.vue"));
Vue.component("Login", require("./components/Login.vue"));
Vue.component("Register", require("./components/Register.vue"));
Vue.component("LogoutButton", require("./components/LogoutButton.vue"));
Vue.component("UserNotifications", require("./components/UserNotifications.vue"));
Vue.component("Dropdown", require("./components/Dropdown.vue"));
const app = new Vue({
    el: '#app',
    data: {
        searching: false
    },

    methods: {
        // search() {
            // this.searching = true;

            // this.$nextTick(() => {
                //this.$refs.search.focus();
            // });
        // }
    }
});
