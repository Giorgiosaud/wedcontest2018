<template>
	<div class="container py-4">
		<div class="row">
			<div class="container">
				<div class="col">
					<h2>{{ translations.en.title }} / {{ translations.es.title }} <span class="badge badge-pill badge-primary">{{ state }}</span></h2>

				</div>
			</div>
		</div>
		<!--div class="row">
			<div class="container">
				<div class="col">
					<div class="py-2">
						<label for="artwork">{{$t('lang.artWork')}}</label>
						<image-uploader name="artwork" class="mr-1" v-model="artwork.url" :cropperOptions="cropperOptions"></image-uploader> 
						<transition name="zoom" enter-active-class="zoomIn" leave-active-class="zoomOut">
							<div class="text-red" v-if="artwork.url===''">{{$t('lang.required')}}</div>
						</transition>
					</div>
				</div>
			</div>
		</div-->
		<div class="row">
			<div class="col col-md-4">
				<h3>Inglés</h3>
				<div class="form-group">
					<label for="name">{{ $t("lang.artWorkTitle")}}</label>
					<input 
					type="text" 
					class="form-control" 
					:class="{'is-invalid':errors&&errors.title}"
					id="title" 
					autocomplete="title" 
					aria-describedby="title"
					v-model="translations.en.title"
					ref="title"
					required >
					<transition name="zoom" enter-active-class="zoomIn" leave-active-class="zoomOut">
						<div class="text-red" v-if="artwork.title===''">{{$t('lang.required')}}</div>
					</transition>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<wysiwyg name="explenation" id="explenation" ref="explenation" v-model="translations.en.description" required>
					</wysiwyg>
					<transition name="zoom" enter-active-class="zoomIn" leave-active-class="zoomOut">
						<div class="text-red" v-if="artwork.description===''">{{$t('lang.required')}}</div>
					</transition>
				</div>
			</div>
			<div class="col col-md-4">
				<h3>Español</h3>
				<div class="form-group">
					<label for="name">{{ $t("lang.artWorkTitle")}}</label>
					<input 
					type="text" 
					class="form-control" 
					:class="{'is-invalid':errors&&errors.title}"
					id="title" 
					autocomplete="title" 
					aria-describedby="title"
					v-model="translations.es.title"
					ref="title"
					required >
					<transition name="zoom" enter-active-class="zoomIn" leave-active-class="zoomOut">
						<div class="text-red" v-if="artwork.title===''">{{$t('lang.required')}}</div>
					</transition>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<wysiwyg name="explenation" id="explenation" ref="explenation" v-model="translations.es.description" required>
					</wysiwyg>
					<transition name="zoom" enter-active-class="zoomIn" leave-active-class="zoomOut">
						<div class="text-red" v-if="artwork.description===''">{{$t('lang.required')}}</div>
					</transition>
				</div>
			</div>
			<div class="col col-md-4">
				<img :src="'/storage/'+artwork.url"  class="img-fluid" :alt="artwork.title">
				<!--div class="py-2">
					<label for="artwork">{{$t('lang.artWork')}}</label>
					<image-uploader name="artwork" class="mr-1" v-model="artwork.url" :cropperOptions="cropperOptions"></image-uploader> 
					<transition name="zoom" enter-active-class="zoomIn" leave-active-class="zoomOut">
						<div class="text-red" v-if="artwork.url===''">{{$t('lang.required')}}</div>
					</transition>
				</div-->
			</div>
		</div>
		<div class="row">
			<div class="container">
				<button type="button" class="btn btn-wedcontest" @click="saveTranslation">Guardar Traduccion</button>	
			</div>
		</div>
	</div>
</template>

<script>
import ImageUploader from "./ImageUploader.vue";
export default {

	name: 'Translation',
	components:{
		ImageUploader
	},
	props:['artwork'],
	data () {
		return {
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
			state:'',
			errors:{},
			translations:{
				en:{
					title:'',
					description:''
				},
				es:{
					title:'',
					description:''
				}
			}
		}
	},
	methods:{
		translate(model, element){
			if(this.contest){
				return model.translations.find(translation=>translation.locale===App.locale)[element];
			}
		},
		saveTranslation(){
			axios.put('/admin/translate/'+this.artwork.id,this.translations)
			.then((response)=>{
				console.log("saving translation");
				this.state='translated';
			});
		}
	},
	created(){
		this.translations.en.title=this.artwork.translations.find(translation=>translation.locale==='en').title;
		this.translations.es.title=this.artwork.translations.find(translation=>translation.locale==='es').title;
		this.translations.en.description=this.artwork.translations.find(translation=>translation.locale==='en').description;
		this.translations.es.description=this.artwork.translations.find(translation=>translation.locale==='es').description;
		this.state=this.artwork.state;

	}
}
</script>

<style lang="css" scoped>
</style>