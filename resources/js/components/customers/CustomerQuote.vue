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
              <h4 class="card-title m-t-10">{{customer.name}}</h4>
              <h6 class="card-subtitle">
                <div class="badge badge-pill badge-success font-16" v-if="customer.status == true">
                  <span class="ti-user text-success"></span>
                  Active
                </div>

                <div
                  class="badge badge-pill badge-success font-16"
                  v-else-if="customer.status == false"
                >
                  <span class="ti-user text-success"></span>
                  Inactive
                </div>
              </h6>
            </center>
          </div>
          <div>
            <hr />
          </div>
          <div class="card-body">
            <small class="text-muted">E-mail</small>
            <h6>{{customer.email}}</h6>
            <small class="text-muted p-t-30 db">Phone</small>
            <h6>91 {{customer.phone}}</h6>
            <small class="text-muted p-t-30 db">Address</small>
            <h6>{{customer.address}}</h6>
          </div>
          <div class="card-body row">
            <div class="col-12">
              <p
                class="font-s"
              >Registration Date: {{moment(customer.created_at).format('YYYY-MM-DD')}}</p>
              <p></p>
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
                :to="'/admin/customers/'+customer.id"
                aria-current="page"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-3"
              >
                <i class="fas fa-edit fa-sm"></i> Edit
              </router-link>
              <router-link
                :to="'/admin/customers/'+ customer.id +'/invoice'"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
              >
                <i class="fas fa-rupee-sign fa-sm"></i> Invoices
              </router-link>
              <router-link
                :to="'/admin/customers/'+ customer.id +'/quotes'"
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
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >Sent Quotes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{customer.quote_count}}</div>
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
                        >Approved</div>
                        <div
                          class="h5 mb-0 font-weight-bold text-gray-800"
                        >{{customer.quote_approved_count}}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-scroll fa-2x text-gray-300"></i>
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
                          class="text-xs font-weight-bold text-danger text-uppercase mb-1"
                        >Rejected</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div
                              class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                            >{{customer.quote_approved_declined}}</div>
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
                          >Quotation No</th>
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
                          <th rowspan="1" colspan="1">Quotation No</th>
                          <th rowspan="1" colspan="1">Date</th>
                          <th rowspan="1" colspan="1">From</th>
                          <th rowspan="1" colspan="1">To</th>

                          <th rowspan="1" colspan="1">Status</th>
                          <th rowspan="1" colspan="1" class="text-center">Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <tr v-if="customer.quote" v-for="quote in customer.quote" :key="quote.id">
                          <td>{{quote.quotation_no}}</td>
                          <td>{{moment( quote.created_at).format("DD/M/YYYY")}}</td>
                          <td>{{quote.from}}</td>
                          <td>{{quote.to}}</td>
                          <td>
                            <span
                              class="badge badge-success"
                              v-if="quote.status == 'approved'"
                            >Approved</span>
                            <span
                              class="badge badge-danger"
                              v-else-if="quote.status == 'declined'"
                            >Declined</span>
                            <span class="badge badge-info" v-else>Pending</span>
                          </td>
                          <td align="center">
                            <router-link
                              :to="'/admin/customers/'+ customer.id+'/quotes/'+ quote.id+'/view'"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="View Quote"
                            >
                              <i class="fas fa-eye text-secondary"></i>
                            </router-link>
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
      </div>
    </div>
  </fragment>
</template>

<style scoped>
.router-link-exact-active {
  background-color: #4e73df;
  color: white;
}
</style>

<script>
export default {
  data() {
    return {
      search: ""
    };
  },
  computed: {
    customer() {
      return new Form(this.$store.getters.getCustomerQuotes);
    }
  },
  created() {
    this.$store.dispatch("retrieveCustomerQuotes", this.$route.params.id);
  }
};
</script>