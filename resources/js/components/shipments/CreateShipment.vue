<template>
  <fragment>
    <div>
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-4">Shipment Info</h4>
              <!-- show errors -->
              <DisplayError :form="form"></DisplayError>
              <!-- end errors -->
              <form
                class="form-horizontal form-material"
                action="/admin/shipments"
                @keydown="form.errors.clear()"
                enctype="multipart/form-data"
              >
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Date">Shipment Date</label>
                      <b-form-datepicker
                        id="example-datepicker"
                        v-model="form.date"
                        class="mb-2"
                      ></b-form-datepicker>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Date">Expected Delivery Date</label>
                      <b-form-datepicker
                        id="example-datepicker2"
                        v-model="form.delivery_date"
                        class="mb-2"
                      ></b-form-datepicker>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <h6 class="mb-3">Sender Info</h6>
                    <div class="form-group">
                      <v-select
                        :options="customers"
                        label="name"
                        @input="selectCustomer($event)"
                      ></v-select>
                      <!-- <div class="mt-2">
                        <router-link to="/admin/customers/create"
                          >Add new</router-link
                        >
                      </div> -->

                      <div>
                        <a class="nav-link" v-b-modal.modal-1>Add new</a>

                        <b-modal id="modal-1" title="Create customer">
                          <CreateCustomer></CreateCustomer>
                        </b-modal>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-5">
                    <h6 class="mb-3">Receiver Info</h6>
                    <div class="form-group">
                      <v-select
                        :options="customers"
                        label="name"
                        @input="selectReceiver($event)"
                      ></v-select>
                      <!-- <div class="mt-2">
                        <router-link to="/admin/customers/create"
                          >Add new</router-link
                        >
                      </div> -->
                                              <a class="nav-link" v-b-modal.modal-1>Add new</a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="delivery_address">Delivery Address</label>
                      <textarea
                        class="form-control"
                        id="delivery_address"
                        rows="3"
                        v-model="form.delivery_address"
                      ></textarea>
                    </div>
                  </div>
                </div>

                <hr />
                <h6 class="mb-4">Package Pickup Location</h6>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.package_contact_person"
                        placeholder="Contact Person"
                      />
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.package_contact_person_phone"
                        placeholder="Phone"
                      />
                    </div>
                  </div>

                  <div class="col-md-3">
                    <select
                      class="custom-select"
                      aria-label="Select Transaction Type"
                      v-model="form.package_transaction_type"
                    >
                      <option disabled>Transaction Type</option>

                      <option value="Full Load" selected>Full Load</option>
                      <option value="Part Load">Part Load</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1"
                        >Pickup Address</label
                      >
                      <textarea
                        class="form-control"
                        id="pickup_address"
                        rows="3"
                        v-model="form.package_pickup_address"
                      ></textarea>
                    </div>
                  </div>
                </div>

                <h6 class="mb-4">Transport Details</h6>
                <div class="row mb-2">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.transport_driver_name"
                        placeholder="Driver Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.transport_driver_phone"
                        placeholder="Driver Phone number"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.transport_driver_vehicle"
                        placeholder="Vehicle Details"
                      />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea
                        class="form-control"
                        v-model="form.user_notes"
                        rows="3"
                        placeholder="User Notes - For internal use only."
                      ></textarea>
                    </div>
                  </div>
                </div>
                <h6 class="mb-4">Vendor Details</h6>
                <div class="row">
                  <div class="col-md-3">
                    <h6 class="mb-2">Select Vendor</h6>
                    <div class="form-group">
                      <v-select
                        :options="vendors"
                        label="name"
                        @input="selectVendor($event)"
                      ></v-select>
                      <!-- <div class="mt-2">
                        <router-link to="/admin/customers/create"
                          >Add new</router-link
                        >
                      </div> -->
                      <div>
                        <a class="nav-link" v-b-modal.modal-2>Add new</a>

                        <b-modal id="modal-2" title="Create Vendor">
                          <CreateStaff :is_role="0"></CreateStaff>
                        </b-modal>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <h6 class="mb-2">Memo no</h6>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.vendor_memo_no"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <h6 class="mb-2">Commission</h6>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.vendor_commission"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <h6 class="mb-2">Total</h6>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.vendor_total"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <h6 class="mb-2">Advance</h6>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.vendor_advance"
                      />
                    </div>
                  </div>
                </div>

                <!-- <div class="row mb-2">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for>Payment Type</label>
                      <v-select
                        :options="payment_types"
                        label="name"
                        @input="selectPaymentType($event)"
                      ></v-select>
                    </div>
                  </div>
                </div> -->
                <h6 class="mb-4">Package Details</h6>

                <table class="table table-responsive-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                      <!-- <th scope="col">Serial No</th> -->
                      <th scope="col">Invoice No</th>
                      <th scope="col">Size</th>
                      <th scope="col">Weight</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Cost</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in form.package" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ item.description }}</td>
                      <!-- <td>{{ item.serial_no }}</td> -->
                      <td>{{ item.invoice_no }}</td>
                      <td>{{ item.size }}</td>
                      <td>{{ item.weight }}</td>
                      <td>{{ item.quantity }}</td>
                      <td>{{ item.cost }}</td>
                      <td>
                        <i class="fas fa-edit text-secondary" @click="openUpdatePackage(item)"  v-b-modal="'edit-package'"></i>
                        <i class="fas fa-times text-danger" @click="deletePackage(item.uid)"></i>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#exampleModal"
                        >
                          Add
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- Insurance Details -->

                <h6 class="mb-4">Insurance Details</h6>

                <table class="table table-responsive-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Eway Bill</th>
                      <th scope="col">Insurance No</th>
                      <th scope="col">Insurance Agent</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in form.insurance" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ item.eway_bill }}</td>
                      <td>{{ item.insurance_no }}</td>
                      <td>{{ item.insurance_agent }}</td>

                      <td @click="deleteInsurance(item.uid)">
                        <i class="fas fa-times text-danger"></i>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#insurance_modal"
                        >
                          Add
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <hr />
                <h6 class="mb-4">Additional Expenses</h6>
                <div class="row mb-2">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="transportation">Transportation</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="form.charge_transportation"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Handling</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="form.charge_handling"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Halting</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="form.charge_halting"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Insurance</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="form.charge_Insurance"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Cartage</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="form.charge_cartage"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Over weight</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="form.charge_over_weight"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>ODC Charges</label>
                      <input
                        type="number"
                        class="form-control"
                        v-model="form.charge_odc"
                        @change="calculateTotal"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Tax Percent (%)</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="form.charge_tax_percent"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Advance Paid</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="form.charge_advance_paid"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Discount</label>
                      <input
                        type="number"
                        class="form-control"
                        @change="calculateTotal"
                        v-model="form.discount"
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
                      v-model="form.charge_tax_amount"
                      style="width: 8rem"
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
                      v-model="form.charge_total"
                      placeholder="Total"
                      style="width: 8rem"
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
                      v-model="form.charge_balance"
                      style="width: 8rem"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea
                        class="form-control"
                        rows="3"
                        placeholder="Remarks"
                        v-model="form.remarks"
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col">
                    <b-form-group label="Bill To">
                      <b-form-radio
                        v-model="form.bill_to"
                        name="some-radios"
                        value="consignor"
                        >Consignor</b-form-radio
                      >
                      <b-form-radio
                        v-model="form.bill_to"
                        name="some-radios"
                        value="consignee"
                        >Consignee</b-form-radio
                      >
                    </b-form-group>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <button
                      class="btn btn-outline-primary block"
                      type="submit"
                      :disabled="form.errors.any()"
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
                <DisplayError :form="form"></DisplayError>
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
              <h5 class="modal-title" id="exampleModalLabel">
                Package Details
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
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

                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Serial Number</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.serial_no"
                    />
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Invoice">Invoice Number</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.invoice_no"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Size</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.size"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="docket">Weight</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.weight"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="docket">Quantity</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.quantity"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Declared value</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.cost"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="button" class="btn btn-primary" @click="addPackage">
                Add
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- edit package modal -->

    <b-modal id="edit-package"  hide-footer>

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

                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Serial Number</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.serial_no"
                    />
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Invoice">Invoice Number</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.invoice_no"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Size</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.size"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="docket">Weight</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.weight"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="docket">Quantity</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.quantity"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Size">Declared value</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.cost"
                    />
                  </div>
                </div>
              </div>
                          <div class="modal-footer">
          
              <button type="button" class="btn btn-primary" @click="updatePackage">
                Update
              </button>
            </div>

    </b-modal>


      <!-- Insurance modal  -->

      <div
        class="modal fade"
        id="insurance_modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Insurance Info</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Eway Bill"
                      v-model="insuranceDetails.eway_bill"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Insurance No"
                      v-model="insuranceDetails.insurance_no"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Insurance Agent"
                      v-model="insuranceDetails.insurance_agent"
                    />
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="addInsurance"
                :disabled="!insuranceDetails.eway_bill"
              >
                Add
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>


