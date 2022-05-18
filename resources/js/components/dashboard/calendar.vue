<template>
  <div>
    <sideBar></sideBar>
    <div class="main-panel">
      <navBar></navBar>
      <div id="calendar">
        <FullCalendar :options="calendarOptions"/>
      </div>
        <modal ref="calendarEvent" title="Event Details" :hide-ok="true"  @cancel="$refs.calendarEvent.hide()" centered>

         <div class="card-body-event">
                     
                        <div class="row">
                          
                        <div class="col-md-12">
                         <label><u>Title</u></label>
                           <select
                      class="form-control checkbox"
                      v-model="title"
                      
                    >
                       <option value>Select Option</option>
                      <option value="Available">Available</option>
                      <option value="Unavailable">Unavailable</option>
                      <!-- <option value="Holiday">Holiday</option> -->
                    </select>
                       
                        </div>

                      
                         <div class="col-md-6">
                          <label><u>Start Time</u></label>
                          <input type="time" class="form-control" v-model="start"/>
                        </div>

                        <div class="col-md-6">
                         <label><u>End Time</u></label>
                          <input type="time" class="form-control" v-model="end"/>
                        </div>

                       

                         <div class="col-md-12">
                         <label><u>Date </u></label>
                          <input type="date" class="form-control" v-model="date"/>
                        </div>

                        <div class="col-md-12" style="margin-top:10px;">
                        <a
                        href="javascript:void(0);"
                            type="submit"
                            class="btn btn-info btn-fill pull-left"
                            @click="updateEvent"
                               >{{text}}
                                <Spinner v-show="saving" size="small"></Spinner>
                          </a>

                           <a
                           style="margin-left:10px;"
                            type="submit"
                              href="javascript:void(0);"
                            class="btn btn-danger btn-fill "
                            @click="deleteEvent"
                               >{{deleteText}}
                                <Spinner v-show="deleting" size="small"></Spinner>
                          </a>
                        </div>
                         
                        </div>
                     
                      </div>

      </modal>

       <modal ref="assignmentEvent" title="Assignment Details" :hide-ok="true" @cancel="$refs.assignmentEvent.hide()" centered>

         <div class="card-body-event">
                     
                        <div class="row">
                        <div class="col-md-12">
                         <label class="big"><u>Task Name</u></label>
                         <br/>
                         <span>
                           {{title}}
                         </span>
                         <br/>
                        </div>
                        <div class="col-md-12">
                           <label class="big"><u>Client</u></label>
                         <br/>
                         <span>
                           {{client}}
                         </span>
                         <br/>
                        </div>

                       
                          <div class="col-md-12">
                              <label class="big"><u>All time is in 24 hr notation</u></label>
                            <br/>
                            </div>


                         <div class="col-md-4">
                            <label class="big"><u>Start Time </u></label>
                            <br/>
                         <span>
                           {{start}}
                         </span>
                         <br/>
                         
                        </div>

                        <div class="col-md-4">
                           <label class="big"><u>End Time</u></label>
                           <br/>
                         <span>
                           {{end}}
                         </span>
                         <br/>
                         
                        </div>
                        <div class="col-md-4">
                           <label class="big"><u>Break Time</u></label>
                           <br/>
                         <span>
                           {{break_time}}
                         </span>
                         <br/>
                         
                        </div>

                     
                         <div class="col-md-12">
                           <label class="big"><u>Date </u></label>
                           <br/>
                         <span>
                           {{date}}
                         </span>
                          <!-- <input type="date" class="form-control" v-model="date"/> -->
                        </div>

                        
                         
                        </div>
                     
                      </div>

      </modal>
      <!-- <siteFooter></siteFooter> -->
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import axios from "axios";
import navBar from "../navBar.vue";
import sideBar from "../sideBar.vue";
import siteFooter from "../dashboard/siteFooter.vue";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import availability from "./availability.vue";
import router from "@/js/routes.js";
import modal from 'vue-modality'
import vSelect from "vue-select";
import Spinner from 'vue-simple-spinner';

