<template>
    <v-navigation-drawer 
      v-model="drawer" 
      :mini-variant.sync="mini"
      src="black" 
      fixed
      dark
      permanent 
      app>
    	<v-list-item two-line class="px-2">
    		<v-list-item-avatar>
    			<v-img :src="userPhoto"></v-img>	
    		</v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title>{{ data.name }}</v-list-item-title>
                <v-list-item-subtitle>{{ data.access_name }}</v-list-item-subtitle>
            </v-list-item-content>

        	<v-btn icon @click.stop="mini = !mini">
        		<v-icon>mdi-chevron-left</v-icon>
        	</v-btn>
	    </v-list-item>

	    <v-divider></v-divider>

	    <v-list dense>
	    	<v-list-item v-for="item in items" :key="item.title" link @click="$router.push(item.link).catch(()=>{})" :title="item.title">
	    		<v-list-item-icon>
	    			<v-icon>{{ item.icon }}</v-icon>
	    		</v-list-item-icon>

  				<v-list-item-content>
  					<v-list-item-title>{{ item.title }}</v-list-item-title>
  				</v-list-item-content>
  			</v-list-item>
  		</v-list>

        <template v-slot:append>
            <div v-if="mini" class="pb-2">
                <v-list-item link dense title="Logout">
                    <v-list-item-icon>
                        <v-icon @click="logout()">mdi-logout</v-icon>
                    </v-list-item-icon>
                </v-list-item>
            </div>
            <div v-else class="pa-2" dense>
                <v-btn  block @click="logout()">Logout</v-btn>
            </div>
        </template>
	  </v-navigation-drawer>
</template>

<script>

  export default 
  {
    data() {
      return {
        data : {
            name : null,
            access_name : null,
            permission : null
        },

        userPhoto : './../../../storage/assets/img/template/bg.jpg',
        drawer: true,
        items: [
          { title : 'Dasboard', icon : 'mdi-home-city', link : '/' },
          { title : 'Profile', icon : 'mdi-face-profile', link : '/profile' },
          { title : 'Role', icon : 'mdi-view-list', link : '/role' },
          { title : 'Users', icon : 'mdi-account-multiple', link : '/users' },
          { title : 'Category', icon : 'mdi-tag-multiple', link : '/category' },
          { title : 'Financial', icon : 'mdi-cash-multiple', link : '/financial' },
        ],
        mini: true,
      }
    },

    methods : {
        getData() {
            axios.get(`/store/admin/data`).then((res) => {
                this.data = res.data
            });
        },

        logout() {
            axios.get(`/v1/logout`).then((res) => {
                this.$router.go('/admin-login')
            });
        }
    },

    mounted() {
      this.getData()
    }
  }
</script>