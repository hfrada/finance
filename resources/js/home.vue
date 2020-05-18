<template>
        <v-carousel
    cycle
    height="400"
    hide-delimiter-background
    show-arrows-on-hover
  >
    <v-carousel-item
      v-for="(slide, i) in slides"
      :key="i"
      :src="'/img/bg.jpg'"
    >
     <v-sheet
          :color="colors[i]"
          height="100%"
          tile
        >
        <v-row
          class="fill-height"
          align="center"
          justify="center"
        >
          <div class="display-3">{{ slide }}</div>
        </v-row>
      </v-sheet>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data () {
      return {
        colors: [
          'indigo',
          'warning',
          'pink darken-2',
          'red lighten-1',
          'deep-purple accent-4',
        ],
        slides: [
          'Aku pengen pacar',
          'Ibnu Kambing',
          'Give me a cup of girlfriend',
          'Yang putih bening kaya anak sekolahan jepun',
          'Udah tua juga gapapa kalau masih cantik',
        ],
      }
  },
    }
</script>