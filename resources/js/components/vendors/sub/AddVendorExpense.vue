<template>
  <b-form
    @submit.prevent="onSubmit"
    @reset="onReset"
    @keydown="form.errors.clear()"
  >
    <DisplayError :form="form"></DisplayError>
    <b-form-group id="input-group-1" label="Select Vendor">
      <v-select
        :options="vendors"
        label="name"
        v-model="form.vendor_id"
        :reduce="(vendor) => vendor.id"
      ></v-select>
    </b-form-group>

    <b-form-group id="input-group-1">
      <b-form-input v-model="form.name" placeholder="Name"></b-form-input>
    </b-form-group>
    <b-form-group id="input-group-1">
      <b-form-input
        v-model="form.amount"
        placeholder="Amount"
        type="number"
      ></b-form-input>
    </b-form-group>
    <b-form-group id="input-group-1">
      <b-form-textarea
        id="textarea"
        v-model="form.note"
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
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      form: new Form({
        vendor_id: "",
        name: "",
        note: "",
        amount: 0,
      }),
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("post", "/api/vendor_expenses")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$store.dispatch("RETRIEVE_VENDOR_EXPENSES");
        })
        .catch();
    },
    onReset(evt) {
      evt.preventDefault();
      this.form.vendor_id = "";
      this.form.name = "";
      this.form.note = "";
      this.form.amount = 0;
    },
  },
  created() {
    this.$store.dispatch("RETRIEVE_ALL_VENDORS");
  },
  computed: {
    ...mapGetters({
      vendors: "getAllVendors",
    }),
  },
};
</script>