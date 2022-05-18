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
                                        placeholder:'Search Product Categories'
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
                      <span v-if="props.column.field == 'isActive'">
                        <div style="display:flex;">
                          <label> YES</label> <input type="radio" :name="props.formattedRow.name"   v-bind:checked="props.formattedRow.is_active==1"    @change="(e)=> changeCategoryStatus(1,props.formattedRow)" />
                          <label> NO</label> <input type="radio" :name="props.formattedRow.name"  v-bind:checked="props.formattedRow.is_active ==0"   @change="(e)=> changeCategoryStatus(0,props.formattedRow)"/>
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

        <modal ref="industryPad" title="ADD CATEGORY"  no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.industryPad.hide()" centered>
                      
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
                          <label>Industry</label>
                             <v-select  v-model="industry_id" :options="industries"  label="name"></v-select>                      
                        </div>
                      </div>

                        <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Size Unit</label>

                           <v-select  multiple  v-model="size_unit_id"  :options="product_sizes"  label="name"></v-select> 
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

        <modal ref="editIndustryPad" title="EDIT CATEGORY"  no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.editIndustryPad.hide()" centered>
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
                          <label>Industry</label>
                             <v-select  v-model="industry_id"  :options="industries"  label="name"></v-select>
                                                 
                        </div>
                      </div>

                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Size Unit</label>

                           <v-select multiple  v-model="size_unit_id"  :options="product_sizes"  label="name"></v-select> 
                        </div>
                      </div>

                      
                       <!-- <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Is Active</label>

                          <select class="form-control"  v-model="is_active">
                                                 <option  :value="1"  :selected="is_active ==1" > 
                                                   YES
                                    </option>
                                     <option  :value="0"   :selected="is_active ==0"> 
                                                    NO
                                    </option>
                          </select>

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
  name: "categories",
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
      text:"Save",
      editText:"Edit",
      option:[],
      data_name:"categories",
      industries_data:"industries",
      name:"",
      id:"",
      industry_id:"",
      size_unit_id:"",
      modalTitle:"ADD INDUSTRY",
     // categories:[]
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        {
          label: "Name",
          field: "name",
        },{
          label: "industry",
          field: "industry_id",
          hidden:true
        },
         {
          label: "Units",
          field: this.getUnitDetails,
        },
        {
          label: "Status",
          field: "isActive",
          html:true
        },
         {
          label: "size",
          field: "sku_id",
          hidden:true
        },
           {
          label: "is active",
          field: "is_active",
          hidden:true
        },
        {
          label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
      industries:[],
      sku_name:null,
      sku_id:null,
      size_unit_id:null,
      product_sizes:[],
      cat_sku: [],
      is_active:null
    };
  },
  methods:{
      changeCategoryStatus:function(e, record)
    {
        this.isLoading =true
        axios
        .put("api/updateCategory?id="+ record.id+"&is_active="+e+"&updateType=status")
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



        this.Loading = true;
        // let data  = {
        //    is_show:(e == "yes")?1:0,
        //    product:item
        //  }
        // this.statusChangePayload.push(data);
    },
    getIndustryName:function(rowObj)
    {
        this.industries.forEach(industry =>{
            if(industry.id ==  rowObj.id)
            {
                return industry.name;
            }
        })
    },
    // pickSizeUnits:function(record)
    // {
    //   this.product_sizes = [];
    //   this.size_unit_id =null;
    //     this.skus.forEach(sku => {
    //       if(sku.industry_id == record.id)
    //       {
    //         this.product_sizes.push(sku);
    //       }
    //     })
    // },
    getCategories:function(event)
    {
       this.isLoading =true
        axios
        .delete("api/deleteCategory?id="+ record.id+"&data_name="+this.data_name)
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
    openModal()
    {
      this.name = null;
      this.industry_id = null;
      this.size_unit_id = null;
      this.$refs.industryPad.open();
    },
     removeItems: function () {
       arguments[0].forEach((ele) => {
        const item = this.rows.findIndex((p) => p.id === arguments[0]);
        this.rows.splice(item, 1);
      });
    },
    deleteRecord(record)
    {
         this.isLoading =true
        axios
        .delete("api/deleteCategory?id="+ record.id+"&data_name="+this.data_name)
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
        this.industries.forEach(industry => 
        {
            if(industry.id == record.industry_id)
            {
               this.industry_id = industry.name;
            }
        });

        let all_units  = []
        this.cat_sku.forEach(size => 
          {
              if(size.product_category_id == record.id)
              {
                  all_units.push(size.sku)
                  this.size_unit_id = all_units
              }
        });

        this.$refs.editIndustryPad.open();
    },
    getUnitDetails:function(rowObj)
    {
        let found_name  =[]
        this.cat_sku.forEach(el => {
              if(el.product_category_id === rowObj.id)
              {
                 found_name.push(el.sku.name);
              }
        })

        return found_name

    },
    getIndustryId:function()
    {
        if(typeof arguments[0] == "string")
        {
             let i =  this.industries.findIndex(el => arguments[0] == el.name)
              return this.industries[i].id  
        }

        if(typeof arguments[0] == "object")
        {
           return arguments[0].id
        }
    },
    editIndustry(event)
    {
          this.saving = true;
          this.editText = "";

          event.preventDefault();
            let data = {
                name:this.name,
                id:this.id,
                industry_id: this.getIndustryId(this.industry_id),
                sku_id: this.size_unit_id
            };
            axios
            .put("api/updateCategory", data)
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
                 this.size_unit_id  = [];
                this.$refs.editIndustryPad.hide();
                setTimeout(() => {
                    this.loadItems()
                    this.$router.go()
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
                    message: error.message,
                    type: "error",
                    position: "top",
                });
                });

    },
     addIndustry(event)
    {
        
            this.saving =true;
            this.text =""
            event.preventDefault();
            let data = {
                name:this.name,
                industry_id:this.industry_id.id,
                sku_id:this.size_unit_id,
                is_active:0
            };
            axios
            .post("api/newCategory?data_name=category" , data)
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
                this.name ="";
                this.$refs.industryPad.hide();
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
    getSkus()
    {
      axios
        .get("api/getSkus?data_name=skus")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.product_sizes = response.data["skus"];
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

    getIndustries()
    {
     
      axios
        .get("api/getIndustries?data_name="+this.industries_data)
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
         
            this.industries = response.data[this.industries_data];
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
    getCategorySku:function()
    {
        axios
        .get("api/getProductCategorySku?data_name=cat_sku")
        .then((response) => {
          if (response.data.status === 200) {
            this.cat_sku = response.data['cat_sku'];
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
    loadItems() {
      this.isLoading =true
      axios
        .get("api/getCategories?data_name="+this.data_name)
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
    
    this.getSkus();
    this.getIndustries();
    this.getCategorySku();
 
  }
}
  </script>