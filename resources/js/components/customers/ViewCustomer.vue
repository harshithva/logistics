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
            <h4 class="card-title m-t-10">vinyas poojary</h4>
            <h6 class="card-subtitle">
              <div class="badge badge-pill badge-success font-16">
                <span class="ti-user text-success"></span> Active
              </div>
            </h6>
          </center>
        </div>
        <div>
          <hr />
        </div>
        <div class="card-body">
          <small class="text-muted">E-mail</small>
          <h6>harshith11032001@gmail.com</h6>
          <small class="text-muted p-t-30 db">Phone</small>
          <h6>91 7975503096</h6>
          <small class="text-muted p-t-30 db">Address</small>
          <h6>india, MANGALORE, 574154, MULKI, SHAMA SADANA SHIMANTHUR PANJINADKA POST</h6>
        </div>
        <div class="card-body row text-center">
          <div class="col-6 border-right">
            <h6>2020-05-29 09:02:39</h6>
            <span>Registration Date</span>
          </div>
          <div class="col-6">
            <h6>2020-05-29 11:27:07</h6>
            <span>Last Login</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <a
              href="/admin/customers/1"
              aria-current="page"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2 router-link-exact-active router-link-active"
            >
              <i class="fas fa-edit fa-sm"></i> Edit
            </a>
            <a
              href="/admin/customers/1/invoice"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"
            >
              <i class="fas fa-rupee-sign fa-sm"></i> Invoices
            </a>
            <a
              href="/admin/customers/1/quotes"
              class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2 mr-2"
            >
              <i class="fas fa-scroll fa-sm"></i> Quotes
            </a>
          </div>
          <div id="loader" style="display:none"></div>
          <div id="msgholder"></div>
          <form class="form-horizontal form-material" id="admin_form" method="post">
            <section>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="password" placeholder="Password" />
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
                    <input type="text" class="form-control" name="fname" placeholder="Company Name" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="gst" placeholder="GST No" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="email" class="form-control" name="phone" placeholder="Email" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      name="phone"
                      placeholder="Primary Phone"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control"
                      name="phone"
                      placeholder="Secondary Phone"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                  Update Customer
                  <span>
                    <i class="icon-ok"></i>
                  </span>
                </button>
                <button
                  class="btn btn-outline-danger btn-confirmation"
                  name="dosubmit"
                  type="submit"
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