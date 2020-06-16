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
        <div class="col"></div>
        <div class="col"></div>
        <div class="col">
          <button class="btn btn-outline-primary ml-2" @click="generatePdf">
            <i class="fas fa-download"></i> Download PDF
          </button>
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
              <datatable
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
              />

              <!-- <table class="table table-bordered table-responsive" ref="content">
                <thead>
                  <tr role="row">
                    <th>Date</th>
                    <th>Product</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Docket No</th>
                    <th>Invoice No</th>
                    <th>Amount</th>
                    <th>Consignor</th>
                    <th>Consignee</th>
                    <th>Consignor GST</th>
                    <th>Consignee GST</th>
                  </tr>
                </thead>
                <tr v-for="item in packages">
                  <td>{{moment(item.shipment_date).format("DD/MM/YYYY")}}</td>
                  <td>{{item.description}}</td>
                  <td>{{item.shipment_sender_address}}</td>
                  <td>{{item.shipment_delivery_address}}</td>
                  <td>{{item.shipment_docket_no}}</td>
                  <td>{{item.shipment_freight_invoice_number}}</td>
                  <td>{{item.shipment_charge_total}}</td>
                  <td>{{item.shipment_sender_name}}</td>
                  <td>{{item.shipment_receiver_name}}</td>
                  <td>{{item.shipment_sender_gst}}</td>
                  <td>{{item.shipment_receiver_gst}}</td>
                </tr>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Docket No</th>
                    <th>Invoice No</th>
                    <th>Amount</th>
                    <th>Consignor</th>
                    <th>Consignee</th>
                    <th>Consignor GST</th>
                    <th>Consignee GST</th>
                  </tr>
                </tfoot>
                <tbody></tbody>
              </table>-->
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
      file: null,
      status: "pickup",
      tableColumns1: [
        {
          label: "Date",
          field: "shipment_date",
          numeric: false,
          html: false
        },
        {
          label: "Product",
          field: "description",
          numeric: false,
          html: false
        },
        {
          label: "From",
          field: "shipment_sender_address",
          numeric: false,
          html: false
        },
        {
          label: "To",
          field: "shipment_delivery_address",
          numeric: false,
          html: false
        },
        {
          label: "Docket",
          field: "shipment_docket_no",
          numeric: false,
          html: false
        },
        {
          label: "Freight Invoice Number",
          field: "shipment_freight_invoice_number",
          numeric: false,
          html: false
        },
        {
          label: "Charge Total",
          field: "shipment_charge_total",
          numeric: false,
          html: false
        },
        {
          label: "Charge Total",
          field: "shipment_charge_total",
          numeric: false,
          html: false
        },
        {
          label: "Sender Name",
          field: "shipment_sender_name",
          numeric: false,
          html: false
        },
        {
          label: "Receiver Name",
          field: "shipment_receiver_name",
          numeric: false,
          html: false
        },
        {
          label: "Sender GST",
          field: "shipment_sender_gst",
          numeric: false,
          html: false
        },
        {
          label: "Receiver GST",
          field: "shipment_receiver_gst",
          numeric: false,
          html: false
        }
      ]
    };
  },
  methods: {
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