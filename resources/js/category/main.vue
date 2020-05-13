<template>
	<div>
		<div>
			<input type="text" placeholder="Search by category ..." name="search" v-model="search">
		</div>
		<br>
		<button v-on:click="$router.push({name: 'categoryForm', params:{ id: 'create' }})">Add New Data</button>
		<br>
		<h1>Table Category</h1>
		<table border="1">
			<tr>
				<th v-on:click="sortData('created_at')">No</th>
				<th v-on:click="sortData('category')">Category</th>
				<th>Action</th>
			</tr>
			<tr v-for="item in data">
				<td>1</td>
				<td>{{ item.category }}</td>
				<td>
					<a v-on:click="$router.push({name: 'categoryForm', params:{ id: item.id }})">edit</a> ||
					<a v-on:click="deleteData(item.id)">delete</a>
				</td>
			</tr>
		</table>
	</div>
</template>
<script>
	var sort = 'asc';

	export default{

		data(){
			return{
				data : [],
				search : null
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

			sortData(params)
			{
				if (sort == 'asc') sort = 'desc';
				else sort = 'asc';

				axios.get(`/api/v1/category?sort_by=` + params + `&sort_type=` + sort).then((res)=>{
					this.data = res.data.data;
				});
			}
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