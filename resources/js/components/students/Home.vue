<template>
  <div id="app">
    <router-view />
    <Navigation :student="student" />
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">News Feed</h3>

    </v-content>
    <Footer />
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
  name: "Home",
  components: {
    Navigation: Navigation,
    Footer: Footer
  }
};
</script>
