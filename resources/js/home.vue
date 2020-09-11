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
            <v-col cols="12">
                <v-card
                  outlined
                  tile>
                    <v-breadcrumbs :items="breadcrumbs">
                        <v-breadcrumbs-item
                          slot="item"
                          slot-scope="{ item }"
                          exact>
                            <span v-if="item.icon" style="margin-bottom: 2px;"><v-icon>{{ item.icon }}</v-icon></span>
                            <span v-else>{{ item.text }}</span>
                        </v-breadcrumbs-item>
                    </v-breadcrumbs>
                </v-card>
            </v-col>

            <v-col lg="3" md="3" sm="6" xs="12"
              v-for="card in cards"
              :key="card.title">
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

            <v-col lg="8" md="8" sm="12" xs="12">
                <v-card
                  class="pr-3 pl-2"
                  outlined
                  tile>

                    <v-row class="pa-1">
                        <v-col cols="4" sm="4">
                            <v-select label="Chart Type" v-model="filter.chartType" :items="['bar', 'line', 'radar', 'area']"></v-select>
                        </v-col>

                        <v-col cols="4" sm="4">
                            <v-select
                              v-model="filter.showedData"
                              label="Showed Data"
                              :items="['today', 'weekday', 'monthday', 'yearmonth', 'yeardecade']"></v-select>  
                        </v-col>

                        <v-col cols="4" sm="4">
                            <v-select label="Chart Theme" v-model="filter.chartTheme" :items="['palette', 'palette2', 'palette3', 'palette4', 'palette5', 'palette6', 'palette7', 'palette8', 'palette9', 'palette10']"></v-select>
                        </v-col>
                    </v-row>

                    <apexcharts :type="filter.chartType" :options="options" :series="series"></apexcharts>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default
    {
        data() {
            return {
                filter : {
                    chartType : 'bar',
                    showedData : 'yeardecade',
                    chartTheme : 'palette',
                },

                breadcrumbs : [
                    { icon : 'mdi-home', disabled : true },
                    { text : 'Dashboard', disabled : true },
                ],

                values : [],
                labels : [],

                options : {
                    xaxis : { categories : null },

                    theme : { palette : null },

                    title : { text : 'User Activity Statistic' },

                    noData : { text : 'No Data Detected!' }
                },

                series : [
                    { name : null, data : null }
                ],

                cards : [
                    { title : 'User Active Today', subtitle : '20.300', icon : 'mdi-account-box', color : 'red darken-3' },
                    { title : 'Transaction Activity', subtitle : '700.100', icon : 'mdi-cash-usd', color : 'purple darken-3' },
                    { title : 'Sek gung kepikiran', subtitle : '1.200.500', icon : 'mdi-cash-register', color : 'indigo darken-3' },
                    { title : 'Gung kepikiran', subtitle : '300.000', icon : 'mdi-cash-register', color : 'light-blue darken-3' },
                ]
            }
        },

        methods : {
            chartData(param = 'yeardecade') {
                axios.get(`/v1/statistic/period-chart?tFormat=` + param).then((res) => {
                    res.data.forEach((data) => {
                        this.labels.push(data.date)
                        this.values.push(data.data)
                    });

                    this.series = [ { name : this.filter.showedData, data : this.values } ];
                    this.options = { xaxis : { categories : this.labels } };
                });
            },
        },

        mounted() {
            this.chartData();
        },

        watch : {
            'filter.chartTheme'(val) {
                this.options = {
                    theme : { palette : val }
                }
            },

            'filter.showedData'(val) {
                this.labels = [];
                this.values = [];

                this.chartData(val);
            }
        }
    }
</script>