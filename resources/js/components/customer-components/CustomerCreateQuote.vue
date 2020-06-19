<template>
  <fragment>
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
              <h4 class="card-title m-t-10">{{customer.name}}</h4>
              <h6 class="card-subtitle">
                <div class="badge badge-pill badge-success font-16" v-if="customer.status == true">
                  <span class="ti-user text-success"></span>
                  Active
                </div>

                <div
                  class="badge badge-pill badge-success font-16"
                  v-else-if="customer.status == false"
                >
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
            <small class="text-muted">E-mail</small>
            <h6>{{customer.email}}</h6>
            <small class="text-muted p-t-30 db">Phone</small>
            <h6>{{customer.phone}}</h6>
            <small class="text-muted p-t-30 db">Address</small>
            <h6>{{customer.address}}</h6>
          </div>
          <div class="card-body row">
            <div class="col-12">
              <p
                class="font-s"
              >Registration Date: {{moment(customer.created_at).format('YYYY-MM-DD')}}</p>
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
                to="/customer"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
              >
                <i class="fas fa-rupee-sign fa-sm"></i> Invoices
              </router-link>
              <router-link
                to="/customer/quote"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
              >
                <i class="fas fa-scroll fa-sm"></i> Quotes
              </router-link>

              <router-link
                to="/customer/track/shipment"
                aria-current="page"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
              >
                <i class="fas fa-truck fa-sm"></i> Track Shipment
              </router-link>

              <router-link
                to="/customer/quote/create"
                aria-current="page"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"
              >
                <i class="fas fa-sticky-note fa-sm"></i> Request Quote
              </router-link>
            </div>
          </div>
          <div class="container">
            <h4 class="mb-3">Quotation Form</h4>
            <div id="loader" style="display:none"></div>
            <div id="msgholder"></div>
            <form
              class="form-horizontal form-material"
              @submit.prevent="onSubmit"
              @keydown="form.errors.clear()"
            >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for>Date</label>
                    <input
                      type="text"
                      class="form-control"
                      name="password"
                      :value="moment(new Date).format('DD/MM/YYYY')"
                      placeholder="Date"
                      disabled
                    />
                  </div>
                </div>
              </div>

              <h6 class="mb-2 mt-2">Quotation Details</h6>

              <div>
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    <div class="col-sm-12">
                      <table
                        class="table dataTable table-responsive-sm"
                        id="dataTable"
                        width="100%"
                        cellspacing="0"
                        role="grid"
                        aria-describedby="dataTable_info"
                        style="width: 100%;"
                      >
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Description</th>

                            <th scope="col">Size</th>
                            <th scope="col">Weight</th>
                            <th scope="col">ETA</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Advance</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tr v-for="(quotation,index) in form.quotations" :key="index">
                          <td>{{index+1}}</td>
                          <td>{{quotation.from}}</td>
                          <td>{{quotation.to}}</td>
                          <td>{{quotation.description}}</td>
                          <td>{{quotation.size}}</td>
                          <td>{{quotation.weight}}</td>
                          <td>{{quotation.eta}}</td>
                          <td>{{quotation.rate}}</td>
                          <td>{{quotation.advance}}</td>
                          <td @click="deleteQuotation(quotation.uid)">
                            <i class="fas fa-times text-danger"></i>
                          </td>
                        </tr>
                        <tbody>
                          <button
                            type="button"
                            class="btn btn-primary mt-3"
                            data-toggle="modal"
                            data-target="#quotation"
                          >Add</button>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <button
                    class="btn btn-outline-primary btn-confirmation"
                    @click.prevent="onSubmit"
                  >
                    Save
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
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- quotation -->
    <div
      class="modal fade"
      id="quotation"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Quotation Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Serial Number">From</label>
                  <input type="text" class="form-control" v-model="from" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="docket">To</label>
                  <input type="text" class="form-control" v-model="to" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    v-model="description"
                  ></textarea>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="Serial Number">Size</label>
                  <input type="text" class="form-control" v-model="size" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="docket">Weight</label>
                  <input type="text" class="form-control" v-model="weight" />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="addQuotation"
              data-dismiss="modal"
            >Add</button>
          </div>
        </div>
      </div>
    </div>
  </fragment>
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
      from: "",
      to: "",
      description: "",
      size: "",
      weight: "",
      eta: "",
      rate: "",
      advance: "",
      form: new Form({
        customer_id: this.$store.getters.getUserData.user.id,
        quotations: []
      })
    };
  },
  methods: {
    addQuotation() {
      this.form.quotations.push({
        uid: uuidv4(),
        from: this.from,
        to: this.to,
        description: this.description,
        size: this.size,
        weight: this.weight,
        eta: this.eta,
        rate: this.rate,
        advance: this.advance
      });

      // reset

      this.from = "";
      this.to = "";
      this.description = "";
      this.size = "";
      this.weight = "";
      this.eta = "";
      this.rate = "";
      this.advance = "";
    },
    onSubmit() {
      this.form
        .submit("post", "/api/quotations")
        .then(response => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Well done! Quote has been created",
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
    },
    deleteQuotation(uid) {
      let i = this.form.quotations.map(item => item.uid).indexOf(uid); // find index of your object
      this.form.quotations.splice(i, 1); // remove it from array
    }
  },

  computed: {
    customer() {
      return new Form(this.$store.getters.getSingleCustomer);
    }
  },
  created() {
    this.$store.dispatch(
      "retrieveSingleCustomer",
      this.$store.getters.getUserData.user.id
    );
  }
};
</script>