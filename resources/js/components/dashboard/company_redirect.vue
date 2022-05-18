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
                    :rows="companies"
                    @on-page-change="onPageChange"
                    @on-sort-change="onSortChange"
                    @on-column-filter="onColumnFilter"
                    @on-per-page-change="onPerPageChange"
                   
                    :isLoading.sync="isLoading"
                    :search-options="{
                                        enabled: true,
                                        width: '100px',
                                        placeholder:'Search Companies Redirect'
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
                    
                  </VueGoodTable>


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
Vue.use(Toaster, {timeout: 5000})
export default {
  name: "company_redirect",
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

        isLoader: false,
      showWarning:false,
      isLoading:true, 
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        {
          label: "Company",
          field: "company_id",
          hidden:true
        },
         {
          label: "link",
          field: "site_link",
          hidden:true
        },
        {
          label: "Company Name",
          field: 'name',
        },
          {
          label: "Redirect Totals",
          field: this.getTotalCount
        },
        //  {
        //   label: "Date",
        //   field: this.latestDate
        // },
        // {
        // label: "Action",
        //   field: "btn",
        //   html: true,
        // },
      ],
      companies:[]
    };
  },
  methods:{

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
    getTotalCount(rowObj)
    {
      return rowObj.company_redirect.length
    },
    getRedirect()
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
    openModal()
    {
       this.site_link =null;
       this.$refs.cityPad.open();
    },
    openDefaultModal:function()
    {
       this.site_link =null;
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
    this.getRedirect();
  }
}
  </script>

  <<style scoped>
  #chartdiv {
  width: 100%;
  height: 500px;
}

</style>