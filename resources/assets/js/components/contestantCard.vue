<template>
	<div class="col-12 col-md-4 mb-4">
		<div class="card" :class="statusColor">
			<div class="card-header">
				<span class="realze">{{  contestant.categories[0].name | capitalize}}</span> - {{ $t('lang.category') }} {{ categoriesLabel }} {{  $t('lang.yearsOld') }}
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><strong>{{ contestant.name }} {{ contestant.last_name }} – {{ age }} {{ $t('lang.yearsOld') }}</strong></li>
				<li class="list-group-item">{{ status }}</li>
			</ul>
			<div class="card-footer">
				<div class="d-flex align-center justify-content-between">
					<div class="edit">
						<a :href="contestant.editPath"><i class="far fa-edit"></i>{{ $t('lang.edit') }} {{ $t('lang.profile') }}</a>
					</div>
					<div class="upload" v-if="isAdmin">
						<div v-if="!artwork || artwork.length===0">
							<a :href="contestant.uploadPath" data-toggle="tooltip"
							data-placement="top" :title="$t('lang.uploadTooltip')">
							{{ $t('lang.upload') }}<i class="fas fa-cloud-upload-alt"></i></a>
						</div>
						<div v-if=" artwork.length>0 && artwork[0].state==='reviewing'">
							<a :href="artwork[0].pathEdit" data-toggle="tooltip"
							data-placement="top" :title="$t('lang.editTooltip')">
							{{ $t('lang.edit') }} {{ $t('lang.artwork') }}<i class="fas fa-cloud-upload-alt"></i></a>
						</div>
						<div v-if="artwork.length>0 && artwork[0].state!=='reviewing'">
							<a :href="artwork[0].pathReview" data-toggle="tooltip"
							data-placement="top" :title="$t('lang.profileTooltip')">
							{{ $t('lang.profile') }} {{ $t('lang.artwork') }}<i class="fas fa-cloud-upload-alt"></i></a>
						</div>
					</div>
					<div class="upload" v-else>
						<a class="btn btn-link text-muted" href="#" data-toggle="tooltip"
						data-placement="top" :title="$t('lang.uploadTooltipNotOpen')">
						{{ $t('lang.upload') }}<i class="fas fa-cloud-upload-alt"></i>
					</a>
				</div>
				<div class="delete">
					<a href="#" @click.prevent="deleteContestant"><i class="far fa-trash-alt"></i>{{ $t('lang.delete') }}</a>
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
	props:["contestant","artwork"],
	methods:{
		deleteContestant(){
			axios.delete(this.contestant.deletePath)
			.then(()=>window.location.reload())
		},
	},
	computed:{
		isAdmin(){
			return App.user.isAdmin;
		},
		statusColor(){
			// console.log(this.contestant);
			if(this.contestant.categories[0].pivot.status==='pending'){
				return 'bg-pending-rethinking-plastic';
			}
			else{
				return this.contestant.categories[0].color;
			}
		},
		age() {
			return differenceInYears(new Date(),this.contestant.dob)
		},
		shortCat(){
			if(this.contestant.categories.length===0) return;
			if(this.contestant.categories[0].name=="Game Changers"){
				return "GC";
			}
			return this.contestant.categories[0].name.substr(0, 2).toUpperCase();
		},
		status(){
			return this.contestant.categories[0].pivot.status
		},

		categoriesLabel(){
			if(this.contestant.categories[0].name=="Seeds"){

				return this.$t("lang.upto3");
			}
			else if(this.contestant.categories[0].name=="Sprouts"){
				return this.$t("lang.upto7");
			}
			else if(this.contestant.categories[0].name=="Thinkers"){
				return this.$t("lang.upto10");
			}
			else{
				return this.$t("lang.upto15");
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