<template>
	<div>
		<div class="filters">
			<div class="row">
				<div class="container">
					<div class="form-group">
						<select name="filter" id="filter" class="form-control" v-model="filter">
							<option value="all" selected>Todos</option>
							<option value="approved">Aprobados por Usuario</option>
							<option value="translated">Traducidos</option>
						</select>
					</div>
				</div>
			</div>	
		</div>	
		

		<translation v-for="artwork in filteredArtworks" :key="artwork.id" :artwork="artwork"></translation>
	</div>
</template>

<script>
export default {

	name: 'Translations',
	props:['artworks'],
	data () {
		return {
			filter:'all'
		}
	},
	computed:{
		filteredArtworks(){
			return this.artworks.filter(artwork=>{
				if(this.filter==='all') return true;
				return artwork.state===this.filter;
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>