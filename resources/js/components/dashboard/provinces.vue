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
                                        placeholder:'Search Provinces'
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
                            >DELET</button>
                         
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

                     <modal ref="signaturePad" title="Signature Pad"  :hide-ok="true" @cancel="$refs.signaturePad.hide()" centered>
                      
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Province Details</h4>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" v-model="name"  />
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Population</label>
                          <input type="text" class="form-control" v-model="population"  />
                        </div>
                      </div>
                    </div>
                  
                   
                    <button
                   
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="addProvince($event)"
                    >{{text}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
                    
                      
                        
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
import "vue-toast-notification/dist/theme-default.css";
import "vue-loading-overlay/dist/vue-loading.css";
import Loading from "vue-loading-overlay";
Vue.use(Loading);
Vue.use(VueToast);
import vueSignature from "vue-signature"
import modal from 'vue-modality'
import Spinner from 'vue-simple-spinner'
export default {
  name: "provinces",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Loading,
    VueGoodTable,
    vueSignature,
    modal,
    Spinner
  },
  data() {
    return {
      showWarning:false,
      data_name:"provinces",
      message:"Ensure you have saved your signature",
      isLoading:true,
      worker_id:"",
      saving:false,
      text:"Save",
      option:[],
      name:"",
      population:"",
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
          label: "Population",
          field: "population",
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
  methods: {
    openModal()
    {
       this.$refs.signaturePad.open();
    },
    ok(){
     // alert("Ensure you have saved your signature")
      this.showWarning = true;
      this.$refs.signaturePad.hide();
    },
     addProvince(event){
          

     this.saving =true;
     this.text =""
      event.preventDefault();
      let data = {
         name:this.name,
        population:this.population
      };
      axios
    .post("api/province" , data)
    .then((response) => {
     this.saving =false;
     this.text ="Save"
     if(response.data.status ==201)
     {
          Vue.$toast.open({
            message: response.data.message,
            type: response.data.type,
            position: response.data.position,
          });
           this.$refs.signaturePad.hide();
           setTimeout(() => {
             this.loadItems()
           }, 2000);
           
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
       
      
      deleteRecord:function(record)
      {
        this.worker_id = record.id;

         this.isLoading =true
        axios
        .delete("api/deleteProvince?id="+ record.id+"&data_name="+this.data_name)
        .then((response) => {
              this.isLoading =false
          if (response.data.status === 204) {
         //  this.removeItems(record.id)
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


        
        //this.$refs.signaturePad.open()
      },
     removeItems: function () {
      // arguments[0].forEach((ele) => {
        const item = this.rows.findIndex((p) => p.slug === arguments[0]);
        this.rows.splice(item, 1);
     // });
    },
    fieldFn(rowObj) {
  if(rowObj.status ===1)
  {
    return "Active"
  }else{
      return "In-active"
  }
 
},
    openEdit:function()
    {
         this.$store.commit("putClient", arguments[0]);
             this.$router.push("/edit-client");
    },
    openCalendar: function () {
        this.isLoading =true
        axios
        .delete("api/client/"+  arguments[0].slug)
        .then((response) => {
              this.isLoading =false
          if (response.data.status === 204) {
           this.removeItems(arguments[0].slug)
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
        .get("api/getProvinces?data_name="+this.data_name)
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.totalRecords = response.data.provinces.length;
            this.rows = response.data.provinces;
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
};
</script>
<style scoped>
.days {
  float: right;
}
.checkbox {
  height: 13px;
}
.form-control {
  padding: 0px;
  height: 20px;
}
.main-panel {
  overflow: auto;
  max-height: calc(100vh - 30px);
  min-height: 100%;
}

.align {
  display: block;
}
</style>
