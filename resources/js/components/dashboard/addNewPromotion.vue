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


                  

                   <form>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label> Company</label>
                             <v-select   :options="companies"    label="name"  v-model="company_id"></v-select>
                        
                        </div>
                      </div>

                
                <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Promo Duration</label>
                          <br />
                      
                              <date-picker  v-model="promo_period" range format="YYYY-MM-DD"   :default-value="new Date()"  :disabled-date="latestEndDate"></date-picker>
                        
                        </div>
                      </div>

  
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Promo Text</label>
                      
                               <textarea  style="max-height:450px" ref="textarea"  @focus="resize" @keyup="resize"  rows="5" cols="23" type="text" class="form-control" v-model="promotion_text"> </textarea>
                        
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
 import vSelect from 'vue-select'
 import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
    import moment from 'moment'


Vue.use(Toaster, {timeout: 5000})
export default {
  name: "addNewPromotion",
  components: {
    navBar,
    sideBar,
    siteFooter,
    VueGoodTable,
    modal,
    Spinner,
    vSelect,
    DatePicker
  },
   data() {
    return {
    
    promotion_text:null,
    text:"ADD",
    editText:"EDIT",
    isLoader: false,
      showWarning:false,
      isLoading:true, 
      saving:false,
      promotions:[],
      companies:[],
      company_id:null,
      period :null,
      promo_period:null,
      latestPromoEndDate:null
    };
  },
  methods:{
       latestEndDate:function(date)
      {
    
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if(this.promotions.length>0)
        {
              let end_date = this.promotions[this.promotions.length -1].end_date;
             return  date < new Date(end_date);
        }else{
            return date < today;
        }
    },

    getCompanies()
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
 
clearFields()
    { 
      this.promotion_text = null;
      this.company_id = null;
      this.promo_period =null
    },addIndustry(event)
    {
            this.saving =true;
            this.text =""
            event.preventDefault();
            let data = {
              company_id:this.company_id.id,
              promotion_text: this.promotion_text,
              is_active:1,
              start_date:moment(String(this.promo_period[0])).format('YYYY-MM-DD'),
              end_date: moment(String(this.promo_period[1])).format('YYYY-MM-DD')
            };
            axios
            .post("api/newPromotion?data_name=promotion" , data)
            .then((response) => {
            this.saving =false;
            this.text ="Save"
            if(response.data.status == 201)
            {
                this.$toaster.success(response.data.message);
                this.getPromotions();
                this.clearFields();
                
            }else{
                this.$toaster.error(response.data.message);
              }
            }).catch((error) => {

              this.saving = false;
              this.text ="Save"
              this.$toaster.error(error.message);   
          });
    },
    getPromotions:function()
    {
            
    axios
        .get("api/getPromotions?data_name=promotions")
        .then((response) => {
          if (response.data.status === 200) {
            this.promotions = response.data["promotions"];
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
    ,
     resize() {
        const { textarea } = this.$refs;
        textarea.style.height = textarea.scrollHeight - 4 + 'px';
      }
  },
  mounted()
  {
    this.getCompanies();
    this.getPromotions();
     this.resize();
  }
}
  </script>

