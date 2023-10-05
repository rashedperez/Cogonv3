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
console.log($("#added_resident_success"))

// Add Resident Notification
   if($("#added_resident_success").length > 0)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Successfully Added New Resident'
      })
}
else if ($("#added_resident_failed").length > 0)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Unsuccessful Added New Resident'
      })
}

// Update Resident Notification
if($("#update_resident_success").length > 0)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Successfully Updated Resident'
      })
}
else if ($("#update_resident_failed").length > 0)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      })
      
      Toast.fire({
        icon: 'danger',
        title: 'Unsuccessful'
      })
}

// Delete Resident Notification
if($("#delete_resident_success").length > 0)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Successfully Deleted Resident'
      })
}
else if ($("#delete_resident_failed").length > 0)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Success to Delete Resident'
      })
}
