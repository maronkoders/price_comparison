import Vue from "vue";
import axios from "axios";
import store from "./storeEvent.js"

var userRole = function(){
    // axios
    // .get("api/getUserRole")
    // .then((response) => {
    //   if (response.data.status === 200) {
    //     store.commit("putLoggedInUser", response.data.data);
    //   } 
    // })
    // .catch((error) => {
    //   Vue.$toast.open({
    //     message: error.message,
    //     type: "error",
    //     position: "top",
    //   });
    // });
};
export default userRole();