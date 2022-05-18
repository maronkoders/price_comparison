import Vue from "vue";
import axios from "axios";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";
Vue.use(VueToast);

var checkConnection = () => {
var userRole = function(){
    axios
    .get("api/checkConnection")
    .then((response) => {
      if (response.data.status === 200) {
        return response.data.data;
      } 
    })
    .catch((error) => {
      Vue.$toast.open({
        message: error.message,
        type: "error",
        position: "top",
      });
    });
};

}

export default checkConnection();