<script>
import { mapGetters } from "vuex";
import CreateCustomer from "../customers/CreateCustomer.vue";
import CreateStaff from "../staff/CreateStaff.vue";

export default {
  components:{
    CreateCustomer,
    CreateStaff
  },
  data() {
    return {
      edit_package_uid:"",
      // payment_types: [{ name: "TDS" }, { name: "TCS" }],
      form: new Form({
        receiver_id: "",
        sender_id: "",
        delivery_address: "",
        package_contact_person: "",
        package_contact_person_phone: "",
        package_transaction_type: "Full Load",
        package_pickup_address: "",
        transport_company_name: "",
        transport_company_phone: "",
        transport_driver_name: "",
        transport_driver_phone: "",
        transport_driver_vehicle: "",
        user_notes: "",
        freight_invoice_number: "",
        charge_transportation: 0,
        charge_handling: 0,
        charge_halting: 0,
        charge_cartage: 0,
        charge_over_weight: 0,
        charge_Insurance: 0,
        charge_odc: 0,
        charge_tax_percent: 0,
        charge_tax_amount: 0,
        charge_total: 0,
        charge_advance_paid: 0,
        charge_balance: 0,
        bill_to: "",
        document: "",
        remarks: "",
        date: "",
        delivery_date:"",
        package: [],
        insurance: [],
        // payment_type: "",
        vendor_id: "",
        vendor_total: 0,
        vendor_advance: 0,
        vendor_commission: 0,
        vendor_memo_no: "",
        discount: 0,
      }),
      file: null,
      paymentType: null,
      status: "pickup",
      packagedetails: {
        description: "",
        serial_no: "",
        invoice_no: "",
        size: "",
        weight: "",
        cost: "",
        quantity: "",
      },
      insuranceDetails: {
        eway_bill: "",
        insurance_no: "",
        insurance_agent: "",
      },
    };
  },
  methods: {
    openUpdatePackage(e){
        (this.packagedetails.description = e.description),
        (this.packagedetails.serial_no = e.serial_no),
        (this.packagedetails.invoice_no = e.invoice_no),
        (this.packagedetails.size = e.size),
        (this.packagedetails.weight = e.weight),
        (this.packagedetails.quantity = e.quantity),
        (this.packagedetails.cost = e.cost);
        this.edit_package_uid = e.uid;
      // reset_package();
    },
    updatePackage(){
      let objIndex = this.form.package.findIndex((obj => obj.uid == this.edit_package_uid));
      this.form.package[objIndex].description = this.packagedetails.description;
      this.form.package[objIndex].serial_no = this.packagedetails.serial_no;
      this.form.package[objIndex].invoice_no = this.packagedetails.invoice_no;
      this.form.package[objIndex].size = this.packagedetails.size;
      this.form.package[objIndex].weight = this.packagedetails.weight;
      this.form.package[objIndex].quantity = this.packagedetails.quantity;
      this.form.package[objIndex].cost = this.packagedetails.cost;
      this.reset_package();
    },
    clearFiles() {
      this.$refs["file-input"].reset();
    },
    onSubmit() {
      this.form.submit("post", "/api/shipments").then(response).catch(error);
    },
    selectCustomer(e) {
      this.form.sender_id = e.id;
    },

    selectReceiver(e) {
      this.form.receiver_id = e.id;
    },
    selectReceiver(e) {
      this.form.receiver_id = e.id;
    },
    selectPaymentType(e) {
      this.form.payment_type = e.name;
    },
    selectVendor(e) {
      this.form.vendor_id = e.id;
    },
    reset_package(){
            // reset
      (this.packagedetails.description = ""),
        (this.packagedetails.serial_no = ""),
        (this.packagedetails.invoice_no = ""),
        (this.packagedetails.size = ""),
        (this.packagedetails.weight = ""),
        (this.packagedetails.quantity = ""),
        (this.packagedetails.cost = 0);
    },
    addPackage() {
      this.form.package.push({
        uid: uuidv4(),
        description: this.packagedetails.description,
        serial_no: this.packagedetails.serial_no,
        invoice_no: this.packagedetails.invoice_no,
        size: this.packagedetails.size,
        weight: this.packagedetails.weight,
        quantity: this.packagedetails.quantity,
        cost: this.packagedetails.cost,
      });
      this.reset_package();
    },
    addInsurance() {
      this.form.insurance.push({
        uid: uuidv4(),
        eway_bill: this.insuranceDetails.eway_bill,
        insurance_no: this.insuranceDetails.insurance_no,
        insurance_agent: this.insuranceDetails.insurance_agent,
      });

      // reset
      this.insuranceDetails.eway_bill =
        this.insuranceDetails.insurance_no =
        this.insuranceDetails.insurance_agent =
          "";
    },
    onSubmit() {
      let timerInterval;
      Swal.fire({
        title: "Your shipment being created!",
        html: "I will close in <b></b> milliseconds.",
        timer: 2000,
        timerProgressBar: true,
        onBeforeOpen: () => {
          Swal.showLoading();
          timerInterval = setInterval(() => {
            const content = Swal.getContent();
            if (content) {
              const b = content.querySelector("b");
              if (b) {
                b.textContent = Swal.getTimerLeft();
              }
            }
          }, 100);
        },
        onClose: () => {
          clearInterval(timerInterval);
        },
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log("I was closed by the timer");
        }
      });

      const sender_id = this.form.sender_id;
      this.form
        .submitBinary("post", "/api/shipments")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Well done! Shipment has been created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push(
            `/admin/customers/${sender_id}/invoices/${response.id}/view`
          );
        })
        .catch((error) =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          })
        );
    },
    calculateTotal() {
      const total =
        parseInt(this.form.charge_transportation) +
        parseInt(this.form.charge_handling) +
        parseInt(this.form.charge_halting) +
        parseInt(this.form.charge_cartage) +
        parseInt(this.form.charge_over_weight) +
        parseInt(this.form.charge_Insurance) +
        parseInt(this.form.charge_odc);

      this.form.charge_tax_amount =
        (total * parseInt(this.form.charge_tax_percent)) / 100;
      this.form.charge_total =
        this.form.charge_tax_amount + total - this.form.discount;

      if (this.form.charge_advance_paid > 0) {
        this.form.charge_balance =
          this.form.charge_total - parseInt(this.form.charge_advance_paid);
      } else {
        this.form.charge_balance = this.form.charge_total;
      }
    },
    deletePackage(uid) {
      let i = this.form.package.map((item) => item.uid).indexOf(uid); // find index of your object
      this.form.package.splice(i, 1); // remove it from array
    },
    deleteInsurance(uid) {
      let i = this.form.insurance.map((item) => item.uid).indexOf(uid); // find index of your object
      this.form.insurance.splice(i, 1); // remove it from array
    },
  },
  mounted() {
    this.$store.dispatch("retrieveCustomers");
    this.$store.dispatch("RETRIEVE_ALL_VENDORS");
  },
  computed: {
    ...mapGetters({
      vendors: "getAllVendors",
    }),
    customers() {
      return this.$store.getters.getAllCustomers;
    },
  },
  created() {
    this.form.date = moment(new Date()).format("YYYY-MM-DD");
    this.form.delivery_date = moment(new Date()).add('days', 1).format("YYYY-MM-DD");
  },
};
</script>