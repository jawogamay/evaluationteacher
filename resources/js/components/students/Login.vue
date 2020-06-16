<template>
  <v-app id="inspire">
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="light-blue darken-3" dark flat>
                <v-toolbar-title>Student Login Form</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                    <v-alert v-if="errors.stu_id" dense text type="error">{{ errors.stu_id[0] }}</v-alert>
                    <v-alert v-if="errors.password" dense text type="error">{{ errors.password[0] }}</v-alert>
                <v-form>
                  <v-text-field label="Student ID" name="stu_id" color="light-blue darken-3" prepend-icon="mdi-account" type="text" v-on:keyup.enter="login()" v-model="stu_id"></v-text-field>
                  <v-text-field id="password" color="light-blue darken-3" label="Password" name="password" prepend-icon="mdi-lock" type="password" v-on:keyup.enter="login()" v-model="password"></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="light-blue darken-3 mr-5 mb-5" style="outline: none;" v-on:keyup.enter="login()" v-on:click="login()" dark>Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
        stu_id: null,
        password: null,
        errors: []
    };
  },
  methods: {
    login() {
   axios
   .post("/student/login", {stu_id: this.stu_id, password: this.password})
   .then(response => {
       window.location.replace("/student/home");
       })
   .catch(error => {
       this.errors = error.response.data.errors;
       });
    }
  }
};
</script>
