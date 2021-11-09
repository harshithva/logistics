<template>
  <fragment>
    <div class="row">
      <div class="input-group m-2">
        <select
          class="custom-select"
          id="inputGroupSelect04"
          aria-label="Example select with button addon"
          v-model="status.status"
        >
          <option disabled>Shipment Status</option>
          <option value="Awaiting Pickup">Awaiting Pickup</option>
          <option value="Dispatched">Dispatched</option>
          <option value="Intransit">Intransit</option>
          <option value="Delivered">Delivered</option>
        </select>
      </div>


    
        <div class="col-12" v-if="status.status != 'Awaiting Pickup'">
          <div class="form-group">
            <input
                          type="text"
                          class="form-control"
                          v-model="pincode"
                          @change="fetchAddress"
                          placeholder="Enter pincode to fetch address automatically"
                        />
          </div>
        </div>

       <div class="col-12" v-if="status.status != 'Awaiting Pickup'">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              v-model="status.location"
              placeholder="Location"
            />
          </div>
        </div>

      <div v-if="status.status == 'Delivered'">
        <div class="row m-1">
          <div class="col-md-6">
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                placeholder="Receiver Name"
                v-model="status.receiver_name"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Phone" v-model="status.phone" />
            </div>
          </div>
        </div>

        <div class="row m-1 d-print-none">
          <div class="col">
            <b-form-file v-model="status.document" ref="file-input" class="mb-2"></b-form-file>
          </div>
          <div class="col">
            <b-button @click="clearFiles" class="mr-2">Reset</b-button>
          </div>
        </div>
      </div>

      <div v-else-if="status.status == 'Awaiting Pickup'" class="d-print-none"></div>


    </div>
    <div class="row">
      <div class="col">
        <button
          type="button"
          class="btn btn-primary"
          @click.prevent="updateStatus"
          data-dismiss="modal"
        >Update</button>
      </div>
    </div>
  </fragment>
</template>

<script>
export default {
  props: ["sender_id", "shipment_id"],
  data() {
    return {
      pincode:"",
      status: new Form({
        status: "Awaiting Pickup",
        customer_id: "",
        shipment_id: "",
        location: "",
        receiver_name: "",
        phone: "",
        document: null,
      }),
    };
  },
  methods: {
    updateStatus() {
      this.status.shipment_id = this.shipment_id;
      this.status.customer_id = this.sender_id;
      this.status
        .submit("post", "api/shipments/" + this.shipment_id + "/status")
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Shipment Status Updated",
            showConfirmButton: false,
            timer: 1500,
          });

          this.$store.dispatch("retrieveShipments");
          this.$store.dispatch(
            "retrieveShipmentStatus",
            this.$route.params.invoice_id
          );
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        });
    },
     fetchAddress(){
      let test = this;
      if(this.pincode){
         var options = {
          method: 'POST',
          url: 'https://pincode.p.rapidapi.com/',
          headers: {
            'content-type': 'application/json',
            'x-rapidapi-host': 'pincode.p.rapidapi.com',
            'x-rapidapi-key': '566be8cd40msh03fd69b630e243ep1f78aajsnb216caf55e2b'
          },
          data: {searchBy: 'pincode', value: this.pincode}
        };

        axios.request(options).then(function (response) {
          if(response.data.length > 0){
            console.log(response.data)
            test.status.location = `${response.data[0].taluk}, ${response.data[0].district}, ${response.data[0].circle} - ${response.data[0].pin}`;
          }

    }).catch(function (error) {
      console.error(error);
    });

      }

    }
  },
};
</script>