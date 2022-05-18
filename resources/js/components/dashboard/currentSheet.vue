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
                    ref="currentTimeSheet"
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
                                        placeholder:'Search Current timesheets'
                                    }"
                  
                    :sort-options="{
                                        enabled: true,
                                        initialSortBy: {
                                            field: 'title',
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
                      <!-- <router-link to="/register-user">
                        <button class="btn btn-default" style="margin-right:10px;">NEW USER</button>
                      </router-link>-->
                    </div>
                    <!-- <div slot="selected-row-actions">
                      <button @click="activateSelected('activate')">Multiple Activate</button>
                      <button @click="deactivateSelected('deactivate')">Multiple De-activate</button>
                    </div>-->

                    <div slot="table-row" slot-scope="props">
                      <span v-if="props.column.field == 'btn'">
                        <div style="display:flex;">
                            <button
                              @click="openSignaturePad(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >Sign</button>
                         
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
                <modal ref="signaturePad" title="Signature Pad" :hide-ok="true" @cancel="$refs.signaturePad.hide()" centered>
                        <vueSignature ref="signature" :sigOption="option"></vueSignature> 
                        <button @click="save">
            
                          {{text}}
                           <Spinner v-show="saving" size="small"></Spinner>
                          </button>
                        <button @click="clear">Clear</button>
                        <button @click="undo">Undo</button>
                        
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
import vueSignature from "vue-signature"
import modal from 'vue-modality'
import Spinner from 'vue-simple-spinner'
Vue.use(VueToast);
export default {
  name: "currentSheet",
  components: {
    navBar,
    sideBar,
    siteFooter,
    vueSignature,
    modal,
    VueGoodTable,
    Spinner
  },
  data() {
    return {
      isLoading:true,
      worker_id:"",
      saving:false,
      text:"Save",
      option:[],
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
        {
          label: "Task Title",
          field: "title",
        },
        {
          label: "Client Name",
          field: "client.name",
        },
        {
          label: "Start Time",
          field: "start",
        },
        {
          label: "End Time",
          field: "end",
        },
        {
          label: "Break time",
          field: "break_time",
        },
        {
          label: "Client Signed",
          field: "client_signature",
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
      save(){
            var _this = this;
            var png = _this.$refs.signature.save()
            var jpeg = _this.$refs.signature.save('image/jpeg')
            var svg = _this.$refs.signature.save('image/svg+xml');
    
     this.saving =true;
     this.text =""
      event.preventDefault();
      let data = {
         id: this.worker_id,
        file:png,
      };
      axios
    .post("api/updateSignature" , data)
    .then((response) => {
     this.saving =false;
     this.text = "Save"
     if(response.data.status ===200)
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
        clear(){
            var _this = this;
            _this.$refs.signature.clear();
        },
        undo(){
            var _this = this;
            _this.$refs.signature.undo();
        },
        addWaterMark(){
            var _this = this;
            _this.$refs.signature.addWaterMark({
                text:"mark text",          // watermark text, > default ''
                font:"20px Arial",         // mark font, > default '20px sans-serif'
                style:'all',               // fillText and strokeText,  'all'/'stroke'/'fill', > default 'fill		
                fillStyle:"red",           // fillcolor, > default '#333' 
                strokeStyle:"blue",	   // strokecolor, > default '#333'	
                x:100,                     // fill positionX, > default 20
                y:200,                     // fill positionY, > default 20				
                sx:100,                    // stroke positionX, > default 40
                sy:200                     // stroke positionY, > default 40
            });
        },
        fromDataURL(url){
            var _this = this;
            _this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
        },
        handleDisabled(){
            var _this = this;
            _this.disabled  = !_this.disabled
        },
      openSignaturePad:function(record)
      {
        this.worker_id = record.id;
        this.$refs.signaturePad.open()
      },
     removeItems: function () {
      // arguments[0].forEach((ele) => {
        const item = this.rows.findIndex((p) => p.slug === arguments[0]);
        this.rows.splice(item, 1);
     // });
    },
    fieldFn(rowObj) {
      if(rowObj.status === 1)
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
        this.isLoading = true
        axios
        .delete("api/client/"+  arguments[0].slug)
        .then((response) => {
          this.isLoading = false
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
          this.isLoading = false
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
    },
    getWorkers: function () {},
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
        .get("api/timesheet?current=true")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.totalRecords = response.data.data.length;
            this.rows = response.data.data;
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
label {
  text-transform: uppercase;
}
</style>
