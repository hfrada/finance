<template>
	<v-container>
		<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
		
    	<v-row>
    		<!-- <v-col cols="12" sm="10">
    			<search-data blog="username"></search-data>
    		</v-col> -->

    		<v-col cols="12" sm="12">
    			<h4>Filter Select</h4>
    		</v-col>

    		<v-col cols="12" sm="4">
    			<select-user v-model="filter.username" type="number" label="Amount Min."></select-user>
    		</v-col>

    		<v-col cols="12" sm="4">
    			<select-category v-model="filter.category" type="number" label="Amount Min."></select-category>
    		</v-col>

    		<v-col cols="12" sm="4">
    			<v-select label="Type" v-model="filter.type" :items="['pay', 'wallet']"></v-select>
    		</v-col>

    		<v-col cols="12" sm="12">
    			<h4>Filter Amount</h4>
    		</v-col>

    		<v-col cols="12" sm="4">
    			<v-text-field v-model="filter.amount_min" type="number" label="Amount Min."></v-text-field>
    		</v-col>

    		<v-col cols="12" sm="4">
    			<v-text-field v-model="filter.amount_max" type="number" label="Amount Max."></v-text-field>
    		</v-col>

    		<v-col cols="12" sm="12">
    			<h4>Action</h4>
    		</v-col>

    		<v-col cols="12" sm="2" class="pt-8">
    			<v-btn block small color="primary" v-on:click="$router.push({name: 'financialForm', params: {id: 'create'}})">create</v-btn>
    		</v-col>

    		<v-col cols="12" sm="2" class="pt-8">
    			<v-btn block small color="error" v-on:click="resetFilter()">reset</v-btn>
    		</v-col>

    		<v-col cols="12" sm="2" class="pt-8">
    			<v-btn block small color="primary" v-on:click="dataFilter()">filter</v-btn>
    		</v-col>

    		<v-col sm="12" class="pt-8">
    			<data-table :headers="headers" :items="items" :pagination="pagination">
					<template v-slot:item="{ item }">
						<td>{{ item.username }}</td>
						<td>{{ item.type }}</td>
						<td>{{ item.amount }}</td>
						<td>{{ item.category }}</td>
						<td>{{ item.created_at }}</td>
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
	import selectCategory from '../components/SelectCategoryComponent.vue';
	import selectUser from '../components/SelectUserComponent.vue';

	export default 
	{
		components:
		{
			dataTable : dataTable,
			searchData : searchData,
			selectCategory : selectCategory,
			selectUser : selectUser,
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
					{ name : "Create Time", key : "created_at" },
					{ name : "Action", disort : true }
				],
				breadcrumbs : [
					{ text : 'Financial', disabled : true },
				],
				fkey : ['username', 'category', 'type', 'amount_min', 'amount_max'],
				filter : {
					username : null,
					category : null,
					type : null,
					amount_min : null,
					amount_max : null,
				}
			}
		},

		methods : {
			dataFilter(){
				let query = Object.assign({}, this.$route.query);
				this.fkey.forEach((key)=>{
					if (this.filter[key]) {
						query[key] = this.filter[key]
					}else{
						delete query[key]
					}
				})
				this.$router.push({
					query: query
				}).catch(err => {});
			},
			resetFilter(){
				this.filter = {
					username : null,
					category : null,
					type : null,
					amount_min : null,
					amount_max : null,
				}
				this.dataFilter()
			}
		},
	}
</script>