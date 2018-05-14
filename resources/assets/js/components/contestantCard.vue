<template>
	<div class="flex items-center">
		<div class="w-10 h-10 rounded-full mr-4 flex items-center justify-center" :class="statusColor">
			{{ shortCat }}
		</div>
		<div class="text-sm">
			<p class="text-black leading-none">{{ contestant.name }} {{ contestant.last_name }}</p>
			<p class="text-grey-dark">{{ contestant.dob }}</p>
		</div>
	</div>
</template>

<script>
export default {

	name: 'contestantCard',
	props:["contestant"],
	computed:{
		statusColor(){
			if(this.contestant.status==='pending'){
				return 'bg-orange-lighter';
			}
			else{
				return this.contestant.category[0].color;
			}
		},
		shortCat(){
			return this.contestant.category[0].name.substr(0, 2).toUpperCase();
		}
	}
}
</script>

<style lang="css" scoped>
</style>