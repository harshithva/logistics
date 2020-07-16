<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Staff List</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12">
          <vue-good-table
            :columns="tableColumns1"
            :rows="staffs"
            :line-numbers="true"
            :search-options="{
    enabled: true,
       placeholder: 'Type to search',
  }"
            :pagination-options="{
    enabled: true,
     mode: 'pages',
     
  }"
          >
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'action'">
                <router-link
                  :to="'/admin/staff/'+ props.row.id +'/edit'"
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
                  @click="deleteStaff(props.row.id)"
                >
                  <i class="fas fa-trash text-danger"></i>
                </a>
              </span>
              <span v-else>{{props.formattedRow[props.column.field]}}</span>
            </template>
          </vue-good-table>
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
      search: "",
      tableColumns1: [
        {
          label: "Name",
          field: "name"
        },
        {
          label: "Role",
          field: "role"
        },
        {
          label: "Phone",
          field: "phone"
        },
        {
          label: "Email",
          field: "email"
        },
        {
          label: "Action",
          field: "action"
        }
      ]
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