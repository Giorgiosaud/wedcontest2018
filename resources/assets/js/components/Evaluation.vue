<template>
	<div>
		<div class="container text-center pt-4">
			<h2 v-if="category.name==='Seeds'" >{{ $t("lang.seedsEvaluation")}}</h2>
			<h2 v-else-if="category.name==='Sprouts'">{{ $t("lang.sproutssEvaluation")}}</h2>
			<h2 v-else-if="category.name==='Thinkers'" >{{ $t("lang.thinkersEvaluation")}}</h2>
			<h2 v-else >{{ $t("lang.gameChangersEvaluation")}}</h2>
		</div>
		<transition-group
		name="fadeLeft"
		tag="div"
		class="container row mx-auto">
		<div
		class="col-6 col-md-4  artwork-container p-2 d-flex align-items-center justify-content-center"
		v-for="artwork in filteredArtworks"
		:key="artwork.id" @click="openDetail(artwork)">
		<div
		class="m-2 artwork border"
		:class="{evaluated:artwork.evaluated}"
		>
		<div class="places" v-if="artwork.byPlace && artwork.place!==0">{{artwork.place}}</div>
		<img :src="'/storage'+artwork.imageLink" :alt="artwork.title" class="img-fluid p-2">
	</div>
</div>
</transition-group>
<transition
name="bounce"
enter-active-class="bounceInLeft"
leave-active-class="bounceOutRight"
>
<div class="detail" v-if="!hiddenDetail">
	<div class="p-4 container">
		<div class="row">
			<div class="container-fluid text-right close-btn">
				<button type="button" class="close"  @click="hiddenDetail=true" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="d-flex align-items-center justify-content-center px-4">
			<div class="move movePrev" @click="selectPrev"><i class="fas fa-chevron-left"></i></div>
			<div class="img-container">
				<img :src="'/storage'+selectedArtwork.imageLink" alt="selectedArtwork.title" class="img-h-fluid">
			</div>
			<div class="move moveNext" @click="selectNext"><i class="fas fa-chevron-right"></i></div>
		</div>
		<div class="container py-4 text-center">
			<h2 class="black-bold" v-html="translate(selectedArtwork,'title')"></h2>
			<h2 v-html="translate(selectedArtwork,'description')"></h2>
		</div>
		<div class="container">
			<div v-if="locale==='es' && (questions.subjectsEn && questions.subjectsEn[0].name.toLowerCase()!=='place')">
				<h3>Evaluation for the category of {{category.name}}</h3>
				<h4>Indicadores</h4>
				<ul >
					<li><small>EE: Excede las Expectativas</small></li>
					<li><small>SE: Satisface todas las Expectativas</small></li>
					<li><small>ME: Satisface la Mayoria de las Expectativas</small></li>
					<li><small>DE: Debajo de las Expectativas</small></li>
				</ul>
			</div>
			<div v-else-if="(questions.subjectsEn && questions.subjectsEn[0].name.toLowerCase()!=='place')">
				<h3> Evaluation for the {{category.name}} Category</h3>
				<h4>INDICATORS</h4>
				<ul>
					<li><small>EE: Exceeds Expectations</small></li>
					<li><small>SE: Satisfies all Expectations</small></li>
					<li><small>ME: Satisfies Most Expectations</small></li>
					<li><small>BE: Below Expectations</small></li>
				</ul>
			</div>
			<div class="row" v-for="theme in questionsToShow" v-if="questionsToShow">
				<div class="col-12">
					<hr class="py-3">
					<h2>{{theme.name}}</h2>
				</div>
				<div class="col-12">
					<div class="py-3" v-for="q in theme.questions">
						<h3><strong>{{q.name}}</strong></h3>
						<div class="radio py-2" v-for="(option,index) in q.options">
							<label v-if="theme.name!=='Place' || theme.name==='Place' && index!==3" >
								<input :disabled="theme.name==='Place' &&(
								(index==0 && selectedFirstPlace) ||
								(index==1 && selectedSecondPlace) ||
								(index==2 && selectedThirdPlace) ||
								(index==3 && selectedFourthPlace)
								)
								" type="radio" :name="q.id" @click="setAnswer(q.id,index)" :value="index" :checked="answers && answers[q.id] && answers[q.id]==4-index" >
								<span v-text="selectedOption(index)"></span>{{option.name}}
							</label>
							

						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="container">
			<button type="button" v-if="selectedArtwork.byPlace" @click="clearAnswer"  class="btn btn-block btn-wedcontest">Clear Answers</button>
			<button type="button" @click="sendAnswers" :disabled="!showSubmit" class="btn btn-block btn-wedcontest">Send Answers</button>
		</div>
	</div>
