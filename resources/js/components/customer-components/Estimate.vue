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
            <Navigation></Navigation>
          </div>

          <div class="row">
            <!-- <div class="col">
              <input
                type="text"
                class="form-control"
                id="inputPassword2"
                disabled
                value="Bangalore"
              />
            </div>-->
            <div class="col">
              <v-select :options="shipment_rates" label="to" @input="getRate($event)" class="ml-2"></v-select>
            </div>

            <div class="col-8"></div>
          </div>

          <div class="row mt-4">
            <div class="col-sm-12">
              <table
                class="table table-bordered dataTable"
                id="dataTable"
                width="100%"
                cellspacing="0"
                role="grid"
                aria-describedby="dataTable_info"
                style="width: 100%;"
              >
                <thead>
                  <tr role="row">
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Position: activate to sort column ascending"
                      style="width: 40px;"
                    >From</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Office: activate to sort column ascending"
                      style="width: 50px;"
                    >To</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Office: activate to sort column ascending"
                      style="width: 50px;"
                    >Rate</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th rowspan="1" colspan="1">From</th>
                    <th rowspan="1" colspan="1">To</th>
                    <th rowspan="1" colspan="1">Rate</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-if="shipmentRate">
                    <td>{{shipmentRate.from}}</td>
                    <td>{{shipmentRate.to}}</td>
                    <td>{{shipmentRate.rate}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
import Navigation from "./Navigation";
export default {
  components: {
    Navigation,
  },
  data() {
    return {
      customer: {},
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      shipmentRate: "",
    };
  },
  methods: {
    getRate(e) {
      this.shipmentRate = e;
    },
    onSubmit() {
      this.form
        .submit("patch", "/api/customers/" + this.form.id)
        .then((response) => (this.dismissCountDown = 10))
        .catch((error) =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
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
    },
  },
  computed: {
    shipment_rates() {
      return this.$store.getters.getFilteredPriceLists;
    },
    form() {
      return new Form(this.$store.getters.getSingleCustomer);
    },
    tracking_details() {
      return this.$store.getters.getTrackingDetails;
    },
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleCustomer",
      this.$store.getters.getUserData.user.id
    );
    this.$store.dispatch("retrievePriceLists");
  },
};
</script>