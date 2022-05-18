<template>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container rangu">
        

             <router-link to="/"  class="navbar-brand logo-image" >
           
                <img src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/logo.webp" alt="alternative">

                </router-link>

            <button class="navbar-toggler p-0 border-0" type="button" @click="startBySelectingIndustry($event)" href="javascript:void(0)">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                      <!-- <a class="nav-link page-scroll" href="#header">Home <span class="sr-only">(current)</span></a> -->
                    <!-- <li class="nav-item" v-for="(h,i)  in industries" :key="i">
                        <a class="nav-link page-scroll" @click="selectedIndustry(h)" href="javascript:void(0)">{{h.name}}</a>
                    </li> -->

                    <li class="nav-item" v-if="homeText">
                        <router-link to="/" class="nav-link page-scroll">

   <button class="btn btn-outline-success brt">Home</button>
                        </router-link>
                        <!-- <a class="nav-link page-scroll" href="javascript:void(0)">Home</a> -->
                          <!-- <a class="nav-link page-scroll" @click="firstStep($event)" href="javascript:void(0)">Compare Prices</a> -->

                          <!-- <firstStep name="example"></firstStep> -->
                    </li>

                     <li class="nav-item" v-if="comparePriceText">
                       
                          <!-- <a class="nav-link page-scroll" @click="firstStep($event)" href="javascript:void(0)">Compare Prices</a> -->
                        <button class="btn btn-outline-success brt" @click="startBySelectingIndustry($event)" href="javascript:void(0)">Compare Prices</button>
                          <!-- <firstStep name="example"></firstStep> -->
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link page-scroll" href="#testimonials">Testimonials</a>
                    </li> -->
                </ul>
               
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container --> 
       <modal ref="selectIndustryModal"  no-close-on-backdrop no-close-on-esc hide-cancel title="SELECT INDUSTRY"  width="550px" :hide-ok="true" hide-footer centered>
             <form>
                    <div class="row">
                         <div class="col-md-12 pr-1">
                            <div  v-show="allIndustries" class="form-group industries" v-for="(industry, iKey) in industries" :key="iKey">
                                <div class="col-md-12 pr-1" > 
                                    <div class="card __web-inspector-hide-shortcut__">
                                        <div class="card-body">
                                            <div class="details">
                                                <div class="text">
                                                    <div class="testimonial-author">
                                                            {{industry.name}}
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="radio" class="industries" v-model="selectedIndustryData" style="margin:10px;" name="industries" @change="onSelectedIndustry($event, industry)" />
                                        </div>
                                        </div>
                                </div>
                            </div>
                         </div>
                    </div>
             </form>
        </modal>

        <modal  ref="selectCompaniesModal"  no-close-on-backdrop no-close-on-esc hide-cancel title="SELECT COMPANIES"  width="950px" :hide-ok="true" hide-footer centered>
               <form>
                    <div class="row">
                      <div class="col-md-12 pr-1">
                                                     
                            <div  v-show="showIndustryTitle" class="title common">{{industryTitle}}</div>
                                <div v-show="selectedIndustryOption" class="btn-solid-lg" style="margin:10px;">
                                <span class="closeBtn" @click='restartSelectingIndustry(); return false;'>x</span>
                                  {{selectedIndustryName}}
                               
                            </div>

                             <div class="title common" v-show="showCompanyTitle"> {{title}} </div>



                              <div class="title selected-companies" v-show="showSelectedCompanyNames"> 
                            <div class="f6">
                                <a v-for="(companyDetail, i) in  selectedCompaniesDetails" :key="i" data-ga-click="Topic, repository page" data-octo-click="topic_click" data-octo-dimensions="topic:linux" href="javascript:void(0)" title="Topic: linux" data-view-component="true" class="topic-tag topic-tag-link">
                                      {{companyDetail.name}}
                                        </a>

                                        <button @click="redoSelectCompanies($event)" tooltip="undo">
                                          <i class="fa fa-undo" aria-hidden="true"></i>
                                        </button>
                            </div>
                        </div>

                         <div class="title common" v-show="showCategoriesTitle"> {{categoriesTitle}} </div>


                        <div v-show="allCompanies">
                        <div class="collapse show companies-display" > 
                                <div   class="form-group col-md-4 col-sm-4 col-lg-4 column_size " v-for="(company , index) in industryCompanies" :key="index">
                            
                                    <div class="col-md-6 pr-1 column_size" > 
                                        <div class="card __web-inspector-hide-shortcut__">
                                        
                                            <div @click="showToaster($event)" class="card-body company_default" v-if="company.is_default" data-label="D">
                                                <div class="details" >
                                                    <div class="text">
                                                        <div class="testimonial-author">

                                                                {{company.name}}
                                                        </div>
                                                    </div>
                                                </div>
                                                 <input type="checkbox"  tool-tip="Default Shop" disabled checked class="industries" style="margin:10px; visibility:hidden;"/>
                                            </div>
                                             <div class="card-body " v-else>
                                                <div class="details">
                                                    <div class="text">
                                                        <div class="testimonial-author">

                                                                {{company.name}}
                                                        </div>
                                                     
                                                    </div>
                                                </div>
                                                 <input type="checkbox"  class="industries" style="margin:10px;" selectedOption="company_data" v-model="selectedCompaniesDetails" @change="selectedChoice($event)" :value="company"/>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                
                                 
                            </div>
                              <small v-show="atLeastTwo"  style="margin-left: 15px;">
                                                            Select at least 2 companies.
                                   </small>
                                 <div>
                                <button  v-show="showGetCategoriesBtn" class="nextBtn" @click="getCategories($event)">
                                        NEXT
                                </button>
                              </div>
                        </div>

                        <div v-show="allCategories">

                            <div class="collapse show companies-display"> 
                                    <div   class="form-group" v-for="(category , index) in categories" :key="index">
                                
                                        <div class="col-md-6 pr-1 column_size"> 

                                            <div class="card __web-inspector-hide-shortcut__">
                                            
                                                <div class="card-body">
                                        
                                                    <div class="details">
                                                        <div class="text">
                                                            <div class="testimonial-author">
                                                                    {{category.name}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <input type="checkbox" style="margin:10px;" selectedOption="category_data" @change="selectedChoice($event)" v-model="selectedCategoriesDetails"  :value="category"/>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                            </div>
<small v-show="atLeastTwoCat"   style="margin-left: 15px;">
                                                            Select at least 2 categories.
                                   </small>
                            <div>
                                <button v-show ="showCreateComparisonTableBtn" class="nextBtn" @click="generateComparisonTable($event)">
                                        NEXT
                                </button>
                            </div>

                        </div>
                      </div>
                      
                    </div>
                    <Spinner v-show="loader" :message="loadingMessage" size="medium"></Spinner>
               </form>
        </modal>


        

    </nav>
</template>
<script>
import Vue from "vue";
import modal from 'vue-modality';
import axios from"axios";
import Spinner from 'vue-simple-spinner';
import VueHtml2pdf from 'vue-html2pdf';
import html2PDF from "html-pdf-adaptive";
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 2500});
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
 import VModal from 'vue-js-modal'
