<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col">
            <h6 class="m-0 font-weight-bold text-primary">Price List</h6>
          </div>
          <div class="col-8"></div>
          <div class="col">
            <b-button v-b-modal.modal-1 variant="primary">Add</b-button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <vue-good-table
          v-if="price_lists && price_lists.length"
          :columns="tableColumns1"
          :rows="price_lists"
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

    <!-- add price list -->
    <b-modal id="modal-1" title="Create">
      <b-form @submit="onSubmit" @reset="onReset">
        <b-form-group id="input-group-1" label="From">
          <b-form-input id="input-1" v-model="form.from" type="text" required disabled></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-1" label="To:">
          <b-form-input id="input-1" v-model="form.to" type="text" required></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-1" label="LCV">
          <b-form-input id="input-1" v-model="form.rate_1" type="text" required placeholder="0.0"></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-1" label="28Ft Open Truck">
          <b-form-input id="input-1" v-model="form.rate_2" type="text" required placeholder="0.0"></b-form-input>
        </b-form-group>
      </b-form>
      <template v-slot:modal-footer>
        <div class="w-100">
          <b-button
            type="submit"
            @click="onSubmit"
            variant="primary"
            size="sm"
            class="float-right"
          >Add</b-button>
        </div>
      </template>
    </b-modal>
  </fragment>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      show: false,
      form: new Form({
        from: "bangalore",
        to: "",
        rate_1: "",
        rate_2: "",
      }),
      tableColumns1: [
        {
          label: "From",
          field: "from",
        },
        {
          label: "To",
          field: "to",
        },
        {
          label: "Rate",
          field: "rate_1",
        },
        {
          label: "Rate",
          field: "rate_1",
        },
        // {
        //   label: "Created At",
        //   field: "created_at",
        //   type: "date",
        //   dateInputFormat: "yyyy-mm-dd",
        //   dateOutputFormat: "dd/mm/yyyy",
        // },

        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
  methods: {
    deleteItem(item_id) {
      const data = {
        id: item_id,
      };
      axios
        .post(`/api/price_lists/${item_id}/delete`, data)
        .then((response) => {
          this.$store.dispatch("retrievePriceLists");
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
    onSubmit() {
      console.log("hello");
      this.form
        .submit("post", "/api/price_lists")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.form.from = "Bangalore";
          this.$store.dispatch("retrievePriceLists");
        })
        .catch((error) =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          })
        );
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.to = "";
      this.form.rate_1 = "";
      this.form.rate_2 = "";
    },
  },
  created() {
    this.$store.dispatch("retrievePriceLists");
  },
  computed: {
    ...mapGetters({
      price_lists: "getFilteredPriceLists",
    }),
  },
};
</script>