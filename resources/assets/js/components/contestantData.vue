<template>
	<div class="row contestant" :class="contestant.categories[0].color">
		<div class="col">
			{{ contestant.id }}
		</div>
		<div class="col">
			{{  contestant.categories[0].name}}
		</div>
		<div class="col">
			<a :href="contestant.editPath">{{ contestant.name }}
			{{ contestant.last_name }}</a>

		</div>
		<div class="col">
			{{ contestant.dob }}
		</div>
		<div class="col">
			{{ contestant.email }}
		</div>
		<div class="col">
			{{ contestant.motivo }}
		</div>
		<div class="col">
			{{ age }}
		</div>
	</div>
</template>

<script>
import {format,differenceInYears} from "date-fns";

export default {
	name: 'contestantData',
	props:["contestant"],
	data () {
		return {

		}
	},
	computed:{
		age() {
    		return differenceInYears(new Date(), this.contestant.dob);
    	},
    }

}
</script>

<style lang="scss" scoped>
.contestant{
	color:#fff
}
a{
	color:inherit
}
</style>