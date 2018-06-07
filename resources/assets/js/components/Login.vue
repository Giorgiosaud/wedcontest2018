<template>
  <div>
    <h1 class="pb-4">Login</h1>
    <form @submit.prevent="login" @keydown="feedback = ''">
      <div class="form-group">
        <label for="email">E-mail</label>
        <input
        type="email"
        class="form-control"
        id="email"
        autocomplete="email"
        :class="{'is-invalid':errors && errors.email}"
        v-model="form.email"
        aria-describedby="emailHelp"
        required>
        <div v-if="errors.email" v-text="errors.email[0]" class="invalid-feedback"></div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
        type="password"
        class="form-control"
        id="password"
        :class="{'is-invalid':errors&&errors.email}"
        autocomplete="current-password"
        required
        v-model="form.password">
        <div v-if="errors.password" v-text="errors.password[0]" class="invalid-feedback"></div>

      </div>
<div class="d-flex justify-content-between">
      <div>
        <button
        type="submit"
        @click="login"
        class="btn btn-wedcontest mr-2"
        :class="loading ? 'loader' : ''"
        :disabled="loading">Log In</button>
        <a href="/register"
        class="btn btn-link text-muted"
        >or register</a>
      </div>
      <a :href="resetLink"
        class="btn btn-link text-muted"
        >{{ $t('registration.forgot') }}</a>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props:['resetLink'],
  data() {
    return {
      form: { email: "", password: "" },
      feedback: "",
      errors:{},
      loading: false
    };
  },

  methods: {
    login() {
      this.loading = true;
      axios
      .post("login", this.form)
      .then(response => {
        // console.log(response)
        window.location.href = response.request.responseURL
      })
      .catch(errors => {
        this.errors=errors.response.data.errors;
        this.loading = false;
      });
    }
  }
};
</script>
