<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>accordion vue</p>
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
