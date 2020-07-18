<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="m-0 font-weight-bold text-primary">Payment Log</h6>
      </div>
      <div class="row">
        <div class="col">
          <router-link
            to="/admin/reports"
            class="d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
          >
            <i class="fas fa-scroll fa-sm"></i> Reports
          </router-link>
          <router-link
            to="/admin/payment_log"
            class="d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm active"
          >
            <i class="fas fa-rupee-sign fa-sm"></i> Payment Log
          </router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <vue-good-table
        v-if="payments && payments.length"
        :columns="tableColumns1"
        :rows="payments"
        :line-numbers="true"
        :search-options="{
    enabled: true,
       placeholder: 'Type to search',
  }"
        :pagination-options="{
    enabled: true,
     mode: 'pages',
     
  }"
        :sort-options="{
    enabled: true,
    initialSortBy: {field: 'date', type: 'desc'}
  }"
      >
        <!-- <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'action'">
          
          </span>

          <span v-else>{{props.formattedRow[props.column.field]}}</span>
        </template>-->
      </vue-good-table>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      tableColumns1: [
        {
          label: "Freight Invoice No",
          field: "freight_invoice_number"
        },
        {
          label: "Customer.name",
          field: "customer_name"
        },
        {
          label: "Date",
          field: "date",

          type: "date",
          dateInputFormat: "yyyy-mm-dd",
          dateOutputFormat: "dd/mm/yyyy"
        },
        {
          label: "Payment Type",
          field: "payment_type"
        },
        {
          label: "Amount",
          field: "amount"
        }
      ]
    };
  },
  created() {
    this.$store.dispatch("retrieveAllPayments");
  },
  computed: {
    payments() {
      return this.$store.getters.getAllPayments;
    }
  }
};
</script>