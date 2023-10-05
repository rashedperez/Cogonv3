$('#amenityinfo').on('show.bs.modal',event  => {
  const button = event.relatedTarget;  
  const data = JSON.parse(button.getAttribute('data-data'));
    const amenityNameInfo = $('#amenityinfo #name')
    const amenityPriceInfo = $('#amenityinfo #price') 
    const amenityQuantityInfo = $('#amenityinfo #quantity')
    const amenityDescriptionInfo = $('#amenityinfo #description')

    amenityNameInfo.text(data.name);
    amenityPriceInfo.text(data.price);
    amenityQuantityInfo.text(data.quantity);
    amenityDescriptionInfo.text(data.description);
 });

 $('#updateamenitymodal').on('show.bs.modal',event  => {
  const button = event.relatedTarget;  
  const data = JSON.parse(button.getAttribute('data-data')); console.log(data)
    const amenityNameUpdate = $('#updateamenitymodal #name');
    const amenityPriceUpdate = $('#updateamenitymodal #price');
    const amenityQuantityUpdate = $('#updateamenitymodal #quantity');
    const amenityDescriptionUpdate = $('#updateamenitymodal #description');
    const amenityIdUpdate = $('#updateamenitymodal #id');


    amenityNameUpdate.val(data.name);
    amenityPriceUpdate.val(data.price);
    amenityQuantityUpdate.val(data.quantity);
    amenityDescriptionUpdate.val(data.description);
    amenityIdUpdate.val(data.id);
 });
console.log($("#added_amenity_success"))

// Add amenity Notification
 if($("#added_amenity_success").length > 0)
{
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
    })
    
    Toast.fire({
      icon: 'success',
      title: 'Successfully Added New amenity'
    })
}
else if ($("#added_amenity_failed").length > 0)
{
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
    })
    
    Toast.fire({
      icon: 'success',
      title: 'Unsuccessful Added New amenity'
    })
}

// Update amenity Notification
if($("#update_amenity_success").length > 0)
{
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
    })
    
    Toast.fire({
      icon: 'success',
      title: 'Successfully Updated amenity'
    })
}
else if ($("#update_amenity_failed").length > 0)
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

// Delete amenity Notification
if($("#delete_amenity_success").length > 0)
{
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
    })
    
    Toast.fire({
      icon: 'success',
      title: 'Successfully Deleted amenity'
    })
}
else if ($("#delete_amenity_failed").length > 0)
{
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
    })
    
    Toast.fire({
      icon: 'success',
      title: 'Success to Delete amenity'
    })
}

if($("#added_amenity_success").length > 0)
{
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Successfully Added New amenity'
  })
}
else if ($("#added_amenity_failed").length > 0)
{
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Unsuccessful Added New amenity'
  })
}

// Update amenity Notification
if($("#update_amenity_success").length > 0)
{
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Successfully Updated amenity'
  })
}
else if ($("#update_amenity_failed").length > 0)
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

// Delete amenity Notification
if($("#delete_amenity_success").length > 0)
{
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Successfully Deleted amenity'
  })
}
else if ($("#delete_amenity_failed").length > 0)
{
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Success to Delete amenity'
  })
}

