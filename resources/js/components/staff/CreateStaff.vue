<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xlg-12 col-md-12">
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade show active"
              id="previous-month"
              role="tabpanel"
              aria-labelledby="pills-setting-tab"
            >
              <div class="card-body">
                <div id="loader" style="display:none"></div>
                <div id="msgholder"></div>
                <form class="form-horizontal form-material" id="admin_form" method="post">
                  <section>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="username"
                            placeholder="Username"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="password"
                            placeholder="Password"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="fname" placeholder="Name" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="fname"
                            placeholder="Designation"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="gst" placeholder="Phone" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="email" class="form-control" name="phone" placeholder="Email" />
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="code_phone"
                            list="browsers6"
                            autocomplete="off"
                            required="required"
                            placeholder="Staff Role"
                          />
                          <datalist id="browsers6">
                            <option value="admin" selected disabled>Roles</option>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                            <option value="driver">Driver</option>
                            <option value="user">User</option>
                          </datalist>
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
                          ></textarea>
                        </div>
                      </div>
                    </div>
                  </section>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <button
                        class="btn btn-outline-primary btn-confirmation"
                        name="dosubmit"
                        type="submit"
                      >
                        Add Staff
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
  </div>
</template>