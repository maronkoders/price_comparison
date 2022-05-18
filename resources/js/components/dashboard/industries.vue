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
                                        placeholder:'Search Industries'
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

        <modal ref="industryPad" title="ADD INDUSTRY"   no-close-on-backdrop no-close-on-esc hide-cancel  :hide-ok="true" @cancel="$refs.industryPad.hide()" centered  >
                      
            
                  <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="name"  />
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
                    <div class="clearfix"></div>
                  </form>
                      
        </modal>

        <modal ref="editIndustryPad" title="EDIT INDUSTRY" no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true" @cancel="$refs.editIndustryPad.hide()" centered>
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
Vue.use(Toaster, {timeout: 5000})
export default {
  name: "industries",
  components: {
    navBar,
    sideBar,
    siteFooter,
    VueGoodTable,
    modal,
    Spinner
  },
   data() {
    return {
      showWarning:false,
      isLoading:true,
      saving:false,
      text:"Save",
      editText:"Edit",
      option:[],
      data_name:"industries",
      name:"",
      company_name:null,
      id:"",
      server_error:null,
      modalTitle:"ADD INDUSTRY",
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        {
          label: "Name",
          field: "name",
        },
        {
          label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
    };
  },
  methods:{
    openModal()
    {
       this.$refs.industryPad.open();
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
                name:this.name,
            };
            axios
            .post("api/newIndustry?data_name=industry" , data)
            .then((response) => {
            this.saving =false;
            this.text ="Save"
            if(response.data.status == 201)
            {
                 this.$toaster.success(response.data.message);
                this.name ="";
                this.$refs.industryPad.hide();
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
        .get("api/getIndustries?data_name="+this.data_name)
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
  }
}
  </script>