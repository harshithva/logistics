<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
    </div>
    <div class="card-body">
      <vue-good-table
        :columns="tableColumns1"
        :rows="customers"
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
              :to="'/admin/customers/' + props.row.id"
              data-toggle="tooltip"
              data-placement="top"
              title="View Customer"
            >
              <i class="fas fa-eye text-secondary"></i>
            </router-link>
          </span>

          <span v-else>{{props.formattedRow[props.column.field]}}</span>
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
        user_notes: ""
      }),
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      tableColumns1: [
        {
          label: "Name",
          field: "name",
          sortable: true
        },
        {
          label: "Email",
          field: "email"
        },
        {
          label: "Phone",
          field: "phone"
        },
        {
          label: "Location",
          field: "address"
        },

        {
          label: "Action",
          field: "action"
        }
      ]
    };
  },
  created() {
    this.$store.dispatch("retrieveCustomers");
  },
  computed: {
    customers() {
      return this.$store.getters.getFilteredCustomers;
    }
  },
  countDownChanged(dismissCountDown) {
    this.dismissCountDown = dismissCountDown;
  },
  showAlert() {
    this.dismissCountDown = this.dismissSecs;
  },
  methods: {
    searchCustomer() {
      this.$store.commit("searchCustomer", this.search);
    }
  }
};
</script>