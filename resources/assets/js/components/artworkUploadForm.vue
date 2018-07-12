<template>
	<div class="container py-4">
		<h1 class="pb-4">{{$t("lang.artworkSubmition")}}</h1>
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
			<wysiwyg name="explenation" id="explenation" ref="explenation" v-model="form.explenation" placeholder="" required></wysiwyg>
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
	<div class="py-2">
		<div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="tems" v-model="terms">
			<label class="form-check-label" for="tems" v-html="$t('lang.terms')">
			</label>
		</div>
	</div>

</div>
<div class="py-2">
	<button type="button" class="btn btn-wedcontest" @click.prevent="createArtwork">{{$t('lang.revisar')}}</button>
</div>
</form>
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" v-html="$t('lang.termsTitle')"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"  v-html="$t('lang.termsConditions')">
			</div>
		</div>
	</div>
</div>
</div>
</template>

<script>
import ImageUploader from "./ImageUploader.vue";
export default {

	name: 'artworkEditForm',
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
			terms:'',
			errors:{},
			cropperOptions: {
				minWidth:800,
				minHeight:800,
				// aspectRatio: 16 / 9,
				autoCropArea:2,
				movable: true,
				zoomOnWheel: true,
				viewMode:0,
				dragMode:'move',
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
				window.location.href = response.request.responseURL;
			});
		}
	}

}
</script>

<style lang="scss" scoped>
@media (min-width: 576px)
{
	.modal-dialog {
    	max-width: 800px;
    	margin: 1.75rem auto;
	}
}
.text-red{
	color:red;
}
</style>