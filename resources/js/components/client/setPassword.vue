<template>
<div>
    <navBar/>
    <br />
    <br />
    <br />

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                         <h4> Set password for  your account.</h4>
                    </center>
                    <hr class="section-divider">
                  
            <div class="row">
                <div class="col-lg-3">  </div>
                
                <div class="col-lg-6">
                    <!-- Newsletter Form -->
                        <form>
                                <div class="form-group" :class="{ 'form-group--error': $v.password.$error}">
                                    <label>Password</label>
                                    <input type="password" class="form-control-input"  v-model.trim="$v.password.$model">
                                    <div class="error" v-if="!$v.password.required">Field is required</div>
                                
                                </div>
                                <div class="form-group" :class="{ 'form-group--error': $v.confirmPassword.$error }">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control-input" v-model.trim="$v.confirmPassword.$model">
                                            <div class="error" v-if="!$v.confirmPassword.required">Field is required</div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" @click="savePassword($event)" class="form-control-submit-button">
                                
                                        
                                    SAVE PASSWORD
                                    </button>
                                </div>
                                <div class="form-message">
                                    <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                                </div>
                    </form>
                   
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
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate)
const { required, minLength} = require('vuelidate/lib/validators');

export default {
  name: "setPassword",
    components:{
      navBar,
      Spinner,
      siteFooter,
  },
  data(){
    return {
            password:null,
            confirmPassword:null,
            email:null
      }
  },
      validations: {
        password: {
                required,
                minLength: minLength(8),
                },
        confirmPassword: {
                required,
                minLength: minLength(8),
                }
        },
  methods:{
       savePassword:function(event)
           {
              event.preventDefault();

                let payload = {
                        token:this.$route.query.token,
                        password:this.password,
                        email:this.email,
                        updateType: "set_password"
                    }

                this.$v.$touch()
                if (!this.$v.$invalid) {
                            axios
                            .put("api/updateUser", payload)
                            .then((response) => {
                                if(response.data.status == 200)
                                {
                                    this.password ="";
                                    this.confirmPassword ="";

                                    setTimeout(() => {
                                        this.$toaster.success(response.data.message)
                                    }, 2100);

                                   // this.$routers.push('/login');
                                }
                                else{
                                   this.$toaster.error(response.data.message)
                                }
                            })
                            .catch((error) => {
                                  this.$toaster.error(error.message)
                            });
                    }
        },

       getUserData:function()
        {
                axios.get("api/getUserData?token=")
                            .then((response) => {
                                if (response.data.status === 200) 
                                {
                                
                                } 
                            })
                            .catch((error) => {
                                this.$toaster.error(error.message)
                            });
        }
  },
  mounted(){
      this.getUserData();
  },
}
</script>
<style scoped>
  .error{
      color:red;
  }


</style>
