<template>
        <div class="py-6">
          
          <h1>{{$t("registration.registerContestants")}}</h1>
            <form class="py-6" @submit.prevent="register">
                <div class="mb-6">
                    <label  for="name" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                    >
                    {{ $t("registration.name")}}
                    </label>
                    <input  type="text" 
                            class="w-full p-2 leading-normal" 
                            autocomplete="name" 
                            placeholder="John"
                            v-model="form.name"
                            @keydown="errors.name = false"
                            required 
                    >
                    <span v-if="errors.name" v-text="errors.name[0]" class="text-xs text-red"></span>
                </div>
                <div class="mb-6">
                    <label for="last_name" 
                    class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                    >
                    {{ $t("registration.last_name")}}
                    </label>
                    <input  type="text" 
                            class="w-full p-2 leading-normal"
                            autocomplete="last_name"
                            placeholder="Doe" 
                            v-model="form.last_name" 
                            @keydown="errors.last_name = false"
                            required 
                    >
                    <span v-if="errors.last_name" v-text="errors.last_name[0]" class="text-xs text-red"></span>
                </div>
                <div class="datepicker-trigger mb-6">
                  <label for="datepicker-trigger" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 ">
                    {{ $t("registration.birthday")}}
                  </label>
                <datepicker v-model="form.dob" name="dob"></datepicker>

                </div>
                <div class="mb-6">
                    <label for="category" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                    {{$t('registration.category')}}
                    </label>
                    <v-select label="name" :options="categories" v-model="form.category">
                     <template slot="option" slot-scope="option">
                        {{option.name}}
                        <span class="age">{{$t("register.until")}} {{option.max_age}}</span>
                        
                        </template> 
                    </v-select>
                    <span v-if="errors.categories" v-text="errors.categories[0]" class="text-xs text-red"></span>
                </div>            
            <div class="flex items-center -mx-4">
                <button type="submit" class="btn is-green flex-1 mx-4" :class="loading ? 'loader' : ''" :disabled="loading">{{$t('registration.register')}}</button>
            </div>

            <div class="mt-6" v-if="feedback">
                <div class="text-xs text-red mt-2" v-text="feedback"></div>
            </div> 
            </form>        
        </div>
</template>

<script>
// import component and stylesheet
import format from "date-fns/format";
import differenceInYears from "date-fns/difference_in_years";
let locales = {
  es: require("date-fns/locale/es"),
  en: require("date-fns/locale/en")
};

export default {
  props: ["categories"],
  data() {
    return {
      form: {
        name: "",
        dob: "",
        last_name: "",
        phone: "",
        country: "",
        referred: "",
        language: "",
        email: "",
        password: "",
        password_confirmation: "",
        subscribed: true
      },
      dateFormat: "D MMMM YYYY",
      dateOne: "",
      feedback: "",
      loading: false,
      errors: {}
    };
  },
  methods: {
    register() {
      this.loading = true;

      axios
        .post("/my-contestants", this.form)
        .then(response => {
          console.log(response);
          window.location.href = response.request.responseURL;
        })
        .catch(error => {
          this.errors = error.response.data.errors;

          this.loading = false;
        });
    }
  },
  computed: {
    age() {
      return differenceInYears(new Date(), this.form.dob);
    }
  },
  watch: {
    "form.dob": function() {
      this.form.category = this.categories.find(cat => this.age < cat.max_age);
    }
  }
};
</script>
