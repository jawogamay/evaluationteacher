<template>
  <div id="app">
    <router-view />
    <Navigation :admin="admin"/>
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">User Table</h3>
    <v-container>
        <v-row class="mt-3" justify="center">

                        <!-- STUDENT REGISTER -->
                        <v-dialog persistent scrollable v-model="addstudent" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearUser()" depressed small v-on="on" style="outline:none;">Register Student</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Student Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Student ID" v-on:keyup.enter="addStudent()" type="text" v-model="add_stu_id"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.stu_id" type="error">{{ errors.stu_id[0] }}</v-alert>
                                <v-autocomplete label="Select Section" rounded filled dense :items="sections" item-value="id" item-text="sec_code" v-model="add_sec_id"></v-autocomplete>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.sec_id" type="error">{{ errors.sec_id[0] }}</v-alert>
                                <v-text-field label="First Name" v-on:keyup.enter="addStudent()" type="text" v-model="add_fname"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.fname" type="error">{{ errors.fname[0] }}</v-alert>
                                <v-text-field label="Middle Initital" v-on:keyup.enter="addStudent()" type="text" v-model="add_mi"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.mi" type="error">{{ errors.mi[0] }}</v-alert>
                                <v-text-field label="Last Name" v-on:keyup.enter="addStudent()" type="text" v-model="add_lname"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.lname" type="error">{{ errors.lname[0] }}</v-alert>
                                <v-text-field label="Birthday" v-on:keyup.enter="addStudent()" type="date" v-model="add_birthdate"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.birthdate" type="error">{{ errors.birthdate[0] }}</v-alert>
                                <v-text-field label="Home Address" v-on:keyup.enter="addStudent()" type="text" v-model="add_address"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.address" type="error">{{ errors.address[0] }}</v-alert>
                                <v-text-field label="Contact Number" v-on:keyup.enter="addStudent()" type="text" v-model="add_contact"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.contact" type="error">{{ errors.contact[0] }}</v-alert>
                                <v-text-field label="Password" v-on:keyup.enter="addStudent()" type="password" v-model="add_password"></v-text-field>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.password" type="error">{{ errors.password[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addstudent = false" v-on:click="clearUser()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addStudent()" text v-on:click="addStudent()">Register</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>

                    </v-row>
                    <!-- STUDENT TABLE -->
                        <v-card class="mt-3">
                            <v-card-title>
                                Students
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table style="outline: none;" :headers="headers" :search="search" :items-per-page="5" :items="students" class="elevation-1">

                                <template v-slot:item.section="{item}">
                                        <div v-for="section in sections" :key="section.id">
                                            <div v-if="item.sec_id === section.id">
                                            {{ section.sec_code }}
                                            </div>
                                        </div>
                                </template>

                                <template v-slot:item.actions="{item}">

                                         <!-- Update Information -->

                                        <v-icon v-on:click="clickStudent(item)" data-toggle="modal" data-target="#updateStudentInfo" small>mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateStudentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Student Info</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearUser()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-text-field label="Student ID" v-on:keyup.enter="updateStudent()" type="text" v-model="stu_id"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.stu_id" type="error">{{ errors.stu_id[0] }}</v-alert>
                                                                                        <v-autocomplete label="Select Section" rounded filled dense :items="sections" item-value="id" item-text="sec_code" v-model="sec_id"></v-autocomplete>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.sec_id" type="error">{{ errors.sec_id[0] }}</v-alert>
                                                                                        <v-text-field label="Last Name" v-on:keyup.enter="updateStudent()" type="text" v-model="lname"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.lname" type="error">{{ errors.lname[0] }}</v-alert>
                                                                                        <v-text-field label="First Name" v-on:keyup.enter="updateStudent()" type="text" v-model="fname"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.fname" type="error">{{ errors.fname[0] }}</v-alert>
                                                                                        <v-text-field label="Middle Initital" v-on:keyup.enter="updateStudent()" type="text" v-model="mi"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.mi" type="error">{{ errors.mi[0] }}</v-alert>
                                                                                        <v-text-field label="Birthday" v-on:keyup.enter="updateStudent()" type="date" v-model="birthdate"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.birthdate" type="error">{{ errors.birthdate[0] }}</v-alert>
                                                                                        <v-text-field label="Home Address" v-on:keyup.enter="updateStudent()" type="text" v-model="address"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.address" type="error">{{ errors.address[0] }}</v-alert>
                                                                                        <v-text-field label="Contact Number" v-on:keyup.enter="updateStudent()" type="text" v-model="contact"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.contact" type="error">{{ errors.contact[0] }}</v-alert>
                                                                                        <v-text-field label="Change Password" v-on:keyup.enter="updateStudent()" type="password" v-model="password"></v-text-field>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.password" type="error">{{ errors.password[0] }}</v-alert>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearUser()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateStudent()" v-on:click="updateStudent()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                        <!-- Delete Student -->

                                        <v-icon v-on:click="clickStudent(item)"  data-toggle="modal" data-target="#deleteStudentInfo" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteStudentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Information</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div style="text-align: center; font-size: 15px;"> Are you sure? </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteStudent()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                </template>
                            </v-data-table>
                        </v-card>


        <v-row class="mt-5" justify="center">

                        <!-- FACULTY REGISTER -->
                        <v-dialog persistent scrollable v-model="addfaculty" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearUser()" depressed small v-on="on" style="outline:none;">Register Faculty</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Faculty Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Username" v-on:keyup.enter="addFaculty()" type="text" v-model="add_faculty_username"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.username" type="error">{{ errors.username[0] }}</v-alert>
                                <v-autocomplete label="Select Position" rounded filled dense :items="positions" item-value="id" item-text="pos_name" v-model="add_pos_id"></v-autocomplete>
                                    <v-alert color="#EF9A9A" dense text v-if="errors.pos_id" type="error">{{ errors.pos_id[0] }}</v-alert>
                                <v-text-field label="First Name" v-on:keyup.enter="addFaculty()" type="text" v-model="add_faculty_fname"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.fname" type="error">{{ errors.fname[0] }}</v-alert>
                                <v-text-field label="Middle Initital" v-on:keyup.enter="addFaculty()" type="text" v-model="add_faculty_mi"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.mi" type="error">{{ errors.mi[0] }}</v-alert>
                                <v-text-field label="Last Name" v-on:keyup.enter="addFaculty()" type="text" v-model="add_faculty_lname"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.lname" type="error">{{ errors.lname[0] }}</v-alert>
                                <v-text-field label="Birthday" v-on:keyup.enter="addFaculty()" type="date" v-model="add_faculty_birthdate"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.birthdate" type="error">{{ errors.birthdate[0] }}</v-alert>
                                <v-text-field label="Home Address" v-on:keyup.enter="addFaculty()" type="text" v-model="add_faculty_address"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.address" type="error">{{ errors.address[0] }}</v-alert>
                                <v-text-field label="Contact Number" v-on:keyup.enter="addFaculty()" type="text" v-model="add_faculty_contact"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.contact" type="error">{{ errors.contact[0] }}</v-alert>
                                <v-text-field label="Password" v-on:keyup.enter="addFaculty()" type="password" v-model="add_faculty_password"></v-text-field>
                                        <v-alert color="#EF9A9A" dense text v-if="errors.password" type="error">{{ errors.password[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addfaculty = false" v-on:click="clearUser()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addFaculty()" text v-on:click="addFaculty()">Register</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>

                     <!-- FACULTY TABLE -->
                        <v-card class="mt-3">
                            <v-card-title>
                                Faculty Members
                            <v-spacer></v-spacer>
                            <v-text-field v-model="faculty_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table :headers="faculty_headers" :search="faculty_search" :items-per-page="5" :items="faculties" class="elevation-1">

                                <template v-slot:item.position="{item}">
                                        <div v-for="position in positions" :key="position.id">
                                            <div v-if="item.pos_id === position.id">
                                            {{ position.pos_name }}
                                            </div>
                                        </div>
                                </template>

                                <template v-slot:item.actions="{item}">

                                         <!-- Update Information -->

                                        <v-icon v-on:click="clickFaculty(item)" data-toggle="modal" data-target="#updateFacultyInfo" small>mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateFacultyInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Faculty Info</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearUser()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-text-field label="Username" v-on:keyup.enter="updateFaculty()" type="text" v-model="username"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.username" type="error">{{ errors.username[0] }}</v-alert>
                                                                                        <v-autocomplete label="Select Position" rounded filled dense :items="positions" item-value="id" item-text="pos_name" v-model="pos_id"></v-autocomplete>
                                                                                            <v-alert color="#EF9A9A" dense text v-if="errors.pos_id" type="error">{{ errors.pos_id[0] }}</v-alert>
                                                                                        <v-text-field label="Last Name" v-on:keyup.enter="updateFaculty()" type="text" v-model="lname"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.lname" type="error">{{ errors.lname[0] }}</v-alert>
                                                                                        <v-text-field label="First Name" v-on:keyup.enter="updateFaculty()" type="text" v-model="fname"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.fname" type="error">{{ errors.fname[0] }}</v-alert>
                                                                                        <v-text-field label="Middle Initital" v-on:keyup.enter="updateFaculty()" type="text" v-model="mi"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.mi" type="error">{{ errors.mi[0] }}</v-alert>
                                                                                        <v-text-field label="Birthday" v-on:keyup.enter="updateFaculty()" type="date" v-model="birthdate"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.birthdate" type="error">{{ errors.birthdate[0] }}</v-alert>
                                                                                        <v-text-field label="Home Address" v-on:keyup.enter="updateFaculty()" type="text" v-model="address"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.address" type="error">{{ errors.address[0] }}</v-alert>
                                                                                        <v-text-field label="Contact Number" v-on:keyup.enter="updateFaculty()" type="text" v-model="contact"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.contact" type="error">{{ errors.contact[0] }}</v-alert>
                                                                                        <v-text-field label="Change Password" v-on:keyup.enter="updateFaculty()" type="password" v-model="password"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" dense text v-if="errors.password" type="error">{{ errors.password[0] }}</v-alert>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearUser()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateFaculty()" v-on:click="updateFaculty()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                        <!-- Delete Faculty -->

                                        <v-icon v-on:click="clickFaculty(item)" data-toggle="modal" data-target="#deleteFacultyInfo" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteFacultyInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Information</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div style="text-align: center; font-size: 15px;"> Are you sure? </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteFaculty()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                </template>
                            </v-data-table>
                        </v-card>

    </v-container>
    </v-content>
    <Footer />
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
  name: "User",
  components: {
    'Navigation': Navigation,
    'Footer': Footer,
  },
  data: () => ({
        headers: [
        {
          text: 'Student ID',
          value: 'stu_id',
          sortable: false,
          align: 'left'
        },
        { text: 'Section', value: 'section' },
        { text: 'Last Name', value: 'lname' },
        { text: 'First Name', value: 'fname' },
        { text: 'Middle Initial', value: 'mi' },
        { text: 'Birthday', value: 'birthdate' },
        { text: 'Home Address', value: 'address' },
        { text: 'Contact Number', value: 'contact' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
        faculty_headers: [
        {
          text: 'Position',
          value: 'position',
          sortable: false,
          align: 'left'
        },
        { text: 'Last Name', value: 'lname' },
        { text: 'First Name', value: 'fname' },
        { text: 'Middle Initial', value: 'mi' },
        { text: 'Birthday', value: 'birthdate' },
        { text: 'Home Address', value: 'address' },
        { text: 'Contact Number', value: 'contact' },
        { text: 'Username', value: 'username' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
      search: '',
      faculty_search: '',
      addstudent: false,
      addfaculty: false,
      add_fname: null,
      add_mi: null,
      add_lname: null,
      add_birthdate: null,
      add_address: null,
      add_contact: null,
      add_stu_id: null,
      add_password: null,
      add_sec_id: null,
      add_faculty_fname: null,
      add_faculty_mi: null,
      add_faculty_lname: null,
      add_faculty_birthdate: null,
      add_faculty_address: null,
      add_faculty_contact: null,
      add_faculty_password: null,
      add_faculty_username: null,
      add_pos_id: null,
      username: null,
      fname: null,
      mi: null,
      lname: null,
      birthdate: null,
      address: null,
      contact: null,
      stu_id: null,
      sec_id: null,
      password: null,
      sec_code: null,
      pos_id: null,
      pos_name: null,
      id: null,
      sections: [],
      students: [],
      faculties: [],
      positions: [],
      errors: []
  }),

  created() {
    this.fetchStudent();
    // this.fetchSection();
    this.fetchFaculty();
  },

  methods: {

    // STUDENT
    fetchStudent() {
      axios.get("/admin/student/view").then(response => {
        this.students = response.data.students;
        this.sections = response.data.sections;
      });
    },

    clickStudent: function (student) {
    return (this.id = student.id, this.fname = student.fname, this.mi = student.mi, this.lname = student.lname, this.birthdate = student.birthdate,
     this.address = student.address, this.contact = student.contact, this.stu_id = student.stu_id, this.sec_id = student.sec_id);
    },

    addStudent() {
        axios.post("/admin/student/create", {fname: this.add_fname, mi: this.add_mi, lname: this.add_lname, birthdate: this.add_birthdate, address: this.add_address,
        contact: this.add_contact, stu_id: this.add_stu_id, sec_id: this.add_sec_id, password: this.add_password})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
       this.errors = error.response.data.errors;
        });
    },

    updateStudent() {
   axios.put("/admin/student/update", {id: this.id, stu_id: this.stu_id, sec_id: this.sec_id, fname: this.fname, mi: this.mi, lname: this.lname, birthdate: this.birthdate, address: this.address,
   contact: this.contact, password: this.password})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
       this.errors = error.response.data.errors;
       });

    },

    deleteStudent() {
    axios.post("/admin/student/delete", {id: this.id})
        .then(response => {
        window.location.reload()
       })
        .catch(error => {
        });
    },

    // FACULTY

    fetchFaculty() {
      axios.get("/admin/faculty/view").then(response => {
        this.faculties = response.data.faculties;
        this.positions = response.data.positions;
      });
    },

    clickFaculty: function (faculty) {
    return (this.id = faculty.id, this.fname = faculty.fname, this.mi = faculty.mi, this.lname = faculty.lname, this.birthdate = faculty.birthdate,
     this.address = faculty.address, this.contact = faculty.contact, this.username = faculty.username, this.pos_id = faculty.pos_id);
    },

    addFaculty() {
        axios.post("/admin/faculty/create", {fname: this.add_faculty_fname, mi: this.add_faculty_mi, lname: this.add_faculty_lname, birthdate: this.add_faculty_birthdate, address: this.add_faculty_address,
        contact: this.add_faculty_contact, username: this.add_faculty_username, pos_id: this.add_pos_id, password: this.add_faculty_password})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
       this.errors = error.response.data.errors;
        });
    },

    updateFaculty() {
   axios.put("/admin/faculty/update", {id: this.id, username: this.username, pos_id: this.pos_id, fname: this.fname, mi: this.mi, lname: this.lname, birthdate: this.birthdate, address: this.address,
   contact: this.contact, password: this.password})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
       this.errors = error.response.data.errors;
       });

    },

    deleteFaculty() {
    axios.post("/admin/faculty/delete", {id: this.id})
        .then(response => {
         window.location.reload()
       })
        .catch(error => {
        });
    },

    clearUser() {
        this.fname = "";
        this.mi = "";
        this.lname = "";
        this.birthdate = "";
        this.address = "";
        this.contact = "";
        this.stu_id = "";
        this.sec_id = "";
        this.pos_id = "";
        this.password = "";
        this.add_fname = "";
        this.add_mi = "";
        this.add_lname = "";
        this.add_birthdate = "";
        this.add_address = "";
        this.add_contact = "";
        this.add_stu_id = "";
        this.add_sec_id = "";
        this.add_password = "";
        this.add_faculty_fname = "";
        this.add_faculty_mi = "";
        this.add_faculty_lname = "";
        this.add_faculty_birthdate = "";
        this.add_faculty_address = "";
        this.add_faculty_contact = "";
        this.add_faculty_username = "";
        this.add_pos_id = "";
        this.add_faculty_password = "";
        this.errors = "";
    },

  },
};
</script>
