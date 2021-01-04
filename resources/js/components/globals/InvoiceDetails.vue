<template>
  <div>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-3">
        <p>
          Delivery Status :
          <span
            class="badge badge-pill badge-primary"
            v-model="shipment_status.status !== ''"
            >{{ shipment_status.status }}</span
          >
        </p>
        <p>
          Balance Amount :
          {{ shipment.balance }}
        </p>
        <p>TDS Amount: {{ shipment.tds_amount }}</p>
      </div>
      <div class="col-9">
        <a
          class="btn btn-primary text-white btn-sm"
          onclick="javascript:window.print()"
        >
          <i class="fas fa-print"></i> Print Invoice
        </a>

        <router-link
          :to="
            '/admin/customers/' +
            shipment.sender.id +
            '/invoices/' +
            shipment.id +
            '/view/docket'
          "
          class="btn btn-warning ml-2 btn-sm"
        >
          <i class="fas fa-check"></i> Docket
        </router-link>
        <button @click.prevent="sendMail" class="btn btn-info ml-2 btn-sm">
          <i class="fas fa-envelope"></i> Mail
        </button>

        <button @click.prevent="sendSms" class="btn btn-danger ml-2 btn-sm">
          <i class="fas fa-envelope"></i> Sms
        </button>
        <button
          type="button"
          class="btn btn-outline-info btn-sm ml-2"
          data-toggle="modal"
          data-target="#updatestatus"
        >
          <span> <i class="fas fa-scroll"></i> </span>&nbsp; Status
        </button>
        <button
          type="button"
          class="btn btn-success btn-sm ml-2"
          data-toggle="modal"
          data-target="#paymentmodal"
        >
          <span>
            <i class="fas fa-rupee-sign"></i>
          </span>
          Add Payment
        </button>
        <button
          @click="updateBalance"
          type="button"
          class="btn btn-secondary btn-sm ml-2"
          data-toggle="modal"
          data-target="#tds_modal"
        >
          <span>
            <i class="fas fa-rupee-sign"></i>
          </span>
          Update TDS Payment
        </button>
        <router-link
          :to="'/admin/shipments/' + shipment.id + '/edit'"
          class="btn btn-dark ml-2 btn-sm"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-check"></i> Edit
        </router-link>
      </div>
    </div>
    <div class="row d-print-none">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <p>Sender Details</p>
                <p>
                  Pickup Location :
                  <br />
                  {{ shipment.package_pickup_address }}
                </p>
                <p>Sender name : {{ shipment.sender.name }}</p>
                <p>Contact : {{ shipment.sender.phone }}</p>
              </div>
              <div class="col-3">
                <p>Receiver Details</p>
                <p>
                  Dropoff Location :
                  <br />
                  {{ shipment.delivery_address }}
                </p>
                <p>Receiver Name : {{ shipment.receiver.name }}</p>
                <p>Contact : {{ shipment.receiver.phone }}</p>
              </div>
              <div class="col-3">
                <p>Transport Details</p>
                <p>Driver Name : {{ shipment.transport_driver_name }}</p>
                <p>Contact : {{ shipment.transport_driver_phone }}</p>
                <p>Vehicle Details : {{ shipment.transport_driver_vehicle }}</p>
              </div>
              <div class="col-3">
                <p>Vendor Details</p>
                <p>Vendor: {{ shipment.vendor_name }}</p>
                <p>Total: {{ shipment.vendor_total }}</p>
                <p>Advance: {{ shipment.vendor_advance }}</p>
                <p>Balance: {{ shipment.vendor_balance }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <AddPayment :shipment="shipment"></AddPayment>
    <UpdateTdsPayment
      :shipment="shipment"
      :balance_amount="balance_amount.balance_amount"
    ></UpdateTdsPayment>
  </div>
</template>

<script>
import AddPayment from "../globals/AddPayment";
import UpdateTdsPayment from "../globals/UpdateTdsPayment";
export default {
  data() {
    return {};
  },
  components: {
    AddPayment,
    UpdateTdsPayment,
  },
  props: ["shipment", "balance_amount", "shipment_status"],
  methods: {
    sendMail() {
      axios
        .post(`/api/shipments/${this.shipment.id}/shipment_send_email`)
        .then(function (response) {
          Swal.fire("Good job!", "Email Sent Successfully", "success");
        })
        .catch(function (error) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Check Whether Sender email is valid",
          });
        });
    },
    sendSms() {
      axios
        .post(`/api/shipments/${this.shipment.id}/shipment_send_sms`)
        .then(function (response) {
          Swal.fire("Good job!", "Sms Sent Successfully", "success");
        })
        .catch(function (error) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Check Whether Sender phone number is valid",
          });
        });
    },
    updateBalance() {
      this.$store.commit("updateShipmentBalance", this.shipment.balance);
    },
  },
};
</script>