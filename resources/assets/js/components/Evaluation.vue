<template>
	<div>
		<div class="container text-center pt-4">
			<h2 v-html="translate(contest,'description')"></h2>
		</div>
		<transition-group 
		name="fadeLeft" 
		tag="div"
		class="row">
		<div 
		class="col-6 col-md-4  artwork-container p-2 d-flex align-items-center justify-content-center" 
		v-for="artwork in filteredArtworks" 
		:key="artwork.id" @click="openDetail(artwork)">
		<div 
		class="m-2 artwork border" 
		>
		<img :src="'/storage'+artwork.imageLink" :alt="artwork.title" class="img-fluid p-2">
	</div>
</div>
</transition-group>
</div>
</template>

<script>
export default {

	name: 'Evaluation',
	props:['contest','category'],
	data () {
		return {
			artworks:[]
		}
	},
	computed:{
		filteredArtworks(){
			return this.artworks.sort((a,b)=>a.contestant.last_name.localeCompare(b.contestant.last_name));
		},
	},
	methods:{
		translate(model, element){
			if(this.contest){
				return model.translations.find(translation=>translation.locale===App.locale)[element];
			}
		},
	},

	created(){
		axios.get(`/api/artworks/category/${this.category.id}`)
		.then(response=>this.artworks=response.data);
	},
}
</script>

<style lang="scss" scoped>
</style>