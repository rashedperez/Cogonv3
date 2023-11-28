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

    const subtotal = parseFloat(resource.data.price) * parseFloat(resource.quantity);
    const has_driver = !Number.isInteger(resource.driver) && parseFloat(resource.has_driver);
    const extras = (resource.rental_fee ? parseFloat(resource.rental_fee) : 0) + (!has_driver ? parseFloat(resource.driver ? resource.driver : 0) : 0);

    resources_container.append(`
      <div class="row border-top border-bottom py-3">
        <div class="col-3 text-capitalize">` + resource.data.type + `</div>
        <div class="col-3 text-center">` + resource.data.name + ` ${has_driver ? `<br/><small class="text-muted">(Driver: ${resource.driver})</small>` : ``}</div>
        <div class="col-3 text-center">` + resource.formatted_quantity + `</div>
        <div class="col-3 text-right">₱` + subtotal.toLocaleString(undefined, { minimumFractionDigits: 2 }) + `</div>
        <div class="col-12">
          <small class="mb-0"><span style="font-weight: 600">Purpose: </span>` + (resource.purpose ? resource.purpose : 'Not specified') + `</small>
          ` + (resource.purpose == 'Burial' ? `<br/> <small> <span style="font-weight: 600">Name of deceased:</span> ${resource.purpose_specific} </small>` : 
              (resource.purpose == 'Others' ? `<br/> <small> <span style="font-weight: 600"> Specific Reason:</span> ${resource.purpose_specific} </small>` : ``)) + `
        </div>
      </div>
    `);

    return {
      main: subtotal + extras,
      extras: extras
    };
  });

  const extras = subtotals.reduce((acc, total) => total.extras + acc, 0);

  // Toggle additional
  if (extras > 0) {
    modal.find('.additional').show();
  }
  else {
    modal.find('.additional').hide();
  }

  // Update total and reference
  modal.find('.additional span').text((extras).toLocaleString(undefined, { minimumFractionDigits: 2 }));
  modal.find('.total span').text((subtotals.reduce((acc, total) => total.main + acc, 0)).toLocaleString(undefined, { minimumFractionDigits: 2 }));
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
    
    const subtotal = parseFloat(resource.data.price) * parseFloat(resource.quantity);
    const has_driver = !Number.isInteger(resource.driver) && parseFloat(resource.has_driver);
    const extras = (resource.rental_fee ? parseFloat(resource.rental_fee) : 0) + (!has_driver ? parseFloat(resource.driver ? resource.driver : 0) : 0);
    
    resources_container.append(`
      <div class="row" style="font-weight: 400">
        <div class="col-3 text-capitalize">` + resource.data.type + `</div>
        <div class="col-3 text-center">` + resource.data.name + `</div>
        <div class="col-3 text-center">` + resource.extent + `</div>
        <div class="col-3 text-right">₱` + subtotal.toLocaleString(undefined, { minimumFractionDigits: 2 }) + `</div>
      </div>
    `);

    return {
      main: subtotal + extras,
      extras: extras
    };
  });console.log(subtotal_array)

  const extras = subtotal_array.reduce((total, current) => total + current.extras, 0);

  // Iapil ang additioner bayranan ug naa
  if (extras > 0) {
    resources_container.append(`
      <div class="row d-flex justify-content-end w-100 mt-1">
        <div class="col-12">
          <small>Additional Fees: <span class="ml-1">₱${extras.toLocaleString(undefined, { minimumFractionDigits: 2 })}</span></small>
        </div>
      </div>
    `);
  }

  // Display Total Amount
  resources_container.append(`
    <div class="row fw-bold d-flex justify-content-end mt-3">
      <div class="col-3 text-center">Total Amount</div>
      <div class="col-3 text-right total">₱` + (subtotal_array.reduce((total, current) => total + current.main, 0)).toLocaleString(undefined, { minimumFractionDigits: 2 })  + `</div>
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
    confirmButtonColor: '#4BBF73',
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

// Bantay iclick ang return
$('.btn-return').click(( { currentTarget }) => {
  // Show confirmation
  Swal.fire({
    title: 'Are you sure you want to return this reservation\'s resources?',
    text: 'Proceed to return',
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
        window.location = '../reservation/return/' + $(currentTarget).data('data');
    }
  });
});