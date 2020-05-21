<template>
    <div>
        <div>
            <div class="label_input" v-for="(element, index) in elements" :key="element.index">
                <div>
                    <label class="edit_label">
                        <slot name="column_name"></slot>
                    </label>
                </div>
                <div>
                    <input  :name="'date[' + index + '][' + attribute + ']'" type="text" v-model="element.event_date" placeholder="2020-01-01">
                    <input type="hidden" :name="'date[' + index + '][event_date_id]'" :value="element.id">
                    <!-- <p v-if="errors && errors[0][attribute]" erroclass="validation">※{{errors[0][attribute]}}</p> -->
                </div>
            </div>
            <div>
                <button type="button" v-on:click="append">追加</button>
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
        },
        data() {
            // var now =new Date()
            // var todayStr = now.getFullYear() + "-" + (now.getMonth()+1) + "-" + now.getDate()
            return {
                attribute: this.attributeName,
                elements: this.eventDate.length != 0 ? this.eventDate : [
                    {
                        event_date: "",
                        // todayStr,
                    },
                ],
            }
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
            // console.log("eventId : " + this.eventData[2].id)
            console.log(this.eventDate)
        }
    }
</script>
