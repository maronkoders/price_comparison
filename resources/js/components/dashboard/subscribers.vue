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
                                        placeholder:'Search Subscribers'
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
                    <!-- <div slot="table-actions">
                     
                        <button class="btn btn-small" @click="openModal($event)" modalName="Add Population" style="margin-right:10px;">NEW</button>
                     
                    </div> -->
                    <!-- <div slot="selected-row-actions">
                      <button @click="activateSelected('activate')">Multiple Activate</button>
                      <button @click="deactivateSelected('deactivate')">Multiple De-activate</button>
                    </div>-->

                    <div slot="table-row" slot-scope="props">
                      <span v-if="props.column.field == 'btn'">
                        <div style="display:flex;">
                            <!-- <button
                              @click="sendLetters(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >MORE</button> -->


                             <button
                              @click="deleteRecord(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            > DELETE</button>

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
import Spinner from 'vue-simple-spinner'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})

export default {
  name: "products",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Loading,
    VueGoodTable,
    Spinner,
    vSelect
  },
   data() {
    return {
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
          label: "Phone Number",
          field: "phone",
        },
         {
          label: "Email",
          field: "email",
        },
        {
          label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
      data_name:"subscribers"
    };
  },
  methods:{
    deleteRecord(record)
    {
        this.isLoading =true
        axios
        .delete("api/deleteSubscriber?id="+ record.id+"&data_name="+this.data_name)
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
   sendLetters:function()
    {

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
        .get("api/getSubscribers?data_name="+this.data_name)
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
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