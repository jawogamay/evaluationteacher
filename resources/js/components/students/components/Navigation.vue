<template>
  <div data-app>
    <v-navigation-drawer v-model="drawer" app>
        <div style="background-color: #0277BD">
      <v-list dense dark>
        <v-menu transition="slide-x-transition" offset-y>
          <template v-slot:activator="{ on }">
            <v-list-item v-on="on">
              <v-list-item-avatar size="40">
                <v-icon size="35">mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content class="ml-3">
                <v-list-item-title style="font-family: 'Roboto', sans-serif; font-size: 15px; font-weight:350;">{{ student.fname }} {{ student.mi }} {{ student.lname }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>

          <v-list>
            <!-- Profile Model -->
            <v-dialog v-model="profile" persistent width="400">
              <template v-slot:activator="{ on }">
                <v-list-item v-on="on" link>
                  <v-list-item-action>
                    <v-icon>mdi-card-account-details</v-icon>
                  </v-list-item-action>
                  <v-list-item-content class="ml-4">
                    <v-list-item-title>Profile</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </template>

              <v-card>
                <v-toolbar color="#0277BD" dark flat>
                  <v-toolbar-title>Profile Information</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-list-item three-line>
                    <v-list-item-content>
                      <v-list-item-title class="headline font-regular mt-4 mb-2">
                        {{ student.fname }} {{ student.mi }} {{ student.lname }}
                        <!-- Edit Info Model -->
                        <v-dialog persistent scrollable v-model="editinfo" width="500">
                          <template v-slot:activator="{ on }">
                            <v-icon v-on:click="clickStudent(student)" v-on="on" small>mdi-pencil</v-icon>
                          </template>

                          <v-card>
                            <v-toolbar color="#0277BD" dark flat>
                              <v-toolbar-title>Edit Information</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text class="mt-5">
                              <v-form>
                                <v-text-field label="First Name" type="text" v-on:keyup.enter="editInfo()" v-model="fname"></v-text-field>
                                <v-text-field label="Middle Initial" type="text" v-on:keyup.enter="editInfo()" v-model="mi"></v-text-field>
                                <v-text-field label="Last Name" type="text" v-on:keyup.enter="editInfo()" v-model="lname"></v-text-field>
                                <v-text-field label="Birthday" type="date" v-on:keyup.enter="editInfo()" v-model="birthdate"></v-text-field>
                                <v-text-field label="Home Address" type="text" v-on:keyup.enter="editInfo()" v-model="address"></v-text-field>
                                <v-text-field label="Contact" type="text" v-on:keyup.enter="editInfo()" v-model="contact"></v-text-field>
                                <v-text-field label="Student ID" type="text" v-on:keyup.enter="editInfo()" v-model="stu_id"></v-text-field>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn style="outline: none;" text @click="editinfo = false">Cancel</v-btn>
                              <v-btn style="outline: none;" text v-on:keyup.enter="editInfo()" v-on:click="editInfo()">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-list-item-title>
                      <v-list-item-subtitle class="mb-2">
                        Student ID: {{ student.stu_id }}
                      </v-list-item-subtitle>
                      <v-list-item-subtitle class="mb-2">
                        Birthday: {{ student.birthdate }}
                      </v-list-item-subtitle>
                      <v-list-item-subtitle class="mb-2">
                        Home Address: {{ student.address }}
                      </v-list-item-subtitle>
                      <v-list-item-subtitle class="mb-2">
                        Contact: {{ student.contact }}
                      </v-list-item-subtitle>

                      <!-- Edit Password Model -->
                    </v-list-item-content>

                    <v-icon size="80">mdi-account-box</v-icon>
                  </v-list-item>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn style="outline: none;" text v-on:keyup.enter="profile = false" @click="profile = false">Ok</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>

            <v-list-item @click.prevent="logout" link>
              <v-list-item-action>
                <v-icon>mdi-logout</v-icon>
              </v-list-item-action>
              <v-list-item-content class="ml-4">
                <v-list-item-title>Logout</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

        </v-menu>
      </v-list>
        </div>

      <v-list nav dense>
          <v-list-item :href="item.link" style="text-decoration:none;" v-for="(item, i) in items" :key="i">
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content class="ml-4">
              <v-list-item-title style="font-family: 'Roboto', sans-serif; font-size: 15px; font-weight:300;" v-text="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar color="#0288D1" app dark>
      <v-app-bar-nav-icon style="outline: none;" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Student</v-toolbar-title>
    </v-app-bar>

  </div>
</template>

<script>
export default {
  name: "Navigation",
  props: ["student"],
  data: () => ({
      items: [
        { text: 'Home', icon: 'mdi-home', link:'/student/home' },
        { text: 'Evaluation', icon: 'mdi-file', link:'/student/evaluation' }
      ],
    drawer: null,
    profile: false,
    editinfo: false,
    fname: null,
    mi: null,
    lname: null,
    birthdate: null,
    address: null,
    contact: null,
    stu_id: null
  }),

  methods: {
    logout() {
      axios
        .post("logout")
        .then(function(response) {
          window.location.reload();
        })
        .catch(function(response) {});
    },

    clickStudent: function(student) {
      return (
        (this.fname = student.fname),
        (this.mi = student.mi),
        (this.lname = student.lname),
        (this.birthdate = student.birthdate),
        (this.address = student.address),
        (this.contact = student.contact),
        (this.stu_id = student.stu_id)
      );
    },

    editInfo() {
      axios
        .put("/student/info", { fname: this.fname, mi: this.mi, lname: this.lname, birthdate: this.birthdate, address: this.address, contact: this.contact, stu_id: this.stu_id })
        .then(response => {
          window.location.reload();
        })
        .catch(error => {});
    }
  }
};
</script>
