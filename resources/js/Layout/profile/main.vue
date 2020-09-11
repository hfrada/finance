<template>
    <v-card class="overflow-hidden" tile>
    	<v-app-bar
    	  absolute
    	  color="#6a76ab"
    	  dark
    	  prominent
    	  shirnk-on-scroll
    	  src="./../../../storage/assets/img/template/bg.jpg"
    	  scroll-target="#scrolling-techniques-3">

    		<v-app-bar-title>Title</v-app-bar-title>
    		<v-spacer></v-spacer>

    		<template v-slot:extension>
    			<v-tabs 
    			  align-with-title
    			  icon-and-text
    			  v-for="tab in tabs"
    			  :key="tab.title">
    				<v-tab href="#{ tab.title }">{{ tab.title }} <v-icon>{{ tab.icon }}</v-icon></v-tab>
    			</v-tabs>
    		</template>
    	</v-app-bar>
    	<v-sheet
    	  id="scrolling-techniques-3"
    	  class="overflow-y-auto"
    	  max-height="600">
    		<v-container style="height: 1000px;"></v-container>
    	</v-sheet>
    </v-card>
</template>

<script>
	export default
	{
		data() {
			return {
				breadcrumbs : [
                    { icon : 'mdi-home', disabled : true },
                    { text : 'Profile', disabled : true },
                ],

                tabs : [
                	{ icon : '', title : 'About' },
                	{ icon : '', title : 'Activity' },
                	{ icon : '', title : 'Describe' }
                ]
			}
		}
	}
</script>