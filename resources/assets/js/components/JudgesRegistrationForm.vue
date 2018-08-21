<template>
    <div>
      <h1 class="pb-4">{{$t("registration.register")}}</h1>
      <form @submit.prevent="register">
        <div class="form-group">
            <label for="name">{{ $t("lang.judgename")}}</label>
            <input
            type="text"
            class="form-control"
            id="name"
            aria-describedby="name"
            autocomplete='name'
            v-model="form.name"
            :class="{'is-invalid':errors.length>0 && errors.name}"
            @keydown="errors.name = false"
            required >
            <div v-if="errors.name" v-text="errors.name[0]" class="invalid-feedback">
            </div>
        </div>
        <div class="form-group">
            <label for="last_name">{{ $t("lang.judge_last_name")}}</label>
            <input
            type="text"
            class="form-control"
            :class="{'is-invalid':errors.last_name}"
            id="last_name"
            aria-describedby="last_name"
            v-model="form.last_name"
            @keydown="errors.last_name = false"
            required >
            <div v-if="errors.last_name" v-text="errors.last_name[0]" class="invalid-feedback">
            </div>
        </div>
        <div class="form-group">
            <label for="country">{{$t('registration.country')}}</label>
            <v-select label="name" :options="countries" v-model="country">
                <template slot="option" slot-scope="option">
                    <span class="flag"><img :src="option.flag" :alt="option.name"></span>
                    {{option.name}}
                </template>
            </v-select>
            <span v-if="errors.country" v-text="errors.country[0]" class="text-xs text-red"></span>
        </div>
        <div class="form-group">
            <label for="referred">{{$t('registration.referred.label')}}</label>
            <v-select :options="referredOptions" v-model="referred"></v-select>
            <span v-if="errors.referred" v-text="errors.referred[0]" class="text-xs text-red"></span>
        </div>
        <div class="form-group" v-if="form.referred!=='employee' && form.referred!==''">
            <label for="referredBy" class="sr-only">{{$t('registration.specify')}}</label>
            <input
            type="text"
            name="referred_specify"
            autocomplete='referred_specify'
            :class="{'is-invalid':errors.referred_specify}"
            class="form-control"
            v-model="form.referred_specify"
            :placeholder="$t('registration.specify')">
        </div>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input
                type="radio"
                class="form-check-input"
                value="en"
                name="language"
                :class="{'is-invalid':errors.language}"
                v-model="form.language"
                id="en"
                checked
                required
                >
                <label
                class="form-check-label"
                for="en">{{$t('registration.language.options.en')}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input
                type="radio"
                class="form-check-input"
                value="es"
                name="language"
                :class="{'is-invalid':errors.language}"
                v-model="form.language"
                id="es"
                required
                >
                <label
                class="form-check-label"
                for="es">{{$t('registration.language.options.es')}}</label>
            </div>
            <div v-if="errors.language" class="form-control">
                <div v-text="errors.language[0]" class="invalid-feedback"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">{{ $t("registration.phone")}}</label>
            <input
            type="text"
            class="form-control"
            :class="{'is-invalid':errors.phone}"
            id="phone"
            autocomplete="tel-national"
            aria-describedby="phone"
            v-model="form.phone"
            @keydown="errors.phone = false"
            required >
            <div v-if="errors.phone" v-text="errors.phone[0]" class="invalid-feedback">
            </div>
        </div>
        <div class="form-group">
            <label for="email">{{ $t("registration.email")}}</label>
            <input
            type="text"
            class="form-control"
            id="email"
            autocomplete='email'
            :class="{'is-invalid':errors.email}"
            aria-describedby="email"
            v-model="form.email"
            @keydown="errors.email = false"
            required >
            <div v-if="errors.email" v-text="errors.email[0]" class="invalid-feedback">
            </div>
        </div>

        <div class="form-group">
            <label for="password">
                {{$t('registration.password')}}
            </label>
            <input
            type="password"
            class="form-control"
            id="password"
            autocomplete="password"
            name="password"
            :class="{'is-invalid':errors.password}"
            v-model="form.password"
            @keydown="errors.password = false"
            >
            <div v-if="errors.password" v-text="errors.password[0]" class="invalid-feedback">
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">
                {{$t('registration.password_confirmation')}}
            </label>
            <input
            type="password"
            :class="{'is-invalid':errors.password}"
            class="form-control"
            id="password_confirmation"
            autocomplete="password_confirmation"
            name="password_confirmation"
            v-model="form.password_confirmation"
            @keydown="errors.password = false"
            >
            <div v-if="errors.password" v-text="errors.password[0]" class="invalid-feedback">
            </div>
        </div>
        <button
        type="submit"
        class="btn btn-wedcontest"
        :class="loading ? 'loader' : ''"
        :disabled="loading">{{$t('registration.register')}}</button>
    </form>
</div>
</template>


<script>
export default {
    props:['postTo'],
    data() {
        return {
          form: {
            name: "",
            last_name: "",
            phone: "",
            country: "",
            referred: "",
            language: "en",
            email: "",
            password: "",
            referred_specify: "",
            password_confirmation: "",
            subscribed: true
        },
        countries: [],
        country: "",
        referred: "",
        referredOptions: [
            {
                label: this.$t("registration.referred.options.1"),
                value: "employee"
            },
            {
                label: this.$t("registration.referred.options.2"),
                value: "invited"
            },
            {
                label: this.$t("registration.referred.options.3"),
                value: "other"
            }
        ],
      feedback: "",
      loading: false,
      errors: {}
  };
},
methods: {
    register() {
      this.loading = true;

      axios
      .post(this.postTo, this.form)
      .then(response => {
          console.log(response);
          this.loading = false;
          window.location.href = response.request.responseURL;
      })
      .catch(error => {
          this.errors = error.response.data.errors;
          this.loading = false;

      });
  }
},
created() {
    if (this.countries.length > 2) return;
    axios
    .get("/api/countries")
    .then(({ data }) => (this.countries = data))
    .catch(error => {
        flash("Hubo un error refresca la pagina", "warning");
    });
},
watch: {
    country(value) {
      this.form.country = value.code;
  },
  referred(value) {
      this.form.referred = value.value;
  }
},
};
</script>
<style>
.v-select input[type=search]{
    background:#fff;
}
.v-select .dropdown-toggle{
    background-color:#fff;
}
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px #fff inset;
}
</style>
