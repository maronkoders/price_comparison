<template>
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Dashboard</h2>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">

                             <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                
                                            </div>
                                            <div class="text">
                                                 <span>In Active Products </span>
                                                <h2>{{inactive}}</h2>
                                               
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <span>members online</span>
                                                <h2>10368</h2>
                                                
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <!-- <i class="zmdi zmdi-shopping-cart"></i> -->
                                            </div>
                                            <div class="text">
                                                <span>Active Products</span>
                                                <h2>{{active}}</h2>
                                                
                                            </div>
                                        </div>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <!-- <i class="zmdi zmdi-money"></i> -->
                                            </div>
                                            <div class="text">
                                                <span>Monthly Counts</span>
                                                <h2>{{monthlyCounts}}</h2>
                                                
                                            </div>
                                        </div>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            Products Impression Metrics
                                            
                                            
                                            </h3>
                                            
                                       
                                    </div>
                                    <!-- <div class="au-task js-list-load">
                                           <div class="row">
                                            <div class="col-md-2 pr-1">
                                                <div class="form-group">
                                                <label> Filter Products</label>
                                                <select class="form-control" @change="selectFilterOption($event)"> 
                                                <option value="">Select Option</option>
                                                <option value="week">Weekly</option>
                                                <option value="month">Monthly</option>
                                                <option value="year">Yearly</option>
                                                <!-- <option value="custom">Custom Date</option> 
                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 pr-1">
                                                <div class="form-group">
                                                <label> Filter Period</label>
                                                <select class="form-control" @change="selectFilterOption($event)"> 
                                                <option value="">Select Option</option>
                                                <option value="week">Weekly</option>
                                                <option value="month">Monthly</option>
                                                <option value="year">Yearly</option>
                                                <!-- <option value="custom">Custom Date</option> 
                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 pr-1">
                                                    <div class="form-group">
                                                    <label> Action </label>

                                                        <button @click="applyFilters($event)" class="btn btn-primary">
                                                            Apply
                                                        </button>
                                                    </div>
                                            </div>
                                        </div>
                                        -->
                                        <center>
 <div class="productMetrics"  style="height:500px"  id="productMetrics"> </div>

                                        </center>
                                        
                                    </div> 
                                </div>
                            </div>
                          
                        </div>
                            <site-foot/>
                    </div>
                </div>
</template>
<script>

import Vue from 'vue';
import navBar from './nav_bar.vue';
import sideNavBar from './side_nav_bar.vue';
import mobileHeader  from './header.vue';
import desktopHeader from './desktopHeader.vue'
import dashboard from './dashboard.vue';
import siteFoot from './siteFooter'
import axios from "axios";
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000});

 import ApexCharts from 'apexcharts'
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
am4core.useTheme(am4themes_animated);

export default {
    name:"home",
    components:{
        navBar,
        sideNavBar,
        dashboard,
        mobileHeader,
        desktopHeader,
        siteFoot,
        ApexCharts
    },
   data(){
        return{
            dashboardLoader:false,
            inactive:0,
            active:0,
            monthlyCounts:0,
            period:'Monthly'
        }
    },
    methods:{
    applyFilters:function(event)
        {
            event.preventDefault();

        },
       getProductSelections()
       {
            axios
                .get("api/getProductSelections?token="+this.$route.query.user_token)
                .then((response) => {
                if (response.data.status === 200) {
                    const grouped = response.data.record.reduce((grouped, product) => {
                                                    const key = product.name;
                                                    return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                                    }, {});

                    //    let  series = Object.keys(grouped).map(el=>{
                    //         return grouped[el].length;
                    //     })

                                                
                    //     var options = {
                    //          title: {
                    //     text:this.period+' Products Impression Metrics',
                    //     align: 'center'
                    //   },
                    //     series:series,
                    //     chart: {
                    //     width: 600,
                    //     type: 'pie',
                    //     },
                    //     labels:Object.keys(grouped) ,
                    //     responsive: [{
                    //     breakpoint: 480,
                    //     options: {
                    //         chart: {
                    //         width: 200
                    //         },
                    //         legend: {
                    //         position: 'right'
                    //         }
                    //     }
                    //     }]
                    //     };

                    //     var chart = new ApexCharts(document.querySelector("#productMetrics"), options);
                    //     chart.render();
                                    
                        var chart = am4core.create("productMetrics", am4charts.PieChart);
                        
                        chart.data = Object.keys(grouped).map(el=>{
                                    return {
                                        name: el,
                                        total:grouped[el].length
                                    }
                                });
                            
                        var  pieSeries = chart.series.push(new am4charts.PieSeries());
                            pieSeries.dataFields.value = "total";
                            pieSeries.dataFields.category = "name";
                            pieSeries.labels.template.disabled = true;

                            chart.radius = am4core.percent(80);
                            chart.innerRadius = am4core.percent(50);

                            // Disable ticks and labels
                            pieSeries.labels.template.disabled = true;
                            pieSeries.ticks.template.disabled = true;
                        // pieSeries.slices.template.tooltipText = "";

                            // Add a legend
                            chart.legend = new am4charts.Legend();
                            chart.legend.position = "right";
                
                } else {
                    this.$toaster.error("Catalog has been downloaded")
                }
                })
                .catch((error) => {
                    this.$toaster.error(error.message)
            }); 
       },
        getLoggedInUserData:function()
        {
            axios
            .get("api/getDashboardMetric?token="+this.$route.query.user_token)
            .then((response) => {
               
               if (response.data.status === 200) {
                  this.dashboardLoader = true
                 this.inactive = response.data.data.inactive
                 this.active = response.data.data.active
                 this.monthlyCounts = response.data.data.monthly;
                this.$store.commit("putUserData",response.data.data.user)
                this.$store.commit("putCompanyData",response.data.data.company)
                 
               } else {

               Vue.$toast.open({
                  message: response.data.message,
                  type: "error",
                  position: "top",
               });
               }
            })
            .catch((error) => {
               Vue.$toast.open({
               message: error.message,
               type: "error",
               position: "top",
               });
            });

        }
    },
    mounted(){
        this.getLoggedInUserData();
        this.getProductSelections();
    },
    created(){
          this.$store.commit("putUserToken",this.$route.query.user_token)
    }
}
</script>

<style scoped>
  .productMetrics{
     width: 100%;
  height: 500px;  
  }
</style>