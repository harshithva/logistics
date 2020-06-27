<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xlg-12 col-md-12">
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="card-body">
              <div id="loader" style="display:none"></div>
              <div id="msgholder"></div>
              <form
                class="form-horizontal form-material"
                id="admin_form"
                action="/admin/customers"
                @submit.prevent="onSubmit"
                @keydown="form.errors.clear()"
              >
                <!-- customer created alert -->
                <b-alert
                  :show="dismissCountDown"
                  variant="success"
                  dismissible
                  fade
                  @dismissed="dismissCountDown=0"
                  @dismiss-count-down="countDownChanged"
                >Well Done! You just created a customer</b-alert>

                <!-- show errors -->

                <b-alert
                  v-if="form.errors.has('email')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('email')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('password')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('password')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('name')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('name')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('company_name')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('company_name')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('gst')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('gst')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('phone')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('phone')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('address')"
                  dismissible
                  show
                  variant="danger"
                >{{form.errors.get('address')}}</b-alert>

                <b-alert
                  v-if="form.errors.has('user_notes')"
                  dismissible
                  show
                  variant="danger"
                >{{ form.errors.get('user_notes')}}</b-alert>
                <!-- end errors -->
                <section>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          v-model="form.email"
                          placeholder="Email"
                          :class="{'border border-danger': form.errors.has('email')}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="form.password"
                          placeholder="Password"
                          :class="{'border border-danger': form.errors.has('password')}"
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
                          v-model="form.name"
                          placeholder="Name"
                          :class="{'border border-danger': form.errors.has('name')}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="form.company_name"
                          :class="{'border border-danger': form.errors.has('company_name')}"
                          placeholder="Company Name"
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
                          v-model="form.gst"
                          :class="{'border border-danger': form.errors.has('gst')}"
                          placeholder="GST No"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="form.phone"
                          :class="{'border border-danger': form.errors.has('phone')}"
                          placeholder="Phone Number"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Address</label>
                        <textarea
                          v-model="form.address"
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                          :class="{'border border-danger': form.errors.has('address')}"
                        ></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          v-model="form.user_notes"
                          :class="{'border border-danger': form.errors.has('user_notes')}"
                          rows="6"
                          placeholder="User Notes - For internal use only."
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </section>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" :disabled="form.errors.any()">
                      Add Customer
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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
        company_name: "",
        gst: "",
        phone: "",
        address: "",
        user_notes: ""
      }),

      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false
    };
  },
  methods: {
    onSubmit() {
      let timerInterval;
      Swal.fire({
        title: "Your shipment being created!",
        html: "I will close in <b></b> milliseconds.",
        timer: 4000,
        timerProgressBar: true,
        onBeforeOpen: () => {
          Swal.showLoading();

          this.form
            .submit("post", "/api/customers")
            .then(response => {
              clearInterval(timerInterval);
              this.dismissCountDown = 10;
            })
            .catch(clearInterval(timerInterval));
        },
        onClose: () => {
          clearInterval(timerInterval);
        }
      });

      // this.form
      //   .submit("post", "/api/customers")
      //   .then(response => (this.dismissCountDown = 10))
      //   .catch(error);
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    }
  }
};
</script>