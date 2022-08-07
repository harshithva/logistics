<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <div class="col-3">      <h6 class="m-0 font-weight-bold text-primary">Customer List</h6></div>
        <div class="col-6"></div>
        <div class="col-3">
            <export-excel
            :data="customers"
            :fields="json_fields"
            class="btn btn-success btn-sm"
          >
            <i class="fas fa-cloud-download-alt"></i> &nbsp;Excel
          </export-excel>
        </div>
      </div>


    </div>
    <div class="card-body">
      <vue-good-table
        mode="remote"
        :columns="tableColumns1"
        :rows="customers"
        :line-numbers="true"
        :search-options="{
          enabled: true,
          placeholder: 'Type to search',
        }"
        @on-search="searchCustomer"
        :pagination-options="{
          enabled: true,
          mode: 'pages',
        }"
      >
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'action'">
            <router-link
              :to="'/admin/customers/' + props.row.id"
              data-toggle="tooltip"
              data-placement="top"
                  target="_blank"
              title="View Customer"
            >
              <i class="fas fa-eye text-secondary"></i>
            </router-link>
          </span>

          <span v-else>{{ props.formattedRow[props.column.field] }}</span>
        </template>
      </vue-good-table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
        company_name: "",
        gst: "",
        phone: "",
        address: "",
        user_notes: "",
      }),
      search:'',
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
            json_fields: {
        name: "name",
        email: "email",
        phone: "phone",
        location: "address",
      },
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
    this.$store.dispatch("retrieveCustomers");
  },
  computed: {
    customers() {
      return this.$store.getters.getFilteredCustomers;
    },
  },
  countDownChanged(dismissCountDown) {
    this.dismissCountDown = dismissCountDown;
  },
  showAlert() {
    this.dismissCountDown = this.dismissSecs;
  },
  methods: {
    searchCustomer(search) {
       this.$store.dispatch("retrieveCustomers",{search: search.searchTerm});
      // this.$store.commit("searchCustomer", this.search);
    },
  },
  mounted() {},
};
</script>