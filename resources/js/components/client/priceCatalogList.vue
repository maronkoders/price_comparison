<template>

<div>
    <navBar/>
    <br />
    <br />
    <br />

        <div class="container" >
           
            <div class="row one">
                <div class="col-lg-12">
                    <center>
                         <h4>PRODUCTS LISTING TABLE.</h4>
                    </center>
                    <hr class="section-divider">
                   

                       
        

               <div style="text-align:center">
                    <Skeleton v-show="textDefault"/>
                  <span class="text-muted" v-show="selectProductsText">
                    <small>
                        {{select_text}}
                    </small> 
                  </span> 

               </div>

                <div   style="margin-bottom:10px">

                    <Skeleton
                                height="600px"
                                color="#e6f3fd"
                                highlight="#f9f9f9"
                                v-show="productsLoader"
                            
                            />
                </div>


                <div style="text-align:center" v-show="noDataTag">

                    <img  src="/images/no_data.svg" style="width:250px;height:250px;"/>
                    
                    <br/>
                    <br/>
                   
                  <span class="text-muted">
                    
                     {{noDataText}}
                   
                  </span> 

               </div>



        <div class="container table-responsive"> 
                <table class="table table-bordered table-hover" v-show="productsTable" width="100%" style="">
                <thead class="thead-dark">
                    <tr>
                            <th class="table1" >Select <b>
                                             &emsp;&emsp;&emsp;
                                        </b></th>
                          <th class="table1">Category <b>
                                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </b></th>
                    <th class="table1" >Brand <br><b>
                                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </b></th>

                    <th class="table2" v-for="company in selectedCompaniesDetails" :key="company.id">
                        {{company.name}} <b>
                                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </b>
                    </th>
                 

                    </tr>
                </thead>
                <tbody>


                     <tr v-for="(product , key) in products" :key="key">
                       <td>
                            <tr  v-for="(product_ , index) in Object.values(product)" :key="index">
                                    <td style="border:none;">
                                        <b>
                                             &emsp;
                                        </b>
                                            <tr class="mywidth" v-for="(attribute_details,index)  in Object.values(product_.product_attributes)" :key="index">   
                                        <td class="byna" >              
                                            <input style="width:60px;"
                                                    type="checkbox"
                                                    v-model="chosenItems"
                                                    :value="attribute_details"
                                                    @change="selectedFinalProducts($event, product_)"
                                                />
                                         </td>
                                        </tr>
                                    </td>
                                </tr>

                            </td> 
                            
                         
                         <td colspan="1">
                              <span>
                                    <b>{{key.toUpperCase()}}</b>
                               </span>
                         </td>
                        <td>
                             <tr v-for="(product_details , i) in Object.values(product)" :key='i'>
                                 <td style="border:none;">
                                     <b>
                                         <u class="wraprangu">
                                              {{product_details.name}}
                                             </u> 
                                         </b>
                                     <tr v-for=" (product_attribute, index)  in Object.keys(product_details.product_attributes)" :key="index">
                                           <td style="width:250px;">
                                              {{product_attribute}}

                                                <span> 
                                                        {{Object.values(product_details.product_attributes)[index][0].sku.measurement}}
                                                </span>

                                            </td>
                                             <br/>
                                      </tr> 
                                 </td>
                             </tr>
                        </td>
                           
                            <td  v-for="company in selectedCompaniesDetails" :key="company.id">
                               <tr v-for="(product_ , index) in Object.values(product)" :key="index"> 
                                   <td style="border:none;" >
                                        <b>
                                             &emsp;
                                        </b>

                                       <tr v-for=" (product_attribute, index)  in Object.values(product_.product_attributes)" :key="index">
                                          <td style="width:200px;" v-if="product_attribute.some(data => data.company_id == company.id)">  
                                                 
                                                  &emsp;
                                                    <span style="margin-left:-15px;">
                                                    {{ 
                                                        product_attribute.filter(function(elem){
                                                                    if(elem.company_id == company.id) return elem;
                                                                })[0].price
                                                        }}      
                                                    </span>

                                            </td>
                                            <td  style="width:200px;" v-else>
                                               
                                                <span style="margin-left: 6px;">
                                                    ----
                                                </span>
                                               
                                            </td>
                                       </tr>
                                   </td>
                                 </tr>
                            </td> 
                         
                        </tr>
                       

                     <tr class="bordernone">
                           <th scope="row" class="bordernone">

                              <span style="color:red">{{noProductSelectedError}} </span>
                              <br/>
                                <button  class="nextBtn"  @click="generateFinalBill($event)">
                                     TOTAL
                                </button>

                              
                            </th>
                          <th scope="row" class="bordernone">
                          </th>
                          <td></td>
                           <td v-for ="(totalCompanies , index) in totalSelectedCompanies" :key="index">
                           </td>
                          
                     </tr>
            
                </tbody>
                </table>
                </div>

                <div class="container table-responsive">
