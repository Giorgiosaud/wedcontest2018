<template>
	<div class="container">
		<div class="row" @click="showChild = !showChild">
			<div class="col">
				<div class="row text-muted">
					ID
				</div>
				<div class="row">
					{{ user.id }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Name & Last Name
				</div>
				<div class="row">
					{{ user.name }} {{ user.last_name }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Country
				</div>
				<div class="row">
					{{ user.country }} <img class="mx-2" :src="flag" alt="user.country">
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					email
				</div>
				<div class="row">
					{{ user.email }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Language Selected
				</div>
				<div class="row">
					{{ user.language }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Phone
				</div>
				<div class="row">
					{{ user.phone }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Referred
				</div>
				<div class="row">
					{{ user.referred }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Roles
				</div>
				<div v-for="role in user.roles" class="row">
					{{ role.name }}
				</div>
			</div>
			<div class="col">
				<div class="row text-muted">
					Make Role
				</div>
				<div class="row">
					<a :href="'/admin/users/'+user.id">Toggle Admin Role</a>
				</div>
			</div>
			<div class="d-flex align-items-center justify-content-center mx-3">
				<i class="fas fa-caret-up" :class="{'show-child':showChild}"></i>
			</div>
		</div>
		<div class="collapse" v-if="user.contestants.length>0" :class="{show:showChild}" >
			<contestantData 
			v-for="contestant in user.contestants" 
			:contestant="contestant" 
			:key="contestant.id"
			></contestantData>
		</div>
		<div class="collapse" v-else :class="{show:showChild}" >
			<div class="row no-contestant">
				<div class="col">
					Dont Have Artist Subscribed
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import contestantData from './contestantData';
export default {
	name: 'showUserData',
	props:['user'],
	components:{
		contestantData
	},
	data () {
		return {
			showChild:false
		}
	},
	computed:{
		flag(){
			return `/images/flags/${this.user.country}.png`;
		}
	}
}
</script>

<style lang="css" scoped>
.fas{
	transition:all .25s
}
.show-child{
	transform:rotate(180deg);
}
.no-contestant {
    border: dashed 1px;
}
</style>