<template>
  <fragment>
    <div class="row mt-3 mb-3 ml-3 d-print-none">
      <div class="col-3">
        <p>
          Delivery Status :
          <span class="badge badge-pill badge-primary">Dispatched</span>
        </p>
        <p>Balance Amount : 5415</p>
      </div>
      <div class="col-9">
        <a class="btn btn-primary text-white" onclick="javascript:window.print()">
          <i class="fas fa-print"></i> Print
        </a>
        <button class="btn btn-secondary ml-2">
          <i class="fas fa-download" @click="downloadPDF"></i> Download
        </button>
        <a href class="btn btn-info ml-2">
          <i class="fas fa-envelope"></i> Mail
        </a>
        <a href class="btn btn-warning ml-2">
          <i class="fas fa-envelope"></i> Status
        </a>
        <a href class="btn btn-outline-success ml-2">
          <i class="fas fa-envelope"></i> Add Payment
        </a>
        <a href class="btn btn-danger ml-2">
          <i class="fas fa-times"></i> Decline
        </a>
        <a href class="btn btn-success ml-2">
          <i class="fas fa-check"></i> Approve
        </a>
        <a href class="btn btn-dark ml-2">
          <i class="fas fa-check"></i> Edit
        </a>
      </div>
    </div>
    <div class="card" ref="content">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <p>GST No: 29AYGPS3509N2Q</p>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <img :src="logo" />
          </div>
          <div class="col"></div>
          <div class="col">
            <p>
              Payment Status :
              <span class="badge badge-pill badge-warning">Partial</span>
            </p>
            <h6>FREIGHT INVOICE</h6>
          </div>
        </div>
        <div class="row mt-4">
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
          <div class="col"></div>
          <div class="col">
            <p>Date of Invoice</p>
            <p>Invoice No.</p>
            <p>Transaction Type</p>
            <p>
              <span class="badge badge-pill badge-success">Full Load</span>
            </p>
          </div>
        </div>
        <hr />
        <div class="row mt-2">
          <div class="col">
            <p>BILL TO</p>
          </div>

          <div class="col">Consignor Name</div>
        </div>

        <div class="row mt-2">
          <div class="col"></div>
          <div class="col">
            Consignor GST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Address
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col"></div>
          <div class="col">
            <p>Consignee Name</p>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col"></div>
          <div class="col">
            Consignee GST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Consignee Address
          </div>
        </div>
        <br />

        <div class="row mt-2">
          <div class="col">
            <table class="table-bordered table">
              <thead>
                <th scope="col">SL No.</th>
                <th scope="col">Description</th>
                <th scope="col">Serial No.</th>
                <th scope="col">Docket No.</th>
              </thead>
              <tr>
                <th scope="row">1</th>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et neque, similique adipisci provident hic cum recusandae saepe? Doloremque, ullam dolorem quae repudiandae id modi unde tempore explicabo odio sequi dolor.</td>
                <td>Gl4551</td>
                <td>DN45415</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-5">
            <table class="table-bordered table">
              <tr>
                <th scope="row">Advance Paid</th>
                <td>500</td>
              </tr>
              <tr>
                <th scope="row">Balance Amount</th>
                <td>500</td>
              </tr>
            </table>
          </div>
          <div class="col">
            <table class="table-bordered table">
              <!-- <thead>
                <th scope="col" colspan="4" class="text-center">Amount</th>
              </thead>-->
              <tr>
                <th scope="row">Transportation</th>
                <td>500</td>
                <th scope="row">Others</th>
                <td>500</td>
              </tr>

              <tr>
                <th scope="row">Insurance</th>
                <td>500</td>
                <th scope="row">CGST</th>
                <td>500</td>
              </tr>

              <tr>
                <th scope="row">Cartage</th>
                <td>500</td>
                <th scope="row">SGST</th>
                <td>500</td>
              </tr>

              <tr>
                <th scope="row">Handling</th>
                <td>500</td>
                <th scope="row">IGST</th>
                <td>500</td>
              </tr>
              <tr>
                <th scope="row">Halting</th>
                <td>500</td>
                <th>Total</th>
                <td>1545</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <h6>Terms & Conditions</h6>
            <ol>
              <li>Remittance of payment within 7 days of invoice receipt.</li>
              <li>A 10 % charge will be applied for each day of late payment.</li>
              <li>GST Payable by Freight Bearer</li>
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
          <div class="col-6"></div>
          <div class="col">
            <p>
              For and behalf of
              <br />
              <br />
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
  }
};
</script>