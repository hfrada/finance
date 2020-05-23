<template>
	<v-select 
		label="ID for Category"
		item-text="category" 
		item-value="id" 
		v-model="value"
		:items="items"
		required>
	</v-select>
</template>
<script>
	
	import dataProcess from '../mixin/dataProcess.js';

	export default
	{
		props : ['value'],
		mixins : [dataProcess],

		data()
		{
			return {
				url : '/api/v1/category?sort_by=id'
			}
		},

		watch:{
			value(val){
				this.$emit('input', val)
			}
		},
	}
</script>