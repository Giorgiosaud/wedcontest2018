<template>
	<div class="col-12 col-md-4 mb-4">
		<div class="card" :class="statusColor">
			<div class="card-header">
				<span class="realze">{{  contestant.category[0].name | capitalize}}</span> - {{ $t('contestants.category') }} {{ categoryLabel }} {{  $t('contestants.yearsOld') }}
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><strong>{{ contestant.name }} {{ contestant.last_name }} – {{ age }} {{ $t('contestants.yearsOld') }}</strong></li>
				<li class="list-group-item">{{ status }}</li>
			</ul>
			<div class="card-footer">
				<div class="d-flex align-center justify-content-between">
					<div class="edit">
						<a :href="editLink"><i class="far fa-edit"></i>{{ $t('contestants.edit') }}</a>
					</div>
					<div class="upload">
						<button type="button" class="btn btn-link" data-toggle="tooltip" 
						data-placement="top" :title="$t('contestants.uploadTooltip')">
							{{ $t('contestants.upload') }}<i class="fas fa-cloud-upload-alt"></i>
						</button>
					</div>
				</div>
			</div>

		</div>
	</div>
</template>

<script>
import {format,differenceInYears} from "date-fns";
export default {

	name: 'contestantCard',
	props:["contestant","editLink"],
	computed:{
		statusColor(){
			console.log(this.contestant);
			if(this.contestant.category[0].pivot.status==='pending'){
				return 'bg-pending-rethinking-plastic';
			}
			else{
				return this.contestant.category[0].color;
			}
		},
		age() {
			return differenceInYears(new Date(),this.contestant.dob)
		},
		shortCat(){
			if(this.contestant.category.length===0) return;
			if(this.contestant.category[0].name=="Game Changers"){
				return "GC";
			}
			return this.contestant.category[0].name.substr(0, 2).toUpperCase();
		},
		status(){
			return this.contestant.category[0].pivot.status
		},
		categoryLabel(){
			if(this.contestant.category[0].name=="Seeds"){

				return this.$t("contestants.upto3");
			}
			else if(this.contestant.category[0].name=="Sprouts"){
				return this.$t("contestants.upto7");
			}
			else if(this.contestant.category[0].name=="Thinkers"){
				return this.$t("contestants.upto10");
			}
			else{
				return this.$t("contestants.upto15");
			}
		}
	}
}
</script>

<style lang="scss" scoped>
li.list-group-item {
	border: none;
}
.realze{
	font-size:1.1em;
}
.card-footer {
	background: #fff;
	border-top: none;
	padding: 0.5rem;
}
i.far,i.fas{
	margin:0 0.3rem;
}
a{
	color:#666;
}
</style>