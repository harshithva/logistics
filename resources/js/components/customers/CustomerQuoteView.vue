<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col"></div>
      <div class="col">
        <a class="btn btn-primary text-white" onclick="javascript:window.print()">
          <i class="fas fa-print"></i> Print
        </a>
        <button class="btn btn-secondary ml-2">
          <i class="fas fa-download" @click="downloadPDF"></i> Download
        </button>
        <a href class="btn btn-info ml-2">
          <i class="fas fa-envelope"></i> Mail
        </a>
        <a href class="btn btn-danger ml-2">
          <i class="fas fa-times"></i> Decline
        </a>
        <a href class="btn btn-success ml-2">
          <i class="fas fa-check"></i> Approve
        </a>
      </div>
    </div>
    <div class="card" ref="content">
      <div class="card-body">
        <div class="row mt-2">
          <div class="col">
            <img :src="logo" />
          </div>
          <div class="col"></div>
          <div class="col">
            <p>
              GURUKAL LOGISTICS
              <br />Anchepalya, Bangalore - 560073
              <br />Mob: +91-9342244267 /
              +91-9663222686
              <br />E-mail : logistics@gurukal.co.in
              <br />Website: www.gurukal.co.in
              <br />
            </p>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col">
            <p>Ref No: BNG/001/2020-21</p>
          </div>
          <div class="col"></div>
          <div class="col">Date: 02/06/2020</div>
        </div>

        <div class="row mt-2">
          <div class="col text-center">
            <h5>
              <u>For Transit</u>
            </h5>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p>
              To,
              <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vinyas
              <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VAwebsites Managalore
              <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;India - 574154
              <br />
            </p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col text-center">
            <h6>Sub: Transit Quote for</h6>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <p>
              Dear Sir,
              <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As per our discussion regarding transportation requirement for the consignment to
            </p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col text-center">
            <h5>
              <u>Quotation</u>
            </h5>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <table class="table-bordered table">
              <thead>
                <th scope="col">SL</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Description</th>
                <th scope="col">Size(Feet)&#38; Weight</th>
                <th scope="col">ETA</th>
                <th scope="col">Rate</th>
                <th scope="col">Advance</th>
              </thead>
              <tr>
                <th scope="row">1</th>
                <td>Vinyas</td>
                <td>customer1</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et neque, similique adipisci provident hic cum recusandae saepe? Doloremque, ullam dolorem quae repudiandae id modi unde tempore explicabo odio sequi dolor.</td>
                <td>5kg</td>
                <td>5 days</td>
                <td>500</td>
                <td>100</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <h6>Terms & Conditions</h6>
            <ol>
              <li>Rates quoted above are valid for 48Hrs only.</li>
              <li>Extra charges will be implied If the consignment exceeds the limit of fleet dimension.</li>
              <li>Advance payment is to be made (unless stated above, in which case you shall pay the quoted price).</li>
              <li>if the unloading time exceeds 8Hrs halting will be charged on pro rate basis.</li>
              <li>Payments are to be made within 7 days from the date of invoice.</li>
            </ol>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <p>
              Bank Details
              <br />Name : Axis Bank
              <br />8th Mile Branch
              <br />A/c No.: 918020030455515
              <br />IFSC: UTIB0002926
              <br />
            </p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <p>
              For and behalf of
              <br />

              <u>Gurukal Logistics</u>
            </p>
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>

<script>
import jsPDF from "jspdf";
import domtoimage from "dom-to-image";
export default {
  data() {
    return {
      logo: "https://gurukal.co.in/wp-content/uploads/2020/02/guru1-1.png"
    };
  },
  methods: {
    downloadPdf() {
      alert("hi");
      /** WITH CSS */
      domtoimage
        .toPng(this.$refs.content)
        .then(function(dataUrl) {
          var img = new Image();
          img.src = dataUrl;
          const doc = new jsPDF({
            orientation: "portrait",
            // unit: "pt",
            format: [900, 1400]
          });
          doc.addImage(img, "JPEG", 20, 20);
          const date = new Date();
          const filename =
            "timechart_" +
            date.getFullYear() +
            ("0" + (date.getMonth() + 1)).slice(-2) +
            ("0" + date.getDate()).slice(-2) +
            ("0" + date.getHours()).slice(-2) +
            ("0" + date.getMinutes()).slice(-2) +
            ("0" + date.getSeconds()).slice(-2) +
            ".pdf";
          doc.save(filename);
        })
        .catch(function(error) {
          console.error("oops, something went wrong!", error);
        });
    }
  }
};
</script>