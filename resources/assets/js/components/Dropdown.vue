<template>
  <div @mouseover="active = true"
  @mouseout="active = false"
  class="relative cursor-pointer relative z-10"
  >
  <slot name="heading"></slot>

  <div v-show="active"
  class="py-6 absolute"
  >
  <ul class="list-reset flex flex-col bg-opaque-black border-top-white">
    <slot name="links"></slot>
  </ul>
</div>
</div>
</template>

<script>
export default {
  data() {
    return {
      active: false
    };
  }
};
</script>
