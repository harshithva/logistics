<template>
  <form
    class="form-horizontal form-material"
    :action="'/admin/customers/' + form.id"
    @keydown="form.errors.clear()"
  >
    <b-alert
      :show="dismissCountDown"
      variant="success"
      dismissible
      fade
      @dismissed="dismissCountDown = 0"
      @dismiss-count-down="countDownChanged"
      >Well Done! Updated Successfully</b-alert
    >

    <section>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Email"
              v-model="form.email"
              :class="{ 'border border-danger': form.errors.has('email') }"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Phone"
              v-model="form.phone"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Name"
              v-model="form.name"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Company Name"
              v-model="form.company_name"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="GST No"
              v-model="form.gst"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Address</label>
            <textarea
              class="form-control"
              id="exampleFormControlTextarea1"
              rows="3"
              v-model="form.address"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <textarea
              class="form-control"
              name="notes"
              rows="6"
              placeholder="User Notes - For internal use only."
              v-model="form.user_notes"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <span>Show Rates</span>
          <b-form-checkbox
            switch
            size="lg"
            v-model="form.show_rates"
          ></b-form-checkbox>
        </div>
      </div>
    </section>
    <div class="form-group">
      <div class="col-sm-12">
        <button
          class="btn btn-outline-primary"
          name="dosubmit"
          type="submit"
          :disabled="form.errors.any()"
          @click.prevent="onSubmit"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          Update Customer
          <span>
            <i class="icon-ok"></i>
          </span>
        </button>
        <button
          class="btn btn-outline-danger btn-confirmation"
          name="dosubmit"
          type="submit"
          @click.prevent="deleteCustomer"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          Delete Customer
          <span>
            <i class="icon-ok"></i>
          </span>
        </button>
        <router-link
          to="/admin"
          class="btn btn-outline-secondary btn-confirmation"
        >
          <span>
            <i class="ti-share-alt"></i>
          </span>
          Return to the dashboard
        </router-link>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: ["form"],
  data() {
    return {
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("patch", "/api/customers/" + this.form.id)
        .then((response) => (this.dismissCountDown = 10))
        .catch((error) =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          })
        );
    },
    deleteCustomer() {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          this.form
            .submit("delete", "/api/customers/" + this.form.id)
            .then((response) => this.$router.push("/admin/customers"))
            .catch((error) =>
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
              })
            );
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
  },
};
</script>