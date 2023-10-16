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
  data.resources.map(resource => {
    resources_container.append(`
      <div class="row" style="font-weight: 400">
        <div class="col-4 text-capitalize">` + resource.data.type + `</div>
        <div class="col-4 text-center">` + resource.data.name + `</div>
        <div class="col-4 text-center">` + resource.quantity + `</div>
      </div>
    `);
  });
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