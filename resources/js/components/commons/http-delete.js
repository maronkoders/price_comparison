import axios from "axios";
import toasterNotification from "./toaster-notification";

var DELETE = function(URL)
{
    axios
        .delete(URL)
        .then((response) => 
        {
           if (response.data.status === 204) 
          {
              return response;
          } else 
          {
            toasterNotification.notifier(response.data.message,response.data.type,"bottom",3000)
          }
        })
        .catch((error) => 
        {
          toasterNotification.notifier(error.message,"error","bottom",3000);
        });
};

export default DELETE();