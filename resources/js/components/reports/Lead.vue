<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col">
            <h6 class="m-0 font-weight-bold text-primary">Leads</h6>
          </div>
          <div class="col-6"></div>
          <div class="col">
            <b-button v-b-modal.modal-1 variant="primary" class="btn btn-sm"
              >Add Lead</b-button
            >
            <!-- <button class="btn btn-danger btn-sm" @click="generatePdf">
              <i class="fas fa-file-download"></i> &nbsp;PDF
            </button> -->
            <export-excel
              :data="leads"
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
          v-if="leads && leads.length"
          :columns="tableColumns1"
          :rows="leads"
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

    <!-- add expense -->
    <b-modal id="modal-1" title="Create">
      <AddLead></AddLead>

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
import AddLead from "./AddLead";

export default {
  data() {
    return {
      show: false,
      json_fields: {
        Date:"created_at",
        email:"email",
        "Lead Name":"name",
        "Lead Type":"type",
        "Lead Contact":"contact",
        "Lead Source":"source",
        "Lead region":"region",
        "Lead country":"country",
        "Potential Opportunity":"potential_opportunity",
        "Chance of Sale":"chance_of_sale",
        "Forecast close":"forecast_close",
        "Weighted Forecast":"weighted_forecast",

      },
      tableColumns1: [

        // {
        //   label: "Date",
        //   field: "created_at",
        // },
        {
          label: "Email",
          field: "email",
        },
         {
          label: "Lead Name",
          field: "name",
        },
         {
          label: "Type",
          field: "type",
        },
         {
          label: "Source",
          field: "source",
        },
         {
          label: "Lead Contact",
          field: "contact",
        },
                {
          label: "Lead Region",
          field: "region",
        },
        {
          label: "Country",
          field: "country",
        },
        {
          label: "Potential Opportunity",
          field: "potential_opportunity",
        },
                {
          label: "Chance of sale",
          field: "chance_of_sale",
        },
                {
          label: "Forecast Close",
          field: "forecast_close",
        },
                {
          label: "Weighted forecast",
          field: "weighted_forecast",
        },
        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
  components: {
    AddLead,
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

      doc.autoTable(columns, vm.leads, {
        styles: {
          fontSize: 10,
        },
      });

      doc.save("leads.pdf");
    },
    deleteItem(item_id) {
      axios
        .delete(`/api/leads/${item_id}`)
        .then((response) => {
          this.$store.dispatch("RETRIEVE_LEADS");
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
    this.$store.dispatch("RETRIEVE_LEADS");
  },
  computed: {
    ...mapGetters({
      leads: "getLeads",
    }),
  },
};
</script>