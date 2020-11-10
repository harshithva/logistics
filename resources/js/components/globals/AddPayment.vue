<template>
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
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @keydown="payment.errors.clear()">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Serial Number">Payment Date</label>

                  <input
                    type="text"
                    class="form-control"
                    v-model="payment.payment_date"
                  />
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
                  <input
                    type="text"
                    class="form-control"
                    v-model="payment.amount"
                  />
                </div>
              </div>
            </div>

            <div class="row" v-if="payment.payment_type === 'bank'">
              <div class="col">
                <div class="form-group">
                  <label for="Size">Bank Name</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="payment.bank_name"
                  />
                </div>
              </div>
            </div>
            <div class="row" v-if="payment.payment_type === 'upi'">
              <div class="col">
                <div class="form-group">
                  <label for="Size">UPI Ref ID</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="payment.upi_ref_id"
                  />
                </div>
              </div>
            </div>
            <div class="row" v-if="payment.payment_type === 'cheque'">
              <div class="col">
                <div class="form-group">
                  <label for="Size">Cheque No</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="payment.cheque_no"
                  />
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click.prevent="addPayment"
            data-dismiss="modal"
          >
            Add
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
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
  props: ["shipment"],
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

          this.payment.payment_date = moment(new Date()).format("DD/MM/YYYY");
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
  },
  created() {
    this.payment.payment_date = moment(new Date()).format("DD/MM/YYYY");
  },
};
</script>