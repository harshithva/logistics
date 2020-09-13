<template>
  <fragment>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col">
            <h6 class="m-0 font-weight-bold text-primary">Expenses</h6>
          </div>
          <div class="col-8"></div>
          <div class="col">
            <b-button v-b-modal.modal-1 variant="primary">Add Expense</b-button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <vue-good-table
          v-if="expenses && expenses.length"
          :columns="tableColumns1"
          :rows="expenses"
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
      <b-tabs content-class="mt-3" fill active>
        <b-tab title="Expense" active>
          <AddExpense></AddExpense>
        </b-tab>
        <b-tab title="Expense Category">
          <AddExpenseCategory></AddExpenseCategory>
        </b-tab>
      </b-tabs>
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
import { mapGetters } from "vuex";
import AddExpense from "./AddExpense";
import AddExpenseCategory from "./AddExpenseCategory";

export default {
  data() {
    return {
      show: false,
      form: new Form({
        category_id: "",
        date: "",
        name: "",
        note: "",
        amount: 0,
      }),
      tableColumns1: [
        {
          label: "Name",
          field: "name",
        },
        {
          label: "Amount",
          field: "amount",
        },
        {
          label: "Note",
          field: "note",
        },
        {
          label: "Category Name",
          field: "category_name",
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
    AddExpense,
    AddExpenseCategory,
  },
  methods: {
    deleteItem(item_id) {
      axios
        .delete(`/api/expenses/${item_id}`)
        .then((response) => {
          this.$store.dispatch("RETRIEVE_EXPENSES");
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
    this.$store.dispatch("RETRIEVE_EXPENSES");
  },
  computed: {
    ...mapGetters({
      expenses: "getExpenses",
    }),
  },
};
</script>