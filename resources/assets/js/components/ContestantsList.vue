<template>
<div>
  
  <div class="container">
    <div class="row">
  <contestantCard v-for="contestant in contestants" :contestant="contestant" :key="contestant.id"></contestantCard>
  </div>
  </div>
  </div>
</template>
<script>

import contestantCard from "./contestantCard.vue";

export default {
  props: {
    contestants:{
      type:Array,
      default:()=>[]
    },
    isAdmin:{
      type:Boolean,
      default:false
    }
  },
  components:{
    contestantCard
  },
  data() {
    return {};
  }
};
</script>
