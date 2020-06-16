<template>
  <div data-app>
    <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-menu transition="slide-x-transition" offset-y>
          <template v-slot:activator="{ on }">
            <v-list-item v-on="on">
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content class="ml-2">
                <v-list-item-title>{{ admin.fname }} {{ admin.lname }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>

          <v-list>
            <!-- Profile Model -->
            <v-dialog persistent v-model="profile" width="400">
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
                <v-toolbar color="grey darken-3" dark flat>
                  <v-toolbar-title>Profile Information</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-list-item three-line>
                    <v-list-item-content>
                      <v-list-item-title class="headline font-regular mt-4 mb-2">
                        {{ admin.fname }} {{ admin.lname }}
                        <!-- Edit Name Model -->
                        <v-dialog persistent v-model="editinfo" width="500">
                          <template v-slot:activator="{ on }">
                            <v-icon v-on:click="clickAdmin(admin)" v-on="on" small>mdi-pencil</v-icon>
                          </template>

                          <v-card>
                            <v-toolbar color="grey darken-3" dark flat>
                              <v-toolbar-title>Edit Name</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text class="mt-5">
                              <v-form>
                                <v-text-field
                                  label="First Name"
                                  type="text"
                                  v-on:keyup.enter="editInfo()"
                                  v-model="fname"
                                ></v-text-field>
                                <v-text-field
                                  label="Last Name"
                                  type="text"
                                  v-on:keyup.enter="editInfo()"
                                  v-model="lname"
                                ></v-text-field>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn
                                color="grey darken-3"
                                style="outline: none;"
                                text
                                @click="editinfo = false"
                              >Cancel</v-btn>
                              <v-btn
                                color="grey darken-3"
                                style="outline: none;"
                                text
                                v-on:keyup.enter="editInfo()"
                                v-on:click="editInfo()"
                              >Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-list-item-title>
                      <v-list-item-subtitle class="title font-weight-light mb-3">
                        Username: {{ admin.username }}
                        <!-- Edit Username Model -->
                        <v-dialog persistent v-model="changeusername" width="500">
                          <template v-slot:activator="{ on }">
                            <v-icon v-on:click="clickAdmin(admin)" v-on="on" small>mdi-pencil</v-icon>
                          </template>

                          <v-card>
                            <v-toolbar color="grey darken-3" dark flat>
                              <v-toolbar-title>Change Username</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text class="mt-5">
                              <v-form>
                                <v-text-field
                                  label="Username"
                                  v-on:keyup.enter="changeUsername()"
                                  prepend-icon="mdi-account"
                                  type="text"
                                  v-model="username"
                                ></v-text-field>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn
                                color="grey darken-3"
                                style="outline: none;"
                                text
                                @click="changeusername = false"
                              >Cancel</v-btn>
                              <v-btn
                                color="grey darken-3"
                                style="outline: none;"
                                text
                                v-on:keyup.enter="changeUsername()"
                                v-on:click="changeUsername()"
                              >Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-list-item-subtitle>

                      <!-- Edit Password Model -->
                      <v-list-item-subtitle>
                        <v-dialog persistent v-model="changepassword" width="500">
                          <template v-slot:activator="{ on }">
                            <v-btn
                              v-on:click="clickAdmin(admin)"
                              class="font-weight-light"
                              depressed
                              small
                              v-on="on"
                              style="outline:none;"
                            >Change Password</v-btn>
                          </template>

                          <v-card>
                            <v-toolbar color="grey darken-3" dark flat>
                              <v-toolbar-title>Change Password</v-toolbar-title>
                            </v-toolbar>

                            <v-card-text class="mt-5">
                              <v-form>
                                <v-text-field
                                  label="New Password"
                                  v-on:keyup.enter="changePassword()"
                                  prepend-icon="mdi-lock"
                                  type="password"
                                  v-model="password"
                                ></v-text-field>
                                <v-text-field
                                  label="Confirm Password"
                                  v-on:keyup.enter="changePassword()"
                                  prepend-icon="mdi-lock-check"
                                  type="password"
                                  v-model="password_confirmation"
                                ></v-text-field>
                              </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn
                                color="grey darken-3"
                                style="outline: none;"
                                text
                                @click="changepassword = false"
                              >Cancel</v-btn>
                              <v-btn
                                color="grey darken-3"
                                style="outline: none;"
                                v-on:keyup.enter="changePassword()"
                                text
                                v-on:click="changePassword()"
                              >Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-list-item-subtitle>
                    </v-list-item-content>

                    <v-icon size="80">mdi-account-box</v-icon>
                  </v-list-item>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="grey darken-3"
                    style="outline: none;"
                    text
                    v-on:keyup.enter="profile = false"
                    @click="profile = false"
                  >Ok</v-btn>
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

      <v-divider></v-divider>

      <v-list nav dense>
          <v-list-item :href="item.link" style="text-decoration:none;" v-for="(item, i) in items" :key="i">
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content class="ml-4">
              <v-list-item-title v-text="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar color="grey darken-4" app clipped-left dark>
      <v-app-bar-nav-icon style="outline: none;" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Evaluation Management System</v-toolbar-title>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  name: "Navigation",
  props: ["admin"],
  data: () => ({
      items: [
        { text: 'Dashboard', icon: 'mdi-view-dashboard', link:'/admin/home' },
        { text: 'User Table', icon: 'mdi-account-multiple-plus', link:'/admin/user' },
        { text: 'Evaluation', icon: 'mdi-clipboard-outline', link:'/admin/evaluation' },
        { text: 'School', icon: 'mdi-home-city', link:'/admin/school' },
      ],
    drawer: null,
    profile: false,
    editinfo: false,
    changeusername: false,
    changepassword: false,
    fname: null,
    lname: null,
    username: null,
    password: null,
    password_confirmation: null
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

    clickAdmin: function(admin) {
      return (
        (this.fname = admin.fname),
        (this.lname = admin.lname),
        (this.username = admin.username)
      );
    },

    editInfo() {
      axios
        .put("/admin/info", { fname: this.fname, lname: this.lname })
        .then(response => {
          window.location.reload();
        })
        .catch(error => {});
    },

    changeUsername() {
      axios
        .put("/admin/username", { username: this.username })
        .then(response => {
          window.location.reload();
        })
        .catch(error => {});
    },

    changePassword() {
      axios
        .put("/admin/password", {
          password: this.password,
          password_confirmation: this.password_confirmation
        })
        .then(response => {
          window.location.reload();
        })
        .catch(error => {});
    }
  }
};
</script>
