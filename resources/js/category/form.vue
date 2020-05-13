<template>
	<div>
		<h1>{{ id == 'create' ? 'Create' : 'Update' }} Category</h1>
		<div>
			<input type="text" name="search" id="search" placeholder="Search by category ..." v-model="data.category">
		</div>
		<button v-on:click="id == 'create'? insertData() : updateData(id)">{{ id == 'create' ? 'Create' : 'Update' }}</button>
	</div>
</template>
<script>
	export default{

		data(){
			return{
				data : {
					category : null,
				},
				id : this.$route.params.id,
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