<template>
    <div>
        <div>
            <div class="label_input" v-for="(element, index) in elements" :key="element.index">
                <div>
                    <label class="edit_label">
                        <slot name="column_name"></slot>
                    </label>
                </div>
                <div id="app">
                    <!-- <div class="form-group">
                        <div class="input-group date datetimepicker" :id="'due_date' + index" data-target-input="nearest">
                        <input type="text" 
                            :name="'date[' + index + '][' + attribute + ']'"
                            :value="element.event_date"
                            id="due_date-field" class="form-control datetimepicker-input" :data-target="'#due_date' + index" />
                        <div class="input-group-append" :data-target="'#due_date' + index" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        </div>
                    </div> -->
                    <vuejs-datepicker 
                        :format="DatePickerFormat"
                        :highlighted ="highlighted"
                        :clear-button = true
                        clear-button-icon = "far fa-trash-alt"
                        input-class="datepic_input"
                        :name="'date[' + index + '][' + attribute + ']'"
                        :value="element.event_date">
                    </vuejs-datepicker>
                    <input type="hidden" :name="'date[' + index + '][id]'" :value="element.id">
                </div>
                <!-- <div>
                    <input :name="'date[' + index + '][' + attribute + ']'" type="text" v-model="element.event_date" placeholder="2020-01-01">
                    <input type="hidden" :name="'date[' + index + '][id]'" :value="element.id"> -->
                    <!-- <p v-if="errors && errors[0][attribute]" erroclass="validation">※{{errors[0][attribute]}}</p> -->
                <!-- </div> -->
            </div>
            <div>
                <button type="button" class="btn btn-dark btn-sm" style="margin: -5px 0 8px 0" v-on:click="append">追加</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExampleComponent",
        props: {
            eventDate: "",
            attributeName: "",
            old: "",
        },
        data() {
            var now =new Date()
            var todayStr = now.getFullYear() + "-" + (now.getMonth()+1) + "-" + now.getDate()
            return {
                attribute: this.attributeName,
                elements: this.eventDate.length != 0 ? this.eventDate : [
                    {
                        event_date: "",
                        // todayStr,
                    },
                ],
                DatePickerFormat: 'yyyy-MM-dd',
                highlighted: {
                    dates: [new Date(),]
                    },
                oldData: this.old,
            }
        },
        components: {
            'vuejs-datepicker':vuejsDatepicker,
        },
        methods: {
            append: function() {
                this.elements.push({
                    event_date: ""
                    // $('.label_input').val()
                })
            }
        },
        mounted() {
            console.log("eventId : ")
            console.log(this.oldData)
            console.log(this.elements)
            // console.log(this.eventDate)
        }
    }
</script>