export default {
  name: "calendar",
  components: {
    navBar,
    sideBar,
    siteFooter,
    FullCalendar,
    availability,
    vSelect,
    modal,
    Spinner,
  },
  data() {
    return {
      showModal: false,
      clients:[],
      title:"",
      text:"UPDATE",
      deleteText:"REMOVE",
      saving:false,
      deleting:false,
      end:"",
      start:"",
      date:"",
      client:"",
      slug:"",
      fullName:"",
      worker:"",
      break_time:"",
      status:{
        'unavailable':"0",
        'available':"1"
      },
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        eventClick: this.handleDateClick,
        events: [],
        customButtons: {
          myCustomButton: {
            text: "Availability",
            click: function () {
              router.push("/set-availability");
            },
          },
        },
        headerToolbar: {
          right: "prev,next today myCustomButton",
          center: "title",
          left: "dayGridMonth,timeGridWeek,timeGridDay",
        },
      },
    };
  },
  methods: {
     removeEvent: function () {
      const item = this.calendarOptions.events.findIndex((p) => p.id === arguments[0]);
      this.calendarOptions.events.splice(item, 1);
    },
    deleteEvent:function()
    {
      this.deleting = true;
      this.deleteText = ""
      event.preventDefault();
      let data = {
        slug: this.slug
      };
      axios
    .post("api/deleteEvent", data)
    .then((response) => {
      this.deleting = false;
      this.deleteText ="REMOVE"
     if(response.data.status === 204)
     {
       this.removeEvent(this.slug);
        this.$refs.calendarEvent.hide()
          Vue.$toast.open({
            message: response.data.message,
            type: response.data.type,
            position: response.data.position,
          });
       }else{
        Vue.$toast.open({
                    message: response.data.message,
                    type: response.data.type,
                    position: response.data.position,
                });
         }
       })
        .catch((error) => {
        this.deleting =false;
         this.deleteText ="REMOVE"
          Vue.$toast.open({
            message: error.message,
            type: "error",
            position: "top",
          });
        });
    },

    getStatus:function()
    {
      let statuses = Object.entries(this.status)
      let selected = statuses.filter((el,i)=>{
           return el[0]==this.title.toLowerCase();
      });
      return selected[0][1];
    },
     updateEvent:function()
    { 
      this.saving =true;
      this.text =""
      event.preventDefault();
        let data = {
          client_id: null,
          start: this.start,
          title: this.title,
          end: this.end,
          date:this.date,
          status:this.getStatus(),
          break_time:null,
          slug: this.slug,
          admin_edited:'"no'
        };
    
    axios
    .post("api/updateAssignedTask" , data)
    .then((response) => {
    this.saving =false;
     this.text ="UPDATE"
     if(response.data.status ===200)
     {
        this.$refs.calendarEvent.hide()
          Vue.$toast.open({
            message: response.data.message,
            type: response.data.type,
            position: response.data.position,
          });
       }else{
        Vue.$toast.open({
                    message: response.data.message,
                    type: response.data.type,
                    position: response.data.position,
                });
         }
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
     getDate:function()
    {
         let today = new Date(arguments[0]);
         return today.getFullYear()+"-"+(today.getMonth()+1) +"-"+today.getDate()
    },
    getTime:function()
    {
      let today = new Date(arguments[0]);
       return  today.getHours()+":"+today.getMinutes();
    },
    checkClient:function()
    {
        if(arguments[0] === 0)
        {
          this.client ="";
        }else{
          this.client  = arguments[1];
        }
    },
    checkBreakTime:function()
    {
        if(arguments[0] === null)
        {
          this.break_time ="";
        }else{
          this.break_time = arguments[0]
        }
    },
    handleDateClick: function (arg) {
       axios
        .get("api/getCalendarEvent/"+arg.event.id)
        .then((response) => {
          if (response.data.status === 200) {
                  this.title= response.data.data.title; 
                  this.start= response.data.data.start;
                  this.end=response.data.data.end;
                  this.date=response.data.data.date;
                  this.slug = response.data.data.slug;
              if(response.data.data.admin_edited ==="yes")
              {
                  this.client=response.data.data.client.name;
               //  this.checkClient(response.data.data.client_id,response.data.data.client);
                  this.checkBreakTime(response.data.data.break_time);
               this.$refs.assignmentEvent.open()
              }else{
                   this.$refs.calendarEvent.open()
              }   
        
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
     
    onShow(data) {
      // do something
    },
    getAvailability: function () {
      axios
        .get("api/calendar")
        .then((response) => {
          if (response.data.status === 200) {
            response.data.data.forEach((element) => {
             let event = {
                title: element.title,
                date: element.date,
                start: element.date + "T" + element.start,
                end: element.date + "T" + element.end,
                allDay: false,
                id: element.slug,
                backgroundColor:element.color
              };
              this.calendarOptions.events.push(event);
            });

            // console.log(this.calendarOptions.events[0].start);
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
  },
  created() {
    this.getAvailability();
    //console.log(this.calendarOptions.events)
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
#calendar {
  margin: 20px;
}
.big{
text-transform: uppercase;
font-weight: bold;
}

</style>
