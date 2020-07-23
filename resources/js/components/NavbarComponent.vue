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

        navbarBackground : './../../../storage/assets/img/template/bg.jpg',
        userPhoto : './../../../storage/assets/img/template/bg.jpg',
        drawer: true,
        items: [
          { title : 'Dasboard', icon : 'mdi-home-city', link : '/' },
          { title : 'Profile', icon : 'mdi-face-profile', link : '/profile' },
          { title : 'Role', icon : 'mdi-segment', link : '/role' },
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
            axios.get(`/v1/logout`).then(res => {
                this.$router.go('/admin-login')
            });
        }
    },

    mounted() {
      this.getData()
    }
  }
</script>

<!-- <template>
    <v-navigation-drawer 
      permanent
      :mini-variant.sync="mini">
      <v-system-bar></v-system-bar>
      <v-list>
        <v-list-item class="px-2">
          <v-list-item-avatar>
            <v-img src="./../../../storage/assets/img/template/bg.jpg"></v-img>
          </v-list-item-avatar>
          <v-btn icon @click.stop="mini = !mini" left="false">
              <v-icon>mdi-chevron-left</v-icon>
          </v-btn>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content>
            <v-list-item-title class="title">John Leider</v-list-item-title>
            <v-list-item-subtitle>john@vuetifyjs.com</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action>
            <v-icon>mdi-menu-down</v-icon>
          </v-list-item-action>
        </v-list-item>
      <v-divider></v-divider>
      <v-list
        nav
        dense
      >
        <v-list-item-group v-model="item" color="primary">
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
</template>

<script>
  export default {
    data: () => ({
      mini : true,
      item: 0,
      items: [
        { text: 'My Files', icon: 'mdi-folder' },
        { text: 'Shared with me', icon: 'mdi-account-multiple' },
        { text: 'Starred', icon: 'mdi-star' },
        { text: 'Recent', icon: 'mdi-history' },
        { text: 'Offline', icon: 'mdi-check-circle' },
        { text: 'Uploads', icon: 'mdi-upload' },
        { text: 'Backups', icon: 'mdi-cloud-upload' },
      ],
    }),
  }
</script> -->

<!-- <template>
  <v-container>
    <v-row justify="space-around">
      <v-navigation-drawer
        v-model="drawer"
        :color="color"
        :expand-on-hover="expandOnHover"
        :mini-variant.sync="mini"
        :right="right"
        src="./../../../storage/assets/img/template/bg.jpg"
        absolute
        permanent
        dark
      >
        <v-list
          dense
          nav
          class="py-0"
        >
          <v-list-item two-line class="px-2">
            <v-list-item-avatar>
              <img src="https://randomuser.me/api/portraits/men/81.jpg">
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>Application</v-list-item-title>
              <v-list-item-subtitle>Subtext</v-list-item-subtitle>
            </v-list-item-content>
            <v-btn icon @click.stop="mini = !mini">
              <v-icon>mdi-chevron-left</v-icon>
            </v-btn>
          </v-list-item>

          <v-divider></v-divider>

          <v-list-item
            v-for="item in items"
            :key="item.title"
            link
          >
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data () {
      return {
        drawer: true,
        items: [
          { title: 'Dashboard', icon: 'mdi-view-dashboard' },
          { title: 'Photos', icon: 'mdi-image' },
          { title: 'About', icon: 'mdi-help-box' },
        ],
        right: false,
        permanent: true,
        mini: true,
        expandOnHover: false,
        background: false,
      }
    }
  }
</script> -->

<!-- <template>
  <v-card class="overflow-hidden">
    <v-app-bar
      absolute
      color="#43a047"
      dark
      shrink-on-scroll
      prominent
      src="https://picsum.photos/1920/1080?random"
      fade-img-on-scroll
      scroll-target="#scrolling-techniques-5"
      scroll-threshold="500"
    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(55,236,186,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>
    <v-sheet
      id="scrolling-techniques-5"
      class="overflow-y-auto"
      max-height="600"
    >
      <v-container style="height: 1500px;"></v-container>
    </v-sheet>
  </v-card>
</template> -->

<!-- <template>
  <v-card
    class="mx-auto"
    height="400"
    width="256"
  >
    <v-navigation-drawer
      class="deep-purple accent-4"
      dark
      permanent
    >
      <v-list>
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block>Logout</v-btn>
        </div>
      </template>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
  export default {
    data () {
      return {
        items: [
          { title: 'Dashboard', icon: 'mdi-dashboard' },
          { title: 'Account', icon: 'mdi-account-box' },
          { title: 'Admin', icon: 'mdi-gavel' },
        ],
      }
    },
  }
</script> -->