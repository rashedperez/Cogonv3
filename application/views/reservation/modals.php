<!--Begin Reservation Info Modal-->
<div class="modal fade" id="reservationinfo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered to-print" role="document">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h3 class="modal-title mx-auto">Reservation Information</h3>
      </div>
      <div class="modal-body m-3 py-0 font-weight-bold">
        <div class="border-top border-bottom py-3">
          <div class="d-flex justify-content-between">
            <p class="mb-0"><b>Reservation ID:</b><span id="id" class="ml-2" style="font-weight: 400">R00000001</span></p>
            <p class="mb-0"><b>Date of Reservation:</b><span id="date_reservation" class="ml-2" style="font-weight: 400">October 10, 2023</span></p>
          </div>
          <p class="mb-0"><b>Reserver:</b><span id="reserver" class="ml-2" style="font-weight: 400">Romel Macalinao</span></p>
          <p class="mb-0"><b>Reserved Date:</b><span id="date_reserved" class="ml-2" style="font-weight: 400">October 21, 2023 - 8:00 AM</span></p>
        </div>
        <p class="pt-3 mb-3"><b>Reserved Resources</b></p>
        <div class="resources">
          <div class="row border-top border-bottom py-3">
            <div class="col-3">Amenity</div>
            <div class="col-3 text-center">Banana</div>
            <div class="col-3 text-center">x5</div>
            <div class="col-3 text-right">₱500.00</div>
            <div class="col-12">
              <small class="mb-0"><span style="font-weight: 600">Purpose: </span>Potassium K</small>
            </div>
          </div>
          <div class="row border-top border-bottom py-3">
            <div class="col-3">Facility</div>
            <div class="col-3 text-center">Ahem asa na</div>
            <div class="col-3 text-center">x5</div>
            <div class="col-3 text-right">₱500.00</div>
            <div class="col-12">
              <small class="mb-0"><span style="font-weight: 600">Purpose: </span>Ang Turon</small>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end w-100 mt-1">
          <p class="additional">Additional Fees: ₱<span>Oiiii badang chupapi momniyanyo</span></p>
        </div>
        <div class="text-center py-3">
          <h3 class="total mb-0">Total Amount &nbsp; ₱<span>69420.00</span></h3>
        </div>
        <p class="reference mb-0 fw-bold">Reference No.: <span>CRBCP-0000001</span></p>
      </div>
    </div>
  </div>
</div>
<!--END Reservation Info Modal-->

<!--Begin Reservation Payment Modal-->
<div class="modal fade" id="reservation-payment" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body m-3 font-weight-bold">
        <div class="d-flex justify-content-between">
          <p><b>Reservation ID:</b><span id="id" class="ml-2" style="font-weight: 400">R00000001</span></p>
          <p><b>Date of Reservation:</b><span id="date_reservation" class="ml-2" style="font-weight: 400">October 10, 2023</span></p>
        </div>
        <p><b>Reserver:</b><span id="reserver" class="ml-2" style="font-weight: 400">Romel Macalinao</span></p>
        <p><b>Reserved Date:</b><span id="date_reserved" class="ml-2" style="font-weight: 400">October 21, 2023 - 8:00 AM</span></p>
        <p class="mb-1"><b>Reserved Resources</b></p>
        <div class="resources px-5 mb-4">
          <div class="row fw-bold label">
            <div class="col-3">Type of Resources</div>
            <div class="col-3 text-center">Resources</div>
            <div class="col-3 text-center">Quantity</div>
            <div class="col-3 text-right">Amount</div>
          </div>
          <div class="row" style="font-weight: 400">
            <div class="col-3">Facility</div>
            <div class="col-3 text-center">Baby are you down down down</div>
            <div class="col-3 text-center">1</div>
            <div class="col-3 text-right">₱50.00</div>
          </div>
          <div class="row" style="font-weight: 400">
            <div class="col-3">Saging</div>
            <div class="col-3 text-center">Bababa baba nana</div>
            <div class="col-3 text-center">1</div>
            <div class="col-3 text-right">₱50.00</div>
          </div>
          <div class="row" style="font-weight: 400">
            <div class="col-3">Turon</div>
            <div class="col-3 text-center">Bababa baba nana</div>
            <div class="col-3 text-center">1</div>
            <div class="col-3 text-right">₱50.00</div>
          </div>
          <div class="row fw-bold d-flex justify-content-end">
            <div class="col-3 text-center">Total Amount</div>
            <div class="col-3 text-right total">₱<span>Amount</span></div>
          </div>
        </div>
        <?php if ($this->session->userdata('role') != RESIDENT): ?>
        <p class="text-muted text-center">Clicking "confirm payment" means the resident has paid, confirming the reservation</p>
        <form method="POST" class="d-flex justify-content-center">
          <button type="button" class="btn btn-pay text-white" style="background-color: #495057">Confirm Payment</button>
        </form>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>
<!--END Reservation Payment Modal-->