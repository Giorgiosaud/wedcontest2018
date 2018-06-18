<template>
  <div class="container py-4">

    <h1>{{$t("registration.editContestants")}}</h1>
    <form class="" @submit.prevent="register">
      <div class="form-group">
        <label for="name">{{ $t("registration.name")}}</label>
        <input
        type="text"
        class="form-control"
        :class="{'is-invalid':errors&&errors.name}"
        id="name"
        autocomplete="name"
        aria-describedby="name"
        v-model="contestant.name"
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
        :class="{'is-invalid':errors&&errors.last_name}"
        id="contestant.last_name"
        autocomplete="last_name"
        aria-describedby="last_name"
        v-model="contestant.last_name"
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
        autocomplete="off"
        input-class="disabled"
        v-model="dob"
        @input="setDefaultCategory"
        :typeable="false"
        @selectDate="selectDate"
        initial-view="year"
        :language="locale"
        ></datepicker>
      </div>
      <div class="form-group">
        <label for="category" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
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
          <span>{{$t('contestants.'+props.option.label)}}</span>
        </template>
      </multiselect>
      <span v-if="errors.categories" v-text="errors.categories[0]" class="text-xs text-red"></span>
    </div>
    <div class="form-group" v-if="!contestantCorrespondToSelectedCategory && contestant.dob">
      <textarea name="motivo"
      id="motivo"
      v-model="contestant.motivo"
      class="form-control"
      :class="{'is-invalid':errors&&errors.motivo}"
      rows="10"
      :placeholder="$t('registration.motivo')"></textarea>
    </div>
    <div class="form-check form-group">
      <input type="checkbox" class="form-check-input" id="authorizedEmail" v-model="!!contestant.email">
      <label class="form-check-label" for="authorizedEmail">{{$t('registration.sendInformationtoContestantemail')}}</label>
    </div>
    <div class="form-group" v-if="authorizedEmail">
      <label for="email">{{ $t("registration.email")}}</label>
      <input
      type="text"
      class="form-control"
      :class="{'is-invalid':errors&&errors.email}"
      id="email"
      aria-describedby="email"
      autocomplete="email"
      v-model="contestant.email"
      @keydown="errors.email = false"
      :language="locale"
      required >
      <div v-if="errors.email" v-text="errors.email[0]" class="invalid-feedback">
      </div>
    </div>
    <div class="form-group">
      <button type="button" @click="edit" class="btn btn-wedcontest" :class="loading ? 'loader' : ''" :disabled="loading">{{$t('registration.editContestants')}}</button>
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
  props: ["categories","putTo","contestant"],
  data() {
    return {
      category:null,
      dateFormat: "D MMMM YYYY",
      feedback: "",
      loading: false,
      authorizedEmail:false,
      errors: {},
      dob:'',
      dob2:''
    };
  },
  methods: {
   customFormatter(date) {
    return format(date, 'YYYY-MM-DD')
  },
  edit() {
    this.loading = true;
    console.log(this.contestant);
    axios
    .put(this.putTo, this.contestant)
    .then(response => {
      console.log(response);
      this.contestant.dob=this.contestant.dob.toString().substring(0, 9);
      window.location.href = response.request.response;
    })
    .catch(error => {this.errors=error.response.data.errors;this.loading=false});
  },
  selectDate(val){
    console.log("SELECTD");
    this.contestant.dob=moment(val.timestamp).format('YYYY-MM-DD-MM');
  },
  setDefaultCategory(value) {
    console.log(this.categories.find(cat => this.age < cat.max_age));

    this.category = this.categories.find(cat => this.age <= cat.max_age);
  },
  categoryLabel: function(object) {
    return this.$t('contestants.'+object.label);
  },
  classBgCat(cat){
    return `${cat} bg-red`;
  },
},
watch:{
  category(value){
    this.contestant.categories[0]=value;
    this.contestant.categoryId=value.id;
  }
},
computed: {
  age() {
    if(this.dob) this.contestant.dob=format(this.dob, 'YYYY-MM-DD');
    return differenceInYears(new Date(), this.contestant.dob);
  },
  categoryCorrespondent() {

    return this.categories.find(cat => this.age <= cat.max_age);
  },
  contestantCorrespondToSelectedCategory() {
    return this.categoryCorrespondent.id=== this.contestant.categories[0].id;
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
created(){
  this.category=this.categoriesModified.find(cat=>cat.id===this.contestant.categories[0].id);
}
};
</script>
