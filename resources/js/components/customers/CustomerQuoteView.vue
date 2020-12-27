<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-6"></div>
      <div class="col-6">
        <a
          class="btn btn-primary text-white"
          onclick="javascript:window.print()"
        >
          <i class="fas fa-print"></i> Print
        </a>

        <button @click="sendQuoteLink" class="btn btn-info ml-2">
          <i class="fas fa-envelope"></i> Mail
        </button>
        <button
          href
          class="btn btn-danger ml-2"
          @click.prevent="updateStatus('decline')"
          v-show="!quote.status"
        >
          <i class="fas fa-times"></i> Decline
        </button>
        <button
          class="btn btn-success ml-2"
          @click.prevent="updateStatus('approve')"
          v-show="!quote.status"
        >
          <i class="fas fa-check"></i> Approve
        </button>
        <router-link
          :to="'/admin/quotes/' + quote.id + '/edit'"
          class="btn btn-warning ml-2"
          v-if="this.$store.getters.getUserData.user.role == 'admin'"
        >
          <i class="fas fa-edit"></i> Edit
        </router-link>
      </div>
    </div>
    <Quote v-if="quote" :quote="quote"></Quote>
  </fragment>
</template>

<script>
export default {
  data() {
    return {
      showUpdation: true,
    };
  },
  methods: {
    updateStatus(status) {
      if (status == "approve") {
        axios
          .post(`/api/quotations/${this.quote.id}/status/approve`)
          .then((response) => {
            this.$store.dispatch(
              "retrieveSingleQuote",
              this.$route.params.quote_id
            );
            this.showUpdation = false;
          })
          .catch(function (error) {
            console.log("Something went wrong");
          });
      } else if (status == "decline") {
        axios
          .post(`/api/quotations/${this.quote.id}/status/decline`)
          .then((response) => {
            this.$store.dispatch(
              "retrieveSingleQuote",
              this.$route.params.quote_id
            );
            this.showUpdation = false;
          })
          .catch(function (error) {
            console.log("Something went wrong");
          });
      }
    },
    sendQuoteLink() {
      axios
        .post(`api/quotations/${this.quote.id}/quote_send_email`)
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Quote has sent through mail",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Make sure customer email is valid.",
          });
        });
    },
  },
  computed: {
    quote() {
      return new Form(this.$store.getters.getSingleQuote);
    },
  },
  created() {
    this.$store.dispatch("retrieveSingleQuote", this.$route.params.quote_id);
  },
};
</script>