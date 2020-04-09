<template>
    <div>
        <FullCalendar
            @dateClick="handleDateClick"
            @eventClick="handleEventClick"
            @eventMouseEnter="handleMouseEnter"
            @eventMouseLeave="handleMouseLeave"
            @eventRender="handleEventRender"
            ref="fullCalendar"
            :plugins="calendarPlugins"
            :weekends="calendarWeekends"
            :events="calendarEvents"
            :locale="fr"
            :header="{
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            }"
        />
    </div>
</template>

<script>

import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from '@fullcalendar/list';
import Vue from 'vue';
import Tooltip from 'tooltip.js';

export default {

    components: {
        FullCalendar
    },
    methods: {
        handleDateClick(info) {
            //console.log(info);
        },
        handleEventClick(info) {
            //console.log(info);
        },
        handleMouseEnter(info) {
            //console.log(info);
        },
        handleMouseLeave(info) {
            //console.log(info);
            this.tooltip = null;
        },
        handleEventRender(info) {
            //console.log(info);
            this.tooltip = new Tooltip(info.el, {
                title:"<div><h3>bongo</h3><p>Typ: Ölwechsel</p><p>Priorität: HOCH</p></div>",
                text:"bimbo",
                placement: 'top',
                trigger: 'hover',
                html: true,
                container: 'body'
            });
        }
    },
    tooltip(){

    },
    data() {
        return {
            tooltip: "torpedo",
            calendarPlugins: [
                dayGridPlugin,
                timeGridPlugin,
                interactionPlugin,
                listPlugin
            ],
            calendarWeekends: true,
            calendarEvents: [
                { title: "Today", start: new Date() }
            ]
        };
    },
    mounted() {
        console.log('mounted()')
        axios.get('/horaceho/fullcalendar/events').then(response => {
            this.events = response.data
            if (this.events) {
                this.calendarEvents = []
                this.events.forEach((event) => {
                    this.calendarEvents.push({
                        title:console.log(event),
                        start: event.start_date,
                        end: event.end_date
                    })
                })
            }
        });
    },
}

</script>

<style>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
@import "~@fullcalendar/timegrid/main.css";
@import "~@fullcalendar/list/main.css";
</style>
