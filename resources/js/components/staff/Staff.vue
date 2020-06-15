<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Staff List</h6>
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
                    v-model="search"
                    @input="searchStaff"
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
                    >Name</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Position: activate to sort column ascending"
                      style="width: 40px;"
                    >Role</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="1"
                      aria-label="Office: activate to sort column ascending"
                      style="width: 50px;"
                    >Phone</th>
                    <th
                      class="sorting"
                      tabindex="0"
                      aria-controls="dataTable"
                      rowspan="1"
                      colspan="0.2"
                      aria-label="Age: activate to sort column ascending"
                      style="width: 31px;"
                    >Email</th>

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
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">Role</th>
                    <th rowspan="1" colspan="1">Phone</th>
                    <th rowspan="1" colspan="1">Email</th>
                    <th rowspan="1" colspan="1" class="text-center">Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="staff in staffs" :key="staff.id">
                    <td>{{staff.name}}</td>

                    <td>{{staff.role}}</td>

                    <td>{{staff.phone}}</td>

                    <td>{{staff.email}}</td>

                    <td align="center">
                      <router-link
                        :to="'/admin/staff/'+ staff.id +'/edit'"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Edit Staff"
                      >
                        <i class="fas fa-edit text-secondary"></i>
                      </router-link>
                      <a
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Delete Staff"
                        @click="deleteStaff(staff.id)"
                      >
                        <i class="fas fa-trash text-danger"></i>
                      </a>
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
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      search: ""
    };
  },
  created() {
    this.$store.dispatch("retrieveStaffs");
  },
  computed: {
    ...mapGetters({
      staffs: "getFilteredStaffs"
    })
  },
  methods: {
    deleteStaff(staff_id) {
      axios
        .delete(`/api/staffs/${staff_id}`)
        .then(response => {
          this.$store.dispatch("retrieveStaffs");
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Staff Deleted Successfully",
            showConfirmButton: false,
            timer: 1500
          });
        })
        .catch(error =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"
          })
        );
    },
    searchStaff() {
      this.$store.commit("searchStaff", this.search);
    }
  }
};
</script>