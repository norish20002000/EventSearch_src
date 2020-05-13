<template>
    <div>
        <button class="p-btn" type="button" @click="accordionToggle()">
            <slot name="title"></slot>
        </button>
        <div v-if="isOpened">
            <slot name="body"></slot>
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
                isOpened: false,
            }
        },
        methods: {
            accordionToggle: function() {
                this.isOpened = !this.isOpened
            },
        },
        mounted() {
            // console.log("eventId : " + this.eventData[2].id)
            // console.log('Component mounted.')
        }
    }
</script>
