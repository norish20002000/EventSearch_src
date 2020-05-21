<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="btn_row">
                    <div>
                        <button type='button' class="btn btn-outline-primary" @click="getDataOpened">公開data</button>
                    </div>
                    <div>
                        <button type='button' class="btn btn-outline-primary" @click="getDataClosed">非公開data</button>
                    </div>
                </div>
                <div>
                    <h5>{{eventCount}}件</h5>
                    <h5>{{eventType}}</h5>
                </div>
                <div class="card" v-for="event in events" :key="event.id">
                    <div class="card-header">{{event.id}}</div>
                    <div class="card-body">
                        <div class="icon fl">
                            <a :href="'/eventbank/event/edit/' + event.id">
                                <img class="thumb_img" :src="event.image_url"/>
                            </a>
                        </div>
                            <a :href="'/eventbank/event/edit/' + event.id">
                                <div class="fl">
                                    <div>{{event.title | truncate(30, '...')}}</div>
                                    <div class="days">
                                        <div>開催日</div>
                                        <div>
                                            <div v-for="date in event.date" :key="date.id">
                                                <div>{{date.event_date}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>{{event.introduction | truncate(50, '...')}}</div>
                                </div>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // Vue.filter('truncate', function(value, length, omission) {
    //     var length = length ? parseInt(length, 10) : 20;
    //     var ommision = omission ? omission.toString() : '...';

    //     if (value.length <= length) {
    //         return value;
    //     }

    //     return value.substring(0, length) + ommision;
    // });

    export default {
        name: "ExampleComponent",
        props: {
            eventData: "",
        },
        data() {
            return {
                events: this.eventData,
                eventType: "非公開データ表示中",
                eventCount: this.eventData.length,
            }
        },
        methods: {
            getDataOpened: function() {
                let data = {
                            params: {
                                status: 0,
                                }
                            }
                data._token = document.getElementsByName('csrf-token')[0].content;
                axios.get("/api/eventdata", data,).then((result)=>{
                    console.log(result.data)
                    this.events = result.data.event_data

                    this.eventType = "公開データ表示中"
                    this.eventCount = this.events.length
                }).catch(error => {
                    console.log(error.message)
                })
            },
            getDataClosed: function() {
                let data = {
                            params:{
                                status: 1,
                                }
                            }
                data._token = document.getElementsByName('csrf-token')[0].content;
                axios.get("/api/eventdata", data).then((result)=>{
                    console.log(result.data)
                    this.events = result.data.event_data

                    this.eventType = "非公開データ表示中"
                    this.eventCount = this.events.length
                }).catch(error => {
                    console.log(error.message)
                })
            },
        },
        filters: {
            truncate: function(value, length, omission) {
                var length = length ? parseInt(length, 10) : 20;
                var ommision = omission ? omission.toString() : '...';

                if (value == undefined) {
                    return value;
                }

                if (value.length <= length) {
                    return value;
                }

                return value.substring(0, length) + ommision;
            },
        },
        beforeCreate () {
            console.log('beforeCreate: ' + this.events)
        },
        created () {
            console.log('created: ' + this.events)
        },
        mounted() {
            console.log("test: " + this.events)
            console.log('Component mounted.')
        }
    }
</script>
