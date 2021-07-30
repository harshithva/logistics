<template>
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <h1 class="text-white bg-box-dark p-4">{{ type }}</h1>
      </div>

      <div class="col">
        <div class="row">
          <!-- <div class="col  ml-3 ">
                        <h5 class="float-right ml-2">CONSIGNOR COPY</h5>
                    </div> -->
        </div>
      </div>
    </div>

    <div class="row p-3 only-print">
      <div class="col-6 bg-light-box border-top">
        <h1
          class="main-title"
          style="font-family: 'Times New Roman'; margin-bottom: -1rem"
        >
          GURUKAL LOGISTICS
        </h1>
        <h5>
          <br />Anchepalya, Bangalore - 560073 <br /><i
            class="fas fa-phone-alt"
          ></i>
          &nbsp;+91 962 0202 001 <br /><i class="fas fa-envelope"></i>
          &nbsp;logistics@gurukal.co.in <br /><b
            ><i class="fas fa-globe-americas"></i> &nbsp;www.gurukal.in</b
          >
          <br />GST No: 29AYGPS3509N2ZQ
        </h5>
      </div>
      <div class="col"></div>
      <div class="col-3 logo">
        <img
          src="https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg"
          style="max-width: 20rem"
        />
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h3 class="sub-title-red pt-2">
          <b>REF NO: {{ quote.quotation_no }}</b>
        </h3>
      </div>
      <div class="col">
        <h5 class="sub-title-red pt-2">
          DATE: {{ moment(quote.created_at).format("DD/MM/YYYY") }}
        </h5>
      </div>
    </div>
    <div class="row" v-if="type === 'QUOTATION'">
      <div class="col text-center">
        <h3>FOR TRANSIT</h3>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5><i class="fas fa-user icon"></i>&nbsp;&nbsp;TO</h5>
        <h5 v-if="quote.customer">
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ quote.customer.company_name }}
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ quote.customer.address }}
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ quote.customer.gst }}
          <br />
        </h5>
      </div>
    </div>

    <div class="row mt-2" v-if="type === 'QUOTATION'">
      <div class="col text-center">
        <h5 v-if="quote.list">
          SUB: TRANSIT QUOTE FOR
          {{
            quote.list[0].to.charAt(0).toUpperCase() + quote.list[0].to.slice(1)
          }}
        </h5>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col" v-if="type === 'QUOTATION'">
        <p v-if="quote.list">
          Dear Sir,
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As
          per our discussion regarding transportation requirement for the
          consignment to
          {{
            quote.list[0].to.charAt(0).toUpperCase() +
            quote.list[0].to.slice(1)
          }}.
        </p>
      </div>
      <div class="col" v-else>
        <p v-if="quote.list">
          Dear Sir,
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          We request you to kindly release the following advance amount
          mentioned for transportation to
          {{
            quote.list[0].to.charAt(0).toUpperCase() +
            quote.list[0].to.slice(1)
          }}.
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col text-center">
        <h4>{{ type }}</h4>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <table
          class="
            table-print
            table-bordered
            table-responsive-sm
            table-print-border-bottom
          "
        >
          <thead>
            <th class="bg-red">SL</th>
            <th class="bg-red">From</th>
            <th class="bg-red">To</th>
            <th class="bg-red">Description</th>
            <th class="bg-red">Size(Feet)&amp; Weight</th>
            <th class="bg-red">ETA</th>
            <th class="bg-red">Rate</th>
            <th class="bg-red">Advance</th>
          </thead>
          <tr
            v-if="quote.list"
            v-for="(item, index) in quote.list"
            :key="index"
          >
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ item.from }}</td>
            <td>{{ item.to }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.size }} & {{ item.weight }}</td>
            <td>{{ item.eta }} days</td>
            <td>{{ item.rate }}</td>
            <td>{{ item.advance }}</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row mr-1 ml-1" v-if="this.type !== 'PROFORMA INVOICE'">
      <div class="col bg-secondary text-white pt-2 pb-2">
        Remarks: {{ quote.remarks }}
      </div>
    </div>

    <div class="row mt-2 mr-1 ml-1">
      <div class="col bg-dark text-white pt-2">
        <h5>Terms & Conditions</h5>
        <ol>
          <li>Rates quoted above are valid for 48Hrs only.</li>
          <li>
            Extra charges will be implied If the consignment exceeds the limit
            of fleet dimension/ RTO Regulations.
          </li>
          <li>
            Advance payment is to be made (unless stated above, in which case
            you shall pay the quoted price).
          </li>
          <li>
            If the unloading time exceeds 4hrs halting will be charged as per
            actuals
          </li>
          <li>
            Payments are to be made within 7 days from the date of invoice.
          </li>
          <li>
            If Vehicle Is Cancelled Prior To 60min/On Arrival Charges Are
            Applicable.
          </li>
          <li>Change in destination/location is to be charged extra.</li>
        </ol>
        <p class="ml-2 text-white">Subject to Bangalore Jurisdiction</p>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-10">
        <b>
          Bank Details
          <br />Name : Axis Bank <br />8th Mile Branch <br />A/c No.:
          918020030455515 <br />IFSC: UTIB0002926
          <br />
        </b>
      </div>

      <div class="col">
        <p>For and behalf of</p>
        <img
          src="https://i.ibb.co/gySNn0G/sign-rohith.png"
          alt="Rohith"
          class="img-fluid"
          style="width: 5.5rem"
        />
        <br />
        <br />
        <u>Gurukal Logistics</u>
      </div>
    </div>

    <div class="row mt-1">
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
  props: ["quote", "type"],
  data() {
    return {
      logo: require("./assets/logo-png-2.png"),
      sign: "https://i.ibb.co/W6vkYqs/seal.png",
    };
  },
};
</script>

<style  scoped>
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
  position: absolute;
  top: -1%;
  right: 15%;
}

.logo img {
  width: 20rem;
}

.main-title {
  color: #c0392b;
  font-weight: bolder;
}
</style>