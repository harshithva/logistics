<template>
  <fragment>
    <div>
      <img :src="logo" alt srcset class="bg-logo" />
    </div>

    <div class="row">
      <div class="col text-center">
        <h2 class="border-top text-white bg-box-dark p-4">DOCKET/LORRY RECEIPT</h2>
      </div>

      <div class="col">
        <div class="row">
          <div class="col ml-3">
            <h5 class="float-right ml-2">{{copy}}</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="row p-3">
      <div class="col-6 bg-light-box border-top">
        <h1
          class="main-title"
          style="font-family:'Times New Roman'; margin-bottom: -1rem;"
        >GURUKAL LOGISTICS</h1>
        <h5>
          <br />Anchepalya, Bangalore - 560073
          <br />
          <i class="fas fa-phone-alt"></i> &nbsp;+91 962 0202 001
          <br />
          <i class="fas fa-envelope"></i> &nbsp;logistics@gurukal.co.in
          <br />
          <b>
            <i class="fas fa-globe-americas"></i> &nbsp;www.gurukal.in
          </b>
          <br />GST No: 29AYGPS3509N2ZQ
        </h5>
      </div>
      <div class="col"></div>
      <div class="col-3 logo">
        <img :src="logo_text" style="max-width: 20rem;" />
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <h3 class="sub-title-red pt-2">
          <b>DOCKET NO: {{shipment.docket_no}}</b>
        </h3>
        <h5 class="border-top-dark pt-1">PAYMENT BY: {{shipment.bill_to }}</h5>
      </div>
      <div class="col">
        <h6 class="sub-title-red pt-1">DATE: {{shipment.date}}</h6>
        <h6 class="border-top-dark pt-1">VEHICLE NO: {{shipment.transport_driver_vehicle}}</h6>

        <h6 class="border-top-dark pt-1">TRANSACTION TYPE: {{shipment.package_transaction_type}}</h6>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col font-md">
        <h5>
          <i class="fas fa-user icon"></i>&nbsp;&nbsp;CONSIGNOR
        </h5>
        <h5>
          {{shipment.sender.company_name}}
          <br />
          {{shipment.sender.address}}
          <br />
          GST: {{shipment.sender.gst}}
        </h5>
      </div>
      <div class="col">
        <h5>
          <i class="fas fa-user icon"></i>&nbsp;&nbsp;CONSIGNEE
        </h5>
        <h5 class="underline">
          {{shipment.receiver.company_name}}
          <br />
          {{shipment.receiver.address}}
          <br />
          GST: {{shipment.receiver.gst}}
        </h5>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col">
        <table class="table-print table-bordered table-print-border-bottom">
          <thead>
            <th class="bg-red">SL No.</th>
            <th style="width: 20rem;" class="bg-red">Description</th>
            <th class="bg-red">Invoice No.</th>
            <th class="bg-red">Serial No.</th>
            <th class="bg-red">Weight</th>
            <th>Quantity</th>
            <th class="bg-red">Declared value</th>
          </thead>
          <tbody>
            <tr v-for="(data,index) in shipment.package">
              <th scope="row">{{index+1}}</th>
              <td>{{data.description}}</td>
              <td>{{data.invoice_no}}</td>
              <td>{{data.serial_no}}</td>
              <td>{{data.weight}} Kg</td>
              <td>{{data.quantity}}</td>
              <td>₹ {{data.cost}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-6">
        <table class="table-print table-bordered table-responsive-sm font-dark">
          <thead>
            <th class="bg-red" style="width:13rem">Eway Bill</th>
            <th class="bg-red" style="width:13rem">Insurance No</th>
            <th class="bg-red" style="width:13rem">Insurance Agent</th>
          </thead>
          <tr v-for="data in shipment.insurance">
            <td>{{data.eway_bill}}</td>
            <td>{{data.insurance_no}}</td>
            <td>{{data.insurance_agent}}</td>
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
        <h6 class="mt-3">Remarks: {{shipment.remarks}}</h6>
      </div>
    </div>

    <div class="row">
      <div class="col bg-dark text-white p-2 mt-3 mb-3 ml-2">
        <h5>Payment Condition</h5>
        <ol>
          <li>
            Delivery of goods against freight & other charges only Payment by A/c payee in favour of M/s
            GURUKAL
            LOGISTICS only.
          </li>
          <li>
            IN CASE OF LOSS OR DAMAGE TO GOOOS THE LIABILITY OF THE CARRIER SHALL NOT EXCEED A SUM OF Rs
            500).
            (FIVE HUNDRED ONLY) The company is not responsible for leakage, Breakage & Accident Damage
            Subject
            to Terms & Conditions of carriage printed overleaf.
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

    <div class="font-s">
      <div class="card-body">
        <h6 class="text-center border border-secondary pb-2 pt-2 bg-dark text-white mb-2">
          Terms &amp;
          Conditions of
          Carriage At
          Owner's
          Risk
        </h6>
        <div class="row">
          <div class="col">
            <ul class="list-group">
              <li class="list-group-item">
                The transport operator shall carry the goods at owner's risk and
                the customers viz, Consignors/ consignee will have to cover insurance at their costs.
                Otherwise the liability to transport operator will ceases to exist
              </li>
              <li class="list-group-item">
                The transport operator is not responsible for loss or damage to
                goods entrusted to them due to fire in transit or their godown or accident to vehicle in
                transit or for losses / damages to goods due to natures fury / calamity, criminal
                activity of an unruly, mob, riots for Leakage or for Internal shortage of goods
              </li>
              <li class="list-group-item">
                In case of door delivery consignments the transport operator
                undertakes to effect door delivery against payment of their accured charges and
                surrendering the original consignee's copy by the consignor consignee at the destination
                branch In case door delivery is refused by consignee the transport operator shall unload
                the goods at their nearest branch at the risk and costs of consignor consignee. In case
                the Vehicle is detained by consignee upon arrival the consignee will have to pay the
                detention as demanded by them to the transport operator
              </li>
              <li class="list-group-item">
                The customer undertake to obtain delivery of goods from the
                transport operators destination office within 3 day of their arrival by surrendering the
                original consignee copy of lorry receipt and payment of accured freight, octroi and
                other charges. Upon- failure by any customer to obtain delivery within 3 days of arnval,
                the transport operator would entitle to levy storage charges of Rs 8 00 per OH Or part
                the reof per day. it would be the obligation of holder of lorry receipt to ascertain the
                date and time to arrival, of goods from the destination office of the transport operator
              </li>
              <li class="list-group-item">
                The transport operator shall not be able It has goods are
                detained, seized or confiscated by the Government authorities or local bodies or any
                reason whatsoever
              </li>
              <li class="list-group-item">
                The delivery office cf the transport operator shall have the
                right to re-weight, re-measure and recalculate the freight amount mentioned on the lorry
                receipt and it would be binding on part of the consignee. Consignor or holder thereof
                pay the charge according to the calculation arrived at by the destination branch of the
                transport operator.
              </li>
            </ul>
          </div>
          <div class="col">
            <ul class="list-group">
              <li class="list-group-item">
                The consignor is responsible, for all consequences of any
                Incorrect or false declarations made by him in his invoice copy surrendered to the
                transport operator at the booking branch
              </li>
              <li class="list-group-item">
                The transport operator shall have the nght to entrust the goods
                to any other lorry or services for transport In the event of goods being so entrusted by
                transport operator to another carrier the other carries shall alone be responsible for
                any criminal acts of misappropriation or loss of goods, damage, breakage to the
                consignor, consignee or holder therof lorry receipt.
              </li>
              <li class="list-group-item">
                No claim for loss or injury to goods shall be entertained by
                transport operator after expiry of six months form the date of booking
              </li>
              <li
                class="list-group-item"
              >Contractual based customer shall make payment as per agreement</li>
              <li class="list-group-item">
                In case of value not being declared at the time of booking of
                goods the transport operators Lability in case of loss or injury to goods shall not
                exceed Rs 100/- as per carriers act, and in any other the liability of transport
                operators shall not exceed Rs 100/-which would be applicable only in case the goods are
                not covered with insurance
              </li>
              <li class="list-group-item">
                The tamer under takes to carry the goods covered under
                consignment Note under the contract of Personal Service and in case of any loss or
                damage to goods the liability of the carrier shall not exceed a sum of Rs. 500/-.
              </li>
              <li class="list-group-item">
                The transport operator reserves his rights to with hold delivery
                of goods until freight and other charges accured are first paid by the consignor,
                consignee or holder thereof.
              </li>
              <li class="list-group-item">
                The transport operator shall not be responsible for loss of
                market value of goods in case of delay in delivery at desbnation for reasons beyond the
                control of transport operator.
              </li>
              <li class="list-group-item">
                Only the courts cf Bangalore shall have the junsdiction to
                decide any claim, dispute suit or any other legal proceeding arising under this contract
                of goods entrusted to the transport operator for transportation and delivery under this
                lorry receipt
              </li>
            </ul>
          </div>
          <div class="col">
            <ul class="list-group">
              <li class="list-group-item">
                The transport operator shall have the right to dispose of
                perishable goods lying undelivered after 3 days or arrival at the destination with
                notice of 48 hours to the consignor, consignee and or holder thereof The sale proceeds
                to realized would be first adjusted against the transport operators dues and balance if
                remaining shall be remitted to the consignor, consignee or holder thereof In case after
                adjustment of dues of transport operator there remains further dues to the recovered by
                the transport operator then, the consignor, consignee or holder thereof shall be liable
                to pay the same to the transport operator
              </li>
              <li class="list-group-item">
                In case of non penshable goods the transport operator shall have
                the nght to dispose itself within 30 days of arrival after giving to the Consignor,
                Consignee or holder there of 15 days notice and a runner reminder of a weak where after
                it the consignor, consignee or holder thereof fail to obtain delivery the goods would be
                sold by the transport operator without any further notice and the procedure as stated In
                clause 14 above would apply
              </li>
              <li class="list-group-item"></li>
              <li class="list-group-item">
                The transport operator not liable for leakage, breakage, or any loss or damage due to
                fire, Accident, Theft, Whether Conditions etc., in absence of any Negligence, default or
                misconduct.
                Received the consignment as per particulars overleaf from GURUKAL LOGISTICS properly
                packed in Dry, Sound and Good condition.
              </li>
              <h6 class="m-4">TERMS &amp; CONDITIONS OF GST</h6>
              <li class="list-group-item">
                Notificalon No. 17/2017-Central Tax (Rate), ',;:p dated
                28106/2017 as amended by Notification c No. 20/2017-Central Tax (Rata), dated
                22/08120172 the GST on GTA is 5% (CGST 2.5%, SGST 2.5%) 0 cf")
              </li>
              <li class="list-group-item">
                The person liable to pay GST on this Invoice IE Consignor
                /Consignee.
              </li>
              <li class="list-group-item">
                ITC NOT availed by the service provider." -o 0. co
                Signature of authorized representative of the consignor / Consignee with Rubber Stamp
              </li>
              <li class="list-group-item">Date........................</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="pagebreak"></div>
  </fragment>
</template>

<script>
export default {
  props: ["shipment", "copy"],
  data() {
    return {
      logo: require("./assets/logo-png-2.png"),

      logo_text: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
    };
  },
  computed: {
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
  top: 20%;
  left: 8%;
  position: absolute;
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
  position: absolute;
  top: 15%;
  right: 16%;
}

.logo img {
  width: 20rem;
}

.main-title {
  color: #c0392b;
  font-weight: bolder;
}
@media print {
  .logo {
    position: absolute;
    top: 1%;
    right: 16%;
  }
}
</style>