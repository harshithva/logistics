<template>
  <div>
    <form @keydown="payment.errors.clear()">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="Size">Payment Type</label>
              <select
                class="custom-select"
                id="inputGroupSelect04"
                aria-label="Example select with button addon"
                v-model="payment.type"
              >
                <option selected disabled>Choose</option>
                <option value="cash">Cash</option>
                <option value="bank">Bank</option>
                <option value="upi">UPI</option>
                <option value="cheque">Cheque</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
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
      </div>

      <div class="row">
        <div class="col-9"></div>
        <div class="col">
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
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      payment: new Form({
        type: "cash",
        amount: 0,
        shipment_id: "",
        vendor_id: "",
      }),
    };
  },
  props: ["shipment_id", "vendor_id"],
  methods: {
    addPayment() {
      this.payment.shipment_id = this.shipment_id;
      this.payment.vendor_id = this.vendor_id;

      if (this.payment.amount == 0 || "") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Amount cannot be 0",
        });
        return;
      }
      this.payment
        .submit("post", "api/vendor_payments")
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Well done! Payment added",
            showConfirmButton: false,
            timer: 1500,
          });

          this.$store.dispatch("retrieveSingleCustomer", this.vendor_id);
          this.$store.dispatch("RETRIEVE_VENDOR_SHIPMENTS", this.vendor_id);

          this.payment.amount = 0;
          this.payment.type = "cash";
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Amount field is required",
          });
        });
    },
  },
  created() {},
};
</script>