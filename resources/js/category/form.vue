<template>
	<v-container>
    	<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>

    	<v-text-field v-model="data.category" label="Category" required></v-text-field>

    	<v-btn color="primary" v-on:click="id == 'create'? insertData() : updateData(id)">{{ id == 'create' ? 'Create' : 'Update' }}</v-btn>
	</v-container>
</template>
<script>
	export default{

		data(){
			let id = this.$route.params.id;
			return{
				data : {
					category : null,
				},
				id : id,
				breadcrumbs : [
					{ text : 'Category', disabled : false, href : '/#/category' },
					{ text : id == 'create' ? 'Create' : 'Update', disabled : true},
				]
			}
		},

		methods:{
			insertData(){
				axios.post(`/api/v1/category`, this.data).then((res)=>{
					this.$router.push({name: 'categoryMain'})
				});	
			},
			updateData(id){
				axios.put(`/api/v1/category/${id}`, this.data).then((res)=>{
					this.$router.push({name: 'categoryMain'})
				});	
			},
			getData(id){
				axios.get(`/api/v1/category/${id}`).then((res)=>{
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