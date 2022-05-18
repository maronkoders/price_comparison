<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">
          <div class="row">

              <div class="col-md-4">

                <div class="list-group">

  <a href="javascript:void(0);" @click="changeView('profile')" class="list-group-item list-group-item-action">Profile</a>
  <a href="javascript:void(0);" @click="changeView('password')" class="list-group-item list-group-item-action">Password</a>

</div>

            </div>
            <div class="col-md-8" v-show="profile">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" v-model="name" disabled/>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" v-model="surname" disabled/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5 pr-1">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" class="form-control" v-model="mobile"/>
                        </div>
                      </div>
                      <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>Telephone</label>
                          <input type="text" class="form-control" v-model="daytelephone"/>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" v-model="email" disabled/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" v-model="address" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" class="form-control" v-model="city" />
                        </div>
                      </div>

                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Postal Code</label>
                          <input type="text" class="form-control" v-model="postalCode" />
                        </div>
                      </div>
                    </div>

                    <a
                    href="javascript:void(0)"
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="updateProfile($event)"
                    >
                    
                 {{text}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    
                    </a>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>

             <div class="col-md-8" v-show="password">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Update Password</h4>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      

                       <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>New Password</label>
                          <input type="password" class="form-control" v-model="new_password"/>
                             <div class="message">{{ validation.firstError('new_password') }}</div>
                        </div>
                      </div>
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" v-model="confirm_password"/>
                             <div class="message">{{ validation.firstError('confirm_password') }}</div>
                        </div>
                      </div>
                    </div>
                    <a
                    href="javascript:void(0)"
                      type="submit"
                      class="btn btn-info btn-fill pull-left"
                      @click="updatePassword($event)"
                    >
                    
                       {{text}}
                      <Spinner v-show="saving" size="small"></Spinner>
                    </a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <siteFooter></siteFooter>
    </div>
  </div>
</template>
<script>
import navBar from "../navBar.vue";
import sideBar from "../sideBar.vue";
import siteFooter from "../dashboard/siteFooter.vue";
import axios from "axios";
import Vue from "vue";
import VueToast from "vue-toast-notification";
import "vue-loading-overlay/dist/vue-loading.css";
import Loading from "vue-loading-overlay";
import "vue-toast-notification/dist/theme-default.css";
import SimpleVueValidation from "simple-vue-validator";
const Validator = SimpleVueValidation.Validator;
Vue.use(VueToast);
Vue.use(Loading);
Vue.use(SimpleVueValidation);
import Spinner from 'vue-simple-spinner'
export default {
  name: "profile",
  components: {
    navBar,
    sideBar,
    siteFooter,
    Loading,
    Spinner
  },
  data() {
    return {
      name: "",
      surname: "",
      daytelephone: "",
      postalCode: "",
      email: "",
      mobile: "",
      address: "",
      city: "",
      slug: "",
      text:"UPDATE",
      saving:false,
      profile:true,
      password:false,
      new_password:"",
      confirm_password:"",
      submitted: false
    };
  },
    validators: {
      new_password: function (value) {
        return Validator.value(value).required().minLength(6);
      },
      'confirm_password, new_password': function (confirm_password, new_password) {
        if (this.submitted || this.validation.isTouched('confirm_password')) {
          return Validator.value(confirm_password).required().match(new_password);
        }
      }
   },
  methods: {
    changeView:function()
    {
        if(arguments[0]==="password")
        {
            this.password =true;
            this.profile=false;
        }else{
          this.password= false
          this.profile =true;
        }
    },
    updatePassword:function($event)
    {
        let payload = 
          {
            password:this.new_password
          }

        this.submitted = true;
        this.$validate()
          .then(function(success) {
            if (success) {

              axios
              .post("api/updatePassword" , payload)
              .then((response) => {
                //this.saving =false;
                //this.text ="UPDATE"
                Vue.$toast.open({
                  message: response.data.message,
                  type: response.data.type,
                  position: response.data.position,
                });
              })
              .catch((error) => {
                  //this.saving =false;
                  //this.text ="UPDATE"
                Vue.$toast.open({
                  message: error.message,
                  type: "error",
                  position: "top",
                });
              });
                
            }
          });
    },
    updateProfile: function (event) {
      event.preventDefault();
  this.saving =true;
     this.text =""
      let data = {
        name: this.name,
        surname: this.surname,
        daytelephone: this.daytelephone,
        postalCode: this.postalCode,
        email: this.email,
        mobile: this.mobile,
        address: this.address,
        city: this.city,
      };

      axios
        .put("api/worker/" + this.slug, data)
        .then((response) => {
           this.saving =false;
            this.text ="UPDATE"
          Vue.$toast.open({
            message: response.data.message,
            type: response.data.type,
            position: response.data.position,
          });
        })
        .catch((error) => {
            this.saving =false;
             this.text ="UPDATE"
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
    },
  },
  created() {
    let loader = this.$loading.show({
      // Optional parameters
      canCancel: false,
      onCancel: this.onCancel,
      width: 40,
      height: 40,
      color: "#002d3f",
    });
    axios
      .get("api/worker")
      .then((response) => {
        window.href = window.origin;
        if (response.status === 200) {
          loader.hide();
          this.name = response.data[0].name;
          this.surname = response.data[0].surname;
          this.email = response.data[0].user.email;
          this.mobile = response.data[0].mobile;
          this.address = response.data[0].address;
          this.daytelephone = response.data[0].daytelephone;
          this.city = response.data[0].city;
          this.postalCode = response.data[0].postalCode;
          this.slug = response.data[0].user.slug;
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
};
</script>
<style scoped>
.container-fluid {
  margin-top: 10px;
}
.main-panel {
  overflow: auto;
  max-height: calc(100vh - 30px);
  min-height: 100%;
}
.message{
  color:red;
}
</style>
