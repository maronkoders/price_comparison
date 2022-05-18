<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">
        <div class="row">                 
            <div class="col-xl-12 col-md-12 col-12">
                <center style="text-transform:uppercase;">
                  {{sSelectOption}}  STORE PERFORMANCE METRICS
                </center>
                    <spinner v-show="loaderStoreStats" message="Fetching data wait.."></spinner>  

        <div id="storeMetricsGraph">

                  

            <div v-show="storeStatsBrn" style="margin:bottom:25px;">
                          <center>
                            {{generatedMessage}}
                          </center>

                           <button class="btn btn-small dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter By
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" @click="filterBy($event,'weekly')">Weekly</a>
                    <a class="dropdown-item" href="#"  @click="filterBy($event,'monthly')">Monthly</a>
                    <a class="dropdown-item" href="#"  @click="filterBy($event,'yearly')">Yearly</a>
                  </div>

                  
                                          
                <date-picker placeholder="Custom Dates" @input="selectedDates"  @clear="clearDates"  v-model="selectPeriod" valueType="format" range></date-picker>

                </div>

                         <bar-chart
                      id="bar"
                      :data="storeMetrics"
                      :xkey="xSKeyValue"
                      :ykeys="all_stores"
                      :labels="all_stores"
                      :xLabels="sgraphLabel"
                      :line-colors="colorArray"
                      grid-text-weight="bold"
                      resize="true"
                    >
                  </bar-chart>
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
import Raphael from 'raphael/raphael'
global.Raphael = Raphael
import { DonutChart,BarChart, LineChart ,AreaChart } from 'vue-morris'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
const groupBy = require('lodash/groupBy');
import moment from 'moment'
import modal from 'vue-modality'

export default {

  name: "dashboard",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Spinner,
    DonutChart, BarChart, LineChart, AreaChart,
    modal,
    DatePicker
    // highcharts
  },
  
  data(){
    return {
      all_stores:null,
      categoryImpressions:[],
      storeMetrics:[],
      allCountRecords:[],
      selectPeriod:null,
      sSelectOption:'monthly',
      yearMonths:[
        '01','02',"03","04","05","06","07","08","09","10","11","12"
      ],
      sgraphLabel:"month",
      printGraphData:true,
      loaderGraphData:false,
      allselectedProducts:[],
      xSKeyValue:"month",
      noData:null,
      duration:"monthly",
      generatedMessage:null,
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
      loaderStoreStats:true,
      storeStatsBrn:false
    }
  }, methods:{
    clearDates:function()
    {
        console.log("evented the dates");
    },
    filterBy:function(event,period){
      
      this.storeMetrics = [];
      this.sSelectOption = period
      if(period =="weekly")
      { 
         this.sgraphLabel ="week"
         this.xSKeyValue = "week"
        let weeks =  groupBy(this.allCountRecords, (dt) => moment(dt.date).week());

        Object.keys(weeks).forEach(el => {
                       const byCat =  weeks[el].reduce((byCat, company) => {
                                            const key = company.name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(company)}
                                            }, {});

                            //console.log(weeks[el])
                            let elmentRange = weeks[el][0].date +" to "+weeks[el][weeks[el].length-1].date


                        let elm = {"week":elmentRange}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })
                        this.storeMetrics.push(elm)                           
                    })
      } 

      if(period =="monthly"){
         this.ssgraphLabel ="month"
         this.xSKeyValue = "month"

         const grouped = this.allCountRecords.reduce((grouped, company) => {
                                            const key = this.getMonthName(company.date);
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(company)}
                                            }, {});
  
                Object.keys(grouped).forEach(el => {
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"month":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })
                        this.storeMetrics.push(elm)                           
                    })
       
      }

      if(period == "yearly")
      {
         this.sgraphLabel ="year"
         this.xSKeyValue = "year"
         const grouped = this.allCountRecords.reduce((grouped, company) => {
                                            const key = new Date(company.date).getFullYear();
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(company)}
                                            }, {});
  
                Object.keys(grouped).forEach(el => {
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"year":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })
                        this.storeMetrics.push(elm)                           
                    })
      }

    },  
    getTopStats:function()
    { 
       this.storeMetrics = [];
      axios
        .get("api/storeMetrics")
        .then((response) => {
          this.loaderStoreStats  = false
          
          if (response.data.status === 200){ 
            this.storeStatsBrn = true;
            this.allCountRecords = response.data.record;
                const grouped = response.data.record.reduce((grouped, company) => {
                                            const key =  this.getMonthName(company.date);
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(company)}
                                            }, {});
  
                Object.keys(grouped).forEach(el => {
                      
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"month":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })

                        this.storeMetrics.push(elm)                           
                    })

                const companies =  response.data.record.reduce((byCat, product) => {
                                            const key = product.name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});
                 
                this.all_stores = Object.keys(companies);
              
          } else {
            Vue.$toast.open({
              message: response.data.message,
              type: "error",
              position: "top",
            });
          }
        })
        .catch((error) => {
          this.loaderStoreStats = false;
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });


    },
    selectedDates:function(v)
    {

      
      this.storeMetrics = [];
      if(v[0] == null && v[1] == null)
      {

          this.sSelectOption = "Monthly"
          this.sgraphLabel ="month"
         this.xSKeyValue = "month"

          const grouped = this.allCountRecords.reduce((grouped, company) => {
                                            const key = this.getMonthName(company.date);
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(company)}
                                            }, {});
  
                Object.keys(grouped).forEach(el => {
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"month":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })
                        this.storeMetrics.push(elm)                           
                    })
         
      }else{

      this.ssSelectOption = v[0]+" to "+v[1];
      this.printGraphData =true
      this.noData  = null;
      axios
        .get("api/getStoreMetricByDate?from="+v[0]+"&to="+v[1])
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
                this.noData = "No data was found for "+ this.sSelectOption;
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

                        this.storeMetrics.push(elm)                           
                    })
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
    asPDFStoreMetrics:function()
    {
        let today = new Date();
            today =  today.getDate()+"-"+(today.getMonth()+1)+"-"+today.getFullYear()
        event.preventDefault();
        this.storeStatsBrn = false;
         this.generatedMessage ="Generated from Priceline on "+today;
     
        html2canvas(document.getElementById('storeMetricsGraph')).then(canvas => {
          var w = document.getElementById("storeMetricsGraph").offsetWidth;
          var h = document.getElementById("storeMetricsGraph").offsetHeight;
         
          var img = canvas.toDataURL("image/jpeg", 1);

          var doc = new jsPDF('L', 'pt', [w, h]);
          doc.addImage(img, 'JPEG', 10, 10, w, h);
          doc.save(this.sSelectOption+'_store_metrics.pdf');
      
          this.storeStatsBrn = true;
            this.generatedMessage= null;
        }).catch(function(e) {
            console.log(e.message);
        });
    },
  
    openFilterModal:function(){
      this.showCustomDate = false;
        this.$refs.filterModal.open()
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
    this.getTopStats();
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

.totalVisitors{
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
