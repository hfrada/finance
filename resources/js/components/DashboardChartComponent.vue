<template>
    <v-card class="mt-4">
        <v-sheet class="v-sheet--offset mx-auto" color="cyan" elevation="12" max-width="calc(100% - 32px)">
            <v-sparkline :labels="labels" :value="value" color="white" line-width="2" padding="16"></v-sparkline>
        </v-sheet>

        <v-card-text class="pt-0">
            <v-icon class="mr-2" small>mdi-clock</v-icon>
            <span class="caption grey--text font-weight-light">{{ caption }}</span>
        </v-card-text>
    </v-card>
</template>

<style>
    .v-sheet--offset {
        top: -24px;
        position: relative;
    }
</style>

<script>
  export default {
    data: () => ({
        labels : [],
        value : [],
    }),

    props : ['url', 'caption'],

    mounted(){
        axios.get(this.url)
        .then((res)=>{
            res.data.forEach((data)=>{
                this.labels.push(data.date)
                this.value.push(data.data)
            })
        })
    }

  }
</script>