<template>
  <div v-if="shipment">
    <div class="row">
      <div class="col text-center">
        <h1 class="text-white bg-box-dark py-2 px-4">FREIGHT INVOICE</h1>
      </div>

      <div class="col">
        <div class="row">
          <!-- <div class="col  ml-3 ">
                        <h5 class="float-right ml-2">CONSIGNOR COPY</h5>
          </div>-->
        </div>
      </div>
    </div>

    <div class="row px-3 py-1 only-print">
      <div class="col-6 bg-light-box">
        <h2
          class="main-title"
          style="font-family: 'Times New Roman'; margin-bottom: -1rem"
        >
          GURUKAL LOGISTICS
        </h2>
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
      <div class="col-3 logo">
        <img :src="logo_text" style="max-width: 20rem" />
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h3 class="sub-title-red">
          <b>INVOICE NO: {{ shipment.freight_invoice_number }}</b>
          <h6 class="border-top-dark pt-1">
            PAYMENT STATUS:
            <span v-if="shipment.balance <= 0">PAID</span>
            <span v-else-if="shipment.balance == shipment.charge_total"
              >PENDING</span
            >

            <span v-else>PARTIAL</span>
          </h6>
        </h3>
      </div>
      <div class="col">
        <h6 class="sub-title-red pt-1">
          DATE: {{ moment(shipment.date).format("DD/MM/YYYY") }}
        </h6>
        <h6 class="border-top-dark pt-1">
          VEHICLE NO: {{ shipment.transport_driver_vehicle }}
        </h6>
        <h6 class="border-top-dark pt-1">
          TRANSACTION TYPE: {{ shipment.package_transaction_type }}
        </h6>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <h5><i class="fas fa-user icon"></i>&nbsp;&nbsp;BILL TO</h5>
        <h5 v-if="shipment.bill_to == 'consignor'">
          {{ shipment.sender.company_name }}
          <br />
          {{ shipment.sender.address }}
          <br />
          GST: {{ shipment.sender.gst }}
        </h5>
        <h5 v-else-if="shipment.bill_to == 'consignee'">
          {{ shipment.receiver.company_name }}
          <br />
          {{ shipment.receiver.address }}
          <br />
          GST: {{ shipment.receiver.gst }}
        </h5>
        <h5 v-else>
          {{ shipment.sender.company_name }}
          <br />
          {{ shipment.sender.address }}
          <br />
          GST: {{ shipment.sender.gst }}
        </h5>
      </div>
      <div class="col-6">
        <h5><i class="fas fa-user icon"></i>&nbsp;&nbsp;CONSIGNOR</h5>
        <h5 class="underline">
          {{ shipment.sender.company_name }}
          <br />
          {{ shipment.sender.address }}
          <br />
          GST: {{ shipment.sender.gst }}
        </h5>
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

    <div class="row">
      <div class="col-12">
        <table
          class="
            table-print
            table-bordered
            table-responsive-sm
            table-print-border-bottom
          "
        >
          <thead>
            <th class="bg-red">SL No.</th>
            <th class="bg-red">Description</th>

            <!-- <th class="bg-red">Serial No.</th> -->
            <th class="bg-red">Docket No.</th>
            <th class="bg-red">Invoice No.</th>

            <th class="bg-red">Quantity</th>
            <th class="bg-red">Weight</th>
          </thead>
          <tr v-for="(item, index) in shipment.package" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ item.description }}</td>

            <!-- <td>{{ item.serial_no }}</td> -->
            <td>{{ shipment.docket_no }}</td>
            <td>{{ item.invoice_no }}</td>

            <td>{{ item.quantity }}</td>
            <td>{{ item.weight }} kg</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table-bordered table-print">
          <!-- <tr>
            <th class="bg-red" v-if="shipment.Charge_advance_paid  > 0">Advance Paid</th>
            <td>{{ shipment.charge_advance_paid }}</td>
          </tr>
          <tr v-if="shipment.discount > 0">
            <th class="bg-red">Discount</th>
            <td>{{ shipment.discount }}</td>
          </tr>
          <tr>
            <th class="bg-red">Balance Amount</th>
            <td>{{ shipment.balance }}</td>
          </tr> -->
        </table>

        <div class="row">
          <div class="col">
            <h6 class="bg-secondary text-white p-2">
              Remarks: {{ shipment.remarks }}
            </h6>
            <p class="mt-2" v-if="checkDate">
              Bank Details
              <br />Name : Axis Bank <br />8th Mile Branch <br />A/c No.:
              918020030455515 <br />IFSC: UTIB0002926
            </p>
            <p class="mt-2" v-else>
              Bank Details
              <br /><span class="text-primary font-weight-bold">
                Name: GURUKAL LOGISTICS </span
              ><br />
              Bank name: Axis Bank <br />8th Mile Branch <br />A/c No:
              918020022199928 <br />
              IFSC: UTIB0002926
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <table class="table-print table-bordered table-responsive-sm font-dark">
          <tr v-if="shipment.charge_transportation > 0">
            <th class="bg-red">Transportation</th>
            <td>{{ shipment.charge_transportation }}</td>
          </tr>
          <tr v-if="shipment.charge_handling > 0">
            <th class="bg-red">Handling</th>
            <td>{{ shipment.charge_handling }}</td>
          </tr>
          <tr v-if="shipment.charge_odc > 0">
            <th class="bg-red">ODC Charges</th>
            <td>{{ shipment.charge_odc }}</td>
          </tr>
          <tr v-if="shipment.charge_halting > 0">
            <th class="bg-red">Halting</th>
            <td>{{ shipment.charge_halting }}</td>
          </tr>
          <tr v-if="shipment.charge_cartage > 0">
            <th class="bg-red">Cartage</th>
            <td>{{ shipment.charge_cartage }}</td>
          </tr>
          <tr v-if="shipment.charge_over_weight > 0">
            <th class="bg-red">Over weight</th>
            <td>{{ shipment.charge_over_weight }}</td>
          </tr>
          <tr v-if="shipment.charge_Insurance > 0">
            <th class="bg-red">Insurance</th>
            <td>{{ shipment.charge_Insurance }}</td>
          </tr>
          <tr v-if="shipment.charge_tax_amount > 0">
            <th class="bg-red">GST</th>
            <td>{{ shipment.charge_tax_amount }}</td>
          </tr>
          <tr>
            <th class="bg-red">Total</th>
            <td>{{ shipment.charge_total }}</td>
          </tr>
          <tr>
            <th class="bg-red" >Advance Paid</th>
            <td>{{ shipment.charge_advance_paid }}</td>
          </tr>
          <tr v-if="shipment.discount > 0">
            <th class="bg-red">Discount</th>
            <td>{{ shipment.discount }}</td>
          </tr>
          <tr>
            <th class="bg-red">Balance Amount</th>
            <td>{{ shipment.balance }}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <qrcode :value="qrcode" :options="{ width: 120 }"></qrcode>
      </div>
      <div class="col-8 bg-dark text-white pt-2">
        <h5>Terms & Conditions</h5>
        <ol>
          <li>Remittance of payment within 7 days of invoice receipt.</li>
          <li>
            A 10 % charge will be applied for every month of late payment.
          </li>
          <li>GST Payable by Freight Bearer.</li>
          <li>
            Notification No.17/2017-Central Tax (Rate), dated 28/06/2017 as
            amended by Notification No.20/2017-Central Tax (Rate), dated
            22/08/2017 the GST on GTA is 5%(CGST 2.5%, SGST 2.5%).
          </li>
          <li>
            The person liable to pay GST on this Invoice is Consignor /
            Consignee.
          </li>
          <li>ITC NOT availed by the service provider.</li>
        </ol>
        <p class="ml-2 text-white">Subject to Bangalore Jurisdiction</p>
      </div>

      <div class="col">
        <p>For and behalf of</p>
        <img :src="sign" alt="Rohith" class="img-fluid" style="width: 5.5rem" />
        <br />
        <br />
        <u>Gurukal Logistics</u>
      </div>
    </div>

    <div class="row">
      <div class="col text-center">
        <p>
          This is a computer generated document No seal and signature required.
        </p>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["shipment", "balance_amount", "shipment_status"],
  data() {
    return {
      logo: require("./assets/logo-png-2.png"),
      logo_text: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
      sign: "https://i.ibb.co/gySNn0G/sign-rohith.png",
    };
  },
  computed: {
    qrcode() {
      if (this.shipment.id) {
        return `https://crm.gurukal.in/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/${this.shipment.id}/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view`;
      } else {
        return "QRCODE not generated";
      }
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
  top: 20%;
  left: 8%;
  position: absolute;
  width: 60rem;
  z-index: 2;
  opacity: 0.3;
}

.border-top-dark {
  border-top: 0.2rem solid #363636 !important;
}

.bg-box-dark {
  background-color: #363636;
}

.icon {
  border: 0.2rem solid #34495e;
  padding: 0.6rem;
  border-radius: 2rem;
  font-size: 1rem;
  color: #363636;
}

.bg-red {
  background-color: #34495e !important;
  color: white;
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
  padding: 0.5rem;
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
  position: absolute;
  top: -1%;
  right: 15%;
}

.logo img {
  width: 15rem;
}

.main-title {
  color: #c0392b;
  font-weight: bolder;
}
</style>