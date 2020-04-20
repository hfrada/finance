<template>
	<div>
		<div>
			<label for="search">search</label>
			<input type="text" name="search" v-model="search">
		</div>
		<br>
		<button v-on:click="$router.push({name: 'categoryForm', params:{ id: 'create' }})">add</button>
		<br>
		<h1>Table Category</h1>
		<table border="1">
			<tr>
				<th>Category</th>
				<th>Action</th>
			</tr>
			<tr v-for="item in data">
				<td>{{ item.category }}</td>
				<td>
					<a v-on:click="$router.push({name: 'categoryForm', params:{ id: item.id }})">edit</a> |
					<a v-on:click="deleteData(item.id)">delete</a>
				</td>
			</tr>
		</table>
	</div>
</template>
<script>
	export default{

		data(){
			return{
				data : [],
				search : null,
			}
		},

		methods:{
			getData(search=''){
				axios.get(`/api/v1/category?category=${search}`).then((res)=>{
					this.data = res.data.data
				});	
			},
			deleteData(id){
				axios.delete(`/api/v1/category/${id}`).then((res)=>{
					this.getData()
				});	
			},
		},

		mounted(){
			this.getData()
		},

		watch:{
			search(val){
				this.getData(val)
			}
		}

	}
</script>