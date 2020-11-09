<template>
  <fragment
    v-if="
      this.$store.getters.getUserData.user.role == 'admin' ||
      this.$store.getters.getUserData.user.role == 'employee'
    "
  >
    <Sidebar></Sidebar>
    <Main></Main>
  </fragment>
</template>

<script>
import Sidebar from "./Sidebar";
import Main from "./Main";

// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  data() {
    return {
      fullPage: true,
      color: "#4e73df",
    };
  },
  components: {
    Main,
    Sidebar,
  },
  computed: {
    isLoading() {
      return this.$store.getters.getIsLoading;
    },
  },
};
</script>