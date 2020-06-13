<template>
  <fragment>
    <!-- Sidebar -->
    <ul
      class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-print-none"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <router-link
        class="sidebar-brand d-flex align-items-center justify-content-center"
        to="/admin"
      >
        <div class="sidebar-brand-icon">
          <img
            src="https://i.ibb.co/9VxLb0M/logo-3.png"
            class="img-fluid mt-4 mr-4"
            style="width:10rem"
          />
        </div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0 mt-3" />

      <li class="nav-item ml-2 mt-3 mr-1">
        <router-link to="/admin/shipments/create" class="btn bg-white text-primary">
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

      <!-- customer -->

      <!-- staff -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Staff</div>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/staff/create">
          <i class="fas fa-plus"></i>
          <span>Create Staff</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link collapsed" to="/admin/staff">
          <i class="fas fa-users"></i>
          <span>Staff List</span>
        </router-link>
      </li>

      <hr class="sidebar-divider" />
      <div class="sidebar-heading">Reports</div>
      <li class="nav-item">
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
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
  </fragment>
</template>

<script>
export default {
  data() {
    return {
      logo_src: "../dashboard/img/gurukal.png"
    };
  },
  name: "Sidebar"
};
</script>