Vue.use(VModal, { componentName: 'firstStep' })
const { required, minLength ,maxLength, alpha, email,numeric} = require('vuelidate/lib/validators')

export default
   {
       name:"myBar",
       data(){
           return {
header_promotion_details:null,
               industries_data:"industries",
               companies_data:"companies",
               categories_data:"categories",
               industries:[],
               companies:[],
               industry_detail:"",
               loader:false,
               title:"SELECT INDUSTRY",
               selectedIndustryOption:false,
               industryCompanies:[],
               allCompanies:false,
               noCompanies:false,
               allCategories:false,
               selectedIndustryName:"",
               showCompanyTitle:false,
               allIndustries:true,
               showIndustryTitle:true,
               showSelectedCompanyNames:false,
               industryTitle:"SELECT INDUSTRY",
               categories:[],
               selectedIndustryId:"",
               selectedCompaniesDetails:[],
               selectedCategoriesDetails:[],
               loadingMessage:"Loading",
               products:[],
               allSelectedCompanyProducts:[],
               productsTable:false,
               productsLoader:false,
               selectedProducts:[],
               showCategoriesTitle:false,
               categoriesTitle:"SELECT CATEGORIES",
               totalSelectedCompanies:0,
               productsLoaderMessage:"Loading products",
               billTable:false,
               chosenItems:[],
               totalCosts:[],
               downloadCatalogLoader:false,
               downloadCatalogBtn:true,
               companyTotals:{},
               noCompaniesPlaceholder:false,
               selectedIndustryData:0,
               showGetCategoriesBtn:false,
               showCreateComparisonTableBtn:false,
               noProductSelectedError:null,
               shopsavvyDetails:null,
               shopsavvyExist:false,
               defaultShopName:"",
               subscriberName:null,
               subscriberPhone:null,
               subscriberEmail:null,
               saveSubscriberBeforeDownloading:false,
               subscriberDownloadText:"SAVE AND DOWNLOAD",
               companyProductAttributes:[],
               allServerProducts:[],
            visitorSelectedProducts:[],
            product_category_skus:[],
            product_sku_unit:null,
            finalVisitorSelectedProducts:[],
            promotion_details:null,
            grouped_categories:[],
            selectProducts:false,
            select_text:"ADD A PRODUCT TO YOUR LIST BY CLICKING THE CHECKBOX COLUMN.THEN PRESS BILL TO GENERATE THE TOTAL",
            atLeastTwo:true,
            atLeastTwoCat:true,
            comparePriceText:true,
            homeText:false
           }
       },
     validations: {
        subscriberName: {
            required,
            alpha,
            minLength: minLength(3),
            },
    subscriberPhone: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(10),
            numeric
            },
    subscriberEmail: {
            required,
            email
            }
        },
       components:
       {
           modal,
           Spinner,
           VueHtml2pdf,
           html2PDF
       },
        watch:
        {
                // a computed getter
        getSkuMeasurement: function () {
                return arguments[0];
                }
        },
       methods:
       {

    isRequired(value) {
            return value ? true : 'This field is required';
            },
     firstStep:function(event)
            {
                event.preventDefault(),
                   
                   this.$modal.show("example", {
                        title: "Message",
                        text: "hello",
                        buttons: [
                        {
                            title: "OK",
                            handler: () => {
                            alert("closed");
                            }
                        },
                        {
                            title: "Close",
                            default: true,
                            handler: () => {}
                        },
                        {
                            title: "Cancel"
                        }
                        ]
                    });
            },
    submitSubscriberDetail:function(event)
           {
              event.preventDefault();
                let payload = {
                        name: this.subscriberName,
                        phone:this.subscriberPhone,
                        email:this.subscriberEmail,
                        subscriberSource : 'catalog_based'
                    }

    this.$v.$touch()
      if (!this.$v.$invalid) {
                axios
                .post("api/newSubscriber", payload)
                .then((response) => {
                    if(response.data.status == 201)
                    {
                        this.subscriberName ="";
                        this.subscriberPhone ="";
                        this.subscriberEmail ="";
                        this.$refs.newsLetterSubscribers.hide();
                        this.$refs.html2Pdf.generatePdf();
                        setTimeout(() => {
                             this.$toaster.success("Catalog has been downloaded")
                        }, 2100);
                    }
                    else if(response.data.status == 422)
                        {
                            if(response.data.message.hasOwnProperty('phone'))
                            {
                               this.$toaster.error("Phone number is taken");  
                            }
                            if(response.data.message.hasOwnProperty('email'))
                            {
                               this.$toaster.error("Email is taken already"); 
                            }
                        }
                    else{
                       toaster_.error(response.data.message)
                    }
                })
                .catch((error) => {
                   toaster_.error(error.message)
                });
        }
    },
    
    GetSortOrder:function(prop) {    
            return function(a, b) {    
                        if (a[prop] > b[prop]) {    
                            return 1;    
                        } else if (a[prop] < b[prop]) {    
                            return -1;    
                        }    
                        return 0;    
                    }    
                },


            restartSelectingIndustry:function()
            {
                this.atLeastTwo = true;
                this.atLeastTwoCat = true;
                this.$refs.selectCompaniesModal.hide();
                this.$refs.selectIndustryModal.open();
            },
           reSelectingIndustry:function()
           {
               this.allCompanies = false;
               this.showCompanyTitle = false;
               this.industryTitle="SELECT INDUSTRY"
               this.selectedIndustryOption  = false
               this.selectedIndustryId = ""
               this.selectedCompaniesDetails = []
               this.selectedCategoriesDetails =[];
               this.allCategories = false;
               this.showSelectedCompanyNames =false
               this.categories = [];
               this.companies =[];
               this.products=[];
               this.selectedIndustryData = 0;
               this.showCategoriesTitle =false
               this.finalVisitorSelectedProducts = [];
               this.showIndustryTitle = false
               this.allIndustries = true;

              //this.$refs.comparisonModal.hide();
           },
           showButtonElement:function()
           {
               return arguments[0].length > 1
           },
           selectedChoice:function(event)
           { 
               if(event.target.getAttribute('selectedOption') == "company_data")
               {
                    this.atLeastTwo = this.selectedCompaniesDetails.length < 2  
                    this.showGetCategoriesBtn = this.showButtonElement(this.selectedCompaniesDetails)
               }else{
                     this.atLeastTwoCat = this.selectedCategoriesDetails.length < 2;
                     this.showCreateComparisonTableBtn = this.showButtonElement(this.selectedCategoriesDetails)
               }
           },
           onProgress:function(event)
           {
                if(event == 100)
                {
                    this.downloadCatalogBtn =true;
                    this.downloadCatalogLoader =false;
                }
           },
           generateCatalog:function(event)
           {    
                this.$refs.comparisonTable.hide();
                this.$refs.newsLetterSubscribers.open();
                this.downloadCatalogBtn = false;
                this.downloadCatalogLoader = true;
           },   
           getTotalCost:function()
           {  
               const priceByCompany = this.chosenItems.reduce((tot, prod) => 
               {
                    prod.forEach((p) => {
                        this.selectedCompaniesDetails.forEach((company)=> {
                            if(company.id == p.company_id)
                            {
                                if (!tot[p.company_id])
                                {   tot[p.company_id] = [] }
                                    const new_price = Number(p.price)
                                    const numberPrice = new_price.toFixed(2) 
                                 tot[p.company_id].push(numberPrice)
                            }
                        });
                    })
                    return tot
                }, {})

                Object.keys(priceByCompany).forEach((company) => {  
                            const total = priceByCompany[company].reduce((tot, price) => Number(tot) + Number(price))
                            priceByCompany[company] = total.toFixed(2)
                        })
                    
                this.companyTotals  = priceByCompany;
           },
        createAComparisonTable:function(event)
           {    
               event.preventDefault();
               this.$refs.comparisonModal.hide();
               this.$refs.comparisonTable.open();
               //this.$router.push('/price-comparison')
               this.productsLoader = true;
               this.selectProducts = false;
               this.finalVisitorSelectedProducts = [];
               this.products = []
               this.selectedProducts = []
               let category_ids = this.selectedCategoriesDetails.map(el =>el.id);
               //this.$store.commit("putSelectedIndustryId", this.selectedIndustryId);

               //this.selectedCategoriesDetails = this.selectedCategoriesDetails.sort(this.GetSortOrder('name'));

                 axios.get("api/getProducts?data_name=products&industry_id="+this.selectedIndustryId+"&product_categories="+category_ids+"&request_option=product_list")
                        .then((response) => {
                        if (response.data.status === 200) {
                           let allProducts = response.data.products;
                           this.allServerProducts = allProducts;
                          if(allProducts.length> 0)
                          {

                           let products_ = [];  
                           allProducts.forEach(prod => {
                                        let result = this.selectedProducts.filter(product_element =>(product_element.id === prod.id))
                                            if(result.length == 0)
                                            {
                                                const productAttributes = prod.product_attributes.reduce((tot, product) => 
                                                        {
                                                            if (!tot[product.description])
                                                                {   
                                                                    tot[product.description] = []
                                                                }
                                                                    const product_ = product;
                                                                    tot[product.description].push(product_)                                                                    
                                                                return tot
                                                        }, {});
                                                        
                                                     prod.product_attributes = productAttributes;
                                                products_.push(prod);
                                           }
                                    });

                               const grouped = products_.reduce((grouped, product) => {
                                            const key = product.category.name;
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {})


                            this.products = grouped;
                            this.productsLoader = false;
                            this.productsTable = true;
                            this.selectProducts = true;

                          }else{

                               this.$toaster.success("No product were found for your selection")
                               this.$refs.comparisonModal.hide();
                          }
                        } else {
                             this.$toaster.success(response.data.message)
                          }
                        })
                        .catch((error) => {
                             this.$toaster.error(error.message)
                        });

           },
        tryAgain:function(event)
        {
            this.selectedIndustryData = 0
            this.allIndustries = true;
            this.showIndustryTitle = true;
            this.noCompaniesPlaceholder = false 
        },
        generateComparisonTable:function(event)
        {
            event.preventDefault();
            let category_ids = this.selectedCategoriesDetails.map(el =>el.id);
            this.$store.commit("putSelectedIndustryId", this.selectedIndustryId);
            this.$store.commit("putSelectedCategoryIds", category_ids);
            this.$store.commit("putSelectedCompanies",this.selectedCompaniesDetails)
             this.$router.push('/price-comparison');
        },
        onSelectedIndustry:function(event, industry)
        {
            event.preventDefault();
            this.restartTheWorkFlow();
            this.$refs.selectIndustryModal.hide();
            this.$refs.selectCompaniesModal.open();
            this.loadingMessage ="Loading companies..."
            this.loader = true;
            this.selectedIndustryId = industry.id;

             axios
                .get("api/getCompanies?data_name=companies&industry_id="+this.selectedIndustryId+"&is_active=1")
                .then((response) => {
                if (response.data.status === 200) {
                setTimeout(() => {
                  if( response.data.companies.length > 0)
                     {
                         this.industryCompanies = response.data.companies;
                         this.showCompanyTitle = true;
                         this.title ="SELECT COMPANIES"
                         this.allCompanies = true
                         this.loader =false
                         this.selectedIndustryOption = true;
                         this.showIndustryTitle=true
                         this.industryTitle ="SELECTED INDUSTRY";
                         this.selectedIndustryName = industry.name.toUpperCase();
                         let default_company = this.industryCompanies.filter(el => el.is_default==1);
                         if( default_company.length!=0)
                         {
                            this.selectedCompaniesDetails.push(default_company[0])   
                         }
                    }else{
                            this.loader =false
                            this.noCompaniesPlaceholder = true;
                    }
            }, 2000);
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
        openComparisonSteps:function(h)
        {
            this.allIndustries = true;
            this.showIndustryTitle = true;
            this.industryTitle ="SELECT INDUSTRY";
            this.selectedIndustryOption = false;
            this.showCategoriesTitle = false;
            this.showCompanyTitle = false;
            this.showSelectedCompanyNames = false;
            this.allCompanies= false;
            this.allCategories = false;
            this.selectedCompaniesDetails =[]
            this.selectedCategoriesDetails =[]
            this.productsTable =false;
            this.products =[];
            this.chosenItems =[];
            this.totalSelectedCompanies =0;
            this.companyTotals ={}
            this.billTable = false;
            this.selectedIndustryData =0
            this.noCompaniesPlaceholder = false;
            this.$refs.comparisonModal.open();
        },
        restartTheWorkFlow:function()
        {
          this.showSelectedCompanyNames = false;
          this.showCompanyTitle = false;
          this.showCategoriesTitle =false;
          this.showGetCategoriesBtn  =false;
          this.allCategories  =false;
          this.allCompanies=false
          this.selectedCompaniesDetails =[]
          this.selectedCategoriesDetails =[]
          this.productsTable =false;
          this.products =[];
          this.chosenItems =[];
          this.totalSelectedCompanies =0;
          this.companyTotals ={}
          this.billTable = false;
          this.selectedIndustryData =0
          this.noCompaniesPlaceholder = false;
          this.showIndustryTitle = false;
          this.selectedIndustryOption = false;
        //   if(this.$router.history.current.path =="/price-comparison")
        //   {
        //       this.$router.push('/')
        //   }
        
        },
        startingPoint:function(event)
        {
                event.preventDefault();
                this.restartTheWorkFlow();
                this.$refs.comparisonModal.open();
                this.allIndustries = true;

        },
        startBySelectingIndustry:function(event)
        {
            event.preventDefault();
            if(this.$router.currentRoute.path =="/price-comparison")
            {
                this.$toaster.info("Redirecting to home page..");
                setTimeout(() => {
                         this.$router.push('/')
                }, 3000);  
               
            }else{

            this.restartTheWorkFlow();
            this.$refs.selectIndustryModal.open();
            this.allIndustries = true;
            }

        },
        selectedIndustry:function(event, industry)
        {

            event.preventDefault();
            this.restartTheWorkFlow();
            this.loadingMessage ="Loading..."
            this.loader = true
            // this.$refs.comparisonModal.open();
            this.showIndustryTitle = false
            this.selectedIndustryOption = false;
            this.selectedIndustryName ="";
            this.selectedIndustryId = industry.id
            this.allIndustries = false
            this.industryCompanies = [];

             axios
                .get("api/getCompanies?data_name=companies&industry_id="+this.selectedIndustryId+"&is_active=1")
                .then((response) => {
                if (response.data.status === 200) {
                setTimeout(() => {
                  if( response.data.companies.length > 0)
                     {
                         this.industryCompanies = response.data.companies;
                         this.showCompanyTitle = true;
                         this.title ="SELECT COMPANIES"
                         this.allCompanies = true
                         this.loader =false
                         this.selectedIndustryOption = true;
                         this.showIndustryTitle=true
                         this.industryTitle ="SELECTED INDUSTRY";
                         this.selectedIndustryName = industry.name.toUpperCase();
                         let default_company = this.industryCompanies.filter(el => el.is_default==1);
                         if( default_company.length!=0)
                         {
                            this.selectedCompaniesDetails.push(default_company[0])   
                         }
                    }else{
                            this.loader =false
                            this.noCompaniesPlaceholder = true;
                    }
            }, 2000);
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
         getIndustries:function()
            {
                axios
                    .get("api/getIndustries?data_name="+this.industries_data)
                    .then((response) => {

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
        getProducts()
        {
            axios
                .get("api/getProducts?data_name=products")
                .then((response) => {

                if (response.data.status === 200) {
                    this.products = response.data["products"];
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
        getCompanies:function()
        {
            axios
            .get("api/getCompanies?data_name="+this.companies_data)
            .then((response) => {
            if (response.data.status === 200) {
                this.companies = response.data[this.companies_data];
             //   this.$store.commit("putCompanies", this.companies)
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

        saveRedirect:function(event, company)
        {
            axios
            .post("api/new", company)
            .then((response) => {
            if (response.data.status === 201) {
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
        selectedFinalProducts:function(event, product)
        {
            if(this.chosenItems.length < 0)
             {
                this.noProductSelectedError = "Select something";
             }
            else{
                this.noProductSelectedError = null;
                if(!this.visitorSelectedProducts.some(data => data.id === product.id))
                {  
                    this.visitorSelectedProducts.push(product);  
                }
             }
        },
        saveVisitorSelections:function()
        {
             let data = {
                products: this.chosenItems,
                companies:this.selectedCompaniesDetails
               }

             axios
                .post("api/saveVisitorSelection",data)
                .then((response) => {
                if (response.data.status === 201) 
                {
                    console.log("visitor data saved");
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
        generateFinalBill:function(event)
        {
            if(this.chosenItems.length > 0)
            {
                this.selectProducts = false;
                this.productsTable = false;
                this.productsLoader = true;
                this.productsLoaderMessage =" Loading wishlist products..."
                this.getTotalCost();
                this.saveVisitorSelections();
                let products__  = [];
                this.visitorSelectedProducts.forEach(product => {
                     product.product_attributes = [];
                    products__.push(product)
                })

                products__.forEach(item => {
                       this.chosenItems.forEach(item_ => {
                            item_.forEach(element_ => {
                                    if(item.id === element_.product_id)
                                    {
                                        item.product_attributes.push(element_);
                                    }
                            })
                    })
                })

                let all_products = [];
                products__.forEach(product_element_ =>
                {
                    const productAttributes_ = product_element_.product_attributes.reduce((tot, product) => 
                                                        {
                                                            if (!tot[product.description])
                                                                {   
                                                                    tot[product.description] = []
                                                                }
                                                                    const product_ = product;
                                                                    tot[product.description].push(product_)                                                                    
                                                                return tot
                                                        }, {})
                    product_element_.product_attributes = productAttributes_;
                    all_products.push(product_element_);
                })

                   const grouped = all_products.reduce((grouped, product) => {
                                            const key = product.category.name
                        
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {})
                            
                this.finalVisitorSelectedProducts = grouped;

                setTimeout(() => {
                      this.billTable = true;
                      this.productsLoader = false;
                }, 3000);

            }else{
                this.noProductSelectedError ="Select something"
            }
        },
        redoSelectCompanies:function(event)
        {
            event.preventDefault();
            this.allCompanies = true;
            this.showSelectedCompanyNames =false
            this.allCategories = false;
            this.selectedCategoriesDetails= [];
            this.title="SELECT COMPANIES";
            this.showCategoriesTitle=false;
            this.totalSelectedCompanies = 0;
            this.shopsavvyExist=false;
            this.shopsavvyDetails=null;
            this.atLeastTwoCat =true

        }, 
        getCategories:function(event, collapsibleEvent)
        {
            event.preventDefault();



         //   if()
            this.allCompanies = false
            this.showSelectedCompanyNames = true
            this.showCreateComparisonTableBtn = false;
            this.allCategories = false;
            this.title ="SELECTED COMPANIES"
            this.showCategoriesTitle = true;

            if(this.shopsavvyDetails != null)
            {
                  this.selectedCompaniesDetails.forEach(el => { 
                                         if(el.name == this.shopsavvyDetails.name)
                                             {
                                                this.shopsavvyExist = true;   
                                            }
                                        }
                                    );

                if(!this.shopsavvyExist)
                {
                    this.selectedCompaniesDetails.push(this.shopsavvyDetails);
                }
            }

            this.selectedCompaniesDetails = this.selectedCompaniesDetails.sort(this.GetSortOrder("id"));
            this.totalSelectedCompanies =this.selectedCompaniesDetails.length
            if(this.categories.length<=0)
            {

                this.loadingMessage ="Loading Categories";
                this.loader = true

                axios
                .get("api/getCategories?data_name="+this.categories_data+"&industry_id="+this.selectedIndustryId+"&is_active=1")
                .then((response) => {
                if (response.data.status === 200) {
                    this.categories = response.data[this.categories_data];
                    this.loader = false;
                    this.loadingMessage ="";
                    this.allCategories = true;
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

            }else{
               this.allCategories =true;
            }           
        },

        showToaster:function(event)
        {
            this.$toaster.info("Can't choose a default company.It comes pre-selected");  
        },
        getProductAttributes:function()
        {
             axios
                .get("api/getCompanyProducts?data_name=attributes")
                .then((response) => {
                if(response.data.status === 200) 
                {
                    this.companyProductAttributes = response.data.attributes;
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
        // getPromotionDetails:function()
        // {
            
        //       axios
        //         .get("api/getPromotions?data_name=promotion&is_active=1")
        //         .then((response) => {
        //         if(response.data.status === 200) 
        //         {
        //             this.promotion_details =response.data['promotion'][0]; 
        //         } else {
        //                 Vue.$toast.open({
        //                     message: response.data.message,
        //                     type: "error",
        //                     position: "top",
        //                 });
        //            }
        //         })
        //         .catch((error) => {
        //             Vue.$toast.open({
        //                 message: error.message,
        //                 type: "error",
        //                 position: "top",
        //             });
        //         });
        // },
        // getHeaderPromotionData:function()
        // {
        //      axios
        //         .get("api/getHeaderPromo?data_name=header_promotion")
        //         .then((response) => {
        //         if(response.data.status === 200) 
        //         {
        //             this.header_promotion_details = response.data; 
        //         } else {
        //                 Vue.$toast.open({
        //                     message: response.data.message,
        //                     type: "error",
        //                     position: "top",
        //                 });
        //            }
        //         })
        //         .catch((error) => {
        //             Vue.$toast.open({
        //                 message: error.message,
        //                 type: "error",
        //                 position: "top",
        //             });
        //         });
        // },
      },
      mounted(){
        this.getIndustries();
        if(this.$router.currentRoute.name == "priceCatalogList")
        {

            this.comparePriceText = false
        this.homeText = true
        }else{
              this.comparePriceText = true
        this.homeText = false

        }
                    
        //   this.getPromotionDetails();
        //   this.getHeaderPromotionData();
      }
   }
</script>


<style scoped>
.promo_container{
   width:100%;
   padding:20px;
}
.promo_text{
    width:100%;
}
.promo_company_name{
    width: 100%;
}
  .title{
      text-transform: uppercase;
      margin:13px
  }
.option{
    border-radius: 20px;
    border: 1px solid #73AD21;
    padding: 15px; 
    width: 100px;
    height: 15px; 

}

#close {
    float:right;
    display:inline-block;
    padding:2px 5px;
    background:#ccc;
}
.companies-display{
    display: flex;
    flex-wrap: wrap;
}
.column_size{
     max-width:    100%;
    
}
.card_name_size{
 padding: 0.4rem;
}
  
  .selected-companies{
     margin-top: 16px!important;
  }

  .f6{
          font-size: 12px!important;
  }

  .topic-tag {
    margin: 0 .125em .333em 0;
}

.delete-topic-button, .topic-tag, .topic-tag-action {
     background-color: #ff6c02;
    border: 1px solid transparent;
    border-radius: 2em;
    display: inline-block;
    font-weight: 500;
    line-height: 18px;
    line-height: 22px;
    padding: 0 10px;
    color: white;
     font-size: 0.875rem;
}

a {
    text-decoration: none;
}

.nextBtn{
    display: inline-block;
    padding: 1.0rem 2.20rem 1.0rem 2.0rem;
    border: 1px solid #ff6c02;
    border-radius: 4px;
    background-color: #ff6c02;
    color: #ffffff;
    font-weight: 600;
    font-size: 0.875rem;
    line-height: 0;
    text-decoration: none;
    transition: all 0.2s;
}

.testimonial-author{
    	cursor: pointer;
        text-transform: uppercase;
        color:#1e266d;
            font-weight: 600;
         font-size: 0.875rem;
         
}
.closeBtn{
  

        margin-top: -3px;
    font-size: 23px;
    float: right;
    margin-left: 20px;
    	cursor: pointer;
}


 .card-body:hover {
     border: 1px solid #ff6c02;
     border-radius: 0.2px;

}


.industries{
    cursor: pointer;
}

.common{
        font-weight: 600;
    font-size: 0.875rem;
     color:#1e266d;
     text-decoration-line: underline;
}

.vm-header .vm-header-border span{
       font-weight: 600;
    font-size: 0.875rem;
     color:#1e266d;
}
.card-body{
display:flex; justify-content:center; align-items:center;
}

th{
    text-transform: uppercase;
}

.company_default::after{
  position: absolute;
  content: attr(data-label);
  top: 0px;
  right: -1px;
  padding: 0.05rem;
  width: auto;
  background: #3949ab;
  color: white;
  font-size: smaller;
  text-align: center;
  margin-bottom: 2px;
  font-family: 'Roboto', sans-serif;
  box-shadow: 4px 4px 15px rgba(26, 35, 126, 0.2);
}
.error{
    color:red;
}

</style>
