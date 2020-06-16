<template>
  <div id="app">
    <router-view />
    <Navigation :admin="admin" />
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">Dashboard</h3>
      <v-container>

        <v-row class="mt-4 ml-3" justify="center">

          <v-col cols="12" sm="6" lg="3">
            <v-card class="elevation-4 mx-auto" height="200" width="400">
              <v-row class="fill-height" align="center" justify="center">
                    <v-card class="elevation-4" color="#FFAB00" height="100" width="100">
                        <v-icon color="#FFF8E1" class="mt-4 pl-4" size="50">mdi-account</v-icon>
                    </v-card>
                    <div style="position:absolute; top: 8px; right:16px; font-size: 20px;">Students</div>
              </v-row>
            </v-card>
          </v-col>

          <v-col cols="12" sm="6" lg="3">
            <v-card class="elevation-4 mx-auto" height="200" width="400">
              <v-row class="fill-height" align="center" justify="center">
                    <v-card class="elevation-4" color="#EEEEEE" height="100" width="100">
                        <v-icon color="#212121" class="mt-4 pl-4" size="50">mdi-account-tie</v-icon>
                    </v-card>
                    <div style="position:absolute; top: 8px; right:16px; font-size: 20px;">Faculties</div>
              </v-row>
            </v-card>
          </v-col>

          <v-col cols="12" sm="6" lg="3">
            <v-card class="elevation-4 mx-auto" height="200" width="400">
              <v-row class="fill-height" align="center" justify="center">
                    <v-card class="elevation-4" color="#00B0FF" height="100" width="100">
                        <v-icon color="#FFF8E1" class="mt-4 pl-4" size="50">mdi-file-check</v-icon>
                    </v-card>
                    <div style="position:absolute; top: 8px; right:16px; font-size: 20px;">Evaluation Results</div>
              </v-row>
            </v-card>
          </v-col>

          <v-col cols="12" sm="6" lg="3">
            <v-card class="elevation-4 mx-auto" height="200" width="400">
              <v-row class="fill-height" align="center" justify="center">
                    <v-card class="elevation-4" color="#00E676" height="100" width="100">
                        <v-icon color="#FFF8E1" class="mt-4 pl-4" size="50">mdi-home-account</v-icon>
                    </v-card>
                    <div style="position:absolute; top: 8px; right:16px; font-size: 20px;">Departments</div>
              </v-row>
            </v-card>
          </v-col>

        </v-row>
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
  name: "Dashboard",
  components: {
    Navigation: Navigation,
    Footer: Footer
  }
};
</script>
