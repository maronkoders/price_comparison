<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">

          



         
                               
             

        <div class="row">                 
                
    

              <div class="col-xl-12 col-md-12 col-12" style="margin-top:20px; margin-bottom:20px;" id="productsPerfomance">
                <center>
                  <p  style="text-transform:uppercase">
                    {{productPerformance}} performance metrics
                  </p>
                  
                </center>

                                  <div class="productPerf" id="chart">
                  </div>
               </div>



                 
              </div>


             



              	
        </div> 
        </div>
      </div>
      <!-- <siteFooter></siteFooter> -->
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import navBar from "../navBar.vue";
import sideBar from "../sideBar.vue";
import axios from "axios";
import siteFooter from "../dashboard/siteFooter.vue";
import Spinner from 'vue-simple-spinner';
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import Raphael from 'raphael/raphael'
global.Raphael = Raphael
import { DonutChart,BarChart, LineChart ,AreaChart } from 'vue-morris'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
 import vmodal from 'vue-js-modal';
 const groupBy = require('lodash/groupBy');
 import moment from 'moment'
 import ApexCharts from 'apexcharts'
Vue.use(vmodal)

import modal from 'vue-modality'
import { indexOf } from '@amcharts/amcharts4/.internal/core/utils/Array';
var dayjs = require('dayjs')
am4core.useTheme(am4themes_animated);


