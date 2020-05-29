<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-xs-12" v-for="event in events.data" :key="event.id">
                <div class="card my_card">
                    <!-- <div class="card-header">
                        {{event.id}}
                    </div> -->
                    <div class="card-body">
                        <div>
                            <!-- <span v-if="event.genre.length > 0" class="genre_icon"><i class="far fa-flag" style="margin: 0 3px 0 0"></i>{{event.genre[0].disp_name}}</span> -->
                            <div v-if="event.genre.length > 0">
                                <!-- <div style="position:absolute; top:30px; left:15px"> -->
                                <!-- <span v-for="(genre01, i) in event.genre01" :key="genre01.id" class="genre_icon2"><i class="far fa-flag" style="margin: 0 3px 0 0"></i>{{genre01.disp_name}}</span> -->
                                <!-- </div> -->
                                <!-- {{count(this.leftNum)}} -->
                            </div>
                        </div>
                        <div class="icon fl">
                            <a :href="'/eventdetail/' + event.id">
                                <img v-if="event.image_url" class="thumb_img" :src="event.image_url"/>
                                <img v-else class="thumb_img" src="image/view/noimage.jpg" />
                            </a>
                        </div>
                        <a :href="'/eventdetail/' + event.id">
                            <div class="fl">
                                <div class="event_title">{{event.title | truncate(30, '...')}}</div>
                                <div class="days">
                                        <div v-for="date in event.date" :key="date.id">
                                            <div>{{date.event_date}}</div>
                                        </div>
                                </div>
                                <div>{{event.introduction | truncate(40, '...')}}</div>
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
                genreData: this.genre,
                leftNum: 100,
                // pStyle: {
                //     "color": "#0f0",
                //     "position": "absolute",
                //     "top": "15px",
                //     "left": this.leftNum + "px",
                // }
            }
        },
        computed: {
        },
        methods: {
            pStyle(cnt) {
                return {
                    // "color": "#0f0",
                    // "position": "absolute",
                    // "top": "15px",
                    // "left": this.leftNum + "px",
                }
            },
            count: function(num) {
                this.leftNum + 15
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
            console.log('num : ' + this.leftNum)
            // console.log('beforeCreate: ' + this.events)
        },
        created () {
            console.log('num : ' + this.pStyle)
            console.log(this.events)
        },
        mounted() {
            console.log("test: " + this.events)
            console.log('Component mounted.')
        }
    }
</script>
