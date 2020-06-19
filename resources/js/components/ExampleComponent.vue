<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-xs-12" v-for="event in events.data" :key="event.id">
                <div class="card my_card">
                    <!-- <div class="card-header">
                        {{event.id}}
                    </div> -->
                    <div class="card-body my_card_body">
                        <div>
                            <span v-if="event.left_timer != ''" class="genre_icon">{{event.left_timer}}</span>
                            <!-- <span class="genre_icon">{{diffTime(event.current_date, event.st_time)}}</span> -->
                            <!-- <span v-if="event.genre.length > 0" class="genre_icon"><i class="far fa-flag" style="margin: 0 3px 0 0"></i>{{event.genre[0].disp_name}}</span> -->
                            <!-- <div v-if="event.genre.length > 0"> -->
                                <!-- <div style="position:absolute; top:300px; left:15px">
                                <span v-for="list in 3" :key="list" class="genre_icon2"><i class="far fa-flag" style="margin: 0 3px 0 0"></i>{{event.genre01[list].disp_name}}</span>
                                </div> -->
                            <!-- </div> -->
                        </div>
                        <div class="icon fl">
                            <a :href="'/eventdetail/' + event.id">
                                <img v-if="event.image_url" class="thumb_img" :src="event.image_url"/>
                                <img v-else class="thumb_img" src="/image/view/noimage.jpg" />
                            </a>
                        </div>
                        <a class="link_color" :href="'/eventdetail/' + event.id">
                            <div class="fl event_str">
                                <div class="event_title">{{event.title | truncate(35, '...')}}</div>
                                <div class="days">
                                    <div class="awe_calendar">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <!-- <div v-for="date in event.date" :key="date.id"> -->
                                            <div v-if="event.date.length > 1">{{event.min_date}}（{{getWeekStr(event.min_date)}}）〜{{event.max_date}}（{{getWeekStr(event.max_date)}}） {{event.st_time | truncate(5, ' ')}}
                                            </div>
                                            <div v-else>{{event.min_date}}（{{getWeekStr(event.min_date)}}）{{event.st_time | truncate(5, ' ')}}</div>
                                            <!-- <div>{{event.date[0].event_date}} ({{getWeekStr(event.date[0].event_date)}}) {{event.st_time | truncate(5, ' ')}}</div> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <!-- <div>{{event.introduction | truncate(40, '...')}}</div> -->
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
                testCnt: 0,
                week_str:"",
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
            getWeekStr(date) {
                var dayOfWeek = new Date(date).getDay()
                var weekStr = [ "日", "月", "火", "水", "木", "金", "土" ][dayOfWeek]
                
                return weekStr
            },
            diffTime(date, time) {
                console.log(new Date('Y-m-d'))
                let nowTime = new Date()
                let stTime = new Date(date + 'T' + time)
                let diff = stTime.getTime() - nowTime.getTime()

                // date
                let diffDay = diff / (1000 * 60 * 60 * 24)
                console.log(Math.floor(diffDay))
                //HH
                let diffHour = (diffDay - Math.floor(diffDay)) * 24
                // console.log(diffHour)
                //MM
                let diffMinute = (diffHour - Math.floor(diffHour)) * 60
                //SS
                let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60

                // console.log(Math.floor(diffDay) + ':' + ('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2))

                return Math.floor(diffDay) + ':' + ('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2)
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
            // console.log('num : ' + this.leftNum)
            // console.log('beforeCreate: ' + this.events)
        },
        created () {
            // console.log('num : ' + this.pStyle)
            console.log(this.events)
        },
        mounted() {
            // console.log("test: " + new Date('2020-06-04'))
            console.log('Component mounted.')
        }
    }
</script>
