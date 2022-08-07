<template>
  <fragment v-if="this.$store.getters.getUserData.user.role == 'admin'">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
      <h1
        class="h3 mb-0 text-gray-800"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        Dashboard
      </h1>
      <h1 class="h3 mb-0 text-gray-800" v-else>Staff Dashboard</h1>
    </div>

    <div class="row mb-4">
      <div class="col"></div>
      <div class="col">
        <router-link
          :to="'/admin/shipments/create'"
          class="btn btn-primary ml-2"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-truck-loading"></i> Create Shipment
        </router-link>
        <router-link
          :to="'/admin/customers/create'"
          class="btn btn-danger ml-2"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-user-plus"></i> Create Customer
        </router-link>
        <router-link
          :to="'/admin/quotes/create'"
          class="btn btn-success ml-2"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-scroll"></i> Create Quote
        </router-link>
        <router-link
          :to="'/admin/staff/create'"
          class="btn btn-info ml-2"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-plus"></i> Create Staff
        </router-link>
      </div>
    </div>
    <!-- Content Row -->
    <div class="row">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-primary text-uppercase
                    mb-1
                  "
                >
                  Total Earnings
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  ₹ {{ dashboard.earnings }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-success text-uppercase
                    mb-1
                  "
                >
                  Total Shipments
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.shipments }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-truck fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-danger text-uppercase
                    mb-1
                  "
                >
                  Pending Delivery
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.pending_delivery }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="text-xs font-weight-bold text-info text-uppercase mb-1"
                >
                  Total Quotations
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                      {{ dashboard.quotations }}
                    </div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div
                        class="progress-bar bg-info"
                        role="progressbar"
                        style="width: 50%"
                        aria-valuenow="50"
                        aria-valuemin="0"
                        aria-valuemax="100"
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

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-warning text-uppercase
                    mb-1
                  "
                >
                  Total Customers
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.customers }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-danger text-uppercase
                    mb-1
                  "
                >
                  Pending Payment
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.pending_payment }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-danger text-uppercase
                    mb-1
                  "
                >
                  Upcoming Expenses
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.upcoming_expense }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-success text-uppercase
                    mb-1
                  "
                >
               This Financial Year Earnings
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.this_year_earnings }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-success text-uppercase
                    mb-1
                  "
                >
               Last Financial Year Earnings
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ dashboard.last_year_earnings }}
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->

    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">
              Shipments Overview
            </h6>
            <div class="dropdown no-arrow">
              <a
                class="dropdown-toggle"
                href="#"
                role="button"
                id="dropdownMenuLink"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
           
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <line-chart
                :data="dashboard.overview"
                :colors="['#1cc88a', '#e74a3b']"
                :discrete="true"
                xtitle="Days"
                ytitle="Business"
                prefix="₹"
                :legend="true"
                :dataset="{ borderWidth: 4 }"
                :download="true"
              >
                ></line-chart
              >
            </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Payment Received</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-pie pb-4">
              <pie-chart
                :data="dashboard.payments_overview"
                :donut="true"
                prefix="₹"
                :colors="[
                  '#4e73df',
                  '#1cc88a',
                  '#36b9cc',
                  '#f6c23e',
                  '#e74a3b',
                  '#858796',
                  '#f8f9fc',
                  '#5a5c69',
                ]"
                :download="true"
              ></pie-chart>
            </div>
            <br />
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>

<script>
import Header from "./Header";

export default {
  components: {
    Header,
  },
  computed: {
    dashboard() {
      return new Form(this.$store.getters.getDashboardDetails);
    },
  },
  created() {
    this.$store.dispatch("retrieveDashboardDetails");
  },
};
</script>