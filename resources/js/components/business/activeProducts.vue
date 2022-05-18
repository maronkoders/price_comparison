<template>


            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Active Products</h2>
                                </div>
                            </div>

                            <div class="col-md-12">
                                  <VueGoodTable
                    ref="users"
                    :columns="columns"
                    :rows="rows"  
                    :isLoading.sync="isLoading"
                    :search-options="{
                                        enabled: true,
                                        width: '100px',
                                        placeholder:'Search Products'
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


                            
                             <button
                              @click="openAttributeModal(props.formattedRow)"
                              class="btn btn-sm primary"
                              style="margin-right:10px;"
                              type="button"
                            >ATTRIBUTES</button>
                         
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
                        <site-foot/>
                    </div>
                </div>
            </div>
        
</template>
<script>
import Vue from 'vue';
import sideNavBar from './side_nav_bar.vue';
import mobileHeader  from './header.vue';
import desktopHeader from './desktopHeader.vue'
import siteFoot from './siteFooter'
import axios from "axios";
import { VueGoodTable } from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";

export default {
    name:'activeProducts',
    components:{
            sideNavBar,
            mobileHeader,
            desktopHeader,
            siteFoot,
            VueGoodTable
    },
    mounted(){
        this.getactiveProducts()
    },
    data(){
        return {
            
            isLoading:true,
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
                    label: "Description",
                    field: this.describe,
                },
                // {
                // label: "Action",
                // field: "btn",
                // html: true,
                // },
            ],
      rows: [],
        }
    },
    methods:{
        getactiveProducts:function()
        {
             axios
                .get("api/getManProducts?token="+this.$route.query.user_token+"&status=1")
                .then((response) => {
                
                if (response.data.status === 200) {
                    this.dashboardLoader = true
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
                Vue.$toast.open({
                message: error.message,
                type: "error",
                position: "top",
                });
                });

        },
        describe:function(record)
        {
            return record.description+" "+record.measurement;
        }
    }
}
</script>