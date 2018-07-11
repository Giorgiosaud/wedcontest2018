<template>
  <div class="container py-4">

    <h1 class="pb-4">{{$t("lang.registerContestants")}}</h1>
    <form class="" @submit.prevent="register">
      <div class="form-group">
        <label for="name">{{ $t("lang.contestant_name")}}</label>
        <input 
        type="text" 
        class="form-control" 
        :class="{'is-invalid':errors&&errors.name}"
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
        <label for="last_name">{{ $t("lang.contestant_last_name")}}</label>
        <input 
        type="text" 
        class="form-control" 
        :class="{'is-invalid':errors&&errors.last_name}"
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
          {{ $t("lang.birthdate")}}
        </label>
        <datepicker 
        :bootstrapStyling="true"
        autocomplete="off"
        v-model="dob" 
        name="dob"  
        input-class="disabled"
        @input="setDefaultCategory" 
        :typeable="false"
        initial-view="year"
        :language="locale"
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
      :options="categoriesModified"
      :searchable="false" 
      :allow-empty="false" 
      :custom-label="categoryLabel"
      v-model="category"
      >
      <template slot="option" slot-scope="props" :class="classBgCat(props.option.name)">
        <span>{{$t('lang.'+props.option.label)}}</span>
      </template> 
    </multiselect>
    <span v-if="errors.categories" v-text="errors.categories[0]" class="text-xs text-red"></span>
  </div>    
  <div class="form-group" v-if="!contestantCorrespondToSelectedCategory && form.dob">
    <textarea name="motivo" 
    id="motivo" 
    v-model="form.motivo" 
    class="form-control" 
    :class="{'is-invalid':errors&&errors.motivo}"
    rows="10" 
    :placeholder="$t('registration.motivo')"></textarea>
  </div>
  <div class="form-check form-group">
    <input type="checkbox" class="form-check-input" id="authorizedEmail" v-model="authorizedEmail">
    <label class="form-check-label" for="authorizedEmail">{{$t('registration.sendInformationtoContestantemail')}}</label>
  </div>
  <div class="form-group" v-if="authorizedEmail">
    <label for="email">{{ $t("lang.email")}}</label>
    <input 
    type="text" 
    class="form-control" 
    :class="{'is-invalid':errors&&errors.email}"
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
import {en, es} from 'vuejs-datepicker/dist/locale';
import {format,differenceInYears} from "date-fns";
let locales = {
  es: require("date-fns/locale/es"),
  en: require("date-fns/locale/en")
};

export default {
  props: ["categories","postTo"],
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
    axios
    .post(this.postTo, this.form)
    .then(response => {
      console.log(response);
      window.location.href = response.request.responseURL;
    })
    .catch(error => {this.errors=error.response.data.errors;this.loading=false});
  },
  setDefaultCategory() {
    console.log(this.categories.find(cat => this.age < cat.max_age));
    this.category = this.categories.find(cat => this.age <= cat.max_age);
  },
  categoryLabel: function(object) {
    return this.$t('lang.'+object.label);
  },
  classBgCat(cat){
    return `${cat} bg-red`;
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
  },
  categoriesModified(){
    return this.categories.map(category=>{
      category.label=  category.name.replace(/\s/g,'').toLowerCase();
      return category;
    });
  },
  locale(){
    if (App.locale==='en') return en;
    return es;
  },
},
watch: {
  category: function(value) {
    console.log(value);
    this.form.categoryId = value.id;
  }
}
};
</script>
<style lang="scss">
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
