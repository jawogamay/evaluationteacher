<template>
  <div id="app">
    <router-view />
    <Navigation :admin="admin"/>
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">School</h3>
    <v-container>
                <v-row class="mt-3" justify="center">
                        <!-- CREATE DEPARMENT -->
                        <v-dialog persistent v-model="adddepartment" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearInfo()" depressed small v-on="on" style="outline:none;">Create Department</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Department Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Code" v-on:keyup.enter="addDepartment()" type="text" v-model="add_dept_code"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.dept_code" type="error">{{ errors.dept_code[0] }}</v-alert>
                                <v-text-field label="Name" v-on:keyup.enter="addDepartment()" type="text" v-model="add_dept_name"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.dept_name" type="error">{{ errors.dept_name[0] }}</v-alert>
                                <v-text-field label="Description" v-on:keyup.enter="addDepartment()" type="text" v-model="add_dept_desc"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.dept_desc" type="error">{{ errors.dept_desc[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="adddepartment = false" v-on:click="clearInfo()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addDepartment()" text v-on:click="addDepartment()">Create</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>


                    <!-- DEPARTMENT TABLE -->

                        <v-card class="mt-3 mx-auto" width="800">
                            <v-card-title>
                                Departments
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table :headers="headers" :search="search" :items-per-page="5" :items="departments" class="elevation-1">

                                <template v-slot:item.actions="{item}">

                                         <!-- Update Department -->

                                        <v-icon v-on:click="clickDepartment(item)" data-toggle="modal" data-target="#updateDepartmentInfo" small class="ml-4">mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateDepartmentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Department Info</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearInfo()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-text-field label="Code" v-on:keyup.enter="updateDepartment()" type="text" v-model="dept_code"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" text="#D50000" v-if="errors.dept_code" type="error">{{ errors.dept_code[0] }}</v-alert>
                                                                                        <v-text-field label="Name" v-on:keyup.enter="updateDepartment()" type="text" v-model="dept_name"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" text="#D50000" v-if="errors.dept_name" type="error">{{ errors.dept_name[0] }}</v-alert>
                                                                                        <v-text-field label="Description" v-on:keyup.enter="updateDepartment()" type="text" v-model="dept_desc"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" text="#D50000" v-if="errors.dept_desc" type="error">{{ errors.dept_desc[0] }}</v-alert>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearInfo()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateDepartment()" v-on:click="updateDepartment()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                        <!-- Delete Department -->

                                        <v-icon v-on:click="clickDepartment(item)" data-toggle="modal" data-target="#deleteDepartmentInfo" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteDepartmentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteDeparmtent()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                </template>

                            </v-data-table>
                    </v-card>


                <v-row class="mt-5" justify="center">

                        <!-- CREATE FACULTY POSITION -->

                        <v-dialog persistent v-model="addposition" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearInfo()" depressed small v-on="on" style="outline:none;">Create Faculty Position</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Position Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Position Name" v-on:keyup.enter="addPosition()" type="text" v-model="add_pos_name"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.pos_name" type="error">{{ errors.pos_name[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addposition = false" v-on:click="clearInfo()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addPosition()" text v-on:click="addPosition()">Create</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>

                      <!-- POSITION TABLE -->

                        <v-card class="mt-3 mx-auto" width="800">
                            <v-card-title>
                                Faculty Positions
                            <v-spacer></v-spacer>
                            <v-text-field v-model="position_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table :headers="position_headers" :search="position_search" :items-per-page="5" :items="positions" class="elevation-1">

                                <template v-slot:item.actions="{item}">

                                         <!-- Update Position -->

                                        <v-icon v-on:click="clickPosition(item)" data-toggle="modal" data-target="#updatePositionInfo" small class="ml-4">mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updatePositionInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Position Info</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearInfo()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                            <v-text-field label="Code" v-on:keyup.enter="updatePosition()" type="text" v-model="pos_name"></v-text-field>
                                                                                                    <v-alert color="#EF9A9A" text="#D50000" v-if="errors.pos_name" type="error">{{ errors.pos_name[0] }}</v-alert>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearInfo()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updatePosition()" v-on:click="updatePosition()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                        <!-- Delete Position -->

                                        <v-icon v-on:click="clickPosition(item)" data-toggle="modal" data-target="#deletePositionInfo" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deletePositionInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deletePosition()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                </template>

                            </v-data-table>
                    </v-card>



                      <v-row class="mt-5" justify="center">

                        <!-- CREATE STUDENT SECTION -->

                        <v-dialog persistent v-model="addsection" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearInfo()" depressed small v-on="on" style="outline:none;">Create Student Section</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Section Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Section Code" v-on:keyup.enter="addSection()" type="text" v-model="add_sec_code"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.sec_code" type="error">{{ errors.sec_code[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addsection = false" v-on:click="clearInfo()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addSection()" text v-on:click="addSection()">Create</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>




                      <!-- SECTION TABLE -->

                        <v-card class="mt-3 mx-auto" width="800">
                            <v-card-title>
                                Student Sections
                            <v-spacer></v-spacer>
                            <v-text-field v-model="section_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table :headers="section_headers" :search="section_search" :items-per-page="5" :items="sections" class="elevation-1">

                                <template v-slot:item.actions="{item}">
                                         <!-- Update Section -->

                                        <v-icon v-on:click="clickSection(item)" data-toggle="modal" data-target="#updateSectionInfo" small class="ml-4">mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateSectionInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Section Info</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearInfo()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-text-field label="Code" v-on:keyup.enter="updateSection()" type="text" v-model="sec_code"></v-text-field>
                                                                                                <v-alert color="#EF9A9A" text="#D50000" v-if="errors.sec_code" type="error">{{ errors.sec_code[0] }}</v-alert>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearInfo()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateSection()" v-on:click="updateSection()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                        <!-- Delete Section -->

                                        <v-icon v-on:click="clickSection(item)" data-toggle="modal" data-target="#deleteSectionInfo" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteSectionInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteSection()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                </template>

                            </v-data-table>
                    </v-card>



                      <v-row class="mt-5" justify="center">

                        <!-- CREATE ACADEMIC YEAR -->

                        <v-dialog persistent v-model="addacademic" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearInfo()" depressed small v-on="on" style="outline:none;">Create Academic Year</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Academic Year Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Start of Year" v-on:keyup.enter="addAcademic()" type="text" v-model="add_year_start"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.year_start" type="error">{{ errors.year_start[0] }}</v-alert>
                                <v-text-field label="End of Year" v-on:keyup.enter="addAcademic()" type="text" v-model="add_year_end"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.year_end" type="error">{{ errors.year_end[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addacademic = false" v-on:click="clearInfo()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addAcademic()" text v-on:click="addAcademic()">Create</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>




                      <!-- ACADEMIC TABLE -->

                        <v-card class="mt-3 mx-auto" width="800">
                            <v-card-title>
                                Academic Year
                            <v-spacer></v-spacer>
                            <v-text-field v-model="academic_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table :headers="academic_headers" :search="academic_search" :items-per-page="5" :items="academic_years" class="elevation-1">

                                  <template v-slot:item.actions="{item}">
                                         <!-- Update Academic -->

                                        <v-icon v-on:click="clickAcademic(item)" data-toggle="modal" data-target="#updateAcademicYear" small class="ml-4">mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateAcademicYear" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Academic Year</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearInfo()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-form>
                                                                                            <v-text-field label="Start of Year" v-on:keyup.enter="updateAcademic()" type="text" v-model="year_start"></v-text-field>
                                                                                                    <v-alert color="#EF9A9A" text="#D50000" v-if="errors.year_start" type="error">{{ errors.year_start[0] }}</v-alert>
                                                                                            <v-text-field label="End of Year" v-on:keyup.enter="updateAcademic()" type="text" v-model="year_end"></v-text-field>
                                                                                                    <v-alert color="#EF9A9A" text="#D50000" v-if="errors.year_end" type="error">{{ errors.year_end[0] }}</v-alert>
                                                                                        </v-form>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearInfo()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateAcademic()" v-on:click="updateAcademic()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                        <!-- Delete Academic -->

                                        <v-icon v-on:click="clickAcademic(item)" data-toggle="modal" data-target="#deleteAcademic" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteAcademic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Academic Year</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div style="text-align: center; font-size: 15px;"> Are you sure? </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteAcademic()">Delete</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                </template>



                            </v-data-table>
                    </v-card>







                      <v-row class="mt-5" justify="center">

                        <!-- CREATE SEMESTER -->

                        <v-dialog persistent v-model="addsemester" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn class="font-weight-light mx-auto" v-on:click="clearInfo()" depressed small v-on="on" style="outline:none;">Create Semester</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar flat>
                              <v-toolbar-title>Semester Form</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                              <v-form>
                                <v-text-field label="Semester Name" v-on:keyup.enter="addSemester()" type="text" v-model="add_sem_name"></v-text-field>
                                        <v-alert color="#EF9A9A" text="#D50000" v-if="errors.sem_name" type="error">{{ errors.sem_name[0] }}</v-alert>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="addsemester = false" v-on:click="clearInfo()">Cancel</v-btn>
                              <v-btn style="outline: none;" v-on:keyup.enter="addSemester()" text v-on:click="addSemester()">Create</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                    </v-row>




                      <!-- SEMESTER TABLE -->

                        <v-card class="mt-3 mx-auto" width="800">
                            <v-card-title>
                                Semester
                            <v-spacer></v-spacer>
                            <v-text-field v-model="semester_search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>


                            <v-data-table :headers="semester_headers" :search="semester_search" :items-per-page="5" :items="semesters" class="elevation-1">

                                  <template v-slot:item.actions="{item}">
                                         <!-- Update SEMESTER -->

                                        <v-icon v-on:click="clickSemester(item)" data-toggle="modal" data-target="#updateSemester" small class="ml-4">mdi-pencil</v-icon>

                                                            <div class="modal fade" id="updateSemester" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Semester</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;"  @click="clearInfo()" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <v-form>
                                                                                            <v-text-field label="Semester Name" v-on:keyup.enter="updateSemester()" type="text" v-model="sem_name"></v-text-field>
                                                                                                    <v-alert color="#EF9A9A" text="#D50000" v-if="errors.sem_name" type="error">{{ errors.sem_name[0] }}</v-alert>
                                                                                        </v-form>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="clearInfo()">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" v-on:keyup.enter="updateSemester()" v-on:click="updateSemester()">Save Changes</v-btn>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                        <!-- Delete SEMESTER -->

                                        <v-icon v-on:click="clickSemester(item)" data-toggle="modal" data-target="#deleteSemester" small class="ml-1">mdi-delete</v-icon>

                                                            <div class="modal fade" id="deleteSemester" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Semester</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" style="outline: none;" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div style="text-align: center; font-size: 15px;"> Are you sure? </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal">Cancel</v-btn>
                                                                                <v-btn depressed style="outline: none;" data-dismiss="modal" v-on:click="deleteSemester()">Delete</v-btn>
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
  name: "School",
  components: {
    'Navigation': Navigation,
    'Footer': Footer,
  },
   data: () => ({
      search: '',
      position_search: '',
      section_search: '',
      academic_search: '',
      semester_search: '',
        headers: [
        {
          text: 'Department Code',
          value: 'dept_code',
          sortable: false,
          align: 'left'
        },
        { text: 'Department Name', value: 'dept_name' },
        { text: 'Department Description', value: 'dept_desc' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
      adddepartment: false,
      dept_code: null,
      dept_name: null,
      dept_desc: null,
      add_dept_code: null,
      add_dept_name: null,
      add_dept_desc: null,
      departments: [],
        position_headers: [
        {
          text: 'Position Name',
          value: 'pos_name',
          sortable: false,
          align: 'left'
        },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
      addposition: false,
      pos_name: null,
      add_pos_name: null,
      positions: [],
        section_headers: [
        {
          text: 'Section Code',
          value: 'sec_code',
          sortable: false,
          align: 'left'
        },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
      addsection: false,
      sec_code: null,
      add_sec_code: null,
      sections: [],
        academic_headers: [
        {
          text: 'Start of Year',
          value: 'year_start',
          sortable: false,
          align: 'left'
        },
        { text: 'End of Year', value: 'year_end' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
        addacademic: false,
        add_year_start: null,
        add_year_end: null,
        year_start: null,
        year_end: null,
        academic_years: [],
        semester_headers: [
        {
          text: 'Semester Name',
          value: 'sem_name',
          sortable: false,
          align: 'left'
        },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false }
        ],
        addsemester: false,
        add_sem_name: null,
        sem_name: null,
        semesters: [],
        errors: []
  }),

  created() {
    this.fetchSchool();
  },

  methods: {

    //   DEPARTMENT

    fetchSchool() {
      axios.get("/admin/school/view").then(response => {
        this.departments = response.data.departments;
        this.positions = response.data.positions;
        this.sections = response.data.sections;
        this.academic_years = response.data.academic_years;
        this.semesters = response.data.semesters;
      });
    },

    addDepartment() {
        axios.post("/admin/department/create", {dept_code: this.add_dept_code, dept_name: this.add_dept_name, dept_desc: this.add_dept_desc})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    clickDepartment: function (department) {
    return (this.id = department.id, this.dept_code = department.dept_code, this.dept_name = department.dept_name, this.dept_desc = department.dept_desc);
    },

    updateDepartment() {
   axios.put("/admin/department/update", {id: this.id, dept_code: this.dept_code, dept_name: this.dept_name, dept_desc: this.dept_desc})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deleteDeparmtent() {
    axios.post("/admin/department/delete", {id: this.id})
        .then(response => {
        window.location.reload()
       })
        .catch(error => {
        });
    },

    // POSITION

    addPosition() {
        axios.post("/admin/position/create", {pos_name: this.add_pos_name})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    clickPosition: function (position) {
    return (this.id = position.id, this.pos_name = position.pos_name);
    },

    updatePosition() {
   axios.put("/admin/position/update", {id: this.id, pos_name: this.pos_name})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deletePosition() {
    axios.post("/admin/position/delete", {id: this.id})
        .then(response => {
        window.location.reload()
       })
        .catch(error => {
        });
    },

    // SECTION

    addSection() {
        axios.post("/admin/section/create", {sec_code: this.add_sec_code})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    clickSection: function (section) {
    return (this.id = section.id, this.sec_code = section.sec_code);
    },

    updateSection() {
   axios.put("/admin/section/update", {id: this.id, sec_code: this.sec_code})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deleteSection() {
    axios.post("/admin/section/delete", {id: this.id})
        .then(response => {
        window.location.reload()
       })
        .catch(error => {
        });
    },

    // ACADEMIC

    addAcademic() {
        axios.post("/admin/academic/create", {year_start: this.add_year_start, year_end: this.add_year_end})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    clickAcademic: function (academic) {
    return (this.id = academic.id, this.year_start = academic.year_start, this.year_end = academic.year_end);
    },

    updateAcademic() {
   axios.put("/admin/academic/update", {id: this.id, year_start: this.year_start, year_end: this.year_end})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deleteAcademic() {
    axios.post("/admin/academic/delete", {id: this.id})
        .then(response => {
        window.location.reload()
       })
        .catch(error => {
        });
    },

    // SEMESTER

    addSemester() {
        axios.post("/admin/semester/create", {sem_name: this.add_sem_name})
        .then(response => {
        window.location.reload()
        })
        .catch(error => {
        this.errors = error.response.data.errors;
        });
    },

    clickSemester: function (semester) {
    return (this.id = semester.id, this.sem_name = semester.sem_name);
    },

    updateSemester() {
   axios.put("/admin/semester/update", {id: this.id, sem_name: this.sem_name})
   .then(response => {
         window.location.reload()
   })
    .catch(error => {
        this.errors = error.response.data.errors;
       });

    },

    deleteSemester() {
    axios.post("/admin/semester/delete", {id: this.id})
        .then(response => {
        window.location.reload()
       })
        .catch(error => {
        });
    },

    clearInfo() {
      this.add_dept_code = "";
      this.add_dept_name = "";
      this.add_dept_desc = "";
      this.dept_code = "";
      this.dept_name = "";
      this.dept_desc = "";
      this.pos_name = "";
      this.add_pos_name = "";
      this.sec_code = "";
      this.add_sec_code = "";
      this.add_year_start = "";
      this.add_year_end = "";
      this.year_start = "";
      this.year_end = "";
      this.errors = "";
    }

  }
};
</script>
