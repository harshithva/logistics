<template>
  <fragment>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/admin">
        <div class="sidebar-brand-icon">
          <img :src="logo_src" />
        </div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <li class="nav-item ml-2 mt-3 mr-1">
         
       <router-link to="/admin/shipments/create" class="btn bg-white text-primary"><i class="fas fa-box"></i> &nbsp;Create Shipment</router-link>

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
        <router-link
          class="nav-link collapsed"
          to="/admin/customers/create">
        <i class="fas fa-user-plus"></i>
          <span>Add Customer</span>
        </router-link>
      </li>

       <li class="nav-item">
        <router-link
          class="nav-link collapsed"
          to="/admin/customers">
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
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-plus"></i>
          <span>Create Quote</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
       <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-scroll"></i>
          <span>Quote Lists</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Shipment</div>

     <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-truck"></i>
          <span>Create Shipment</span>
        </a>
      </li>

       <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-truck-loading"></i>
          <span>Shipment List</span>
        </a>
      </li>

      <!-- customer -->

    

      <!-- staff -->
            <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Staff</div>

     <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-plus"></i>
          <span>Create Staff</span>
        </a>
      </li>

       <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-users"></i>
          <span>Staff List</span>
        </a>
      </li>

       <hr class="sidebar-divider" />

  <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-file-invoice"></i>
          <span>General Reports</span>
        </a>
      </li>

        <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span>
        </a>
      </li>
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
      logo_src: "/dashboard/img/gurukal.png"
    };
  }
};
</script>