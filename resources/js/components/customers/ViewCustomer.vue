<template>
  <div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          <center class="m-t-30">
            <img
              src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png"
              class="rounded-circle"
              width="100"
            />
            <h4 class="card-title m-t-10">{{form.name}}</h4>
            <h6 class="card-subtitle">
              <div class="badge badge-pill badge-success font-16" v-if="form.status == true">
                <span class="ti-user text-success"></span>
                Active
              </div>

              <div class="badge badge-pill badge-success font-16" v-else-if="form.status == false">
                <span class="ti-user text-success"></span>
                Inactive
              </div>
            </h6>
          </center>
        </div>
        <div>
          <hr />
        </div>
        <div class="card-body">
          <!-- customer created alert -->
          <b-alert
            :show="dismissCountDown"
            variant="success"
            dismissible
            fade
            @dismissed="dismissCountDown=0"
            @dismiss-count-down="countDownChanged"
          >Customer Updated!</b-alert>

          <small class="text-muted">E-mail</small>
          <h6>{{form.email}}</h6>
          <small class="text-muted p-t-30 db">Phone</small>
          <h6>{{form.phone}}</h6>
          <small class="text-muted p-t-30 db">Address</small>
          <h6>{{form.email}}</h6>
        </div>
        <div class="card-body row">
          <div class="col-12">
            <p class="font-s">Registration Date: {{moment(form.created_at).format('YYYY-MM-DD')}}</p>
            <p></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <div id="loader" style="display:none"></div>
          <div id="msgholder"></div>
          <div class="row mb-4">
            <router-link
              :to="'/admin/customers/' + form.id"
              aria-current="page"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-3"
            >
              <i class="fas fa-edit fa-sm"></i> Edit
            </router-link>
            <router-link
              :to="'/admin/customers/' + form.id + '/invoice'"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
            >
              <i class="fas fa-rupee-sign fa-sm"></i> Invoices
            </router-link>
            <router-link
              :to="'/admin/customers/' + form.id + '/quotes'"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
            >
              <i class="fas fa-scroll fa-sm"></i> Quotes
            </router-link>
          </div>
          <form
            class="form-horizontal form-material"
            :action="'/admin/customers/' + form.id"
            @keydown="form.errors.clear()"
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
                      :class="{'border border-danger': form.errors.has('email')}"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Password" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" v-model="form.name" />
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
                    <input type="text" class="form-control" placeholder="GST No" v-model="form.gst" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Email"
                      v-model="form.phone"
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
            </section>
            <div class="form-group">
              <div class="col-sm-12">
                <button
                  class="btn btn-outline-primary"
                  name="dosubmit"
                  type="submit"
                  :disabled="form.errors.any()"
                  @click.prevent="onSubmit"
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
                >
                  Delete Customer
                  <span>
                    <i class="icon-ok"></i>
                  </span>
                </button>
                <router-link to="/admin" class="btn btn-outline-secondary btn-confirmation">
                  <span>
                    <i class="ti-share-alt"></i>
                  </span> Return to the dashboard
                </router-link>
              </div>
            </div>
            <input name="locker" type="hidden" value="274218" />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.router-link-exact-active {
  background-color: #4e73df;
  color: white;
}
</style>


<script>
export default {
  data() {
    return {
      customer: {},
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("patch", "/api/customers/" + this.form.id)
        .then(response => (this.dismissCountDown = 10))
        .catch(error =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"
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
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.form
            .submit("delete", "/api/customers/" + this.form.id)
            .then(response => this.$router.push("/admin/customers"))
            .catch(error =>
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
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
    }
  },
  computed: {
    form() {
      return new Form(this.$store.getters.getSingleCustomer);
    }
  },
  created() {
    this.$store.dispatch("retrieveSingleCustomer", this.$route.params.id);
  }
};
</script>