<template>
  <fragment>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <Header></Header>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card" v-if="isLoading">
            <div class="card-body">
              <content-loader
                :width="400"
                :height="180"
                :speed="2"
                primaryColor="#ffffff"
                secondaryColor="#ecebeb"
              >
                <circle cx="10" cy="20" r="8" />
                <rect x="25" y="15" rx="5" ry="5" width="220" height="10" />
                <circle cx="10" cy="50" r="8" />
                <rect x="25" y="45" rx="5" ry="5" width="220" height="10" />
                <circle cx="10" cy="80" r="8" />
                <rect x="25" y="75" rx="5" ry="5" width="220" height="10" />
                <circle cx="10" cy="110" r="8" />
                <rect x="25" y="105" rx="5" ry="5" width="220" height="10" />
              </content-loader>
            </div>
          </div>

          <router-view v-else></router-view>
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
import Header from "./Header";
import Analytics from "./Analytics";
import { mapGetters } from "vuex";
import { ContentLoader } from "vue-content-loader";
export default {
  components: {
    Analytics,
    Header,
    ContentLoader,
  },
  computed: {
    ...mapGetters({ isLoading: "getIsLoading" }),
  },
};
</script>