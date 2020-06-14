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
              <div class="col-sm-12 col-md-6"></div>
              <div class="col-sm-12 col-md-6 text-right">
                <div id="dataTable_filter" class="dataTables_filter">
                  <label>
                    Search: &nbsp;
                    <input
                      type="search"
                      class="form-control form-control-sm"
                      placeholder
                      aria-controls="dataTable"
                      v-model="search"
                      @input="searchShipment"
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
                    <tr role="row" v-for="(shipment,index) in shipments" :key="shipment.id">
                      <td class="sorting_1" v-if="shipment.docket_no">{{shipment.docket_no}}</td>
                      <td class="sorting_1" v-else>---</td>
                      <td v-if="shipment.date">{{moment(shipment.date).format('DD/MM/YYYY')}}</td>
                      <td v-else>---</td>
                      <td v-if="shipment.sender.name">{{shipment.sender.name}}</td>
                      <td v-else>---</td>
                      <td v-if="shipment.sender.address">{{shipment.sender.address}}</td>
                      <td v-else>---</td>
                      <td v-if="shipment.delivery_address">{{shipment.delivery_address}}</td>
                      <td v-else>---</td>
                      <td align="center">
                        <router-link
                          :to="'/admin/customers/'+ shipment.sender.id +'/invoices/'+ shipment.id + '/view'"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="View"
                        >
                          <i class="fas fa-eye text-secondary"></i>
                        </router-link>

                        <span
                          class="badge badge-pill badge-primary"
                          v-if="shipment.status.status == 'Awaiting pickup'"
                        >{{shipment.status.status}}</span>
                        <span
                          class="badge badge-pill badge-success"
                          v-else-if="shipment.status.status == 'Delivered'"
                        >{{shipment.status.status}}</span>
                        <span class="badge badge-pill badge-info" v-else>{{shipment.status.status}}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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
      search: ""
    };
  },
  methods: {
    searchShipment() {
      this.$store.commit("searchShipment", this.search);
    },
    clearFiles() {
      this.$refs["file-input"].reset();
    }
  },
  created() {
    this.$store.dispatch("retrieveShipments");
  },
  computed: {
    shipments() {
      return this.$store.getters.getFilteredShipments;
    }
  }
};
</script>