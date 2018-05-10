<template>
<div>
  <h1>Concursantes</h1>
  <ul>
    <li v-for="contestant in contestants"></li>
  </ul>
  </div>
</template>
<script>
export default {
  props: ["contestants"],
  data() {
    return {};
  }
};
</script>
