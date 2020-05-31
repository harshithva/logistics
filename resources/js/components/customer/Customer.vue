<template>
  <div class="conatiner-fluid">
    <table class="table">
      <thead class="bg-primary text-white">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Location</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <th scope="row">1</th>
          <td>{{customer.name}}</td>
          <td>{{customer.email}}</td>
          <td>{{customer.phone}}</td>
          <td>{{customer.city}}</td>
          <td>Delete</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      customers: []
    };
  },
  mounted() {
    console.log("HELLO");

    axios
      .get("http://127.0.0.1:8000/api/customers")
      .then(response => (this.customers = response.data.data))
      .catch(function(error) {
        // handle error
        console.log(error);
      });
  }
};
</script>