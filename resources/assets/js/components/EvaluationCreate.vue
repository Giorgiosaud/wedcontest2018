<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col">
          <h1>{{category.name}}</h1>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="tema">Subject:</label>
            <input class="form-control" v-model="actualSubjectEn">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="tema">Tema:</label>
            <input class="form-control" v-model="actualSubjectEs">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="percentaje">Porcentaje:</label>
            <input class="form-control" v-model="actualSubjectPercentage">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="rol">Rol Evaluador:</label>
            <select class="form-control" id="rol" v-model="actualSubjectRole">
              <option :vlaue="null" selected>Choose Role...</option>
              <option :value="role.name" v-for="role in roles">{{role.name}}</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <button type="button" 
      class="btn btn-wedcontest" 
      :disabled="actualSubjectEn==='' || actualSubjectEs==='' || actualSubjectPercentage===''" @click="addSubject">Add Subject</button>
    </div>
    <div class="container">
      <div class="row">
        <div class="col" >
          <div class="row" v-for="subject in subjectsEn">
            {{subject.name}} – {{subject.percentage}}%
            <ul v-for="question in subject.questions" class="list-group">
              <li class="list-group-item active">{{question.name}}</li>
              <li class="list-group-item d-flex justify-content-between align-items-center" v-for="option in question.options">
                {{option.name}}
                <span class="badge badge-primary badge-pill">{{option.value}}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="row"  v-for="subject in subjectsEs">


            {{subject.name}} – {{subject.percentage}}%
            <ul v-for="question in subject.questions" class="list-group">
              <li class="list-group-item active">{{question.name}}</li>
              <li class="list-group-item d-flex justify-content-between align-items-center" v-for="option in question.options">
                {{option.name}}
                <span class="badge badge-primary badge-pill">{{option.value}}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container" v-if="subjectsEn.length>0">
      <div class="row">
        <h3>New Questions</h3>
      </div>
      <div class="row">
        <div class="col">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="theme">Theme</label>
            </div>
            <select class="custom-select" id="theme" v-model="newQuestionThemeEn">
              <option :vlaue="null" selected>Choose...</option>
              <option :value="subject.name" v-for="subject in subjectsEn">{{subject.name}}</option>
            </select>
          </div>
        </div>
        <div class="col">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="theme">Tema</label>
            </div>
            <select class="custom-select" id="theme" v-model="newQuestionThemeEs">
              <option :vlaue="null" selected>Escoje el Tema...</option>
              <option :value="subject.name" v-for="subject in subjectsEs">{{subject.name}}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col" v-if="newQuestionThemeEn">
          <div class="form-group">
            <label for="newQuestionEn">Question:</label>
            <input class="form-control" v-model="newQuestionEn" id="newQuestionEn">
          </div>
          <div class="form-group">
            <label for="newQuestionEnOption1">Option 1:</label>
            <input class="form-control" v-model="newQuestionEnOption1" id="newQuestionEnOption1">
          </div>
          <div class="form-group">
            <label for="newQuestionEnOption2">Option 2:</label>
            <input class="form-control" v-model="newQuestionEnOption2" id="newQuestionEnOption2">
          </div>
          <div class="form-group">
            <label for="newQuestionEnOption3">Option 3:</label>
            <input class="form-control" v-model="newQuestionEnOption3" id="newQuestionEnOption3">
          </div>
          <div class="form-group">
            <label for="newQuestionEnOption4">Option 4:</label>
            <input class="form-control" v-model="newQuestionEnOption4" id="newQuestionEnOption4">
          </div>
        </div>
        <div class="col" v-if="newQuestionThemeEs">
          <div class="form-group">
            <label for="newQuestionEs">Pregunta:</label>
            <input type="hidden" v-model="newQuestionId">

            <input class="form-control" v-model="newQuestionEs" id="newQuestionEs">
          </div>
          <div class="form-group">
            <label for="newQuestionEsOption1">Opción 1:</label>
            <input class="form-control" v-model="newQuestionEsOption1" id="newQuestionEsOption1">
          </div>
          <div class="form-group">
            <label for="newQuestionEsOption2">Opción 2:</label>
            <input class="form-control" v-model="newQuestionEsOption2" id="newQuestionEsOption2">
          </div>
          <div class="form-group">
            <label for="newQuestionEsOption3">Opción 3:</label>
            <input class="form-control" v-model="newQuestionEsOption3" id="newQuestionEsOption3">
          </div>
          <div class="form-group">
            <label for="newQuestionEsOption4">Opción 4:</label>
            <input class="form-control" v-model="newQuestionEsOption4" id="newQuestionEsOption4">
          </div>
        </div>
      </div>
      <div class="row">
        <button type="button" 
        class="btn btn-wedcontest" 
        :disabled="!canPushQuestion" @click="addQuestion">Add Question</button>
      </div>
    </div>
    <div class="container">
      <button type="button" class="btn btn-wedcontest" @click="sendQuestions">Agregar Cuestionario</button>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    category:Object,
    roles:Array
  },
  components: {
  },
  data() { 
    return{
      actualSubjectEn:'',
      actualSubjectEs:'',
      actualSubjectPercentage:'',
      actualSubjectRole:null,
      subjectsEn:[],
      subjectsEs:[],
      newQuestionThemeEn:null,
      newQuestionThemeEs:null,
      newQuestionEn:null,
      newQuestionEs:null,
      newQuestionEnOption1:null,
      newQuestionEnOption2:null,
      newQuestionEnOption3:null,
      newQuestionEnOption4:null,
      newQuestionEsOption1:null,
      newQuestionEsOption2:null,
      newQuestionEsOption3:null,
      newQuestionEsOption4:null,
      newQuestionId:1,

    }
  },
  computed: {
    questions(){
      return {
        questionsEs:this.subjectsEs,
        questionsEn:this.subjectsEn
      }
    },
    canPushQuestion(){
      return this.newQuestionThemeEn &&
      this.newQuestionThemeEs &&
      this.newQuestionEn &&
      this.newQuestionEs &&
      this.newQuestionEnOption1 &&
      this.newQuestionEnOption2 &&
      this.newQuestionEnOption3 &&
      this.newQuestionEnOption4 &&
      this.newQuestionEsOption1 &&
      this.newQuestionEsOption2 &&
      this.newQuestionEsOption3 &&
      this.newQuestionEsOption4;
    },
    subjectEn(){
      return{
        name:this.actualSubjectEn,
        percentage:this.actualSubjectPercentage,
        role:this.actualSubjectRole,
        questions:[]
      }
    },
    subjectEs(){
      return {
        name:this.actualSubjectEs,
        percentage:this.actualSubjectPercentage,
        role:this.actualSubjectRole,
        questions:[]
      }
    },
    questionEn(){
      return {
        name:this.newQuestionEn,
        id:this.newQuestionId,
        options:[
        {name:this.newQuestionEnOption1,value:4},
        {name:this.newQuestionEnOption2,value:3},
        {name:this.newQuestionEnOption3,value:2},
        {name:this.newQuestionEnOption4,value:1}
        ]
      }
    },
    questionEs(){
      return{
        name:this.newQuestionEs,
        options:[
        {name:this.newQuestionEsOption1,value:4},
        {name:this.newQuestionEsOption2,value:3},
        {name:this.newQuestionEsOption3,value:2},
        {name:this.newQuestionEsOption4,value:1}
        ]
      }
    },
    totalPercentage(){
      return this.subjectsEn.reduce((sum,subject)=> sum+parseInt(subject.percentage),0)
    }
  },
  methods: {
    addSubject(){
      this.subjectsEn.push(this.subjectEn);
      this.subjectsEs.push(this.subjectEs);
      this.newQuestionId++;
    },
    addQuestion(){
      this.subjectsEn.find(sub=>sub.name===this.newQuestionThemeEn).questions.push(this.questionEn);
      this.subjectsEs.find(sub=>sub.name===this.newQuestionThemeEs).questions.push(this.questionEs);
      this.cleanNewQuestions();
    },
    cleanNewQuestions(){
      this.newQuestionEn=null;
      this.newQuestionEs=null;
      this.newQuestionEnOption1=null;
      this.newQuestionEsOption1=null;
      this.newQuestionEnOption2=null;
      this.newQuestionEsOption2=null;
      this.newQuestionEnOption3=null;
      this.newQuestionEsOption3=null;
      this.newQuestionEnOption4=null;
      this.newQuestionEsOption4=null;
    },
    sendQuestions(){
      axios.post(`/admin/evaluations/${this.category.id}`, this.questions)
      .then(({ data }) => {
        flash("El concurso fue creado exitosamente", "success");
      })
      .catch(error => {
        flash(error.response.data.message, "warning");
      })
      console.log('sending')
    }
  },
};
</script>

<style lang="scss">

</style>