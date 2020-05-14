<template>
	<div>
		<div>
			<input type="text" placeholder="Search by category ..." name="search" v-model="search">
		</div>
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
	// mixin
	import dataProcess from '../mixin/dataProcess.js'

	export default{

		components:{
            dataTable : dataTable,
        },

        mixins : [dataProcess],

		data(){
			return{
				search : null,
				url : '/api/v1/category',
				headers : [
					{ name: "category" },
					{ name: "action", disort : true },
				],
			}
		},

		methods:{

			sortData(params)
			{
				if (sort == 'asc') sort = 'desc';
				else sort = 'asc';

				axios.get(`/api/v1/category?sort_by=` + params + `&sort_type=` + sort).then((res)=>{
					this.data = res.data.data;

				});
			}
		},

		watch:{
			search(val){
				let query = Object.assign({}, this.$route.query);
				query = Object.assign(query, { category: val })
				this.$router.push({query: query});
				this.loadData()
			}
		}

	}
</script>