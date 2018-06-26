<template>
	<div>
    <div class="container text-center">
      <h1 v-html="translate(contest,'description')"></h1>
    </div>
    <div v-if="contest" class="filters container text-center py-4">
      <div class="d-flex align-items-center justify-content-around">
        <div class="flex-expand" @click="category='all'">All</div>
        <div v-for="category in contest.categories" class="flex-expand" v-text="category.name" @click="selectedCat(category.name)"></div>
      </div>
    </div>
    <div v-if="gallery" class="artworks container">
        <transition-group 
        name="fadeLeft" 
        tag="div"
        class="row">
          <div class="col-6 col-md-4  artwork-container p-2 d-flex align-items-center justify-content-center" v-for="artwork in filteredGallery" :key="artwork.id">
            <div class="m-2 artwork border">
              <img :src="artwork.imageLink" :alt="artwork.title" class="img-fluid p-2">
            </div>
          </div>
        </transition-group>
     </div>
  </div>
</template>

<script>
export default {

  name: 'gallery',
  props:['contest'],
  data () {
    return {
    	gallery:null,
      category:'all'
    }
  },
  methods:{
    translate(model, element){
      if(this.contest){
        return model.translations.find(translation=>translation.locale===App.locale)[element];
      }
    },
    selectedCat(cat){
      this.category=cat;
    }
  },
  computed:{
    filteredGallery(){
      return this.gallery.filter(art=>{
        if(this.category==='all'){
          return true
        }
        return art.category.name===this.category;
      })
    }
  },
  created(){
  	axios.get(`/api/gallery/${this.contest.slug}`)
  	.then(response=>this.gallery=response.data);
  }
}
</script>

<style lang="scss" scoped>
.filters{
  cursor:pointer;
  font-weight:bold;
  font-size:1.1rem;
}
.artwork{
  overflow:hidden;
  height: 200px;
  transition:all .5s ease-in-out;

  img{
    transition:all .5s ease-in-out;
  }
  img:hover{
    transform:scale(1.3);
  }
}
</style>