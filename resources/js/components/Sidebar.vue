<template>
  <fragment>
    <!-- Sidebar -->
    <ul
      class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-print-none"
      :class="isToggled ? 'toggled' : ''"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <router-link
        class="sidebar-brand d-flex align-items-center justify-content-center"
        to="/admin"
      >
        <div class="sidebar-brand-icon">
          <img
            src="https://i.ibb.co/vJrfRxt/gurukal.png"
            class="img-fluid mt-4 mr-4"
            style="width: 10rem"
          />
        </div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0 mt-3" />

      <li class="nav-item ml-2 mt-3 mr-1">
        <router-link
          to="/admin/shipments/create"
          class="btn bg-white text-primary mr-2"
        >
          <i class="fas fa-box"></i> &nbsp;Create Shipment
        </router-link>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <router-link class="nav-link" to="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </router-link>
      </li>

      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Customer</div>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/customers/create">
          <i class="fas fa-user-plus"></i>
          <span>Add Customer</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/customers">
          <i class="fas fa-user"></i>
          <span>Customer List</span>
        </router-link>
      </li>
      <!-- end customer -->

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Quote</div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/quotes/create">
          <i class="fas fa-plus"></i>
          <span>Create Quote</span>
        </router-link>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/quotes">
          <i class="fas fa-scroll"></i>
          <span>Quote Lists</span>
        </router-link>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Shipment</div>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/shipments">
          <i class="fas fa-truck-loading"></i>
          <span>Shipment List</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/price_list">
          <i class="fas fa-scroll"></i>
          <span>Price List</span>
        </router-link>
      </li>
      <!-- Heading -->
      <div class="sidebar-heading">Vendors</div>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/vendors">
          <i class="fas fa-users"></i>
          <span>Vendors List</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/vendor/expenses">
          <i class="fas fa-file-invoice"></i>
          <span>Vendor Expenses</span>
        </router-link>
      </li>

      <!-- customer -->

      <!-- staff -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div
        class="sidebar-heading"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        Staff
      </div>

      <li
        class="nav-item"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        <router-link class="nav-link collapsed" to="/admin/staff/create">
          <i class="fas fa-plus"></i>
          <span>Create Staff</span>
        </router-link>
      </li>

      <li
        class="nav-item"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        <router-link class="nav-link collapsed" to="/admin/staff">
          <i class="fas fa-users"></i>
          <span>Staff List</span>
        </router-link>
      </li>

      <hr
        class="sidebar-divider"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      />
      <div
        class="sidebar-heading"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        Reports
      </div>
      <li
        class="nav-item"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        <router-link class="nav-link collapsed" to="/admin/call_logs">
          <i class="fas fa-phone"></i>
          <span>Call Logs</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        <router-link class="nav-link collapsed" to="/admin/expenses">
          <i class="fas fa-file-invoice"></i>
          <span>Expenses</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      >
        <router-link class="nav-link collapsed" to="/admin/reports">
          <i class="fas fa-file-invoice"></i>
          <span>General Reports</span>
        </router-link>
      </li>

      <!-- <li class="nav-item">
        <router-link
          class="nav-link collapsed"
          to="/admin/settings">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span>
        </router-link>
      </li>-->
      <!-- Divider -->
      <hr
        class="sidebar-divider d-none d-md-block"
        v-if="this.$store.getters.getUserData.user.role == 'admin'"
      />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button
          class="rounded-circle border-0"
          id="sidebarToggle"
          @click="toggleSidebar"
        ></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
  </fragment>
</template>

<script>
export default {
  data() {
    return {
      logo_src: "../dashboard/img/gurukal.png",
    };
  },
  methods: {
    toggleSidebar() {
      this.$store.commit("toggleSidebar");
    },
  },
  computed: {
    isToggled() {
      return this.$store.getters.getIsToggled;
    },
  },
  name: "Sidebar",
};
</script>