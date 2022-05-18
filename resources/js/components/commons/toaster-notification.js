
import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
var notifier =  function(message, type, position = "bottom",duration=1200)
{
    Vue.$toast.open({
        message: message,
        type: type,
        position: position,
        duration:duration
      });
   
};

export default notifier();