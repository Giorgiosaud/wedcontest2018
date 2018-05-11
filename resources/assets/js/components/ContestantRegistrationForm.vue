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
                  <label for="datepicker-trigger"class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 ">
                    {{ $t("registration.birthdate")}}
                  </label>
                <datepicker 
                v-model="dob" 
                name="dob"  
                @input="setDefaultCategory" 
                :typeable="false"
                initial-view="year"

                ></datepicker>
                
                </div>
                <div class="mb-6">
                    <label for="category" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                    {{$t('registration.category')}}
                    </label>
                    <multiselect 
                    label="name"
                    track-by="name" 
                    :options="categories"
                    :searchable="false" 
                    :allow-empty="false" 
                    :custom-label="categoryLabel"
                    v-model="category">
                    <template slot="option" slot-scope="props">
										<span>{{props.option.name}} – <small>{{props.option.max_age}}</small></span>
									</template> 
                    </multiselect>
                    <span v-if="errors.categories" v-text="errors.categories[0]" class="text-xs text-red"></span>
                </div>    
                <div class="mb-6 w-full" v-if="!contestantCorrespondToSelectedCategory && form.dob">
                    <textarea name="motivo" 
                    id="motivo" 
                    v-model="form.motivo" 
                    class="appearance-none block w-full  text-grey-darker border rounded py-3 px-4 mb-3" 
                    rows="10" 
                    :placeholder="$t('registration.motivo')"></textarea>
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

import {format,differenceInYears} from "date-fns";
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
        categoryId: "",
        motivo:""
      },
      dob:"",
      locale:window.App.locale,
      category: "",
      dateFormat: "D MMMM YYYY",
      dateOne: "",
      feedback: "",
      loading: false,
      errors: {}
    };
  },
  methods: {
     customFormatter(date) {
      return format(date, 'YYYY-MM-DD')
    },
    register() {
      this.loading = true;

      axios
        .post("/contestants", this.form)
        .then(response => {
          console.log(response);
          // window.location.href = response.request.responseURL;
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.loading = false;
        });
    },
    setDefaultCategory() {
      console.log(this.categories.find(cat => this.age < cat.max_age));
      this.category = this.categories.find(cat => this.age < cat.max_age);
    },
    categoryLabel: function(account) {
      return `${account.name} – ${account.max_age}`;
    }
  },
  computed: {
    age() {
      if(this.dob) this.form.dob=format(this.dob, 'YYYY-MM-DD');
      return differenceInYears(new Date(), this.dob);
    },
    categoryCorrespondent() {

      return this.categories.find(cat => this.age < cat.max_age);
    },
    contestantCorrespondToSelectedCategory() {
      return this.categoryCorrespondent === this.category;
    }
  },
  watch: {
    category: function(value) {
      this.form.categoryId = value.id;
    }
  }
};
</script>
