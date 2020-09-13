<template>
  <b-form @submit="onSubmit" @reset="onReset">
    <b-form-group id="input-group-1" label="Select Expense Category">
      <v-select :options="expense_categories" label="name" @input="selectCategory($event)"></v-select>
    </b-form-group>
    <b-form-group id="input-group-1" label="Date">
      <b-form-datepicker id="example-datepicker" v-model="form.date" class="mb-2"></b-form-datepicker>
    </b-form-group>

    <b-form-group id="input-group-1">
      <b-form-input v-model="form.name" placeholder="Name"></b-form-input>
    </b-form-group>
    <b-form-group id="input-group-1">
      <b-form-input v-model="form.amount" placeholder="Amount" type="number"></b-form-input>
    </b-form-group>
    <b-form-group id="input-group-1">
      <b-form-textarea id="textarea" v-model="form.note" placeholder="Note" rows="3" max-rows="6"></b-form-textarea>
    </b-form-group>
    <b-button type="submit" variant="primary">Submit</b-button>
    <b-button type="reset" variant="danger">Reset</b-button>
  </b-form>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      form: new Form({
        category_id: "",
        date: "",
        name: "",
        note: "",
        amount: 0,
      }),
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("post", "/api/expenses")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$store.dispatch("RETRIEVE_EXPENSES");
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
      this.form.category_id = "";
      this.form.date = "";
      this.form.name = "";
      this.form.note = "";
      this.form.amount = 0;
    },
    selectCategory(e) {
      this.form.category_id = e.id;
    },
  },
  created() {
    this.$store.dispatch("RETRIEVE_EXPENSE_CATEGORIES");
  },
  computed: {
    ...mapGetters({
      expense_categories: "getExpenseCategories",
    }),
  },
};
</script>