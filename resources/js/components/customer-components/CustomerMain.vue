<template>
  <fragment>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <CustomerHeader></CustomerHeader>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <router-view></router-view>
        </div>
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white d-print-none">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Gurukal 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </fragment>
</template>

<script>
import CustomerHeader from "./CustomerHeader";

export default {
  components: {
    CustomerHeader,
  },
};
</script>