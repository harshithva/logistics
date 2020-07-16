<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Shipment List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                <span v-if="props.column.field == 'action'">
                  <router-link
                    :to="'/admin/customers/'+ props.row.sender_id +'/invoices/'+ props.row.id + '/view'"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View"
                  >
                    <i class="fas fa-eye text-secondary"></i>
                  </router-link>
                </span>

                <span v-if="props.column.field == 'status'">
                  <span
                    class="badge badge-pill badge-success"
                    v-if="props.row.current_status.status"
                  >{{props.row.current_status.status}}</span>
                </span>

                <span v-if="props.column.field == 'payment'">
                  <span
                    class="badge badge-pill badge-success"
                    v-if="props.row.balance_amount <= 0"
                  >Paid</span>
                  <span
                    class="badge badge-pill badge-danger"
                    v-else-if="props.row.balance_amount == props.row.charge_total"
                  >Pending</span>

                  <span class="badge badge-pill badge-warning" v-else>Partial</span>
                </span>

                <span v-else>{{props.formattedRow[props.column.field]}}</span>
              </template>
            </vue-good-table>
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      file: null,
      status: "pickup",

      tableColumns1: [
        {
          label: "Tracking Number",
          field: "docket_no"
        },
        {
          label: "Date",
          field: "date"
        },
        {
          label: "Name",
          field: "sender_name"
        },
        {
          label: "From",
          field: "sender_address"
        },
        {
          label: "To",
          field: "delivery_address"
        },
        {
          label: "Status",
          field: "status"
        },
        {
          label: "Payment",
          field: "payment"
        },
        {
          label: "Action",
          field: "action"
        }
      ]
    };
  },
  methods: {
    searchShipment() {
      this.$store.commit("searchShipment", this.search);
    },
    clearFiles() {
      this.$refs["file-input"].reset();
    }
  },
  created() {
    this.$store.dispatch("retrieveShipments");
  },
  computed: {
    ...mapGetters({
      shipments: "getFilteredShipments"
    })
  }
};
</script>