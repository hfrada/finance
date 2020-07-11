<template>
	<div v-if="$store.state.usersNames.data">
		<v-select 
		label="User"
		v-model="value"
		:items="$store.state.usersNames.data"
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
				value : null,
			}
		},

		watch:{
			value(val){
				this.$emit('input', val)
			}
		},
	}
</script>