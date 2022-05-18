<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-5"> 

              <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12 pl-1">
                                                <div class="form-group">
                                                    <label>Company (disabled)</label>
                                                    <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                                                </div>
                                            </div>
                                            <div class="col-md-12 pl-1">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" :value="user_data[0].name.toUpperCase()" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="col-md-12 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" :value="user_data[0].email"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Phone Number</label>
                                                    <input type="email" :value="user_data[0].phone"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                       
                                       
                  
                      
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>



                     


            </div>
            <div class="col-lg-7">
                 <form v-show="addForm">
                    <div class="row">
                    
                     <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Tier</label>
                          <v-select  v-model="tier" :options="subscriptionTiers"  label="name"></v-select>  
                          <span style="color:red;">
                            {{server_error}}
                          </span>
                        </div>
                      </div>


                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Start Date</label>
                       
                           <date-picker v-model="startDate" valueType="format"></date-picker>
                        
                          <span style="color:red;">
                            {{server_error}}
                          </span>
                        </div>
                      </div>

                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> End Date</label>
                        
                           <date-picker v-model="endDate" valueType="format"></date-picker>
                          <span style="color:red;">
                            {{server_error}}
                          </span>
                        </div>
                      </div>


                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Status</label>
                          

                            <v-select  v-model="status" :options="statuses"></v-select>  
                      
                          <span style="color:red;">
                            {{server_error}}
                          </span>
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

                      <button
                      style="margin-left:10px;"
                   
                     
                      class="btn btn-info btn-fill pull-left"
                      @click="cancelAddSubscription($event)"
                    >Cancel
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>

              <div class="content-panel" v-show="subscriptionTable">
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
                                        placeholder:'Search Subscription'
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
                                        position: 'bottom',
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
                    
                        <button @click="openSubscriptionForm($event)" class="btn btn-small"  modalName="Add Population" style="margin-right:10px;">NEW</button>
                     
                    </div>
                    <!-- <div slot="selected-row-actions">
                      <button @click="activateSelected('activate')">Multiple Activate</button>
                      <button @click="deactivateSelected('deactivate')">Multiple De-activate</button>
                    </div>-->

                    <div slot="table-row" slot-scope="props">
                         <span v-if="props.column.field == 'isActive'">
                        <div style="display:flex;">
                          <label> YES</label> <input type="radio" :name="props.formattedRow.name"   v-bind:checked="props.formattedRow.is_active==1"    @change="(e)=> changeStatus(1,props.formattedRow)" />
                          <label> NO</label> <input type="radio" :name="props.formattedRow.name"  v-bind:checked="props.formattedRow.is_active ==0"   @change="(e)=> changeStatus(0,props.formattedRow)"/>
                        </div>
                      </span>
                      <span v-if="props.column.field == 'btn'">
                        <div style="display:flex;">
                            <button
                              @click="deleteRecord(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >Disable</button>

                             <button
                              @click="openMoreDetails(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >Edit</button>
                         
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


        <!-- <modal ref="editIndustryPad" title="EDIT INDUSTRY" no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true" @cancel="$refs.editIndustryPad.hide()" centered>
                <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="company_name"  />
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
        </modal> -->

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
import siteFooter from "../dashboard/siteFooter.vue";
import { VueGoodTable } from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
import axios from "axios";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import modal from 'vue-modality'
import Spinner from 'vue-simple-spinner'
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import vSelect from 'vue-select'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

