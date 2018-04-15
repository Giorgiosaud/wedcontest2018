<template>

    <modal name="register" height="auto" >
        <div>
            <form class="p-10" @submit.prevent="register">
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
                <div class="mb-6">
                    <label for="country" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                    {{$t('registration.country')}}
                    </label>
                    <v-select label="name" :options="countries" v-model="country">
                        <template slot="option" slot-scope="option">
                        <span class="flag"><img :src="option.flag" :alt="option.name"></span>
                        {{option.name}}
                        </template>
                    </v-select>
                    <span v-if="errors.country" v-text="errors.country[0]" class="text-xs text-red"></span>
                </div>
                <div class="mb-6">
                    <label for="referred" 
                            class="block uppercase ubscribedtracking-wide text-grey-darker text-xs font-bold mb-2">
                            {{$t('registration.referred.label')}}

                    </label>
                    <v-select v-model="referred" :options="referredOptions"></v-select>
                    <div v-if="errors.referred" v-text="errors.referred[0]" class="text-xs text-red mt-2"></div>
                </div>
                <div class="mb-6">
                    <div class="flex">
                        <input type="radio"
                                class="p-2 leading-normal" 
                                value="en"
                                name="language"
                                checked="checked"
                                required 
                                v-model="form.language"
                        >
                    <label for="en" 
                           class="uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 px-2"
                    >{{$t('registration.language.options.en')}}
                    </label>
                    <input  type="radio" 
                            class="p-2 leading-normal" 
                            value="es" 
                            name="language"
                            required 
                            v-model="form.language"
                    >
                    <label  for="es" 
                            class=" uppercase tracking-wide text-grey-darker text-xs font-bold mb-2 px-2"
                            >
                    {{$t('registration.language.options.es')}}
                    </label>
                    </div> 
                    <span v-if="errors.language" v-text="errors.language[0]" class="text-xs text-red"></span>
                </div>
                <div class="mb-6">
                    <label  for="phone" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                    >
                    {{$t('registration.phone')}}
                    </label>
                    <input 
                    type="text" 
                    class="w-full p-2 leading-normal"
                    id="phone"
                    autocomplete="phone"
                    placeholder="+56(414) 897-9056"
                    required 
                    v-model="form.phone"
                    @keydown="errors.phone = false">
                    <span v-if="errors.phone" v-text="errors.phone[0]" class="text-xs text-red"></span>
                </div>
                <div class="mb-6">
                    <label  for="email" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            >{{$t('registration.email')}}
                    </label>
                    <input  type="text" 
                            class="w-full p-2 leading-normal" 
                            id="email" 
                            autocomplete="email" 
                            placeholder="joe@example.com"
                            required 
                            v-model="form.email"
                            @keydown="errors.email = false"
                    >
                    <div v-if="errors.email" v-text="errors.email[0]" class="text-xs text-red mt-2"></div>
                </div>
                <div class="mb-6">
                    <label for="password" 
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                            {{$t('registration.password')}}
                    </label>
                <input  type="password" 
                        class="w-full p-2 leading-normal" 
                        id="password" 
                        autocomplete="password" 
                        name="password" 
                        v-model="form.password" 
                        @keydown="errors.password = false">
                <div v-if="errors.password" v-text="errors.password[0]" class="text-xs text-red mt-2"></div>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" 
                class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                {{$t('registration.password_confirmation')}}
                </label>
                <input type="password" 
                        class="w-full p-2 leading-normal" 
                        id="password_confirmation" 
                        autocomplete="password_confirmation" 
                        name="password_confirmation"
                        required 
                        v-model="form.password_confirmation" 
                        @keydown="errors.password = false">
            </div>
            
            <div class="mb-6">
                <label for="subscribed" 
                class="block uppercase ubscribedtracking-wide text-grey-darker text-xs font-bold mb-2">
                {{$t('registration.subscribed')}}
                </label>
                <input 
                type="checkbox" 
                value="1" 
                class="w-full p-2 leading-normal" 
                id="subscribed" 
                autocomplete="subscribed" 
                name="subscribed" 
                required
                v-model="form.subscribed" 
                @keydown="errors.subscribed = false">
                <div v-if="errors.subscribed" v-text="errors.subscribed[0]" class="text-xs text-red mt-2"></div>
            </div>

            
            <div class="flex items-center -mx-4">
                <button type="submit" class="btn is-green flex-1 mx-4" :class="loading ? 'loader' : ''" :disabled="loading">{{$t('registration.register')}}</button>
            </div>

            <div class="mt-6" v-if="feedback">
                <div class="text-xs text-red mt-2" v-text="feedback"></div>
            </div> 
            </form>            
        </div>
    </modal>
</template>

<script>
export default {
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
        password_confirmation: "",
        subscribed: true
      },
      countries: [],
      country: "",
      referred: "",
      referredOptions: [
        {
          label: this.$t("registration.referred.options.1"),
          value: "invited"
        },
        {
          label: this.$t("registration.referred.options.2"),
          value: "contact"
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
        .post("/register", this.form)
        .then(response => {
          location.reload();
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
  computed: {
    selectedCountry() {
      this.form.country = this.country.code;
      return this.form.country;
    },
    selectedReferred() {
      this.form.referred = this.referred.value;
      return this.form.referred;
    }
  },
  mounted() {}
};
</script>
