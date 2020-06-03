<template>
  <div>
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade show active"
              id="previous-month"
              role="tabpanel"
              aria-labelledby="pills-setting-tab"
            >
              <div class="card-body">
                <div id="loader" style="display:none"></div>
                <div id="msgholder"></div>
                <h4 class="mb-4">Shipment Info</h4>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Serial Number">Shipment Date</label>

                      <input type="text" class="form-control" value="31/05/2020" />
                    </div>
                  </div>
                </div>

                <h6 class="mb-2">Sender Info</h6>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        name="code_phone"
                        list="browsers6"
                        autocomplete="off"
                        required="required"
                        placeholder="Search Customer"
                      />
                      <datalist id="browsers6">
                        <option data-countrycode="AF" value="Vinyas">Vinyas</option>
                        <option data-countrycode="AL" value="Gurukal">Gurukal</option>
                      </datalist>
                    </div>
                  </div>
                </div>
                <h6 class="mb-4">Receiver Info</h6>
                <form class="form-horizontal form-material" id="admin_form" method="post">
                  <section>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="fname" placeholder="Name" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            placeholder="Company Name"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="gst" placeholder="GST No" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="email" class="form-control" name="phone" placeholder="Email" />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="phone"
                            placeholder="Primary Phone"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="email"
                            class="form-control"
                            name="phone"
                            placeholder="Secondary Phone"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Address</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="fname" placeholder="State" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            placeholder="Pincode"
                          />
                        </div>
                      </div>
                    </div>
                  </section>
                  <h6 class="mb-4">Package Pickup Location</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Contact Person"
                        />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="fname" placeholder="Phone" />
                      </div>
                    </div>
                  </div>

                  <div class="input-group mb-2">
                    <select
                      class="custom-select"
                      id="inputGroupSelect04"
                      aria-label="Example select with button addon"
                    >
                      <option selected disabled>Transaction Type</option>

                      <option value="2">Full Load</option>
                      <option value="3">Part Load</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Address</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                          name="fname"
                          placeholder="Company Name"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="fname" placeholder="Phone" />
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Driver Name"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Driver Phone number"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Vechile Details"
                        />
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          name="notes"
                          rows="6"
                          placeholder="User Notes - For internal use only."
                        ></textarea>
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-4">Add Package Details</h6>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Fright Invoice Number"
                        />
                      </div>
                    </div>
                  </div>
                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Serial No</th>
                        <th scope="col">Docket No</th>
                        <th scope="col">Size</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Cost</th>
                      </tr>
                    </thead>
                    <tbody>
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
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Transportation"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="fname" placeholder="Handling" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="fname" placeholder="Halting" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Insurance"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="ODC Charges"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="fname" placeholder="Tax" />
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
                        type="text"
                        class="form-control float-right"
                        name="fname"
                        placeholder="Tax"
                        style="width:5rem;"
                      />
                    </div>
                  </div>

                  <div class="row m-2">
                    <div class="col">
                      <p>Total</p>
                    </div>
                    <div class="col">
                      <input
                        type="text"
                        class="form-control float-right"
                        name="fname"
                        placeholder="Total"
                        style="width:5rem;"
                      />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="notes" rows="6" placeholder="Remarks"></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <p>Upload Docs</p>
                    <div class="row">
                      <div class="col-6 d-flex d-inline">
                        <b-form-file v-model="file" ref="file-input" class="mb-2"></b-form-file>
                      </div>
                      <div class="col-6">
                        <b-button @click="clearFiles" class="mr-2">Reset</b-button>
                      </div>
                    </div>
                  </div>

                  <div class="row m-2">
                    <div class="col">
                      <p class="form-check-inline">Bill To</p>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio1"
                          value="consignor"
                        />
                        <label class="form-check-label" for="inlineRadio1">Consignor</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio2"
                          value="consignee"
                        />
                        <label class="form-check-label" for="inlineRadio2">Consignee</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-12">
                      <button
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
                      <button
                        class="btn btn-outline-primary btn-confirmation"
                        name="dosubmit"
                        type="submit"
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
                      <button
                        class="btn btn-outline-secondary btn-confirmation"
                        name="dosubmit"
                        type="submit"
                      >
                        Print Invoice
                        <span>
                          <i class="icon-ok"></i>
                        </span>
                      </button>
                      <button
                        class="btn btn-outline-primary btn-confirmation"
                        name="dosubmit"
                        type="submit"
                      >
                        Print Docket
                        <span>
                          <i class="icon-ok"></i>
                        </span>
                      </button>
                      <button
                        class="btn btn-outline-secondary btn-confirmation"
                        name="dosubmit"
                        type="submit"
                      >
                        Send Mail
                        <span>
                          <i class="icon-ok"></i>
                        </span>
                      </button>
                      <router-link to="/admin" class="btn btn-outline-secondary btn-confirmation">
                        <span>
                          <i class="ti-share-alt"></i>
                        </span> Return to the dashboard
                      </router-link>
                    </div>
                  </div>
                  <input name="locker" type="hidden" value="274218" />
                </form>
              </div>
            </div>
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
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="Serial Number">Serial Number</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="docket">Docket Number</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Size">Size</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="docket">Weight</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Size">Cost</label>
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
                  >
                    <option selected disabled>Choose</option>
                    <option value="1">Cash</option>
                    <option value="2">Bank</option>
                    <option value="3">UPI</option>
                    <option value="3">Cheque</option>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      file: null
    };
  },
  methods: {
    clearFiles() {
      this.$refs["file-input"].reset();
    }
  }
};
</script>