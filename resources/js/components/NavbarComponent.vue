<template>
    <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" fixed permanent app :right="null">
    	<v-list-item class="px-2">
    		<v-list-item-avatar>
    			<v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>	
    		</v-list-item-avatar>

    	<v-list-item-title>{{ data.name }}</v-list-item-title>

    	<v-btn icon @click.stop="mini = !mini">
    		<v-icon>mdi-chevron-left</v-icon>
    	</v-btn>
	    </v-list-item>

	    <v-divider></v-divider>

	    <v-list dense>
	    	<v-list-item v-for="item in items" :key="item.title" link @click="$router.push(item.link).catch(()=>{})">
	    		<v-list-item-icon>
	    			<v-icon>{{ item.icon }}</v-icon>
	    		</v-list-item-icon>

  				<v-list-item-content>
  					<v-list-item-title>{{ item.title }}</v-list-item-title>
  				</v-list-item-content>
  			</v-list-item>
  		</v-list>
	  </v-navigation-drawer>
</template>

<script>

  export default 
  {
    data () {
      return {
        data : {
          name : null,
          access_name : null,
          permission : null
        },

        url : 'v1/admin/data',
        drawer: true,
        items: [
          { title: 'Dasboard', icon: 'mdi-home-city', link : '/' },
          { title: 'Role', icon: 'mdi-segment', link : '/role' },
          { title: 'Category', icon: 'mdi-tag-multiple', link : '/category' },
          { title: 'Financial', icon: 'mdi-cash-multiple', link : '/financial' },
        ],
        mini: true,
      }
    },

    methods : {
      getData()
      {
        axios.get(`/v1/admin/data`).then((res) => {
          this.data = res.data[0]
        });
      }
    },

    mounted() {
      this.getData()
    }
  }
</script>