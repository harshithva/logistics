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
        <div class="col">
          <!-- <a class="btn btn-primary text-white ml-2" onclick="javascript:window.print()">
            <i class="fas fa-print"></i> Print Report
          </a>-->
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
              <table class="table table-bordered table-responsive">
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
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      file: null,
      status: "pickup"
    };
  },
  methods: {},
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