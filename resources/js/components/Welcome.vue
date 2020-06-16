<template>
  <v-app light>
    <v-content>
      <section>
        <v-parallax src="/images/hero.jpeg" height="600">
          <v-layout column align-center justify-center class="white--text">
            <img src="/images/logo_mini.png" height="200" />
            <h1 class="grey--text text--darken-4 mb-2 display-1 font-weight-medium text-center">Evaluation Management System</h1>

                                    <v-dialog width="300">
                                    <template v-slot:activator="{ on }">
                                    <v-btn class="mt-10 grey--text text--darken-4" v-on="on" rounded color="amber accent-4" style="outline: none;" dark large>Get Started</v-btn>
                                    </template>

                                    <v-card>
                                        <v-toolbar dark flat>
                                        <v-toolbar-title>Login as:</v-toolbar-title>
                                        </v-toolbar>
                                            <v-btn class="ml-6 mt-5 grey--text text--darken-4 mb-5" rounded color="amber accent-4" href="/student/login" style="text-decoration: none; outline: none;" dark large>Student</v-btn>
                                            <v-btn class="ml-6 mt-5 grey--text text--darken-4 mb-5" rounded color="amber accent-4" href="/faculty/login" style="text-decoration: none; outline: none;" dark large>Faculty</v-btn>
                                    </v-card>
                                    </v-dialog>

          </v-layout>
        </v-parallax>
      </section>

      <section>
        <v-layout column wrap class="my-12" align-center>
          <v-flex xs12 sm4 class="my-4">
            <div class="text-center">
              <h2 class="headline">The best way to start developing</h2>
              <span class="subheading">Cras facilisis mi vitae nunc</span>
            </div>
          </v-flex>
          <v-flex xs12>
            <v-container grid-list-xl>
              <v-layout row wrap align-center>
                <v-flex xs12 md4>
                  <v-card flat class="transparent">
                    <v-card-text class="text-center">
                      <v-icon x-large class="grey--text text--darken-4">mdi-palette</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline text-center">Material Design</div>
                    </v-card-title>
                    <v-card-text>
                      Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                      Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs12 md4>
                  <v-card flat class="transparent">
                    <v-card-text class="text-center">
                      <v-icon x-large class="grey--text text--darken-4">mdi-flash</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline">Fast development</div>
                    </v-card-title>
                    <v-card-text>
                      Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                      Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs12 md4>
                  <v-card flat class="transparent">
                    <v-card-text class="text-center">
                      <v-icon x-large class="grey--text text--darken-4">mdi-wrench</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline text-center">Completely Open Sourced</div>
                    </v-card-title>
                    <v-card-text>
                      Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                      Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                    </v-card-text>
                  </v-card>
                </v-flex>
              </v-layout>
            </v-container>
          </v-flex>
        </v-layout>
      </section>

      <section>
        <v-parallax src="/images/section.jpg" height="380">
          <v-layout column align-center justify-center>
            <div class="headline white--text mb-4 text-center">Web development has never been easier</div>
            <em>Kick-start your application today</em>

                                    <v-dialog width="300">
                                    <template v-slot:activator="{ on }">
                                    <v-btn class="mt-10 grey--text text--darken-4" v-on="on" rounded color="amber accent-4" style="outline: none;" dark large>Get Started</v-btn>
                                    </template>

                                    <v-card>
                                        <v-toolbar dark flat>
                                        <v-toolbar-title>Login as:</v-toolbar-title>
                                        </v-toolbar>
                                            <v-btn class="ml-6 mt-5 grey--text text--darken-4 mb-5" rounded color="amber accent-4" href="/student/login" style="text-decoration: none; outline: none;" dark large>Student</v-btn>
                                            <v-btn class="ml-6 mt-5 grey--text text--darken-4 mb-5" rounded color="amber accent-4" href="/faculty/login" style="text-decoration: none; outline: none;" dark large>Faculty</v-btn>
                                    </v-card>
                                    </v-dialog>
          </v-layout>
        </v-parallax>
      </section>

      <section>
        <v-container grid-list-xl>
          <v-layout row wrap justify-center class="my-12">
            <v-flex xs12 sm4>
              <v-card flat class="transparent">
                <v-card-title primary-title class="layout justify-center">
                  <div class="headline">Company info</div>
                </v-card-title>
                <v-card-text>
                  Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                  Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                  Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12 sm4 offset-sm1>
              <v-card flat class="transparent">
                <v-card-title primary-title class="layout justify-center">
                  <div class="headline">Contact us</div>
                </v-card-title>
                <v-card-text>Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.</v-card-text>
                <v-list class="transparent">
                  <v-list-item>
                    <v-list-item-action>
                      <v-icon class="grey--text text--darken-4">mdi-phone</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>000-000-0000</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                  <v-list-item>
                    <v-list-item-action>
                      <v-icon class="grey--text text--darken-4">mdi-map-marker</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>Blank, Blank</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                  <v-list-item>
                    <v-list-item-action>
                      <v-icon class="grey--text text--darken-4">mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>blank@blank.com</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </section>



    <v-footer>
      <div>EMS &copy; {{ new Date().getFullYear() }}</div>
    </v-footer>
    </v-content>
  </v-app>
</template>


<script>
export default {

}
</script>
