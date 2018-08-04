<template>
	<div>
    <div class="container text-center">
      <h1 v-html="translate(contest,'description')"></h1>
    </div>
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
      :key="artwork.id" @click="openDetail(artwork)">
      <div 
      class="m-2 artwork border" 
      >
      <img :src="'/storage'+artwork.imageLink" :alt="artwork.title" class="img-fluid p-2">
    </div>
  </div>
</transition-group>
<transition 
name="bounce"
enter-active-class="bounceInLeft"
leave-active-class="bounceOutRight"
>
<div class="detail" v-if="!hiddenDetail">
  <div class="p-4 container">
    <div class="row">
      <div class="container-fluid text-right close-btn">
        <button type="button" class="close"  @click="hiddenDetail=true" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <div class="d-flex align-items-center justify-content-center px-4">
     <div class="move movePrev" @click="selectPrev"><i class="fas fa-chevron-left"></i></div>
     <div class="img-container">
       <img :src="'/storage'+selectedArtwork.imageLink" alt="selectedArtwork.title" class="img-h-fluid">
     </div>
     <div class="move moveNext" @click="selectNext"><i class="fas fa-chevron-right"></i></div>
   </div>
   <div class="container py-4">
     <h1 v-html="translate(selectedArtwork,'title')"></h1>
     <h2 v-html="translate(selectedArtwork,'description')"></h2>
     <p>{{ selectedArtwork.contestant.name }} {{ selectedArtwork.contestant.last_name }} – {{ age }} {{ $t('lang.yearsOld') }} – {{ selectedArtwork.category.name}}</p>
   </div>
 </div>
</div>
</transition>
</div>
</div>
</template>

<script>
import {format,differenceInYears} from "date-fns";

export default {

  name: 'gallery',
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
    })
  },
  indexOfSelectedArtwork(){
    return this.filteredGallery.findIndex(art=>art.id===this.selectedArtwork.id);
  },
  maxIndexOfFilterArtworks(){
    return this.filteredGallery.length-1;
  }
},
created(){
 axios.get(`/api/gallery/${this.contest.slug}`)
 .then(response=>this.gallery=response.data);
}
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
  cursor:pointer;
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