<template>
	<v-container>
    	<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>

    	<v-text-field v-model="data.access_name" label="Name" required></v-text-field>

    	<v-select
    		v-model="data.permission"
    		label="Permission"
    		:items="['financial', 'category']"
    		multiple></v-select>

    	<v-btn color="primary" v-on:click="id == 'create'? insertData() : updateData(id)">{{ id == 'create' ? 'Create' : 'Update' }}</v-btn>
	</v-container>
</template>
<script>
	export default{

		data(){
			let id = this.$route.params.id;
			return {
				data : {
					access_name : null,
					permission : null
				},

				id : id,
				
				breadcrumbs : [
					{ text : 'Role', disabled : false, href : '/#/role' },
					{ text : id == 'create' ? 'Create' : 'Update', disabled : true},
				]
			}
		},

		methods:{
			insertData(){
				axios.post(`/v1/role`, this.data).then((res) => {
					this.$router.push({name: 'roleMain'});
					this.$toastr.success('Data Created!', 'Success!');
				}).catch((err) => {
					err.response.data.messages.forEach((message) => {
						this.$toastr.error(message, 'Error!');
					});
				});	
			},
			updateData(id){
				axios.put(`/v1/role/${id}`, this.data).then((res)=>{
					this.$router.push({name: 'roleMain'});
					this.$toastr.success('Data Edited!', 'Success!');
				}).catch((err) => {
					err.response.data.messages.forEach((message) => {
						this.$toastr.error(message, 'Error!');
					});
				});	
			},
			getData(id){
				axios.get(`/v1/role/${id}`).then((res)=>{
					this.data = res.data
				});	
			}
		},

		mounted(){
			if (this.id != 'create') {
				this.getData(this.id)
			}
		}
	}
</script>