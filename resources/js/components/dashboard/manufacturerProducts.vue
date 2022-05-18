<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                <h3>
                <b>
                  <u>
 {{manufacturer_name}}'s Products
                  </u>
                   
                </b> 
                </h3>
              </div>
            <div class="col-lg-12">
              <div class="content-panel">
                <div id="table">

                     <form>
                    <div class="row">
                        <div class="col-md-12 pr-1" v-show="pageLoader">
                             <Spinner  size="medium" message="Loading page content"></Spinner>
                        </div>
                      <div class="col-md-12 pr-1" v-show="pageContent">
                      
                        <ul  class="list-group" style="margin-bottom:10px;" v-if="totalCompanyProducts > 0"> 
                                <table class="table table-bordered">
                                <tbody>
                                  <tr  v-for="(item, index) in allCompanyProducts" :key="index">
                                    <td v-for="(value , k) in item"  :key="k">
                                          <b style="text-transform:uppercase;" >{{value.name}}</b>
                                          <br/>
                                           <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col">Attributes</th>
                                              <th scope="col">Prices</th>
                                                <th scope="col">Activated</th>
                                               
                                            </tr>
                                          </thead>
                                            <tbody>
                                               <tr v-for="(attr , a) in Object.entries(value.product_attributes)" :key="a">
                                                                                          <td  >
                                                                                                {{attr[0]}} 

                                                                                                {{
                                                                                                  
                                                                                                   skus_.find(sku_el=> sku_el.id === attr[1][0].sku_id).measurement
                                                                                                
                                                                                                
                                                                                                
                                                                                                }}
                                                                                          </td>
                                                                                          <td>
                                                                                                {{attr[1][0].price}}
                                                                                          </td>

                                                                  

                                                                                           <td  v-for="(value , k) in item"  :key="k">
                                                                                            
                                                                                             <input  type="radio"  :name="attr[1][0].id" v-bind:checked="attr[1][0].is_show == 1"   @change="(e)=> changeStatus('yes',attr[1][0].id)"/>
                                                                                             <label for="">Yes</label>
                                                                                               <input  type="radio" :name="attr[1][0].id"  v-bind:checked="attr[1][0].is_show== 0"   @change="(e)=> changeStatus('no',attr[1][0].id)" />
                                                                                               <label for="">No</label>
                                                                                            </td>
                                                                                         
                                               </tr> 
                                                   
                                            </tbody>
                                         </table>
                                      </td>                 
                                  </tr>
                                </tbody>
                              </table>
                        </ul>
                            
                        <ul  class="list-group" style="margin-bottom:10px;" v-else>
                                <li class="list-group-item">
                                <b style="text-transform:uppercase;"> {{selectedCompanyName}} has  no listed brands</b> 
                                  </li>
                               </ul>
                      </div>                      
                    </div>
                  
                    <button
                      type="submit"
                      v-show="EditCompanyProducts"
                      class="btn btn-info btn-fill pull-left"
                      @click="editProductStatuses($event)"
                    >{{editText}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </button>
                    <div class="clearfix"></div>
                  </form>
    
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
import axios from "axios";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";
import "vue-loading-overlay/dist/vue-loading.css";
import Loading from "vue-loading-overlay";
Vue.use(Loading);
Vue.use(VueToast);
import modal from 'vue-modality'
import Spinner from 'vue-simple-spinner'


export default {
  name: "manufacturerProducts",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Loading,
    modal,
    Spinner
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
      name:"",
      manufacturer_name:this.$store.state.manufacturer.name,
      id:"",
      industry_id:"",
      rows: [],
      allCompanyProducts:[],
      statusChangePayload:[],
      selectedCompanyName:null,
      chartData:[],
      companyStatus:null,
      companyRecord:null,
      getImpressionsLoader:false,
      is_active:null,
      products_:[],
      totalCompanyProducts:0,
      skus_:[],
      pageLoader:true,
      pageContent:false,
      updateResponseStatus:0,
      manufacturer_record:null
    };
  },
  methods:{
       getExecutionTime:function (startTime) 
        {
            let now = Date.now();
            return Math.floor((now - startTime)/1000);
        },
       updateRecord:function()
        {
            axios.put('api/updateProductAttributes?id='+arguments[0]+'&is_show='+arguments[1]+'&updateOption=manufacturer-products')
            .then((response) => 
            {
                this.updateResponseStatus = response.data;
            })
            .catch((error) => 
            {
            Vue.$toast.open({
                message: error.message,
                type: "error",
                position: "top",
            });
            });
        },
 editProductStatuses:function(event)
    { 
      event.preventDefault();
      this.saving = true;
      this.editText = null;
      if(this.statusChangePayload.length > 0)
      {
        // let start_time = Date.now();
        this.statusChangePayload.forEach(element => 
        {
           this.updateRecord(element.id, element.is_show);
        });

        setTimeout(() => {
             this.saving=false;
              this.editText ="Edit";
            if(this.updateResponseStatus.status == 200)
            {
                 Vue.$toast.open({
                        message: "Statuses has been updated",
                        type: "success",
                        position: "top",
                        });
            }else{
              Vue.$toast.open({
                        message:this.updateResponseStatus.message,
                        type: "error",
                        position: "top",
                        });
            }
        },1500);
      }else{
           this.saving = false; this.editText = 'Edit';
          Vue.$toast.open({
                  message: "No changes has been made",
                  type: "info",
                  position: "top",
                });
       }
    },
    changeStatus:function(e, id)
    {
        let data  = {
           is_show:(e == "yes")?1:0,
           id:id
         }
         
        this.statusChangePayload.push(data);
    },
     changeCompanyStatus:function(e, record)
    {
        this.isLoading =true
        axios
        .put("api/updateManufacturer?id="+ record.id+"&is_active="+e)
        .then((response) => {
          this.isLoading =false
          if (response.data.status === 200) {
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
        this.Loading = true;
    },

    getCompanyProducts:function(record)
    { 
         this.pageLoader = true;
         axios
            .get('api/getCompanyProducts?data_name=product_attributes&manufacturer_id='+this.$store.state.manufacturer.id,
            { 
              headers: {
                'Content-Type': 'multipart/form-data'
            }}
          )
        .then((response) => {
          this.pageLoader = false;
          this.pageContent = true;
          let new_pd = [];
          if(response.data.status == 200)
          {
             this.products_.forEach(el_ => 
              {
                el_.product_attributes = [];
                response.data.product_attributes.forEach(attri_ => {
                  
                                if(el_.id == attri_.product_id)
                                {
                                  if(!el_.product_attributes[attri_.id])
                                  {
                                     el_.product_attributes.push(attri_);
                                  }   
                                } 
                    });                    
              });

              this.products_.forEach(el_p => {
                  const productAttributes = el_p.product_attributes.reduce((tot, product) => 
                                                        {
                                                            if (!tot[product.description])
                                                                {   
                                                                    tot[product.description] = []
                                                                }
                                                                    const product_ = product;
                                                                    tot[product.description].push(product_)                                                                    
                                                                return tot
                                                        }, {});                                    
                                                     el_p.product_attributes = productAttributes;
                                                new_pd.push(el_p);
              });

              const grouped = new_pd.reduce((grouped, product) => {
                                            const key = product.name  
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {})

            this.allCompanyProducts = grouped;
            this.totalCompanyProducts = Object.entries(this.allCompanyProducts).length
            this.selectedCompanyName = this.$store.state.manufacturer.name;
            if(this.totalCompanyProducts > 0)
            {
              this.EditCompanyProducts =true
            }else{
              this.EditCompanyProducts = false;
            }

          }else{
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
      getProducts() {
      axios
        .get("api/getManufacturerProducts?manufacturer_id="+this.$store.state.manufacturer.id)
        .then((response) => {
          if (response.data.status === 200) {
           
            this.products_ =  Object.values(response.data.records);
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
      getSku() {
      axios
        .get("api/getSkus?data_name=skus")
        .then((response) => {
          if (response.data.status === 200) {
            this.skus_ = response.data["skus"];
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
    
  },
  mounted()
  {
    this.getProducts();
    this.getSku();
    this.getCompanyProducts();
  }
}
  </script>

  <<style scoped>
  #chartdiv {
  width: 100%;
  height: 500px;
}

</style>