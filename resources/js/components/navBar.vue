<template>
  <div>
    <nav class="navbar navbar-expand-lg" color-on-scroll="500">
      <div class="container-fluid">
        <a class="navbar-brand" href="#pablo">Dashboard</a>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="nav-link" >{{greeting}}</span> 
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">
                <span class="no-icon" @click="logout()">Log out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import axios from "axios";
import Vue from "vue";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";

Vue.use(VueToast);
export default {
  name: "navBar",
  components:{
  },
  data(){
    return {
      greeting:"",
    }
  },
  methods: {
    logout: function () {
      Vue.$toast.open({
        message: "Logging out of the system, please wait",
        type: "info",
        position: "top",
      });

      axios
        .post("logout")
        .then((response) => {
          if (response.status === 204) {
            window.localStorage.clear();
            setTimeout(() => {
              window.location = window.origin;
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
    },
  },
  created(){
    var d = new Date();
    var time = d.getHours();
    if (time < 12) {
     this.greeting = "Good Morning"
    }
    if (time > 12) {
     this.greeting = "Good Afternoon"
    }
  },mounted(){
  
  }
};
</script>