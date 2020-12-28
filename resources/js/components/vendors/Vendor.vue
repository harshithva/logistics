
<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <div class="col-10">
          <h6 class="m-0 font-weight-bold text-primary">Vendor List</h6>
        </div>
        <div class="col">
          <button v-b-modal.modal-1 class="btn btn-primary">Add Vendor</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <vue-good-table
        :columns="tableColumns1"
        :rows="vendors"
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
              :to="'/admin/vendors/' + props.row.id"
              data-toggle="tooltip"
              data-placement="top"
              title="View Customer"
            >
              <i class="fas fa-eye text-secondary"></i>
            </router-link>
          </span>

          <span v-else>{{ props.formattedRow[props.column.field] }}</span>
        </template>
      </vue-good-table>
    </div>

    <b-modal id="modal-1" title="Create Vendor">
      <CreateVendor></CreateVendor>
      <template v-slot:modal-footer>
        <div class="w-100"></div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import CreateVendor from "./sub/CreateVendor";
export default {
  components: {
    CreateVendor,
  },
  data() {
    return {
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      tableColumns1: [
        {
          label: "Name",
          field: "name",
          sortable: true,
        },
        {
          label: "Email",
          field: "email",
        },
        {
          label: "Phone",
          field: "phone",
        },
        {
          label: "Location",
          field: "address",
        },

        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
  created() {
    this.$store.dispatch("RETRIEVE_ALL_VENDORS");
  },
  computed: {
    ...mapGetters({ vendors: "getAllVendors" }),
  },
  countDownChanged(dismissCountDown) {
    this.dismissCountDown = dismissCountDown;
  },
  showAlert() {
    this.dismissCountDown = this.dismissSecs;
  },
  methods: {},
  mounted() {},
};
</script>
