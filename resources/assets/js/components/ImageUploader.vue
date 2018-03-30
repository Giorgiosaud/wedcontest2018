<template>
    <div>
      <label class="label" data-toggle="tooltip" title="Change your avatar">
        <img class="rounded" id="avatar" :src="src" alt="avatar">
        <input type="file" class="sr-only" id="input" name="image" accept="image/*" @change="onChange" >
      </label>
        <!-- <div class="box" ref="box"> -->
            <!-- <div class="box__input"> -->
            <!-- <input class="box__file" type="file" name="file" accept="image/*" @change="onChange"> -->
                <!-- <label for="file"> -->
                    <!-- <strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>. -->
                <!-- </label> -->
            <!-- </div> -->
        <!-- </div> -->
        <!-- <div> -->
          <!-- <img :src="img_src" ref="imagen" alt=""> -->
        <!-- </div> -->
        <!-- <button v-if="!editing" type="button" @click="createCropper">Edit Image</button> -->
        <!-- <button v-if="editing" type="button" @click="croppImage">Finish Image Crop</button> -->
        <modal name="cropperModal" width="80%" :clickToClose="false" :adaptive="true" :resizable="true" height="auto" @opened="createCropper" @closed="destroyCropper">
          <div class="header">
          <h2>Crop The Uploaded Image</h2> 
          </div>
          <div class="body">
              <img id="image" ref="imagen" :src="src">
          </div>
          <div class="footer flex justify-between">
            <div class="edition">
              <button type="button" @click="rotateRight"><feather type="rotate-cw" animation="spin" animation-speed="fast"></feather></button>
              <button type="button" @click="rotateRightSlow"><feather type="rotate-cw" animation="spin" animation-speed="slow"></feather></button>
              <button type="button" @click="rotateLeft"><feather type="rotate-ccw" animation="unspin" animation-speed="fast"></feather></button>
              <button type="button" @click="rotateLeftSlow"><feather type="rotate-ccw" animation="unspin" animation-speed="slow"></feather></button>
            </div>
            <div class="finish">
              <button type="button" @click="endEdition"><feather type="check"></feather></button>
            </div>
          </div>
        </modal>
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
      src: _.clone(this.value),
      editing: false,
      croppedImage: "",
      cropper: "",
      cropperOptionsMerged: Object.assign(
        {
          aspectRatio: 16 / 9,
          movable: false,
          zoomOnWheel: false,
          minContainerWidth: 800,
          minCropBoxWidth: 800
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
    onChange(e) {
      if (!e.target.files.length) return;

      let file = e.target.files[0];
      let that = this;
      if (URL) {
        this.src = URL.createObjectURL(file);
      } else {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = e => {
          this.src = e.target.result;
        };
      }
      this.$modal.show("cropperModal");
    },
    createCropper() {
      this.editing = true;
      this.cropper = new Cropper(this.$refs.imagen, this.cropperOptionsMerged);
    },
    destroyCropper() {
      this.editing = false;
      this.cropper.destroy();
      this.cropper = null;
    },
    endEdition() {
      this.croppedImage = this.cropper
        .getCroppedCanvas(this.croppedCanvasOptionsMerged)
        .toDataURL();
      let src = this.src;
      let file = this.croppedImage;
      this.$emit("cropped", { src, file });
      this.$modal.hide("cropperModal");
    },
    rotateRight() {
      this.cropper.rotate(90);
    },
    rotateRightSlow() {
      this.cropper.rotate(5);
    },
    rotateLeft() {
      this.cropper.rotate(-90);
    },
    rotateLeftSlow() {
      this.cropper.rotate(-5);
    }
  },
  mounted() {}
};
</script>
