<template>
	<v-container>
    	<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>	

    	<v-select
    		v-model="data.type"
    		label="Type"
    		:items="['pay', 'amount']">
    	</v-select>

    	<v-text-field v-model="data.amount" label="Amount" required></v-text-field>	

    	<!-- <v-text-field v-model="data.user_id" label="User ID" required></v-text-field>	 -->

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
					// user_id : null,
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
					user_id : this.data.user_id,
					category_id : this.data.category_id
				}).then((res)=>{
					this.$router.push({name : 'financialMain'})
				});
			},

			updateData(id)
			{
				axios.put(`/v1/finance/${id}`, {
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