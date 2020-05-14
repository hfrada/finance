export default {
	
	data(){

		let current = this.$route.query.page ? this.$route.query.page : 1;
		return {
			items : [],
			pagination: {
				current: current,
				total: 1,
				next: 1,
				prev : 1,
			}
		}

	},

	mounted() {
        this.loadData()
    },

    methods : {

    	loadData(){
        	axios.get(this.url, {
        		params: Object.assign({}, this.$route.query)
        	})
			.then((res)=>{

	        	this.items = res.data.data;
	        	this.paginate(res.data)
	        	
        	});
        },

        paginate(pagination){
        	this.pagination.current = pagination.current_page;
			this.pagination.total = pagination.last_page;
			this.pagination.next = pagination.next_page_url ? pagination.next_page_url.split("=").pop() : 1;
			this.pagination.prev = pagination.prev_page_url ? pagination.prev_page_url.split("=").pop() : 1;
        },

        deleteData(id){
			axios.delete(`${this.url}/${id}`).then((res)=>{
				this.getData()
			});	
		},
    },

    watch : {
    	
    	'$route'(to, from){

			this.loadData()
		},

		'pagination.current': {
			handler(newval, oldval){
				let query = Object.assign({}, this.$route.query);
				query = Object.assign(query, { page: this.pagination.current })
				this.$router.push({
					query: query
				}).catch(err => {});
			},
			deep: true,
		}
    }
}