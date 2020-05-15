<template>
	<div>
		<search-data blog="category"></search-data>
		<br>
		<button v-on:click="$router.push({name: 'categoryForm', params:{ id: 'create' }})">Add New Data</button>
		<br>
		<data-table caption="Table Category" :headers="headers" :items="items" :pagination="pagination">
			<template v-slot:item="{ item }">
				<td>{{ item.category }}</td>
				<td>
					<a v-on:click="$router.push({name: 'categoryForm', params:{ id: item.id }})">edit</a> ||
					<a v-on:click="deleteData(item.id)">delete</a>
				</td>
			</template>
		</data-table>
	</div>
</template>
<script>
	// components
	import dataTable from '../components/DataTableComponent.vue';
	import searchData from '../components/SearchDataComponent.vue';
	// mixin
	import dataProcess from '../mixin/dataProcess.js'

	export default{

		components:{
            dataTable : dataTable,
            searchData : searchData
        },

        mixins : [dataProcess],

		data(){
			return{
				search : null,
				url : '/api/v1/category',
				headers : [
					{ name: "Category" },
					{ name: "Action", disort : true },
				],
			}
		},
	}
</script>