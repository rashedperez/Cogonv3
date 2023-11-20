$('#updateusermodal').on('show.bs.modal', event => {
    // Get Data
    const button = event.relatedTarget;  
    const data = JSON.parse(button.getAttribute('data-data'));
    const modal = $(event.currentTarget);

    // Show badang
    modal.find('.badang, .modal-body').toggle();

    setTimeout(() => modal.find('.badang, .modal-body').toggle(), 200);

    // Update Content
    modal.find('[href="#resetpasswordmodal"]').attr('data-id', data.id).attr('data-name', data.full_name);
    modal.find('#role').val(data.role);
    modal.find('#full_name').val(data.full_name);
    modal.find('#username').val(data.name);
    modal.find('#status').prop('checked', data.status == 'active');
    $('[name="id"]').val(data.id);

    // Check ug Admin ba
    if (data.role == 'admin') {
      modal.find('#status').closest('label').hide();
    }
    else {
      modal.find('#status').closest('label').show();
    }
});

// Bantay mugawas ang reset password
$('#resetpasswordmodal').on('show.bs.modal', ({ currentTarget, relatedTarget }) => {

  // Tago ang nigawas
  $('.modal.show').modal('hide');

  // Update Display
  $(currentTarget).find('h2 span').text($(relatedTarget).data('name'));

}).on('hide.bs.modal', ({ currentTarget }) => $(currentTarget).find('#id').val(''));

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