<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Shipment List</h6>
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
                      >Tracking No</th>
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
                      >Name</th>
                      <th
                        class="sorting"
                        tabindex="0"
                        aria-controls="dataTable"
                        rowspan="1"
                        colspan="0.2"
                        aria-label="Age: activate to sort column ascending"
                        style="width: 31px;"
                      >From</th>
                      <th
                        class="sorting"
                        tabindex="0"
                        aria-controls="dataTable"
                        rowspan="1"
                        colspan="0.2"
                        aria-label="Age: activate to sort column ascending"
                        style="width: 31px;"
                      >To</th>
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
                      <th rowspan="1" colspan="1">Tracking No</th>
                      <th rowspan="1" colspan="1">Date</th>
                      <th rowspan="1" colspan="1">Name</th>
                      <th rowspan="1" colspan="1">From</th>
                      <th rowspan="1" colspan="1">To</th>
                      <th rowspan="1" colspan="1" class="text-center">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr role="row" v-for="(shipment,index) in shipments">
                      <td class="sorting_1">{{shipment.docket_no}}</td>
                      <td>{{shipment.created_at}}</td>
                      <td v-if="shipment.sender.name">{{shipment.sender.name}}</td>
                      <td v-else>---</td>
                      <td v-if="shipment.sender.address">{{shipment.sender.address}}</td>
                      <td v-else>---</td>
                      <td v-if="shipment.delivery_address">{{shipment.delivery_address}}</td>
                      <td v-else>---</td>
                      <td align="center">
                        <!-- <a
                          type="button"
                          data-toggle="modal"
                          data-target="#updatestatus"
                          data-placement="top"
                          title="Updated status"
                        >
                          <i class="fas fa-truck text-primary"></i>
                        </a>-->
                        <router-link
                          :to="'/admin/customers/'+ shipment.sender.id +'/invoices/'+ shipment.id + '/view'"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="View"
                        >
                          <i class="fas fa-eye text-secondary"></i>
                        </router-link>
                        <!-- <router-link
                          to="/admin/shipments/1/edit"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Edit"
                        >
                          <i class="fas fa-edit text-primary"></i>
                        </router-link>-->
                        <!-- <span class="badge badge-pill badge-info">Intransit</span> -->
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
                    <li class="paginate_button page-item previous disabled" id="dataTable_previous">
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
      status: "pickup"
    };
  },
  methods: {
    clearFiles() {
      this.$refs["file-input"].reset();
    }
  },
  created() {
    return this.$store.dispatch("retrieveShipments");
  },
  computed: {
    shipments() {
      return this.$store.getters.getAllShipments;
    }
  }
};
</script>