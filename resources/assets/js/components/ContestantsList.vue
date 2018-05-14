<template>
<div>
  <h1>Concursantes</h1>
  <contestantCard v-for="contestant in contestants" :contestant="contestant" :key="contestant.id"></contestantCard>
  </div>
</template>
<script>

import contestantCard from "./contestantCard.vue";

export default {
  props: ["contestants"],
  components:{
    contestantCard
  },
  data() {
    return {};
  }
};
</script>
