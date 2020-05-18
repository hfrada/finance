<template>
	<div class="v-data-table elevation-1 theme--light">
		<table class="v-data-table__wrapper">
			<thead class="v-data-table-header">
			<tr>
				<th v-for="head in headers" v-on:click="sort(head.key)">
					{{ head.name }}
					<span style="float: right;" v-if="!head.disort">
						<v-icon v-if="$route.query.sort_type == 'asc' && $route.query.sort_by == head.key">mdi-sort-ascending</v-icon>
						<v-icon v-else-if="$route.query.sort_type == 'desc' && $route.query.sort_by == head.key">mdi-sort-descending</v-icon>
						<v-icon v-else>mdi-sort</v-icon>
					</span>
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
				<td colspan="99" class="text-center m-t">
					<ul class="v-pagination theme--light text-center">
						<li v-on:click="pagination.current = 1">
							<button type="button" class="v-pagination__navigation"><v-icon>mdi-chevron-double-left</v-icon></button>
						</li>
						<li v-on:click="pagination.current = pagination.prev">
							<button type="button" class="v-pagination__item"><v-icon>mdi-chevron-left</v-icon></button>
						</li>
						<li v-for="num in setPageNumber(5)">
							<button type="button" :class="'v-pagination__item'+
							(num.page == pagination.current?' v-pagination__item--active primary':'')+
							(num.page > pagination.total? ' v-pagination--disabled':'' )"
							v-on:click="pagination.current = num.page"
							>{{ num.page }}</button>
						</li>
						<li v-on:click="pagination.current = pagination.next">
							<button type="button" class="v-pagination__item"><v-icon>mdi-chevron-right</v-icon></button>
						</li>
						<li v-on:click="pagination.current = pagination.total">
							<button type="button" class="v-pagination__navigation"><v-icon>mdi-chevron-double-right</v-icon></button>
						</li>
					</ul>
				</td>
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
        	},
        	setPageNumber(num){
        		let page = [],
        			resPage = (Math.ceil(this.pagination.current/num)-1)*num
        		
        		for (var i = resPage+1; i <= resPage+num; i++) {
        			page.push({ page : i, active: i == this.pagination.current})
        		}
        		return page
        	}
        }
	}
</script>