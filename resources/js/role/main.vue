<template>
	<v-container>
		<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
		
    	<v-row>
    		<v-col cols="12" sm="2" class="pt-8">
    			<v-btn block small color="primary" v-on:click="$router.push({name: 'roleForm', params:{ id: 'create' }})">create</v-btn>
    		</v-col>

    		<v-col sm="12">
    			<data-table :headers="headers" :items="items" :pagination="pagination">
					<template v-slot:item="{ item }">
						<td>{{ item.access_name }}</td>
						<td>{{ item.permission }}</td>
						<td>
							<v-btn x-small color="primary" v-on:click="$router.push({name: 'roleForm', params:{ id: item.id }})">edit</v-btn> 
							<v-btn x-small color="error" v-on:click="deleteData(item.id)">delete</v-btn>
						</td>
					</template>
				</data-table>
    		</v-col>
    	</v-row>
	</v-container>
</template>
<script>
	// components
	import dataTable from '../components/DataTableComponent.vue';
	// mixin
	import dataProcess from '../mixin/dataProcess.js'

	export default{

		components:{
            dataTable : dataTable
        },

        mixins : [dataProcess],

		data(){
			return{
				search : null,
				url : '/v1/role',
				headers : [
					{ name: "Name", key : "access_name"},
					{ name: "Permission", key : "permission"},
					{ name: "Action", disort : true },
				],
				breadcrumbs : [
					{ text : 'Role', disabled : true },
				]
			}
		},
	}
</script>