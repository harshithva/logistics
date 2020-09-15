<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col">
            <h6 class="m-0 font-weight-bold text-primary">call_logs</h6>
          </div>
          <div class="col-6"></div>
          <div class="col">
            <b-button v-b-modal.modal-1 variant="primary" class="btn btn-sm">Add Call Log</b-button>
            <button class="btn btn-danger btn-sm" @click="generatePdf">
              <i class="fas fa-file-download"></i> &nbsp;PDF
            </button>
            <export-excel :data="call_logs" :fields="json_fields" class="btn btn-success btn-sm">
              <i class="fas fa-cloud-download-alt"></i> &nbsp;Excel
            </export-excel>
          </div>
        </div>
      </div>
      <div class="card-body">
        <vue-good-table
          v-if="call_logs && call_logs.length"
          :columns="tableColumns1"
          :rows="call_logs"
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

            <span v-else>{{props.formattedRow[props.column.field]}}</span>
          </template>
        </vue-good-table>
      </div>
    </div>

    <!-- add expense -->
    <b-modal id="modal-1" title="Create">
      <AddCallLog></AddCallLog>

      <template v-slot:modal-footer>
        <div class="w-100">
          <!-- <b-button
            type="submit"
            @click="onSubmit"
            variant="primary"
            size="sm"
            class="float-right"
          >Add</b-button>-->
        </div>
      </template>
    </b-modal>
  </fragment>
</template>

<script>
import jsPDF from "jspdf";
import { mapGetters } from "vuex";
import AddCallLog from "./AddCallLog";

export default {
  data() {
    return {
      show: false,
      json_fields: {
        "Customer Name": "name",
        "Company Name": "company_name",
        Duration: "duration",
        Date: "date",
      },
      tableColumns1: [
        {
          label: "Customer Name",
          field: "name",
        },
        {
          label: "Company Name",
          field: "company_name",
        },

        {
          label: "Duration",
          field: "duration",
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
    AddCallLog,
  },
  methods: {
    generatePdf() {
      const vm = this;
      const columns = [
        { title: "Customer Name", dataKey: "name" },
        { title: "Company Name", dataKey: "company_name" },
        { title: "duration", dataKey: "duration" },
        { title: "Date", dataKey: "date" },
      ];
      const doc = new jsPDF("p", "pt");

      doc.autoTable(columns, vm.call_logs, {
        styles: {
          fontSize: 10,
        },
      });

      doc.save("call_logs.pdf");
    },
    deleteItem(item_id) {
      axios
        .delete(`/api/call_logs/${item_id}`)
        .then((response) => {
          this.$store.dispatch("RETRIEVE_CALL_LOGS");
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
    this.$store.dispatch("RETRIEVE_CALL_LOGS");
  },
  computed: {
    ...mapGetters({
      call_logs: "getCallLogs",
    }),
  },
};
</script>