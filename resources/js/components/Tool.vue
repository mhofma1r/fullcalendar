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
    import Tooltip from 'tooltip.js';

    export default {

        components: {
            FullCalendar,
        },
        methods: {
            handleDateClick(info) {
                // console.log(info);
            },
            handleEventClick(info) {
//
            },
            handleMouseEnter(info) {
                 console.log(info.event);
            },
            handleMouseLeave(info) {
                // console.log(info)
            },
            handleEventRender(info) {
                this.tooltip = new Tooltip(info.el, {
                    title: info.event.title + '<br/>' +
                        '<p>Priorität: ' + info.event.extendedProps.prio + '</p>' +
                        '<p>Status: ' + info.event.extendedProps.progress + '</p>',
                    placement: 'right',
                    trigger: 'hover',
                    padding: 5,
                    html: true,
                    container: 'body'
                });


            }
        },
        tooltip() {

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
                    {title: "Today", start: new Date('2022-12-22 00:00:00')}
                ]
            };
        },
        mounted() {
            axios.get('/horaceho/fullcalendar/events').then(response => {
                this.events = response.data
                if (this.events) {
                    this.calendarEvents = []
                }
                this.events.forEach((event) => {

                    this.calendarEvents.push({
                        url: 'http://www.google.com',
                        title:event.title,
                        progress: event.progress,
                        prio: event.priority,
                        recurrence: event.recurring_in_days,
                        start: event.start_date,
                        end: event.end_date
                    })
                })

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
