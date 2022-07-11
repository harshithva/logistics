<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Shipment List</h6>
      </div>
      <div class="card-body">
        <vue-good-table
          v-if="shipments && shipments.length"
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
          :sort-options="{
            enabled: false,
            initialSortBy: { field: 'created_at', type: 'desc' },
          }"
        >
          <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'action'">
              <router-link
                :to="
                  '/admin/customers/' +
                  props.row.sender_id +
                  '/invoices/' +
                  props.row.id +
                  '/view'
                "
                data-toggle="tooltip"
                data-placement="top"
                title="View"
                 target="_blank"
              >
                <i class="fas fa-eye text-secondary"></i>
              </router-link>
              <a
                v-b-modal.modal-1
                variant="primary"
                class="btn btn-sm"
                @click="openUpdateStatus(props.row)"
              >
                <i class="fas fa-car text-secondary"></i>
              </a>
            </span>

            <span v-if="props.column.field == 'location'">
              <span v-if="props.row.current_status.location"
                >{{ props.row.current_status.location }} -
                {{
                  moment(props.row.current_status.created_at).format(
                    "DD/MM/YYYY h:mm a"
                  )
                }}</span
              >
            </span>
            <span v-if="props.column.field == 'status'">
              <span
                class="badge badge-pill badge-success"
                v-if="props.row.current_status.status"
                >{{ props.row.current_status.status }}</span
              >
            </span>

            <span v-if="props.column.field == 'payment'">
              <span
                class="badge badge-pill badge-success"
                v-if="props.row.balance <= 0"
                >Paid</span
              >
              <span
                class="badge badge-pill badge-danger"
                v-else-if="props.row.balance == props.row.charge_total"
                >Pending</span
              >

              <span class="badge badge-pill badge-warning" v-else>Partial</span>
            </span>

            <span v-else>{{ props.formattedRow[props.column.field] }}</span>
          </template>
        </vue-good-table>
      </div>
    </div>

    <!-- update status -->
    <b-modal id="modal-1" title="Update Status">
      <UpdateStatus
        :shipment_id="shipment.id"
        :sender_id="shipment.sender_id"
      ></UpdateStatus>
      <template v-slot:modal-footer>
        <div class="w-100"></div>
      </template>
    </b-modal>
  </fragment>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      file: null,
      status: "pickup",
      shipment: {},

      tableColumns1: [
        {
          label: "Tracking Number",
          field: "docket_no",
          // sortable: true,
        },
        {
          label: "Date",
          field: "created_at",
          // sortable:true,
          type: "datetime",
          dateInputFormat: "yyyy-MM-d HH:mm:ss",
          dateOutputFormat: "dd/mm/yyyy",
        },
        {
          label: "Name",
          field: "sender_name",
        },
        {
          label: "From",
          field: "sender_address",
        },
        {
          label: "To",
          field: "delivery_address",
        },
        {
          label: "Current Location",
          field: "location",
        },
        {
          label: "Status",
          field: "status",
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
  methods: {
    openUpdateStatus(e) {
      this.shipment = e;
    },
    searchShipment() {
      this.$store.commit("searchShipment", this.search);
    },
    clearFiles() {
      this.$refs["file-input"].reset();
    },
  },
  created() {
    this.$store.dispatch("retrieveShipments");
  },
  computed: {
    ...mapGetters({
      shipments: "getFilteredShipments",
    }),
  },
};
</script>