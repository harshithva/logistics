<template>
  <div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <UserDetails :user="user"></UserDetails>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <div id="loader" style="display: none"></div>
          <div id="msgholder"></div>
          <div class="row mb-4">
            <router-link
              :to="'/admin/customers/' + user.id"
              aria-current="page"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-3"
            >
              <i class="fas fa-edit fa-sm"></i> Edit
            </router-link>
            <router-link
              :to="'/admin/customers/' + user.id + '/invoice'"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
            >
              <i class="fas fa-rupee-sign fa-sm"></i> Invoices
            </router-link>
            <router-link
              :to="'/admin/customers/' + user.id + '/quotes'"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
            >
              <i class="fas fa-scroll fa-sm"></i> Quotes
            </router-link>
          </div>

          <EditUser v-if="user" :form="user"></EditUser>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.router-link-exact-active {
  background-color: #4e73df;
  color: white;
}
</style>


<script>
import Switches from "vue-switches";
import UserDetails from "../globals/UserDetails";
import EditUser from "../globals/EditUser";
export default {
  components: {
    Switches,
    UserDetails,
    EditUser,
  },
  data() {
    return {};
  },
  methods: {},
  computed: {
    user() {
      return new Form(this.$store.getters.getSingleCustomer);
    },
  },
  created() {
    this.$store.dispatch("retrieveSingleCustomer", this.$route.params.id);
  },
};
</script>