<template>
	<v-container>
		<div v-if="$store.state.permissions.includes('financial')">
			<v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
			
			<v-row>
				<v-col cols="12" sm="12">
		    		<h4><v-icon>mdi-select-group</v-icon> Filter by Select</h4>
				</v-col>

				<v-col cols="12" sm="4">
					<select-user v-model="filter.username" type="number" label="Username"></select-user>
				</v-col>

				<v-col cols="12" sm="4">
					<select-category v-model="filter.category" type="number" label="Category"></select-category>
				</v-col>

				<v-col cols="12" sm="4">
					<v-select label="Type" v-model="filter.type" :items="['pay', 'wallet']"></v-select>
				</v-col>

				<v-col cols="12" sm="12">
					<h4><v-icon>mdi-cash-multiple</v-icon> Filter by Amount</h4>
				</v-col>

				<v-col cols="12" sm="4">
					<v-text-field v-model="filter.amount_min" type="number" label="Amount Min."></v-text-field>
				</v-col>

				<v-col cols="12" sm="4">
					<v-text-field v-model="filter.amount_max" type="number" label="Amount Max."></v-text-field>
				</v-col>

				<v-col cols="12" sm="12">
					<h4><v-icon>mdi-calendar-multiple</v-icon> Filter by Date</h4>
				</v-col>

				<v-col cols="12" sm="4">
					<v-menu
		    			ref="menu1"
		    			v-model="menu1"
		    			:close-on-content-click="false"
		    			:return-value.sync="filter.date_min"
		    			transition="scale-transition"
		    			offset-y
		    			max-width="290px">
						<template v-slot:activator="{ on }">
							<v-text-field
								v-model="filter.date_min"
								label="Date Min."
								readonly
								v-on="on"
								type="date"></v-text-field>
						</template>
						<v-date-picker v-model="filter.date_min">
		    				<v-spacer></v-spacer>
		    				<v-btn text color="primary" @click="menu1 = false"><strong>Cancel</strong></v-btn>
		    				<v-btn text color="primary" @click="$refs.menu1.save(filter.date_min)"><strong>Save</strong></v-btn>
		    			</v-date-picker>
					</v-menu>
				</v-col>

				<v-col cols="12" sm="4">
					<v-menu
		    			ref="menu2"
		    			v-model="menu2"
		    			:close-on-content-click="false"
		    			:return-value.sync="filter.date_max"
		    			transition="scale-transition"
		    			offset-y
		    			max-width="290px">
						<template v-slot:activator="{ on }">
							<v-text-field
								v-model="filter.date_max"
								label="Date Max."
								readonly
								v-on="on"
								type="date"></v-text-field>
						</template>
						<v-date-picker v-model="filter.date_max">
		    				<v-spacer></v-spacer>
		    				<v-btn text color="primary" @click="menu2 = false"><strong>Cancel</strong></v-btn>
		    				<v-btn text color="primary" @click="$refs.menu2.save(filter.date_max)"><strong>Save</strong></v-btn>
		    			</v-date-picker>
					</v-menu>
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
		</div>
		<div v-else>
			<h4 class="text-center" style="margin-top: 49vh;">You Haven't Permission to Access This Web</h4>
		</div>
	</v-container>
</template>
<script>
	import dataTable from '../../Components/DataTableComponent.vue';
	import searchData from '../../Components/SearchDataComponent.vue';
	import dataProcess from '../../Services/mixin/dataProcess.js';
	import selectCategory from '../../Components/SelectCategoryComponent.vue';
	import selectUser from '../../Components/SelectUserComponent.vue';

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
				url : '/v1/financial',
				headers : [
					{ name : "Username", key : "username" },
					{ name : "Type", key : "type" },
					{ name : "Amount", key : "amount" },
					{ name : "Category", key : "category" },
					{ name : "Create Time", key : "created_at" },
					{ name : "Action", disort : true }
				],

				menu1 : null,
				menu2 : null,

				breadcrumbs : [
					{ text : 'mdi-home', disabled : true },
					{ text : 'Financial', disabled : true },
				],

				fkey : ['username', 'category', 'type', 'amount_min', 'amount_max', 'date_min', 'date_max'],

				filter : {
					username : null,
					category : null,
					type : null,
					amount_min : null,
					amount_max : null,
					date_min : null,
					date_max : null
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
					date_min : null,
					date_max : null
				}
				this.dataFilter()
			}
		},
	}
</script>