<!--Begin Reservation Info Modal-->
<div class="modal fade" id="reservationinfo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
            <div class="col-4">Type of Resources</div>
            <div class="col-4 text-center">Resources</div>
            <div class="col-4 text-center">Quantity</div>
          </div>
          <div class="row" style="font-weight: 400">
            <div class="col-4">Facility</div>
            <div class="col-4 text-center">Baby are you down down down</div>
            <div class="col-4 text-center">1</div>
          </div>
          <div class="row" style="font-weight: 400">
            <div class="col-4">Saging</div>
            <div class="col-4 text-center">Bababa baba nana</div>
            <div class="col-4 text-center">1</div>
          </div>
          <div class="row" style="font-weight: 400">
            <div class="col-4">Turon</div>
            <div class="col-4 text-center">Bababa baba nana</div>
            <div class="col-4 text-center">1</div>
          </div>
        </div>
        <button type="button" class="btn text-white float-right" data-dismiss="modal" style="background-color: #495057">Close</button>
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
        <p class="text-muted text-center">Clicking "confirm payment" means the resident has paid, confirming the reservation</p>
        <form method="POST" class="d-flex justify-content-center">
          <button type="button" class="btn btn-pay text-white" style="background-color: #495057">Confirm Payment</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END Reservation Payment Modal-->