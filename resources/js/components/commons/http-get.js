import axios from "axios";

var GET = function()
{
    axios
        .get(arguments[0])
        .then((response) => {
           if (response.data.status === 200) {
              return response;
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
};

export default GET();