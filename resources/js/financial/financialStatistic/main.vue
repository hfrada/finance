<template>
	<div>
		<search-data blog="username"></search-data>
		<br />
		<data-table caption="Table Data Financial" :headers="headers" :items="items" :pagination="pagination">
			<template v-slot:item="{ item }">
					<td>{{ item.username }}</td>
					<td>{{ item.amount }}</td>
					<td>{{ item. }}</td>
					<td>{{ item.category }}</td>
			</template>
		</data-table>
	</div>
</template>
<script>
	import dataTable from '../../components/DataTableComponent.vue';
	import searchData from '../../components/SearchDataComponent.vue';
	import dataProcess from '../../mixin/dataProcess.js';

	export default
	{
		
	}
</script>