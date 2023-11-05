$('#reservationinfo').on('show.bs.modal', event => {
  // Get Data
  const button = event.relatedTarget;
  const data = JSON.parse(button.getAttribute('data-data'));
  const modal = $(event.currentTarget);

  // Update Content
  modal.find('#id').text(data.formatted_id);
  modal.find('#date_reservation').text(moment(data.date_reservation).format('MMMM D, YYYY'));
  modal.find('#reserver').text(data.reserver);
  modal.find('#date_reserved').text(moment(data.date_reservation).format('MMMM D, YYYY - h:m A'));
  
  // Container of resources
  const resources_container = modal.find('.resources');

  // Empty
  resources_container.find('.row').not('.label').remove();

  // Add to container
  const subtotals = data.resources.map(resource => {

    const subtotal = resource.data.price * resource.quantity;

    resources_container.append(`
      <div class="row border-top border-bottom py-3">
        <div class="col-3 text-capitalize">` + resource.data.type + `</div>
        <div class="col-3 text-center">` + resource.data.name + `</div>
        <div class="col-3 text-center">` + resource.formatted_quantity + `</div>
        <div class="col-3 text-right">₱` + subtotal.toLocaleString(undefined, { minimumFractionDigits: 2 }) + `</div>
        <div class="col-12">
          <small class="mb-0"><span style="font-weight: 600">Purpose: </span>` + (resource.purpose ? resource.purpose : 'Not specified') + `</small>
        </div>
      </div>
    `);

    return subtotal;
  });

  // Update total and reference
  modal.find('.total span').text((subtotals.reduce((acc, total) => total + acc, 0)).toLocaleString(undefined, { minimumFractionDigits: 2 }));
  modal.find('.reference span').text(data.reference_number);
});

$('#reservation-payment').on('show.bs.modal', event => {
  // Get Data
  const button = event.relatedTarget;
  const data = JSON.parse(button.getAttribute('data-data'));
  const modal = $(event.currentTarget);

  // Update Content
  modal.find('#id').text(data.formatted_id);
  modal.find('#date_reservation').text(moment(data.date_reservation).format('MMMM D, YYYY'));
  modal.find('#reserver').text(data.reserver);
  modal.find('#date_reserved').text(moment(data.date_reservation).format('MMMM D, YYYY - h:m A'));
  modal.find('form').attr('action', 'pay/' + data.id);

  // Container of resources
  const resources_container = modal.find('.resources');

  // Empty
  resources_container.find('.row').not('.label').remove();

  // Add to container
  const subtotal_array = data.resources.map(resource => {
    const subtotal = parseFloat(resource.data.price * resource.quantity);
    resources_container.append(`
      <div class="row" style="font-weight: 400">
        <div class="col-3 text-capitalize">` + resource.data.type + `</div>
        <div class="col-3 text-center">` + resource.data.name + `</div>
        <div class="col-3 text-center">` + resource.quantity + `</div>
        <div class="col-3 text-right">₱` + subtotal.toLocaleString(undefined, { minimumFractionDigits: 2 }) + `</div>
      </div>
    `);

    return subtotal;
  });

  // Display Total Amount
  resources_container.append(`
    <div class="row fw-bold d-flex justify-content-end mt-3">
      <div class="col-3 text-center">Total Amount</div>
      <div class="col-3 text-right total">₱` + (subtotal_array.reduce((total, current) => total + current, 0)).toLocaleString(undefined, { minimumFractionDigits: 2 })  + `</div>
    </div>
  `);
});

// Bantay pisliton ang cancel
$('.btn-cancel').click(({ currentTarget }) => {
  // Show confirmation
  Swal.fire({
    title: 'Are you sure you want to cancel this reservation?',
    text: 'This action cannot be undone',
    showDenyButton: true,
    confirmButtonText: 'Proceed',
    confirmButtonColor: '#E03444',
    denyButtonText: 'Close',
    denyButtonColor: '#495057',
    reverseButtons: true
  }).then((result) => {
      
    // Confirmed
    if (result.isConfirmed) {
        
        // Delete
        window.location = '../reservation/cancel/' + $(currentTarget).data('data');
    }
  });
});

// Bantay iclick ang print
$('.print').click(({ currentTarget }) => {

  // Open info
  $(currentTarget).closest('ul').find('[data-target="#reservationinfo"]').trigger('click');

  // Print after modal has shown
  setTimeout(() => {
    const print_content = document.querySelector('.modal.show .modal-content').innerHTML;
    const original_content = document.body.innerHTML;

    document.body.innerHTML = print_content;
    window.print();
    document.body.innerHTML = original_content;
  }, 500);
});