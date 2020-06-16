<template>
  <div id="app">
    <router-view />
    <Navigation :faculty="faculty" />
    <v-content>
        <h3 class="mt-5" style="color:#212121; font-family: 'Roboto', sans-serif; text-align: center; font-weight:100;">My Rating</h3>
        <form @submit.prevent="getMyAverage()">
        <select class="form-control" v-model="form_rate">
            <option v-for="evaluatedData in evaluatedDate" :key="evaluatedData.id" :value="evaluatedData.form_id">{{evaluatedData.evaluateform.title}}</option>
        </select>
        <br>
        <button class="btn btn-primary" type="submit">Get My Average Rate</button>
        </form>
        You Average Rating is: {{myAverage}}
        <img src="https://media.tenor.com/images/c674ba98c40f6793eaf10a1356c1c36a/tenor.gif" v-show="myAverage>=3">
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
  name: "Rating",
  components: {
    Navigation: Navigation,
    Footer: Footer
  },
  data(){
      return{
        evaluatedDate:[],
        form_rate:'',
        myAverage:0
      }
  },
  mounted(){
      this.getTeacherEvaluation()
  },
  methods:{
      getTeacherEvaluation(){
          axios.get('/faculty/getTeacherEvaluation').then(({data}) => this.evaluatedDate = data)
      },
      getMyAverage(){
          axios.get('/faculty/averageRate/'+this.form_rate).then(({data}) => this.myAverage = data)
      }
  }
};
</script>
