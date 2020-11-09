<template>
  <vue-good-table
    :columns="tableColumns1"
    :rows="shipments"
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
      <span v-if="props.column.field == 'payment'">
        <span
          class="badge badge-pill badge-success"
          v-if="props.row.balance <= 0"
          >Paid</span
        >
        <span
          class="badge badge-pill badge-danger"
          v-else-if="props.row.balance == props.row.total"
          >Pending</span
        >

        <span class="badge badge-pill badge-warning" v-else>Partial</span>
      </span>

      <span v-if="props.column.field == 'action'">
        <router-link
          :to="
            '/admin/customers/' +
            props.row.sender_id +
            '/invoices/' +
            props.row.shipment_id +
            '/view'
          "
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
</template>

<script>
export default {
  props: ["shipments"],
  data() {
    return {
      tableColumns1: [
        {
          label: "Docket No",
          field: "docket_no",
          sortable: true,
        },

        {
          label: "Delivery Address",
          field: "delivery_address",
        },
        {
          label: "Total",
          field: "total",
        },
        {
          label: "Advance",
          field: "advance",
        },
        {
          label: "Balance",
          field: "balance",
        },
        {
          label: "Payment",
          field: "payment",
        },

        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
};
</script>