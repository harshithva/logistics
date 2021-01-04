<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="m-0 font-weight-bold text-primary">General Reports</h6>
      </div>
      <div class="row">
        <div class="col">
          <router-link
            to="/admin/reports"
            class="d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2 active"
          >
            <i class="fas fa-scroll fa-sm"></i> Reports
          </router-link>
          <router-link
            to="/admin/payment_log"
            class="d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"
          >
            <i class="fas fa-rupee-sign fa-sm"></i> Payment Log
          </router-link>
        </div>
        <div class="col-6"></div>
        <div class="col">
          <button class="btn btn-danger ml-2 btn-sm" @click="generatePdf">
            <i class="fas fa-file-download"></i> &nbsp;PDF
          </button>
          <export-excel
            :data="packages"
            :fields="json_fields"
            class="btn btn-success btn-sm"
          >
            <i class="fas fa-cloud-download-alt"></i> &nbsp;Excel
          </export-excel>
          <b-form-select
            v-model="selectedMonth"
            :options="options"
            size="sm"
            @change="selectMonth"
            style="width: 8rem"
          ></b-form-select>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="col-sm-12">
        <vue-good-table
          v-if="packages && packages.length"
          :columns="tableColumns1"
          :rows="packages"
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
            initialSortBy: { field: 'shipment_date', type: 'desc' },
          }"
        >
          <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'packages'">
              <p v-for="p in props.row.packages">{{ p.description }}</p>
            </span>

            <span v-else>{{ props.formattedRow[props.column.field] }}</span>
          </template>
        </vue-good-table>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import jsPDF from "jspdf";
import "jspdf-autotable";

export default {
  data() {
    return {
      selectedMonth: 0,
      json_fields: {
        Date: "shipment_date",
        Product: "packages_description",
        From: "shipment_sender_address",
        To: "shipment_delivery_address",
        Docket: "shipment_docket_no",
        "Freight Invoice Number": "shipment_freight_invoice_number",
        TDS: "shipment_tds_amount",
        "Charge Total": "shipment_charge_total",
        "Sender Name": "shipment_sender_name",
        "Receiver Name": "shipment_receiver_name",
        "Sender GST": "shipment_sender_gst",
        "Receiver GST": "shipment_receiver_gst",
      },
      options: [
        { value: 0, text: "All" },
        { value: 1, text: "This month" },
        { value: 2, text: "Last month" },
        { value: 3, text: "This year" },
      ],
      file: null,
      status: "pickup",

      tableColumns1: [
        {
          label: "Date",
          field: "shipment_date",

          type: "date",
          dateInputFormat: "yyyy-mm-dd",
          dateOutputFormat: "dd/mm/yyyy",
        },
        {
          label: "Product",
          field: "packages",
          numeric: false,
        },
        {
          label: "From",
          field: "shipment_sender_address",
          numeric: false,
        },
        {
          label: "To",
          field: "shipment_delivery_address",
          numeric: false,
        },
        {
          label: "Docket",
          field: "shipment_docket_no",
          numeric: false,
        },
        {
          label: "Freight Invoice Number",
          field: "shipment_freight_invoice_number",
          numeric: false,
        },
        {
          label: "Charge Total",
          field: "shipment_charge_total",
          numeric: false,
        },
        {
          label: "TDS",
          field: "shipment_tds_amount",
          numeric: false,
        },

        {
          label: "Sender Name",
          field: "shipment_sender_name",
          numeric: false,
        },
        {
          label: "Receiver Name",
          field: "shipment_receiver_name",
          numeric: false,
        },
        {
          label: "Sender GST",
          field: "shipment_sender_gst",
          numeric: false,
        },
        {
          label: "Receiver GST",
          field: "shipment_receiver_gst",
          numeric: false,
        },
        {
          label: "Payment Type",
          field: "shipment_payment_type",
          numeric: false,
        },
      ],
    };
  },
  methods: {
    selectMonth() {
      this.$store.commit("selectMonth", this.selectedMonth);
    },
    generatePdf() {
      const vm = this;
      const columns = [
        { title: "Date", dataKey: "shipment_date" },
        { title: "Product", dataKey: "packages_description" },
        { title: "From", dataKey: "shipment_sender_address" },
        { title: "To", dataKey: "shipment_delivery_address" },
        { title: "Docket", dataKey: "shipment_docket_no" },
        {
          title: "Invoice Number",
          dataKey: "shipment_freight_invoice_number",
        },
        { title: "TDS", dataKey: "shipment_tds_amount" },
        { title: "Charge Total", dataKey: "shipment_charge_total" },
        { title: "Sender Name", dataKey: "shipment_sender_name" },
        { title: "Receiver Name", dataKey: "shipment_receiver_name" },
        { title: "Sender GST", dataKey: "shipment_sender_gst" },
        { title: "Receiver GST", dataKey: "shipment_receiver_gst" },
      ];
      const doc = new jsPDF("p", "pt");

      doc.autoTable(columns, vm.packages, {
        styles: {
          fontSize: 4,
        },
      });

      doc.save("reports.pdf");
    },
  },
  created() {
    this.$store.dispatch("retrievePackages");
  },
  computed: {
    ...mapGetters({
      packages: "getAllPackages",
    }),
  },
};
</script>