<template>
  <div>
    <div class="row mb-2 mt-2">
      <div class="col-10"></div>
      <div class="col">
        <export-excel
          :data="shipments"
          :fields="json_fields"
          class="btn btn-success btn-sm"
        >
          <i class="fas fa-cloud-download-alt"></i> &nbsp;Excel
        </export-excel>
      </div>
    </div>
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
            v-if="role == 'admin'"
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

          <a
            v-if="role == 'admin'"
            v-b-modal.modal-1
            variant="primary"
            class="btn btn-sm"
            @click="openPaymentModal(props.row)"
          >
            <i class="fas fa-rupee-sign text-secondary"></i>
          </a>
        </span>

        <span v-else>{{ props.formattedRow[props.column.field] }}</span>
      </template>
    </vue-good-table>

    <b-modal id="modal-1" title="Add Payment">
      <AddVendorPayment
        :shipment_id="data.shipment_id"
        :vendor_id="data.vendor_id"
      ></AddVendorPayment>
      <template v-slot:modal-footer>
        <div class="w-100"></div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import AddVendorPayment from "./AddVendorPayment";
export default {
  props: ["shipments"],
  components: {
    AddVendorPayment,
  },
  data() {
    return {
      data: {},
      json_fields: {
        Docket: "docket_no",
        "Memo no": "memo_no",
        "Delivery Address": "delivery_address",
        Commission: "commission",
        Cash: "Cash",
        Total: "total",
        Advance: "advance",

        "Payment Date": "payment_date",
      },
      tableColumns1: [
        {
          label: "Docket No",
          field: "docket_no",
          sortable: true,
        },
        {
          label: "Memo No",
          field: "memo_no",
          sortable: true,
        },

        {
          label: "Delivery Address",
          field: "delivery_address",
        },
        {
          label: "Commission",
          field: "commission",
        },
        {
          label: "Cash",
          field: "cash",
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
          label: "Payment Date",
          field: "payment_date",
        },

        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
  methods: {
    openPaymentModal(e) {
      this.data = e;
    },
  },
  computed: {
    role() {
      return this.$store.getters.getUserData.user.role;
    },
  },
};
</script>