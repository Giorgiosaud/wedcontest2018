<template>
  <div class="py-4">
      <h1>Login</h1>
              <form class="p-10" @submit.prevent="login" @keydown="feedback = ''">
            <div class="mb-6">
                <label for="email" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Email</label>
                <input type="text" class="w-full p-2 leading-normal" id="email" name="email" autocomplete="email" placeholder="joe@example.com"  required v-model="form.email">
            </div>

            <div class="mb-6">
                <label for="password" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Password</label>
                <input type="password" class="w-full p-2 leading-normal" id="password" name="password" autocomplete="current-password" required v-model="form.password">
            </div>
            <div class="flex justify-end items-center">
                <button type="button" 
                @click="login" 
                class="btn is-green mr-4" 
                :class="loading ? 'loader' : ''" 
                :disabled="loading">Log In</button>
                <a href="/register" 
                class="text-xs text-grey-dark link" 
                >or register</a>
            </div>

            <div class="mt-6" v-if="feedback">
                <span class="text-xs text-red" v-text="feedback"></span>
            </div>
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
        .post("/login", this.form)
        .then(response => (window.location.href = response.request.responseURL))
        .catch(error => {
          this.feedback =
            "The given credentials are incorrect. Please try again.";
          this.loading = false;
        });
    }
  }
};
</script>
