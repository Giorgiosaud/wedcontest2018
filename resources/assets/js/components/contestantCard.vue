<template>
	<div class="d-flex align-items-center ml-4">
		<div class="w-prof h-prof rounded-full mr-4 d-flex align-items-center justify-content-center" :class="statusColor">
			{{ shortCat }}
		</div>
		<div class="text-sm">
			<p class="text-black leading-none">{{ contestant.name }} {{ contestant.last_name }}</p>
			<p class="text-grey-dark">{{ contestant.category[0].name }}</p>
		</div>
	</div>
</template>

<script>
export default {

	name: 'contestantCard',
	props:["contestant"],
	computed:{
		statusColor(){
			if(this.contestant.category[0].pivot.status==='pending'){
				return 'bg-pending-rethinking-plastic';
			}
			else{
				return this.contestant.category[0].color;
			}
		},
		shortCat(){
			if(this.contestant.category[0].name=="Game Changers"){
				return "GC";
			}
			return this.contestant.category[0].name.substr(0, 2).toUpperCase();
		}
	}
}
</script>

<style lang="css" scoped>
</style>