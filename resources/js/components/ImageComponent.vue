<template>
    <div>
        <figure>
            <a href=""></a>
            <img :src="data.image" width="200px">
        </figure>
        <input type="file" name="event_image" ref="file" @change="setImage">
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
                console.log(fileImg)
                if (fileImg.type.startsWith("image/")) {
                    this.imgStr = ""
                    this.data.image = window.URL.createObjectURL(fileImg);
                    this.data.name = fileImg.name;
                    this.data.type = fileImg.type;
                }
            },
        },
        mounted() {
            // console.log("eventId : ")
            // console.log(this.eventData)
            // console.log('Component mounted.')
        }
    }
</script>
