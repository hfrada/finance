<template>
	<v-container>
		<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
	</v-container>
</template>

<script>
	export default
	{
		data() {
			let id = this.$route.params.id;

			return {
				id : id,

				breadcrumbs : [
					{ text : 'Profile', disabled : false, href : '/#/profile' },
					{ text : id == 'create' ? 'Create' : 'Update', disabled : true},
				],
			}
		}
	}
</script>