<template>
  <div>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-2">
        <!-- <select
          class="custom-select"
          id="inputGroupSelect04"
          aria-label="Example select with button addon"
          v-model="docket_copy_text"
        >
          <option disabled>Docket copy</option>
          <option value="ORIGINAL">ORIGINAL</option>
          <option value="CONSIGNOR">CONSIGNOR</option>
          <option value="CONSIGNEE">CONSIGNEE</option>
          <option value="CARGO COPY">CARGO COPY</option>
        </select> -->
      </div>
      <div class="col-4"></div>
      <div class="col">
        <a
          class="btn btn-primary text-white"
          onclick="javascript:window.print()"
        >
          <i class="fas fa-print"></i> Print Docket
        </a>
        <!-- <a class="btn btn-primary text-white" v-print="'#docket'">
          <i class="fas fa-print"></i> Print Docket
        </a>-->

        <button class="btn btn-success text-white" @click="sendDocketLink">
          <i class="fas fa-print"></i> Mail Docket
        </button>

        <button @click="$router.go(-1)" class="btn btn-dark ml-2">
          <i class="fas fa-arrow-left"></i> Return
        </button>
      </div>
    </div>
    <div class="row d-print-none font-md">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <p>Sender Details</p>
                <p>Pickup Location : {{ shipment.package_pickup_address }}</p>
                <p>Sender name : {{ shipment.sender.name }}</p>
                <p>Contact : {{ shipment.sender.phone }}</p>
              </div>
              <div class="col-3">
                <p>Receiver Details</p>
                <p>Dropoff Location : {{ shipment.delivery_address }}</p>
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
                <p>Current Status</p>
                <p v-if="shipment_status.location">
                  Location : {{ shipment_status.location }}
                </p>
                <p v-else>Location: Not Updated</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <Docket
        :shipment="shipment"
        :copy="docket_copy_text"
        display="false"
      ></Docket>
      <Docket :shipment="shipment" copy="CONSIGNOR" display="false"></Docket>
      <Docket :shipment="shipment" copy="CONSIGNEE" display="false"></Docket>
      <Docket :shipment="shipment" copy="CARGO COPY" display="false"></Docket>
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