<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xlg-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <div id="loader" style="display: none"></div>
            <div id="msgholder"></div>
            <form
              class="form-horizontal form-material"
              @submit.prevent="onSubmit"
              @keydown="form.errors.clear()"
            >
              <!-- show errors -->

              <DisplayError :form="form"></DisplayError>
              <!-- end errors -->
              <section>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
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
                        v-model="form.phone"
                        placeholder="Phone"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for>Select Role</label>
                    <div class="form-group">
                      <select
                        v-model="form.role"
                        class="custom-select"
                        :class="{
                          'border border-danger': form.errors.has('role'),
                        }"
                      >
                        <option selected disabled>Roles</option>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                        <!-- <option value="driver">Driver</option> -->
                        <option value="customer">Customer</option>
                        <option value="vendor">Vendor</option>
                      </select>
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
                        :class="{
                          'border border-danger': form.errors.has('user_notes'),
                        }"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </section>
              <div class="form-group">
                <div class="col-sm-12">
                  <button
                    class="btn btn-outline-primary"
                    type="submit"
                    :disabled="form.errors.any()"
                  >
                    Add Staff
                    <span>
                      <i class="icon-ok"></i>
                    </span>
                  </button>
                  <router-link to="/admin" class="btn btn-outline-secondary">
                    <span>
                      <i class="ti-share-alt"></i>
                    </span>
                    Return to the dashboard
                  </router-link>
                </div>
              </div>
            </form>
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
        phone: "",
        role: "employee",
        user_notes: "",
      }),
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("post", "/api/staffs")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Staff Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((error) =>
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          })
        );
    },
  },
};
</script>