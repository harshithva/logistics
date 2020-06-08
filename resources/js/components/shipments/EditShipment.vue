<template>
  <fragment>
    <div>
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div id="loader" style="display:none"></div>
              <div id="msgholder"></div>
              <h4 class="mb-4">Shipment Info</h4>
              <!-- show errors -->

              <b-alert
                v-if="shipment.errors.has('sender_id')"
                dismissible
                show
                variant="danger"
              >{{shipment.errors.get('sender_id')}}</b-alert>

              <b-alert
                v-if="shipment.errors.has('receiver_id')"
                dismissible
                show
                variant="danger"
              >{{shipment.errors.get('receiver_id')}}</b-alert>

              <b-alert
                v-if="shipment.errors.has('charge_total')"
                dismissible
                show
                variant="danger"
              >{{shipment.errors.get('charge_total')}}</b-alert>

              <b-alert
                v-if="shipment.errors.has('document')"
                dismissible
                show
                variant="danger"
              >{{shipment.errors.get('document')}}</b-alert>
              <!-- end errors -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Shipment Date</label>

                    <input
                      type="text"
                      class="form-control"
                      :value="moment(new Date).format('DD/MM/YYYY')"
                      disabled
                    />
                  </div>
                </div>
              </div>
              <form
                class="form-horizontal form-material"
                action="/admin/shipments"
                @keydown="shipment.errors.clear()"
                enctype="multipart/form-data"
              >
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-2">Sender Info</h6>
                    <div class="form-group">
                      <v-select :options="customers" label="name" @input="selectCustomer($event)"></v-select>
                      <div class="mt-2">
                        <router-link to="/admin/customers/create">Add new</router-link>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h6 class="mb-2">Receiver Info</h6>
                    <div class="form-group">
                      <v-select :options="customers" label="name" @input="selectReceiver($event)"></v-select>
                      <div class="mt-2">
                        <router-link to="/admin/customers/create">Add new</router-link>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="delivery_address">Delivery Address</label>
                      <textarea
                        class="form-control"
                        id="delivery_address"
                        rows="3"
                        v-model="shipment.delivery_address"
                      ></textarea>
                    </div>
                  </div>
                </div>

                <hr />
                <h6 class="mb-4">Package Pickup Location</h6>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.package_contact_person"
                        placeholder="Contact Person"
                      />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.package_contact_person_phone"
                        placeholder="Phone"
                      />
                    </div>
                  </div>
                </div>

                <div class="input-group mb-2">
                  <select
                    class="custom-select"
                    aria-label="Select Transaction Type"
                    v-model="shipment.package_transaction_type"
                  >
                    <option selected disabled>Transaction Type</option>

                    <option value="Full Load">Full Load</option>
                    <option value="Part Load">Part Load</option>
                  </select>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Pickup Address</label>
                      <textarea
                        class="form-control"
                        id="pickup_address"
                        rows="3"
                        v-model="shipment.package_pickup_address"
                      ></textarea>
                    </div>
                  </div>
                </div>

                <h6 class="mb-4">Transport Details</h6>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.transport_company_name"
                        placeholder="Company Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.transport_company_phone"
                        placeholder="Phone"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.transport_driver_name"
                        placeholder="Driver Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.transport_driver_phone"
                        placeholder="Driver Phone number"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.transport_driver_vehicle"
                        placeholder="Vehicle Details"
                      />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea
                        class="form-control"
                        v-model="shipment.user_notes"
                        rows="6"
                        placeholder="User Notes - For internal use only."
                      ></textarea>
                    </div>
                  </div>
                </div>

                <h6 class="mb-4">Add Package Details</h6>

                <table class="table table-responsive-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                      <th scope="col">Serial No</th>
                      <th scope="col">Invoice No</th>
                      <th scope="col">Size</th>
                      <th scope="col">Weight</th>
                      <th scope="col">Cost</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in shipment.package" :key="index">
                      <td>{{index+1}}</td>
                      <td>{{item.description}}</td>
                      <td>{{item.serial_no}}</td>
                      <td>{{item.invoice_no}}</td>
                      <td>{{item.size}}</td>
                      <td>{{item.weight}}</td>
                      <td>{{item.cost}}</td>
                      <td @click="deletePackage(item.uid)">
                        <i class="fas fa-times text-danger"></i>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#exampleModal"
                        >Add</button>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <hr />
                <h6 class="mb-4">Additional Expenses</h6>
                <div class="row mb-2">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="transportation">Transportation</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="shipment.charge_transportation"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Handling</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="shipment.charge_handling"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Halting</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="shipment.charge_halting"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Insurance</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="shipment.charge_Insurance"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>ODC Charges</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="shipment.charge_odc"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tax Percent (%)</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="shipment.charge_tax_percent"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Advance Paid</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="shipment.charge_advance_paid"
                      />
                    </div>
                  </div>
                </div>

                <hr />
                <div class="row m-2">
                  <div class="col">
                    <p>Total Taxes</p>
                  </div>
                  <div class="col">
                    <input
                      type="number"
                      class="form-control float-right"
                      @change="calculateTotal"
                      v-model="shipment.charge_tax_amount"
                      style="width:8rem;"
                    />
                  </div>
                </div>

                <div class="row m-2">
                  <div class="col">
                    <p>Total</p>
                  </div>
                  <div class="col">
                    <input
                      type="number"
                      @change="calculateTotal"
                      class="form-control float-right"
                      v-model="shipment.charge_total"
                      placeholder="Total"
                      style="width:8rem;"
                    />
                  </div>
                </div>

                <div class="row m-2">
                  <div class="col">
                    <p>Balance</p>
                  </div>
                  <div class="col">
                    <input
                      type="number"
                      @change="calculateTotal"
                      class="form-control float-right"
                      v-model="shipment.charge_balance"
                      style="width:8rem;"
                    />
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <textarea
                      class="form-control"
                      rows="6"
                      placeholder="Remarks"
                      v-model="shipment.remarks"
                    ></textarea>
                  </div>
                </div>

                <div class="row m-2">
                  <div class="col">
                    <p class="form-check-inline">Bill To</p>
                    <b-form-group label="Individual radios">
                      <b-form-radio
                        v-model="shipment.bill_to"
                        name="some-radios"
                        value="Consignor"
                      >Consignor</b-form-radio>
                      <b-form-radio
                        v-model="shipment.bill_to"
                        name="some-radios"
                        value="Consignee"
                      >Consignee</b-form-radio>
                    </b-form-group>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <!-- <button
                      type="button"
                      class="btn btn-outline-success btn-confirmation"
                      data-toggle="modal"
                      data-target="#paymentmodal"
                    >
                      Add Payment
                      <span>
                        <i class="icon-ok"></i>
                      </span>
                    </button>
                    -->
                    <button
                      class="btn btn-outline-primary block"
                      type="submit"
                      :disabled="shipment.errors.any()"
                      @click.prevent="onSubmit"
                    >
                      Save
                      <span>
                        <i class="icon-ok"></i>
                      </span>
                    </button>
                    <button
                      class="btn btn-outline-danger btn-confirmation"
                      name="dosubmit"
                      type="submit"
                    >
                      Reset
                      <span>
                        <i class="icon-ok"></i>
                      </span>
                    </button>
                  </div>
                </div>
                <input name="locker" type="hidden" value="274218" />
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Package Modal -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Package Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea
                      class="form-control"
                      id="exampleFormControlTextarea1"
                      rows="3"
                      v-model="packagedetails.description"
                    ></textarea>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Serial Number</label>
                    <input type="text" class="form-control" v-model="packagedetails.serial_no" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Invoice">Invoice Number</label>
                    <input type="text" class="form-control" v-model="packagedetails.invoice_no" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Size</label>
                    <input type="text" class="form-control" v-model="packagedetails.size" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="docket">Weight</label>
                    <input type="text" class="form-control" v-model="packagedetails.weight" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Size">Declared value</label>
                    <input type="number" class="form-control" v-model="packagedetails.cost" />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="addPackage">Add</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Payment Modal-->

      <div
        class="modal fade"
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
            <div class="modal-body">
              <div class="row">
                <div class="input-group m-2">
                  <select
                    class="custom-select"
                    id="inputGroupSelect04"
                    aria-label="Example select with button addon"
                  >
                    <option selected disabled>Received From</option>
                    <option value="1">Consignor</option>
                    <option value="2">Consignee</option>
                    <option value="3">Others</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Payment Date</label>

                    <input type="text" class="form-control" value="31/05/2020" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Payment Type</label>
                    <select
                      class="custom-select"
                      id="inputGroupSelect04"
                      aria-label="Example select with button addon"
                      v-model="paymentType"
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
                    <input type="text" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="row" v-if="paymentType === 'bank'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">Bank Name</label>
                    <input type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="row" v-if="paymentType === 'upi'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">UPI Ref ID</label>
                    <input type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="row" v-if="paymentType === 'cheque'">
                <div class="col">
                  <div class="form-group">
                    <label for="Size">Cheque No</label>
                    <input type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Add</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- update status modal  -->

    <div
      class="modal fade"
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
                  v-model="status"
                >
                  <option disabled>Shipment Status</option>
                  <option value="pickup">Awaiting Pickup</option>
                  <option value="dispatched">Dispatched</option>
                  <option value="intrasit">Intrasit</option>
                  <option value="delivered">Delivered</option>
                </select>
              </div>

              <div v-if="status === 'delivered'">
                <div class="col">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Location" />
                  </div>
                </div>

                <div class="row m-1">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Receiver Name" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Phone" />
                    </div>
                  </div>
                </div>

                <div class="row m-1">
                  <div class="col">
                    <b-form-file v-model="file" ref="file-input" class="mb-2"></b-form-file>
                  </div>
                  <div class="col">
                    <b-button @click="clearFiles" class="mr-2">Reset</b-button>
                  </div>
                </div>
              </div>

              <div v-else-if="status == 'pickup'"></div>
              <div v-else>
                <div class="row m-2">
                  <div class="col">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Location" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Update</button>
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
      file: null,
      paymentType: null,
      status: "pickup",
      packagedetails: {
        description: "",
        serial_no: "",
        invoice_no: "",
        size: "",
        weight: "",
        cost: 0
      }
    };
  },
  methods: {
    clearFiles() {
      this.$refs["file-input"].reset();
    },
    onSubmit() {
      this.form
        .submit("post", "/api/shipments")
        .then(response)
        .catch(error);
    },
    selectCustomer(e) {
      this.form.sender_id = e.id;
    },

    selectReceiver(e) {
      this.form.receiver_id = e.id;
    },

    addPackage() {
      this.form.package.push({
        uid: uuidv4(),
        description: this.packagedetails.description,
        serial_no: this.packagedetails.serial_no,
        invoice_no: this.packagedetails.invoice_no,
        size: this.packagedetails.size,
        weight: this.packagedetails.weight,
        cost: this.packagedetails.cost
      });

      // reset
      (this.packagedetails.description = ""),
        (this.packagedetails.serial_no = ""),
        (this.packagedetails.invoice_no = ""),
        (this.packagedetails.size = ""),
        (this.packagedetails.weight = ""),
        (this.packagedetails.cost = 0);
    },

    calculateTotal() {
      const total =
        parseInt(this.form.charge_transportation) +
        parseInt(this.form.charge_handling) +
        parseInt(this.form.charge_halting) +
        parseInt(this.form.charge_Insurance) +
        parseInt(this.form.charge_odc) +
        parseInt(this.form.charge_tax_amount) +
        parseInt(this.form.charge_odc);
      this.form.charge_tax_amount =
        (total * parseInt(this.form.charge_tax_percent)) / 100;
      this.form.charge_total = this.form.charge_tax_amount + total;

      if (this.form.charge_advance_paid > 0) {
        this.form.charge_balance =
          this.form.charge_total - parseInt(this.form.charge_advance_paid);
      } else {
        this.form.charge_balance = this.form.charge_total;
      }
    },
    deletePackage(uid) {
      let i = this.form.package.map(item => item.uid).indexOf(uid); // find index of your object
      this.form.package.splice(i, 1); // remove it from array
    }
  },

  computed: {
    shipment() {
      return new Form(this.$store.getters.getSingleShipment);
    },
    customers() {
      return this.$store.getters.getAllCustomers;
    }
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleShipment",
      this.$route.params.shipment_id
    );

    this.$store.dispatch("retrieveCustomers");
  }
};
</script>