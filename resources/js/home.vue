<!-- <template>
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
</script> -->

<template>
    <v-container>
        <v-row>
            <v-col
              v-for="card in cards"
              :key="card.title"
              xl="3"
              lg="3"
              md="3"
              sm="6"
              xs="12">
                <v-card
                  :color="card.color"
                  outlined
                  dark>
                    <v-list-item two-line>
                        <v-list-item-content>
                            <v-list-item-title>{{ card.title }}</v-list-item-title>
                            <v-list-item-subtitle>{{ card.subtitle }}</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-avatar
                          size="40"
                          color="white"
                          rounded>
                            <v-icon color="black">{{ card.icon }}</v-icon>
                        </v-list-item-avatar>
                    </v-list-item>
                </v-card>
            </v-col>
        </v-row>

        <apexcharts width="650" type="bar" :options="options" :series="series"></apexcharts>
    </v-container>
</template>

<script>
    export default
    {
        data() {
            return {
                data : {

                },

                labels : [],
                values : [],

                options : {
                    chart : {
                        id : 'vuecharts-example'
                    },

                    xaxis : {
                        categories : [],
                    }
                },
                series : [],

                cards : [
                    { title : 'User Active Today', subtitle : '20.300', icon : 'mdi-account-box', color : 'red darken-3' },
                    { title : 'Transaction Activity', subtitle : '700.100', icon : 'mdi-cash-usd', color : 'purple darken-3' },
                    { title : 'Sek gung kepikiran', subtitle : '1.200.500', icon : 'mdi-cash-register', color : 'indigo darken-3' },
                    { title : 'Gung kepikiran', subtitle : '300.000', icon : 'mdi-cash-register', color : 'light-blue darken-3' },
                ]
            }
        },

        mounted() {
            axios.get('/v1/statistic/period-chart?tFormat=yeardecade')
            .then((res)=>{
                res.data.forEach((res)=>{
                    this.labels.push(res.date);
                    this.values.push(res.data);
                    // this.options.xaxis.categories.push(res.date);
                })

                
                // apexcharts.updateSeries([
                //     { name : 'yeardecade', data : res.data }
                // ]);
            });

            console.log(this.labels);
            console.log(this.values);
        }
    }
</script>