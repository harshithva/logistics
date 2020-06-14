<template>
  <fragment>
    <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage" :color="color"></loading>
    <Sidebar></Sidebar>
    <Main></Main>
  </fragment>
</template>

<script>
import Sidebar from "./Sidebar";
import Main from "./Main";
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  data() {
    return {
      fullPage: true,
      color: "#4e73df"
    };
  },
  components: {
    Main,
    Sidebar,
    Loading
  },
  computed: {
    isLoading() {
      return this.$store.getters.getIsLoading;
    }
  }
};
</script>