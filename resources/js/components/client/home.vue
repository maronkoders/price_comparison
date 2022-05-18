<template>
<div>
    <navBar/>
    <br />
    <br />
    <br />

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/Artboard+1price.webp" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/winter.webp" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/TODAY.webp" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
        
    
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <div class="text-container">
                        <h1 class="h1-large">Get  great value for your money.</h1>
                        <p class="p-large">Infinite number of products from different dealers to compare from.</p>
                        <a class="btn-solid-lg" href="#newsletters">Sign up for Newsletters</a>
                        <!-- <a class="btn-outline-lg page-scroll" href="#intro">Discover</a> -->
                    </div> <!-- end of text-container -->
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/header.webp" alt="alternative">
                    </div> <!-- end of image-container -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header>

       <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Brands and shops that use <span>Priceline</span> to grow their business</h4>
                    <hr class="section-divider">

                    <!-- Image Slider -->
                      <Spinner v-show="clientsLoader" message="Loading our clients" size="medium"></Spinner>
                    <div class="slider-container">
                        
                        <!-- <div class="swiper-container image-slider" >
                            <div class="swiper-wrapper"  v-for="company in ourClients" :key="company.id">
                                <div class="swiper-slide" >
                                    <img class="img-fluid"  :src="company.logo_path" alt="alternative">
                                </div>
                            </div>
                        </div>  -->

                         <div class="swiper-container image-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/images/spa.jpg" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/images/picknpay.jpg" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/images/ok.jpg" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/images/foodworld.jpg" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/images/bonmarche.jpg" alt="alternative">
                                </div>
                               
                            </div>
                        </div> 

                        
                    </div> 
                   

                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> 

       <div id="intro" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img class="img-fluid" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/coffee.webp" alt="alternative">
                </div>
                <div class="col-lg-4">
                    <img class="img-fluid" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/IRVINES.webp" alt="alternative">
                </div>
                <div class="col-lg-4">
                    <img class="img-fluid" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/hamper.webp" alt="alternative">
                </div>

            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>

    
	<div class="form-1"  id="newsletters">
		<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">Subscribe for News letters</h2>
                    <p class="p-heading">
                        Be part of the story and follow us on Instagram via
                        
                         <a target="_blank" href="https://www.instagram.com/pricelinezim/">@pricelinezim</a> and subscribe to the newsletter for promotion updates from different shops</p>
                </div>
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                
                    <form>
                         <div class="form-group mail">
                            <input type="text" class="form-control-input"  id="name" v-model="subscriberName">
                            <label class="label-control">Name</label>
                            <div class="error">
                                {{ validation.firstError('subscriberName') }}
                            </div>
                            
                        </div>
                         <div class="form-group mail">
                            <input type="text" class="form-control-input"   id="phone" v-model="subscriberPhone">
                            <label class="label-control">Phone number</label>
                          <div class="error">
                                {{ validation.firstError('subscriberPhone') }}
                            </div>
                        </div>
                        <div class="form-group mail">
                            <input type="email" class="form-control-input" id="nemail"  v-model="subscriberEmail">
                            <label class="label-control">Email address</label>
                            <div class="error">
                                {{ validation.firstError('subscriberEmail') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" @click="submitSubscriberDetails($event)" class="form-control-submit-button">Subscribe</button>
                        </div>
                        <div class="form-message">
                            <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                        </div>
                    </form>  
                </div>
            </div>
        </div> 
    </div> 

    <site-last-tag/> 
    	
</div>
    
</template>
<script>
import navBar from './navbar.vue';
import siteLastTag from './footer.vue';
import axios from "axios";
import Vue from "vue";
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})
import Spinner from 'vue-simple-spinner';
import SimpleVueValidation from 'simple-vue-validator';
  const Validator = SimpleVueValidation.Validator;
Vue.use(SimpleVueValidation);

export default {
  name: "home",
    components:{
      navBar,
      Spinner,
      siteLastTag
  },
  data(){
    return {
            subscriberName:"",
            subscriberPhone:"",
            subscriberEmail:"",
            ourClients:[],
            clientsLoader:false
      }
  },
  validators: {
    subscriberEmail: function (value) {
        return Validator.value(value).required().email();
      },
       subscriberName: function(value) {
        return Validator.value(value).required().regex('^[A-Za-z ]*$', 'Must only contain alphabetic characters.');
      },
      subscriberPhone: function(value) {
        return Validator.value(value).required().digit().length(10);
      },
  },
  methods:{
      clearFields:function()
      {
           this.subscriberName ="";
                        this.subscriberPhone ="";
                        this.subscriberEmail ="";
      },
      getCompanies:function()
      {
          this.clientsLoader = true;
            axios
                .get("api/getCompanies?data_name=companies")
                .then((response) => {
                    if(response.data.status == 200)
                    {
                        this.clientsLoader = false;
                        this.ourClients = response.data.companies;
                      //  this.$store.commit('putCompaniesData', this.our)
                    }else{
                        this.$toaster.error(response.data.message)
                    }
                })
                .catch((error) => {
                     this.clientsLoader = false;
                    this.$toaster.error(error.message)
                });
      },
    
      submitSubscriberDetails:function(event)
        {
         event.preventDefault();
         let payload = {
                name: this.subscriberName,
                phone:this.subscriberPhone,
                email:this.subscriberEmail,
               subscriberSource :"home_page"
            }

        let  toaster_ = this.$toaster;
        // let name_ = this.subscriberName;
        // let email = this.subscriberEmail;
        // let phone = this.subscriberPhone;

        this.$validate()
          .then(function (success) {
            if (success) {
                axios
                .post("api/newSubscriber", payload)
                .then((response) => {
                    if(response.data.status == 201)
                    {
                        toaster_.success("Thank you for subscribing..")
                        setTimeout(() => {
                            window.location.reload();
                        }, 1800);
                    }
                    else if(response.data.status == 422)
                        {
                            if(response.data.message.hasOwnProperty('phone'))
                            {
                                toaster_.error("Phone number is taken");  
                            }
                            if(response.data.message.hasOwnProperty('email'))
                            {
                                toaster_.error("Email is taken already"); 
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
          })
        },
  },
  mounted(){
    this.getCompanies(),
    function()
    {
         this.$nextTick(function () {
            window.setInterval(() => {
                this.clearFields();
            },1000);
        })
    }
  },

  
}
</script>
<style scoped>
  .error{
      color:red;
  }
</style>
