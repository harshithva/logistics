<template>
  <div>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-md-8 col-4"></div>
      <div class="col">
        <a
          class="btn btn-primary text-white"
          onclick="javascript:window.print()"
        >
          <i class="fas fa-print"></i> Print Docket
        </a>

        <button @click="$router.go(-1)" class="btn btn-dark ml-2">
          <i class="fas fa-arrow-left"></i> Return
        </button>
      </div>
    </div>

    <div>
      <Docket
        :shipment="shipment"
        :copy="docket_copy_text"
        :display="true"
        :is_terms="true"
      ></Docket>
      <!-- <div>
        <Docket :shipment="shipment" :copy="copy" v-for="(copy,index) in copies" :key="index"></Docket>
      </div>-->
    </div>
  </div>
</template>


<style>
.font-xs {
  font-size: 0.6rem;
}

.font-s {
  font-size: 0.8rem;
}

.font-md {
  font-size: 1.1rem;
}

p {
  color: black !important;
}
.font-dark {
  color: black !important;
}

.only-print {
  display: none;
}
@media print {
  .pagebreak {
    page-break-before: always;
  }
  .only-print {
    display: block;
  }
}

.bg-white {
  background-color: white !important;
}
</style>

<script>
import VueBarcode from "vue-barcode";
import jsPDF from "jspdf";

export default {
  data() {
    return {
      logo: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
      status: "pickup",
      docket_copy_text: "ORIGINAL",
      copies: ["CONSIGNOR", "CONSIGNEE", "CARGO COPY"],
    };
  },
  components: {
    barcode: VueBarcode,
  },
  computed: {
    shipment() {
      return this.$store.getters.getSingleShipment;
    },
    shipment_status() {
      return this.$store.getters.getShipmentStatus;
    },
  },
  methods: {
    sendDocketLink() {
      axios
        .post(`api/shipments/${this.shipment.id}/shipment_send_docket`)
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Docket has sent through mail",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Make sure email is valid.",
          });
        });
    },
    print() {
      window.print();
    },
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleShipment",
      this.$route.params.invoice_id
    );
    this.$store.dispatch(
      "retrieveShipmentStatus",
      this.$route.params.invoice_id
    );
  },
};
</script>