<template>
  <div :class="[!display ? 'only-print' : '']">
    <div class="only-print">
      <img :src="logo" alt srcset class="bg-logo" />
    </div>

    <div class="row">
      <div class="col text-center">
        <h2 class="border-top text-white bg-box-dark p-4">
          DOCKET/LORRY RECEIPT
        </h2>
      </div>

      <div class="col">
        <div class="row">
          <div class="col ml-3">
            <h5 class="float-right ml-2">{{ copy }}</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="row p-3">
      <div class="col-6 bg-light-box border-top">
        <h1
          class="main-title"
          style="font-family: 'Times New Roman'; margin-bottom: -1rem"
        >
          GURUKAL LOGISTICS
        </h1>
        <h5>
          <br />Anchepalya, Bangalore - 560073
          <br />
          <i class="fas fa-phone-alt"></i> &nbsp;+91 962 0202 001
          <br />
          <i class="fas fa-envelope"></i> &nbsp;logistics@gurukal.co.in
          <br />
          <b> <i class="fas fa-globe-americas"></i> &nbsp;www.gurukal.in </b>
          <br />
          <span v-if="checkDate"> GST No: 29AYGPS3509N2ZQ </span>
          <span v-else> GST No: 29BAYPR5950F1ZU </span>
        </h5>
      </div>
      <div class="col"></div>
      <div class="col-3 logo only-print">
        <img :src="logo_text" style="max-width: 20rem" />
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <h3 class="sub-title-red pt-2">
          <b>DOCKET NO: {{ shipment.docket_no }}</b>
        </h3>
        <h5 class="border-top-dark pt-1">PAYMENT BY: {{ shipment.bill_to }}</h5>
      </div>
      <div class="col">
        <h6 class="sub-title-red pt-1">DATE: {{ shipment.date }}</h6>
        <h6 class="border-top-dark pt-1">
          VEHICLE NO: {{ shipment.transport_driver_vehicle }}
        </h6>

        <h6 class="border-top-dark pt-1">
          TRANSACTION TYPE: {{ shipment.package_transaction_type }}
        </h6>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col font-md">
        <h5><i class="fas fa-user icon"></i>&nbsp;&nbsp;CONSIGNOR</h5>
        <h5>
          {{ shipment.sender.company_name }}
          <br />
          {{ shipment.sender.address }}
          <br />
          GST: {{ shipment.sender.gst }}
        </h5>
      </div>
      <div class="col">
        <h5><i class="fas fa-user icon"></i>&nbsp;&nbsp;CONSIGNEE</h5>
        <h5 class="underline">
          {{ shipment.receiver.company_name }}
          <br />
          {{ shipment.receiver.address }}
          <br />
          GST: {{ shipment.receiver.gst }}
        </h5>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col">
        <table class="table-print table-bordered table-print-border-bottom">
          <thead>
            <th class="bg-red">SL No.</th>
            <th style="width: 20rem" class="bg-red">Description</th>
            <th class="bg-red">Invoice No.</th>
            <th class="bg-red">Serial No.</th>
            <th class="bg-red">Weight</th>
            <th class="bg-red">Quantity</th>
            <th class="bg-red">Declared value</th>
          </thead>
          <tbody>
            <tr v-for="(data, index) in shipment.package">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ data.description }}</td>
              <td>{{ data.invoice_no }}</td>
              <td>{{ data.serial_no }}</td>
              <td>{{ data.weight }} Kg</td>
              <td>{{ data.quantity }}</td>
              <td>₹ {{ data.cost }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-6">
        <table class="table-print table-bordered table-responsive-sm font-dark">
          <thead>
            <th class="bg-red" style="width: 13rem">Eway Bill</th>
            <th class="bg-red" style="width: 13rem">Insurance No</th>
            <th class="bg-red" style="width: 13rem">Insurance Agent</th>
          </thead>
          <tr v-for="data in shipment.insurance">
            <td>{{ data.eway_bill }}</td>
            <td>{{ data.insurance_no }}</td>
            <td>{{ data.insurance_agent }}</td>
          </tr>
        </table>
      </div>
      <div class="col-4"></div>
      <div class="col">
        <qrcode :value="qrcode" :options="{ width: 120 }"></qrcode>
      </div>
    </div>

    <div class="row">
      <div class="col font-dark">
        <h6 class="mt-3 bg-secondary text-white p-2">
          Remarks: {{ shipment.remarks }}
        </h6>
      </div>
    </div>

    <div class="row">
      <div class="col bg-dark text-white p-2 mt-3 mb-3 ml-2">
        <h5>Payment Condition</h5>
        <ol>
          <li>
            Delivery of goods against freight & other charges only Payment by
            A/c payee in favour of M/s GURUKAL LOGISTICS only.
          </li>
          <li>
            IN CASE OF LOSS OR DAMAGE TO GOOOS THE LIABILITY OF THE CARRIER
            SHALL NOT EXCEED A SUM OF Rs 500). (FIVE HUNDRED ONLY) The company
            is not responsible for leakage, Breakage & Accident Damage Subject
            to Terms & Conditions of carriage https://crm.gurukal.in/terms.
          </li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-4"></div>
      <div class="col box border"></div>
      <div class="col box ml-4 border"></div>
    </div>
    <div class="row mt-1">
      <div class="col-4"></div>
      <div class="col">
        <p>
          Consignor Sign
          <br />
          <span class="font-s">(GOODS INSPECTED)</span>
        </p>
      </div>
      <div class="col">
        <p>
          Receiver Sign
          <br />
          <span class="font-s">(GOODS RECEIVED IN GOOD CONDITION)</span>
        </p>
      </div>
    </div>

    <div class="page-break"></div>
    <!-- <div v-if="is_terms">
      <DocketTerms></DocketTerms>
    </div> -->

    <div class="pagebreak"></div>
  </div>
