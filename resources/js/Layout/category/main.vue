<template>
	<v-container>
		<div v-if="$store.state.permissions.includes('category')">
			<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
	    	<v-row>
	    		<v-col cols="12" sm="2" class="pt-8">
	    			<v-btn block small color="primary" v-on:click="$router.push({name: 'categoryForm', params:{ id: 'create' }})">create</v-btn>
	    		</v-col>

	    		<v-col cols="12" sm="10">
	    			<search-data blog="category"></search-data>
	    		</v-col>

	    		<v-col sm="12">
	    			<data-table :headers="headers" :items="items" :pagination="pagination">
						<template v-slot:item="{ item }">
							<td>{{ item.category }}</td>
							<td>
								<v-btn x-small color="primary" v-on:click="$router.push({name: 'categoryForm', params:{ id: item.id }})">edit</v-btn> 
								<v-btn x-small color="error" v-on:click="deleteData(item.id)">delete</v-btn>
							</td>
						</template>
					</data-table>
	    		</v-col>
	    	</v-row>
	    </div>
	    <div v-else>
	    	<h4 class="text-center" style="margin-top: 49vh;">You Haven't Permission to Access This Web</h4>
	    </div>
	</v-container>
</template>
<script>
	// components
	import dataTable from '../../Components/DataTableComponent.vue';
	import searchData from '../../Components/SearchDataComponent.vue';
	// mixin
	import dataProcess from '../../Services/mixin/dataProcess.js'

	export default{
		components:{
            dataTable : dataTable,
            searchData : searchData
        },

        mixins : [dataProcess],

		data(){
			return {
				search : null,
				url : '/v1/category',
				headers : [
					{ name: "Category", key : "category"},
					{ name: "Action", disort : true },
				],
				breadcrumbs : [
					{ text : 'Category', disabled : true },
				]
			}
		},
	}
</script>