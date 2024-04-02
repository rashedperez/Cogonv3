  $('#updateresidentmodal').on('show.bs.modal',event  => {
    const button = event.relatedTarget;  
    const data = JSON.parse(button.getAttribute('data-data')); console.log(data)
      const residentNameUpdate = $('#updateresidentmodal #name');
      const residentAddressUpdate = $('#updateresidentmodal #address');
      const residentContactnumUpdate = $('#updateresidentmodal #contact_num');
      const residentIdUpdate = $('#updateresidentmodal #id');

  
      residentNameUpdate.val(data.name);
      residentAddressUpdate.val(data.address);
      residentContactnumUpdate.val(data.contact_num);
      residentIdUpdate.val(data.id);
   });

// Bantay nay mosubmit nga form
$('form').on('submit', (e) => {

  // Dili isubmit
  e.preventDefault();

  let number_input, phone;
  
  try {
    number_input = $(e.target).find('[name="contact_num"]');
    phone = libphonenumber.parsePhoneNumber(number_input.val(), 'PH');
  
    // Check ug valid ba ang phone
    if (!phone.isValid()) {
      throw new Error();
    }
  }
  catch (error) {

    // Prompt Error
    window.notyf.open({
      type: 'error',
      message: 'Invalid mobile number',
      duration: 3000,
      position: {
        x: 'center',
        y: 'top'
      }
    });

    return false;
  }

  // Assign ang contact number sa sakto nga format
  number_input.val(phone.number);

  // Disable ang nagsubmit
  const submitter = $(e.originalEvent.submitter).prop('disabled', true);

  // Get form data
  $.ajax({
    url: e.target.action,
    method: 'POST',
    dataType: 'json',
    data: $(e.target).serialize(),
    success: async ({ status, message, username, password, redirect }) => {
      
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

      // Password
      if (username && password) {
        await Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          allowOutsideClick: false,
          showCloseButton: true
        }).fire({
          icon: 'success',
          title: `
            <b>Username</b><br/>
            ${ username }<br/>
            <b>Password</b><br/>
            ${ password }
          `
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