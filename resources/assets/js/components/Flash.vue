<template>
    <div :class="classes"
         role="alert"
         v-show="show"
         v-text="body">
    </div>
</template>

<script>
export default {
  props: ["message"],

  data() {
    return {
      body: this.message,
      level: "success",
      show: false
    };
  },

  computed: {
    classes() {
      let defaults = ["alert", "fixed-bottom-right"];

      if (this.level === "success")
        defaults.push("alert-success");
      if (this.level === "warning")
        defaults.push("alert-warning");
      if (this.level === "danger") defaults.push("alert-danger");
      return defaults;
    }
  },

  created() {
    if (this.message) {
      this.flash();
    }

    window.events.$on("flash", data => this.flash(data));
  },

  methods: {
    flash(data) {
      if (data) {
        this.body = data.message;
        this.level = data.level;
      }

      this.show = true;

      this.hide();
    },

    hide() {
      setTimeout(() => {
        this.show = false;
      }, 3000);
    }
  }
};
</script>
