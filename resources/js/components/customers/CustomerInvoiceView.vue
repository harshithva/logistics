<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none" v-if="!loading">
      <div class="col-3">
        <p>
          Delivery Status :
          <span class="badge badge-pill badge-primary">Dispatched</span>
        </p>
        <p>Balance Amount : 5415</p>
      </div>
      <div class="col-9">
        <a class="btn btn-primary text-white" onclick="javascript:window.print()">
          <i class="fas fa-print"></i> Print Invoice
        </a>

        <router-link to="/admin/customers/1/invoices/1/view/docket" class="btn btn-warning ml-2">
          <i class="fas fa-check"></i> Docket
        </router-link>

        <button class="btn btn-secondary ml-2">
          <i class="fas fa-download"></i> Download
        </button>
        <a href class="btn btn-info ml-2">
          <i class="fas fa-envelope"></i> Mail
        </a>
        <a href class="btn btn-warning ml-2">
          <i class="fas fa-envelope"></i> Status
        </a>
        <a href class="btn btn-outline-success ml-2">
          <i class="fas fa-envelope"></i> Add Payment
        </a>

        <a href class="btn btn-dark ml-2">
          <i class="fas fa-check"></i> Edit
        </a>
      </div>
    </div>
    <div class="row d-print-none">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <p>Sender Details</p>
                <p>
                  Pickup Location :
                  <br />
                  {{form.package_pickup_address}}
                </p>
                <p>Sender name : {{form.sender.name}}</p>
                <p>Contact : {{form.sender.phone}}</p>
              </div>
              <div class="col-3">
                <p>Receiver Details</p>
                <p>
                  Dropoff Location :
                  <br />
                  {{form.delivery_address}}
                </p>
                <p>Receiver Name : {{form.receiver.name}}</p>
                <p>Contact : {{form.receiver.phone}}</p>
              </div>
              <div class="col-3">
                <p>Transport Details</p>
                <p>Driver Name : {{form.transport_driver_name}}</p>
                <p>Contact : {{form.transport_driver_phone}}</p>
                <p>Vechile Details : {{form.transport_driver_vehicle}}</p>
              </div>
              <div class="col-3">
                <p>Current Status</p>
                <p>Location : Mysore</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card" ref="content">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <p>GST No: 29AYGPS3509N2Q</p>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <img :src="logo" style="max-width:8rem" />
          </div>
          <div class="col"></div>
          <div class="col">
            <h5>
              <b>FREIGHT INVOICE</b>
            </h5>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <p>
              GURUKAL LOGISTICS
              <br />Anchepalya, Bangalore - 560073
              <br />Mob: +91 9620202001
              <br />E-mail : logistics@gurukal.co.in
              <br />Website: www.gurukal.co.in
              <br />
            </p>
          </div>
          <div class="col"></div>
          <div class="col">
            <p>Date of Invoice: {{moment(form.created_at).format('DD/MM/YYYY')}}</p>
            <p>Invoice No.</p>
            <p>Transaction Type</p>
            <p>
              <span class="badge badge-pill badge-success">{{form.package_transaction_type}}</span>
            </p>
            <p>
              Payment Status :
              <span class="badge badge-pill badge-warning">---</span>
            </p>
          </div>
        </div>
        <hr />
        <div class="row mt-2">
          <div class="col">
            <p>BILL TO</p>
            {{form.sender.address}}
            <!-- <p v-if="form.bill_to == 'Consginor'">{{form.sender.address}}</p>
            <p v-if="form.bill_to == 'Consginee'">{{form.receiver.address}}</p>-->
          </div>

          <div class="col">
            Consignor Name: {{form.sender.company_name}}
            <br />
            {{form.sender.address}}
          </div>
        </div>

        <div class="row mt-2">
          <div class="col"></div>
          <div class="col">Consignor GST: {{form.sender.gst}}</div>
        </div>
        <br />

        <div class="row">
          <div class="col"></div>
          <div class="col">
            <p>
              Consignee Name: {{form.receiver.name}}
              <br />
              {{form.receiver.address}}
            </p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col"></div>
          <div class="col">Consignee GST {{form.receiver.gst}}</div>
        </div>
        <br />

        <div class="row mt-2">
          <div class="col-8">
            <table class="table-bordered table">
              <thead>
                <th scope="col">SL No.</th>
                <th scope="col" style="width:20rem">Description</th>
                <th scope="col">Weight</th>
                <th scope="col">Serial No.</th>
                <th scope="col">Docket No.</th>
              </thead>
              <tr v-for="(item,index) in form.package">
                <th scope="row">{{index+1}}</th>
                <td>{{item.description}}</td>
                <td>{{item.weight}} kg</td>
                <td>{{item.serial_no}}</td>
                <td>{{item.invoice_no}}</td>
              </tr>
            </table>

            <table class="table-bordered table" style>
              <tr>
                <th scope="row">Advance Paid</th>
                <td>500</td>
              </tr>
              <tr>
                <th scope="row">Balance Amount</th>
                <td>500</td>
              </tr>
            </table>

            <h6 class="mt-4">Remarks</h6>
            <p>{{form.remarks}}</p>
          </div>
          <div class="col">
            <table class="table-bordered table">
              <!-- <thead>
                <th scope="col" colspan="4" class="text-center">Amount</th>
              </thead>-->
              <tr>
                <th scope="row">Transportation</th>
                <td>{{form.charge_transportation}}</td>
              </tr>

              <tr>
                <th scope="row">Handling</th>
                <td>{{form.charge_handling}}</td>
              </tr>
              <tr>
                <th scope="row">ODC Charges</th>
                <td>{{form.charge_odc}}</td>
              </tr>

              <tr>
                <th scope="row">Halting</th>
                <td>{{form.charge_halting}}</td>
              </tr>

              <tr>
                <th scope="row">Insurance</th>
                <td>{{form.charge_Insurance}}</td>
              </tr>
              <tr>
                <th scope="row">GST</th>
                <td>{{form.charge_tax_amount}}</td>
              </tr>
              <tr>
                <th>Total</th>
                <td>{{form.charge_total}}</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <h6>Terms & Conditions</h6>
            <ol>
              <li>Remittance of payment within 7 days of invoice receipt.</li>
              <li>A 10 % charge will be applied for every month of late payment.</li>
              <li>GST Payable by Freight Bearer</li>
            </ol>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <p>
              Bank Details
              <br />Name : Axis Bank
              <br />8th Mile Branch
              <br />A/c No.: 918020030455515
              <br />IFSC: UTIB0002926
              <br />
            </p>
          </div>
          <div class="col-6"></div>
          <div class="col">
            <p>
              For and behalf of
              <br />
              <br />
              <br />
              <u>Gurukal Logistics</u>
            </p>
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>

<script>
export default {
  data() {
    return {
      logo: "https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg",
      loading: false
    };
  },
  computed: {
    form() {
      return new Form(this.$store.getters.getSingleShipment[0]);
    }
    // sender() {
    //   return this.shipment.sender ? this.shipment.sender : "";
    // },
    // package() {
    //   return this.shipment.package ? this.shipment.package : "";
    // }
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleShipment",
      this.$route.params.invoice_id
    );
  }
};
</script>