</div>
</transition>
</div>
</template>

<script>
import {format,differenceInYears} from "date-fns";
export default {

	name: 'Evaluation',
	props:['contest','category'],
	data () {
		return {
			artworks:[],
			selectedArtwork:{},
			hiddenDetail:true,
			completedAnswers:0,
			showSubmit:false
		}
	},
	computed:{
		selectedFirstPlace(){
			return this.artworks.filter(a=>a.place==1).length>0;
		},
		selectedSecondPlace(){
			return this.artworks.filter(a=>a.place==2).length>0;
		},
		selectedThirdPlace(){
			return this.artworks.filter(a=>a.place==3).length>0;
		},
		selectedFourthPlace(){
			return this.artworks.filter(a=>a.place==4).length>0;
		},
		qtyAnswers(){
			if(!this.questionsTranslated)
				return false;
			let qtyOfQuestions=this.questionsToShow.reduce((sum,subject)=> sum+subject.questions.length,0);
			return qtyOfQuestions;
		},
		filteredArtworks(){
			return this.artworks.sort((a,b)=>a.contestant.last_name.localeCompare(b.contestant.last_name)).map(artwork=>{
				if(!artwork.answers){
					artwork.evaluated=false;
					artwork.place=0;
				}
				return artwork;
			});
		},
		age() {
			return differenceInYears(new Date(),this.selectedArtwork.contestant.dob);
		},
		questions(){
			return JSON.parse(this.selectedArtwork.category.questions.questions);
		},
		answers:{
			get(){

				return this.selectedArtwork.answers;
			},
			set(value){
				this.selectedArtwork.answers=value;
			}
		},


		questionsTranslated(){
			if(this.questions==={})
				return {};
			else if (App.locale==='en')
				return this.questions.subjectsEn;
			else (App.locale==='en')
				return this.questions.subjectsEs;
		},
		questionsToShow(){
			if(!this.questionsTranslated)
				return {};
			return this.questionsTranslated.filter(question=>{
				for(let i=0;i<App.roles.length;i++){

					if(question.role===App.roles[i])
						return true;
				}
				return false;
			})
		},
		locale(){
			if(App.locale==='en')
				return 'en';
			else
				return 'es';
		},
		indexOfSelectedArtwork(){
			return this.filteredArtworks.findIndex(art=>art.id===this.selectedArtwork.id);
		},
		maxIndexOfFilterArtworks(){
			return this.filteredArtworks.length-1;
		}
	},
	methods:{
		setAnswer(questionId,answer){
			this.artworks.find(art=>art.id===this.selectedArtwork.id).answers[questionId]=4-answer
			if(this.selectedArtwork.byPlace){
				this.selectedArtwork.place=answer+1;
			}
			this.selectedArtwork.evaluated=true;
			this.completedAnswers=Object.keys(this.selectedArtwork.answers).length;
			if(this.completedAnswers===this.qtyAnswers){
				this.showSubmit=true;
			}
		},
		clearAnswer(){
			this.$set(this.selectedArtwork,'answers',null);
			this.$set(this.selectedArtwork,'evaluated',false);
			this.$set(this.selectedArtwork,'place',0);
			this.sendAnswers();
		},
		getPlaceAndAnswers(){

			this.artworks.forEach(artwork=>{
				this.$set(artwork,'questions',JSON.parse(artwork.category.questions.questions));
				if(artwork.questions.subjectsEn.filter(sub=>sub.name=="Place").length){
					this.$set(artwork,'byPlace',true);
				}
				else{
					this.$set(artwork,'byPlace',false);
				}
				if(!artwork.answers){
					this.$set(artwork,'answers',{});
					this.$set(artwork,'evaluated',false);
					this.$set(artwork,'place',0);
				}
				else{
					this.$set(artwork,'answers',JSON.parse(artwork.answers.answers)||{});
					this.$set(artwork,'evaluated',true);

					switch(artwork.answers[1]){
						case 4:
						this.$set(artwork,'place',1);
						break;
						case 3:
						this.$set(artwork,'place',2);
						break;
						case 2:
						this.$set(artwork,'place',3);
						break;
						case 1:
						this.$set(artwork,'place',4);
						break;
						default:
						this.$set(artwork,'place',0);
					}
				}
			})
		},
		selectedOption(index){
			if((this.questions.subjectsEn && this.questions.subjectsEn[0].name.toLowerCase()!='place')){
				if(App.locale==='en'){
					switch(index){
						case 0:
						return 'EE:';
						case 1:
						return 'SE:';
						case 2:
						return 'ME:';
						case 3:
						return 'BE:';
					}
				}
				switch(index){
					case 0:
					return 'EE:';
					case 1:
					return 'SE:';
					case 2:
					return 'ME:';
					case 3:
					return 'DE:';
				}
			}
			else
				return ""
		},
		translate(model, element){
			if(this.contest){
				return model.translations.find(translation=>translation.locale===App.locale)[element];
			}
		},
		openDetail(artwork){
			this.hiddenDetail=false;

			this.selectedArtwork=artwork;
		},

		selectNext(){
			if(this.maxIndexOfFilterArtworks==this.indexOfSelectedArtwork){
				this.selectedArtwork=this.filteredArtworks[0];
			}
			else{
				this.selectedArtwork=this.filteredArtworks[this.indexOfSelectedArtwork+1];
			}
		},
		selectPrev(){
			if(this.indexOfSelectedArtwork===0){
				this.selectedArtwork=this.filteredArtworks[this.filteredArtworks.length-1];
			}
			else{
				this.selectedArtwork=this.filteredArtworks[this.indexOfSelectedArtwork-1];
			}
		},
		sendAnswers(){
			axios.post(`/evaluation/answers/${this.selectedArtwork.id}`,this.selectedArtwork.answers)
			.then(response=>{
				this.selectedArtwork.evaluated=true;
				switch(this.selectedArtwork.answers[1]){
					case 4:
					this.selectedArtwork.place=1	;
					break;
					case 3:
					this.selectedArtwork.place=2	;
					break;
					case 2:
					this.selectedArtwork.place=3	;
					break;
					case 1:
					this.selectedArtwork.place=4	;
					break;
				}
				this.hiddenDetail=true;
			});
		}
	},
	watch:{
		selectedArtwork(val){
			window.location.hash=val.title;
		}
	},
	created(){
		axios.get(`/api/artworks/category/${this.category.id}/${App.user.id}`)
		.then(response=>{
			this.artworks=response.data;
			this.getPlaceAndAnswers();
		});
	},
}
</script>

<style lang="scss" scoped>
.places {
	z-index: 100;
	position: absolute;
	height: 100%;
	width: 100%;
	background: #e3e3e3;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: xx-large;
	opacity: 0.6;
	font-family: "Source Sans Pro", Arial, Helvetica, sans-serif;
}
.border.evaluated {
	border: 3px solid green !important;
	position:relative;
}
.close-btn {
	position: absolute;
	top: 0;
	right: 0;
}
.filters{
	cursor:pointer;
	font-size:1.1rem;
	.selected{
		font-weight:bold
	}
}
.artworks {
	min-height: 50vh;
}
.artwork{
	overflow:hidden;
	height: 248px;
	transition:all .5s ease-in-out;
	cursor:pointer;
	display: flex;
	align-items: center;
	justify-content: center;

	img{
		transition:all .5s ease-in-out;
	}
	img:hover{
		transform:scale(1.1);
	}
}
.detail{
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	background: white;
	z-index: 1050;
	height:100vh;
	overflow:auto;
	button.close {
		font-size: 4rem;
	}
	.move{
		padding:1rem;
		cursor:pointer;
		i.fas{
			font-size:2rem;
		}
	}
}

</style>