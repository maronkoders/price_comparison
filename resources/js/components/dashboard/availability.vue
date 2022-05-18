<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-10 offset-md-2">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" style="text-transform:uppercase;">Set Schedule</h4>
                </div>
                <div class="card-body">
                  <form>
                    <label>Availability</label>

                    <select
                      class="form-control"
                      v-model="availability"
                      :class="{error: validation.hasError('availability')}"
                     >
                       <option value>Select Option</option>
                      <option value="Available">Available</option>
                      <option value="Unavailable">Unavailable</option>
                  
                    </select>
                    <div class="message">{{ validation.firstError('availability') }}</div>

                    <br/>
                  
                    <table style="width:100%">
                      <tr>
                        <td>
                            <label>Pick Dates</label>
                              <DatePicker  
                              range 
                              placeholder="Select date range" 
                              :disabled-date="disabledBeforeTodayAndAfterAWeek" 
                              @change="getWeekDays($event)" 
                              @clear="removeOtherDates" 
                              v-model="weekStartDate"  
                              valueType="format">
                              </DatePicker>

                               <div class="message">{{ validation.firstError('weekStartDate') }}</div>
                        </td>
                        <td>
                          <label>Starting Time</label>
                        
                            <DatePicker
                            v-model="mondayStart"
                            format="HH:mm"
                            value-type="format"
                            type="time"
                            placeholder="Select Start Time"
                            @change="getMondayStartTime($event)"
                              ></DatePicker>
                          
                          <div class="message">{{ validation.firstError('mondayStart') }}</div>
                         <div class="message" v-show="showMondayErrors">{{ mondayEndStart }}</div>
                        </td>
                        <td>
                          <label>Ending Time</label>
                       
                           <DatePicker
                            v-model="mondayEnd"
                            format="HH:mm"
                            value-type="format"
                            type="time"
                            placeholder="Select End Time"
                            @change="getMondayEndTime($event)"
                              ></DatePicker>
                         
                          <div class="message">{{ validation.firstError('mondayEnd') }}</div>
                         
                        </td>
                      </tr>
                      
                    </table>

                    <br />

                    <a
                      type="submit"
                      href="javascript:void(0);"
                      class="btn btn-info btn-fill pull-left"
                      @click="clearForm()"
                    >Clear
                    
                    </a>
                    <a
                    style="margin-left:10px;"
                      href="javascript:void(0);"
                      type="submit"
                      class="btn btn-info btn-fill"
                      @click="submitData($event)"
                    >{{text}}
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
import Vue from "vue";
import axios from "axios";
import navBar from "../navBar.vue";
import sideBar from "../sideBar.vue";
import siteFooter from "../dashboard/siteFooter.vue";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import { message } from "ant-design-vue";
import Antd from "ant-design-vue";
import "ant-design-vue/dist/antd.css";
import moment from "moment";
import SimpleVueValidation from "simple-vue-validator";
const Validator = SimpleVueValidation.Validator;
import Spinner from 'vue-simple-spinner';
Vue.use(SimpleVueValidation);
Vue.use(Antd);
export default {
  name: "availability",
  components: {
    navBar,
    sideBar,
    siteFooter,
    DatePicker,
    moment,
    Spinner
  },
  data() {
    return {
      savedDates:[],
      text:"SAVE",
      saving:false,
      canEdit:true,
      availability: "",
      monday: "",
      mondayStart: "",
      mondayEnd: "",
      tuesday: "",
      tuesdayStart: "",
      tuesdayEnd: "",
      wednesday: "",
      wednesdayEnd: "",
      wednesdayStart: "",
      thursday: "",
      thursdayStart: "",
      thursdayEnd: "",
      weekStartDate: "",
      friday: "",
      fridayStart: "",
      fridayEnd: "",
      saturday: "",
      saturdayStart: "",
      saturdayEnd: "",
      sunday: "",
      sundayEnd: "",
      sundayStart: "",
      openMondayStart: false,
      openMondayEnd: false,
      openTuesdayStart: false,
      openTuesdayEnd: false,
      openWednesdayStart: false,
      openWednesdayEnd: false,
      openThursdayStart: false,
      openThursdayEnd: false,
      openFridayStart: false,
      openFridayEnd: false,
      openSaturdayStart: false,
      openSaturdayEnd: false,
      openSundayStart: false,
      openSundayEnd: false,
      minDatetime: "",
      firstDayOfTheweek: "",
      secondDayOfTheweek: "",
      thirdDayOfTheweek: "",
      forthDayOfTheweek: "",
      fifthDayOfTheweek: "",
      sixthDayOfTheweek: "",
      seventhDayOfTheweek: "",
      pastDate:false,
      mondayEndStart: "start must be less than end time",
      showMondayErrors:false,
      showTuesdayError:false,
      showWednesdayError:false,
      showThursdayError:false,
      showFridayError:false,
      showSaturdayError:false,
      showSundayError:false,

      startDate:"",
      endDate:"",

    };
  },
  validators: {
    
    availability: function (value) {
      return Validator.value(value).required();
    },
    weekStartDate: function (value) {
      return Validator.value(value).required();
    },
    mondayStart: function (value) {
      return Validator.value(value).required();
    },
    mondayEnd: function (value) {
      return Validator.value(value).required();
    },

  },
  methods: {
    disabledBeforeTodayAndAfterAWeek(date) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      return date < today;
    },

    checkIfDatesAreEqual:function()
    {
          var choosedDate  = arguments[0];
          this.savedDates.forEach((el)=>{
          if(el === choosedDate)
          {
              return true;
          }else{
             return false;
          }
          });
    },
    getMondayStartTime:function()
    {      
        if(!this.mondayEnd)
        {
          if(this.mondayStart >= this.mondayEnd)
          {
            this.showMondayErrors =true;
          }else{
              this.showMondayErrors=false;
          }
        }else{
            if(this.mondayStart >= this.mondayEnd)
            {
              this.showMondayErrors =true;
            }else{
                this.showMondayErrors=false;
            }
        }  
    },
    getMondayEndTime:function()
    {
      if(this.mondayStart >= this.mondayEnd)
      {
         this.showMondayErrors =true;
      }else{
          this.showMondayErrors=false;
      }
    }, 
    removeOtherDates:function()
    {
      this.firstDayOfTheweek="";
    },
    clearForm:function()
    {
      this.firstDayOfTheweek="";
      this.availability="";
       this.mondayStart="";
      this.mondayEnd="";
      this.weekStartDate="";
      this.validation.reset();
    },

    checkDates:function()
    {
      let data = {
         range: this.dateRange(this.startDate, this.endDate)
      }
        axios
            .post("api/checkDates", data)
            .then((response) => {
              if (response.data.status === 200) {
                console.log("checked dates", response.data.data.length);
                  this.savedDates  = response.data.data;
              } else {
                Vue.$toast.open({
                  message: response.data.message,
                  type: response.data.type,
                  position: response.data.position,
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
    dateRange:function(startDate, endDate, steps = 1) {
          const dateArray = [];
          let currentDate = new Date(startDate);
          while (currentDate <= new Date(endDate)) {
            let date = moment(new Date(currentDate)).format("DD-M-YYYY");
            dateArray.push(date);
            currentDate.setUTCDate(currentDate.getUTCDate() + steps);
          }
          return dateArray;
        },
    getWeekDays:function()
    {
        let start_date = arguments[0][0];
        let end_date  = arguments[0][1];
        this.startDate = moment(start_date).format("YYYY-MM-DD");
        this.endDate = moment(end_date).format("YYYY-MM-DD");
        this.checkDates();
    },

   formatDate: function(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [day, month, year].join('-');
    },
    checkThroughSavedDates:function(){
      var notEmptyDates = [];

      console.log("argument", arguments[0]);
      this.savedDates.forEach(element => 
      {
        if(element !== null)
        {
          notEmptyDates.push(element);
        }
      });




      console.log("saved dates", this.savedDates);


    if(arguments[0].includes(this.formatDate(notEmptyDates[0].date)) && arguments[0].includes(this.formatDate(notEmptyDates[notEmptyDates.length - 1].date)))
      {
          if((this.mondayStart  >= this.savedDates[0].start && this.mondayEnd <= this.savedDates[this.savedDates.length-1].end)||( this.mondayStart <= this.savedDates[0].start && this.mondayEnd >= this.savedDates[this.savedDates.length-1].end ))
          {
              let errorMessage = `Sorry you can't set date and time from ${this.savedDates[0].date} (${this.savedDates[0].start}) - ${this.savedDates[this.savedDates.length-1].date} (${this.savedDates[this.savedDates.length-1].end}) `;
              Vue.$toast.open({
                message: errorMessage,
                type: "error",
                position: "top",
                duration:5000,
              });
          }        
      }else{
          this.$validate().then(function (success) {
        if (success) {
           axios
            .post("api/saveUserAvailability", data)
            .then((response) => {
              if (response.data.status === 201) {
                Vue.$toast.open({
                  message: response.data.message,
                  type: response.data.type,
                  position: response.data.position,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
              } else {
                Vue.$toast.open({
                  message: response.data.message,
                  type: response.data.type,
                  position: response.data.position,
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
        }
      });
      
      }
    },
    submitData: function () {
      event.preventDefault();
      let data = {
        title: this.availability,
        startTime:this.mondayStart,
        endTime:this.mondayEnd,
        range: this.dateRange(this.startDate, this.endDate)
      };

      
      this.checkThroughSavedDates(data.range);
    },
    changeDays: function () {
      event.preventDefault();
      if (arguments[0] === "everyday") {
        this.monday = true;
        this.tuesday = true;
        this.wednesday = true;
        this.thursday = true;
        this.friday = true;
        this.saturday = true;
        this.sunday = true;
        this.saturdayStart ="";
        this.saturdayEnd ="";
        this.sundayStart ="";
        this.sundayEnd ="";
      } else {
        this.monday = true;
        this.tuesday = true;
        this.wednesday = true;
        this.thursday = true;
        this.friday = true;
        this.saturday = false;
        this.sunday = false;
        this.saturdayStart ="00:00";
        this.saturdayEnd ="00:00";
        this.sundayStart ="00:00";
        this.sundayEnd ="00:00";
        this.canEdit =false;
      }
    },
  },
};
</script>
<style scoped>
.days {
  float: right;
}
.checkbox {
  height: 13px;
}
.form-control {
  padding: 0px;
  height: 20px;
}
.main-panel {
  overflow: auto;
  max-height: calc(100vh - 30px);
  min-height: 100%;
}

.align {
  display: block;
}
.message {
  color: red;
}
.btn-sm {
    font-size: 12px;
    border-radius: 3px;
    padding: 5px 10px;
    height: 34px;}

</style>
