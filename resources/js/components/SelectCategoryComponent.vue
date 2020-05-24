<template>
	<v-select 
		label="Category"
		item-text="category" 
		item-value="id" 
		v-model="value"
		:items="items"
		>
	</v-select>
</template>
<script>
	
	import dataProcess from '../mixin/dataProcess.js';

	export default
	{
		mixins : [dataProcess],

		data()
		{
			return {
				value : null,
				url : '/v1/category?no_filter=true'
			}
		},

		watch:{
			value(val){
				this.$emit('input', val)
			}
		},
	}
</script>