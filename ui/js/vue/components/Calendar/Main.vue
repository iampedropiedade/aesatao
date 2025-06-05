<template>
  <div>
    <full-calendar :options="calendarOptions"></full-calendar>
  </div>
</template>
<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import multiMonthPlugin from '@fullcalendar/multimonth'
import axios from 'axios'

export default {
  name: 'EventCalendar',
  components: {
    FullCalendar
  },
  props: {
    eventsEndpoint: {required: true, type: String},
    locale: {required: false, type: String, default: 'PT'},
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin, multiMonthPlugin ],
        initialView: 'multiMonth',
        duration: {
          months: 12
        },
        initialDate: '2024-09-01',
        contentHeight:"auto",
        handleWindowResize:true,
        events: [],
        header: false,
        eventDataTransform: function(event) {
          if(event.allDay) {
            event.end = moment(event.end).add(1, 'days')
          }
          return event;
        },
      }
    }
  },
  methods: {
    async initFullCalendar() {
      this.loading = true
      this.calendarOptions.locale = this.locale
      axios
          .get(this.eventsEndpoint)
          .then(response => {
            this.calendarOptions.events = response.data
          })
          .catch(errors => {
            console.error(errors)
          })
          .finally(() => {
            this.loading = false
          })
    },
  },
  created: function () {
    this.initFullCalendar()
  },
}
</script>