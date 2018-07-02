<template>
	<div>
		<div class="filters">
			<div class="col">
				approved
			</div>
			<div class="col">
				translated
			</div>
		</div>	
		<translation v-for="artwork in artworks" :key="artwork.id" :artwork="artwork"></translation>
	</div>
</template>

<script>
export default {

	name: 'Translations',
	props:['artworks'],
	data () {
		return {

		}
	}
}
</script>

<style lang="css" scoped>
</style>