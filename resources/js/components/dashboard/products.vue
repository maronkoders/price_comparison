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
                  
        <modal ref="industryPad" title="ADD PRODUCT" width="950px" no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true" @cancel="$refs.industryPad.hide()" centered>
                      
                  <form>
                    <div class="row">

                       <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Industry</label>
                           <v-select   :options="industries"  label="name"   @input="getCategoriesPerIndustry" v-model="industry_id"></v-select>
                           <div class="error" v-if="!$v.industry_id.required">Field is required</div>
                        </div>
                      </div>

                       <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label> Category</label>
                            <v-select   :options="industry_categories"  label="name"   @input="getSkuPerCategory"  v-model="product_category_id" ></v-select>
                            <div class="error" v-if="!$v.product_category_id.required">Field is required</div>
                        </div>
                      </div>


                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Company</label>
                           <v-select @input="setSelected"  :options="selectedIndustryCompanies" multiple   label="name"  v-model="company_id"></v-select>
                           <div class="error" v-if="!$v.company_id.required">Field is required</div>
                        </div>
                      </div>

                      
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Product Name</label>
                            <v-select  :options="selectedCategoryProducts" @input="setProductName" label="name" v-model="product_name" taggable push-tags></v-select>
                              <div class="error" v-if="!$v.product_name.required">Field is required</div>
                        </div>
                      </div>

                       <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Manufacturer</label>
                           <v-select   :options="manufacturers"  label="name"  v-model="manufacturer" ></v-select>
                             <div class="error" v-if="!$v.manufacturer.required">Field is required</div>
                        </div>
                      </div>


                       <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Size Unit</label> 
                           <v-select   :options="category_product_category_skus"  label="name"  v-model="product_size_unit" ></v-select>
                               <div class="error" v-if="!$v.product_size_unit.required">Field is required</div>
                      
                        </div>
                      </div>


                      
                      <div class="col-md-12 pr-1" >
                        <div class="form-group">
                          <label>Sizes</label> 

                            <div  style=" margin: auto;">
                              <span class="size_badge" v-for="size in product_sizes" :key="size">
                              <label>{{size}} {{product_size_unit.measurement}} 

                            <button @click="removeSize(size)"  style="margin-top:-10px;" type="button" class="close" aria-label="Close">
                              &times;
                            </button>

                              </label>
                              </span>
                            </div>
                        </div>
                      </div>


                      <div class="col-md-6 pr-1" >
                        <div class="form-group">
                          <label>New Size</label> 

                           <input   type="text" class="form-control" v-model="new_size" />
                          
                             <!-- <div class="error" v-if="!$v.new_size.numeric">New size must be a number </div> -->
                              <div class="error">
                                 {{missingNewSize}} </div>

                         
                         <br/>
                        </div>
                      </div>

                       <div class="col-md-6 pr-1" >
                        <div class="form-group">
                          
                           <button
                            style="margin-top:25px;"
                            type="submit"
                            class="btn btn-info btn-fill pull-left"
                            @click="addNewSize($event)"
                          >
                          Add size
                           
                          
                          </button>
                        <br />
                        </div>
                      </div>



                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <div>
