<template>
  <div class="container py-4">

    <h1>{{$t("registration.registerContestants")}}</h1>
    <form class="" @submit.prevent="register">
      <div class="form-group">
        <label for="name">{{ $t("registration.name")}}</label>
        <input 
        type="text" 
        class="form-control" 
        id="name" 
        autocomplete="name" 
        aria-describedby="name"
        v-model="form.name"
        @keydown="errors.name = false"
        required >
        <div v-if="errors.name" v-text="errors.name[0]" class="invalid-feedback">
        </div>
      </div>
      <div class="form-group">
        <label for="last_name">{{ $t("registration.last_name")}}</label>
        <input 
        type="text" 
        class="form-control" 
        id="last_name" 
        autocomplete="last_name" 
        aria-describedby="last_name"
        v-model="form.last_name"
        @keydown="errors.last_name = false"
        required >
        <div v-if="errors.last_name" v-text="errors.last_name[0]" class="invalid-feedback">
        </div>
      </div>

      <div class="datepicker-trigger form-group">
        <label for="datepicker-trigger"class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 ">
          {{ $t("registration.birthdate")}}
        </label>
        <datepicker 
        :bootstrapStyling="true"
        v-model="dob" 
        name="dob"  
        @input="setDefaultCategory" 
        :typeable="true"
        initial-view="year"

        ></datepicker>

      </div>
      <div class="form-group">
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
      v-model="category"
      >
      <template slot="option" slot-scope="props" :class="classBgCat(props.option.name)">
        <span>{{props.option.name}} – <small>{{props.option.max_age}}</small></span>
      </template> 
    </multiselect>
    <span v-if="errors.categories" v-text="errors.categories[0]" class="text-xs text-red"></span>
  </div>    
  <div class="form-group" v-if="!contestantCorrespondToSelectedCategory && form.dob">
    <textarea name="motivo" 
    id="motivo" 
    v-model="form.motivo" 
    class="form-control" 
    rows="10" 
    :placeholder="$t('registration.motivo')"></textarea>
  </div>
  <div class="form-check form-group">
    <input type="checkbox" class="form-check-input" id="authorizedEmail" v-model="authorizedEmail">
    <label class="form-check-label" for="authorizedEmail">{{$t('registration.sendInformationtoContestantemail')}}</label>
  </div>
  <div class="form-group" v-if="authorizedEmail">
    <label for="email">{{ $t("registration.email")}}</label>
    <input 
    type="text" 
    class="form-control" 
    id="email" 
    aria-describedby="email"
    autocomplete="email" 
    v-model="form.email"
    @keydown="errors.email = false"
    required >
    <div v-if="errors.email" v-text="errors.email[0]" class="invalid-feedback">
    </div>
  </div>
  <div class="form-group">
    <button type="button" @click="register" class="btn btn-wedcontest" :class="loading ? 'loader' : ''" :disabled="loading">{{$t('registration.register')}}</button>
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
        motivo:"",
        email:""
      },
      dob:"",
      locale:window.App.locale,
      category: "",
      dateFormat: "D MMMM YYYY",
      dateOne: "",
      feedback: "",
      loading: false,
      authorizedEmail:false,
      errors: {}
    };
  },
  methods: {
   customFormatter(date) {
    return format(date, 'YYYY-MM-DD')
  },
  register() {
    this.loading = true;
    console.log(this.form);

    axios
    .post("/contestant", this.form)
    .then(response => {
      console.log(response);
      // window.location.href = response.request.responseURL;
    })
        .catch(error => console.error(error));
      },
      setDefaultCategory() {
        console.log(this.categories.find(cat => this.age < cat.max_age));
        this.category = this.categories.find(cat => this.age <= cat.max_age);
      },
      categoryLabel: function(object) {
        return `${object.name} – ${object.max_age}`;
      },
      classBgCat(cat){
        return `${cat} bg-red`;
      },

      groupHighlight (index, selectedGroup) {
        return 'hola';
      },
    },
    computed: {
      age() {
        if(this.dob) this.form.dob=format(this.dob, 'YYYY-MM-DD');
        return differenceInYears(new Date(), this.dob);
      },
      categoryCorrespondent() {

        return this.categories.find(cat => this.age <= cat.max_age);
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
