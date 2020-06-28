<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col"></div>
      <div class="col">
        <a class="btn btn-primary text-white" onclick="javascript:window.print()">
          <i class="fas fa-print"></i> Print Docket
        </a>

        <button @click="$router.go(-1)" class="btn btn-dark ml-2">
          <i class="fas fa-arrow-left"></i> Return
        </button>
      </div>
    </div>

    <div class="card" ref="content">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <p>
              <b>DOCKET</b>
            </p>
          </div>
          <div class="col-7"></div>
          <div class="col">
            <p class="text-right">
              <b>ORIGINAL</b>
            </p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-3">
            <img :src="logo" style="max-width:20rem" />
          </div>
          <div class="col-6 caution-border text-center">
            <h1 class="text-danger" style="font-family:'Times New Roman';margin-bottom:-1rem;">
              <b>GURUKAL LOGISTICS</b>
            </h1>
            <p class="font-md">
              <br />
              <b>
                Transport Contractor
                <br />Anchepalya, Bangalore - 560073
                <br />Mob: +91 9620202001
                <br />E-mail : logistics@gurukal.co.in
                <br />Website: www.gurukal.co.in
                <br />GST No: 29AYGPS3509N2ZQ
              </b>
            </p>
          </div>
          <div class="col text-right">
            <p>Date: {{moment(shipment.date).format('DD/MM/YYYY')}}</p>
            <p>
              <b>Docket No: {{shipment.docket_no}}</b>
            </p>
            <br />
            <p>Transaction Type</p>
            <p>
              <span class="badge badge-pill badge-success">{{shipment.package_transaction_type}}</span>
            </p>
          </div>
        </div>
        <hr />

        <div class="row">
          <div class="col border border-danger p-2 m-2">
            <h6 class="text-danger text-center">CAUTION</h6>
            <p
              class="text-danger"
              style="font-size:0.8rem;"
            >This Consignment will not be detained delivered re-routed or re booked without consignee Banks written permission will be delivered at the destination</p>
          </div>
          <div class="col border border-success p-4 m-2">
            <h6 class="text-center">
              <b>DELIVERY ADDRESS</b>
              <hr />
              {{shipment.delivery_address}}
            </h6>
            <p style="font-size:0.8rem;"></p>
          </div>

          <div class="col border border-info p-2 m-2">
            <h6 class="text-info text-center">Notice</h6>
            <p class="text-info" style="font-size:0.8rem;">
              The consignment covered by this set of special lorry receipt from shall be stored at the destination under the control of the transport operator and
              shall be delivered t or to the order of the consignee bank whose name is mentioned in the lorry receipt it will under no circumstances be delivered
              to anyone without the written authority from the consignee bank or its order endorsed on the consignee copy or on a separate letter of Authority.
            </p>
          </div>
        </div>
        <hr />
        <div class="row mt-1">
          <div class="col">
            <p>Consignor:</p>
            {{shipment.sender.company_name}}
            <br />
            {{shipment.sender.address}}
            <p>Consignor GST: {{shipment.sender.gst}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </div>

          <div class="col mb-2">
            <h6>
              <p>Consignee</p>
              {{shipment.receiver.company_name}}
              <br />
              {{shipment.receiver.address}}
              <p>Consignee GST: {{shipment.receiver.gst}}</p>
            </h6>
            <p style="font-size:0.8rem;"></p>

            <h6>
              <b>
                Payment By:&nbsp;
                <span class="badge badge-pill badge-success">{{shipment.bill_to}}</span>
              </b>
              <br />
            </h6>
          </div>
        </div>

        <div class="row mt-1">
          <div class="col">
            <table class="table-bordered table">
              <thead>
                <th scope="col">SL No.</th>
                <th scope="col" style="width:20rem">Description</th>
                <th scope="col">Serial No.</th>
                <!-- <th scope="col">Docket No.</th> -->
                <th scope="col">Weight</th>
                <th scope="col">Declared value</th>
              </thead>
              <tr v-for="(item,index) in shipment.package">
                <th scope="row">{{index+1}}</th>
                <td>{{item.description}}</td>
                <td>{{item.serial_no}}</td>
                <td v-if="item.weight">{{item.weight}} Kg</td>
                <td v-else>--</td>
                <td>&#8377; {{item.cost}}</td>
              </tr>
            </table>

            <h6 class="mt-1">Consignment Note</h6>
            <p></p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <h6 class="text-danger text-center">
              <b>Payment Conditions</b>
            </h6>
            <p>
              Delivery of goods against freight & other charges only Payment by A/c payee in favour of
              M/s GURUKAL LOGISTICS only.
            </p>
            <hr />
            <p>
              IN CASE OF LOSS OR DAMAGE TO GOOOS THE LIABILITY OF THE CARRIER SHALL NOT EXCEED A SUM OF Rs 500). (FIVE HUNDRED ONLY)
              The company is not responsible for leakage, Breakage & Accident Damage Subject to Terms & Conditions of carriage printed overleaf.
            </p>
          </div>
        </div>
        <hr />
        <div class="row mt-2">
          <div class="col d-flex d-inline-block">
            <qrcode :value="shipment.freight_invoice_number" :options="{ width: 100 }"></qrcode>

            <barcode
              :value="shipment.freight_invoice_number"
              class="mt-2"
              id="barcode"
              :width="2"
              :height="50"
            >Show this if the rendering fails.</barcode>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-8"></div>

          <div class="col">
            <p>Receiver Sign with Seal</p>
          </div>
        </div>
      </div>
    </div>

    <div class="pagebreak"></div>

    <div class="card">
      <div class="card-body">
        <h6 class="text-center m-2 border border-secondary p-2">
          <b>Terms & Conditions of Carriage At Owner's Risk</b>
        </h6>
        <div class="row font-xs">
          <div class="col">
            <ul class="list-group">
              <li
                class="list-group-item"
              >The transport operator shall carry the goods at owner's risk and the customers viz, Consignors/ consignee will have to cover insurance at their costs. Otherwise the liability to transport operator will ceases to exist</li>
              <li
                class="list-group-item"
              >The transport operator is not responsible for loss or damage to goods entrusted to them due to fire in transit or their godown or accident to vehicle in transit or for losses / damages to goods due to natures fury / calamity, criminal activity of an unruly, mob, riots for Leakage or for Internal shortage of goods</li>
              <li
                class="list-group-item"
              >In case of door delivery consignments the transport operator undertakes to effect door delivery against payment of their accured charges and surrendering the original consignee's copy by the consignor consignee at the destination branch In case door delivery is refused by consignee the transport operator shall unload the goods at their nearest branch at the risk and costs of consignor consignee. In case the Vehicle is detained by consignee upon arrival the consignee will have to pay the detention as demanded by them to the transport operator</li>
              <li
                class="list-group-item"
              >Contractual based customer shall make payment as per agreement</li>
              <li
                class="list-group-item"
              >The customer undertake to obtain delivery of goods from the transport operators destination office within 3 day of their arrival by surrendering the original consignee copy of lorry receipt and payment of accured freight, octroi and other charges. Upon- failure by any customer to obtain delivery within 3 days of arnval, the transport operator would entitle to levy storage charges of Rs 8 00 per OH Or part the reof per day. it would be the obligation of holder of lorry receipt to ascertain the date and time to arrival, of goods from the destination office of the transport operator</li>
              <li
                class="list-group-item"
              >The transport operator shall not be able It has goods are detained, seized or confiscated by the Government authorities or local bodies or any reason whatsoever</li>
              <li
                class="list-group-item"
              >The delivery office cf the transport operator shall have the right to re-weight, re-measure and recalculate the freight amount mentioned on the lorry receipt and it would be binding on part of the consignee. Consignor or holder thereof pay the charge according to the calculation arrived at by the destination branch of the transport operator.</li>
            </ul>
          </div>
          <div class="col">
            <ul class="list-group">
              <li
                class="list-group-item"
              >The consignor is responsible, for all consequences of any Incorrect or false declarations made by him in his invoice copy surrendered to the transport operator at the booking branch</li>
              <li
                class="list-group-item"
              >The transport operator shall have the nght to entrust the goods to any other lorry or services for transport In the event of goods being so entrusted by transport operator to another carrier the other carries shall alone be responsible for any criminal acts of misappropriation or loss of goods, damage, breakage to the consignor, consignee or holder therof lorry receipt.</li>
              <li
                class="list-group-item"
              >No claim for loss or injury to goods shall be entertained by transport operator after expiry of six months form the date of booking</li>
              <li
                class="list-group-item"
              >In case of value not being declared at the time of booking of goods the transport operators Lability in case of loss or injury to goods shall not exceed Rs 100/- as per carriers act, and in any other the liability of transport operators shall not exceed Rs 100/-which would be applicable only in case the goods are not covered with insurance</li>
              <li
                class="list-group-item"
              >The tamer under takes to carry the goods covered under consignment Note under the contract of Personal Service and in case of any loss or damage to goods the liability of the carrier shall not exceed a sum of Rs. 500/-.</li>
              <li
                class="list-group-item"
              >The transport operator reserves his rights to with hold delivery of goods until freight and other charges accured are first paid by the consignor, consignee or holder thereof.</li>
              <li
                class="list-group-item"
              >The transport operator shall not be responsible for loss of market value of goods in case of delay in delivery at desbnation for reasons beyond the control of transport operator.</li>
              <li
                class="list-group-item"
              >Only the courts cf Bangalore shall have the junsdiction to decide any claim, dispute suit or any other legal proceeding arising under this contract of goods entrusted to the transport operator for transportation and delivery under this lorry receipt</li>
            </ul>
          </div>
          <div class="col">
            <ul class="list-group">
              <li
                class="list-group-item"
              >The transport operator shall have the right to dispose of perishable goods lying undelivered after 3 days or arrival at the destination with notice of 48 hours to the consignor, consignee and or holder thereof The sale proceeds to realized would be first adjusted against the transport operators dues and balance if remaining shall be remitted to the consignor, consignee or holder thereof In case after adjustment of dues of transport operator there remains further dues to the recovered by the transport operator then, the consignor, consignee or holder thereof shall be liable to pay the same to the transport operator</li>
              <li
                class="list-group-item"
              >In case of non penshable goods the transport operator shall have the nght to dispose itself within 30 days of arrival after giving to the Consignor, Consignee or holder there of 15 days notice and a runner reminder of a weak where after it the consignor, consignee or holder thereof fail to obtain delivery the goods would be sold by the transport operator without any further notice and the procedure as stated In clause 14 above would apply</li>
              <li class="list-group-item"></li>
              <li class="list-group-item">
                The transport operator not liable for leakage, breakage, or any loss or damage due to fire, Accident, Theft, Whether Conditions etc., in absence of any Negligence, default or misconduct.
                Received the consignment as per particulars overleaf from GURUKAL LOGISTICS properly packed in Dry, Sound and Good condition.
              </li>
              <h6 class="m-4">TERMS & CONDITIONS OF GST</h6>
              <li
                class="list-group-item"
              >Notificalon No. 17/2017-Central Tax (Rate), ',;:p dated 28106/2017 as amended by Notification c No. 20/2017-Central Tax (Rata), dated 22/08120172 the GST on GTA is 5% (CGST 2.5%, SGST 2.5%) 0 cf")</li>
              <li
                class="list-group-item"
              >The person liable to pay GST on this Invoice IE Consignor /Consignee.</li>
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

    <!-- <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <p>Sender Details</p>
                <p>Pickup Location : {{shipment.package_pickup_address}}</p>
                <p>Sender name : {{shipment.sender.name}}</p>
                <p>Contact : {{shipment.sender.phone}}</p>
              </div>
              <div class="col-3">
                <p>Receiver Details</p>
                <p>Dropoff Location : {{shipment.delivery_address}}</p>
                <p>Receiver Name : {{shipment.receiver.name}}</p>
                <p>Contact : {{shipment.receiver.phone}}</p>
              </div>
              <div class="col-3">
                <p>Transport Details</p>
                <p>Driver Name : {{shipment.transport_driver_name}}</p>
                <p>Contact : {{shipment.transport_driver_phone}}</p>
                <p>Vehicle Details : {{shipment.transport_driver_vehicle}}</p>
              </div>
              <div class="col-3">
                <p>Current Status</p>
                <p v-if="shipment_status.location">Location : {{shipment_status.location}}</p>
                <p v-else>Location: Not Updated</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </fragment>
</template>


<style>
.font-xs {
  font-size: 0.5rem;
}

.font-s {
  font-size: 0.8rem;
}

.font-md {
  font-size: 1.1rem;
}
@media print {
  .pagebreak {
    page-break-before: always;
  } /* page-break-after works, as well */
}
</style>

<script>
import VueBarcode from "vue-barcode";

export default {
  data() {
    return {
      logo: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
      status: "pickup"
    };
  },
  components: {
    barcode: VueBarcode
  },
  computed: {
    shipment() {
      return this.$store.getters.getSingleShipment;
    },
    shipment_status() {
      return this.$store.getters.getShipmentStatus;
    }
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
  }
};
</script>