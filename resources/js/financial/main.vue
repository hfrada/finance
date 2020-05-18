<template>
	<v-container>
		<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
		
    	<v-row>
    		<v-col cols="12" sm="2" class="pt-8">
    			<v-btn block small color="primary" v-on:click="$router.push({name: 'financialForm', params: {id: 'create'}})">create</v-btn>
    		</v-col>

    		<v-col cols="12" sm="10">
    			<search-data blog="username"></search-data>
    		</v-col>

    		<v-col sm="12">
    			<data-table :headers="headers" :items="items" :pagination="pagination">
					<template v-slot:item="{ item }">
						<td>{{ item.username }}</td>
						<td>{{ item.type }}</td>
						<td>{{ item.amount }}</td>
						<td>{{ item.category }}</td>
						<td>
							<v-btn x-small color="primary" v-on:click="$router.push({name: 'financialForm', params:{ id: item.id }})">edit</v-btn> 
							<v-btn x-small color="error" v-on:click="deleteData(item.id)">delete</v-btn>
						</td>
					</template>
				</data-table>
    		</v-col>
    	</v-row>
	</v-container>
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
					{ name : "Username", key : "username" },
					{ name : "Type", key : "type" },
					{ name : "Amount", key : "amount" },
					{ name : "Category", key : "category" },
					{ name : "Action", disort : true }
				],
				breadcrumbs : [
					{ text : 'Financial', disabled : true },
				]
			}
		},
	}
</script>