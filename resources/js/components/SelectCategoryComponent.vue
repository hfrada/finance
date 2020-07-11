<template>
	<div v-if="$store.state.category">
		<v-select 
			label="Category"
			item-text="category" 
			item-value="id" 
			v-model="value"
			:items="$store.state.category"
			>
		</v-select>
	</div>
</template>
<script>

	export default
	{
		data()
		{
			return {
				value : null
			}
		},

		watch:{
			value(val){
				this.$emit('input', val)
			}
		},
	}
</script>