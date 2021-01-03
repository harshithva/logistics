<template>
  <div
    class="modal fade d-print-none"
    id="tds_modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update TDS</h5>
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
                  <label for="Size">Amount</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="payment.tds_amount"
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
            Update
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
        tds_amount: 0,
        shipment_id: "",
      }),
    };
  },
  props: ["shipment"],
  methods: {
    addPayment() {
      this.payment.shipment_id = this.shipment.id;

      if (this.payment.tds_amount == 0 || "") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Amount cannot be 0",
        });
        return;
      }
      this.payment
        .submit(
          "post",
          "api/shipments/" + this.shipment.id + "/add_tds_payment"
        )
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Well done! TDS Updated",
            showConfirmButton: false,
            timer: 1500,
          });

          this.$store.dispatch(
            "retrieveShipmentBalanceAmount",
            this.$route.params.invoice_id
          );

          this.$store.dispatch(
            "retrieveSingleShipment",
            this.$route.params.invoice_id
          );

          this.payment.tds_amount = 0;
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
  created() {},
};
</script>