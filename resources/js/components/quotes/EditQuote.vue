<template>
  <fragment>
    <div>
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-3">Edit Quote</h4>
              <div id="loader" style="display: none"></div>
              <div id="msgholder"></div>
              <form
                class="form-horizontal form-material"
                @submit.prevent="onSubmit"
                @keydown="form.errors.clear()"
              >
                <DisplayError :form="form"></DisplayError>
                <section>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for>Select Customer</label>
                        <v-select
                          :options="customers"
                          label="name"
                          @input="selectCustomer($event)"
                          :value="quote.customer.name"
                        ></v-select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for>Date</label>
                        <input
                          type="text"
                          class="form-control"
                          name="password"
                          :value="moment(quote.created_at).format('DD/MM/YYYY')"
                          placeholder="Date"
                          disabled
                        />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for>Change Status</label>
                        <select class="custom-select" v-model="quote.status">
                          <option value="approved">Approved</option>
                          <option value="declined">Declined</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for>Quotation no</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Quotation no"
                          v-model="quote.quotation_no"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-8 mb-2">
                      <b-form-textarea
                        id="textarea"
                        v-model="quote.remarks"
                        placeholder="Remarks"
                        rows="3"
                        max-rows="6"
                      ></b-form-textarea>
                    </div>
                  </div>
                  <h6 class="mb-2 mt-2">Quotation Details</h6>

                  <div>
                    <div
                      id="dataTable_wrapper"
                      class="dataTables_wrapper dt-bootstrap4"
                    >
                      <div class="row">
                        <div class="col-sm-12">
                          <table
                            class="table dataTable table-responsive-sm"
                            id="dataTable"
                            width="100%"
                            cellspacing="0"
                            role="grid"
                            aria-describedby="dataTable_info"
                            style="width: 100%"
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
                            <tr
                              v-for="(quotation, index) in quote.list"
                              :key="index"
                            >
                              <td>{{ index + 1 }}</td>
                              <td>{{ quotation.from }}</td>
                              <td>{{ quotation.to }}</td>
                              <td>{{ quotation.description }}</td>
                              <td>{{ quotation.size }}</td>
                              <td>{{ quotation.weight }}</td>
                              <td>{{ quotation.eta }}</td>
                              <td>{{ quotation.rate }}</td>
                              <td>{{ quotation.advance }}</td>
                              <td @click="deleteQuotation(quotation.id)">
                                <i class="fas fa-times text-danger"></i>
                              </td>
                            </tr>
                            <tbody>
                              <button
                                type="button"
                                class="btn btn-primary mt-3"
                                data-toggle="modal"
                                data-target="#quotation"
                              >
                                Add
                              </button>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

                <div class="form-group">
                  <div class="col-sm-12">
                    <button
                      class="btn btn-outline-primary btn-confirmation"
                      @click.prevent="onSubmit"
                    >
                      Update
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
            <h5 class="modal-title" id="exampleModalLabel">
              Add Quotation Details
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
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
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Size">ETA</label>
                  <input type="text" class="form-control" v-model="eta" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="docket">Rate</label>
                  <input type="number" class="form-control" v-model="rate" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="advance">Advance</label>
                  <input type="number" class="form-control" v-model="advance" />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="addQuotation"
              data-dismiss="modal"
            >
              Add
            </button>
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>

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
    };
  },
  methods: {
    selectCustomer(e) {
      this.quote.customer_id = e.id;
    },
    addQuotation() {
      this.quote.list.push({
        uid: uuidv4(),
        from: this.from,
        to: this.to,
        description: this.description,
        size: this.size,
        weight: this.weight,
        eta: this.eta,
        rate: this.rate,
        advance: this.advance,
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
      if (this.quote.list.length > 0) {
        const customer_id = this.quote.customer_id;
        this.quote
          .submit("patch", `/api/quotations/${customer_id}`)
          .then((response) => {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Well done! Quote has been Updated",
              showConfirmButton: false,
              timer: 1500,
            });
            this.$router.push(
              `/admin/customers/${customer_id}/quotes/${response.id}/view`
            );
          })
          .catch((error) =>
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
            })
          );
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Add Package!",
        });
      }
    },
    deleteQuotation(id) {
      let i = this.quote.list.map((item) => item.id).indexOf(id); // find index of your object

      this.quote.list.splice(i, 1); // remove it from array
    },
  },
  computed: {
    customers() {
      return this.$store.getters.getAllCustomers;
    },
    data() {
      return this.$store.getters.getSingleQuote;
    },
    quote() {
      return new Form(this.data);
    },
  },
  created() {
    this.$store.dispatch("retrieveCustomers");

    this.$store.dispatch("retrieveSingleQuote", this.$route.params.quote_id);
  },
};
</script>