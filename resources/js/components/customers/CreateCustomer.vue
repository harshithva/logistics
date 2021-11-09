<template>

        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="card-body">
              <div id="loader" style="display: none"></div>
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
                  @dismissed="dismissCountDown = 0"
                  @dismiss-count-down="countDownChanged"
                  >Well Done! You just created a customer</b-alert
                >

                <!-- show errors -->

                <b-alert
                  v-if="form.errors.has('email')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("email") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('password')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("password") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('name')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("name") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('company_name')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("company_name") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('gst')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("gst") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('phone')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("phone") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('address')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("address") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('user_notes')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("user_notes") }}</b-alert
                >

                <b-alert
                  v-if="form.errors.has('show_rates')"
                  dismissible
                  show
                  variant="danger"
                  >{{ form.errors.get("show_rates") }}</b-alert
                >
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
                          :class="{
                            'border border-danger': form.errors.has('email'),
                          }"
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
                          :class="{
                            'border border-danger': form.errors.has('password'),
                          }"
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
                          :class="{
                            'border border-danger': form.errors.has('name'),
                          }"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="form.company_name"
                          :class="{
                            'border border-danger': form.errors.has(
                              'company_name'
                            ),
                          }"
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
                          :class="{
                            'border border-danger': form.errors.has('gst'),
                          }"
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
                          :class="{
                            'border border-danger': form.errors.has('phone'),
                          }"
                          placeholder="Phone Number"
                        />
                      </div>
                    </div>
                  </div>

<hr>  

  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="pincode"
                          @change="fetchAddress"
                          placeholder="Enter pincode to fetch address automatically"
                        />
                      </div>
                    </div>
                    </div>

                  <div class="row">
                 
                    <div class="col-md-6">
                      <div class="form-group">
                        <!-- <label for="exampleFormControlTextarea1">Address</label> -->
                        <textarea
                          v-model="form.address"
                          class="form-control"
                          id="exampleFormControlTextarea1"
                            placeholder="Address"
                          rows="3"
                          :class="{
                            'border border-danger': form.errors.has('address'),
                          }"
                        ></textarea>
                      </div>
                    </div>
             
                    <div class="col-md-6">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          v-model="form.user_notes"
                          :class="{
                            'border border-danger': form.errors.has(
                              'user_notes'
                            ),
                          }"
                          rows="3"
                          placeholder="User Notes - For internal use only."
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
                      type="submit"
                      class="btn btn-primary"
                      :disabled="form.errors.any()"
                    >
                      Add Customer
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
                <input name="locker" type="hidden" value="274218" />
              </form>
            </div>
          </div>
        </div>

</template>

<script>
export default {
  data() {
    return {
      pincode:"",
      form: new Form({
        name: "",
        email: "",
        password: "",
        company_name: "",
        gst: "",
        phone: "",
        address: "",
        user_notes: "",
        show_rates: false,
      }),
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  methods: {
    onSubmit() {
      let timerInterval;
      Swal.fire({
        title: "Customer being created!",
        html: "I will close in <b></b> milliseconds.",
        timer: 4000,
        timerProgressBar: true,
        onBeforeOpen: () => {
          Swal.showLoading();

          this.form
            .submit("post", "/api/customers")
            .then((response) => {
              clearInterval(timerInterval);
              this.dismissCountDown = 10;
              this.$store.dispatch("retrieveCustomers");
              this.$store.dispatch("RETRIEVE_ALL_VENDORS");
            })
            .catch(clearInterval(timerInterval));
        },
        onClose: () => {
          clearInterval(timerInterval);
        },
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
    },
    fetchAddress(){
      let test = this;
      if(this.pincode){
         var options = {
          method: 'POST',
          url: 'https://pincode.p.rapidapi.com/',
          headers: {
            'content-type': 'application/json',
            'x-rapidapi-host': 'pincode.p.rapidapi.com',
            'x-rapidapi-key': '566be8cd40msh03fd69b630e243ep1f78aajsnb216caf55e2b'
          },
          data: {searchBy: 'pincode', value: this.pincode}
        };

        axios.request(options).then(function (response) {
          if(response.data.length > 0){
            console.log(response.data)
            test.form.address = `${response.data[0].taluk}, ${response.data[0].district}, ${response.data[0].circle} - ${response.data[0].pin}`;
          }

    }).catch(function (error) {
      console.error(error);
    });

      }

    }
  },
};
</script>