<template>
  <div>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-3">
        <p>
          Delivery Status :
          <span
            class="badge badge-pill badge-primary"
            v-model="shipment_status.status !== ''"
          >{{shipment_status.status}}</span>
        </p>
        <p>Balance Amount : {{balance_amount.balance_amount}}</p>
      </div>
      <div class="col-9">
        <a class="btn btn-primary text-white btn-sm" onclick="javascript:window.print()">
          <i class="fas fa-print"></i> Print Invoice
        </a>

        <router-link
          :to="'/admin/customers/'+ shipment.sender.id +'/invoices/'+ shipment.id +'/view/docket'"
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
          <span>
            <i class="fas fa-scroll"></i>
          </span>&nbsp;
          Status
        </button>
        <button
          type="button"
          class="btn btn-success btn-sm ml-2"
          data-toggle="modal"
          data-target="#paymentmodal"
          @click="payment.payment_date = moment(new Date).format('DD/MM/YYYY')"
        >
          <span>
            <i class="fas fa-rupee-sign"></i>
          </span>
          Add Payment
        </button>
        <router-link
          :to="'/admin/shipments/' + shipment.id +'/edit'"
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
            <!-- errors -->
            <b-alert
              v-if="payment.errors.has('amount')"
              dismissible
              show
              variant="danger"
            >{{payment.errors.get('amount')}}</b-alert>
            <div class="row">
              <div class="col-4">
                <p>Sender Details</p>
                <p>
                  Pickup Location :
                  <br />
                  {{shipment.package_pickup_address}}
                </p>
                <p>Sender name : {{shipment.sender.name}}</p>
                <p>Contact : {{shipment.sender.phone}}</p>
              </div>
              <div class="col-4">
                <p>Receiver Details</p>
                <p>
                  Dropoff Location :
                  <br />
                  {{shipment.delivery_address}}
                </p>
                <p>Receiver Name : {{shipment.receiver.name}}</p>
                <p>Contact : {{shipment.receiver.phone}}</p>
              </div>
              <div class="col-4">
                <p>Transport Details</p>
                <p>Driver Name : {{shipment.transport_driver_name}}</p>
                <p>Contact : {{shipment.transport_driver_phone}}</p>
                <p>Vehicle Details : {{shipment.transport_driver_vehicle}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <Invoice
      :shipment="shipment"
      :shipment_status="shipment_status"
      :balance_amount="balance_amount"
    ></Invoice>

    <!-- Payment Modal-->

    <div
      class="modal fade d-print-none"
      id="paymentmodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @keydown="payment.errors.clear()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Payment Date</label>

                    <input type="text" class="form-control" v-model="payment.payment_date" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Payment Type</label>
                    <select
                      class="custom-select"
                      id="inputGroupSelect04"
                      aria-label="Example select with button addon"
                      v-model="payment.payment_type"
                    >
                      <option selected disabled>Choose</option>
                      <option value="cash">Cash</option>
                      <option value="bank">Bank</option>
                      <option value="upi">UPI</option>
                      <option value="cheque">Cheque</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Amount</label>
                    <input type="text" class="form-control" v-model="payment.amount" />
                  </div>
                </div>
              </div>

              <div class="row" v-if="payment.payment_type === 'bank'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">Bank Name</label>
                    <input type="text" class="form-control" v-model="payment.bank_name" />
                  </div>
                </div>
              </div>
              <div class="row" v-if="payment.payment_type === 'upi'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">UPI Ref ID</label>
                    <input type="text" class="form-control" v-model="payment.upi_ref_id" />
                  </div>
                </div>
              </div>
              <div class="row" v-if="payment.payment_type === 'cheque'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">Cheque No</label>
                    <input type="text" class="form-control" v-model="payment.cheque_no" />
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click.prevent="addPayment"
              data-dismiss="modal"
            >Add</button>
          </div>
        </div>
      </div>
    </div>

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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <UpdateStatus :shipment_id="shipment.id" :sender_id="shipment.sender.id"></UpdateStatus>
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
export default {
  data() {
    return {
      logo: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
      sign: "https://i.ibb.co/gySNn0G/sign-rohith.png",

      payment: new Form({
        payment_type: "cash",
        amount: "0",
        payment_date: "",
        bank_name: "",
        upi_ref_id: "",
        cheque_no: "",
        shipment_id: "",
        customer_id: "",
      }),
    };
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
  methods: {
    addPayment() {
      this.payment.shipment_id = this.shipment.id;

      if (this.shipment.bill_to == "consignor") {
        this.payment.customer_id = this.shipment.sender.id;
      } else if (this.shipment.bill_to == "consignee") {
        this.payment.customer_id = this.shipment.receiver.id;
      } else {
        this.payment.customer_id = this.shipment.sender.id;
      }

      if (this.payment.amount == 0 || "") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Amount cannot be 0",
        });
        return;
      }
      this.payment
        .submit("post", "api/shipments/" + this.shipment.id + "/payments")
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Well done! Payment added",
            showConfirmButton: false,
            timer: 1500,
          });

          this.$store.dispatch(
            "retrieveShipmentBalanceAmount",
            this.$route.params.invoice_id
          );

          this.balance_amount = this.$store.getters.getShipmentBalanceAmount;

          this.payment.received_from = "consignor";
          this.payment.amount = 0;
          this.payment.payment_type = "cash";
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Amount and Payment Date field is required",
          });
        });
    },

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
  },
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