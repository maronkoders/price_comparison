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
                    :rows="promotions"
                    @on-page-change="onPageChange"
                    @on-sort-change="onSortChange"
                    @on-column-filter="onColumnFilter"
                    @on-per-page-change="onPerPageChange"
                   
                    :isLoading.sync="isLoading"
                    :search-options="{
                                        enabled: true,
                                        width: '100px',
                                        placeholder:'Search Catalog Promotions Queue'
                                    }"
                    :sort-options="{
                                        enabled: true,
                                        initialSortBy: {
                                            field: 'promotion_text',
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

                    <router-link to="/add_new_promotion">

                      <button class="btn btn-small"  style="margin-right:10px;">ADD PROMO</button>
                    </router-link>

                       <button class="btn btn-small"  @click="openHeaderPromoModal($event)" style="margin-right:10px;">ADD HEADER PROMO</button>

                      <!-- <router-link to="/add_header_promotion">

                      <button class="btn btn-small"  style="margin-right:10px;">ADD HEADER PROMO</button>
                    </router-link> -->
                     
                     
                        

                      
                     
                    </div>

                      <div slot="table-row" slot-scope="props">

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


                     <modal ref="addPromo" title="NEW PROMO"  height="700px"  no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.addPromo.hide()" centered>
                      
            
                 
                      


        </modal>


                   <modal ref="editPromo" title="EDIT PROMO"   no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.editPromo.hide()" centered>
                      
            
                  <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Company</label>
                             <v-select   :options="companies"    label="name"  v-model="company_id"></v-select>
                        
                        </div>
                      </div>


  
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Promo Text</label>
                      
                               <textarea type="text" class="form-control" v-model="promotion_text"> </textarea>
                        
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



        
                   <modal ref="headerPromo" title="ADD HEADER PROMO"   no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.headerPromo.hide()" centered>
                      
            
                  <form>
                    <div class="row">

                      
                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                      
                          
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
                      </div>
                     

                    </div>
                  
                    <button
                   
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="addHeaderPromo($event)"
                    >{{text}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
                      


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
import 'vue-loading-overlay/dist/vue-loading.css';
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
 import vSelect from 'vue-select'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment'
import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
Vue.use(VueFileAgent);


Vue.use(Toaster, {timeout: 5000})
export default {
  name: "catalog_promotion",
  components: {
    navBar,
    sideBar,
    siteFooter,
    VueGoodTable,
    modal,
    Spinner,
    vSelect,
    DatePicker
  },
   data() {
    return {
    
        promotion_text:null,
        text:"ADD",
        editText:"EDIT",
        isLoader: false,
      showWarning:false,
      isLoading:true, 
      saving:false,
      columns: [
         {
          label: "is active",
          field: "is_active",
          hidden: true,
        },
        {
          label: "id",
          field: "id",
          hidden: true,
        },{
          label: "Company",
          field: "company_id",
          hidden:true
        },{
          label: "Company Name",
          field: 'company.name',
        },{
          label: "Promotion Text",
          field: 'promotion_text'
        },
        {
          label: "Start Date",
          field: 'start_date' ,
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: ' do MMM yy',
        },
         {
          label: "End Date",
          field: 'end_date',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: ' do  MMM yy',
        },
        {
          label: "Status",
          field: this.getStatus,
        },
        //  {
        //   label: "Date",
        //   field: this.latestDate
        // },
        {
          label: "Action",
          field: "btn",
          html: true,
        },
      ],
      promotions:[],
      companies:[],
      company_id:null,
      period :null,
      promo_period:null,
         uploadUrl: window.origin+'/api/uploadFile',
      uploadHeaders: { 'X-Test-Header': 'vue-file-agent'},
      fileRecordsForUpload: [],
      filePath:null,
    };
  },
  methods:{
      addHeaderPromo:function(event)
      {
        event.preventDefault();
        this.text =null 
        this.saving = true;

        let form = {
          'path' : this.filePath
        }
          
         axios
            .post('api/saveFileUpload',form ).then((response) => {
            this.text ="ADD" 
        this.saving = false;
          if(response.data.status == 201)
          {

            this.$refs.headerPromo.hide();
                Vue.$toast.open({
                  message: response.data.message,
                  type: "success",
                  position: "top",
                });

          }else{
            
              Vue.$toast.open({
                  message: response.data.message,
                  type: "error",
                  position: "top",
                });
          }
        })
        .catch((error) => {
           this.text ="ADD" 
        this.saving = false;
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });

      },
       deleteUploadedFile: function (fileRecord) {
        this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, fileRecord);
      },
      filesSelected: function (fileRecordsNewlySelected) {

        let formData = new FormData();
        formData.append('file', fileRecordsNewlySelected[0].file);
         axios
            .post('api/uploadFile', formData,
        { headers: {
            'Content-Type': 'multipart/form-data'
        }}
          )
        .then((response) => {
          if(response.data.status == 200)
          {
            this.filePath = response.data.file;
          
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
    openHeaderPromoModal:function(event)
    {

        this.$refs.headerPromo.open()
    },
    removeItems:function()
    {
           arguments[0].forEach((ele) => 
      {
        const item = this.rows.findIndex((p) => p.id === arguments[0]);
        this.rows.splice(item, 1);
      });
    },
    deleteRecord:function(record)
    {
        this.isLoading =true
        axios
        .delete("api/deletePromotion?id="+ record.id+"&data_name=promotions")
        .then((response) => {
          this.isLoading =false
          if (response.data.status === 204) {
            this.removeItems(record.id)
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
    checkPeriod:function(rowObj)
    {
        return ( moment(String(new Date())).format('YYYY-MM-DD')  <  rowObj.end_date)
                      ? "IN QUEUE"
                      : "EXPIRED";
    },
    getStatus:function(rowObj)
    {
        return rowObj.is_active ?  "RUNNING" : this.checkPeriod(rowObj);
    },
      latestDate:function(rowObj)
      {
        console.log("date", rowObj.created_at)
      },
  
    closeThemodal:function()
    {
        this.EditCompanyProducts = true;
        this.saving =false;
        this.editText = "Edit"
        this.$refs.companyProducts.hide();
    },
    getCompanies()
    {
        axios
        .get("api/getCompanies?data_name=companies")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.companies = response.data["companies"];
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
    openDefaultModal:function()
    { 
       this.$refs.addPromo.open();
    },
     removeItems: function ()
    {
        const item = this.promotions.findIndex((p) => p.id === arguments[0]);
        this.promotions.splice(item, 1);
    },
 
    openEditModal(record)
    {
      this.companies.forEach(el =>{
            if(el.id  == record.company_id)
            {
                  this.company_id = el.name
            }
      })
        this.id = record.id;
        this.promotion_text = record.promotion_text;
        this.$refs.editPromo.open();
    },
    editIndustry(event)
    {
        this.saving = true;
        this.editText =""
            event.preventDefault();
            let data = {
                id:this.id,
                
               company_id: this.company_id.id ==null ? this.getCompanyId() : this.company_id.id,
               promotion_text:this.promotion_text
            };
            axios
            .put("api/updatePromotions", data)
            .then((response) => {
            this.saving =false;
            this.editText ="Edit"
            if(response.data.status == 200)
            {
                this.$toaster.success(response.data.message);
                this.$refs.editPromo.hide();
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
    },clearFields()
    { 
      this.promotion_text = null;
      this.industry_id = null;
    },addIndustry(event)
    {
        
            this.saving =true;
            this.text =""
            event.preventDefault();
            let data = {
              company_id:this.company_id.id,
              promotion_text: this.promotion_text,
              is_active:1,
              start_date:null,
              end_date:null
            };
            axios
            .post("api/newPromotion?data_name=promotion" , data)
            .then((response) => {
            this.saving =false;
            this.text ="Save"
            if(response.data.status == 201)
            {
                this.$toaster.success(response.data.message);
                this.clearFields();
                this.$refs.addPromo.hide();

                setTimeout(() => {
                    this.loadItems()
                }, 3500);
                
            }else{
                this.$toaster.error(response.data.message);
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
        .get("api/getPromotions?data_name=promotions")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.promotions = response.data["promotions"];
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
  },
  mounted()
  {
    this.getCompanies()
  }
}
  </script>

  <<style scoped>
  #chartdiv {
  width: 100%;
  height: 500px;
}

</style>