<template>
  <div>
    <div>
      <label class="label" data-toggle="tooltip" title="Change your avatar">
        <img class="img-fluid" :src="'/'+src" v-if="value">
        <div v-else>
          <p class="border-dashed border-light text-muted p-3">{{$t('lang.dropImage')}}</p>
        </div>
        <input type="file" class="sr-only" ref="imageFile" id="input" name="image" accept="image/*" @change="onChange" >
      </label>
    </div>
    <div>
      <button type="button" class="btn btn-wedcontest" v-if="src" @click="editImage" >{{$t('lang.editOrRotate')}}</button>
      <button type="button" class="btn btn-wedcontest" @click="$refs.imageFile.click()" >{{$t('lang.uploadImage')}}</button>
    </div>
  </label>
  <div
  class="modal fade"
  :id="name"
  tabindex="-1"
  role="dialog"
  :aria-labelledby="name"
  aria-hidden="true"
  @show.bs.modal="createCropper"
  @hide.bs.modal  ="destroyCropper"
  data-backdrop="static" 
  data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop The Uploaded Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <img id="image" ref="imagen" :src="src">
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group">
          <button type="button" class="btn btn-primary" @click.prevent="cropper.setDragMode('move')" data-option="move" title="Move">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.setDragMode('move')">
              <span class="fa fa-arrows-alt"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" @click.prevent="cropper.setDragMode('crop')" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.setDragMode('crop')">
              <span class="fa fa-crop"></span>
            </span>
          </button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" @click.prevent="cropper.zoom(0.1)" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.zoomIn">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" @click.prevent="cropper.zoom(-0.1)" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.zoom(-0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" @click.prevent="cropper.move(-10, 0)" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.move(-10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" @click.prevent="cropper.move(10, 0)" title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.move(10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" @click.prevent="cropper.move(0, -10)" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.move(0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" @click.prevent="cropper.move(0, 10)" title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.move(0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
          </button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" @click.prevent="cropper.rotate(-45)"  title="Rotate Left">
            <feather type="rotate-ccw" data-toggle="tooltip"  data-original-title="cropper.rotate(45)"></feather>
          </button>
          <button type="button" class="btn btn-primary"  @click.prevent="cropper.rotate(45)" title="Rotate Right">
            <feather type="rotate-cw" data-toggle="tooltip"  data-original-title="cropper.rotate(45)"></feather>
            </span>
          </button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" @click.prevent="cropper.scaleX(-1)" title="Flip Horizontal">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.scaleX(-1)">
              <span class="fa fa-arrows-alt-h"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" @click.prevent="cropper.scaleY(-1)" title="Flip Vertical">
            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.scaleY(-1)">
              <span class="fa fa-arrows-alt-v"></span>
            </span>
          </button>
        </div>
        
        <button type="button" class="btn btn-primary" @click="endEdition"><feather type="check"></feather></button>
      </div>
    </div>
  </div>
</div>
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
    name: {
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
      src: this.value,
      editing: false,
      file: "",
      croppedImage: "",
      cropper: "",
      cropperOptionsMerged: Object.assign(
      {
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
      $('#'+this.name).modal('show');

      // this.$modal.show(this.name);
    },
    editImage() {
      $('#'+this.name).modal('show');
      // this.$modal.show(this.name);
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
            that.src = data.data;
            // that.$emit("cropped", data);
            that.$emit("input", that.src);
            flash("Imagen Guardada Temporalmente", "success");
          });
        },
        "image/jpeg",
        0.75
        );
      $('#'+this.name).modal('hide');
      // this.$modal.hide(this.name);
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
  mounted() {
    $('#'+this.name).on("shown.bs.modal",(e)=>this.createCropper())
    $('#'+this.name).on("hidden.bs.modal",(e)=>this.destroyCropper())
  }
};
</script>
<style lang="scss">
.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  max-width: 100%;  
  padding: 0;
}

.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
i.feather{
  height: 15px;
}
</style>