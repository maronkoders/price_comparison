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
                    ref="skus"
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
                                        placeholder:'Search Skus'
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
                     
                        <button class="btn btn-small" @click="openModal($event)" modalName="Add Population" style="margin-right:10px;">NEW</button>
                     
                    </div>
                    <!-- <div slot="selected-row-actions">
                      <button @click="activateSelected('activate')">Multiple Activate</button>
                      <button @click="deactivateSelected('deactivate')">Multiple De-activate</button>
                    </div>-->

                    <div slot="table-row" slot-scope="props">
                       <span v-if="props.column.field == 'companyProductsBtn'">
                        <div style="display:flex;">
                            <button
                              @click="getCompanyProducts(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >ACTIVATE</button>
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

        <modal ref="cityPad" title="ADD SKU"   no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true" @cancel="$refs.cityPad.hide()" centered>
                      
            
                  <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="name"/>
                        </div>
                      </div>

                      <div class="col-md-12 pr-1">
                            <div class="form-group">
                            <label> Unit of measurement </label>
                            <input type="text" class="form-control" v-model="measurement"/>
                            </div>
                        </div>
                    

                 <!-- <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Industry</label>
                           <v-select  v-model="industry_id" :options="industries"  label="name"  ></v-select>
                        
                        </div>
                      </div> -->

                        

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

        <modal ref="editcityPad" title="EDIT SKU"  no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.editcityPad.hide()" centered>
                <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="name" />
                        </div>
                      </div>

                       <!-- <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Industry</label>
                          <select class="form-control" v-model="industry_id"> 
                            <option v-for="industry in industries" :key="industry.id" :value="industry.id">
                                {{industry.name}}
                               </option>
                          </select>

                        
                        </div>
                      </div> -->

                         <div class="col-md-12 pr-1">
                            <div class="form-group">
                            <label> Unit of measurement </label>
                            <input type="text" class="form-control" v-model="measurement"/>
                            </div>
                        </div>
                    

                 <!-- <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Industry</label>
                           <v-select  v-model="industry_id" :options="industries"  label="name"   ></v-select>
                        
                        </div>
                      </div> -->

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
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";
Vue.use(VueToast);
import modal from 'vue-modality'
import Spinner from 'vue-simple-spinner'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
  name: "skus",
  components: {
    navBar,
    sideBar,
    siteFooter,
    VueGoodTable,
    modal,
    Spinner,
    vSelect
  },
   data() {
    return {
      showWarning:false,
      isLoading:true,
      saving:false,
      EditCompanyProducts:false,
      allCompanyProductsLoader:false,
      text:"Save",
      editText:"Edit",
      option:[],
      data_name:"skus",
      name:"",
      id:"",
      industry_id:"",
      measurement:"", 
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        // {
        //   label: "Industry",
        //   field: "industry_id",
        //   hidden:true
        // },
        {
          label: "Name",
          field: "name",
        },
        // {
        //   label: "Industry",
        //   field: this.getIndustryName,
        // },
         {
          label: "Unit",
          field: "measurement"
        },
        {
        label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
      industries:[]
    };
  },
  methods:{
  closeThemodal:function()
  {
    this.EditCompanyProducts = true;
    this.saving = false;
    this.editText = "Edit"
    this.$refs.companyProducts.hide();
  },
  
    getIndustryName(rowObj)
    { 
       let record = this.industries.find(el=> el.id === rowObj.industry_id)
       return  (record!= undefined) ? record.name : null ;
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
      
       this.name =null;
       this.measurement=null;
       this.$refs.cityPad.open();
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
        .delete("api/deleteSkus?id="+ record.id+"&data_name="+this.data_name)
        .then((response) => {
          this.isLoading =false
          if (response.data.status === 204) {
           // this.removeItems(record.id)
             Vue.$toast.open({
              message: response.data.message,
              type: response.data.type,
              position: response.data.position,
            });
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
    openEditModal(record)
    {
        this.name = record.name;
        this.id = record.id;
        this.measurement = record.measurement;

        // this.industries.forEach(industry =>
        // {
        //     if(industry.id == record.industry_id)
        //     {
        //       this.industry_id = industry.name
        //     }
        // });

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
               is_active: this.is_active,
               measurement:this.measurement
            };
            axios
            .put("api/updateSkus", data)
            .then((response) => {
            this.saving =false;
            this.editText ="Edit"
            if(response.data.status == 200)
            {
                Vue.$toast.open({
                    message: response.data.message,
                    type: response.data.type,
                    position: response.data.position,
                });
               
                this.$refs.editcityPad.hide();
                setTimeout(() => {
                    this.loadItems()
                }, 3500);
                
            }else{
                Vue.$toast.open({
                            message: response.data.message,
                            type: response.data.type,
                            position: response.data.position,
                        });
                }
            })
                .catch((error) => {
                this.saving = false;
                this.text ="Save"
                Vue.$toast.open({
                    message: response.message,
                    type: "error",
                    position: "top",
                });
                });
    },
     addIndustry(event)
    {
            this.saving =true;
            this.text ="";
            event.preventDefault();
            let data = {
              name:this.name,
              // industry_id: this.industry.id,
              measurement:this.measurement
            };
            axios
            .post("api/newSkus?data_name="+this.data_name, data)
            .then((response) => {
            this.saving =false;
            this.text ="Save"
            if(response.data.status == 201)
            {
                Vue.$toast.open({
                    message: response.data.message,
                    type: response.data.type,
                    position: response.data.position,
                });
                this.name = null;
                this.site_link = null;
                this.$refs.cityPad.hide();
                setTimeout(() => {
                    this.loadItems()
                }, 3500);
                
            }else{
                Vue.$toast.open({
                            message: response.data.message,
                            type: response.data.type,
                            position: response.data.position,
                        });
                }
            })
                .catch((error) => {
                this.saving = false;
                this.text ="Save"
                Vue.$toast.open({
                    message: response.message,
                    type: "error",
                    position: "top",
                });
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
        .get("api/getSkus?data_name="+this.data_name)
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.totalRecords = response.data[this.data_name].length;
            this.rows = response.data[this.data_name];
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