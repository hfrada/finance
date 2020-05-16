<template>
	<div>
		<input type="text" name="search" placeholder="Search by name ..." v-model="search" v-on:keyup="searchData(search)">
	</div>
</template>
<script>
	export default
	{
		props : ['blog'],

		data()
		{
			return {
				search : null
			}
		},

		methods :
		{
			searchData(val)
			{
				let query = Object.assign({}, this.$route.query);
				query[this.blog] = val;
				this.$router.push({query: query});
			}
		}
	}
</script>