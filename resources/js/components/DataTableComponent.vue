<template>
	<div>
		<h1>{{ caption }}</h1>
		<table border="1">
			<thead>
			<tr>
				<th v-for="head in headers">
					{{ head.name }} <span style="float: right;" v-if="!head.disort" v-on:click="sort(head.name)">&#8645;</span>
				</th>
			</tr>
			</thead>
			
			<tbody>
			<tr v-for="item in items">
				<slot name="item" v-bind:item="item"></slot>
			</tr>
			</tbody>
			
			<tfoot>
			<tr>
				<span v-on:click="pagination.current = 1">«</span> |
				<span v-on:click="pagination.current = pagination.prev">‹</span> |
				<span>{{ pagination.current }}</span> |
				<span v-on:click="pagination.current = pagination.next">›</span> |
				<span v-on:click="pagination.current = pagination.total">»</span>
			</tr>
			</tfoot>
		</table>
	</div>
</template>
<script>
	export default {
        
        props: ['headers', 'items', 'caption', 'pagination'],

        methods : {
        	sort(header){
        		let query = Object.assign({}, this.$route.query);
                query = Object.assign(query, {
                	'sort_type': this.$route.query.sort_type == 'desc' ? 'asc' : 'desc',
                	'sort_by': header
                });
                this.$router.push({query: query,});
        	}
        }
	}
</script>