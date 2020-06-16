<template>
  <div id="app">
    <router-view />
    <Navigation :faculty="faculty" />
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
    faculty: {
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
