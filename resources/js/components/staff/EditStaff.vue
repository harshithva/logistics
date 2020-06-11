<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xlg-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <div id="loader" style="display:none"></div>
            <div id="msgholder"></div>
            <form class="form-horizontal form-material">
              <section>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Email</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.email"
                        placeholder="Email"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Phone</label>
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
                    <div class="form-group">
                      <label for>Name</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.name"
                        placeholder="Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Role</label>
                      <select v-model="form.role" class="custom-select">
                        <option selected disabled>Roles</option>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                        <!-- <option value="driver">Driver</option> -->
                        <option value="customer">Customer</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>User Notes</label>
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
                  <button class="btn btn-outline-primary" type="submit" @click.prevent="onSubmit">
                    Update Staff
                    <span>
                      <i class="icon-ok"></i>
                    </span>
                  </button>
                  <router-link to="/admin" class="btn btn-outline-secondary">
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
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    onSubmit() {
      axios
        .patch(`/api/staffs/${this.form.id}`, this.form)
        .then(response => {
          this.$store.dispatch(
            "retrieveSingleStaff",
            this.$route.params.staff_id
          );

          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Staff has been updated",
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
  },
  computed: {
    form() {
      return this.$store.getters.getSingleStaff;
    }
  },
  created() {
    this.$store.dispatch("retrieveSingleStaff", this.$route.params.staff_id);
  }
};
</script>

