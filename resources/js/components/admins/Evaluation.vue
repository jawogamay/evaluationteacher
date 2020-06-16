<template>
  <div id="app">
    <router-view />
    <Navigation :admin="admin"/>
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">Evaluation</h3>
        <v-container>




                <v-row class="mt-3" justify="center">

                        <!-- CREATE QUESTION FORM -->
                        <v-dialog scrollable persistent v-model="addquestion" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" depressed small v-on="on" style="outline:none;">Create Question</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Question Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                                <v-form>
                                    <v-card class="mx-auto mt-3" width="300" flat>
                                        <v-form>
                                            <v-select label="Select Category" filled rounded :items="select_category" v-on:keyup.enter="addQuestion()" v-model="add_ques_category"></v-select>
                                                <v-alert color="#EF9A9A" dense text v-if="errors.ques_category" type="error">{{ errors.ques_category[0] }}</v-alert>
                                            <v-textarea filled label="Write a question..." v-on:keyup.enter="addQuestion()" type="text" v-model="add_ques_statement"></v-textarea>
                                                <v-alert color="#EF9A9A" dense text  v-if="errors.ques_statement" type="error">{{ errors.ques_statement[0] }}</v-alert>
                                        </v-form>
                                <v-row justify="center">
                                        <v-btn class="mx-auto" style="outline: none;" v-on:click="addQuestion()" outlined text small>Save</v-btn>
                                </v-row>
                                    </v-card>
                                </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addquestion = false" v-on:click="clear()">Ok</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>


                    <!-- QUESTION TABLE -->
                        <v-card class="mt-3 mx-auto" width="900">
                            <v-card-title>
                                Questions
                            <v-spacer></v-spacer>
                            <v-text-field v-model="question_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>
                            <v-data-table :headers="question_headers" :search="question_search" :items-per-page="5" :items="questions" class="elevation-1">




                                <template v-slot:item.actions="{item}">

                                         <!-- Update Question -->

                                                        <v-icon v-on:click="clickQuestion(item)" data-toggle="modal" data-target="#updateQuestion" small>mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateQuestion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Question</h5>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                            <v-form>
                                                                                                <v-select label="Select Category" filled rounded :items="select_category" v-on:keyup.enter="addQuestion()" v-model="ques_category"></v-select>
                                                                                                    <v-alert color="#EF9A9A" dense text v-if="errors.ques_category" type="error">{{ errors.ques_category[0] }}</v-alert>
                                                                                                <v-textarea filled label="Write a question..." v-on:keyup.enter="addQuestion()" type="text" v-model="ques_statement"></v-textarea>
                                                                                                    <v-alert color="#EF9A9A" dense text  v-if="errors.ques_statement" type="error">{{ errors.ques_statement[0] }}</v-alert>
                                                                                            </v-form>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clear()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateQuestion()" v-on:click="updateQuestion()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                            <!-- Delete Question -->

                                                        <v-icon v-on:click="clickQuestion(item)" data-toggle="modal" data-target="#deleteQuestion" small>mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteQuestion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Question</h5>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div style="text-align: center; font-size: 15px;"> Are you sure? </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteQuestion()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                </template>




                            </v-data-table>
                        </v-card>




                <v-row class="mt-5" justify="center">

                        <!-- CREATE EVALUATION FORM -->
                        <v-dialog scrollable persistent v-model="addform" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" depressed small v-on="on" style="outline:none;">Create Evaluation Form</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Evaluation Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field filled label="Title" v-on:keyup.enter="addForm()" type="text" v-model="add_title"></v-text-field>
                                    <v-alert color="#EF9A9A" text="#D50000" v-if="errors.title" type="error">{{ errors.title[0] }}</v-alert>
                                <v-select label="Select Type" filled rounded :items="select_type" v-on:keyup.enter="addForm()" v-model="add_type"></v-select>
                                    <v-alert color="#EF9A9A" text="#D50000" v-if="errors.type" type="error">{{ errors.type[0] }}</v-alert>
                                
                                    <div>Start Date</div>
                                        <v-text-field dense rounded type="Date" v-model="start_date"></v-text-field>
                                            <v-alert color="#EF9A9A" dense text v-if="errors.start_date" type="error">{{ errors.start_date[0] }}</v-alert>
                                            <div>End Date</div>
                                        <v-text-field dense rounded type="Date" v-model="end_date"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.end_date" type="error">{{ errors.end_date[0] }}</v-alert>                                                                                   
                                </v-form>
                                <v-row justify="center">
                                    <v-btn style="outline: none;" class="mx-auto" v-on:click="addForm()" outlined text small>Create</v-btn>
                                </v-row>
                            </v-card-text>

                            <v-divider></v-divider>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addform = false" v-on:click="clear()">Ok</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>


                    <!-- EVALUATION FORM TABLE -->
                        <v-card class="mt-3 mx-auto" width="900">
                            <v-card-title>
                                Evaluation Forms
                            <v-spacer></v-spacer>
                            <v-text-field v-model="evaluation_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>
                            <v-data-table :headers="evaluation_headers" :search="evaluation_search" :items-per-page="5" :items="evaluations" class="elevation-1">


                                <!-- Set Period -->
                          


                                <!-- Question Form -->
                                <template v-slot:item.add_question="{item}">

                                        <v-icon v-on:click="clickEvaluation(item)" data-toggle="modal" data-target="#questionForm" small class="ml-3">mdi-file-question</v-icon>

                                            <div class="modal fade bd-example-modal-lg"  data-backdrop="static" data-keyboard="false" id="questionForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Questions</h5>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                    <v-card class="mx-auto" width="400" flat>
                                                                        <v-form>
                                                                            <v-card-title>Select Questions</v-card-title>
                                                                                <v-autocomplete filled rounded :items="questions" v-on:keyup.enter="addQuestionForm()" item-value="id" item-text="ques_category" clearable v-model="add_ques_id">
                                                                                     <template slot="selection" slot-scope="data" >
                                                                                            {{ data.item.ques_category }} - {{data.item.ques_statement}}
                                                                                            </template>
                                                                                        <template slot="item" slot-scope="data" >
                                                                                            {{ data.item.ques_category }} - {{data.item.ques_statement}}
                                                                                            </template>
                                                                                </v-autocomplete>
                                                                        </v-form>
                                                                        <v-btn style="outline: none;" v-on:click="addQuestionForm()" outlined text small>Save</v-btn>
                                                                    </v-card>


                                                                        <v-card class="mt-4 mb-3 mx-auto" width="700">
                                                                            <!-- QUESTION FORM TABLE -->
                                                                        <v-simple-table dense style="background-color: #F5F5F5;" fixed-header>
                                                                                            <template v-slot:default>
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                    <th class="text-left">Categories</th>
                                                                                                    <th class="text-left">Questions</th>
                                                                                                    <th class="text-left">Remove</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody v-for="question in questions" :key="question.id">
                                                                                                    <tr v-for="questionform in questionforms" :key="questionform.id">
                                                                                                            <th v-if="id === questionform.form_id && question.id === questionform.ques_id">{{question.ques_category}}</th>
                                                                                                            <td v-if="id === questionform.form_id && question.id === questionform.ques_id">{{question.ques_statement}}</td>
                                                                                                            <td v-if="id === questionform.form_id && question.id === questionform.ques_id">
                                                                                                                <!-- Delete Question -->
                                                                                                                    <v-icon @click.prevent="deleteQuestionForm(questionform)" small class="ml-3">mdi-delete</v-icon>
                                                                                                            </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </template>
                                                                        </v-simple-table>
                                                                        </v-card>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                <v-btn depressed style="outline: none;" @click="clear()" data-dismiss="modal">Ok</v-btn>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </template>


                                <!-- Evaluator Form -->
                                <template v-slot:item.add_evaluator="{item}">

                                        <v-icon v-on:click="clickEvaluation(item)" data-toggle="modal" data-target="#evaluatorForm" small class="ml-3">mdi-account-multiple-plus</v-icon>

                                            <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="evaluatorForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Evaluators</h5>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                                        <!-- SELECT STUDENT -->
                                                                                    <v-card class="mx-auto" width="300" flat>
                                                                                        <v-form>
                                                                                    <v-autocomplete clearable label="Select Student Evaluator" rounded filled dense :items="students" item-value="id" item-text="fname" v-model="add_student_id">
                                                                                           <template slot="selection" slot-scope="data" >
                                                                                            {{ data.item.fname }} {{data.item.mi}} {{data.item.lname}}
                                                                                            </template>
                                                                                        <template slot="item" slot-scope="data" >
                                                                                            {{ data.item.fname }} {{data.item.mi}} {{data.item.lname}}
                                                                                            </template>
                                                                                        </v-autocomplete>
                                                                                        <v-alert color="#EF9A9A" dense text v-if="errors.student_id" type="error">{{ errors.student_id[0] }}</v-alert>
                                                                                        </v-form>
                                                                                        <v-btn style="outline: none;" v-on:click="addStudentEvaluator()" outlined text small>Add student</v-btn>

                                                                                        <v-card class="mt-4 mb-3 mx-auto" width="300">
                                                                                            <!-- STUDENT TABLE -->
                                                                                        <v-simple-table dense style="background-color: #F5F5F5;" height="200" fixed-header>
                                                                                                <template v-slot:default>
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                        <th class="text-left">Student Evaluators</th>
                                                                                                            <th class="text-left">Remove</th>
                                                                                                                    </tr>
                                                                                                                </thead>
                                                                                                                <tbody v-for="evaluator in evaluators" :key="evaluator.id">
                                                                                                                    <tr v-if="id === evaluator.form_id && evaluator.student_id">
                                                                                                                        <td>
                                                                                                                            <div v-for="student in students" :key="student.id">
                                                                                                                                <div v-if="student.id === evaluator.student_id">
                                                                                                                                    {{ student.fname }} {{ student.mi }} {{ student.lname }}
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                            <!-- Delete Evaluator -->
                                                                                                                        <td><v-icon @click.prevent="deleteEvaluator(evaluator)" small class="ml-3">mdi-delete</v-icon></td>
                                                                                                                    </tr>
                                                                                                            </tbody>
                                                                                                        </template>
                                                                                                    </v-simple-table>
                                                                                                </v-card>
                                                                                            </v-card>


                                                                                    <!-- SELECT FACULTY -->
                                                                                    <v-card class="mx-auto" width="300" flat>
                                                                                        <v-form class="mt-4">
                                                                                    <v-autocomplete clearable label="Select Faculty Evaluator" rounded filled dense :items="faculties" item-value="id" item-text="fname" v-model="add_faculty_id">
                                                                                         <template slot="selection" slot-scope="data" >
                                                                                            {{ data.item.fname }} {{data.item.mi}} {{data.item.lname}}
                                                                                            </template>
                                                                                        <template slot="item" slot-scope="data" >
                                                                                            {{ data.item.fname }} {{data.item.mi}} {{data.item.lname}}
                                                                                            </template>
                                                                                    </v-autocomplete>
                                                                                        <v-alert color="#EF9A9A" dense text v-if="errors.faculty_id" type="error">{{ errors.faculty_id[0] }}</v-alert>
                                                                                        </v-form>
                                                                                        <v-btn style="outline: none;" v-on:click="addFacultyEvaluator()" outlined text small>Add faculty</v-btn>
                                                                                    </v-card>


                                                                                        <v-card class="mt-4 mb-3 mx-auto" width="300">
                                                                                            <!-- FACULTY TABLE -->
                                                                                        <v-simple-table dense style="background-color: #F5F5F5;" height="200" fixed-header>
                                                                                                <template v-slot:default>
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                        <th class="text-left">Faculty Evaluators</th>
                                                                                                            <th class="text-left">Remove</th>
                                                                                                                    </tr>
                                                                                                                </thead>
                                                                                                                <tbody v-for="evaluator in evaluators" :key="evaluator.id">
                                                                                                                    <tr v-if="id === evaluator.form_id && evaluator.faculty_id">
                                                                                                                        <td>
                                                                                                                            <div v-for="faculty in faculties" :key="faculty.id">
                                                                                                                                <div v-if="faculty.id === evaluator.faculty_id">
                                                                                                                                    {{ faculty.fname }} {{ faculty.mi }} {{ faculty.lname }}
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                            <!-- Delete Evaluator -->
                                                                                                                        <td><v-icon @click.prevent="deleteEvaluator(evaluator)" small class="ml-3">mdi-delete</v-icon></td>
                                                                                                                    </tr>
                                                                                                            </tbody>
                                                                                                        </template>
                                                                                                    </v-simple-table>
                                                                                                </v-card>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                <v-btn depressed style="outline: none;" @click="clear()" data-dismiss="modal">Ok</v-btn>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </template>


                                <template v-slot:item.actions="{item}">

                                         <!-- Update Evaluation -->

                                                        <v-icon v-on:click="clickEvaluation(item)" data-toggle="modal" data-target="#updateEvaluation" small>mdi-pencil</v-icon>

                                                            <div class="modal fade" data-backdrop="static" data-keyboard="false" id="updateEvaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Evaluation</h5>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-form>
                                                                                            <v-text-field filled label="Title" v-on:keyup.enter="addForm()" type="text" v-model="title"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" text="#D50000" v-if="errors.title" type="error">{{ errors.title[0] }}</v-alert>
                                                                                            </v-form>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clear()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateEvaluation()" v-on:click="updateEvaluation()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                            <!-- Delete Evaluation -->

                                                        <v-icon v-on:click="clickEvaluation(item)" data-toggle="modal" data-target="#deleteEvaluation" small>mdi-delete</v-icon>

                                                            <div class="modal fade" data-backdrop="static" data-keyboard="false" id="deleteEvaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Evaluation</h5>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div style="text-align: center; font-size: 15px;"> Are you sure? </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteEvaluation()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                </template>




                            </v-data-table>
                        </v-card>




        </v-container>
    </v-content>
    <Footer/>
  </div>
