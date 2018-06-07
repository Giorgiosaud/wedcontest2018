<template>
  <div>
    <h1 class="pb-4">Login</h1>
    <form @submit.prevent="login" @keydown="feedback = ''">
      <div class="form-group">
        <label for="email">Email</label>
        <input 
        type="email" 
        class="form-control" 
        id="email" 
        autocomplete="email" 
        v-model="form.email" 
        aria-describedby="emailHelp" 
        required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input 
        type="password" 
        class="form-control" 
        id="password" 
        autocomplete="current-password" 
        required 
        v-model="form.password">
      </div>


        <button
        type="submit"
        @click="login" 
        class="btn btn-wedcontest mr-2" 
        :class="loading ? 'loader' : ''" 
        :disabled="loading">Log In</button>
        <a href="/register" 
        class="btn btn-link text-muted" 
        >or register</a>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: { email: "", password: "" },
      feedback: "",
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
      .catch(error => {
        this.feedback =
        "The given credentials are incorrect. Please try again.";
        this.loading = false;
      });
    }
  }
};
</script>
