<template>
  <fragment>
    <div>
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-3">Quotation Form</h4>
              <div id="loader" style="display:none"></div>
              <div id="msgholder"></div>
              <form class="form-horizontal form-material" id="admin_form" method="post">
                <section>
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="password"
                          value="31/05/2020"
                          placeholder="Date"
                        />
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-2 mt-2">Quotation Details</h6>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="fname"
                          placeholder="Ref Number"
                        />
                      </div>
                    </div>
                  </div>

                  <div>
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                      <div class="row">
                        <div class="col-sm-12">
                          <table
                            class="table dataTable table-responsive-sm"
                            id="dataTable"
                            width="100%"
                            cellspacing="0"
                            role="grid"
                            aria-describedby="dataTable_info"
                            style="width: 100%;"
                          >
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Description</th>
                                <th scope="col">Serial No</th>
                                <th scope="col">Size</th>
                                <th scope="col">Weight</th>
                                <th scope="col">ETA</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Advance</th>
                              </tr>
                            </thead>
                            <tbody>
                              <button
                                type="button"
                                class="btn btn-primary mt-3"
                                data-toggle="modal"
                                data-target="#quotation"
                              >Add</button>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

                <div class="form-group">
                  <div class="col-sm-12">
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
                      class="btn btn-outline-secondary btn-confirmation"
                      name="dosubmit"
                      type="submit"
                    >
                      Print
                      <span>
                        <i class="icon-ok"></i>
                      </span>
                    </button>
                    <button
                      class="btn btn-outline-danger btn-confirmation"
                      name="dosubmit"
                      type="submit"
                    >
                      Mail
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

    <!-- quotation -->
    <div
      class="modal fade"
      id="quotation"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Quotation Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Serial Number">From</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="docket">To</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="Serial Number">Size</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="docket">Weight</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Size">ETA</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="docket">Rate</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Size">Advance</label>
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
  </fragment>
</template>