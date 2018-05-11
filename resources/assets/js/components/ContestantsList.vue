<template>
<div>
  <h1>Concursantes</h1>
  <ul>
    <li v-for="contestant in contestants">
    	{{ contestant.name }} {{ contestant.last_name }} {{ contestant.status }}
    </li>
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
