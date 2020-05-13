<template>
	<div>
		<h1>{{ id == 'create' ? 'Create' : 'Update'}} Data Financial</h1>
		<div>
			<label for="type">Type : </label>
			<input type="text" name="type" id="type" v-model="data.type">
			<br />
			<label for="amount">Amount : </label>
			<input type="text" name="amount" id="amount" v-model="data.amount">
			<br />
			<label for="user_id">UserID : </label>
			<input type="text" name="user_id" id="user_id" v-model="data.user_id">
			<br />
			<label for="category_id">CategoryID : </label>
			<input type="text" name="category_id" id="category_id" v-model="data.category_id">
		</div>
		<button v-on:click="id == 'create' ? insertData() : updateData(id)">{{ id == 'create' ? 'Create' : 'Update' }}</button>
	</div>
</template>
<script>
	export default
	{
		data() 
		{
			return {
				data : {
					type : null,
					amount : null,
					user_id : null,
					category_id : null
				},

				id : this.$route.params.id
			}
		},

		methods :
		{
			insertData()
			{
				axios.post(`/api/v1/finance`, {
					type : this.data.type,
					amount : this.data.amount,
					user_id : this.data.user_id,
					category_id : this.data.category_id
				}).then((res)=>{
					this.$router.push({name : 'financialMain'})
				});
			},

			updateData(id)
			{
				axios.put(`/api/v1/finance/${id}`, {
					type : this.data.type,
					amount : this.data.amount,
					user_id : this.data.user_id,
					category_id : this.data.category_id
				}).then((res)=>{
					this.$router.push({name : 'financialMain'})
				});
			},

			getData(id)
			{
				axios.get(`api/v1/finance/${id}`).then((res)=>{
						this.data = res.data
				});
			}
		},

		mounted()
		{
			if (this.id != 'create') {
				this.getData(this.id);
			}
		}

	}
</script>