$('#reservationinfo').on('show.bs.modal', event => {
  // Get Data
  const button = event.relatedTarget;
  const data = JSON.parse(button.getAttribute('data-data'));
  const modal = $(event.currentTarget);console.log(data)

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