</template>

<script>
export default {
  props: ["shipment", "copy", "display", "is_terms"],
  data() {
    return {
      logo: require("./assets/logo-png-2.png"),

      logo_text: require("./assets/logo-png.png"),
    };
  },
  computed: {
    checkDate() {
      let day = "01/08/2021";
      let parsed = moment(day, "DD/MM/YYYY");
      if (parsed.diff(moment(this.shipment.created_at)) > 0) {
        return true;
      } else {
        return false;
      }
    },
    qrcode() {
      return `https://crm.gurukal.in/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/${this.shipment.id}/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view`;
    },
  },
};
</script>

<style scoped>
body {
  font-family: "Roboto", sans-serif;
}

.sub-title-red {
  border-top: solid #d03346 0.2rem;
}

.font-s {
  font-size: 0.8rem !important;
}

.box {
  padding: 2rem;
}

.bg-logo {
  margin-bottom: -90rem;
  margin-left: 5rem;
  width: 60rem;
  z-index: 2;
  opacity: 0.1;
}

.border-top {
  border-top: 0.4rem solid #d03346 !important;
}

.border-top-dark {
  border-top: 0.2rem solid #363636 !important;
}

.bg-box-dark {
  background-color: #363636;
}

.icon {
  border: 0.2rem solid #d03346;
  padding: 0.6rem;
  border-radius: 2rem;
  font-size: 1rem;
  color: #363636;
}

.bg-red {
  background-color: #34495e !important;
  color: white;
  -webkit-print-color-adjust: exact;
}

.bg-dark {
  background-color: #363636;
}

.table-print {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}

.table-print-border-bottom {
  border-bottom: 1rem solid #34495e;
}

.table-print thead th {
  vertical-align: bottom;
  border-bottom: 0.2rem solid #363636;
  border-top: 0.2rem solid #363636;
}

.table-print th,
.table-print td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.bg-light-box {
  background-color: #f6f6f6;
}

.page-break {
  page-break-before: always;
}

.logo {
  margin-left: -56rem;

  margin-top: -8rem;
}

.logo img {
  width: 20rem;
}

.main-title {
  color: #c0392b;
  font-weight: bolder;
}
@media print {
}
</style>

