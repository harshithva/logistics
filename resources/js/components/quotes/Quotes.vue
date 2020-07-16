<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Quotation List</h6>
    </div>
    <div class="card-body">
      <vue-good-table
        :columns="tableColumns1"
        :rows="quotes"
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
              :to="'/admin/customers/'+ props.row.customer_id+ '/quotes/'+props.row.id +'/view'"
              data-toggle="tooltip"
              data-placement="top"
              title="View Customer"
            >
              <i class="fas fa-eye text-secondary"></i>
            </router-link>
          </span>

          <span v-if="props.column.field == 'status'">
            <span
              class="badge badge-pill badge-success"
              v-if="props.row.status == 'approved'"
            >Approved</span>

            <span
              class="badge badge-pill badge-danger"
              v-else-if="props.row.status == 'declined'"
            >Declined</span>

            <span class="badge badge-pill badge-warning" v-else>Pending</span>
          </span>

          <span v-else>{{props.formattedRow[props.column.field]}}</span>
        </template>
      </vue-good-table>
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
          label: "Quotation Number",
          field: "quotation_no",
          sortable: true
        },
        {
          label: "Name",
          field: "customer_name"
        },
        {
          label: "From",
          field: "from"
        },
        {
          label: "To",
          field: "to"
        },
        {
          label: "Status",
          field: "status"
        },

        {
          label: "Action",
          field: "action"
        }
      ]
    };
  },
  computed: {
    ...mapGetters({
      quotes: "getFilteredQuotes"
    })
  },
  created() {
    this.$store.dispatch("retrieveQuotations");
  },
  methods: {
    searchQuote() {
      this.$store.commit("searchQuote", this.search);
    }
  }
};
</script>