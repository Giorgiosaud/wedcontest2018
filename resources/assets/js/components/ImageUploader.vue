<template>
  <div>
    <div>
      <label class="label" data-toggle="tooltip" title="Change your avatar">
        <img class="rounded" id="avatar" :src="src" alt="avatar">
        <input type="file" class="sr-only" ref="input" id="input" name="image" accept="image/*" @change="onChange" >
      </label>
    </div>
    <div>
      <button type="button" @click="editImage" >Edit Rotate or Crop Image</button>
      <button type="button" @click="$refs.input.click()" >Upload another Image</button>
    </div>
  </label>
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
        <button type="button" @click="resetRotation"><feather type="repeat"></feather></button>
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
      file: "",
      croppedImage: "",
      cropper: "",
      cropperOptionsMerged: Object.assign(
      {
        aspectRatio: 16 / 9,
        movable: false,
        zoomOnWheel: false
          // minContainerWidth: 800,
          // minCropBoxWidth: 800
        },
        _.clone(this.cropperOptions)
        ),
      croppedCanvasOptionsMerged: Object.assign(
      {
        fillColor: "#fff"
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
    editImage() {
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
    b64ToUint8Array(b64Image) {
      var img = atob(b64Image.split(",")[1]);
      var img_buffer = [];
      var i = 0;
      while (i < img.length) {
        img_buffer.push(img.charCodeAt(i));
        i++;
      }

      return new Uint8Array(img_buffer);
    },
    endEdition() {
      let that = this;
      let b64Image = this.cropper
      .getCroppedCanvas(this.croppedCanvasOptionsMerged)
      .toBlob(
        function(file) {
          that.file = file;
          var formData = new FormData();
          formData.append("image", that.file);
          axios
          .post("/images/upload", formData)
          .catch(e => flash(e.response.data.message, "warning"))
          .then(({ data }) => {
            console.log(data.data);
            that.src = "/" + data.data;
            that.$emit("cropped", data);
            flash("Imagen Guardada Temporalmente", "success");
          });
        },
        "image/jpeg",
        0.75
        );
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
    },
    resetRotation() {
      this.cropper.rotateTo(0);
    }
  },
  mounted() {}
};
</script>