</template>

<script>
import Navigation from "./components/Navigation";
import Footer from "./components/Footer";
export default {
  props: {
    admin: {
      type: Object,
      required: true
    }
  },
  name: "Evaluation",
  components: {
    'Navigation': Navigation,
    'Footer': Footer,
  },

  data: () => ({
      question_search: '',
      evaluation_search: '',
        question_headers: [
        {
            text: 'Category',
            value: 'ques_category',
            sortable: false,
            align: 'left'
        },
        { text: 'Questions', value: 'ques_statement' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
      addquestion: false,
      select_category: ['Commitment', 'Knowledge of the Subject', 'Teaching Effectiveness', 'Management of Learning'],
      add_ques_category: null,
      add_ques_statement: null,
      ques_category: null,
      ques_statement: null,
      id: null,
      questions: [],
        evaluation_headers: [
        {
            text: 'Title',
            value: 'title',
            sortable: false,
            align: 'left'
        },
        { text: 'Type', value: 'type' },
        { text: 'Add Questions', value: 'add_question' },
        { text: 'Add Evaluators', value: 'add_evaluator' },
        { text: 'Started At', value: 'start_date' },
         { text: 'Ended At', value: 'end_date' },

        { text: 'Actions', value: 'actions', sortable: false }
        ],
      addform: false,
      select_type: ['Teacher Evaluation'],
      add_title: null,
      add_type: null,
      title: null,
      type: null,
      start_date: null,
      end_date: null,
      evaluations: [],

      add_ques_id: null,
      questionforms: [],

      add_student_id: null,
      add_faculty_id: null,
      students: [],
      faculties: [],
      evaluators: [],
      errors: []
  }),

  created() {
        this.fetchEvaluation();
  },

  methods: {

    fetchEvaluation() {
      axios.get("/admin/evaluation/view").then(response => {
        this.questions = response.data.questions;
        this.evaluations = response.data.evaluations;
        this.questionforms = response.data.questionforms;
        this.students = response.data.students;
        this.faculties = response.data.faculties;
        this.evaluators = response.data.evaluators;
      });
    },


    //   QUESTIONS

    clickQuestion: function (question) {
    return (this.id = question.id, this.ques_category = question.ques_category, this.ques_statement = question.ques_statement);
    },

    addQuestion() {
        axios.post("/admin/question/create", {ques_category: this.add_ques_category, ques_statement: this.add_ques_statement})
        .then(response => {
                this.questions.unshift({ id: response.data.id, ques_category:response.data.ques_category, ques_statement: response.data.ques_statement, created_at: response.data.created_at, updated_at: response.data.updated_at});
                this.add_ques_category = "";
                this.add_ques_statement = "";
                this.errors = "";
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    updateQuestion() {
   axios.put("/admin/question/update", {id: this.id, ques_category: this.ques_category, ques_statement: this.ques_statement})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deleteQuestion() {
            axios.post("/admin/question/delete", {id: this.id})
        .then(response => {
         window.location.reload()
       })
        .catch(error => {
        });
    },

    // EVALUATION FORM

    clickEvaluation: function (evaluation) {
    return (this.id = evaluation.id, this.title = evaluation.title, this.type = evaluation.type, this.start_date = evaluation.start_date, this.end_date = evaluation.end_date);
    },

    addForm() {
        axios.post("/admin/evaluation/create", {title: this.add_title, type: this.add_type,start_date:this.start_date,end_date:this.end_date})
        .then(response => {
                this.evaluations.unshift({ id: response.data.id, title:response.data.title, type: response.data.type, start_date: response.data.start_date, end_date: response.data.end_date});
                this.add_title = "";
                this.add_type = "";
                this.errors = "";
                this.start_date = "";
                this.end_date = "";
                alert('Success')
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    updateEvaluation() {
   axios.put("/admin/evaluation/update", {id: this.id, title: this.title})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    setPeriod() {
   axios.put("/admin/evaluation/set", {id: this.id, start_date: this.start_date, end_date: this.end_date})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deleteEvaluation() {
            axios.post("/admin/evaluation/delete", {id: this.id})
        .then(response => {
         window.location.reload()
       })
        .catch(error => {
        });
    },

    // QUESTION IN FORM

    addQuestionForm() {
        axios.post("/admin/evaluation/question/create", {form_id: this.id, ques_id: this.add_ques_id})
        .then(response => {
                this.questionforms.unshift({ id: response.data.id, form_id:response.data.form_id, ques_id: response.data.ques_id, created_at: response.data.created_at, updated_at: response.data.updated_at});
                this.add_ques_id = "";
                this.errors = "";
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    deleteQuestionForm(questionform) {
            axios.post("/admin/evaluation/question/delete", {id: questionform.id})
        .then(response => {
            const questionformIndex = this.questionforms.indexOf(questionform)
            this.questionforms.splice(questionformIndex, 1)
       })
        .catch(error => {
        });
    },

    // EVALUATOR

    addStudentEvaluator() {
        axios.post("/admin/evaluator/student/create", {id: this.id, student_id: this.add_student_id})
        .then(response => {
                this.evaluators.unshift({ id: response.data.id, student_id:response.data.student_id, form_id: response.data.form_id });
                this.add_student_id = "";
                this.errors = "";
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    addFacultyEvaluator() {
        axios.post("/admin/evaluator/faculty/create", {id: this.id, faculty_id: this.add_faculty_id})
        .then(response => {
                this.evaluators.unshift({ id: response.data.id, faculty_id:response.data.faculty_id, form_id: response.data.form_id });
                this.add_faculty_id = "";
                this.errors = "";
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    deleteEvaluator(evaluator) {
            axios.post("/admin/evaluator/delete", {id: evaluator.id})
        .then(response => {
            const evaluatorIndex = this.evaluators.indexOf(evaluator)
            this.evaluators.splice(evaluatorIndex, 1)
       })
        .catch(error => {
        });
    },


    clear() {
                this.add_ques_category = "";
                this.add_ques_statement = "";
                this.ques_category = "";
                this.ques_statement = "";
                this.add_title = "";
                this.add_type = "";
                this.title = "";
                this.type = "";
                this.add_ques_id = "";
                this.start_date = "";
                this.end_date = "";
                this.errors = "";
    },

  }
};
</script>
