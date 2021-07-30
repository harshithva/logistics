<template>
  <div v-if="shipment">
    <InvoiceDetails
      :shipment="shipment"
      :balance_amount="balance_amount"
      :shipment_status="shipment_status"
    ></InvoiceDetails>
    <Invoice
      :shipment="shipment"
      :shipment_status="shipment_status"
      :balance_amount="shipment.balance"
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

#content {
  background-color: white !important;
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