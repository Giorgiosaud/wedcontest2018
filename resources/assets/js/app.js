/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Locales from "./vue-i18n-locales.generated.js";
import VueInternalization from "vue-i18n";
console.info(Locales);

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
Vue.component(
  "UserNotifications",
  require("./components/UserNotifications.vue")
);
Vue.component("Dropdown", require("./components/Dropdown.vue"));
Vue.component("Contest", require("./components/Contest.vue"));
Vue.component("wysiwyg", require("./components/wysiwyg.vue"));
const i18n = new VueInternalization({
  locale: window.App.locale, // set locale
  messages: Locales // set locale messages
});

const app = new Vue({
  el: "#app",
  data: {
    searching: false
  },
  i18n,
  methods: {
    // search() {
    // this.searching = true;
    // this.$nextTick(() => {
    //this.$refs.search.focus();
    // });
    // }
  }
}).$mount("#app");
