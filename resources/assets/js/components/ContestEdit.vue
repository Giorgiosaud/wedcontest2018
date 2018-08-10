<template>
  <div>
    <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-secondary" :class="{active:language==='en'}" @click="language='en'">English</button>
      <button type="button" class="btn btn-secondary" :class="{active:language==='es'}" @click="language='es'">Español</button>
    </div>
    <div v-if="language==='en'">
      <div class="form-group">
        <label for="topic">Topic</label>
        <input type="text"
        id="topic"
        class="form-control"
        placeholder="Topic"
        aria-label="Topic"
        v-model="contest.translations[0].topic">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <wysiwyg name="desctiption.en" id="descripcion" v-model="contest.translations[0].description"></wysiwyg>
      </div>
      <div class="py-2">
        <label for="logo_image">Contest Logo</label>
        <image-uploader name="logo_image" class="mr-1" v-model="contest.translations[0].logo_image" :cropperOptions="cropperLogoOptions"></image-uploader> 
      </div>

    </div>
    
    <div v-if="language==='es'">

      <div class="form-group">
        <label for="tema">Tema</label>
        <input type="text"
        id="tema"
        class="form-control"
        placeholder="Tema"
        aria-label="Tema"
        v-model="contest.translations[1].topic">
      </div>
      <div class="form-group">
        <label for="description">Descripción</label>
        <wysiwyg name="desctiption.en" id="descripcion" v-model="contest.translations[1].description"></wysiwyg>
      </div>
      <div class="py-2">
        <label for="logo_imagen">Logo del Concurso</label>
        <image-uploader name="logo_imagen" class="mr-1" v-model="contest.translations[1].logo_image" :cropperOptions="cropperLogoOptions"></image-uploader> 
      </div>

    </div>
    <div class="form-group">
      <label for="slug">Slug</label>
      <input type="text"
      id="slug"
      class="form-control"
      placeholder="slug"
      aria-label="slug"
      v-model="contest.slug">
      <small
      id="slugHelpInline"
      class="text-muted">
      Must be in lowercase and not spaces between words ex(hello-world)
    </small>
  </div>
  <div class="form-group">
    <label for="slug">Year/Año</label>
    <input type="text"
    id="year"
    class="form-control"
    placeholder="Year/Año"
    aria-label="Year/Año"
    v-model="contest.year">
  </div>

  <div class="py-2"> 
    <label  for="normalCategories">
      Create Normal Categories
    </label>
    <div class="d-flex">
      <div class="px-2">No</div>
      <switches v-model="contest.normalCategories" id="normalCategories" theme="bootstrap" color="blue"></switches>
      <div class="px-2">Yes</div>
    </div>
  </div>
  
  <div class="form-group">
    <label for="background_image">Imagen de Fondo del Concurso</label>
    <image-uploader 
    name="background_image" 
    class="mr-1" 
    v-model="contest.background_image" 
    :cropperOptions="cropperOptions" 
    ></image-uploader>
  </div>
  <div class="py-2">
    <button type="button" class="btn btn-wedcontest" @click="editContest">Edit</button>
  </div>
</div>
</template>

<script>

import Switches from "vue-switches";
import ImageUploader from "./ImageUploader.vue";
import ImageUpload from "./ImageUpload.vue";

export default {
  props: ["contest"],
  components: {
    Switches,
    ImageUploader,
    ImageUpload
  },
  data() {
    return {
      language:'en',
      method:'',
      form: {
        slug: '',
        en: {
          topic: '',
          description: '',
          logo_image: '',
        },
        es: {
          topic: '',
          description: '',
          logo_image: '',
        },
        year: '',
        background_image: '',
        normalCategories: true
      },
      cropperOptions: {
        viewMode:1,
        autoCropArea:1,
        movable: false,
        zoomOnWheel: false
      },
      cropperLogoOptions:{
        // aspectRatio: 16/9,
        autoCropArea:1,
        viewMode:1,
        movable: false,
        zoomOnWheel: false
      }
    };
  },
  methods: {
    editContest() {
      axios.put('/admin/contest/'+this.contest.slug, this.contest)
      .then(({ data }) => {
        flash("El concurso fue editado exitosamente", "success");
      })
      .catch(error => {
        flash(error.response.data.message, "warning");
      })
      
    },
    sanitize: function(title) {
      var slug = "";
      // Change to lower case
      var titleLower = title.toLowerCase();
      // Letter "e"
      slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
      // Letter "a"
      slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
      // Letter "o"
      slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
      // Letter "u"
      slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
      // Letter "d"
      slug = slug.replace(/đ/gi, 'd');
      // Trim the last whitespace
      slug = slug.replace(/\s*$/g, '');
      // Change whitespace to "-"
      slug = slug.replace(/\s+/g, '-');
      
      return slug;
    },
  },
  computed: {
    classes() {
      let defaults = ["border-teal", "text-white"];
      if (this.level === "success")
        defaults.push("bg-green", "border-green-dark");
      if (this.level === "warning")
        defaults.push("bg-orange", "border-yellow-dark");
      if (this.level === "danger") defaults.push("bg-red", "border-red-dark");

      return defaults;
    }
  },

};
</script>

<style lang="scss">
img {
  max-width: 100%;
}
.vue-switcher-theme--bootstrap {
  &.vue-switcher-color--blue {
    div {
      background-color: lighten(blue, 10%);

      &:after {
        // for the circle on the switch
        background-color: darken(blue, 5%);
      }
    }

    &.vue-switcher--unchecked {
      div {
        background-color: lighten(blue, 30%);

        &:after {
          background-color: lighten(blue, 10%);
        }
      }
    }
  }
}
</style>