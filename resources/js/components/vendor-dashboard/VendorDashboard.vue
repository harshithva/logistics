<template>
  <div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <UserDetails :user="user"></UserDetails>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <div>
            <b-tabs content-class="mt-3">
              <b-tab title="Shipments" active>
                <VendorShipmentList
                  :shipments="shipments"
                  :role="$store.getters.getUserData.user.id"
                ></VendorShipmentList>
              </b-tab>
              <b-tab title="Edit"
                ><p><EditUser v-if="user" :form="user"></EditUser></p
              ></b-tab>
            </b-tabs>
          </div>
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
import VendorShipmentList from "../vendors/sub/VendorShipmentList";

import { mapGetters } from "vuex";

export default {
  components: {
    Switches,
    UserDetails,
    EditUser,
    VendorShipmentList,
  },
  data() {
    return {};
  },
  methods: {},
  computed: {
    user() {
      return new Form(this.$store.getters.getSingleCustomer);
    },
    ...mapGetters({
      shipments: "getVendorShipments",
    }),
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleCustomer",
      this.$store.getters.getUserData.user.id
    );
    this.$store.dispatch(
      "RETRIEVE_VENDOR_SHIPMENTS",
      this.$store.getters.getUserData.user.id
    );
  },
};
</script>