<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="content-panel">
                <div id="table">
                  <VueGoodTable
                    ref="users"
                    :columns="columns"
                    :rows="rows"
                    @on-page-change="onPageChange"
                    @on-sort-change="onSortChange"
                    @on-column-filter="onColumnFilter"
                    @on-per-page-change="onPerPageChange"
                   
                    :isLoading.sync="isLoading"
                    :search-options="{
                                        enabled: true,
                                        width: '100px',
                                        placeholder:'Search Companies'
                                    }"
                    :sort-options="{
                                        enabled: true,
                                        initialSortBy: {
                                            field: 'name',
                                            type: 'asc'
                                        }
                                    }"
                    :pagination-options="{
                                        enabled: true,
                                        mode: 'pages',
                                        perPage: 10,
                                        position: 'top',
                                        perPageDropdown: [25, 50, 100],
                                        dropdownAllowAll: false,
                                        setCurrentPage: 1,
                                        nextLabel: 'next',
                                        prevLabel: 'prev',
                                        rowsPerPageLabel: 'Rows per page',
                                        ofLabel: 'of',
                                        pageLabel: 'page', // for 'pages' mode
                                        allLabel: 'All'
                                    }"
                  >
                 


                    <div slot="table-actions">
                     
                        <button class="btn btn-small" @click="openDefaultModal($event)" modalName="Add Population" style="margin-right:10px;">SET AS DEFAULT</button>

                         <button class="btn btn-small" @click="openModal($event)" modalName="Add Population" style="margin-right:10px;">NEW</button>
                     
                    </div>
                    <!-- <div slot="selected-row-actions">
                      <button @click="activateSelected('activate')">Multiple Activate</button>
                      <button @click="deactivateSelected('deactivate')">Multiple De-activate</button>
                    </div>-->

                    <div slot="table-row" slot-scope="props">
                       <!-- <span v-if="props.column.field == 'companyProductsBtn'">
                        <div style="display:flex;">
                            <button
                              @click="getCompanyProducts(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >ACTIVATE</button>
                        </div>
                      </span> -->

                        <span v-if="props.column.field == 'isActive'">
                        <div style="display:flex;">
                          <label> YES</label> <input type="radio" :name="props.formattedRow.name"   v-bind:checked="props.formattedRow.is_active==1"    @change="(e)=> changeCompanyStatus(1,props.formattedRow)" />
                          <label> NO</label> <input type="radio" :name="props.formattedRow.name"  v-bind:checked="props.formattedRow.is_active ==0"   @change="(e)=> changeCompanyStatus(0,props.formattedRow)"/>
                        </div>
                      </span>


                      <span v-if="props.column.field == 'impressionDetails'">
                        <div style="display:flex;">
                          <button
                              @click="viewCompanyImpressions(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >VIEW</button>
                        </div>
                      </span>


                      

                      
                      <span v-if="props.column.field == 'costperclick'">
                        <div style="display:flex;">
                            <button
                              @click="visitorChoice(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >VISITOR CHOICE</button>
                        </div>
                      </span>

                      <span v-if="props.column.field == 'btn'">
                        <div style="display:flex;">
                            <button
                              @click="deleteRecord(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >DELETE</button>

                             <button
                              @click="openEditModal(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >EDIT</button>
                         
                        </div>
                        
                      </span>

                      
                      <span v-else>
                        {{
                        props.formattedRow[
                        props.column.field
                        ]
                        }}
                      </span>
                    </div>
                  </VueGoodTable>

        <modal ref="cityPad" title="ADD COMPANY"   no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.cityPad.hide()" centered>
                      
            
                  <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="name"/>
                        </div>
                      </div>


                       <!-- <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Company Logo</label>
                          
                           <VueFileAgent
                              ref="vueFileAgent"
                              :theme="'list'"

                              :deletable="true"
                              :meta="true"
                              :accept="'image/*'"
                              :maxSize="'2MB'"
                              :maxFiles="1"
                              :helpText="'Choose png images '"
                              :errorText="{
                                type: 'Invalid file type. Only png images allowed',
                                size: 'Files should not exceed 60MB in size',
                              }"
                              @select="filesSelected($event)"
                              @beforedelete="onBeforeDelete($event)"
                              @delete="fileDeleted($event)"
                              v-model="fileRecords"
                            ></VueFileAgent>
                         
                        </div>
                      </div> -->


                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Industry</label>
                          <select class="form-control" v-model="industry_id"> 
                            <option v-for="industry in industries" :key="industry.id" :value="industry.id">
                                {{industry.name}}
                               </option>
                          </select>

                        
                        </div>
                      </div>

                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Site Link</label>
                      
                               <input type="text" class="form-control" v-model="site_link"  />
                        
                        </div>
                      </div>
                      
                      
                    </div>
                  
                    <button
                   
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="addIndustry($event)"
                    >{{text}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
                      
        </modal>

        <modal ref="editcityPad" title="EDIT COMPANY"  no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.editcityPad.hide()" centered>
                <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="name" />
                        </div>
                      </div>

                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Industry</label>
                          <select class="form-control" v-model="industry_id"> 
                            <option v-for="industry in industries" :key="industry.id" :value="industry.id">
                                {{industry.name}}
                               </option>
                          </select>

                        </div>
                      </div>

                            <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Site Link</label>
                            <input type="text" class="form-control" v-model="site_link"/>
                        
                        </div>
                      </div>

                                    
                    </div>
                  
                    <button
                   
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="editIndustry($event)"
                    >{{editText}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>           
              </modal>


                <modal ref="companyProducts" title="COMPANY PRODUCTS" width="600px"  no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.companyProducts.hide()" centered>
                <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        
                        <ul  class="list-group" style="margin-bottom:10px;" v-if="allCompanyProducts.length > 0"> 
                                <table class="table table-bordered">
                                <thead>
                                  <tr>
                                  
                                    <th scope="col">Name</th>
                                    <th scope="col">Activated</th>
                                    <th scope="col">Deactivated</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr  v-for="(item, index) in allCompanyProducts" :key="index">
                                      <td>
                                          <b style="text-transform:uppercase;"> {{item.product.name}} </b>
                                      </td>

                                    <td>  <input  type="radio" :name="item.product.name" v-bind:checked="item.is_show == 1"  :value="yes"  @change="(e)=> changeStatus('yes',item)" /></td>
                                    <td>
                                      <input  type="radio"  :name="item.product.name" v-bind:checked="item.is_show== 0"   :value="no"  @change="(e)=> changeStatus('no',item)" />
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                        </ul>
                              
                               
                        <ul  class="list-group" style="margin-bottom:10px;" v-else>
                                <li class="list-group-item">
                                <b style="text-transform:uppercase;"> {{selectedCompanyName}} has  no listed products</b> 
                                  </li>
                               </ul>

                            
                                 
                      </div>                      
                    </div>
                  
                    <button
                      type="submit"
                      v-show="EditCompanyProducts"
                      class="btn btn-info btn-fill pull-left"
                      @click="editProductStatuses($event)"
                    >{{editText}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>           
              </modal>

               <modal ref="impressionPad" title="COMPANY IMPRESSION DETAILS" width="980px"  :hide-ok="true"   no-close-on-backdrop no-close-on-esc hide-cancel  @cancel="$refs.impressionPad.hide()" centered>
                
                    <div class="row">
                      <div class="col-md-12 pr-1">
                         <Spinner v-show="getImpressionsLoader" size="Medium"></Spinner>
                            <fusioncharts
                              :type="type"
                              :width="width"
                              :height="height"
                              :dataFormat="dataFormat"
                              :dataSource="dataSource"
                              ></fusioncharts>  
                      </div>                      
                    </div>
                  
                   
                    <div class="clearfix"></div>
                    
              </modal> 


        <modal ref="defaultCompany" title="SELECT DEFAULT COMPANY" width="400px"  :hide-ok="true"   no-close-on-backdrop no-close-on-esc hide-cancel  @cancel="$refs.defaultCompany.hide()" centered>

               <form v-show="selectIndustry">
                    <div class="row">
                      
                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Industry</label>
                          <select class="form-control" v-model="default_industry_id" @change="changedIndustry($event)"> 
                            <option v-for="industry in industries" :key="industry.id" :value="industry.id"  >  
                                {{industry.name}}
                               </option>
                          </select>
                        </div>
                      </div>
                    </div>
                </form>  

                <table class="table"  ref="formContainer"  v-show="industryCompanies">
                    <thead>
                      <tr>
                        <th scope="col">Company Name</th>
                        <th scope="col">Is Default </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="company in filteredCompaniedPerIndustry" :key="company.id">
                        <td>
                          
                          <span v-if="company.is_default">

                          {{company.name}}
                        <br />
                          <h5>  <span class='badge badge-secondary'>
                              DEFAULT
                            </span>
                          </h5>

                          </span>
                          <span v-else> {{company.name}}
                          </span>
                          </td>
                        <td>
                          <div class="custom-control custom-radio custom-control-inline" v-if="company.is_default">
                           <input type="checkbox" checked disabled>
                        </div>

                          <div class="custom-control custom-radio custom-control-inline" v-else>
                           <input type="checkbox"    @input="isSelectedAdDefault($event,company)">
                        </div>

                        </td>
                      </tr>
                    </tbody>
                  </table>

                <Spinner v-show="loadingCompanies" size="medium" message="Loading Comapnies..."></Spinner>
                 
              </modal> 


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
import siteFooter from "./siteFooter.vue";
import { VueGoodTable } from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
import axios from "axios";
import modal from 'vue-modality'
import Spinner from 'vue-simple-spinner'
import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.use(VueFileAgent);
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})
export default {
  name: "companies",
  components: {
    navBar,
    sideBar,
    siteFooter,
    VueGoodTable,
    modal,
    Loading,
    Spinner
  },
   data() {
    return {
      isLoader: false,
      fullPage: true,
      showWarning:false,
      isLoading:true,
      saving:false,
      EditCompanyProducts:false,
      allCompanyProductsLoader:false,
      text:"Save",
      editText:"Edit",
      option:[],
      data_name:"companies",
      name:"",
      id:"",
      industry_id:"",
      filePath:"",
      site_link:null,
      is_active:null,
      default_industry_id:null,
      selectIndustry:true,
      industryCompanies:false,
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        {
          label: "Industry",
          field: "industry_id",
          hidden:true
        },
         {
          label: "link",
          field: "site_link",
          hidden:true
        },
        //  {
        //   label: "Default",
        //   field: 'is_default'
        // },
        {
          label: "Name",
          field: "name",
        },
        {
          label: "Industry",
          field: this.getIndustryName,
        },
        //  {
        //   label: "Company Products",
        //   field: "companyProductsBtn",
        //   html: true,
        // },{
          {
          label: "Status",
          field: "isActive",
          html:true
        },{
          label: "Total Selection Impression",
          field: "company_selection_count.length"
        },
         {
          label: "is active",
          field: "is_active",
          hidden:true
        },
        //  {
        //   label: "Impression Details",
        //   field: "impressionDetails",
        //   html: true,
        // },
        {
        label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
      industries:[],
      activatedCompanies:[],
      filteredCompaniedPerIndustry:[],
      fileRecords: [],
      uploadUrl: window.origin+'/api/uploadFile',
      uploadHeaders: { 'X-Test-Header': 'vue-file-agent'},
      fileRecordsForUpload: [],
      allCompanyProducts:[],
      statusChangePayload:[],
      selectedCompanyName:null,
      chartData:[],
      companyStatus:null,
      companyRecord:null,
      getImpressionsLoader:false,
      loadingCompanies:false,
      width: "100%",
      height: "400",
      type: "timeseries",
      dataFormat: "json",
      dataSource: {
        chart: {},
        caption: {
          text: "Cariaco Basin Sampling"
        },
        subcaption: {
          text: "Analysis of O₂ Concentration and Surface Temperature"
        },
        yaxis: [
          {
            plot: [
              {
                value: "O2 concentration",
                connectnulldata: true
              }
            ],
            min: "3",
            max: "6",
            title: "O₂ Concentration (mg/L)"
          },
          {
            plot: [
              {
                value: "Surface Temperature",
                connectnulldata: true
              }
            ],
            min: "18",
            max: "30",
            title: "Surface Temperature (°C)",
            orientation: "right"
          }
        ]
    }
    };
  },
  methods:{
    changedIndustry:function(event)
    {
        this.loadingCompanies = true;
        this.selectIndustry = false;
        this.filteredCompaniedPerIndustry =[];
       
        this.activatedCompanies.forEach(company => {
            if(company.industry_id ==  event.target.value)
            {
                this.filteredCompaniedPerIndustry.push(company)
                this.loadingCompanies = false
            }
        });

        setTimeout(() => {
          this.industryCompanies = true;
        }, 1000);

    },
    
    isSelectedAdDefault:function(event, company)
    { 
       let  loader = this.$loading.show({
                    container:  this.$refs.formContainer,
                    canCancel: false});

         axios.put('api/updateCompany?id='+company.id+'&is_default='+1+'&industry_id='+this.default_industry_id)
        .then((response) => 
        {
            this.$refs.defaultCompany.hide();
            this.loadItems();
           setTimeout(() => { 
              if(response.data.status == 200)
              {
                this.$toaster.success(response.data.message)
              }else{
                this.$toaster.error(response.data.message)  
              }
            }, 1000);
        })
        .catch((error) => 
        {
        
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
    },
    viewCompanyImpressions:function(record)
    {
      this.getImpressionsLoader = true;
      this.$refs.impressionPad.open();
      axios.get('api/getTotalCompanyCounts?company_id='+record.id).then((response) => 
        {
            this.getImpressionsLoader = false;
            if(response.data.status == 200)
            {

              const groups =  response.data.record.reduce((groups, count) => {
                const date = count.date;
                if (!groups[date]) {
                  groups[date] = [];
                }
                groups[date].push(count);
                return groups;
              }, {});


            const groupArrays = Object.keys(groups).map((date) => {
              return [ date,groups[date].length];
            });

              const data = groupArrays;
              const schema = [{
                                "name": "Time",
                                "type": "date",
                                "format": "%Y-%m-%d"
                              }, {
                                "name": "Daily Visitors",
                                "type": "number"
                              }];


              const fusionTable = new FusionCharts.DataStore().createDataTable(
                data,
                schema
              );
              this.dataSource.data = fusionTable;
               

            }
        })
        .catch((error) => 
        {
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });

        });

      
      
    },
    showStatusNames:function(record)
    {
      //  return record.is_active ? 'YES' :'NO';
    },
    onChangeEventHandler:function(event)
    {
      ///console.log("attribute", event.target.getAttribute('companyDetails'));
      //event.value = (event.value)? false : true;log

      axios.put('api/updateCompany?company_id='+this.companyRecord).then((response) => 
        {
          console.log("response", response.data)
            if(response.data.status == 200)
            {
                this.$refs.selectionChart.open();
            }
        })
        .catch((error) => 
        {
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });

        });

    },
    updateRecord:function()
    {
        axios.put('api/updateProductAttributes?id='+arguments[0]+'&is_show='+arguments[1]+'&company_id='+arguments[2])
        .then((response) => 
        {
            console.log(response.data);
        })
        .catch((error) => 
        {
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
    },

   getExecutionTime:function (startTime) {
      let now = Date.now();
     return Math.floor((now - startTime)/1000);
      return seconds; 
  },

  closeThemodal:function()
  {
    this.EditCompanyProducts = true;
    this.saving =false;
    this.editText = "Edit"
    this.$refs.companyProducts.hide();
  },
    editProductStatuses:function(event)
    { 
      event.preventDefault();
      this.saving = true;
      this.editText = null;
      if(this.statusChangePayload.length > 0)
      {
        let start_time = Date.now();
        this.statusChangePayload.forEach(element => 
        {
            this.updateRecord(element.product.id, element.is_show, element.product.company_id);
        });

         var request_time = this.getExecutionTime(start_time);
        this.closeThemodal();
         setTimeout(() => {
             Vue.$toast.open({
                  message: "Statuses has been updated",
                  type: "success",
                  position: "top",
                });
         }, request_time);

      }else{
      this.closeThemodal();
          Vue.$toast.open({
                  message: "No changes has been made",
                  type: "info",
                  position: "top",
                });
       }
    },
    changeStatus:function(e, item)
    {
        let data  = {
           is_show:(e == "yes")?1:0,
           product:item
         }
        this.statusChangePayload.push(data);
    },
     changeCompanyStatus:function(e, record)
    {
        this.isLoading =true
        axios
        .put("api/updateCompany?id="+ record.id+"&is_active="+e)
        .then((response) => {
          this.isLoading =false
          if (response.data.status === 200) {
            
           // this.removeItems(record.id)
             Vue.$toast.open({
              message: response.data.message,
              type: response.data.type,
              position: response.data.position,
            });

            this.loadItems();
          } else {
            Vue.$toast.open({
              message: response.data,
              type: "error",
              position: "top",
            });
          }
        })
        .catch((error) => {
          this.isLoading =false
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });



        this.Loading = true;
        // let data  = {
        //    is_show:(e == "yes")?1:0,
        //    product:item
        //  }
        // this.statusChangePayload.push(data);
    },

    getCompanyProducts:function(record)
    { 
         axios
            .get('api/getCompanyProducts?data_name=product_attributes&company_id='+record.id,
            { headers: {
                'Content-Type': 'multipart/form-data'
            }}
          )
        .then((response) => {
          if(response.data.status == 200)
          {
            this.allCompanyProducts = response.data.product_attributes;
            if(this.allCompanyProducts.length > 0)
            {
              this.EditCompanyProducts =true
            }else{
              this.selectedCompanyName = record.name
              this.EditCompanyProducts = false;
            }
             this.$refs.companyProducts.open();
          }else{
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
    deleteUploadedFile: function (fileRecord) {
        // Using the default uploader. You may use another uploader instead.
        this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, fileRecord);
      },
      filesSelected: function (fileRecordsNewlySelected) {

        let formData = new FormData();
        formData.append('file', fileRecordsNewlySelected[0].file);
        formData.append('foldername','company_logos')
         //this.fileRecords[0].name ="Uploading";
         axios
            .post(this.uploadUrl, formData,
        { headers: {
            'Content-Type': 'multipart/form-data'
        }}
          )
        .then((response) => {
          if(response.data.status == 200)
          {
            this.filePath = response.data.file;
          //   this.fileRecords[0].name ="File has been saved"
            // var validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error);
            // this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords);
          
          }else{
              this.fileRecords = [];
              Vue.$toast.open({
                  message: response.data.message,
                  type: "error",
                  position: "top",
                });
          }
        })
        .catch((error) => {
          this.fileRecords=[]
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
      },
      onBeforeDelete: function (fileRecord) {
        var i = this.fileRecordsForUpload.indexOf(fileRecord);
        if (i !== -1) {
        // queued file, not yet uploaded. Just remove from the arrays
          this.fileRecordsForUpload.splice(i, 1);
          var k = this.fileRecords.indexOf(fileRecord);
          if (k !== -1) this.fileRecords.splice(k, 1);
        } else {
          if (confirm('Are you sure you want to delete?')) {
            this.$refs.vueFileAgent.deleteFileRecord(fileRecord); // will trigger 'delete' event
          }
        }
      },
      fileDeleted: function (fileRecord) {
        var i = this.fileRecordsForUpload.indexOf(fileRecord);
        if (i !== -1) {
          this.fileRecordsForUpload.splice(i, 1);
        } else {
          this.deleteUploadedFile(fileRecord);
        }
      },
    getIndustryName(rowObj)
    { 
       let record = this.industries.find(el=> el.id === rowObj.industry_id)
       return  (record!= undefined) ? record.name : null ;
    },
    getTotalCount(rowObj)
    {
      return rowObj.company_selection_count.length
    },
    getIndustries()
    {
        axios
        .get("api/getIndustries?data_name=industries")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.industries = response.data["industries"];
          } else {

            Vue.$toast.open({
              message: response.data.message,
              type: "error",
              position: "top",
            });
          }
        })
        .catch((error) => {
             this.isLoading =false
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
    },
    openModal()
    {
       this.site_link =null;
       this.$refs.cityPad.open();
    },
    openDefaultModal:function()
    {
      this.selectIndustry = true;
      this.default_industry_id = null;
      this.industryCompanies = false;
      this.loadingCompanies = false;
      this.$refs.defaultCompany.open();
    },
     removeItems: function ()
    {
      arguments[0].forEach((ele) => 
      {
        const item = this.rows.findIndex((p) => p.id === arguments[0]);
        this.rows.splice(item, 1);
      });
    },
    deleteRecord(record)
    {
        this.isLoading =true
        axios
        .delete("api/deleteCompany?id="+ record.id+"&data_name="+this.data_name)
        .then((response) => {
          this.isLoading =false
          if (response.data.status === 204) {
           // this.removeItems(record.id)
            this.$toaster.success(response.data.message);
          } else {
            this.$toaster.error(response.data.message);
          }
        })
        .catch((error) => {
          this.isLoading = false;
          this.$toaster.error(error.message);
        });
    },
    openEditModal(record)
    {
        this.name = record.name;
        this.id = record.id;
        this.industry_id = record.industry_id;
        this.site_link = record.site_link;
        this.$refs.editcityPad.open();
    },
    editIndustry(event)
    {
        this.saving = true;
        this.editText =""
            event.preventDefault();
            let data = {
                name:this.name,
                id:this.id,
               industry_id: this.industry_id,
               site_link:this.site_link
            };
            axios
            .put("api/updateCompany", data)
            .then((response) => {
            this.saving =false;
            this.editText ="Edit"
            if(response.data.status == 200)
            {
                this.$toaster.success(response.data.message);
                this.$refs.editcityPad.hide();
                setTimeout(() => {
                    this.loadItems()
                }, 3500);
                
            }else{

              this.$toaster.error(response.data.message);
              
                }
            }).catch((error) => {
                this.saving = false;
                this.text ="Save";
                this.$toaster.error(error.message);
              });
    },
     addIndustry(event)
    {
        
            this.saving =true;
            this.text =""
            event.preventDefault();
            let data = {
              name:this.name,
              industry_id: this.industry_id,
              logo_path:"samplepath",
              site_link:this.site_link
            };
            axios
            .post("api/newCompany?data_name=company" , data)
            .then((response) => {
            this.saving =false;
            this.text ="Save"
            if(response.data.status == 201)
            {
                this.$toaster.success(response.data.message);
                this.name = null;
                this.site_link = null;
                this.$refs.cityPad.hide();

                setTimeout(() => {
                    this.loadItems()
                }, 3500);
                
            }else{
                this.$toaster.error(error.message);
              }
            }).catch((error) => {

              this.saving = false;
              this.text ="Save"

              this.$toaster.error(error.message);   
          });
    },
         updateParams(newProps) {
      this.serverParams = Object.assign({}, this.serverParams, newProps);
    },
            onPageChange(params) {
      this.updateParams({ page: params.currentPage });
      this.loadItems();
    },

    onPerPageChange(params) {
      this.updateParams({ perPage: params.currentPerPage });
      this.loadItems();
    },

    onSortChange(params) {
      this.updateParams({
        // sort: [
        //   {
        //     type: params.sortType,
        //     field: this.columns[params.columnIndex].field,
        //   },
        // ],
      });
      this.loadItems();
    },

    onColumnFilter(params) {
      this.updateParams(params);
      this.loadItems();
    },
    loadItems() {
      this.isLoading = true
      axios
        .get("api/getCompanies?data_name="+this.data_name)
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.totalRecords = response.data[this.data_name].length;
            this.rows = response.data[this.data_name];
            this.activatedCompanies = [];
            this.rows.forEach(company =>{
              if(company.is_active)
              {
                this.activatedCompanies.push(company)
              }
            })
          } else {
             this.$toaster.error(error.message);
          }
        })
        .catch((error) => {
             this.isLoading = false
             this.$toaster.error(error.message);
        });
    },
  },
  mounted()
  {
    this.getIndustries();
  }
}
  </script>

  <<style scoped>
  #chartdiv {
  width: 100%;
  height: 500px;
}

</style>