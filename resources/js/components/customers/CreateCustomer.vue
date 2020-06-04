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
              >
                <!-- customer created alert -->
                <b-alert
                  :show="dismissCountDown"
                  variant="success"
                  dismissible
                  fade
                  @dismissed="dismissCountDown=0"
                  @dismiss-count-down="countDownChanged"
                >
                  Well! You just created a customer
                  <p>This alert will dismiss after {{ dismissCountDown }} seconds...</p>
                  <b-progress
                    variant="success"
                    :max="dismissSecs"
                    :value="dismissCountDown"
                    height="4px"
                  ></b-progress>
                </b-alert>

                <!--error -->
                <b-alert
                  :show="dismissErrorCountDown"
                  variant="danger"
                  dismissible
                  fade
                  @dismissed="dismissErrorCountDown=0"
                  @dismiss-count-down="countDownChanged"
                  v-if="errors.length>0"
                  v-text="errors.get('message')"
                >
                  <p>This alert will dismiss after {{ dismissErrorCountDown }} seconds...</p>
                  <b-progress
                    variant="success"
                    :max="dismissSecs"
                    :value="dismissCountDown"
                    height="4px"
                  ></b-progress>
                </b-alert>

                <section>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          v-model="form.email"
                          placeholder="Email"
                          required
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
                          required
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
                          required
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="form.company_name"
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
                          rows="6"
                          placeholder="User Notes - For internal use only."
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </section>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-primary">
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
      form: {
        name: "",
        email: "",
        password: "",
        company_name: "",
        gst: "",
        phone: "",
        address: "",
        user_notes: ""
      },

      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      dismissErrorCountDown: 0
    };
  },
  methods: {
    onSubmit() {
      this.$store.dispatch("createCustomer", this.form);
      if (this.errors.length < 0) {
        this.dismissCountDown = 10;
        this.form.name = "";
        this.form.email = "";
        this.form.password = "";
        this.form.company_name = "";
        this.form.gst = "";
        this.form.phone = "";
        this.form.address = "";
        this.form.user_notes = "";
      } else {
        this.dismissErrorCountDown = 10;
      }
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    }
  },
  computed: {
    errors() {
      return this.$store.getters.getAllErrors;
    }
  }
};
</script>