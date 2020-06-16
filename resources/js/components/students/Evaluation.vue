<template>
  <div id="app">
    <router-view />
    <Navigation :student="student" />
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">Evaluation</h3>
             <v-container>

                    <!-- EVALUATION FORM TABLE -->
                        <v-card class="mt-3 mx-auto" width="900">
                            <v-card-title>
                                Evaluation Form
                            </v-card-title>
                                <v-simple-table style="background-color: #F5F5F5;" fixed-header>
                                <template v-slot:default>
                                            <thead>
                                                    <tr>
                                                        <th class="text-left">Title</th>
                                                        <th class="text-left">Type</th>
                                                        <th class="text-left">Start Evaluate</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="evaluation in evaluations" :key="evaluation.id">
                                                    <td>{{evaluation.studentevaluate.title}}</td>
                                                    <td>{{evaluation.studentevaluate.type}}</td>
                                                    <td><button class="btn btn-warning" @click="evaluateForm(evaluation.form_id)">Start Evaluate</button></td>
                                                </tr>
                                            </tbody>
                                </template>
                                </v-simple-table>
                        </v-card>

             </v-container>
    </v-content>

    <Footer />

    <div class="modal fade" id="evaluateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-full" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <h3>Evaluation Form # {{formId}}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit="addEvaluation()">
      <div class="modal-body">
        <label><b> Select A Teacher </b> </label>
        <select class="form-control" style="width:20%;" v-model="teacherevaluate">
          <option v-for="teacher in teachers" :key = "teacher.id" :value="teacher.id">
            {{teacher.fname}} {{teacher.lname}}
          </option>
          
        </select>
        <br>
        <table class="table table-bordered table-hovered">
            <thead>
              <th></th>
              <th>Questions </th>
              <th>Scale </th>
            </thead>
            <tbody>
          <tr v-for="(question,index) in questions" :key="question.id">
            <td><b>A. {{question.questionaires.ques_category}}</b></td>
            <td> {{question.questionaires.ques_statement}}</td>
            <input type="hidden" v-model="question.id">
            <td>
              <div class="form-check-inline" v-for="(rate,vindex) in radiosButtons" :key="rate.id">
              <label class="form-check-label">
                <input @click="setValue(question.id,rate.name)" class="form-check-input" :value="[{question_num:question.id,rate:rate.name}]"  type="radio" :name="'group'+index" :id="'radio'+vindex">{{rate.name}}
              </label>
            </div>
            </td>
          </tr>
        </tbody>
        </table>
        <button class="btn btn-primary" type="submit">Submit</button>
        <!-- {{selectedRates}} -->
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
</template>

<script>
import Navigation from "./components/Navigation";
import Footer from "./components/Footer";
export default {
 
  props: {
    student: {
      type: Object,
      required: true
    }
  },

  name: "Student_Evaluation",

  components: {
    Navigation: Navigation,
    Footer: Footer
  },
 
  data:  () => ({
      evaluations: [],
      evaluators: [],
      teachers: [],
      faculties: [],
      questions: [],
      ratings: [],
      formId: '',
      teacherevaluate:'',
      comments: [],
      teachers:[],
      radiosButtons:[
        {name:1},
        {name:2},
        {name:3},
        {name:4},
        {name:5}
      ],
      selectedRates:[],
  }),

  created() {
        this.fetchEvaluation();
        this.getTeachers();
        
  },

  methods: {
    fetchEvaluation(){
      axios.get('/student/evaluationview').then(({data}) => this.evaluations =data);
    },
    
    setValue(name,value){
      console.log(value)
      var self = this;
       this.selectedRates.forEach(function(val,index){
      
         if(val['question_num'] == name) {
           self.selectedRates.splice(index, 1);
           return false;
         }
      });
     this.selectedRates.push({
       "question_num" : name,
       "rates":value
     })
    },
    evaluateForm(id){
      this.formId = id
      axios.get('/student/evaluationview/'+id).then(({data})=> 
      this.questions = data,
      $('#evaluateForm').modal('show'));
    },
    getTeachers(){
      axios.get('/student/teachers').then(({data})=> this.teachers = data)
    },
    addEvaluation(){
      axios.post('/student/evaluationview',{ratingss:this.selectedRates,teacher_id:this.teacherevaluate,form_id:this.formId}).then((response)=> {
          $('#evaluateForm').modal('hide')
          windows.location.reload()

      })
    }
  }

};
</script>
<style scoped>
.modal-full {
    min-width: 100%;
    margin: 0;
}

.modal-full .modal-content {
    min-height: 100vh;
}
</style>