<template>
  <fragment>
    <div>
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div id="loader" style="display: none"></div>
              <div id="msgholder"></div>
              <h4 class="mb-4">Shipment Info</h4>
              <!-- show errors -->

              <b-alert
                v-if="shipment.errors.has('sender_id')"
                dismissible
                show
                variant="danger"
                >{{ shipment.errors.get("sender_id") }}</b-alert
              >

              <b-alert
                v-if="shipment.errors.has('receiver_id')"
                dismissible
                show
                variant="danger"
                >{{ shipment.errors.get("receiver_id") }}</b-alert
              >

              <b-alert
                v-if="shipment.errors.has('charge_total')"
                dismissible
                show
                variant="danger"
                >{{ shipment.errors.get("charge_total") }}</b-alert
              >

              <b-alert
                v-if="shipment.errors.has('document')"
                dismissible
                show
                variant="danger"
                >{{ shipment.errors.get("document") }}</b-alert
              >
              <!-- end errors -->
              <form
                class="form"
                @keydown="shipment.errors.clear()"
                enctype="multipart/form-data"
              >
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Date">Shipment Date</label>
                      <b-form-datepicker
                        id="example-datepicker"
                        v-model="shipment.date"
                        class="mb-2"
                      ></b-form-datepicker>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-2">Sender Info</h6>
                    <div class="form-group">
                      <v-select
                        :options="customers"
                        label="name"
                        @input="selectCustomer($event)"
                        :value="shipment.sender.name"
                      ></v-select>
                      <div class="mt-2">
                        <router-link to="/admin/customers/create"
                          >Add new</router-link
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h6 class="mb-2">Receiver Info</h6>
                    <div class="form-group">
                      <v-select
                        :options="customers"
                        label="name"
                        @input="selectReceiver($event)"
                        :value="shipment.receiver.name"
                      ></v-select>
                      <div class="mt-2">
                        <router-link to="/admin/customers/create"
                          >Add new</router-link
                        >
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
                      <label for="exampleFormControlTextarea1"
                        >Pickup Address</label
                      >
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

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for>Freight Invoice no</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.freight_invoice_number"
                        placeholder="Freight Invoice no"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for>Docekt no</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.docket_no"
                        placeholder="Docekt no"
                      />
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
                      <div class="mt-2">
                        <router-link to="/admin/customers/create"
                          >Add new</router-link
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <h6 class="mb-2">Total</h6>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.vendor_total"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <h6 class="mb-2">Advance</h6>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shipment.vendor_advance"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Payment Type</label>
                      <v-select
                        :options="payment_types"
                        :value="shipment.payment_type"
                        label="name"
                        @input="selectPaymentType($event)"
                      ></v-select>
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
                      <th scope="col">Quantity</th>
                      <th scope="col">Cost</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in shipment.package" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ item.description }}</td>
                      <td>{{ item.serial_no }}</td>
                      <td>{{ item.invoice_no }}</td>
                      <td>{{ item.size }}</td>
                      <td>{{ item.weight }}</td>
                      <td>{{ item.quantity }}</td>
                      <td>{{ item.cost }}</td>
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
                    <tr
                      v-for="(item, index) in shipment.insurance"
                      :key="index"
                    >
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
                <div class="row">
                  <div class="col">
                    <h6 class="mb-4">Additional Expenses</h6>
                  </div>

                  <div class="col text-right">
                    <button
                      class="btn btn-primary"
                      @click.prevent="changeEditingExpense"
                    >
                      Edit Expenses
                    </button>
                  </div>
                </div>

                <div v-if="editExpenses">
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="transportation">Transportation</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="charge_transportation"
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
                          v-model="charge_handling"
                        />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Halting</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="charge_halting"
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
                          v-model="charge_Insurance"
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
                          v-model="charge_odc"
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
                          v-model="charge_tax_percent"
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
                          v-model="charge_advance_paid"
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
                        v-model="charge_tax_amount"
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
                        v-model="charge_total"
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
                        v-model="charge_balance"
                        style="width: 8rem"
                      />
                    </div>
                  </div>
                </div>

                <!-- dont edit expenses -->
                <div v-else>
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="transportation">Transportation</label>
                        <input
                          disabled
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
                          disabled
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
                          disabled
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
                          disabled
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
                          disabled
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
                          disabled
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
                          disabled
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
                        disabled
                        type="number"
                        class="form-control float-right"
                        @change="calculateTotal"
                        v-model="shipment.charge_tax_amount"
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
                        disabled
                        type="number"
                        @change="calculateTotal"
                        class="form-control float-right"
                        v-model="shipment.charge_total"
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
                        disabled
                        type="number"
                        @change="calculateTotal"
                        class="form-control float-right"
                        v-model="shipment.charge_balance"
                        style="width: 8rem"
                      />
                    </div>
                  </div>
                </div>

                <!-- end edit expenses -->

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
                        value="consignor"
                        >Consignor</b-form-radio
                      >
                      <b-form-radio
                        v-model="shipment.bill_to"
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
                      :disabled="shipment.errors.any()"
                      @click.prevent="onSubmit"
                    >
                      Update
                      <span>
                        <i class="icon-ok"></i>
                      </span>
                    </button>
                    <router-link
                      class="btn btn-outline-danger btn-confirmation"
                      name="dosubmit"
                      type="submit"
                      :to="
                        '/admin/customers/' +
                        shipment.sender.id +
                        '/invoices/' +
                        shipment.id +
                        '/view'
                      "
                    >
                      Return
                      <span>
                        <i class="icon-ok"></i>
                      </span>
                    </router-link>
                  </div>
                </div>
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

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Serial Number">Serial Number</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="packagedetails.serial_no"
                    />
                  </div>
                </div>
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
                      type="number"
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
    </div>

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
  </fragment>
