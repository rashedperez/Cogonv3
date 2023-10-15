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
  data.resources.map(resource => {
    const total_amount = (resource.data.price * resource.quantity).toLocaleString(undefined, { minimumFractionDigits: 2 });
    resources_container.append(`
      <div class="row" style="font-weight: 400">
        <div class="col-3 text-capitalize">` + resource.data.type + `</div>
        <div class="col-3 text-center">` + resource.data.name + `</div>
        <div class="col-3 text-center">` + resource.quantity + `</div>
        <div class="col-3 text-right">₱` + total_amount + `</div>
      </div>
    `);
  });
});