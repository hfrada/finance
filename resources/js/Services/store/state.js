import config from '../../endpoint.js';

export let Store = {
	state : 
	{
		roles : [],
		permissions : [],
		category : [],
		usersNames : [],
		adminData : [],
	},

	mutations : 
	{
		initconfig(state, data) {
			Object.assign(state, data);
		},

		getCategory(state) {
			return axios.get('/store/category').then(res => {
	      		state.category = res.data
			});
		},
		
		getPermissions(state) {
			return axios.get('/store/permissions').then(res => {
	      		state.permissions = res.data
			});
		},

		getUsersNames(state) {
			return axios.get('/store/user/name').then(res => {
	      		state.usersNames = res.data
			});
		},

		getAdminData(state) {
			return axios.get('/store/admin/data').then(res => {
	      		state.adminData = res.data
			});
		},			
	},
}