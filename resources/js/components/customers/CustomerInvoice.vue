<template>
  <fragment>
    <div class="row">
      <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
          <div class="card-body">
            <center class="m-t-30">
              <img
                src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png"
                class="rounded-circle"
                width="100"
              />
              <h4 class="card-title m-t-10">vinyas poojary</h4>
              <h6 class="card-subtitle">
                <div class="badge badge-pill badge-success font-16">
                  <span class="ti-user text-success"></span> Active
                </div>
              </h6>
            </center>
          </div>
          <div>
            <hr />
          </div>
          <div class="card-body">
            <small class="text-muted">E-mail</small>
            <h6>harshith11032001@gmail.com</h6>
            <small class="text-muted p-t-30 db">Phone</small>
            <h6>91 7975503096</h6>
            <small class="text-muted p-t-30 db">Address</small>
            <h6>india, MANGALORE, 574154, MULKI, SHAMA SADANA SHIMANTHUR PANJINADKA POST</h6>
          </div>
          <div class="card-body row text-center">
            <div class="col-6 border-right">
              <h6>2020-05-29 09:02:39</h6>
              <span>Registration Date</span>
            </div>
            <div class="col-6">
              <h6>2020-05-29 11:27:07</h6>
              <span>Last Login</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
          <div class="card-body">
            <div id="loader" style="display:none"></div>
            <div id="msgholder"></div>
            <div class="row mb-4">
              <router-link
                to="/admin/customers/1"
                aria-current="page"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-3"
              >
                <i class="fas fa-edit fa-sm"></i> Edit
              </router-link>
              <router-link
                to="/admin/customers/1/invoice"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
              >
                <i class="fas fa-rupee-sign fa-sm"></i> Invoices
              </router-link>
              <router-link
                to="/admin/customers/1/quotes"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
              >
                <i class="fas fa-scroll fa-sm"></i> Quotes
              </router-link>
            </div>
            <div class="row">
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-danger text-uppercase mb-1"
                        >Outstanding Invoices</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹40,000</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-success text-uppercase mb-1"
                        >Paid Invoices</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹215,000</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >Total Invoices</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">15</div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                role="progressbar"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                class="progress-bar bg-info"
                                style="width: 50%;"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-4 mt-2">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Invoices</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="dataTable_length">
                      <label>
                        Show
                        <select
                          name="dataTable_length"
                          aria-controls="dataTable"
                          class="custom-select custom-select-sm form-control form-control-sm"
                        >
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select> entries
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 text-right">
                    <div id="dataTable_filter" class="dataTables_filter">
                      <label>
                        Search: &nbsp;
                        <input
                          type="search"
                          class="form-control form-control-sm"
                          placeholder
                          aria-controls="dataTable"
                        />
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table
                      class="table table-bordered dataTable"
                      id="dataTable"
                      width="100%"
                      cellspacing="0"
                      role="grid"
                      aria-describedby="dataTable_info"
                      style="width: 100%;"
                    >
                      <thead>
                        <tr role="row">
                          <th
                            class="sorting_asc"
                            tabindex="0"
                            aria-controls="dataTable"
                            rowspan="1"
                            colspan="1"
                            aria-sort="ascending"
                            aria-label="Name: activate to sort column descending"
                            style="width: 58px;"
                          >Frieght Invoice No</th>
                          <th
                            class="sorting"
                            tabindex="0"
                            aria-controls="dataTable"
                            rowspan="1"
                            colspan="1"
                            aria-label="Position: activate to sort column ascending"
                            style="width: 40px;"
                          >Date</th>
                          <th
                            class="sorting"
                            tabindex="0"
                            aria-controls="dataTable"
                            rowspan="1"
                            colspan="1"
                            aria-label="Office: activate to sort column ascending"
                            style="width: 50px;"
                          >Receiver Name</th>
                          <th
                            class="sorting"
                            tabindex="0"
                            aria-controls="dataTable"
                            rowspan="1"
                            colspan="0.2"
                            aria-label="Age: activate to sort column ascending"
                            style="width: 31px;"
                          >Amount</th>
                          <th
                            class="sorting"
                            tabindex="0"
                            aria-controls="dataTable"
                            rowspan="1"
                            colspan="0.2"
                            aria-label="Age: activate to sort column ascending"
                            style="width: 31px;"
                          >Status</th>
                          <th
                            class="text-center"
                            tabindex="0"
                            aria-controls="dataTable"
                            rowspan="1"
                            colspan="1"
                            aria-label="Start date: activate to sort column ascending"
                            style="width: 69px;"
                          >Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th rowspan="1" colspan="1">Frieght Invoice No</th>
                          <th rowspan="1" colspan="1">Date</th>
                          <th rowspan="1" colspan="1">Receiver Name</th>
                          <th rowspan="1" colspan="1">Amount</th>
                          <th rowspan="1" colspan="1">Status</th>
                          <th rowspan="1" colspan="1" class="text-center">Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <tr role="row" class="odd">
                          <td>#GK859565565</td>
                          <td>01/06/2020</td>
                          <td>Vinyas</td>
                          <td>1000</td>
                          <td>
                            <span class="badge badge-success">Delivered</span>
                            <span class="badge badge-danger">Unpaid</span>
                          </td>
                          <td align="center">
                            <router-link
                              to="/admin/customers/1/invoices/1/view"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="View Customer"
                            >
                              <i class="fas fa-eye text-secondary"></i>
                            </router-link>
                            <a
                              type="button"
                              data-toggle="modal"
                              data-placement="top"
                              title="Add Payment"
                              data-target="#paymentmodal"
                            >
                              <i class="fas fa-rupee-sign text-secondary"></i>
                            </a>
                            <router-link
                              to="/admin/customers/1"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="View Customer"
                            >
                              <i class="fas fa-print text-secondary"></i>
                            </router-link>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div
                      class="dataTables_info"
                      id="dataTable_info"
                      role="status"
                      aria-live="polite"
                    >Showing 1 to 10 of 57 entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                      <ul class="pagination">
                        <li
                          class="paginate_button page-item previous disabled"
                          id="dataTable_previous"
                        >
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="0"
                            tabindex="0"
                            class="page-link"
                          >Previous</a>
                        </li>
                        <li class="paginate_button page-item active">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="1"
                            tabindex="0"
                            class="page-link"
                          >1</a>
                        </li>
                        <li class="paginate_button page-item">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="2"
                            tabindex="0"
                            class="page-link"
                          >2</a>
                        </li>
                        <li class="paginate_button page-item">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="3"
                            tabindex="0"
                            class="page-link"
                          >3</a>
                        </li>
                        <li class="paginate_button page-item">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="4"
                            tabindex="0"
                            class="page-link"
                          >4</a>
                        </li>
                        <li class="paginate_button page-item">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="5"
                            tabindex="0"
                            class="page-link"
                          >5</a>
                        </li>
                        <li class="paginate_button page-item">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="6"
                            tabindex="0"
                            class="page-link"
                          >6</a>
                        </li>
                        <li class="paginate_button page-item next" id="dataTable_next">
                          <a
                            href="#"
                            aria-controls="dataTable"
                            data-dt-idx="7"
                            tabindex="0"
                            class="page-link"
                          >Next</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
  </fragment>
</template>