<template>
  <fragment>
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
      class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm mr-2"
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
    <router-link
      v-if="customer.show_rates ? true:false"
      to="/customer/price_list"
      aria-current="page"
      class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm ml-2"
    >
      <i class="fas fa-sticky-note fa-sm"></i> Estimate
    </router-link>
  </fragment>
</template>

<script>
export default {
  computed: {
    customer() {
      return new Form(this.$store.getters.getCustomerInvoices);
    },
  },
  created() {
    this.$store.dispatch(
      "retrieveCustomerInvoice",
      this.$store.getters.getUserData.user.id
    );
  },
};
</script>