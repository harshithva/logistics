<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="m-0 font-weight-bold text-primary">Delivery Reports</h6>
      </div>
      <div class="row">
        <!-- <router-link
          to="/admin/reports"
          class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
        >
          <i class="fas fa-scroll fa-sm"></i> Reports
        </router-link>-->
        <router-link
          to="/admin/payment_log"
          class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-3"
        >
          <i class="fas fa-rupee-sign fa-sm"></i> Payment Log
        </router-link>
        <router-link
          to="/admin/delivery_reports"
          class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
        >
          <i class="fas fa-truck fa-sm"></i> Delivery Reports
        </router-link>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="dataTable_length"></div>
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
                    >Fright Invoice No</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="0.2"
                      aria-label="Age: activate to sort column ascending"
                      style="width: 31px;"
                    >Docket No</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="0.2"
                      aria-label="Age: activate to sort column ascending"
                      style="width: 31px;"
                    >Sender Name</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Position: activate to sort column ascending"
                      style="width: 40px;"
                    >Delivery Date</th>
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
                    >Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th rowspan="1" colspan="1">Fright Invoice No</th>
                    <th rowspan="1" colspan="1">Docket No</th>
                    <th rowspan="1" colspan="1">Sender Name</th>
                    <th rowspan="1" colspan="1">Delivery Date</th>

                    <th rowspan="1" colspan="1">Receiver Name</th>
                    <th rowspan="1" colspan="1">Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr role="row" class="odd">
                    <td class="sorting_1"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