export default {
  name: "dashboard",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Spinner,
    DonutChart, BarChart, LineChart, AreaChart,
    modal,
    DatePicker,
    ApexCharts
    // highcharts
  },
  
  data(){
    return {
      totalProducts:0,
      totalCompanies:0,
      totalProductCategories:0,
      totalSubscibers:0,
      monthlyDownloads:0,
      maximumVisitors:0,
      totalManufacturers:0,
      mobileUsers:[],
      desktopUsers:[],
      product_cat:null,
      categoryImpressions:[],
      allCountRecords:[],
      selectPeriod:null,
      SelectOption:'monthly',
      yearMonths:[
        '01','02',"03","04","05","06","07","08","09","10","11","12"
      ],
      productsMonths:[
        'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
      ],
      graphLabel:"month",
      printGraphData:true,
      loaderGraphData:false,
      categoryImpressionsBtn:true,
      allselectedProducts:[],
      xKeyValue:"month",
      noData:null,
      generaatedMessage:null,
      productPerformance:'Products',
      colorArray: ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', 
		  '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
		  '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', 
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', 
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', 
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', 
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'],
      categoriesColors:[],
      topStore:"-",
      loaderStoreStats:true,
      storeStatsBrn:false
    }
  }, methods:{
  
    selectedDates:function(v)
    {
      this.categoryImpressions = [];
      if(v[0]== null && v[1]==null)
      {
          this.SelectOption ="monthly"
         const grouped = this.allselectedProducts.reduce((grouped, product) => {
                                           const key = this.getMonthName(product.date);
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
  
                    Object.keys(grouped).forEach(el => {
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.cat_name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});
                        let elm = {"month":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })
                        this.categoryImpressions.push(elm)                           
                    });

      }else{
         this.SelectOption = v[0]+" to "+v[1];
      this.printGraphData =true
      this.noData  = null;
      axios
        .get("api/getCategorySelectionsByDates?from="+v[0]+"&to="+v[1])
        .then((response) => {
          if (response.data.status === 200){ 

              if( response.data.record.length == 0)
              {
                  Vue.$toast.open({
                    message: "No data set was found",
                    type: "info",
                    position: "top",
                });
                this.printGraphData = false;
                this.noData = "No data was found for "+ this.SelectOption;
              }else{
                  const grouped = response.data.record.reduce((grouped, product) => {
                                            const key = this.getMonthName(product.date);
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
  
                    Object.keys(grouped).forEach(el => {
                      
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.cat_name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"month":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })

                        this.categoryImpressions.push(elm)                           
                    })


                  const categories =  response.data.record.reduce((byCat, product) => {
                                            const key = product.cat_name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});
                 
                       
                this.product_cat = Object.keys(categories);
               
              }
        
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
    getAllProductsPerform:function()
    {

        axios
          .get("api/getProductsPerformance")
          .then((response) => {
            if (response.data.status === 200){ 

              this.seriesData  = [];
              this.monthTotals = [];

               const grouped = response.data.record.reduce((grouped, product) => {

                                            //const monthKey =  new Date(product.date).getMonth()
                                            const key = product.product_name;
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});

                                            console.log(grouped)
                                           
                    Object.keys(grouped).forEach(el => {
                      
                       const byCat =  grouped[el].reduce((byCat, product) => {

                                            const mKey = new Date(product.date).getMonth()
                                            const key = this.productsMonths[mKey];
                                            
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"name":el} 
                        let monthData = [0,0,0,0,0,0,0,0,0,0,0,0];

                        Object.keys(byCat).forEach(cat_ => {
                          let monthIndex = this.productsMonths.indexOf(cat_)
                            monthData[monthIndex] = byCat[cat_].length;
                            elm['data'] = monthData  
                        })
                      this.monthTotals.push(elm)
                    })
              
                var options = {
                  chart: {
                          type: 'line'
                        },
                        series: this.monthTotals,
                        xaxis: {
                          categories: this.productsMonths
                        }
                      }

                var chart = new ApexCharts(document.querySelector("#chart"), options);

                chart.render();
              
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
    },
   
  
    openFilterModal:function(){
      this.showCustomDate = false;
        this.$refs.filterModal.open()
    },
     groupTimesBy:function(theList, unit = 'week', timeParamName = 'date'){
      var toReturn = {};
      for(let listItem of theList) {
          const paramName = dayjs.unix(listItem[timeParamName]).startOf(unit).unix();
          if(toReturn[paramName] == null) {
              toReturn[paramName] = [];
          }
          toReturn[paramName].push(listItem);
      }
    },
    selectFilterOption:function(event)
    {
        event.preventDefault();  
        this.SelectOption = event.target.options[event.target.options.selectedIndex].text;
        
        //event.target.innerText;
        this.graphLabel = event.target.value;
        this.xKeyValue = event.target.value
    },
   
    getMonthName:function(val)
    {
        const month =  new Date(val).getMonth();
       //return this.yearMonths[month];
        return new Date(val).getFullYear()+"-"+this.yearMonths[month];
    },
 
 
  },
    mounted() 
    {
    this.getAllProductsPerform();
    }
};
</script>
<style scoped>
.deviceMetrics{
  width: 100%;
  height: 500px;
}
.categorySelections{
  width: 100%;
  height: 500px;
}

.productPerf{
  width: 100%;
  height: 500px;
}
.container-fluid {
  margin-top: 10px;
}
.main-panel {
  overflow: auto;
  max-height: calc(100vh - 30px);
  min-height: 100%;
}

.info-box {
    min-height: 100px;
    background: #fff;
    width: 100%;
    box-shadow: 0 5px 20px rgb(0 0 0 / 10%);
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 10px;
}

.bg-b-green {background: linear-gradient(45deg, #2ed8b6, #59e0c5);}
.bg-b-blue {background: linear-gradient(45deg, #4099ff, #73b4ff);}



.info-box-icon {
    float: left;
    height: 70px;
    width: 70px;
    text-align: center;
    font-size: 30px;
    line-height: 74px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 100%;
}

.info-box-content {
    padding: 10px 10px 10px 0;
    margin-left: 90px;
}

.info-box-text, .progress-description {
    display: block;
    font-size: 16px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 400;
}

.state-overview {
    color: #fff;
}

.info-box .progress {
    background: rgba(0, 0, 0, 0.2);
    margin: 5px -10px 5px 0;
    height: 2px;
}

.progress {
    border: 0;
    background-image: none;
    filter: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    height: 8px;
    border-radius: 0 !important;
    margin: 0;
}

.progress {
    display: flex;
    height: 1rem;
    overflow: hidden;
    font-size: .75rem;
    background-color: #e9ecef;
    border-radius: .25rem;
}

</style>
