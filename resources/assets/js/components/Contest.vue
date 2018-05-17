<template>
	<form class="w-full" method="POST" enctype="multipart/form-data">
    <div class="py-2">
      <input type="text" :class="classes"
      placeholder="slug" aria-label="slug" v-model="form.slug">
    </div>
    <div class="py-2">
      <input type="text" :class="classes"
      placeholder="Year/Año" aria-label="Year/Año" v-model="form.year">
    </div>
    <div class="py-2">
      <input type="text" class="border-teal" placeholder="Topic" aria-label="Topic" v-model="form.en.topic">
    </div>
    
    <div class="py-2">
      <label for="descripcion">
        Description
      </label>
      <wysiwyg name="desctiption.en" id="descripcion" v-model="form.en.description"></wysiwyg>
    </div>
    <div class="py-2">
      <input  type="text" class="border-teal" placeholder="Tema" aria-label="Tema" v-model="form.es.topic">
    </div>
    <div class="py-2">
      <label  for="description">
        Descripción
      </label>
      <wysiwyg name="desctiption.es" id="description" v-model="form.es.description"></wysiwyg>
    </div>
    <div class="py-2" v-if="!contest"> 
      <label  for="normalCategories">
        Create Normal Categories
      </label>
      <div class="flex">
        <div class="px-2">No</div>
        <switches v-model="form.normalCategories" id="normalCategories" theme="custom" color="blue"></switches>
        <div class="px-2">Yes</div>
      </div>
    </div>
    <div class="py-2">
      <label for="intro_image">Imagen del Concurso</label>
      <image-uploader name="intro_image" class="mr-1" v-model="form.intro_image" :cropperOptions="cropperOptions" @cropped="saveImage"></image-uploader> 
    </div>
    <div class="py-2">
      <label for="intro_image">Imagen del Concurso</label>
      <image-uploader name="intro_image" class="mr-1" v-model="form.intro_image" :cropperOptions="cropperLogoOptions" @cropped="saveLogo"></image-uploader> 
    </div>
    <div class="py-2">
      <button v-if="!contest.id" type="button" @click="createContest">Create</button>
      <button v-if="contest.id" type="button" @click="editContest">Edit</button>
    </div>
  </form>

</template>

<script>

import Switches from "vue-switches";
import ImageUploader from "./ImageUploader.vue";
import ImageUpload from "./ImageUpload.vue";

export default {
  props: {
    contest: {
      type: Object,
      default() {
        return {
          description: "",
          intro_image: "",
          slug: "",
          topic: "",
          id: "",
          translations: [
          {
            description: "",
            seo_message: "",
            topic: ""
          },
          {
            description: "",
            seo_message: "",
            topic: ""
          }
          ],
          year: ""
        };
      }
    }
  },
  components: {
    Switches,
    ImageUploader,
    ImageUpload
  },
  data() {
    return {
      method:'',
      form: {
        id: _.clone(this.contest.id),
        slug: _.clone(this.contest.slug),
        en: {
          topic: _.clone(this.contest.translations[1].topic),
          description: _.clone(this.contest.translations[1].description)
        },
        es: {
          topic: _.clone(this.contest.translations[0].topic),
          description: _.clone(this.contest.translations[0].description)
        },
        year: _.clone(this.contest.year),
        intro_image: _.clone(this.contest.introimg),
        logo_image: _.clone(this.contest.logoImage),
        file: _.clone(this.contest.intro_image_file),
        normalCategories: true
      },
      cropperOptions: {

      },
      cropperLogoOptions:{
        aspectRatio: 16/9,
        movable: false,
        zoomOnWheel: false
      }
    };
  },
  created(){
    this.method=(this.contest===null)?'POST':'PUT';
  },
  methods: {
    resetForm() {
      this.form.en.topic = "";
      this.form.en.description = "";
      this.form.es.topic = "";
      this.form.es.description = "";
      this.form.year = "";
      this.form.error = false;
    },
    createContest() {
      axios({
        method: this.method,
        url: '/contests',
        data: this.form
      })
      .catch(error => {
        flash(error.response.data.message, "warning");
      })
      .then(({ data }) => {
        this.resetForm();
        flash("El concurso fue creado exitosamente", "success");
      });
    },
    editContest() {
      axios
      .put(`/contests/${this.contest.slug}`, this.form)
      .then(({ data }) => {
        console.log(data);
        flash("El concurso fue editado exitosamente", "success");
      })
      .catch(error => {
        flash(error.response.data.message, "warning");
      });
      
    },
    saveImage(imagen) {
      this.form.intro_image = imagen.data;
    },
    saveLogo(imagen) {
      this.form.logo = imagen.data;
    }
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
  }
};
</script>