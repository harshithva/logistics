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
            class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
          >
            <i class="fas fa-scroll fa-sm"></i> Reports
          </router-link>
          <router-link
            to="/admin/payment_log"
            class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"
          >
            <i class="fas fa-rupee-sign fa-sm"></i> Payment Log
          </router-link>
        </div>
        <div class="col-6"></div>
        <div class="col">
          <button class="btn btn-primary ml-2 btn-sm" @click="generatePdf">
            <i class="fas fa-download"></i> Download PDF
          </button>
          <export-excel :data="packages" class="btn btn-success btn-sm">Download Excel</export-excel>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div>
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <!-- <div class="row">
            <div class="col-sm-12 col-md-6"></div>
            <div class="col-sm-12 col-md-6 text-right">
              <div id="dataTable_filter" class="dataTables_filter">
                <label>
                  Search: &nbsp;
                  <input
                    type="search"
                    class="form-control form-control-sm"
                    placeholder
                    aria-controls="dataTable"
                  />
                </label>
              </div>
            </div>
          </div>-->
          <div class="row">
            <div class="col-sm-12">
              <!-- <datatable
                title="Reports"
                :columns="tableColumns1"
                :rows="packages"
                :clickable="false"
                :sortable="true"
                :exactSearch="false"
                :searchable="true"
                :paginate="true"
                :exportable="true"
                :printable="false"
                class="table-responsive p-4"
              ></datatable>-->

              <vue-good-table
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
              >
                <div slot="table-actions">
                  <b-form-select
                    v-model="selectedMonth"
                    :options="options"
                    size="sm"
                    class="mb-1"
                    @change="selectMonth"
                  ></b-form-select>
                </div>
              </vue-good-table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import jsPDF from "jspdf";
import "jspdf-autotable";

import DataTable from "vue-materialize-datatable";

export default {
  components: {
    datatable: DataTable
  },
  data() {
    return {
      selectedMonth: 0,
      options: [
        { value: 0, text: "All" },
        { value: 1, text: "This month" },
        { value: 2, text: "Last month" }
      ],
      file: null,
      status: "pickup",
      tableColumns1: [
        {
          label: "Date",
          field: "shipment_date",
          firstSortType: "desc",
          type: "date",
          dateInputFormat: "yyyy-mm-dd",
          dateOutputFormat: "dd/mm/yyyy"
        },
        {
          label: "Product",
          field: "description",
          numeric: false
        },
        {
          label: "From",
          field: "shipment_sender_address",
          numeric: false
        },
        {
          label: "To",
          field: "shipment_delivery_address",
          numeric: false
        },
        {
          label: "Docket",
          field: "shipment_docket_no",
          numeric: false
        },
        {
          label: "Freight Invoice Number",
          field: "shipment_freight_invoice_number",
          numeric: false
        },
        {
          label: "Charge Total",
          field: "shipment_charge_total",
          numeric: false
        },

        {
          label: "Sender Name",
          field: "shipment_sender_name",
          numeric: false
        },
        {
          label: "Receiver Name",
          field: "shipment_receiver_name",
          numeric: false
        },
        {
          label: "Sender GST",
          field: "shipment_sender_gst",
          numeric: false
        },
        {
          label: "Receiver GST",
          field: "shipment_receiver_gst",
          numeric: false
        }
      ]
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
        { title: "Product", dataKey: "description" },
        { title: "From", dataKey: "shipment_sender_address" },
        { title: "To", dataKey: "shipment_delivery_address" },
        { title: "Docket", dataKey: "shipment_docket_no" },
        {
          title: "Invoice Number",
          dataKey: "shipment_freight_invoice_number"
        },
        { title: "Charge Total", dataKey: "shipment_charge_total" },
        { title: "Sender Name", dataKey: "shipment_sender_name" },
        { title: "Receiver Name", dataKey: "shipment_receiver_name" },
        { title: "Sender GST", dataKey: "shipment_sender_gst" },
        { title: "Receiver GST", dataKey: "shipment_receiver_gst" }
      ];
      const doc = new jsPDF("p", "pt");

      doc.autoTable(columns, vm.packages, {
        styles: {
          fontSize: 6
        }
      });
      doc.save("reports.pdf");
    }
  },
  created() {
    this.$store.dispatch("retrievePackages");
  },
  computed: {
    ...mapGetters({
      packages: "getAllPackages"
    })
  }
};
</script>