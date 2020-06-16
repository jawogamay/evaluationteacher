<template>
  <v-app id="inspire">
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="teal darken-4" dark flat>
                <v-toolbar-title>Faculty Login Form</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                    <v-alert v-if="errors.username" dense text type="error">{{ errors.username[0] }}</v-alert>
                    <v-alert v-if="errors.password" dense text type="error">{{ errors.password[0] }}</v-alert>
                <v-form>
                  <v-text-field label="Username" name="username" color="teal darken-4" prepend-icon="mdi-account" type="text" v-on:keyup.enter="login()" v-model="username"></v-text-field>
                  <v-text-field id="password" color="teal darken-4" label="Password" name="password" prepend-icon="mdi-lock" type="password" v-on:keyup.enter="login()" v-model="password"></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="teal darken-4 mr-5 mb-5" style="outline: none;" v-on:keyup.enter="login()" v-on:click="login()" dark>Login</v-btn>
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
        username: null,
        password: null,
        errors: []
    };
  },
  methods: {
    login() {
   axios
   .post("/faculty/login", {username: this.username, password: this.password})
   .then(response => {
                location.reload();
       })
   .catch(error => {
        this.errors = error.response.data.errors;
       });
    }
  }
};
</script>
