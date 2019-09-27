<template>
    <div id="show-schedule" class="row my-4">
        <div class="col-md-8 offset-md-2">
            <h3>Show Schedule<small class="text-muted"> / {{ name }}</small></h3>
            <div id="show-gadget" class="show-gadget">
                <script src="https://calendars.branson.com/js/2.1/calendar.js" type="application/javascript"></script>
                <script type="application/javascript">
                    var BransonCalendar = new BransonCalendarWidget('{{ gadget }}', 'green');
                    BransonCalendar.setNarrow();
                    BransonCalendar.display();
                </script>
            </div>
        </div>
    </div>
</template>

<script>
    

    export default {
        props: {
            gadget: {
                type: String,
            },
            name: {
                type: String,
            },
        },

    }
</script>
