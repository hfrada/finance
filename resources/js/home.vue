<template>
    <v-row>
        <v-col cols="12" sm="6" class="pa-8 mx-auto" v-for="dboard in dashboardConfig" v-bind:key="dboard.dateFormat">
            <dashboard-chart 
            :url="'/v1/statistic/period-chart?tFormat='+dboard.dateFormat"
            :caption="dboard.caption"
            ></dashboard-chart>
        </v-col>
    </v-row>
</template>

<script>
    import DashboardChart from './components/DashboardChartComponent.vue';

    export default {
        components : {
          DashboardChart : DashboardChart,
        },

        data () {
            return {
                dashboardConfig : [
                    { dateFormat : 'today', caption: 'Data masuk hari ini(jam).', width : 2 },
                    { dateFormat : 'weekday', caption: 'Data masuk minggu ini(tanggal).', width : 2 },
                    { dateFormat : 'monthday', caption: 'Data masuk bulan ini(tanggal).', width : 4 },
                    { dateFormat : 'yearmonth', caption: 'Data masuk tahun ini(bulan).', width : 2 },
                    { dateFormat : 'yeardecade', caption: 'Data masuk dekade ini(tahun).', width : 2 },
                ],
            }
        },

        mounted() {
            console.log(this.$store.state)
        }
    }
</script>