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
                                        <input type="datetime-local" name="date_reserved" class="form-control" placeholder="Choose..." value="<?php echo $reservation->date_reserved; ?>"/>
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
                                        </div>
                                        <div class="price-div">
                                            <b>Price:</b><span class="price ml-2">₱<span><?php echo number_format($resource->data->price * $resource->quantity, 2); ?></span></span>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="w-100">
                                    <button type="button" class="btn btn-primary btn-new">Add New Resource</button>
                                </div>
                                <button type="button" class="btn btn-success btn-submit float-right">Update</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script>
        $(document).ready(() => {

            // All resources
            const resources = <?php echo json_encode($resources); ?>

            // Event Listener for add resource
            $('.btn-new').click(() => {

                // Include to resources
                $('.resources').append(`
                    <div class="resource p-3 mb-3 border rounded">
                        <div class="w-100 d-flex justify-content-end">
                            <button type="button" class="btn btn-link remove text-danger partial-hidden p-0" style="display: none"><u>Remove</u></button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputresident">Type of Reservation</label>
                                <select class="form-control type" name="type[]">
                                    <option selected disabled>Choose...</option>
                                    <option value="<?php echo RESOURCE_FACILITY; ?>"><?php echo ucfirst(RESOURCE_FACILITY); ?></option>
                                    <option value="<?php echo RESOURCE_AMENITY; ?>"><?php echo ucfirst(RESOURCE_AMENITY); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 partial-hidden" style="display: none">
                                <label for="inputresident" class="resource-label">Resource</label>
                                <select class="form-control watch-change resource-item" name="resource[]">
                                    <option selected disabled>Choose...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 partial-hidden" style="display: none">
                                <label for="inputresident">Quantity</label>
                                <input type="number" name="quantity[]" class="form-control watch-change quantity" min="0" placeholder=""/>
                            </div>
                        </div>
                        <div class="price-div" style="display: none">
                            <b>Price:</b><span class="price ml-2">₱<span>Price</span></span>
                        </div>
                    </div>
                `);    

                // Reset event listeners
                reset_event_listeners();
            });

            // Event Listener for submit
            $('.btn-submit').click(() => {

                // Show confirmation
                Swal.fire({
                    title: 'Confirm Reservation Update',
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
                        $('form').trigger('submit');
                    }
                });
            });

            // Reset event listeners
            function reset_event_listeners()
            {
                // Event Listener for type select when changed
                $('.type').unbind('change').change(({ currentTarget }) => {

                    // Show others
                    $(currentTarget).closest('.resource').find('.partial-hidden').show();

                    // Selected type
                    const type_selected = currentTarget.value;

                    // Update Resource Label with uppercase first letter
                    $(currentTarget).closest('.resource').find('.resource-label').text(type_selected.charAt(0).toUpperCase() + type_selected.slice(1));

                    // Get all resources with selected type
                    const selected_resource_types = resources.filter(x => x.type == type_selected);

                    // Add to resource select
                    const resource_select = $(currentTarget).closest('.resource').find('.resource-item');

                    // Display all but preselect default
                    $(currentTarget).closest('.resource').find('.resource-item').empty().append(`
                        ` + (selected_resource_types.map(x => `<option value="` + x.id + `" ` + (x.id == resource_select.val() ? 'selected' : '') + `>` + x.name + `</option>`)) + `
                    `);
                });

                // Evnet Listener for Resource Click
                $('.resource-item').unbind('mouseover').mouseover(({ currentTarget }) => {
                    $(currentTarget).closest('.resource').find('.type').trigger('change');
                });

                // Event Listener for resource and quantity change
                $('.watch-change').unbind('change').change(({ currentTarget }) => {

                    const resource_element = $(currentTarget).closest('.resource');                    
                    const price = parseFloat(resources.find(x => x.id == resource_element.find('.resource-item').val()).price);
                    const quantity = resource_element.find('.quantity').val();

                    // Only update price if there is quantity
                    if (quantity) {

                        // Calculate new price with 2 decimal format
                        const new_price = (parseFloat(price) * parseFloat(quantity)).toLocaleString(undefined, { minimumFractionDigits: 2 });

                        // Display to price and show
                        resource_element.find('.price span').text(new_price).closest('.price-div').show();
                    }
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
