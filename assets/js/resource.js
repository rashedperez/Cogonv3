$('#resourceinfo').on('show.bs.modal', event => {
    // Get Data
    const button = event.relatedTarget;  
    const data = JSON.parse(button.getAttribute('data-data'));
    const modal = $(event.currentTarget);

    // Update Content
    modal.find('#type').text(data.type.charAt(0).toUpperCase() + data.type.slice(1));
    modal.find('#name').text(data.name);
    modal.find('#price') .text(data.price);
    modal.find('#per') .text(data.measurement);
    modal.find('#quantity').text(data.quantity);
    modal.find('#description').text(data.description ? data.description : 'None');
});

$('#updateresourcemodal').on('show.bs.modal', event => {
  // Get Data
  const button = event.relatedTarget;  
  const data = JSON.parse(button.getAttribute('data-data'));
  const modal = $(event.currentTarget);

  // Update Content
  modal.find('#type').val(data.type);
  modal.find('#name').val(data.name);
  modal.find('#per') .val(data.measurement);
  modal.find('#price').val(data.price);
  modal.find('#quantity').val(data.quantity);
  modal.find('#description').val(data.description);
  modal.find('#id').val(data.id);
});
  