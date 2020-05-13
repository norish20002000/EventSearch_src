<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="event in events.data" :key="event.id">
                    <div class="card-header">{{event.summary}}</div>
                    <div class="card-body">
                        <div class="icon fl">
                            <a :href="'/eventdetail/' + event.id">
                                <img class="thumb_img" :src="event.thumb_url"/>
                            </a>
                        </div>
                            <a :href="'/eventdetail/' + event.id">
                        <div class="fl">
                            <div>{{event.title | truncate(30, '...')}}</div>
                            <div>{{event.st_date}}</div>
                            <div>{{event.end_date}}</div>
                            <div>{{event.detail | truncate(50, '...')}}</div>
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
            }
        },
        filters: {
            truncate: function(value, length, omission) {
                var length = length ? parseInt(length, 10) : 20;
                var ommision = omission ? omission.toString() : '...';

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
