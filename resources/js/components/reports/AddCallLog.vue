<template>
  <b-form
    @submit.prevent="onSubmit"
    @reset="onReset"
    @keydown="form.errors.clear()"
  >
    <DisplayError :form="form"></DisplayError>
    <b-form-group id="input-group-1" label="Select Customer">
      <v-select
        :options="customers"
        label="name"
        @input="selectCustomer($event)"
      ></v-select>
    </b-form-group>
    <b-form-group id="input-group-1" label="Duration">
      <b-form-input
        v-model="form.duration"
        placeholder="Duration"
        type="text"
      ></b-form-input>
    </b-form-group>
    <b-form-textarea
      id="textarea"
      v-model="form.feedback"
      placeholder="Feedback..."
      rows="3"
      max-rows="6"
      class="mb-2"
    ></b-form-textarea>

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
        customer_id: "",
        duration: "",
        feedback: "",
      }),
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("post", "/api/call_logs")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$store.dispatch("RETRIEVE_CALL_LOGS");
        })
        .catch();
    },
    onReset(evt) {
      evt.preventDefault();
      this.form.customer_id = "";
      this.form.duration = "";
    },
    selectCustomer(e) {
      this.form.customer_id = e.id;
    },
  },
  created() {
    this.$store.dispatch("retrieveCustomers");
  },
  computed: {
    ...mapGetters({
      customers: "getAllCustomers",
    }),
  },
};
</script>