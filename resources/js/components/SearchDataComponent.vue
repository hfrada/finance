<template>
	<v-text-field placeholder="Search something in table ..." v-model="search" v-on:keyup="searchData(search)">
	 	<v-icon slot="append">mdi-magnify</v-icon>
	</v-text-field>
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