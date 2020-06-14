<template>
  <fragment>
    <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage" :color="color"></loading>
    <CustomerMain></CustomerMain>
  </fragment>
</template>

<script>
import CustomerMain from "./customer-components/CustomerMain";
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
    CustomerMain,
    Loading
  },
  computed: {
    isLoading() {
      return this.$store.getters.getIsLoading;
    }
  }
};
</script>