<template>
	<v-container>
		<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
		
	</v-container>
</template>

<script>
	export default
	{
		data() {
			return {
				breadcrumbs : [
					{ text : 'Profile', disabled : true },
				],
				
			}
		}
	}
</script>