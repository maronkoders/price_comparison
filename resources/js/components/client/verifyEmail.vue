<template>
<div>
    <navBar/>
    <br />
    <br />
    <br />

        <div class="container">
            <div class="row" style="height:100%">
                <div class="col-lg-12">
                    <center>
                         <h4> Email verification in progress.Wait a moment.</h4>
                    </center>
                    <hr class="section-divider">
                  
            <div class="row" >
                <div class="col-lg-3">  </div>
                
                <div class="col-lg-6">
                       <Spinner  v-show="loader" message="Verifying email..." size="large"></Spinner>
                </div> <!-- end of col -->

                  <div class="col-lg-3"> </div>
            </div> 

                    
                </div>
            </div> 
        </div> 
<site-footer/>  
</div>
</template>
<script>
import navBar from './navbar.vue';
import axios from "axios";
import Vue from "vue";
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})
import Spinner from 'vue-simple-spinner';
import siteFooter from './footer.vue';

export default {
  name: "verifyEmail",
    components:{
      navBar,
      Spinner,
      siteFooter,
  },
  data(){
    return {
        loader:true,
      }
  },
  methods:{
       verifyEmail:function()
        {
             let payload = {
                        token:this.$route.query.token,
                        updateType: "verify"
                    }

            axios.put("api/verifyEmail", payload)
                            .then((response) => {
                                if (response.data.status === 200) 
                                {


                                } 
                                if(response.data.status ==204)
                                {
                                   this.$toaster.info(response.data.message)
                                   setTimeout(() => {
                                       // this.$route.push('/')
                                   }, 2500);

                                   this.loader=false;
                                }
                            })
                            .catch((error) => {
                                this.$toaster.error(error.message)
                            });
        }
  },
  mounted(){
      this.verifyEmail();
  },
}
</script>
<style scoped>
  .error{
      color:red;
  }
</style>
