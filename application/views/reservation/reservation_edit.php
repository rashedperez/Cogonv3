<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
            <main class="content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Edit Reservation</h5>
                                <b>Reservation ID<span class="ml-3"><?php echo format_reservation_id($reservation->id); ?></span></b>
                            </div>
                            <b>Date of Reservation: <span class="ml-2"><?php echo date('F j, Y', strtotime($reservation->date_reservation)); ?></span></b>
                        </div>
                        <div class="card-body">
                            <?php echo form_open('reservation/add', [], ['id' => $reservation->id]); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputresident">Resident</label>
                                        <select id="inputresident" class="form-control" name="resident">
                                            <option selected disabled>Choose...</option>
                                            <?php foreach ($residents as $resident): ?>
                                            <option value="<?php echo $resident->id; ?>" <?php echo $resident->id == $reservation->Res_id? 'selected' : ''; ?>><?php echo $resident->name; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress2">Date Reserved</label>
                                        <input type="date" name="date_reserved" class="form-control flatpickr" placeholder="Choose..." value="<?php echo $reservation->date_reserved; ?>"/>
                                    </div>
                                </div>
                                <div class="resources">
                                    <?php foreach ($reservation->resources as $resource): ?>
                                    <div class="resource p-3 mb-3 border rounded">
                                        <div class="w-100 d-flex justify-content-end">
                                            <button type="button" class="btn btn-link remove text-danger partial-hidden p-0"><u>Remove</u></button>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputresident">Type of Reservation</label>
                                                <select class="form-control type" name="type[]">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="<?php echo RESOURCE_FACILITY; ?>" <?php echo $resource->data->type == RESOURCE_FACILITY ? ' selected' : ''; ?>><?php echo ucfirst(RESOURCE_FACILITY); ?></option>
                                                    <option value="<?php echo RESOURCE_AMENITY; ?>" <?php echo $resource->data->type == RESOURCE_AMENITY ? ' selected' : ''; ?>><?php echo ucfirst(RESOURCE_AMENITY); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 partial-hidden">
                                                <label for="inputresident" class="resource-label"><?php echo ucfirst($resource->data->type); ?></label>
                                                <select class="form-control watch-change resource-item" name="resource[]">
                                                    <option disabled>Choose...</option>
                                                    <option value="<?php echo $resource->resource_id; ?>" selected><?php echo $resource->data->name; ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3 partial-hidden">
                                                <label for="inputresident">Quantity</label>
                                                <input type="number" name="quantity[]" class="form-control watch-change quantity" min="0" placeholder="" value="<?php echo $resource->quantity; ?>"/>
                                            </div>
                                            <div class="form-group col-md-6 vehicle-details" <?php echo $resource->data->measurement == KILOMETER ? '' : 'style="display: none"'; ?>>
                                                <label>Rental Fee</label>
                                                <input type="number" name="rental_fee[]" class="form-control watch-change" min="0" placeholder="" value="<?php echo $resource->rental_fee; ?>"/>
                                            </div>
                                            <div class="form-group col-md-6 vehicle-details" <?php echo $resource->data->measurement == KILOMETER ? '' : 'style="display: none"'; ?>>
                                                <label>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="has_driver[]" <?php echo $resource->has_driver ? 'checked' : ''; ?>>
                                                        <label class="form-check-label">I have a driver</label>
                                                    </div>
                                                </label>
                                                <input type="<?php echo $resource->has_driver ? 'text' : 'number'; ?>" class="form-control watch-change" name="driver_name[]" placeholder="<?php echo $resource->has_driver ? 'Enter Driver\'s Name' : 'Driver Service Fee'; ?>" value="<?php echo $resource->driver; ?>"/>
                                            </div>
                                            <div class="form-group col-md-6 partial-hidden">
                                                <label class="purpose-label">Purpose</label>
                                                <select class="form-control" name="purpose[]">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="Religious Activity" <?php echo $resource->purpose == 'Religious Activity' ? 'selected' : ''; ?>>Religious Activity</option>
                                                    <option value="Govt. Activity" <?php echo $resource->purpose == 'Govt. Activity' ? 'selected' : ''; ?>>Govt. Activity</option>
                                                    <option value="Burial" <?php echo $resource->purpose == 'Burial' ? 'selected' : ''; ?>>Burial</option>
                                                    <option value="Others" <?php echo $resource->purpose == 'Others' ? 'selected' : ''; ?>>Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 others" <?php echo in_array($resource->purpose, ['Burial', 'Others']) ? ''  : 'style="display: none"'; ?>>
                                                <label>Name of deceased</label>
                                                <input type="text" name="others[]" class="form-control" value="<?php echo $resource->purpose_specific; ?>"/>
                                            </div>
                                        </div>
                                        <div class="price-div">
                                            <b>Price:</b><span class="price ml-2">₱<span><?php echo number_format(($resource->data->price * $resource->quantity) + ($resource->rental_fee ? (float) $resource->rental_fee : 0) + (!$resource->has_driver ? (float) $resource->driver : 0), 2); ?></span></span>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="w-100">
                                    <button type="button" class="btn btn-primary btn-new">Add New Resource</button>
                                </div>
                                <button type="submit" class="btn btn-success btn-submit float-right">Update</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('application\views\menu\footer.php'); ?>
        </div>
    </div>
    
    <script>
        $(document).ready(() => {

            // Set Flatpickr Instance
            $('.flatpickr').flatpickr({
                enableTime: true,
                altInput: true,
                altFormat: 'F j, Y - h:i K',
                dateFormat: 'Y-m-d H:i:s',
                minDate: 'today'
            });

            // Set SumoSelect Instance
            $('.sumoselect').SumoSelect({
				search: true,
				searchText: 'Search...'
			});

            // All resources
            const resources = <?php echo json_encode($resources); ?>

            // Event Listener for add resource
            $('.btn-new').click((e) => {

                // Include to resources
                $('.resources').append(`
                    <div class="resource p-3 mb-3 border rounded">
                        <div class="w-100 d-flex justify-content-end">
                            <button type="button" class="btn btn-link remove text-danger partial-hidden p-0" style="display: none"><u>Remove</u></button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Type of Reservation</label>
                                <select class="form-control type" name="type[]">
                                    <option selected disabled>Choose...</option>
                                    <option value="<?php echo RESOURCE_FACILITY; ?>"><?php echo ucfirst(RESOURCE_FACILITY); ?></option>
                                    <option value="<?php echo RESOURCE_AMENITY; ?>"><?php echo ucfirst(RESOURCE_AMENITY); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 partial-hidden" style="display: none">
                                <label class="resource-label">Resource</label>
                                <select class="form-control watch-change resource-item" name="resource[]">
                                    <option selected disabled>Choose...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 partial-hidden" style="display: none">
                                <label class="qty-label">Quantity</label>
                                <div class="input-group">
                                    <input type="number" name="quantity[]" class="form-control watch-change quantity" min="0" placeholder="" oninput="validity.valid||(value='')"/>
                                    <button type="button"
                                        class="btn btn-primary btn-map text-white"
                                        data-toggle="offcanvas"
                                        data-target="#map-canvas"
                                        style="display: none"
                                    >
                                        Map
                                    </button>
                                </div>
                            </div>
                            <div class="form-group col-md-6 vehicle-details" style="display: none">
                                <label>Rental Fee</label>
                                <input type="number" name="rental_fee[]" class="form-control watch-change" min="0" placeholder="" oninput="validity.valid||(value='')"/>
                            </div>
                            <div class="form-group col-md-6 vehicle-details" style="display: none">
                                <label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="has_driver[]">
                                        <label class="form-check-label">I have a driver</label>
                                    </div>
                                </label>
                                <input type="number" class="form-control watch-change" name="driver_name[]" min="0" placeholder="Driver Service Fee" oninput="validity.valid||(value='')"/>
                            </div>
                            <div class="form-group col-md-6 partial-hidden" style="display: none">
                                <label class="purpose-label">Purpose</label>
                                <select class="form-control" name="purpose[]">
                                    <option selected disabled>Choose...</option>
                                    <option value="Religious Activity">Religious Activity</option>
                                    <option value="Govt. Activity">Govt. Activity</option>
                                    <option value="Burial">Burial</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 others" style="display: none">
                                <label>Name of deceased</label>
                                <input type="text" name="others[]" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="price-div" style="display: none">
                            <b>Price:</b><span class="price ml-2">₱<span>Price</span></span>
                            <input type="hidden" name="price[]"/>
                        </div>
                    </div>
                `);

                // Reset event listeners
                reset_event_listeners();
            });

            // Event Listener for submit
            $('.btn-submit').click((e) => {

                // Tan awn ug ipasubmit ba
                if (!$(e.currentTarget).attr('data-submit')) {

                    e.preventDefault();
                    e.stopPropagation();

                    // Show confirmation
                    Swal.fire({
                        title: 'Confirm Reservation',
                        text: 'Confirm that the provided information is accurate and requires no changes',
                        showDenyButton: true,
                        confirmButtonText: 'Confirm',
                        confirmButtonColor: '#4bbf73',
                        denyButtonText: 'Cancel',
                        denyButtonColor: '#495057',
                        reverseButtons: true
                    }).then((result) => {
                        
                        // Confirmed
                        if (result.isConfirmed) {
                            
                            // Submit form
                            $(e.currentTarget).attr('data-submit', true).trigger('click');
                        }
                    });
                }
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

            // Reset event listeners
            function reset_event_listeners() {

                // Bantay mausab ang purpose
                $('[name="purpose[]"]').change(({ currentTarget }) => {
                    
                    const resource_element = $(currentTarget).closest('.resource');
                    const show_others = ['Burial', 'Others'].includes(currentTarget.value);

                    // Tan awn if ishow ang uban
                    if (show_others) {
                        resource_element.find('.others').show().find('label').text(currentTarget.value == 'Burial' ? 'Name of deceased' : 'Please specify');
                    }
                    else {
                        resource_element.find('.others').hide().find('input').val('');
                    }
                });

                // Event Listener for type select when changed
                $('.type').unbind('change').change(({ currentTarget }) => {

                    // Show others
                    $(currentTarget).closest('.resource').find('.partial-hidden').show();

                    // Selected type
                    const type_selected = currentTarget.value;

                    // Get all resources with selected type
                    const selected_resource_types = resources.filter(x => x.type == type_selected);

                    // Add to resource select
                    const resource_selected = $(currentTarget).closest('.resource').find('.resource-item').val();

                    // Display all but preselect default
                    $(currentTarget).closest('.resource').find('.resource-item').empty().append(`
                        ` + (selected_resource_types.map(x => `<option value="` + x.id + `" ` + (x.id == resource_selected ? 'selected' : '') + `>` + x.name + `</option>`)) + `
                    `);
                    
                    // Trigger change
                    $(currentTarget).closest('.resource').find('.resource-item').trigger('change');
                });

                // Evnet Listener for Resource Click
                $('.resource-item').unbind('mouseover').mouseover(({ currentTarget }) => {
                    $(currentTarget).closest('.resource').find('.type').trigger('change');
                });

                // Event Listener for resource and quantity change
                $('.watch-change').unbind('change').change(({ currentTarget }) => {

                    const resource_element = $(currentTarget).closest('.resource');                    
                    const price = parseFloat(resources.find(x => x.id == resource_element.find('.resource-item').val()).price);
                    const quantity = parseFloat(resource_element.find('.quantity').val());
                    const rental_fee = resource_element.find('[name="rental_fee[]"]').val();
                    const has_driver = resource_element.find('[name="has_driver[]"]').is(':checked');
                    const driver_fee = parseFloat(resource_element.find('[name="driver_name[]"]').val());

                    // Only update price if there is quantity
                    if (quantity) {

                        // Mga extra bayronon
                        const extras = (rental_fee ? parseFloat(rental_fee) : 0) + (Number.isInteger(driver_fee) && !has_driver ? driver_fee : 0);

                        // Calculate new price with 2 decimal format
                        const new_price = ((price * quantity) + extras).toLocaleString(undefined, { minimumFractionDigits: 2 });

                        // Display to price and show
                        resource_element.find('.price span').text(new_price).closest('.price-div').show();

                        // Update price hidden input
                        resource_element.find('[name="price[]"]').val((price * quantity) + extras);
                    }
                });

                // Bantay iclick ang nay driver
                $('[name="has_driver[]"]').unbind('click').click(({ currentTarget }) => {

                    // Empty driver fee input
                    $(currentTarget).closest('.resource').find('[name="driver_name[]"]').val('');

                    // Trigger change
                    $('.watch-change').trigger('change');
                });

                // Minaw mausab ang resource-item
                $('.resource-item').change(({ currentTarget }) => {

                    // Pangitaon ang gipili nga resource
                    const resource_selected = resources.find(x => x.id == currentTarget.value);
                    const resource_element = $(currentTarget).closest('.resource');

                    // Ipakita ang uban details sa vehicle
                    if (resource_selected.measurement === '<?php echo KILOMETER; ?>') {
                        
                        resource_element.find('.vehicle-details').show();
                        resource_element.find('.btn-map').show();

                        // Bantay mausab ang has driver
                        resource_element.find('[name="has_driver[]"]').unbind('change').change(({ currentTarget }) => {

                            // Tan awn ug gicheckan ba ang naay driver
                            const has_driver = $(currentTarget).is(':checked');

                            // Usbon placeholder
                            resource_element.find('[name="driver_name[]"]').attr('type', has_driver ? 'text' : 'number').attr('placeholder', has_driver ? 'Enter Driver\'s Name' : 'Driver Service Fee')
                        });
                    }
                    else {
                        resource_element.find('.vehicle-details').hide();
                        resource_element.find('.btn-map').hide();
                    }
                    
                    // Update Resource Quantity Label with uppercase first letter
                    if (!resource_element.find('[name="rental_fee[]"]').val()) {
                        resource_element.find('[name="rental_fee[]"]').val(resource_selected.rental_fee);
                    }
                    resource_element.find('.qty-label').text(resource_selected.measurement.charAt(0).toUpperCase() + resource_selected.measurement.slice(1));
                });


                // Event Listener for remove
                $('.remove').unbind('click').click(({ currentTarget }) => {

                    // Show confirmation
                    Swal.fire({
                        text: 'Are you sure you want to remove?',
                        showDenyButton: true,
                        confirmButtonText: 'Remove',
                        denyButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                    
                        // Confirmed
                        if (result.isConfirmed) {
                            
                            // Remove resource
                            $(currentTarget).closest('.resource').remove();
                        }
                    });
                });
            }

            // Reset event listeners
            reset_event_listeners();
        });
    </script>
</body>
</html>
