<template>
    <div>
        <div class="box" ref="box">
            <div class="box__input">
            <input class="box__file" type="file" name="file" accept="image/*" @change="onChange">
                <label for="file">
                    <strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.
                </label>
            </div>
        </div>
        <img :src="img_src" ref="imagen" alt="">
        <button v-if="!editing" type="button" @click="createCropper">Edit Image</button>
        <button v-if="editing" type="button" @click="croppImage">Finish Image Crop</button>
    </div>
</template>
<style>

</style>
<script>
import Cropper from "cropperjs";
import "cropper/dist/cropper.css";
export default {
  props: {
    value: {
      type: String,
      default: ""
    },
    cropperOptions: {
      type: Object,
      default: function() {
        return {};
      }
    },
    croppedCanvasOptions: {
      type: Object,
      default: function() {
        return {};
      }
    }
  },

  data() {
    return {
      img_src: _.clone(this.value),
      editing: false,
      croppedImage: "",
      cropper: "",
      cropperOptionsMerged: Object.assign(
        {
          aspectRatio: 16 / 9,
          movable: false,
          zoomOnWheel: false,
          minContainerWidth: 800,
          minCropBoxWidth: 800,

          crop: function(event) {
            console.log(event);
            console.log(event.detail.x);
            console.log(event.detail.y);
            console.log(event.detail.width);
            console.log(event.detail.height);
            console.log(event.detail.rotate);
            console.log(event.detail.scaleX);
            console.log(event.detail.scaleY);
          }
        },
        _.clone(this.cropperOptions)
      ),
      croppedCanvasOptionsMerged: Object.assign(
        {
          minWidth: 800
        },
        _.clone(this.croppedCanvasOptions)
      )
    };
  },
  methods: {
    createCropper() {
      this.editing = true;
      this.cropper = new Cropper(this.$refs.imagen, this.cropperOptionsMerged);
    },
    croppImage() {
      this.editing = false;
      this.croppedImage = this.cropper
        .getCroppedCanvas(this.croppedCanvasOptionsMerged)
        .toDataURL("image/jepg");
      this.cropper.destroy();
      this.img_src = this.croppedImage;
      this.$emit("input", this.img_src);
      console.log("cropp");
    },
    onChange(e) {
      if (!e.target.files.length) return;
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.img_src = e.target.result;
        this.croppImage();
      };
    },
    isAdvancedUpload() {
      var div = document.createElement("div");
      return (
        ("draggable" in div || ("ondragstart" in div && "ondrop" in div)) &&
        "FormData" in window &&
        "FileReader" in window
      );
    }
  },
  mounted() {
    if (this.isAdvancedUpload) {
      var droppedFiles = false;
      document.addEventListener(
        this.$refs.box,
        "drag dragstart dragend dragover dragenter dragleave drop"
      );
      this.$refs.box.classList.add("has-advanced-upload");
    }
  }
};
</script>
