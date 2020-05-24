<template>
	<v-select 
		label="User"
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
				url : '/v1/users/names'
			}
		},

		watch:{
			value(val){
				this.$emit('input', val)
			}
		},
	}
</script>