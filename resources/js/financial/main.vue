<template>
	<div>
		<search-data blog="username"></search-data>
		<br />
		<button v-on:click="$router.push({name: 'financialForm', params: {id: 'create'}})">Add New Data</button>
		<br />

		<data-table caption="Table Data Financial" :headers="headers" :items="items" :pagination="pagination">
			<template v-slot:item="{ item }">
					<td>{{ item.username }}</td>
					<td>{{ item.type }}</td>
					<td>{{ item.amount }}</td>
					<td>{{ item.category }}</td>
					<td>
						<a v-on:click="$router.push({name : 'financialForm', params: {id : item.id}})">Edit</a> || <a v-on:click="deleteData(item.id)">Delete</a>
					</td>
			</template>
		</data-table>
	</div>
</template>
<script>
	import dataTable from '../components/DataTableComponent.vue';
	import searchData from '../components/SearchDataComponent.vue';
	import dataProcess from '../mixin/dataProcess.js';

	export default 
	{
		components:
		{
			dataTable : dataTable,
			searchData : searchData
		},

		mixins : [dataProcess],

		data() 
		{
			return {
				search : null,
				url : '/api/v1/finance',
				headers : [
					{ name : "Username" },
					{ name : "Type" },
					{ name : "Amount" },
					{ name : "Category" },
					{ name : "Action", disort : true }
				]
			}
		},
	}
</script>