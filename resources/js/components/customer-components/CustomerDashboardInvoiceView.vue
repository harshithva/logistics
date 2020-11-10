<template>
  <div v-if="shipment">
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col">
        <p>
          Delivery Status :
          <span
            class="badge badge-pill badge-primary"
            v-if="shipment_status.status !== ''"
            >{{ shipment_status.status }}</span
          >
        </p>

        <p v-if="shipment_status.location">
          Location : {{ shipment_status.location }}
        </p>
        <p v-else>Location: Not Updated</p>
      </div>
      <div class="col"></div>
      <div class="col">
        <a
          class="btn btn-primary text-white"
          onclick="javascript:window.print()"
        >
          <i class="fas fa-print"></i> Print Invoice
        </a>

        <router-link
          :to="'/customer/invoice/' + shipment.id + '/docket/view'"
          class="btn btn-warning ml-2"
        >
          <i class="fas fa-check"></i> Docket
        </router-link>
        <button @click="$router.go(-1)" class="btn btn-dark ml-2">
          <i class="fas fa-arrow-left"></i> Return
        </button>
      </div>
    </div>
    <Invoice
      :shipment="shipment"
      :shipment_status="shipment_status"
      :balance_amount="balance_amount"
    ></Invoice>

    <!-- Payment Modal-->

    <!-- update status modal  -->

    <div
      class="modal fade d-print-none"
      id="updatestatus"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <UpdateStatus
              :shipment_id="shipment.id"
              :sender_id="shipment.sender.id"
            ></UpdateStatus>
          </div>

          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
@media print {
  #wrapper #content-wrapper {
    background-color: white !important;
  }
}
</style>

<script>
import InvoiceDetails from "../globals/InvoiceDetails";
export default {
  data() {
    return {
      logo: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
      sign: "https://i.ibb.co/gySNn0G/sign-rohith.png",
    };
  },
  components: {
    InvoiceDetails,
  },
  computed: {
    shipment() {
      return this.$store.getters.getSingleShipment;
    },
    balance_amount() {
      return this.$store.getters.getShipmentBalanceAmount;
    },
    shipment_status() {
      return this.$store.getters.getShipmentStatus;
    },
    qrcode() {
      return `https://crm.gurukal.in/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/${this.shipment.id}/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view`;
    },
  },
  methods: {},
  created() {
    this.$store.dispatch(
      "retrieveSingleShipment",
      this.$route.params.invoice_id
    );
    this.$store.dispatch(
      "retrieveShipmentBalanceAmount",
      this.$route.params.invoice_id
    );
    this.$store.dispatch(
      "retrieveShipmentStatus",
      this.$route.params.invoice_id
    );
  },
};
</script>