<template>
  <b-form @submit.prevent="onSubmit" @reset="onReset" @keydown="form.errors.clear()">
    <DisplayError :form="form"></DisplayError>
    <b-form-group id="input-group-2">
      <b-form-input v-model="form.name" placeholder="Name"></b-form-input>
    </b-form-group>

    <b-form-group id="input-group-2">
      <b-form-textarea
        id="textarea"
        v-model="form.description"
        placeholder="Note"
        rows="3"
        max-rows="6"
      ></b-form-textarea>
    </b-form-group>
    <b-button type="submit" variant="primary">Submit</b-button>
    <b-button type="reset" variant="danger">Reset</b-button>
  </b-form>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        name: "",
        description: "",
      }),
    };
  },
  methods: {
    deleteItem(item_id) {
      axios
        .delete(`/api/expense_categories/${item_id}`)
        .then((response) => {
          this.$store.dispatch("RETRIEVE_EXPENSE_CATEGORIES");
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
        .submit("post", "/api/expense_categories")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$store.dispatch("RETRIEVE_EXPENSE_CATEGORIES");
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

      this.form.name = "";
      this.form.description = "";
    },
  },
};
</script>