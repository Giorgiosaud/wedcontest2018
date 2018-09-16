<template>
	<div>
    <!--div class="container text-center pt-4">
      <h2 v-html="translate(contest,'description')"></h2>
    </div-->
    <div v-if="contest" class="filters container text-center py-4">
      <div class="d-flex align-items-center justify-content-around">
        <div class="flex-expand" :class="{selected:category==='all'}" @click="category='all'">All</div>
        <div v-for="cat in contest.categories" class="flex-expand" :class="{selected:category===cat.name}" v-text="cat.name" @click="selectedCat(cat.name)"></div>
      </div>
    </div>
    <div v-if="gallery" class="artworks container">
      <transition-group 
      name="fadeLeft" 
      tag="div"
      class="row">
      <div 
      class="col-6 col-md-4  artwork-container p-2 d-flex align-items-center justify-content-center" 
      v-for="artwork in filteredGallery" 
      :key="artwork.id">
      <a :href="artwork.pathShow"><div 
        class="m-2 artwork border" 
        >
        <img :src="'/storage'+artwork.imageLink" :alt="artwork.title" class="img-fluid p-2">
      </div></a>
    </div>
  </transition-group>
  <transition 
  name="bounce"
  enter-active-class="bounceInLeft"
  leave-active-class="bounceOutRight"
  >
</transition>
</div>
</div>
</template>

<script>
import {format,differenceInYears} from "date-fns";

export default {

  name: 'gallery-plain',
  props:['contest'],
  data () {
    return {
    	gallery:null,
      category:'all',
      selectedArtwork:{},
      hiddenDetail:true,
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
    },
    openDetail(artwork){
      this.hiddenDetail=false;

      this.selectedArtwork=artwork;
    },
    selectNext(){
      if(this.maxIndexOfFilterArtworks==this.indexOfSelectedArtwork){
        this.selectedArtwork=this.filteredGallery[0];
      }
      else{
       this.selectedArtwork=this.filteredGallery[this.indexOfSelectedArtwork+1]; 
     }
   },
   selectPrev(){
    if(this.indexOfSelectedArtwork===0){
      this.selectedArtwork=this.filteredGallery[this.filteredGallery.length-1];
    }
    else{
      this.selectedArtwork=this.filteredGallery[this.indexOfSelectedArtwork-1];
    }
  }

},
computed:{

  age() {
    return differenceInYears(new Date(),this.selectedArtwork.contestant.dob);
  },
  filteredGallery(){
    return this.gallery.filter(art=>{
      if(this.category==='all'){
        return true
      }
      return art.category.name===this.category;
    }).sort((a,b)=>a.contestant.last_name.localeCompare(b.contestant.last_name));
  },
  indexOfSelectedArtwork(){
    return this.filteredGallery.findIndex(art=>art.id===this.selectedArtwork.id);
  },
  maxIndexOfFilterArtworks(){
    return this.filteredGallery.length-1;
  }
},
watch:{
  category(val){
    setTimeOut(function(){
      window.parent.postMessage(JSON.stringify({
        event: 'resize',
        height: $(document).height()
      }), 'http://wedcontest2018.diproinduca.com');
    },2000);
  }
},
mounted(){
  setTimeOut(function(){
    window.parent.postMessage(JSON.stringify({
      event: 'resize',
      height: $(document).height()
    }), 'http://wedcontest2018.diproinduca.com');
  });
},
created(){
 axios.get(`/api/gallery/${this.contest.slug}`)
 .then(response=>this.gallery=response.data);
},
}
</script>

<style lang="scss" scoped>
.close-btn {
  position: absolute;
  top: 0;
  right: 0;
}
.filters{
  cursor:pointer;
  font-size:1.1rem;
  .selected{
    font-weight:bold
  }
}
.artworks {
  min-height: 50vh;
}
.artwork{
  overflow:hidden;
  height: 248px;
  transition:all .5s ease-in-out;
  display: flex;
  align-items: center;
  justify-content: center;

  img{
    transition:all .5s ease-in-out;
  }
  img:hover{
    transform:scale(1.1);
  }
}
.detail{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: white;
  z-index: 1050;
  height:100vh;
  overflow:auto;
  button.close {
    font-size: 4rem;
  }
  .move{
    padding:1rem;
    cursor:pointer;
    i.fas{
      font-size:2rem;
    }
  }
}

</style>