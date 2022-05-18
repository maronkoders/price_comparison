<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">

          	<div class="row">

              
						  <!-- <div class="col-xl-3 col-md-3 col-6">
                    <router-link to="/product-categories">
								<div class="info-box bg-b-green">


									<span class="info-box-icon push-bottom" style="color:white">
                    <i class="nc-icon nc-app"></i>
                    
                    </span>
									<div class="info-box-content">
										<span class="info-box-text" style="color:white">Product Categories</span>
										<span class="info-box-number" style="color:white">{{totalProductCategories}}</span>
										<!-- <div class="progress">
											<div class="progress-bar" style="width: 45%"></div> 
										</div> 
										<!-- <span class="progress-description">
											45% Increase in 28 Days
										</span>
									</div>
								
								</div>
						    </router-link>
							</div>

                <div class="col-xl-3 col-md-3 col-6">
                <router-link to="/manufacturers">
								<div class="info-box bg-b-blue">
									<span class="info-box-icon push-bottom" style="color:white">
                    <i class="nc-icon nc-bag"></i>
                    
                    </span>
									<div class="info-box-content">
										<span class="info-box-text" style="color:white"> Manufacturers</span>
										<span class="info-box-number" style="color:white">{{totalManufacturers}}</span>
										
									</div>
									
								</div>
                </router-link>
							</div>

              

                <div class="col-xl-3 col-md-3 col-6">
                       <router-link to="/subscribers">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom" style="color:white">
                    <i class="nc-icon nc-app"></i>
                    
                    </span>
									<div class="info-box-content">
										<span class="info-box-text" style="color:white">Subscribers</span>
										<span class="info-box-number" style="color:white">{{totalSubscibers}}</span>
										<!-- <div class="progress">
											<div class="progress-bar" style="width: 45%"></div> 
										</div> -->
										<!-- <span class="progress-description">
											45% Increase in 28 Days
										</span> 
									</div>
									
								</div>
                       </router-link>
							
							</div>

               <div class="col-xl-3 col-md-3 col-6">
                     <router-link to="/companies">
								<div class="info-box bg-b-blue">
									<span class="info-box-icon push-bottom" style="color:white">
                    <i class="nc-icon nc-bag"></i>
                    
                    </span>
									<div class="info-box-content">
										<span class="info-box-text" style="color:white">Companies</span>
										<span class="info-box-number" style="color:white">{{totalCompanies}}</span>
										<!-- <div class="progress">
											<div class="progress-bar" style="width: 45%"></div> 
										</div> -->
										<!-- <span class="progress-description">
											45% Increase in 28 Days
										</span> 
									</div>
						
								</div>
                     </router-link>
							
							</div> -->


                <div class="col-xl-3 col-md-3 col-6">
                   
								<div class="info-box bg-b-blue">
									<span class="info-box-icon push-bottom" style="color:white">
                    <i class="nc-icon nc-bag"></i>
                    
                    </span>
									<div class="info-box-content">
										<span class="info-box-text" style="color:white">Monthly Downloads</span>
										<span class="info-box-number" style="color:white">{{monthlyDownloads}}</span>
										<!-- <div class="progress">
											<div class="progress-bar" style="width: 45%"></div> 
										</div> -->
										<!-- <span class="progress-description">
											45% Increase in 28 Days
										</span> -->
									</div>
									<!-- /.info-box-content -->
								</div>
                   
                 
								<!-- /.info-box -->
							</div>

              
                <div class="col-xl-3 col-md-3 col-6">

                   <router-link to="/store-metrics">
                   
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom" style="color:white">
                    <i class="nc-icon nc-bag"></i>
                    
                    </span>
									<div class="info-box-content" tooltip="Click to view more">
										<span class="info-box-text" style="color:white">Monthly Top  Store</span>
										<span class="info-box-number" style="color:white">{{topStore}}</span>
										
										<!-- <span class="progress-description">
										  45 counts
										 </span> -->
                     
									</div>
									<!-- /.info-box-content -->
								</div>
                 </router-link>
                 
								<!-- /.info-box -->
							</div>

              
                <div class="col-xl-3 col-md-3 col-6">
                  </div>
                  
                <div class="col-xl-3 col-md-3 col-6">
                  </div>



                <div class="col-xl-3 col-md-3 col-6">
              
                </div>
                                              




            </div>




         
                               
             

        <div class="row">                 
                
          <div class="col-xl-12 col-md-12 col-12" style="margin-top:20px; margin-bottom:20px;" id="categoryImpressions">

            <center>
           
            <p class="text-muted">
              <h6>

              {{generaatedMessage}}

              </h6>
              </p>
            </center>

         


                   <div   v-show="printGraphData">
                        <div class="col-md-12 pr-1">

              

                        <div v-show="categoryImpressionsBtn">
                            <!-- <button id="modal" @click="openFilterModal($event)" class="btn btn-small" style="margin-right:10px;">Filter</button> -->
                          <!-- <button class="btn btn-small dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter By
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" @click="CatfilterBy($event,'week')">Week</a>
                            <a class="dropdown-item" href="#"  @click="CatfilterBy($event,'month')" >Month</a>
                            <a class="dropdown-item" href="#" @click="CatfilterBy($event,'year')" >Year</a>
                          </div>

                          
                                  
                                  <date-picker placeholder="Custom Dates" @input="selectedDates"   v-model="selectPeriod" valueType="format" range></date-picker> -->
                              
                        </div>

                  

               
                       
                      </div>


                     <div id="catImpressions">
                        <Spinner v-show="loaderGraphData"  message="Loading data"></Spinner>
                     </div>
                    <!-- <line-chart
                      id="line"
                      :data="categoryImpressions"
                      :xkey="xKeyValue"
                      :ykeys="product_cat"
                      :labels="product_cat"
                      :xLabels="graphLabel"
                      :line-colors="colorArray"
                      grid-text-weight="bold"
                      resize="true"
                    >
                  </line-chart> -->
                  </div>

               <center>
                 <p>
                    {{noData}}
                  </p>
                </center>   

                 

               
           

            </div>

              <div class="col-xl-12 col-md-12 col-12" style="margin-top:20px; margin-bottom:20px;" id="productsPerfomance">
                
                        
                           <form>
                             <div class="row">
                                <div class="col-md-4 pr-1">
                                  <div class="form-group">
                              <v-select   :options="totalManufacturers" @input="theGetManufacturer"  label="name"  v-model="manufacturer_record"></v-select>
                                  </div>
                                </div>
                             </div>
                           </form>
                          
                <center>
                 
                  
                </center>
                  <Spinner v-show="loaderGraphData"  message="Loading data"></Spinner>

                                  <div id="chart">
                                     
                  </div>
               </div>



							<div class="col-xl-6 col-md-12 col-12">
                <div class="totalVisitors" ref="totalVisitors">
                </div>
              </div>

              	<div class="col-xl-6 col-md-12 col-12">
                  <div class="deviceMetrics" id="chartdiv" > 
                  </div>
                 
              </div>


             

            <modal ref="filterModal" title="Filter" no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true" @cancel="$refs.filterModal.hide()" centered>
                <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Filter Option</label>
                         <select class="form-control" @change="selectFilterOption($event)"> 
                          <option value="">Select Option</option>
                           <option value="week">Weekly</option>
                           <option value="month">Monthly</option>
                           <option value="year">Yearly</option>
                           <!-- <option value="custom">Custom Date</option> -->
                         </select>
                        </div>
                      </div>

                   
                    </div>
                    <button
                      class="btn btn-info btn-fill pull-left"
                      @click="applyFilter($event)"
                    >
                    Apply
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>           
              </modal>


              	
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

 import vSelect from 'vue-select'
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
    ApexCharts,
    vSelect
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
      totalManufacturers:[],
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
      topStore:"--",
      loaderStoreStats:true,
      storeStatsBrn:false,
      categorySeriesData: [],
      manufacturer_record:null,
      allProductsP:[],
      productSeriesData:[],
      showProdPerf:true
    }
  }, methods:{
    theGetManufacturer:function()
    {   
      document.getElementById('chart').style.display = "none";
      this.loaderGraphData = true
      this.productPerformance = this.manufacturer_record.name+"'s Products";
      this.productSeriesData = [];
      let allManufacturerProducts = [];
      this.allProductsP.forEach(element =>{
          if(element.manufacturer_id === this.manufacturer_record.id)
          {
            allManufacturerProducts.push(element);
          }
      })
    
      const grouped = allManufacturerProducts.reduce((grouped, product) => {
                    const key = product.product_name;
                    return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
                                           
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
                      this.productSeriesData.push(elm)
                    })
              
                var options = {
                   title: {
                        text: this.productPerformance +' Performance Metrics',
                        align: 'center'
                      },
                  chart: {
                        height: '350px',
                          type: 'line'
                        },
                        series: this.productSeriesData,
                        xaxis: {
                          categories: this.productsMonths,
                          title: {
                            text: 'Month'
                          }
                        },
                          yaxis: {
                        title: {
                          text: 'Total'
                        },
                      },
                      }

                var chart = new ApexCharts(document.querySelector("#chart"), options);

                chart.render();
              this.loaderGraphData = false
              document.getElementById('chart').style.display = "block";
    },
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
    CatfilterBy:function(event,period)
    {
      this.categorySeriesData = [];
        if(period == "week")
        {
               this.allselectedProducts =response.data.record;
               const grouped = response.data.record.reduce((grouped, product) => {

                                            //const monthKey =  new Date(product.date).getMonth()
                                            const key = product.cat_name;
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
                                           
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
                      this.categorySeriesData.push(elm)
                    })
              
                var options = {
                   title: {
                        text: this.SelectOption+' category Impressions',
                        align: 'center'
                      },
                  chart: {
                        height: '350px',
                          type: 'line'
                        },
                        series: this.categorySeriesData,
                        xaxis: {
                          categories: this.productsMonths,
                          title: {
                            text: 'Month'
                          }
                        },
                          yaxis: {
                        title: {
                          text: 'Total'
                        },
                      },
                      }

                var chart = new ApexCharts(document.querySelector("#catImpressions"), options);

                chart.render();

        }
        if(period == "year")
        {
            
             
               const grouped =  this.allselectedProducts.reduce((grouped, product) => {
                                            const key = new Date(product.date).getFullYear();
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});

                   let totalRecords =this.allselectedProducts.length;
                    let firstRecord = this.allselectedProducts[0];
                    let lastRecord = this.allselectedProducts[totalRecords-1]; 
                    let i=0;
                    let categoryYears = [];

                this.allselectedProducts.forEach(rec=> {
                        let y = new Date(rec.date).getFullYear()
                        this.categoryYears.push(year);
                })


                   
                                           
                    Object.keys(grouped).forEach(el => {
                      
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key =product.cat_name
                                           
                                     
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"name":el} 
                        let monthData = [0,0,0,0,0,0,0,0,0,0,0,0];

                        Object.keys(byCat).forEach(cat_ => {
                          let monthIndex = this.productsMonths.indexOf(cat_)
                            monthData[monthIndex] = byCat[cat_].length;
                            elm['data'] = monthData  
                        })
                      this.categorySeriesData.push(elm)
                    })
              
                var options = {
                   title: {
                        text: this.SelectOption+' category Impressions',
                        align: 'center'
                      },
                  chart: {
                        height: '350px',
                          type: 'line'
                        },
                        series: this.categorySeriesData,
                        xaxis: {
                          categories: this.productsMonths,
                          title: {
                            text: 'Year'
                          }
                        },
                          yaxis: {
                        title: {
                          text: 'Total'
                        },
                      },
                      }

                var chart = new ApexCharts(document.querySelector("#catImpressions"), options);

                chart.render();
        }
    },
    getAllProductsPerform:function()
    {

        axios
          .get("api/getProductsPerformance")
          .then((response) => {
            if (response.data.status === 200){ 

              this.productSeriesData  = [];
              this.allProductsP = response.data.record;
              const grouped = response.data.record.reduce((grouped, product) => {

                                            //const monthKey =  new Date(product.date).getMonth()
                                            const key = product.product_name;
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
     
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
                      this.productSeriesData.push(elm)
                    })
              
                var options = {
                    title: {
                        text: this.productPerformance +' Performance Metrics',
                        align: 'center'
                      },
                  chart: {
                        height: '350px',
                          type: 'line'
                        },
                        series: this.productSeriesData,
                        xaxis: {
                          categories: this.productsMonths,
                          title: {
                            text: 'Month'
                          }
                        },
                          yaxis: {
                        title: {
                          text: 'Total'
                        },
                      },
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
    asPDFStoreMetrics:function()
    {
        let today = new Date();
            today =  today.getDate()+"-"+(today.getMonth()+1)+"-"+today.getFullYear()
        event.preventDefault();
        this.storeStatsBrn = false;
         this.generaatedMessage ="Generated from Priceline on "+today;
     
        html2canvas(document.getElementById('storeMetricsGraph')).then(canvas => {
          var w = document.getElementById("storeMetricsGraph").offsetWidth;
          var h = document.getElementById("storeMetricsGraph").offsetHeight;
         
          var img = canvas.toDataURL("image/jpeg", 1);

          var doc = new jsPDF('L', 'pt', [w, h]);
          doc.addImage(img, 'JPEG', 10, 10, w, h);
          doc.save(this.SelectOption+'_store_metrics.pdf');
      
          this.storeStatsBrn = true;
            this.generaatedMessage= null;
        }).catch(function(e) {
            console.log(e.message);
        });
    },
    asPDF:function(event)
      {

        let today = new Date();
            today =  today.getDate()+"-"+(today.getMonth()+1)+"-"+today.getFullYear()
        event.preventDefault();
        this.categoryImpressionsBtn = false;
         this.generaatedMessage ="Generated from Priceline on "+today;
     
        html2canvas(document.getElementById('categoryImpressions')).then(canvas => {
          var w = document.getElementById("categoryImpressions").offsetWidth;
          var h = document.getElementById("categoryImpressions").offsetHeight;
         
          var img = canvas.toDataURL("image/jpeg", 1);

          var doc = new jsPDF('L', 'pt', [w, h]);
          doc.addImage(img, 'JPEG', 10, 10, w, h);
          doc.save(this.SelectOption+'_category_impressions.pdf');
        
          this.categoryImpressionsBtn = true;
            this.generaatedMessage= null;
      }).catch(function(e) {
          console.log(e.message);
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
    getTotalVisitors:function()
    {        
      axios
        .get("api/getTotalVisitors")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            let visitors = response.data.record;
            const groups = visitors.reduce((groups, game) => {
                const date = game.date;
                if (!groups[date]) {
                  groups[date] = [];
                }
                groups[date].push(game);
                return groups;
              }, {});

              const groupArrays = Object.keys(groups).map((date) => {
                return  groups[date].length
              });

               const d = new Date(visitors[0].date);
               let chart = am4core.create(this.$refs.totalVisitors, am4charts.XYChart);
                 chart.paddingRight = 20;
               let title =  chart.titles.create()
               title.text ="Total Visitors";
               title.fontSize = 24;

                //TODO:: ensure to render the graph using correct dates
                let data = [];
                for (let i = 0; i <= 365; i++) {
                  data.push({ date: new Date(d.getFullYear(),  d.getMonth(), i), name: "name" + i, value: groupArrays[i]});
                }

                chart.data = data;

                let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.grid.template.location = 0;

                let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.tooltip.disabled = true;
                valueAxis.renderer.minWidth = 35;

                let series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.dateX = "date";
                series.dataFields.valueY = "value";

                series.tooltipText = "{valueY.value}";
                chart.cursor = new am4charts.XYCursor();

                let scrollbarX = new am4charts.XYChartScrollbar();
                scrollbarX.series.push(series);
                chart.scrollbarX = scrollbarX;

                this.chart = chart;

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
    applyFilter:function(event)
    { 
      event.preventDefault();
      this.categoryImpressions =[];
        
           if(this.graphLabel =="week")
           {  
             let weeks =  groupBy(this.allselectedProducts, (dt) => moment(dt.date).week());

                Object.keys(weeks).forEach(el => {
                          const byCat =  weeks[el].reduce((byCat, product) => {
                                                const key = product.cat_name;
                                                return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                                }, {});

                                                   let elmentRange = weeks[el][0].date+" to "+weeks[el][weeks[el].length-1].date

                            let elm = {"week":elmentRange}
                            Object.keys(byCat).forEach(cat_ =>{
                                  elm[cat_] = byCat[cat_].length
                            })
                            this.categoryImpressions.push(elm)                           
                        })
            
           } 

           if(this.graphLabel == "month")
           {
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
           }

           if(this.graphLabel == "year")
           {
               const grouped = this.allselectedProducts.reduce((grouped, product) => {
                                            const key = new Date(product.date).getFullYear();
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
  
                    Object.keys(grouped).forEach(el => {
                      
                       const byCat =  grouped[el].reduce((byCat, product) => {
                                            const key = product.cat_name;
                                            return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                                            }, {});

                        let elm = {"year":el}
                        Object.keys(byCat).forEach(cat_ =>{
                              elm[cat_] = byCat[cat_].length
                        })

                        this.categoryImpressions.push(elm)                           
                    });
           }
          
          this.$refs.filterModal.hide();
    },
    
    getDeviceMetrics:function()
    {        
      axios
        .get("api/getDeviceMetrics")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
                response.data.record.forEach(el => el.deviceType  == "Mobile"?  this.mobileUsers.push(el) : this.desktopUsers.push(el))
                var chart = am4core.create("chartdiv", am4charts.PieChart);
                 let title =  chart.titles.create()
                  title.text ="Catalog Downloads By Device";
                  title.fontSize = 24;
                    chart.data = [{
                      "device": "Mobile",
                      "users": this.mobileUsers.length
                    }, {
                      "device": "Desktop",
                      "users": this.desktopUsers.length
                    }];

                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                       pieSeries.dataFields.value = "users";
                    pieSeries.dataFields.category = "device";
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
    getMonthName:function(val)
    {
        const month =  new Date(val).getMonth();
       //return this.yearMonths[month];
        return new Date(val).getFullYear()+"-"+this.yearMonths[month];
    },
    getCategorySelections:function()
    {
      
      this.loaderGraphData = true;
      axios
        .get("api/getCategorySelections")
        .then((response) => {
           this.loaderGraphData = false;
          if (response.data.status === 200){ 
            this.printGraphData = true;
              this.categorySeriesData  = [];
              this.allselectedProducts =response.data.record;
               const grouped = response.data.record.reduce((grouped, product) => {

                                            //const monthKey =  new Date(product.date).getMonth()
                                            const key = product.cat_name;
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {});
                                           
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
                      this.categorySeriesData.push(elm)
                    })
              
                var options = {
                   title: {
                        text: this.SelectOption+' category Impressions',
                        align: 'center'
                      },
                  chart: {
                        height: '350px',
                          type: 'line'
                        },
                        series: this.categorySeriesData,
                        xaxis: {
                          categories: this.productsMonths,
                          title: {
                            text: 'Month'
                          }
                        },
                          yaxis: {
                        title: {
                          text: 'Total'
                        },
                      },
                      }

                var chart = new ApexCharts(document.querySelector("#catImpressions"), options);

                chart.render();


                // this.allselectedProducts =response.data.record;

                //  const grouped = response.data.record.reduce((grouped, product) => {
                //                             const key = this.getMonthName(product.date);
                //                             return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                //                             }, {});
  
                //     Object.keys(grouped).forEach(el => {
                      
                //        const byCat =  grouped[el].reduce((byCat, product) => {
                //                             const key = product.cat_name;
                //                             return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                //                             }, {});

                //         let elm = {"month":el}
                //         Object.keys(byCat).forEach(cat_ =>{
                //               elm[cat_] = byCat[cat_].length
                //         })

                //         this.categoryImpressions.push(elm)                           
                //     })


                //   const categories =  response.data.record.reduce((byCat, product) => {
                //                             const key = product.cat_name;
                //                             return { ...byCat, [key]: (byCat[key]??[]).concat(product)}
                //                             }, {});
                       
                // this.product_cat = Object.keys(categories);
                //  for(var i=0; i<  this.product_cat.length;i++)
                // {
                //    this.categoriesColors.push(this.colorArray[i])
                // }
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
    getMetrics:function()
    {
      axios
        .get("api/dashboardMetrics")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            if(response.data.record.length ===0)
            {
             
             
            }else{
            this.showTasks =true
            //console.log("record", response.data.record)
            this.totalProductCategories = response.data.record.categories.total_categories
            this.totalCompanies =  response.data.record.companies.total_companies
            this.totalSubscibers = response.data.record.subscribers.total_subscribers
            this.totalManufacturers = response.data.record.manufacturers.total_manufacturers;
            this.monthlyDownloads = response.data.record.monthlyDownloads.total_monthlyDownloads
            this.topStore = response.data.record.monthlyTop.monthlyTop[0].name
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
    mounted() 
    {
    this.getMetrics();
    this.getTotalVisitors();
    this.getDeviceMetrics();
    this.getCategorySelections();
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
