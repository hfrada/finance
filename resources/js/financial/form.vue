<template>
	<v-container>
    	<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>	

    	<v-select
    		v-model="data.type"
    		label="Type"
    		:items="['pay', 'amount']">
    		required
    	</v-select>

    	<v-text-field v-model="data.amount" label="Amount" required></v-text-field>	

    	<select-category v-model="data.category_id"></select-category>

    	<v-btn color="primary" v-on:click="id == 'create'? insertData() : updateData(id)">{{ id == 'create' ? 'Create' : 'Update' }}</v-btn>
	</v-container>
</template>
<script>

	import selectCategory from '../components/SelectCategoryComponent.vue';

	export default
	{
		components :
		{
			selectCategory : selectCategory
		},

		data() 
		{
			let id = this.$route.params.id;

			return {
				data : {
					type : null,
					amount : null,
					category_id : null
				},

				id : id,

				breadcrumbs : [
					{ text : 'Financial', disabled : false, href : '/#/financial' },
					{ text : id == 'create' ? 'Create' : 'Update', disabled : true},
				],
			}
		},

		methods :
		{
			insertData()
			{
				axios.post(`/v1/finance`, {
					type : this.data.type,
					amount : this.data.amount,
					category_id : this.data.category_id
				}).then((res)=>{
					this.$router.push({name : 'financialMain'});
					this.$toastr.success('Data Created!', 'Success!');
				}).catch((err) => {
					err.response.data.messages.forEach((message) => {
						this.$toastr.error(message, 'Error!');
					});
				});
			},

			updateData(id)
			{
				axios.put(`/v1/finance/${id}`, {
					type : this.data.type,
					amount : this.data.amount,
					category_id : this.data.category_id
				}).then((res)=>{
					this.$router.push({name : 'financialMain'});
					this.$toastr.success('Data Edited!', 'Success!');
				}).catch((err) => {
					err.response.data.message.forEach((message) => {
						this.$toastr.error(message, 'Error!');
					})
				});
			},

			getData(id)
			{
				axios.get(`/v1/finance/${id}`).then((res)=>{
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