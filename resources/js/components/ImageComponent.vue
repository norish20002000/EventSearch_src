<template>
    <div>
        <figure>
            <a href=""></a>
            <img :src="data.image" width="200px">
        </figure>
        <input type="file" name="event_image" ref="file" @change="setImage">
        <button type="button" vi-if="data.image" @click="resetImage()">Reset Image</button>
        <input type="hidden" name="image_data" :value="data.image">
        <!-- <input type="hidden" name="image_url" :value="data.image"> -->
    </div>
</template>

<script>
    export default {
        name: "ImageComponent",
        props: {
            eventData: "",
        },
        data() {
            return {
                event: this.eventData,
                data: {
                    image: this.eventData.image_flg ? this.eventData.dir.EVENT_IMAGE_STORAGE + this.eventData.id + '/' + this.eventData.id + '.jpg' : "",
                    name: "",

                },
            }
        },
        methods: {
            setImage(e) {
                const files = this.$refs.file;
                const fileImg = files.files[0];
                if (fileImg.type.startsWith("image/")) {
                    this.imgStr = ""
                    this.data.image = window.URL.createObjectURL(fileImg);
                    this.data.name = fileImg.name;
                    this.data.type = fileImg.type;
                }
            },
            resetImage() {
                const input = this.$refs.file
                input.type = 'text'
                input.type = 'file'
                this.data.image = ''
            },
        },
        mounted() {
            console.log("eventData : ")
            console.log(this.event)
            // console.log('Component mounted.')
        }
    }
</script>
