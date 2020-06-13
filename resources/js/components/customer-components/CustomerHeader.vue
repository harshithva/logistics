<template>
  <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">
    <a class="navbar-brand ml-2" href="#">
      <img :src="logo" width="120" alt loading="lazy" />
    </a>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link text-white" href="#" id="userDropdown" @click="logout">
          <i class="fas fa-sign-out-alt text-white"></i>&nbsp;&nbsp;Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->
</template>


<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      logo: "../dashboard/img/gurukal.png"
    };
  },
  computed: {
    ...mapGetters(["isLogged"])
  },
  methods: {
    logout() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });

      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "You want to logout",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, Logout",
          cancelButtonText: "No, cancel!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            this.$store.dispatch("logout");
            swalWithBootstrapButtons.fire(
              "Logged Out!",
              "You will redirected to login page",
              "success"
            );
            window.location = "/";
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Cancelled",
              "Your imaginary file is safe :)",
              "error"
            );
          }
        });
    }
  }
};
</script>