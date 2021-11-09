<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col">
            <h6 class="m-0 font-weight-bold text-primary">Vendor Payments</h6>
          </div>
          <div class="col-4"></div>
          <div class="col">

            <button class="btn btn-danger btn-sm" @click="generatePdf">
              <i class="fas fa-file-download"></i> &nbsp;PDF
            </button>
            <export-excel
              :data="payments"
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
        >
          <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'action'">
              <a
                data-toggle="tooltip"
                data-placement="top"
                title="Delete "
                @click="deleteItem(props.row.id)"
              >
                <i class="fas fa-trash text-danger"></i>
              </a>
            </span>

            <span v-else>{{ props.formattedRow[props.column.field] }}</span>
          </template>
        </vue-good-table>
      </div>
    </div>

  </fragment>
</template>

<script>
import jsPDF from "jspdf";
import { mapGetters } from "vuex";
import AddVendorExpense from "./sub/AddVendorExpense";

export default {
  data() {
    return {
      json_fields: {
        "Vendor Name": "name",
        Amount: "amount",
        "Payment Method": "payment_method",
        Date: "date",
      },
      tableColumns1: [
        {
          label: "Vendor Name",
          field: "name",
        },
        {
          label: "Amount",
          field: "amount",
        },
        {
          label: "Payment method",
          field: "payment_method",
        },

        {
          label: "Date",
          field: "date",
        },

        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
  components: {
    AddVendorExpense,
  },
  methods: {
    generatePdf() {
      const vm = this;
      const columns = [
        { title: "Vendor name", dataKey: "name" },
        { title: "Amount", dataKey: "amount" },
        { title: "Payment Method", dataKey: "payment_method" },
        { title: "Date", dataKey: "date" },
      ];
      const doc = new jsPDF("p", "pt");

      doc.autoTable(columns, vm.payments, {
        styles: {
          fontSize: 10,
        },
      });

      doc.save("payments.pdf");
    },
    deleteItem(item_id) {
      axios
        .delete(`/api/vendor_payments/${item_id}`)
        .then((response) => {
          this.$store.dispatch("RETRIEVE_ALL_VENDOR_PAYMENTS");
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Deleted Successfully",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          })
        );
    },
  },
  created() {
    this.$store.dispatch("RETRIEVE_ALL_VENDOR_PAYMENTS");
  },
  computed: {
    ...mapGetters({
      payments: "getAllVendorPayment",
    }),
  },
};
</script>