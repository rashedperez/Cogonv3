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
  const is_vehicle = data.measurement == 'kilometer';

  // Update Content
  modal.find('#type').val(data.type);
  modal.find('#name').val(data.name);
  modal.find('#per') .val(data.measurement);
  modal.find('.price-label').text(is_vehicle ? 'Fuel fee' : 'Price');
  modal.find('#price').val(data.price);
  modal.find('.rental-fee').closest('div').css('display', is_vehicle ? 'block' : 'none');
  modal.find('#quantity').val(data.quantity);
  modal.find('#description').val(data.description);
  modal.find('#id').val(data.id);
});

// Bantay sa per
$('select[name="per"]').change(({ currentTarget }) => {

  // Kwaon ang modal
  const modal = $(currentTarget).closest('.modal');

  const is_vehicle = currentTarget.value == 'kilometer';

  modal.find('.price-label').text(is_vehicle ? 'Fuel fee' : 'Price');
  modal.find('.rental-fee').prop('required', is_vehicle ? true : false).closest('div').css('display', is_vehicle ? 'block' : 'none');
});

// Bantay nay mosubmit nga form
$('form').on('submit', (e) => {

  // Dili isubmit
  e.preventDefault();

  // Disable ang nagsubmit
  const submitter = $(e.originalEvent.submitter).prop('disabled', true);

  // Get form data
  $.ajax({
    url: e.target.action,
    method: 'POST',
    dataType: 'json',
    data: $(e.target).serialize(),
    success: ({ status, message, redirect }) => {
      
      // Show message if there is
      if (message) {
        Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
        }).fire({
          icon: message.type,
          title: message.message
        });
      }

      // Check if status is ok and redirect
      if (status && status == true) {
        window.location.replace(redirect);

        return true;
      }

      // Enable ang gasubmit
      submitter.prop('disabled', false);
    },
    error: () => {
      // Show error
			Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
			}).fire({
				icon: 'error',
				title: 'Something went wrong. Please try again later'
			});

      // Enable ang gasubmit
      submitter.prop('disabled', false);
    }
  });


  // Dili isubmit
  return false;
});