<label > Company Name</label>
                       
                          </div>
                          
                              <ul class="list-group">
                                <li class="list-group-item" v-for="(company, index) in selectedCompanies" :key="index">
                                 <b style="text-transform:uppercase;"> {{company.name}} </b>
                                    <label style="float:right" v-show="showPriceLabel">
                                      <b style="text-transform:uppercase;"> Price

                                      </b>
                                      </label>
                                    <table class="table" >
                                        <tbody>
                                          <tr  v-for="(size, size_index) in product_sizes" :key="size_index" >
                                            <th scope="row">
                                              {{size}} {{product_size_unit.measurement}}
                                              <input   style="float:right;" type="text"  name="product_price" @change="(e)=> handleUserAddInput(e,company,size)" />

                                              <br/>
                                             
                                            </th>
                                          </tr>
                                           
                                        </tbody>
                                             
                                      </table>

                                </li>
                                 <p style="color:red;">
                                                {{priceError}}
                                              </p>
                              
                              </ul>
                        </div>
                      </div>
                      
                    </div>
                  
                    <button
                   
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="addIndustry($event)"
                    v-show="btnEnabled"
                    >{{text}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
                      
        </modal>

        <modal ref="editcityPad" title="EDIT PRODUCT" width="400px" no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true"  @cancel="$refs.editcityPad.hide()" centered>

                <Spinner v-show="productEditInfoLoader" size="medium" message="Loading data..."></Spinner>
              
                  <form v-show="productEditInfo">
                    <div class="row">

                    <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Product Name</label>
                          <input type ="text"  class="form-control"  v-model="productName" />  
                            <!-- <v-select  :options="products" @input="setProductName"  label="name"  taggable push-tags></v-select> -->
                        </div>
                      </div>

                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Industry</label>
                           <v-select   :options="industries"  label="name"   @input="getCategoriesPerIndustry" v-model="industry_id"></v-select>
                        </div>
                      </div>

                       <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label> Category</label>
                            <v-select   :options="industry_categories"  label="name"   v-model="product_category_id" ></v-select>
                        </div>
                      </div>

                    </div>
                  
                    <button
                   
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="editProduct($event)"
                    >{{editText}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
                     
        </modal>

        <modal ref="editAttributes" title="EDIT ATTRIBUTE" width="700px" no-close-on-backdrop no-close-on-esc hide-cancel :hide-ok="true"  @cancel="$refs.editAttributes.hide()" centered>


              <div ref="deleteAttributes">
               
                  <form v-show="attributeEditInfo">
                    <div class="row" >

                      <div class="col-lg-12">
                        <center>
                          <h5>
                            <b> 
                              PRODUCT NAME : 
                              
                              {{selectedProductName}}
                            </b>
                          </h5>
                        </center>
                      </div>

                     

                      <table width ="100%" class="table">
                       
                        <tbody>
                          <tr v-for="(company , index) in  productAttributeCompanies" :key="index">
                            
                            <td>  <h5> <b> <u> {{company.name.toUpperCase()}}  </u> </b></h5>

                              <table width="100%">
                                   <thead>
                                <tr>
                                  <th scope="col">Size</th>
                                  <th scope="col">Unit</th>
                                  <th scope="col">Price</th>
                                   <th scope="col">Select</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="(productData , i) in companyProductAttributes" :key="i" >
                                    <td v-if ="productData.company_id===company.id">
                                            {{productData.description}}  
                                    </td>
                                      <td v-if ="productData.company_id === company.id">
                                           <select class="form-control" @change="changedAttributeSku($event, productData,'sku_id')">
                                                 <option v-for="(el,y) in selected_product_sku"  :key="y" :value="el.sku_id" :selected="el.sku_id === productData.sku_id" > 
                                                    {{el.sku.name}}
                                                 </option>
                                            </select>
                                         
                                       </td>
                                      <td v-if ="productData.company_id === company.id">
                                          <input type="text"  @change="changedAttributeSku($event, productData,'price')" class="form-control" :value="productData.price">
                                        </td>

                                        <td v-if ="productData.company_id === company.id">
                                          <input type="checkbox"  v-model="selectedAttributesForDelete"  class="form-control" :value="productData.id">
                                        </td>
                                   </tr>

                                </tbody>

                              </table>
                            </td>
                          
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <button
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="editProductAttributes($event)"
                    >{{editText}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                         
                       <button
                       style="margin-left:10px;"
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="deleteSelectedAttributes($event)"
                    >
                    
                  Delete

                      <Spinner v-show="deletingItems" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
              </div>

                   <Spinner v-show="productEditInfoLoader" size="medium" message="Loading data..."></Spinner>
            
                     
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
 import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import { object } from '@amcharts/amcharts4/core';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate)
const { required, minLength ,maxLength, alpha, email,numeric} = require('vuelidate/lib/validators');

export default {
  name: "products",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Loading,
    VueGoodTable,
    vueSignature,
    modal,
    Spinner,
    vSelect
  },
    validations: {
    industry_id: {
            required,
            },
    product_category_id: {
            required,
            },
    company_id: {
            required,
            },
    product_name: {
            required,
            },
    manufacturer: {
            required,
            },
    product_size_unit: {
            required,
            },
    product_price: {
            required,
            numeric
            }
        },
   data() {
    return {
        fullPage: true,
      showWarning:false,
      isLoading:true,
      deletingItems:false,
      saving:false,
      text:"Save",
      editText:"Edit",
      option:[],
      industries:[],
      categories:[],
      companies:[],
      product_prices:[],
      selectedAttributesForDelete:[],
      data_name:"products",
      name:null,
      id:null,
      product_category_id:null,
      company_id:null,
      industry_id:null,
      description:null,
      product_name:null,
      modalTitle:"ADD COMPANY",
      columns: [
        {
          label: "id",
          field: "id",
          hidden: true,
        },
         {
          label: "category_id",
          field: "product_category_id",
          hidden: true,
        },
        {
          label: "Name",
          field: "name",
        },
          {
            label: "Industry Name",
            field: "industry.name",
          },
         {
          label: "Category Name",
          field: "category.name",
        },
        {
          label: "Action",
          field: "btn",
          html: true,
        },
      ],
      rows: [],
      product_category_id:null,
      selectedCategories:[],
      products:[],
      selectedCompanies:[],
      productName:null,
      product_sizes:[],
      product_size_unit:null,
      product_size:null,
      new_size:null,
      missingNewSize:null,
      price:null,
      manufacturer:null,
      industry_categories:[],
      manufacturers:[],
      product_category_skus:[],
      category_product_category_skus:[],
      product_price_:[],
      productEditInfo:false,
      productEditInfoLoader:true,
      attributeEditInfo:true,
      productAttributeEditData:[],
      productAttributeCompanies:[],
      companyProductAttributes:[],
      selected_product_sku:[],
      selectedProductName:null,
      editedProductAttributes:[],
      selectedIndustryCompanies:[],
      selectedCategoryProducts:[],
      priceError:null,
      btnEnabled:true,
      showPriceLabel:false
    };
  },
  // TODO:: filter products as per category
  methods:{
   
      removeAttributesItems: function ()
    {
      arguments[0].forEach((ele) => 
      {
          const item = this.companyProductAttributes.findIndex((p) => p.id === ele);
          this.companyProductAttributes.splice(item, 1);
      });
    },

    deleteSelectedAttributes:function(event)
    {
        event.preventDefault();
           let  loader = this.$loading.show({
                    container:  this.fullPage ? null : this.$refs.deleteAttributes,
                    canCancel: false});

                    this.deletingItems = true;

        axios
        .delete("api/deleteAttribute?ids="+this.selectedAttributesForDelete+"&data_name=records")
        .then((response) => {
          loader.hide()
          this.deletingItems = false
          if (response.data.status === 204) {
              this.$toaster.success(response.data.message)
              this.selectedAttributesForDelete = [];
              this.removeAttributesItems(this.selectedAttributesForDelete)
              this.$refs.editAttributes.hide();
          }else{
               this.$toaster.error(response.data.message)
          }
        })
        .catch((error) => {
          loader.hide()
            this.deletingItems = false
            this.$toaster.error(error.message)
        });

    },
    getSkuPerCategory:function(record)
    {
        this.product_size_unit = null
        this.selectedCategoryProducts = [];
        this.category_product_category_skus = [];
        this.product_category_skus.forEach(element => 
        {
            if(element.product_category_id === record.id){
                   this.category_product_category_skus.push(element.sku);
                }
         });

      this.rows.forEach(product =>{
           if(product.product_category_id ==  record.id)
           {
              this.selectedCategoryProducts.push(product);
           }
      })
    },
    getCategoriesPerIndustry:function(record)
    {
        this.industry_categories = [];
        this.product_category_id = null;
        this.categories.forEach(element => 
        {
             if(element.industry_id == record.id){
                this.industry_categories.push(element);
             }
        });


      this.companies.forEach(el => {
           if(el.industry_id ==  record.id)
           {
              this.selectedIndustryCompanies.push(el)
           }
      })

        
    },
    getProductCategorySku:function()
    {
        axios
        .get("api/getProductCategorySku?data_name=product_category_sku")
        .then((response) => {
          if (response.data.status === 200) {
              this.product_category_skus = response.data.product_category_sku;
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
    removeSize:function()
    {
        const item = this.product_sizes.findIndex(element => element == arguments[0]);
        this.product_sizes.splice(item, 1);
    },
    addNewSize:function(event)
    {
       event.preventDefault();
       
        if(this.new_size == null)
        {
             this.missingNewSize ="Size cannot be empty"
        }else{

          if(this.product_sizes.includes(this.new_size))
          {

            this.missingNewSize ="Size was added already"
          }else{

              this.product_sizes.push(this.new_size);
              this.new_size =null;
              this.missingNewSize =null
              this.showPriceLabel =true;
          }
        }
    },
    addSize:function(event)
    {
        event.preventDefault();
        if(this.new_size.value  !==0)
        {
            this.product_sizes.push(this.new_size);
            this.new_size =null;
        }else{
          this.missingNewSize ="Size cannot be empty"
        }
    },
    setProductName:function(value)
    {
      return this.productName = (typeof value == "string") ? value: value.name;
    },
    setSelected:function(value)
    {
      this.selectedCompanies = value;
    },
    handleUserAddInput(e,company,size)
      {
         const regex= /^\d+(\.\d{1,2})?$/;
         if(regex.test(e.target.value))
         {
             this.btnEnabled = true 
             this.priceError = null
             let result = this.product_prices.find(x => x.company_id == company.id);
              if(result == undefined)
                {
                    let companyProductPrice = {
                        "company_id":company.id,
                        "price":e.target.value,
                        "size":size
                      };
                      this.product_prices.push(companyProductPrice);
                }else{
                    
                    let objIndex = this.product_prices.findIndex((obj => obj.company_id == result.company_id));
                    this.product_prices[objIndex].price = e.target.value;
                }
           
         }else{
           this.btnEnabled = false;
           this.priceError="Price is invalid.Must be of this format 12.00"

         }
    },
    clearFields()
    {
      this.name = "";
      this.price = "";
      this.product_category_id=  "";
      this.company_id= "";
      this.description= "";
      this.industry_id= ""
      this.selectedCompanies =[];
      this.product_sizes =[];
      this.product_size_unit = null;
      this.selectedCategoryProducts  = [];
      this.selectedIndustryCompanies = [];
      this.manufacturer = null
      this.product_prices = [];
      this.saving =false;
    },
    openModal()
    {
      this.clearFields();
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
        .delete("api/deleteProduct?id="+ record.id+"&data_name="+this.data_name)
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
          this.isLoading = false
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });

    },
    openAttributeModal(record)
    {
        this.productEditInfoLoader = true;
        this.attributeEditInfo = false;
        this.$refs.editAttributes.open();
 
        axios
        .get("api/getProductAttributes?product_id="+ record.id)
        .then((response) => {
           this.productEditInfoLoader = false;
           this.productEditInfo = true;
          if (response.data.status === 200) 
          {         
            let result_ = response.data.record;
            const ids = result_.map(o => o.company_id)
            const filtered = result_.filter(({company_id}, index) => !ids.includes(company_id, index + 1))
            this.productAttributeCompanies  = filtered.map(company_record => company_record.company);
            this.companyProductAttributes = result_ 
            this.selectedProductName =  record.name.toUpperCase()
             this.product_category_skus.forEach(el =>
             {
                 if(el.product_category_id  === record.product_category_id)
                 {
                      this.selected_product_sku.push(el)
                 }
             })
        
            this.productAttributeEditData  = result_;
            this.attributeEditInfo =true;
           
          } else {
            Vue.$toast.open({
              message: response.message.data,
              type: "error",
              position: "top",
            });
          }
        })
        .catch((error) => {
           //this.productEditInfoLoader = false;
            this.$refs.editAttributes.hide();
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });    

    },
    changedAttributeSku:function(event, attr, type)
    {
      if(type == "sku_id")
      {
        attr.sku_id = parseInt(event.target.value);
      }else{
        attr.price = event.target.value;
      }

      var exists = this.editedProductAttributes.some(function(field) {
            return field.id === attr.id
      });

      if (!exists) 
        {
            this.editedProductAttributes.push(attr)
        }else{
          const filtersList = this.editedProductAttributes.filter(element => element.id !== attr.id)
          this.editedProductAttributes=filtersList
          this.editedProductAttributes.push(attr);          
        }   
    },
    deleteUnwantedProperties:function()
    {
      this.$delete(this.editedProductAttributes, 'description')
    },
    editProductAttributes:function(event)
    {
      event.preventDefault();
      if(Object.keys(this.editedProductAttributes).length >0)
      {
          this.saving = true;
          this.editText = null;
          axios
              .put("api/updateProductAttributes", this.editedProductAttributes)
              .then((response) => {
                this.saving =false
                this.editText ="Edit"
                if (response.data.status === 200) {
                    this.$refs.editAttributes.hide();
                    this.$toaster.success(response.data.message);
                    setTimeout(() => {
                      this.$router.go()
                    }, 1500);
                  
                } else {
                    this.$toaster.error(response.data.message);
                }
              })
              .catch((error) => {
                this.saving =false
                this.editText ="Edit"
                  this.$toaster.error(error.message);
              });
      }else{
          this.$toaster.info("Nothing was changed");
      }
    },
    openEditModal(record)
    {
         this.productEditInfoLoader = true;
         this.productEditInfo = false;
         this.$refs.editcityPad.open();
        
        axios
        .get("api/getProducts?id="+ record.id)
        .then((response) => {
           this.productEditInfoLoader = false;
           this.productEditInfo = true;
          if (response.data.status === 200) 
          {         
              this.industry_id = response.data.record.industry.name;
              this.productName = response.data.record.name
              this.product_category_id  = response.data.record.category.name
              this.id = record.id
          //   this.$refs.editcityPad.open();
           
          } else {
            Vue.$toast.open({
              message: response.message.data,
              type: "error",
              position: "top",
            });
          }
        })
        .catch((error) => {
           //this.productEditInfoLoader = false;
            this.$refs.editcityPad.hide();
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });    
    },
    getCategoryData:function()
    {
        return this.categories.findIndex(el => arguments[0]  == el.name)
    },
    getProductData:function()
    { 
        return this.rows.findIndex(el => arguments[0]  == el.name)
    },  
    getIndustryData:function()
    {
         return this.industries.findIndex(el => arguments[0]  == el.name)
    },
      getProductSizeUnitData:function()
      {
          return this.category_product_category_skus.findIndex(el => arguments[0] == el.measurement)
      },
    getManufacturerData:function()
    {
        return this.manufacturers.findIndex(el => arguments[0] == el.name);
    },
    getCategoryId:function()
    {

       if(typeof arguments[0] == "string")
        {
            let index = this.getCategoryData(arguments[0]);
            return this.categories[index].id
        } 

      if(typeof arguments[0] == "object")
        {
          return arguments[0].id
        } 
    },
    getManufacturerId:function()
    {
      if(typeof arguments[0] == "string")
      {
          let index = this.getManufacturerData(arguments[0]);
          return this.manufacturers[index].id
      } 

      if(typeof arguments[0] == "object")
      {
         return arguments[0].id
      } 
    },
     getDepartmentId:function()
    {

      if(typeof arguments[0] == "string")
      {
          let index = this.getIndustryData(arguments[0]);
          return this.industries[index].id
      } 

      if(typeof arguments[0] == "object")
      {
         return arguments[0].id
      } 
    },
    getProductId:function()
    {
        let index = this.getProductData(arguments[0]);
        let id = this.rows[index].id
        return  typeof arguments[0] == "string" ? id : arguments[0].id
    },
  
    editProduct(event)
    {
            this.saving = true;
            this.editText = ""
            event.preventDefault();
            let data = {
                name: this.productName,
                id:this.id,
                product_category_id: this.getCategoryId(this.product_category_id),
                industry_id: this.getDepartmentId(this.industry_id)
            };

            axios
            .put("api/updateProduct", data)
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
                }, 2500);
                
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
                this.editText ="Edit"
                Vue.$toast.open({
                    message: error.message,
                    type: "error",
                    position: "top",
                });
                });

    },
     addIndustry(event)
    {
         
        this.$v.$touch()
        if (!this.$v.$invalid) 
        {
            this.saving = true;
            this.text =""
            event.preventDefault();
            
            let data = {
                name:this.productName,
                product_category_id:this.product_category_id.id,
                company_id:this.company_id,
                description:this.description,
                tax:null,
                discount:null,
                industry_id:this.industry_id.id,
                product_prices:this.product_prices,
                manufacturer_id:this.manufacturer.id,
                sku_id:this.product_size_unit.id
            };
     
              axios
              .post("api/newProduct?data_name=product" , data)
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
                this.clearFields();

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
        }
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
    getSkus()
    {
      axios
        .get("api/getSkus?data_name=skus")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
         
            this.skus = response.data["skus"];
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
    onColumnFilter(params) {
      this.updateParams(params);
      this.loadItems();
    },
    loadItems() {
      this.isLoading =true
      axios
        .get("api/getProducts?data_name="+this.data_name)
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
    getIndustryCategory()
    {

    },

    getCategories()
    {

      //HTTP_GET('api/getCategories?data_name=categories')

     // HTTP_GET
       axios
        .get("api/getCategories?data_name=categories&is_active=1")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.categories = response.data.categories;
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
    getIndustries()
    {
       axios
        .get("api/getIndustries?data_name=industries")
        .then((response) => {
          // this.isLoading =false
          if (response.data.status === 200) {

             response.data.industries.forEach((element) => {
            let agent = {
              name: element.name ,
              id: element.id,
            };
            this.industries.push(agent);
          });

          //  this.industries = response.data.industries;
          } else {

            Vue.$toast.open({
              message: response.data.message,
              type: "error",
              position: "top",
            });
          }
        })
        .catch((error) => {
         //    this.isLoading =false
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });

    },
    getManufacturers:function()
    {
         axios
          .get("api/getManufacturer?data_name=manufacturers")
          .then((response) => {
            this.isLoading =false
            if (response.data.status === 200) {
              this.manufacturers = response.data.manufacturers;
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
      getCompanies()
    {
       axios
        .get("api/getCompanies?data_name=companies&is_active=1")
        .then((response) => {
           this.isLoading =false
          if (response.data.status === 200) {
            this.companies = response.data.companies;
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
    }
  },
  mounted()
  {
    this.getCategories()
    this.getIndustries() 
    this.getCompanies()
    this.getSkus();
    this.getManufacturers();
    this.getProductCategorySku();
  }
}
  </script>
  <style scoped>
  .size_badge{
    display: inline-block;
    padding: .25em .4em;
    font-size: 95%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
  }
   .error{
    color:red;
  }

  </style>