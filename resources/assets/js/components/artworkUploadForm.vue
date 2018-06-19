<template>
	<div class="container py-4">
		<h1 class="pb-4">{{$t("lang.registerContestants")}}</h1>
		<form class="" id="valid" @submit.prevent="register">
			<div class="form-group">
				<label for="name">{{ $t("lang.artWorkTitle")}}</label>
				<input 
				type="text" 
				class="form-control" 
				:class="{'is-invalid':errors&&errors.title}"
				id="title" 
				autocomplete="title" 
				aria-describedby="title"
				v-model="form.title"
				@keydown="errors.title = false"
				ref="title"
				required >
				<div v-if="errors.title" v-text="errors.title[0]" class="invalid-feedback">
				</div>
				<transition
				name="zoom"
				enter-active-class="zoomIn"
				leave-active-class="zoomOut"
				>
				<div class="text-red" v-if="form.title===''">{{$t('lang.required')}}</div>
			</transition>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<wysiwyg name="explenation" id="explenation" ref="explenation" v-model="form.explenation" required></wysiwyg>
			<transition
			name="zoom"
			enter-active-class="zoomIn"
			leave-active-class="zoomOut"
			>
			<div class="text-red" v-if="form.explenation===''">{{$t('lang.required')}}</div>
		</transition>


	</div>
	<div class="py-2">
		<label for="artwork">{{$t('lang.artWork')}}</label>
		<image-uploader name="artwork" class="mr-1" v-model="form.url" :cropperOptions="cropperOptions"></image-uploader> 
		<transition
		name="zoom"
		enter-active-class="zoomIn"
		leave-active-class="zoomOut"
		>
		<div class="text-red" v-if="form.url===''">{{$t('lang.required')}}</div>
	</transition>


</div>
<div class="py-2">
	<button type="button" class="btn btn-wedcontest" @click.prevent="createArtwork">{{$t('lang.revisar')}}</button>
</div>
</form>
</div>
</template>

<script>
import ImageUploader from "./ImageUploader.vue";
export default {

	name: 'artworkUploadForm',
	components:{
		ImageUploader
	},
	props:['contestant'],
	data () {
		return {
			form:{
				title:'',
				explenation:'',
				url:''
			},
			errors:{},
			cropperOptions: {
				autoCropArea:1,
				movable: true,
				zoomOnWheel: true,
				viewMode:1
			},
		}
	},
	methods:{
		createArtwork(){
			if(this.form.title===''){
				this.$refs.title.focus();
				return 
			}
			if(this.form.explenation===''){
				this.$refs.explenation.$refs.trix.focus();
				return 
			}
			axios.post(this.contestant.uploadPath,this.form)
			.then(response=>{
				console.log(response)
				// window.location.href = response.request.responseURL;
			});
		}
	}

}
</script>

<style lang="scss" scoped>
.text-red{
	color:red;
}
</style>