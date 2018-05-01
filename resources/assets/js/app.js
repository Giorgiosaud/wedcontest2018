/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Locales from "./vue-i18n-locales.generated.js";
import VueI18n from "vue-i18n";

Vue.use(VueI18n);
// import VueInternalization from "vue-i18n";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component("Flash", require("./components/Flash.vue"));
Vue.component("Login", require("./components/Login.vue"));
Vue.component("Register", require("./components/Register.vue"));
Vue.component(
  "RepresentantRegistrationForm",
  require("./components/RepresentantRegistrationForm.vue")
);
Vue.component(
  "ContestantRegistrationForm",
  require("./components/ContestantRegistrationForm.vue")
);
Vue.component("LogoutButton", require("./components/LogoutButton.vue"));
Vue.component("EditMyProfile", require("./components/EditMyProfile.vue"));
Vue.component(
  "UserNotifications",
  require("./components/UserNotifications.vue")
);
Vue.component("Dropdown", require("./components/Dropdown.vue"));
Vue.component("Contest", require("./components/Contest.vue"));
Vue.component("wysiwyg", require("./components/wysiwyg.vue"));

const i18n = new VueI18n({
  locale: window.App.locale, // set locale
  messages: Locales // set locale messages
});
const app = new Vue({
  el: "#app",
  data: {
    searching: false
  },
  i18n
});
