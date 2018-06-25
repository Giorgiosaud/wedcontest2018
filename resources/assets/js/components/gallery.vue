<template>
	<div>
    <h1 v-html="translate(contest,'description')"></h1>
    <div v-if="contest" class="filters row text-center">
      <div v-for="category in contest.categories" class="col" v-text="category.name"></div>
    </div>
  </div>
</template>

<script>
export default {

  name: 'gallery',
  props:['slug'],
  data () {
    return {
    	contest:null
    }
  },
  methods:{
    translate(model, element){
      if(this.contest){
        return model.translations.find(translation=>translation.locale===App.locale)[element];
      }
    }
  },
  created(){
  	axios.get(`/api/gallery/${this.slug}`)
  	.then(response=>this.contest=response.data);
  }
}
</script>

<style lang="scss" scoped>
</style>