<table class="table table-bordered table-hover" v-show="billTable" width="100%" style="">
                <thead class="thead-dark">
                   
                    <tr class="table-info">
                     <th class="table1">Category<b>
                                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </b></th>
                      <th class="table1">Brand<br><b>
                                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </b></th>

                    <th class="table1" v-for="company in selectedCompaniesDetails" :key="company.id">
                        {{company.name}}<b>
                                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </b>
                    </th>
                    </tr>
                </thead>
                
                <tbody>
                 
                    <tr v-for="(product, i) in finalVisitorSelectedProducts" :key="i">
                        <td >
                              <span>
                                    <b>{{i.toUpperCase()}}</b>
                               </span>
                         </td>
                           <td >
                               <tr v-for="(product_details , i) in Object.values(product)" :key='i'>
                                 <td style="border:none;">
                                     <b> <u class="wraprangu">
                                           {{product_details.name}}</u>
                                      
                                         </b>
                                     <tr v-for=" (product_attribute, index)  in Object.keys(product_details.product_attributes)" :key="index">
                                           <td style="width:180px;">
                                               {{product_attribute}}

                                                <span> 
                                                        {{Object.values(product_details.product_attributes)[index][0].sku.measurement}}
                                                </span>

                                            </td>
                                        </tr> 
                                  </td>
                               </tr>
                           </td>

                       <td   v-for="company in selectedCompaniesDetails" :key="company.id">
                               <tr v-for="(product_ , index) in Object.values(product)" :key="index"> 
                                   <td style="border:none;">
                                        <b>
                                             &emsp;
                                        </b>

                                       <tr v-for=" (product_attribute, index)  in Object.values(product_.product_attributes)" :key="index">
                                          <td style="width:250px;" v-if="product_attribute.some(data => data.company_id == company.id)">  
                                                 
                                                  &emsp;
                                                    <span class="wraprangu" style="margin-left:-15px;width:250px;">
                                                    {{ 
                                                        product_attribute.filter(function(elem){
                                                                    if(elem.company_id == company.id) return elem;
                                                                })[0].price
                                                        }}      
                                                    </span>

                                            </td>
                                            <td v-else style="width: 250px;">
                                                   
                                                <span style="margin-left:6px;width:250px;" >
                                                    ----
                                                </span>
                                                    
                                            </td>
                                       </tr>
                                   </td>
                                 </tr>
                            </td> 
                        </tr>
                         <br>
                    <tr>
                       
                          <th  scope="row">
                              TOTAL (ZWL)
                          </th>
                          <td></td>
                           <td v-for ="total in companyTotals" :key="total">
                               <span style="margin-left:10px;">
                                   <strong>
                                     {{total}}
                                   </strong>
                                   </span>
                           </td>
                     </tr>

                     <!-- <tr>
                          <th scope="row">
                             Site Links
                          </th>
                          <td></td>
                           <td v-for ="(company , index) in selectedCompaniesDetails" :key="index">
                                   <strong>
                                     <a :href="company.site_link" target="_blank" @click="saveRedirect($event, company)" >  {{company.name.toUpperCase()}} </a>
                                   </strong>
                           </td>
                     </tr> -->
 
            
                </tbody>

                <p>
                     <a href="javascript:void(0)" @click="generateCatalog($event)">

                           <!-- <a href="javascript:void(0)" @click="dowloadPdf()"> -->
                                
                              <i class="fa fa-download" aria-hidden="true"></i>
                                <small>
                                    DOWNLOAD CATALOG
                                </small>
                              </a>

                </p>
 <tr class="bordernone">
                          <th scope="row" class="bordernone">
                          </th>
                          <td></td>
                           <td v-for ="(totalCompanies , index) in totalSelectedCompanies" :key="index">
                           </td>
                            <!-- <th scope="row" class="bordernone">

                              <span style="color:red"></span>
                              <br/>
                                <button  class="nextBtn mybtr"  @click="generateFinalBill($event)">
                                    BACK
                                </button>

                              
                            </th> -->
                     </tr>
                </table> 
                </div>

                   <modal ref="newsLetterSubscribers" no-close-on-backdrop no-close-on-esc hide-cancel width="400px" title="ENTER YOUR DETAILS"  :hide-ok="true" hide-footer centered>
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- Newsletter Form -->
                  <form>
                         <div class="form-group" :class="{ 'form-group--error': $v.subscriberName.$error }">
                             <label>Name</label>
                            <input type="text" class="form-control-input" autocomplete="off" v-model.trim="$v.subscriberName.$model">
                            <div class="error" v-if="!$v.subscriberName.required">Field is required</div>
                            <div class="error" v-if="!$v.subscriberName.minLength">Name must have at least {{$v.subscriberName.$params.minLength.min}} letters.</div>
                               <div class="error" v-if="!$v.subscriberName.alpha">Name must have letters only</div>
                            
                      
                        </div>
                         <div class="form-group" :class="{ 'form-group--error': $v.subscriberPhone.$error}">
                               <label>Whatsapp phone number</label>
                            <input type="text" class="form-control-input"  autocomplete="off" v-model.trim="$v.subscriberPhone.$model">
                            <div class="error" v-if="!$v.subscriberPhone.required">Field is required</div>
                            <div class="error" v-if="!$v.subscriberPhone.numeric || !$v.subscriberPhone.maxLength ||  !$v.subscriberPhone.minLength">Phone must be 10 digit number only</div>
                            <!-- <div class="error" v-if="!$v.subscriberPhone.initialDigits">Incorrect format, use 07XXXXXXXXX</div> -->

                           
                        </div>
                        <div class="form-group" :class="{ 'form-group--error': $v.subscriberEmail.$error }">
                             <label>Email address</label>
                            <input type="email" class="form-control-input"  autocomplete="off" v-model.trim="$v.subscriberEmail.$model">
                                     <div class="error" v-if="!$v.subscriberEmail.required">Field is required</div>
                                      <div class="error" v-if="!$v.subscriberEmail.email">Invalid email provided</div>
                        </div>
                        <div class="form-group">
                            <button type="submit" @click="submitSubscriberDetail($event)" class="form-control-submit-button" :disabled="isGenerating">
                        {{downloadText}}
                        
                           
                            </button>
                        </div>
                        <div class="form-message">
                            <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                        </div>
             </form>
                   
                </div> <!-- end of col -->
            </div> <!-- end of row -->

            
            </modal>

    
                </div>
            </div> 
        </div> 
        <div class="site_footer"> 
            <site-footer/> 
        </div>
 