</template>



<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      payment_types: [
        { id: "1", name: "TDS" },
        { id: "2", name: "TCS" },
      ],
      file: null,
      paymentType: null,
      status: "pickup",
      editExpenses: false,
      charge_transportation: 0,
      charge_handling: 0,
      charge_halting: 0,
      charge_Insurance: 0,
      charge_odc: 0,
      charge_tax_amount: 0,
      charge_total: 0,
      charge_tax_percent: 0,
      charge_advance_paid: 0,
      charge_balance: 0,

      payment_type: "",
      packagedetails: {
        description: "",
        serial_no: "",
        invoice_no: "",
        size: "",
        weight: "",
        quantity: "",
        cost: 0,
      },
      insuranceDetails: {
        eway_bill: "",
        insurance_no: "",
        insurance_agent: "",
      },
      vendor_id: "",
      vendor_total: 0,
      vendor_advance: 0,
    };
  },
  methods: {
    clearFiles() {
      this.$refs["file-input"].reset();
    },
    onSubmit() {
      if (this.editExpenses) {
        this.getData();
      }

      this.shipment
        .submit("patch", `/api/shipments/${this.shipment.id}`)
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Shipment Updated",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Sender, Receiver and Total field is required.",
          });
        });
    },
    selectCustomer(e) {
      this.shipment.sender_id = e.id;
      this.shipment.sender.name = e.name;
    },

    selectReceiver(e) {
      this.shipment.receiver_id = e.id;
      this.shipment.receiver.name = e.name;
    },
    selectPaymentType(e) {
      this.shipment.payment_type = e.name;
    },
    selectVendor(e) {
      this.form.vendor_id = e.id;
    },

    addPackage() {
      this.shipment.package.push({
        uid: uuidv4(),
        description: this.packagedetails.description,
        serial_no: this.packagedetails.serial_no,
        invoice_no: this.packagedetails.invoice_no,
        size: this.packagedetails.size,
        weight: this.packagedetails.weight,
        quantity: this.packagedetails.quantity,
        cost: this.packagedetails.cost,
      });

      // reset
      (this.packagedetails.description = ""),
        (this.packagedetails.serial_no = ""),
        (this.packagedetails.invoice_no = ""),
        (this.packagedetails.size = ""),
        (this.packagedetails.weight = ""),
        (this.packagedetails.quantity = ""),
        (this.packagedetails.cost = 0);
    },

    addInsurance() {
      this.shipment.insurance.push({
        uid: uuidv4(),
        eway_bill: this.insuranceDetails.eway_bill,
        insurance_no: this.insuranceDetails.insurance_no,
        insurance_agent: this.insuranceDetails.insurance_agent,
      });

      // reset
      this.insuranceDetails.eway_bill = this.insuranceDetails.insurance_no = this.insuranceDetails.insurance_agent =
        "";
    },

    calculateTotal() {
      const total =
        parseInt(this.charge_transportation) +
        parseInt(this.charge_handling) +
        parseInt(this.charge_halting) +
        parseInt(this.charge_Insurance) +
        parseInt(this.charge_odc);

      this.charge_tax_amount =
        (total * parseInt(this.charge_tax_percent)) / 100;
      this.charge_total = this.charge_tax_amount + total;

      if (this.charge_advance_paid > 0) {
        this.charge_balance =
          this.charge_total - parseInt(this.charge_advance_paid);
      } else {
        this.charge_balance = this.charge_total;
      }
    },
    deletePackage(uid) {
      let i = this.shipment.package.map((item) => item.uid).indexOf(uid); // find index of your object
      this.shipment.package.splice(i, 1); // remove it from array
    },
    deleteInsurance(uid) {
      let i = this.shipment.insurance.map((item) => item.uid).indexOf(uid); // find index of your object
      this.shipment.insurance.splice(i, 1); // remove it from array
    },
    changeEditingExpense() {
      this.editExpenses = !this.editExpenses;
      // copy value
      this.charge_transportation = this.shipment.charge_transportation;
      this.charge_handling = this.shipment.charge_handling;
      this.charge_halting = this.shipment.charge_halting;
      this.charge_Insurance = this.shipment.charge_Insurance;
      this.charge_odc = this.shipment.charge_odc;
      this.charge_tax_amount = this.shipment.charge_tax_amount;
      this.charge_total = this.shipment.charge_total;
      this.charge_tax_percent = this.shipment.charge_tax_percent;
      this.charge_advance_paid = this.shipment.charge_advance_paid;
      this.charge_balance = this.shipment.charge_balance;
    },
    getData() {
      this.shipment.charge_transportation = this.charge_transportation;
      this.shipment.charge_handling = this.charge_handling;
      this.shipment.charge_halting = this.charge_halting;
      this.shipment.charge_Insurance = this.charge_Insurance;
      this.shipment.charge_odc = this.charge_odc;
      this.shipment.charge_tax_amount = this.charge_tax_amount;
      this.shipment.charge_total = this.charge_total;
      this.shipment.charge_tax_percent = this.charge_tax_percent;
      this.shipment.charge_advance_paid = this.charge_advance_paid;
      this.shipment.charge_balance = this.charge_balance;
    },
  },

  computed: {
    ...mapGetters({
      vendors: "getAllVendors",
    }),
    data() {
      return this.$store.getters.getSingleShipment;
    },
    customers() {
      return this.$store.getters.getAllCustomers;
    },
    shipment() {
      return new Form(this.data);
    },
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleShipment",
      this.$route.params.shipment_id
    );

    this.$store.dispatch("retrieveCustomers");
    this.$store.dispatch("RETRIEVE_ALL_VENDORS");
  },
};
</script>