<template>
	<form class="w-full max-w-sm">
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
    <div class="py-2">
      <button type="button" @click="createContest">Create</button>
    </div>
  </form>

</template>

<script>
export default {
	props: ['contest'],

	data() {
		return {
      form:{
        en:{
          topic:'',
          description:''
        },
        es:{
          topic:'',
          description:''
        },
        year:''
      }
    }
  },
  methods:{
    resetForm(){
      this.form.en.topic='';
      this.form.en.description='';
      this.form.es.topic='';
      this.form.es.description='';
      this.form.year='';
      this.form.error=false;
    },
    createContest(){
      axios.post('/contests',this.form)
      .catch(error => {
        flash(error.response.data.message, "warning");
      })
      .then(({data})=>{
        this.resetForm();
        flash("El concurso fue creado exitosamente", "success");
      })

    }
  },
  computed:{
    classes(){
      let defaults = ['border-teal', 'text-white'];
      if (this.level === 'success') defaults.push('bg-green', 'border-green-dark');
      if (this.level === 'warning') defaults.push('bg-orange', 'border-yellow-dark');
      if (this.level === 'danger') defaults.push('bg-red', 'border-red-dark');

      return defaults;
    }
  }

}
</script>