<template>
       <nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                  <div class="navbar-logo">
                     <a class="mobile-menu" id="mobile-collapse" href="#!">
                     <i class="feather icon-menu"></i>
                     </a>
                     <a href="javascript:void(0)">
                     <img class="img-fluid" width="150px" src="https://shopsavvycdn.s3.us-east-2.amazonaws.com/priceline.co.zw/logo.webp" alt="Priceline" />
                     </a>
                     <a class="mobile-options">
                     <i class="feather icon-more-horizontal"></i>
                     </a>
                  </div>
                  <div class="navbar-container">
                     <ul class="nav-left">
                        <li class="header-search">
                           <div class="main-search morphsearch-search">
                              <div class="input-group">
                                 <span class="input-group-addon search-close"><i
                                    class="feather icon-x"></i></span>
                                 <input type="text" class="form-control">
                                 <span class="input-group-addon search-btn"><i
                                    class="feather icon-search"></i></span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <a href="#!" onclick="javascript:toggleFullScreen()">
                           <i class="feather icon-maximize full-screen"></i>
                           </a>
                        </li>
                     </ul>
                     <ul class="nav-right">
                        <li class="header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="feather icon-bell"></i>
                                 <span class="badge bg-c-pink">5</span>
                              </div>
                              <ul class="show-notification notification-view dropdown-menu"
                                 data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <li>
                                    <h6>Notifications</h6>
                                    <label class="label label-danger">New</label>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="d-flex align-self-center img-radius"
                                          
                                          alt="Generic placeholder image">
                                       <div class="media-body">
                                          <h5 class="notification-user">John Doe</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                             elit.
                                          </p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </li>
                        <!-- <li class="header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                 <i class="feather icon-message-square"></i>
                                 <span class="badge bg-c-green">3</span>
                              </div>
                           </div>
                        </li> -->
                        <li class="user-profile header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <img  class="img-radius"
                                    alt="Default Avatar">
                                 <span>{{loggedInUser}}</span>
                                 <i class="feather icon-chevron-down"></i>
                              </div>
                              <ul class="show-notification profile-notification dropdown-menu"
                                 data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <!-- <li>
                                    <a href="#!">
                                    <i class="feather icon-settings"></i> Settings
                                    </a>
                                 </li> -->
                                 <li>
                                        <router-link to="/settings/profile">
                                    <a href="javascript:void(0);">
                                    <i class="feather icon-user"></i> Profile
                                    </a>
                                        </router-link>
                                 </li>
                                 <li>
                                    <a href="email-inbox.html">
                                    <i class="feather icon-mail"></i> My Messages
                                    </a>
                                 </li>
                                 <!-- <li>
                                    <a href="auth-lock-screen.html">
                                    <i class="feather icon-lock"></i> Lock Screen
                                    </a>
                                 </li> -->
                                 <li>
                                    <a href="javascript:void(0);" @click="logout($event)">
                                    <i class="feather icon-log-out"></i> Logout
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
</template>
<script>
import axios from "axios";
import Vue from "vue";
import "vue-toast-notification/dist/theme-default.css";

export default{
  name:'nav_bar',
  data(){
     return{
        loggedInUser:null
     }
  },methods:{
     getLoggedInfo:function()
     {

     },
     logout:function(e)
     {
        e.preventDefault();
         Vue.$toast.open({
        message: "Logging out of the system, please wait",
        type: "info",
        position: "top",
      });

        axios
        .post("logout")
        .then((response) => {
          if (response.status === 204) 
          {
              window.localStorage.clear();
            setTimeout(() => {
              window.location = window.origin+ "/login";
            }, 2000);
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
     this.getLoggedInfo()
  }
}
</script>
