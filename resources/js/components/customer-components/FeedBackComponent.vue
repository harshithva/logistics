<template>
  <form action="/customer/feedback" @submit.prevent="onSubmit">
    <div class="form-group">
      <label for="exampleFormControlInput1">Freight Invoice number</label>
      <input type="text" class="form-control" v-model="freightInvoiceProp" disabled required />
    </div>
    <div class="form-group">
      <label for="delivery_address">Feedback</label>
      <textarea
        class="form-control"
        id="delivery_address"
        rows="6"
        v-model="form.feedback"
        required
      ></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
</template>

<script>
export default {
  props: ["freightInvoiceProp"],
  data() {
    return {
      form: new Form({
        feedback: "",
        freight_invoice_number: ""
      })
    };
  },
  methods: {
    onSubmit() {
      this.form.freight_invoice_number = this.freightInvoiceProp;
      this.form
        .submit("post", "/api/customer/feedback")
        .then(response => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Feedback Sent! Thank you",
            showConfirmButton: false,
            timer: 1500
          });
        })
        .catch(error =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"
          })
        );
    }
  }
};
</script>