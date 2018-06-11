<template>
	<div class="container">
		<h1>Users Subscribed</h1>
		<showUserData v-for="user in users" :user="user" :key="user.id"></showUserData>
	</div>
</template>

<script>
import showUserData from './showUserData';
export default {

	name: 'Users',
	components:{
		showUserData
	},
	data () {
		return {
			'users':[]
		}
	},

	methods:{
	},
	created(){
		axios.get('/api/users')
		.then(response=>this.users=response.data);
	},
}
</script>

<style lang="scss">
</style>