Vue.use(Toaster, {timeout: 5000})
export default {
  name: "users",
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
      showWarning:false,
      isLoading:true,
      saving:false,
      text:"Save",
      editText:"Edit",
      option:[],
      data_name:"users",
      status:null,
      id:"",
      server_error:null,
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        {
          label: "Tier",
          field: "tier",
        },
          {
          label: "Start Date",
          field: "startDate",
        },
        {
          label: "End Date",
          field: "endDate",
        },
        {
          label: "Status",
          field: "status",
        },
        {
          label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
      companies:[],
      manufacturers:[],
      user_data:[],
      tier:null,
      startDate:null,
      endDate:null,
      addForm:false,
      subscriptionTable:true,
      slug:this.$store.state.userToken,
      representative_option:null,
      subscriptionTiers:[
          {name:'Monthly'},
          {name:'Quarterly'},
          {name:'Yearly'}
      ],
      statuses:['inactive','running','expired'  
      ]
    };
  },
  mounted(){
    this.getCompanies()
    this.getManufactures();
  },
  methods:{
    clearSubPayload:function()
    {
        this.tier =null;
        this.startDate =null;
        this.endDate =null;
    },
    openSubscriptionForm:function () {
        this.addForm = true
        this.subscriptionTable = false
    },
    cancelAddSubscription:function(event)
    {
      event.preventDefault()
        this.clearSubPayload();
        this.addForm = false
        this.subscriptionTable = true
    },
    changeRepOption:function(e)
    {
      this.companies_id = null;
      this.hiringCompanies = e.target.value == "manufacturers"
                              ? this.manufacturers
                              : this.companies;
    },
    getCompanies:function()
    {
          axios
          .get("api/getCompanies?data_name=companies")
          .then((response) => {
            if (response.data.status === 200) {
              this.companies = response.data['companies'];
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
    
      changeStatus:function(e, record)
      {
     this.isLoading =true
        axios
        .put("api/updateUser?id="+ record.id+"&is_active="+e+"&updateType=status")
        .then((response) => {
          this.isLoading =false
          if (response.data.status === 200) {
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
      },
    openMoreDetails(record)
    {
      this.$router.push({name:'user_data',query:{user_token:record.slug}})
    },
     removeItems: function () {
      this.$toaster.success(arguments[0].data.message)
      const item = this.rows.findIndex((p) => p.id == arguments[1].id);
      this.rows.splice(item, 1);
    },
    deleteRecord(record)
    {
         this.isLoading =true
        axios
        .delete("api/deleteIndustry?id="+ record.id+"&data_name="+this.data_name)
        .then((response) => {
          this.isLoading = false
         
         return (response.data.status === 204) 
           ? this.removeItems(response, record)
           : this.$toaster.error(response.data.message);
        })
        .catch((error) => {
              this.isLoading = false;
              this.$toaster.error(error.message);
        });

    },
    openModal:function()
    {   
        this.$refs.industryPad.open();
    },
    openEditModal(record)
    {
        this.company_name = record.name;
        this.id = record.id;
        this.$refs.editIndustryPad.open();
    },
    editIndustry(event)
    {
         this.saving =true;
            this.editText =""
            event.preventDefault();
            let data = {
                name:this.company_name,
                id:this.id
            };
            axios
            .put("api/updateIndustry", data)
            .then((response) => {
            this.saving =false;
            this.editText ="Edit"
            if(response.data.status == 200)
            {
              this.$toaster.success(response.data.message);
 
              this.$refs.editIndustryPad.hide();
              setTimeout(() => {
                    this.loadItems()
              }, 3500);
          
            }else{
               this.$toaster.error(response.data.message);
                }
            })
                .catch((error) => {
                this.saving = false;
                this.text ="Save"
                 this.$toaster.error(error.message);
                });

    },
     addIndustry(event)
    {
        
            this.saving =true;
            this.text =""
            event.preventDefault();
            let data = {
                tier:this.tier['name'],
                startDate:this.startDate,
                endDate:this.endDate,
                slug:this.slug,
                status:this.status
            };
            axios
            .post("api/saveSubscription", data)
            .then((response) => {
            this.saving =false;
            this.text ="Save"
            if(response.data.status == 201)
            {
                 this.$toaster.success(response.data.message);
                 this.clearSubPayload();
                  this.addForm = false
                  this.subscriptionTable = true
                
                setTimeout(() => {
                    this.loadItems()
                }, 3500);
                
            }else{
                this.$toaster.error(response.data.message);
                }
            })
                .catch((error) => {
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
       this.isLoading =true
      axios
        .get("api/getSubscriptions?slug="+this.slug)
        .then((response) => {
           this.isLoading = false
          if (response.data.status === 200) {
            this.rows = response.data.data
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
    getUserInfo:function()
    {
      axios
        .get("api/getUsers?data_name=user&slug="+this.slug)
        .then((response) => {
          if (response.data.status === 200) {
          
            this.user_data = response.data['user']
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
  },mounted()
    {
      this.getUserInfo();
    }
}
  </script>