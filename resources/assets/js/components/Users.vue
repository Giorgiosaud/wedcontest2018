<template>
	<div>
		<ul>
			<li v-for="user in users"></li>
		</ul>
		<button type="button" @click="fetchUsers">usersGet</button>
	</div>
</template>

<script>
export default {

	name: 'Users',

	data () {
		return {
			'users':[]
		}
	},
	methods:{
		fetchUsers(){
			axios.get('/api/users')
			.then(users=>this.users=users);
		}
	}
}
</script>

<style lang="scss">
</style>