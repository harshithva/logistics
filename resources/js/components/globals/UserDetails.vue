<template>
  <div class="card">
    <div class="card-body">
      <center class="m-t-30">
        <img
          src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png"
          class="rounded-circle"
          width="100"
        />
        <h4 class="card-title m-t-10">{{ user.name }}</h4>
        <h6 class="card-subtitle">
          <div
            class="badge badge-pill badge-success font-16"
            v-if="user.status == true"
          >
            <span class="ti-user text-success"></span>
            Active
          </div>

          <div
            class="badge badge-pill badge-success font-16"
            v-else-if="user.status == false"
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
      <h6>{{ user.email }}</h6>
      <small class="text-muted p-t-30 db">Phone</small>
      <h6>{{ user.phone }}</h6>
      <small class="text-muted p-t-30 db">Address</small>
      <h6>{{ user.address }}</h6>
    </div>
    <div class="card-body row">
      <div class="col-12">
        <p class="font-s">
          Registration Date:
          {{ moment(user.created_at).format("YYYY-MM-DD") }}
        </p>
        <p></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
};
</script>