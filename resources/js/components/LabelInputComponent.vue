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
                    <input :name="'data[' + index + '][' + attribute + ']'" type="text" :value="element.event_date">
                    <input type="hidden" :name="'data[' + index + '][event_date_id]'" :value="element.id">
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
            return {
                attribute: this.attributeName,
                elements: this.eventDate.length != 0 ? this.eventDate : [
                    {
                    'name' : "test",
                    },
                ],
            }
        },
        methods: {
            append: function() {
                this.elements.push({
                    name: $('.label_input').val(),
                })
            }
        },
        mounted() {
            // console.log("eventId : " + this.eventData[2].id)
            console.log(this.eventDate)
        }
    }
</script>
