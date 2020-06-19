<template>
  <div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          <center class="m-t-30">
            <img
              src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png"
              class="rounded-circle"
              width="100"
            />
            <h4 class="card-title m-t-10">{{form.name}}</h4>
            <h6 class="card-subtitle">
              <div class="badge badge-pill badge-success font-16" v-if="form.status == true">
                <span class="ti-user text-success"></span>
                Active
              </div>

              <div class="badge badge-pill badge-success font-16" v-else-if="form.status == false">
                <span class="ti-user text-success"></span>
                Inactive
              </div>
            </h6>
          </center>
        </div>
        <div>
          <hr />
        </div>
        <div class="card-body">
          <!-- customer created alert -->
          <b-alert
            :show="dismissCountDown"
            variant="success"
            dismissible
            fade
            @dismissed="dismissCountDown=0"
            @dismiss-count-down="countDownChanged"
          >Customer Updated!</b-alert>

          <small class="text-muted">E-mail</small>
          <h6>{{form.email}}</h6>
          <small class="text-muted p-t-30 db">Phone</small>
          <h6>{{form.phone}}</h6>
          <small class="text-muted p-t-30 db">Address</small>
          <h6>{{form.address}}</h6>
        </div>
        <div class="card-body row">
          <div class="col-12">
            <p class="font-s">Registration Date: {{moment(form.created_at).format('YYYY-MM-DD')}}</p>
            <p></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <div id="loader" style="display:none"></div>
          <div id="msgholder"></div>
          <div class="row mb-4">
            <router-link
              to="/customer"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
            >
              <i class="fas fa-rupee-sign fa-sm"></i> Invoices
            </router-link>
            <router-link
              to="/customer/quote"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
            >
              <i class="fas fa-scroll fa-sm"></i> Quotes
            </router-link>

            <router-link
              to="/customer/track/shipment"
              aria-current="page"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
            >
              <i class="fas fa-truck fa-sm"></i> Track Shipment
            </router-link>

            <router-link
              to="/customer/quote/create"
              aria-current="page"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"
            >
              <i class="fas fa-sticky-note fa-sm"></i> Request Quote
            </router-link>
          </div>

          <tracking-component></tracking-component>
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
export default {
  data() {
    return {
      customer: {},
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      tracking_no: ""
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("patch", "/api/customers/" + this.form.id)
        .then(response => (this.dismissCountDown = 10))
        .catch(error =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"
          })
        );
    },
    async trackShipment() {
      if (this.tracking_no) {
        await this.$store.dispatch("TrackShipment", this.tracking_no);
      }
    },

    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    }
  },
  computed: {
    form() {
      return new Form(this.$store.getters.getSingleCustomer);
    },
    tracking_details() {
      return this.$store.getters.getTrackingDetails;
    }
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleCustomer",
      this.$store.getters.getUserData.user.id
    );
  }
};
</script>