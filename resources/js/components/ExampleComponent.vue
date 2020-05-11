<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="event in events" :key="event.id">
                    <div class="card-header">{{event.summary}}</div>
                    <div class="card-body">
                        <div class="icon fl">
                            <img :src="event.thumb_url"/>
                        </div>
                        <div class="fl" style="margin: 2px">
                            <div>{{event.id}}</div>
                            <div>{{event.title}}</div>
                            <div>{{event.st_date}}</div>
                            <div>{{event.end_date}}</div>
                            I'm an example component.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExampleComponent",
        props: {
            eventData: "",
        },
        data() {
            return {
                events: this.eventData,
            }
        },
        mounted() {
            // console.log("eventId : " + this.eventData[2].id)
            console.log('Component mounted.')
        }
    }
</script>
