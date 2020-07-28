<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-3">
        <p>
          Delivery Status :
          <span
            class="badge badge-pill badge-primary"
            v-model="shipment_status.status !== ''"
          >{{shipment_status.status}}</span>
        </p>
        <p>Balance Amount : {{balance_amount.balance_amount}}</p>
      </div>
      <div class="col-9">
        <a class="btn btn-primary text-white btn-sm" onclick="javascript:window.print()">
          <i class="fas fa-print"></i> Print Invoice
        </a>

        <router-link
          :to="'/admin/customers/'+ shipment.sender.id +'/invoices/'+ shipment.id +'/view/docket'"
          class="btn btn-warning ml-2 btn-sm"
        >
          <i class="fas fa-check"></i> Docket
        </router-link>
        <button @click.prevent="sendMail" class="btn btn-info ml-2 btn-sm">
          <i class="fas fa-envelope"></i> Mail
        </button>

        <button @click.prevent="sendSms" class="btn btn-danger ml-2 btn-sm">
          <i class="fas fa-envelope"></i> Sms
        </button>
        <button
          type="button"
          class="btn btn-outline-info btn-sm ml-2"
          data-toggle="modal"
          data-target="#updatestatus"
        >
          <span>
            <i class="fas fa-scroll"></i>
          </span>&nbsp;
          Status
        </button>
        <button
          type="button"
          class="btn btn-success btn-sm ml-2"
          data-toggle="modal"
          data-target="#paymentmodal"
          @click="payment.payment_date = moment(new Date).format('DD/MM/YYYY')"
        >
          <span>
            <i class="fas fa-rupee-sign"></i>
          </span>
          Add Payment
        </button>
        <router-link
          :to="'/admin/shipments/' + shipment.id +'/edit'"
          class="btn btn-dark ml-2 btn-sm"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-check"></i> Edit
        </router-link>
      </div>
    </div>
    <div class="row d-print-none">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <!-- errors -->
            <b-alert
              v-if="payment.errors.has('amount')"
              dismissible
              show
              variant="danger"
            >{{payment.errors.get('amount')}}</b-alert>
            <div class="row">
              <div class="col-4">
                <p>Sender Details</p>
                <p>
                  Pickup Location :
                  <br />
                  {{shipment.package_pickup_address}}
                </p>
                <p>Sender name : {{shipment.sender.name}}</p>
                <p>Contact : {{shipment.sender.phone}}</p>
              </div>
              <div class="col-4">
                <p>Receiver Details</p>
                <p>
                  Dropoff Location :
                  <br />
                  {{shipment.delivery_address}}
                </p>
                <p>Receiver Name : {{shipment.receiver.name}}</p>
                <p>Contact : {{shipment.receiver.phone}}</p>
              </div>
              <div class="col-4">
                <p>Transport Details</p>
                <p>Driver Name : {{shipment.transport_driver_name}}</p>
                <p>Contact : {{shipment.transport_driver_phone}}</p>
                <p>Vehicle Details : {{shipment.transport_driver_vehicle}}</p>
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
            <p>GST No: 29AYGPS3509N2ZQ</p>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <img :src="logo" style="max-width:10rem" />
          </div>
          <div class="col"></div>
          <div class="col">
            <h5 style="font-size:2rem">
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
            <p style="font-size:1.3rem">
              <b>Invoice No: {{shipment.freight_invoice_number}}</b>
            </p>
            <p>Date of Invoice: {{moment(shipment.date).format('DD/MM/YYYY')}}</p>

            <p>Transaction Type</p>
            <p>
              <span class="badge badge-pill badge-success">{{shipment.package_transaction_type}}</span>
            </p>
            <p>
              Payment Status :
              <span
                class="badge badge-pill badge-success"
                v-if="balance_amount.balance_amount <= 0"
              >Paid</span>
              <span
                class="badge badge-pill badge-danger"
                v-else-if="balance_amount.balance_amount == shipment.charge_total"
              >Pending</span>

              <span class="badge badge-pill badge-warning" v-else>Partial</span>
            </p>
          </div>
        </div>
        <hr />
        <div class="row mt-2">
          <div class="col">
            <p>BILL TO</p>

            <p v-if="shipment.bill_to == 'consignor'">
              {{shipment.sender.company_name}}
              <br />
              {{shipment.sender.address}}
            </p>
            <p v-else-if="shipment.bill_to == 'consignee'">
              {{shipment.receiver.company_name}}
              <br />
              {{shipment.receiver.address}}
            </p>

            <p v-else>
              {{shipment.sender.company_name}}
              <br />
              {{shipment.sender.address}}
            </p>
          </div>

          <div class="col font-dark">
            Consignor Name:
            <br />
            {{shipment.sender.company_name}}
            <br />
            {{shipment.sender.address}}
            <br />
            GST: {{shipment.sender.gst}}
          </div>
        </div>

        <div class="row mt-2">
          <div class="col"></div>
          <div class="col">
            <p>
              Consignee Name:
              <br />
              {{shipment.receiver.company_name}}
              <br />
              {{shipment.receiver.address}}
              <br />
              GST: {{shipment.receiver.gst}}
            </p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-8">
            <table class="table-bordered table font-dark">
              <thead>
                <th scope="col">SL No.</th>
                <th scope="col" style="width:20rem">Description</th>
                <th scope="col">Weight</th>
                <th scope="col">Quantity</th>
                <th scope="col">Serial No.</th>
                <th scope="col">Docket No.</th>
              </thead>
              <tr v-for="(item,index) in shipment.package">
                <th scope="row">{{index+1}}</th>
                <td>{{item.description}}</td>
                <td>{{item.weight}} kg</td>
                <td>{{item.quantity}}</td>
                <td>{{item.serial_no}}</td>
                <td>{{shipment.docket_no}}</td>
              </tr>
            </table>

            <table class="table-bordered table font-dark" style>
              <tr>
                <th scope="row">Advance Paid</th>
                <td>{{shipment.charge_advance_paid}}</td>
              </tr>
              <tr>
                <th scope="row">Balance Amount</th>
                <td>{{balance_amount.balance_amount}}</td>
              </tr>
            </table>

            <h6 class="mt-3 font-dark">Remarks</h6>
            <p>{{shipment.remarks}}</p>
          </div>
          <div class="col">
            <table class="table-bordered table font-dark">
              <!-- <thead>
                <th scope="col" colspan="4" class="text-center">Amount</th>
              </thead>-->
              <tr>
                <th scope="row">Transportation</th>
                <td>{{shipment.charge_transportation}}</td>
              </tr>

              <tr>
                <th scope="row">Handling</th>
                <td>{{shipment.charge_handling}}</td>
              </tr>
              <tr>
                <th scope="row">ODC Charges</th>
                <td>{{shipment.charge_odc}}</td>
              </tr>

              <tr>
                <th scope="row">Halting</th>
                <td>{{shipment.charge_halting}}</td>
              </tr>

              <tr>
                <th scope="row">Insurance</th>
                <td>{{shipment.charge_Insurance}}</td>
              </tr>
              <tr>
                <th scope="row">GST</th>
                <td>{{shipment.charge_tax_amount}}</td>
              </tr>
              <tr>
                <th>Total</th>
                <td>{{shipment.charge_total}}</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col font-dark">
            <h6>Terms & Conditions</h6>
            <ol>
              <li>Remittance of payment within 7 days of invoice receipt.</li>
              <li>A 10 % charge will be applied for every month of late payment.</li>
              <li>GST Payable by Freight Bearer</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p>
              Bank Details
              <br />Name : Axis Bank
              <br />8th Mile Branch
              <br />A/c No.: 918020030455515
              <br />IFSC: UTIB0002926
              <br />
            </p>
            <!-- <p class="mt-4">This is a computer generated invoice.</p> -->
          </div>
          <div class="col-6"></div>
          <div class="col">
            <p>For and behalf of</p>
            <img :src="sign" alt="Rohith" class="img-fluid" style="width:5.5rem;" />
            <br />
            <br />

            <u>Gurukal Logistics</u>
          </div>
        </div>
        <div class="row">
          <div
            class="col text-center"
          >This is a computer generated document No seal and signature required.</div>
        </div>
      </div>
    </div>

    <!-- Payment Modal-->

    <div
      class="modal fade d-print-none"
      id="paymentmodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @keydown="payment.errors.clear()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Payment Date</label>

                    <input type="text" class="form-control" v-model="payment.payment_date" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Payment Type</label>
                    <select
                      class="custom-select"
                      id="inputGroupSelect04"
                      aria-label="Example select with button addon"
                      v-model="payment.payment_type"
                    >
                      <option selected disabled>Choose</option>
                      <option value="cash">Cash</option>
                      <option value="bank">Bank</option>
                      <option value="upi">UPI</option>
                      <option value="cheque">Cheque</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Amount</label>
                    <input type="text" class="form-control" v-model="payment.amount" />
                  </div>
                </div>
              </div>

              <div class="row" v-if="payment.payment_type === 'bank'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">Bank Name</label>
                    <input type="text" class="form-control" v-model="payment.bank_name" />
                  </div>
                </div>
              </div>
              <div class="row" v-if="payment.payment_type === 'upi'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">UPI Ref ID</label>
                    <input type="text" class="form-control" v-model="payment.upi_ref_id" />
                  </div>
                </div>
              </div>
              <div class="row" v-if="payment.payment_type === 'cheque'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">Cheque No</label>
                    <input type="text" class="form-control" v-model="payment.cheque_no" />
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click.prevent="addPayment"
              data-dismiss="modal"
            >Add</button>
          </div>
        </div>
      </div>
    </div>

    <!-- update status modal  -->

    <div
      class="modal fade d-print-none"
      id="updatestatus"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="input-group m-2">
                <select
                  class="custom-select"
                  id="inputGroupSelect04"
                  aria-label="Example select with button addon"
                  v-model="status.status"
                >
                  <option disabled>Shipment Status</option>
                  <option value="Awaiting Pickup">Awaiting Pickup</option>
                  <option value="Dispatched">Dispatched</option>
                  <option value="Intransit">Intransit</option>
                  <option value="Delivered">Delivered</option>
                </select>
              </div>

              <div v-if="status.status == 'Delivered'">
                <div class="col">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="status.location"
                      placeholder="Location"
                    />
                  </div>
                </div>

                <div class="row m-1">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Receiver Name"
                        v-model="status.receiver_name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Phone"
                        v-model="status.phone"
                      />
                    </div>
                  </div>
                </div>

                <div class="row m-1 d-print-none">
                  <div class="col">
                    <b-form-file v-model="status.document" ref="file-input" class="mb-2"></b-form-file>
                  </div>
                  <div class="col">
                    <b-button @click="clearFiles" class="mr-2">Reset</b-button>
                  </div>
                </div>
              </div>

              <div v-else-if="status.status == 'Awaiting Pickup'" class="d-print-none"></div>
              <div v-else>
                <div class="row m-2">
                  <div class="col">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control d-print-none"
                        placeholder="Location"
                        v-model="status.location"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary d-print-none" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click.prevent="updateStatus"
              data-dismiss="modal"
            >Update</button>
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
      sign: "https://i.ibb.co/gySNn0G/sign-rohith.png",
      status: new Form({
        status: "Awaiting Pickup",
        customer_id: "",
        shipment_id: "",
        location: "",
        receiver_name: "",
        phone: "",
        document: null,
      }),
      payment: new Form({
        payment_type: "cash",
        amount: "0",
        payment_date: "",
        bank_name: "",
        upi_ref_id: "",
        cheque_no: "",
        shipment_id: "",
        customer_id: "",
      }),
    };
  },
  computed: {
    shipment() {
      return this.$store.getters.getSingleShipment;
    },
    balance_amount() {
      return this.$store.getters.getShipmentBalanceAmount;
    },
    shipment_status() {
      return this.$store.getters.getShipmentStatus;
    },
  },
  methods: {
    addPayment() {
      this.payment.shipment_id = this.shipment.id;

      if (this.shipment.bill_to == "consignor") {
        this.payment.customer_id = this.shipment.sender.id;
      } else if (this.shipment.bill_to == "consignee") {
        this.payment.customer_id = this.shipment.receiver.id;
      } else {
        this.payment.customer_id = this.shipment.sender.id;
      }

      if (this.payment.amount == 0 || "") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Amount cannot be 0",
        });
        return;
      }
      this.payment
        .submit("post", "api/shipments/" + this.shipment.id + "/payments")
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Well done! Payment added",
            showConfirmButton: false,
            timer: 1500,
          });

          this.$store.dispatch(
            "retrieveShipmentBalanceAmount",
            this.$route.params.invoice_id
          );

          this.balance_amount = this.$store.getters.getShipmentBalanceAmount;

          this.payment.received_from = "consignor";
          this.payment.amount = 0;
          this.payment.payment_type = "cash";
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
    updateStatus() {
      this.status.shipment_id = this.shipment.id;
      this.status.customer_id = this.shipment.sender.id;
      const last_status = this.shipment.status;
      this.status
        .submit("post", "api/shipments/" + this.shipment.id + "/status")
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Shipment Status Updated",
            showConfirmButton: false,
            timer: 1500,
          });

          this.$store.dispatch(
            "retrieveShipmentStatus",
            this.$route.params.invoice_id
          );

          this.shipment_status = this.$store.getters.getShipmentStatus;

          this.status.status = last_status;
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        });
    },
    sendMail() {
      axios
        .post(`/api/shipments/${this.shipment.id}/shipment_send_email`)
        .then(function (response) {
          Swal.fire("Good job!", "Email Sent Successfully", "success");
        })
        .catch(function (error) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Check Whether Sender email is valid",
          });
        });
    },
    sendSms() {
      axios
        .post(`/api/shipments/${this.shipment.id}/shipment_send_sms`)
        .then(function (response) {
          Swal.fire("Good job!", "Sms Sent Successfully", "success");
        })
        .catch(function (error) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Check Whether Sender phone number is valid",
          });
        });
    },
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleShipment",
      this.$route.params.invoice_id
    );
    this.$store.dispatch(
      "retrieveShipmentBalanceAmount",
      this.$route.params.invoice_id
    );
    this.$store.dispatch(
      "retrieveShipmentStatus",
      this.$route.params.invoice_id
    );
  },
};
</script>