</div>
</template>
<script>
import navBar from './navbar.vue';
import axios from "axios";
import Vue from "vue";
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import modal from 'vue-modality';
Vue.use(Toaster, {timeout: 2500})
import Spinner from 'vue-simple-spinner';
import siteFooter from './footer.vue';
import VueHtml2pdf from 'vue-html2pdf';
import Vuelidate from 'vuelidate';
var pdfMake = require('pdfmake/build/pdfmake.js');
var pdfFonts = require('pdfmake/build/vfs_fonts.js');
pdfMake.vfs = pdfFonts.pdfMake.vfs;
import { Skeleton } from 'vue-loading-skeleton';
import moment from "moment";
Vue.use(Vuelidate)
const { required, minLength ,maxLength, alpha, email,numeric,helpers } = require('vuelidate/lib/validators');

const initialDigits = (value) => helpers.req(value[0] != 0);

export default {
  name: "priceCatalogList",
    components:{
      navBar,
      Spinner,
      siteFooter,
      VueHtml2pdf,
      modal ,
      pdfMake,
      Skeleton
  },
  data(){
    return {
            pdfContent:false,
            promotion_details:null,
            header_promotion_details:null,
          
            // productsLoaderMessage:"Loading products...",
            productsTable:false,
            products:[],
            noProductSelectedError:null,
            totalSelectedCompanies:this.$store.state.selectedCompanies.length,
            selectedCompaniesDetails:this.$store.state.selectedCompanies,
            allServerProducts:[],
            chosenItems:[],
            visitorSelectedProducts:[],
            finalVisitorSelectedProducts:[],
            downloadCatalogLoader:false,
            downloadCatalogBtn:true,
            selectProductsText:false,
            companyTotals:{},
            billTable:false,
            subscriberName:null,
            subscriberPhone:null,
            subscriberEmail:null,
            saveSubscriberBeforeDownloading:false,
            selectionError:"Select something",
            select_text:"ADD A PRODUCT TO YOUR WISHLIST BY CHECKING BOXES IN THE SELECT COLUMN. THEN TOTAL GET THE  BILL.",
            tableHeader:['Category','Brand'],
            tableCategories:[],
            promoCompanyName:null,
            promoText:null,
            promotionDuration:null,
            textDefault:true,
            productsLoader:true,
            noDataTag:false,
            noDataText:"No data, please try again",
            isGenerating:false,
            downloadText:"SAVE"
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
            // initialDigits
            },
    subscriberEmail: {
            required,
            email
            }
        },
  methods:{
       submitSubscriberDetail:function(event)
           {
              event.preventDefault();
              this.downloadText ="SAVING..."
              this.isGenerating = true;
                let payload = {
                        name: this.subscriberName,
                        phone:this.subscriberPhone,
                        email:this.subscriberEmail
                    }

    this.$v.$touch()
      if (!this.$v.$invalid) {
                axios
                .post("api/newSubscriber", payload)
                .then((response) => {
                     this.downloadText ="DOWNLOADING PDF..."
                    if(response.data.status == 201)
                    {
                        this.subscriberName ="";
                        this.subscriberPhone ="";
                        this.subscriberEmail ="";
                        this.$refs.newsLetterSubscribers.hide();
                        this.isGenerating = false;
                        this.dowloadPdf();

                        setTimeout(() => {
                             this.$toaster.success("Catalog has been downloaded")
                        }, 2100);


                        setTimeout(()=>{

                            this.$toaster.info("redirecting to homepage")
                            this.$router.push('/');

                        }, 6000)

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

                        this.downloadText = "SAVE";
                        this.isGenerating = false;

                        }
                    else{
                          this.downloadText ="SAVE";
                         this.isGenerating = false;
                        this.$toaster.error(response.data.message); 
                    }
                })
                .catch((error) => {

                    this.isGenerating = false;
                    this.downloadText ="SAVE";
                    this.$toaster.error(error.message);
                });
        }
    },
        generateCatalog:function(event)
           {   
                this.$refs.newsLetterSubscribers.open();
               //this.downloadCatalogBtn = false;
              //this.downloadCatalogLoader = true;
           },
            dowloadPdf:function()
           {  
                this.tableHeader = ['Category','Brand'];
                this.tableCategories = [];

                let generatedDate = moment(new Date()).format("dddd Do MMMM YYYY HH:mm:ss");

                this.selectedCompaniesDetails.forEach(company => {
                    this.tableHeader.push(company.name)
                });

                let defineTableWidth = [];
                this.tableHeader.forEach(el_=>{defineTableWidth.push('*');});

                    let docDefinition = {
                       header: {
    columns: [
    
      { text: 'Priceline Catalog', color: '#ff6c02',alignment:'center',},
    
    ]
  },
                      watermark:{ text: window.origin, color: '#ff6c02', opacity: 0.18, italics: true,fontSize: 50 },
                      footer: {
                                columns: [
                                 { text: window.origin+" \n Generated on "+generatedDate, alignment: 'left', fontSize:8, margin: 5 },
                                //   { 
                                //     text: 'NOTES',
                                //        fontSize: 10,
                                //         bold: true,  
                                //         margin: [5,50,0,3],
                                //         alignment: 'right'
                                //    },
                                //    { 
                                //         text: 'Please note pricing is subject to change.',
                                //         fontSize:8,
                                //         margin: [5,50,0,3],
                                //         alignment: 'right',
                                //     }
                                ]
                            },
                        info: {
                            title: 'Price Catalog',
                            author: window.origin,
                            subject: 'Price Catalog Output File',
                            keywords: '',
                        },
                            content:  [
                                {
                                    table: {
                                        // headers are automatically repeated if the table spans over multiple pages
                                        // you can declare how many rows should be treated as headers
                                        headerRows: 1,
                                        widths: defineTableWidth,
                                        body: [
                                        this.tableHeader,
                                        ]
                                    }
                                },
                                {text: ''},  
                                {text:this.promoCompanyName, fontSize:12 , alignment: 'center'},  
                                {text: ''},  
                                {text: this.promoText, fontSize:8 , alignment: 'center'},  
                                {text: ''},  
                                {text: this.promotionDuration, fontSize:9 , alignment: 'right',italics: true},
                                { 
                                    text: 'NOTES',
                                },
                                { 
                                    text: 'Please be advised that prices are bound to change. However, we strive to keep you updated with the latest prices.',
                                    fontSize:8
                                }
                            ]
                        }

                        var i = 0;
                        let finalSelectedCat_ = Object.keys(this.finalVisitorSelectedProducts);
                        for(var i = 0; i < finalSelectedCat_.length;i++)
                         {
                              let cat_products = this.finalVisitorSelectedProducts[finalSelectedCat_[i]];
                              let numberBrands = cat_products.length;
                              let cat_name = {text: finalSelectedCat_[i]}
                              let cats_ = [{text:cat_name, fontSize:8}]
                            
                                let tableDiff = this.tableHeader.length - 1;
                                for (let index = 0; index < tableDiff; index++) {
                                    cats_.push('');
                                }
                                
                                docDefinition.content[0].table.body.push(cats_)

                                 for(var p = 0; p <numberBrands;  p++ )
                                    {

                                    let attributes = Object.values(cat_products[p].product_attributes)[0];

                                    //prices grouped by company

                                    const groupedByDescription = attributes.reduce((groupedByDescription, product) => {
                                                const key = product.description+" "+product.sku.measurement;
                                                return { ...groupedByDescription, [key]: (groupedByDescription[key]??[]).concat(product)}
                                                }, {})

                                    //put brand names in the doc definitation

                                    let brand_names = [
                                           {
                                             "colSpan": 1,
                                              "rowSpan": cat_products.length,
                                              "text": "",
                                            },
                                            {
                                            text: cat_products[p].name,   
                                            fontSize:7
                                           }
                                    ]

                                      let tableDiffBrands = this.tableHeader.length - 2;
                                            for (let index = 0; index < tableDiffBrands; index++) 
                                                {
                                                     brand_names.push({
                                                         text:"",
                                                        fontSize:7
                                                    })
                                                }


                                    docDefinition.content[0].table.body.push(brand_names)
                                    //put brand sizes in the doc definition
                        
                                     let prod_attri =
                                        [
                                            {
                                             "colSpan": 1,
                                              "rowSpan": 1,
                                              "text": "",
                                            },
                                            {
                                            text: Object.keys(groupedByDescription)[0],   
                                            fontSize:7
                                           }
                                        ]



                                        //  let priceByCompany = [];
                                       this.selectedCompaniesDetails.forEach(com => 
                                             { 
                                                groupedByDescription[Object.keys(groupedByDescription)[0]].forEach(attr__=>{
                                                    if(com.id == attr__.company_id && cat_products[p].id == attr__.product_id)
                                                    {
                                                         prod_attri.push(
                                                            {
                                                                text: attr__.price,   
                                                                fontSize:7
                                                            })
                                                    }
                                                })
                                            })

                                        // this.selectedCompaniesDetails.forEach(comp =>{
                                        //        priceByCompany.forEach(pric_ =>{
                                        //            if(pric_.company_id == comp.id)
                                        //            {
                                        //                prod_attri.push(
                                        //                     {
                                        //                         text: pric_.price,   
                                        //                         fontSize:7
                                        //                     }
                                        //                )
                                        //            }
                                        //        })
                                        // })

                                        if(prod_attri.length != this.tableHeader.length)
                                        {
                                            let diff_ =  this.tableHeader.length-prod_attri.length;
                                            for (let index = 0; index < diff_; index++) {
                                                 prod_attri.push({
                                                                text: '--',   
                                                                fontSize:7
                                                            })
                                            }
                                        }


                                        // console.log("the currenct pro attri", prod_attri)


                                        //   priceByCompany.



                                        //   for (let index = 0; index < priceByCompany.length; index++) 
                                        //   {
                                        //     const element = array[index];
                                              
                                        //   }



                                        // console.log("prices by company", priceByCompany);


                                    //   let totalCompanies = this.selectedCompaniesDetails.length;




                                        

                                        // let tableDiffBrandSize = this.tableHeader.length - 2;
                                        //     for (let index = 0; index < tableDiffBrandSize; index++) 
                                        //         {
                                                // this.selectedCompaniesDetails.forEach(com => 
                                                //         {
                                                //             [].forEach(_el_ =>{
                                                //             if(com.id == _el_.company_id)
                                                //             {
                                                //                  prod_attri.push({
                                                //                     text:_el_.price,
                                                //                     fontSize:7
                                                //                 })
                                                //             }else{
                                                //                  prod_attri.push({
                                                //                     text:"--",
                                                //                     fontSize:7
                                                //                 })
                                                //             }
                                                //         })
                                                //     });
                                                // }
                                    
                                    docDefinition.content[0].table.body.push(prod_attri)
                                    //  let prod_attri =
                                    //     [
                                    //         {
                                    //             stack:[
                                    //             cat_products[p].name,
                                    //             {
                                    //                ul: [
                                    //                         Object.keys(groupedByDescription)[0]
                                    //                     ]  
                                    //             },
                                                
                                    //           ],
                                    //            fontSize:7
                                    //        }
                                    //     ]

                                            // let tableDiff_ = this.tableHeader.length - 2;
                                            //     for (let index = 0; index < tableDiff_; index++) {
                                            //          prod_attri.push({
                                            //              text:200.00,
                                            //               fontSize:7
                                            //          })
                                                    // companies.forEach(com =>{   
                                                    //     unique.forEach(attr__ => {
                                                    //         if(com.id == attr__.company_id)
                                                    //             {
                                                    //                 let price = {
                                                    //                             text:attr__.price,
                                                    //                             fontSize:7
                                                    //                             }
                                                    //                 prod_attri.push(price);   
                                                    //             }
                                                    //     })
                                                    // });

                                                    // this.selectedCompaniesDetails.forEach(com => 
                                                    // {

                                                    //     console.log("company_detail", com);
                                                    //     Object.values(groupedByDescription).forEach(product_attribute =>
                                                    //     {
                                                    //     const unique = this.getUniqueListBy(product_attribute, "company_id");
                                                    //             unique.forEach(attr__ =>
                                                    //             {
                                                    //             // if(com.id == attr__.company_id)
                                                    //             // {
                                                    //             //     let price = 
                                                    //             //         {
                                                    //             //             text:attr__.price,
                                                    //             //             fontSize:7
                                                    //             //         }
                                                    //             //        prod_attri.push(price);   
                                                    //             //    }
                                                    //             })
                                                    //     })
                                                    // })
                                                // }

                                            // console.log("the latest price", prod_attri);
                                            
                                            // prod_attri.unshift({colSpan: 1,rowSpan:numberBrands, text:''});

                                        
                                      
                                    }

                                  
                         }


                           let companyTotals  = Object.values(this.companyTotals);

                                   companyTotals.unshift({text:''})
                                   companyTotals.unshift({text:'Total (ZWL)'})

                                   docDefinition.content[0].table.body.push(companyTotals)
                                 
                                 console.log(docDefinition)



                    pdfMake.createPdf(docDefinition).download();
           },getUniqueListBy:function(arr, key) {
                 return [...new Map(arr.map(item => [item[key], item])).values()]
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
        getTableHeaderDiff:function()
        {   

            let diff = this.tableHeader - arguments[1]

           for (let index = 0; index <diff ; index++) 
                {
                    arguments[0].push('');   
                }

            return arguments[0];
        },
     containsWhitespace:function(str) {
  return /\s/.test(str);
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
                                     if(this.containsWhitespace(p.price))
                                     {
                                         const new_price = Number(p.price.replace(/\s/g, ""))
                                         let numberPrice = new_price.toFixed(2)
                                           tot[p.company_id].push(numberPrice)
                                     }else{
                                         const convertedPrice = Number(p.price);
                                        const price_ = convertedPrice.toFixed(2);
                                         tot[p.company_id].push(price_)
                                     }
                            }
                        });
                    })
                    return tot
                }, {})

                Object.keys(priceByCompany).forEach((company) => {  
                            const total = priceByCompany[company].reduce((tot, price) => Number(tot) + Number(price))
                           // console.log("total", typeof total);
                            priceByCompany[company] = total.toFixed(2)
                        })
                    
                this.companyTotals  = priceByCompany;
           },
        
        generateFinalBill:function(event)
            {
                if(this.chosenItems.length > 0)
                {
                    this.selectProductsText = false;
                    this.productsTable = false;
                    this.productsLoader = true;
                    // this.productsLoaderMessage =" Loading wishlist products..."
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
                    this.$toaster.error(this.selectionError);
                }
            },
         selectedFinalProducts:function(event, product)
        {
            if(this.chosenItems.length < 0)
             {
                this.$toaster.error(this.selectionError)
             }
            else{
                this.noProductSelectedError = null;
                if(!this.visitorSelectedProducts.some(data => data.id === product.id))
                {  
                    this.visitorSelectedProducts.push(product);  
                }
             }
        },
       getProducts:function()
       {
        
                        axios.get("api/getProducts?data_name=products&industry_id="+this.$store.state.selectedIndustryId+"&product_categories="+this.$store.state.selectedCategoryIds+"&request_option=product_list")
                        .then((response) => {
                        if (response.data.status === 200) {
                           let allProducts = response.data.products;
                           this.allServerProducts = allProducts;
                          if(allProducts.length> 0)
                          {

                           let products_ = [];  
                           allProducts.forEach(prod => {
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
                                    });

                               const grouped = products_.reduce((grouped, product) => {
                                            const key = product.category.name
                        
                                            return { ...grouped, [key]: (grouped[key]??[]).concat(product)}
                                            }, {})


                            this.products = grouped;
                            this.productsTable = true;
                            this.selectProductsText = true;
                            this.textDefault = false
                            this.productsLoader = false;
                          }else{

                            this.textDefault = false
                            this.productsLoader = false;
                            //    this.$toaster.success("No product were found for your selection")
                            this.noDataTag = true;
                            //    this.$refs.comparisonModal.hide();
                          }
                        } else {
                             this.$toaster.success(response.data.message)
                             this.textDefault = false
                             this.productsLoader = false;
                          }
                        })
                        .catch((error) => {
                            this.textDefault = false
                            this.productsLoader = false;
                            this.$toaster.error(error.message)
                        });
       },
        getPromotionDetails:function()
        {
              axios
                .get("api/getPromotions?data_name=promotion&is_active=1")
                .then((response) => {
                if(response.data.status === 200) 
                {
                    this.promotion_details = response.data['promotion'][0];
                    if(this.promotion_details != null)
                    {
                        this.promoCompanyName = this.promotion_details.company.name+" promotion";
                        this.promoText = this.promotion_details.promotion_text;
                        let startDate = this.promotion_details.start_date;
                        let endDate = this.promotion_details.end_date;
                        this.promotionDuration = "Promotion runs from "+startDate+ " to "+endDate;
                    } 
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
        getHeaderPromotionData:function()
        {
             axios
                .get("api/getHeaderPromo?data_name=header_promotion")
                .then((response) => {
                if(response.data.status === 200) 
                {
                    this.header_promotion_details = response.data; 
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
        }
  },
  mounted(){
    this.getProducts();
    this.getPromotionDetails();
    this.getHeaderPromotionData();
  },
}
</script>
<style scoped>
  .error{
    color:red;
  }



</style>
