<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-2"></div>
      <div class="col-2">
        <span class="badge badge-pill badge-success" v-if="quote.sent">
          Sent</span
        >
        <span class="badge badge-pill badge-warning" v-else>Drafted</span>
      </div>
      <div class="col">
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

        <button
          class="btn btn-secondary ml-2"
          @click.prevent="changeType"
          v-if="this.type === 'QUOTATION'"
        >
          <i class="fas fa-scroll"></i> Proforma Invoice
        </button>

        <button
          class="btn btn-secondary ml-2"
          @click.prevent="changeType"
          v-else
        >
          <i class="fas fa-scroll"></i> Quotation
        </button>
      </div>
    </div>
    <Quote v-if="quote" :quote="quote" :type="type"></Quote>
  </fragment>
</template>

<script>
export default {
  data() {
    return {
      showUpdation: true,
      type: "QUOTATION",
    };
  },
  methods: {
    updateSentStatus() {
      axios
        .post(`api/quotations/${this.quote.id}/update_sent_status`)
        .then((response) => {
          this.$store.dispatch(
            "retrieveSingleQuote",
            this.$route.params.quote_id
          );
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Quote has been marked sent",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "Mark sure internet connection is stable",
          });
        });
    },
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
    changeType() {
      this.type === "QUOTATION"
        ? (this.type = "PROFORMA INVOICE")
        : (this.type = "QUOTATION");
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