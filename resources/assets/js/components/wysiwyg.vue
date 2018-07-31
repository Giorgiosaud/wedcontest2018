<template>
    <div class="form-group">
        <input :id="id" type="hidden" :name="name" :value="value">

        <trix-editor
                class="form-control"
                :ref="id"
                :input="id"
                @trix-change="change"
                :placeholder="placeholder">
        </trix-editor>
    </div>
</template>

<style lang="scss">
@import "~trix/dist/trix.css";
</style>

<script>
import Trix from "trix";

export default {
  props: {
    name:{type:String},
    value:{type:String},
    placeholder:{type:String},
    id:{type:String,default:'trix'}

  },

  methods: {
    change({ target }) {
      this.$emit("input", target.value);
    }
  },

  watch: {
    value(val) {
      if (val === "") {
        this.$refs.trix.value = "";
      }
    }
  }
};
</script>

<style scoped>
trix-editor {
  min-height: 100px;
}
</style>

