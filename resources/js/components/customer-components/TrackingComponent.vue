<template>
  <fragment>
    <div class="row">
      <div class="col">
        <form class="form-inline" @submit.prevent="trackShipment">
          <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2" class="sr-only">Tracking Number</label>
            <input
              type="text"
              class="form-control"
              id="inputPassword2"
              placeholder="Tracking Number"
              v-model="tracking_no"
            />
          </div>
          <button type="submit" class="btn btn-primary mb-2">Track</button>
        </form>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-sm-12">
        <table
          class="table table-bordered dataTable"
          id="dataTable"
          width="100%"
          cellspacing="0"
          role="grid"
          aria-describedby="dataTable_info"
          style="width: 100%;"
        >
          <thead>
            <tr role="row">
              <th
                class="sorting"
                tabindex="0"
                aria-controls="dataTable"
                rowspan="1"
                colspan="1"
                aria-label="Position: activate to sort column ascending"
                style="width: 40px;"
              >Date</th>
              <th
                class="sorting"
                tabindex="0"
                aria-controls="dataTable"
                rowspan="1"
                colspan="1"
                aria-label="Office: activate to sort column ascending"
                style="width: 50px;"
              >Status</th>
              <th
                class="sorting"
                tabindex="0"
                aria-controls="dataTable"
                rowspan="1"
                colspan="1"
                aria-label="Office: activate to sort column ascending"
                style="width: 50px;"
              >Location</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th rowspan="1" colspan="1">Date</th>
              <th rowspan="1" colspan="1">Status</th>
              <th rowspan="1" colspan="1">Location</th>
            </tr>
          </tfoot>
          <tbody>
            <tr
              v-if="tracking_details"
              v-for="shipment in tracking_details.track"
              :key="shipment.id"
            >
              <td>{{moment( shipment.created_at).format("DD/M/YYYY")}}</td>
              <td>
                <span
                  class="badge badge-primary"
                  v-if="shipment.status == 'Awaiting Pickup'"
                >Awaiting Pickup</span>
                <span
                  class="badge badge-success"
                  v-else-if="shipment.status == 'Delivered'"
                >Delivered</span>
                <span
                  class="badge badge-warning"
                  v-else-if="shipment.status == 'Dispatched'"
                >Dispatched</span>
                <span class="badge badge-info" v-else>Intransit</span>
              </td>
              <td v-if="shipment.location">{{shipment.location}}</td>
              <td v-else>{{shipment.location}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </fragment>
</template>

<script>
export default {
  data() {
    return {
      tracking_no: ""
    };
  },
  methods: {
    async trackShipment() {
      if (this.tracking_no) {
        await this.$store.dispatch("TrackShipment", this.tracking_no);
      }
    }
  },
  computed: {
    tracking_details() {
      return this.$store.getters.getTrackingDetails;
    }
  }
};
</script>