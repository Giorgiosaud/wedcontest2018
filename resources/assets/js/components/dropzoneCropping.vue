<template>
<div>
    <vue-dropzone 
    ref="myVueDropzone" 
    id=":id" 
    :options="options" 
    @vdropzone-thumbnail="showCrop" @vdropzone-success="success"
    ></vue-dropzone>

    <modal name="imageCrop" ref="cropperModal" height="auto" >
        <h1>Image Crop</h1>

        <div class="image-container" ref="imageCropped"></div>
        <button type="button" @click="uploadOnCrop">Crop</button>
    </modal>
    
    
</div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import Cropper from "cropperjs";
import "vue2-dropzone/dist/vue2Dropzone.css";
import "cropper/dist/cropper.css";

export default {
  props: {
    id: {
      type: String,
      required: true
    },
    options: {
      type: Object,
      required: true
    }
  },
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      cachedFilename: "",
      cropper: {},
      cropperOptions: {
        aspectRatio: 16 / 9,
        movable: false
      }
    };
  },
  methods: {
    dataURItoBlob(dataURI) {
      var byteString = atob(dataURI.split(",")[1]);
      var ab = new ArrayBuffer(byteString.length);
      var ia = new Uint8Array(ab);
      for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
      }
      return new Blob([ab], { type: "image/jpeg" });
    },
    showCrop(file, dataUrl) {
      console.info("Try Cropping");
      if (file.croppped) return;
      if (file.width < 800) return;
      // cache filename to re-assign it to cropped file
      this.cachedFilename = file.name;

      // remove not cropped file from dropzone (we will replace it later)
      this.$refs.myVueDropzone.removeFile(file);

      // dynamically create modals to allow multiple files processing
      // var $cropperModal = $(modalTemplate);
      // 'Crop and Upload' button in a modal
      // var $uploadCrop = $cropperModal.find('.crop-upload');
      //create img wrapper
      var $img = $("<img />");

      // initialize FileReader which reads uploaded file

      var reader = new FileReader();
      reader.onloadend = () => {
        console.info("reading file");
        // add uploaded and read image to modal
        $(this.$refs.cropperModal.$el)
          .find(".image-container")
          .html($img);
        $img.attr("src", reader.result);
        $img.attr("id", "toCrop");
        var image = document.getElementById("toCrop");
        this.cropper = new Cropper(image, this.cropperOptions);
      };
      // reader.onloadend = function () {

      // };
      this.$modal.show("imageCrop");
      // read uploaded file (triggers code above)
      reader.readAsDataURL(file);
    },
    uploadOnCrop() {
      // get cropped image data
      // var $img=$('.image-container').find('img')
      // console.log($img);
      var blob = this.cropper.getCroppedCanvas().toDataURL("image/jpeg");
      // transform it to Blob object
      var newFile = this.dataURItoBlob(blob);
      // set 'cropped to true' (so that we don't get to that listener again)
      newFile.cropped = true;
      // assign original filename
      newFile.name = this.cachedFilename;

      // add cropped file to dropzone
      this.$refs.myVueDropzone.addFile(newFile);
      // upload cropped file with dropzone
      this.$refs.myVueDropzone.processQueue();
      this.$modal.hide("imageCrop");
    },
    success(file, response) {
      console.log(file);
      console.log(response);
      this.$emit("input", file);
    }
  }
};
</script>