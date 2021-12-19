<template>
  <b-form
    @submit.prevent="onSubmit"
    @reset="onReset"
    @keydown="form.errors.clear()"
  >
    <DisplayError :form="form"></DisplayError>
    <b-form-group id="input-group-1" label="Name">
      <b-form-input
        v-model="form.name"
        placeholder="name"
        type="text"
      ></b-form-input>
    </b-form-group>
    <b-form-group id="input-group-1" label="Email">
      <b-form-input
        v-model="form.email"
        placeholder="email"
        type="text"
      ></b-form-input>
    </b-form-group>
 
        <div class="row">
            <div class="col">
                   <b-form-group id="input-group-1" label="Type">
                      <select v-model="form.type" lass="form-select">
           <option value="Hot Lead">Hot Lead</option>
            <option value="Warm Lead">Warm Lead</option>
            <option value="Cold Lead">Cold Lead</option>
             </select>
    </b-form-group>
     
            </div>

            <div class="col">
     <b-form-group id="input-group-1" label="Forecast close">
    
 <select v-model="form.forecast_close" lass="form-select">
               <option value="January" selected>January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April ">April </option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July ">July </option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November" >November</option>
            <option value="December" >December</option>
      </select>

    </b-form-group>
    </div>
        </div>


    <div class="row">
        <div class="col">
             <b-form-group id="input-group-1" label="Contact">
      <b-form-input
        v-model="form.contact"
        placeholder="contact"
        type="text"
      ></b-form-input>
    </b-form-group>
        </div>
        <div class="col">
              <b-form-group id="input-group-1" label="Source">
      <b-form-input
        v-model="form.source"
        placeholder="source"
        type="text"
      ></b-form-input>
    </b-form-group>
        </div>
    </div>
    
   <div class="row">
       <div class="col">
     <b-form-group id="input-group-1" label="region">
      <b-form-input
        v-model="form.region"
        placeholder="region"
        type="text"
      ></b-form-input>
    </b-form-group>
       </div>
       <div class="col">
     <b-form-group id="input-group-1" label="country">
      <b-form-input
        v-model="form.country"
        placeholder="country"
        type="text"
      ></b-form-input>
    </b-form-group>
       </div>
   </div>

<div class="row">
    <div class="col">
     <b-form-group id="input-group-1" label="Potential Opportunity">
      <b-form-input
        v-model="form.potential_opportunity"
        placeholder="Potential Opportunity"
        type="number"
      ></b-form-input>
    </b-form-group>
    </div>
    <div class="col">
     <b-form-group id="input-group-1" label="Chance of Sale">
      <b-form-input
        v-model="form.chance_of_sale"
        placeholder="Chance of Sale"
        type="number"
      ></b-form-input>
    </b-form-group>
    </div>
</div>



<div class="row">
    
    <div class="col">

     <b-form-group id="input-group-1" label="Weighted forecast">
      <b-form-input
        v-model="form.weighted_forecast"
        placeholder="Weighted forecast"
        type="number"
      ></b-form-input>
    </b-form-group>
    </div>
</div>

  <h6 class="mt-4 mb-2">Query Form</h6>
<div class="row mb-2">

  <div class="col">
         <b-form-group >
      <b-form-input
        v-model="form.name_company_individual"
        placeholder="Name (Company/Individual)"
        type="text"
      ></b-form-input>
    </b-form-group>
  </div>
</div>
<div class="row mb-2">
  <div class="col">
         <b-form-group>
      <b-form-input
        v-model="form.pickup_pincode"
        placeholder="Pickup Pincode"
        type="text"
      ></b-form-input>
    </b-form-group>
  </div>
  <div class="col">
         <b-form-group>
      <b-form-input
        v-model="form.delivery_pincode"
        placeholder="Delivery Pincode"
        type="text"
      ></b-form-input>
    </b-form-group>
  </div>
</div>

<div class="row mb-2">
  <div class="col">
      <b-form-textarea
      id="textarea"
      v-model="form.consignment_description"
      placeholder="Consignment description"
      rows="3"
      max-rows="6"
    ></b-form-textarea>
  </div>
</div>

<div class="row mb-2">
  <div class="col">
             <b-form-group>
      <b-form-input
        v-model="form.weight"
        placeholder="Weight"
        type="text"
      ></b-form-input>
    </b-form-group>
  </div>
  <div class="col">
             <b-form-group>
      <b-form-input
        v-model="form.dimension"
        placeholder="Dimension/Truck Size"
        type="text"
      ></b-form-input>
    </b-form-group>
  </div>
</div>

    <b-button type="submit" variant="primary">Submit</b-button>
    <b-button type="reset" variant="danger">Reset</b-button>
  </b-form>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      form: new Form({
        email:"",
        name:"",
        type:"",
        contact:"",
        source:"",
        region:"",
        country:"India",
        potential_opportunity:0,
        chance_of_sale:0,
        forecast_close:"",
        weighted_forecast:0,
        name_company_individual:"",
             pickup_pincode:"",
            delivery_pincode:"",
            consignment_description:"",
            weight:"",
            dimension:"",

      }),
    };
  },
  methods: {
    onSubmit() {
      this.form
        .submit("post", "/api/leads")
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Successfully created",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$store.dispatch("RETRIEVE_LEADS");
        })
        .catch();
    },
    onReset(evt) {
      evt.preventDefault();
      this.form.customer_id = "";
      this.form.duration = "";
    },
    // selectCustomer(e) {
    //   this.form.customer_id = e.id;
    // },
  },
  created() {
    // this.$store.dispatch("retrieveCustomers");
  },
//   computed: {
//     ...mapGetters({
//       customers: "getLead",
//     }),
//   },
};
</script>