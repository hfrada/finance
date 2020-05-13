<template>
	<div>
		<div>
			<input type="text" name="search" placeholder="Search by name ..." v-model="search">
		</div>
		<br />
		<button v-on:click="$router.push({name: 'financialForm', params: {id: 'create'}})">Add New Data</button>
		<br />
		<div>
			<h1>Table Data Financial</h1>
			<table border="1">
				<tr>
					<th v-on:click="sortData('created_at')">No</th>
					<th v-on:click="sortData('username')">Name</th>
					<th v-on:click="sortData('type')">Type</th>
					<th v-on:click="sortData('amount')">Amount</th>
					<th v-on:click="sortData('category')">Category</th>
					<th>Action</th>
				</tr>
				<tr v-for="item in data">
					<td>1</td>
					<td>{{ item.username }}</td>
					<td>{{ item.type }}</td>
					<td>{{ item.amount }}</td>
					<td>{{ item.category }}</td>
					<td>
						<a v-on:click="$router.push({name : 'financialForm', params: {id : item.id}})">Edit</a> || <a v-on:click="deleteData(item.id)">Delete</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</template>
<script>
	var sort = 'asc';

	export default 
	{
		data() 
		{
			return {
				data : [],
				search : null
			}
		},

		methods : 
		{
			getData(search = '')
			{
				axios.get(`/api/v1/finance?username=${search}`).then((res)=>{
					this.data = res.data.data;
				});
			},

			deleteData(id)
			{
				axios.delete(`/api/v1/finance/${id}`).then((res)=>{
					this.getData();
				});
			},

			sortData(params)
			{
				if (sort == 'asc') sort = 'desc';
				else sort = 'asc';

				axios.get(`/api/v1/finance?sort_by=`+ params + `&sort_type=` + sort).then((res)=>{
					this.data = res.data.data;
				});
			}
		},

		mounted()
		{
			this.getData();
		},

		watch :
		{
			search(val)
			{
				this.getData(val);
			}
		}


	}
</script>