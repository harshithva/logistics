<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Quotation List</h6>
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
                    >Ref No</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Position: activate to sort column ascending"
                      style="width: 40px;"
                    >Name</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Office: activate to sort column ascending"
                      style="width: 50px;"
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
                      class="sorting"
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
                    <th rowspan="1" colspan="1">Ref No</th>
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">From</th>
                    <th rowspan="1" colspan="1">To</th>
                    <th rowspan="1" colspan="1" class="text-center">Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr role="row" v-if="quotes" v-for="(item,index) in quotes.data">
                    <td>{{index+1}}</td>
                    <td>{{item.customer.name}}</td>
                    <td v-if="item.list[0]">{{item.list[0].from}}</td>
                    <td v-else>---</td>

                    <td v-if="item.list[0]">{{item.list[0].to}}</td>
                    <td v-else>---</td>
                    <td align="center">
                      <router-link
                        :to="'/admin/customers/'+ item.customer.id+ '/quotes/'+item.id +'/view'"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="View Customer"
                      >
                        <i class="fas fa-eye text-secondary"></i>
                      </router-link>
                      <span
                        class="badge badge-pill badge-success"
                        v-if="item.status == 'approved'"
                      >Approved</span>

                      <span
                        class="badge badge-pill badge-danger"
                        v-else-if="item.status == 'declined'"
                      >Declined</span>

                      <span class="badge badge-pill badge-warning" v-else>Pending</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-5"></div>
            <div class="col-sm-12 col-md-7">
              <pagination :data="quotes" @pagination-change-page="getResults">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
              </pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {};
  },
  computed: {
    quotes() {
      return this.$store.getters.getAllQuotes;
    }
  },
  mounted() {
    this.getResults();
  },
  methods: {
    getResults(page = 1) {
      this.$store.dispatch("retrieveQuotations", page);
    }
  }
};
</script>