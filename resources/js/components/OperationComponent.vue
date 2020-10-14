<template>
    <div class="container">
        <div class="search_area">
            <div>
                <label class="search_lavel">ID</label>
                <input name="search_id" type="text" width="300px" v-model="search_id" @keypress.enter="getDataBySearch()">
            </div>
            <div>
                <label class="search_lavel">タイトル</label>
                <input name="search_title" type="text" style="width: 320px;    " v-model="search_title" @keypress.enter="getDataBySearch()">
            </div>
            <div style="display:flex;">
                <label class="search_lavel">開催日</label>
                <!-- <div class="form-group">
                    <div class="input-group date datetimepicker" id="due_date" data-target-input="nearest">
                      <input type="text" name="st_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" v-model="st_date" />
                      <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                </div>
                〜
                <div class="form-group">
                    <div class="input-group date datetimepicker" id="due_date1" data-target-input="nearest">
                      <input type="text" name="end_date"  id="due_date-field" class="form-control datetimepicker-input" v-model="end_date" />
                      <div class="input-group-append" data-target="#due_date1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                </div> -->
                <vuejs-datepicker style="margin: 0 0 0 4px"
                    :format="DatePickerFormat"
                    :highlighted ="highlighted"
                    :clear-button = true
                    clear-button-icon = "far fa-trash-alt"
                    input-class="datepic_input"
                    name="st_date"
                    v-model="st_date">
                </vuejs-datepicker>
                〜
                <vuejs-datepicker 
                    :format="DatePickerFormat"
                    :highlighted ="highlighted"
                    :clear-button = true
                    clear-button-icon = "far fa-trash-alt"
                    input-class="datepic_input"
                    name="end_date"
                    v-model="end_date">
                </vuejs-datepicker>
            </div>
            <div style="display:flex;">
                <label class="search_lavel">公開日</label>
                <vuejs-datepicker style="margin: 0 0 0 5px"
                    :format="DatePickerFormat"
                    :highlighted ="highlighted"
                    :clear-button = true
                    clear-button-icon = "far fa-trash-alt"
                    input-class="datepic_input"
                    name="release_date_st"
                    v-model="release_date_st">
                </vuejs-datepicker>
                〜
                <vuejs-datepicker 
                    :format="DatePickerFormat"
                    :highlighted ="highlighted"
                    :clear-button = true
                    clear-button-icon = "far fa-trash-alt"
                    input-class="datepic_input"
                    name="release_date_end"
                    v-model="release_date_end">
                </vuejs-datepicker>
            </div>
            <div style="display: flex;">
                <label class="search_lavel"></label>
                <p>
                    <input type="radio" value="0" v-model="openFlg">公開
                    <input type="radio" value="1" v-model="openFlg">非公開
                </p>
            </div>
            <div style="text-align:center;">
                <button class="btn btn-info" type="button" @click="getDataBySearch">検索</button>
                <a href="/eventbank/event/ope">clear</a>
            </div>
        </div>
        <!-- <div class="btn_row">
            <div>
                <button type='button' class="btn btn-outline-primary" @click="getDataOpened">公開data</button>
            </div>
            <div>
                <button type='button' class="btn btn-outline-primary" @click="getDataClosed">非公開data</button>
            </div>
        </div> -->
        <div>
            <h5>{{eventCount}}件</h5>
            <h5>{{eventType}}</h5>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xs-12" v-for="event in events.data" :key="event.id">
                <div class="card">
                    <div class="card-header">{{event.id}}</div>
                    <div class="card-body">
                        <div class="icon fl">
                            <a :href="'/eventbank/event/edit/' + event.id" target="_blank">
                                <img class="thumb_img" :src="event.image_url"/>
                            </a>
                        </div>
                            <a :href="'/eventbank/event/edit/' + event.id" target="_blank">
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
        <div v-if="events.last_page != 1">
            <pagination :data="events" @move-page="movePage"></pagination>
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
                eventCount: this.eventData.data.length,
                search_id: "",
                search_title: "",
                DatePickerFormat: 'yyyy-MM-dd',
                highlighted: {
                    dates: [new Date(),]
                    },
                st_date: "",
                end_date: "",
                release_date_st: "",
                release_date_end: "",
                openFlg: "1",
                page: 1,
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
                    this.eventCount = this.events.data.length
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
                    this.eventCount = this.events.data.length
                }).catch(error => {
                    console.log(error.message)
                })
            },
            getDataBySearch: function() {
                let data = {
                            params:{
                                id:this.search_id,
                                title:this.search_title,
                                st_date:this.st_date,
                                end_date:this.end_date,
                                release_date_st:this.release_date_st,
                                release_date_end:this.release_date_end,
                                open_flg: this.openFlg
                                }
                            }
                data._token = document.getElementsByName('csrf-token')[0].content;
                axios.get("/api/searchdata?page=" + this.page, data).then((result)=>{
                    console.log(result.data)
                    this.events = result.data.event_data ? result.data.event_data : ""

                    this.eventType = ""
                    this.eventCount = this.events.total
                }).catch(error => {
                    console.log(error.message)
                })
            },
            movePage: function(page) {
                this.page = page; // ページ番号を更新
                this.getDataBySearch(); // Ajaxで新データを取得

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
        watch: {
            search_id: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
            search_title: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
            st_date: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
            end_date: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
            release_date_st: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
            release_date_end: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
            openFlg: function(newKeyword, oldKeyword) {
                this.page = 1
                this.debouncedGetAnswer()
            },
        },
        components: {
            'vuejs-datepicker':vuejsDatepicker,
        },
        beforeCreate () {
            console.log('beforeCreate: ' + this.events)
        },
        created () {
            this.debouncedGetAnswer = _.debounce(this.getDataBySearch, 1000)
            console.log('created: ' + this.events)
        },
        mounted() {
            console.log("test: " + this.events)
            console.log('Component mounted.')
        }
    }
</script>
