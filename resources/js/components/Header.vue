<template>
  <div>
    <nav
      class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow"
    >
      <VueInputCalculator enableKeyboard v-model="targetValue">
        <i class="fas fa-calculator"></i>
      </VueInputCalculator>
      <div class="ml-4 mt-3">
        <switches v-model="enabled" @input="change"></switches>
      </div>
      <!-- Sidebar Toggle (Topbar) -->
      <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3"
        @click="toggleSidebar"
      >
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="searchDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div
            class="
              dropdown-menu dropdown-menu-right
              p-3
              shadow
              animated--grow-in
            "
            aria-labelledby="searchDropdown"
          >
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control bg-light border-0 small"
                  placeholder="Search for..."
                  aria-label="Search"
                  aria-describedby="basic-addon2"
                />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1 show">
          <NotificationComponent></NotificationComponent>
                        </li>


        <li class="nav-item dropdown no-arrow">
          <a
            class="nav-link text-primary"
            href="#"
            id="userDropdown"
            @click="logout"
          >
            <i class="fas fa-sign-out-alt text-primary"></i>&nbsp;&nbsp;Logout
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- End of Topbar -->
</template>


<script>
import { mapGetters } from "vuex";

import VueInputCalculator from "vue-input-calculator";

import Switches from "vue-switches";
import NotificationComponent from "./NotificationComponent";

export default {
  data() {
    return { targetValue: 0, enabled: false };
  },
  computed: {
    ...mapGetters(["isLogged"]),

    isToggled() {
      return this.$store.getters.getIsToggled;
    },
  },
  components: { VueInputCalculator, Switches,  NotificationComponent  },
  methods: {
    changeMultiple(className, styleProperty, value) {
      var items = document.querySelectorAll(className);
      for (var i = 0; i < items.length; i++) {
        items[i]["style"][styleProperty] = value;
      }
    },
    change() {
      if (this.enabled) {
        document.getElementById("accordionSidebar").style.backgroundColor =
          "red";
        document.getElementById("accordionSidebar").style.backgroundImage =
          "linear-gradient(180deg,#000 100%,#000 100%)";

        document.querySelector(
          "nav.navbar.navbar-expand.navbar-light.topbar.mb-4.static-top.shadow"
        ).style.backgroundColor = "black";

        this.changeMultiple(".card", "backgroundColor", "black");
        this.changeMultiple(".card-header", "backgroundColor", "black");
        this.changeMultiple("#content", "backgroundColor", "#222831");
        this.changeMultiple(".card-body", "backgroundColor", "black");

        document.querySelector(".fa-calculator").classList.add("text-white");
      } else {
        document.getElementById("accordionSidebar").style.backgroundColor =
          "#4e73df";
        document.getElementById("accordionSidebar").style.backgroundImage =
          "linear-gradient(180deg,#4e73df 10%,#224abe 100%)";

        document.querySelector(
          "nav.navbar.navbar-expand.navbar-light.topbar.mb-4.static-top.shadow"
        ).style.backgroundColor = "white";

        this.changeMultiple(".card", "backgroundColor", "white");
        this.changeMultiple(".card-header", "backgroundColor", "#f8f9fc");
        this.changeMultiple("#content", "backgroundColor", "white");
        this.changeMultiple(".card-body", "backgroundColor", "white");

        document.querySelector(".fa-calculator").classList.remove("text-white");
      }
    },
    toggleSidebar() {
      this.$store.commit("toggleSidebar");
    },
    logout() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "You want to logout",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, Logout",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
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
            swalWithBootstrapButtons.fire("Cancelled", "Logout :)", "error");
          }
        });
    },
  },
};
</script>