<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xlg-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <div id="loader" style="display:none"></div>
            <div id="msgholder"></div>
            <form
              class="form-horizontal form-material"
              @submit.prevent="onSubmit"
              @keydown="form.errors.clear()"
            >
              <!-- show errors -->

              <b-alert
                v-if="form.errors.has('email')"
                dismissible
                show
                variant="danger"
              >{{form.errors.get('email')}}</b-alert>
              <b-alert
                v-if="form.errors.has('role')"
                dismissible
                show
                variant="danger"
              >{{form.errors.get('role')}}</b-alert>

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
                v-if="form.errors.has('phone')"
                dismissible
                show
                variant="danger"
              >{{form.errors.get('phone')}}</b-alert>

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
                        type="text"
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
                        :class="{'border border-danger': form.errors.has('role')}"
                      >
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
                      <textarea
                        class="form-control"
                        v-model="form.user_notes"
                        rows="6"
                        placeholder="User Notes - For internal use only."
                        :class="{'border border-danger': form.errors.has('user_notes')}"
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
  computed: {
    data() {
      return this.$store.getters.getSingleStaff;
    },
    staff() {
      return new Form(this.data);
    }
  },
  created() {
    this.$store.dispatch("retrieveSingleStaff", this.$route.params.staff_id);
  }
};
</script>

