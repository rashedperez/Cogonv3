
    <main class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Reservation</h5>
                </div>
                <div class="card-body">
                    <?php echo form_open('reservation/add'); ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputresident">Resident</label>
                                <select id="inputresident" class="form-control" name="resident">
                                    <option selected disabled>Choose...</option>
                                    <?php foreach ($residents as $resident): ?>
                                    <option value="<?php echo $resident->id; ?>"><?php echo $resident->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputresident">Type of Reservation</label>
                                <select id="type" class="form-control" name="type">
                                    <option selected disabled>Choose...</option>
                                    <option value="<?php echo RESOURCE_FACILITY; ?>"><?php echo ucfirst(RESOURCE_FACILITY); ?></option>
                                    <option value="<?php echo RESOURCE_AMENITY; ?>"><?php echo ucfirst(RESOURCE_AMENITY); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 partial-hidden" style="display: none">
                                <label for="inputresident" id="resource-label">Resource</label>
                                <select id="resource" class="form-control" name="resource">
                                    <option selected disabled>Choose...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 partial-hidden" style="display: none">
                                <label for="inputresident">Quantity</label>
                                <input type="number" name="quantity" class="form-control" min="0" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Start Date of Reservation</label>
                                <input type="datetime-local" name="start_date" class="form-control" placeholder="Choose..."/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">End Date of Reservation</label>
                                <input type="datetime-local" name="end_date" class="form-control" placeholder="Choose..."/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-label">Confirm that the provided information is accurate and requires no changes</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(() => {

            // Event Listener for type select when changed
            $('#type').change(({ currentTarget }) => {

                // Show Resource and Quantity
                $('.partial-hidden').show();

                // All resources
                const resources = <?php echo json_encode($resources); ?>

                // Selected type
                const type_selected = currentTarget.value;

                // Update Resource Label with uppercase first letter
                $('#resource-label').text(type_selected.charAt(0).toUpperCase() + type_selected.slice(1));

                // Get all resources with selected type
                const selected_resource_types = resources.filter(x => x.type == type_selected);

                // Add to resource select
                $('#resource').empty().append(`
                    ` + (selected_resource_types.map(x => `<option value="` + x.id + `">` + x.name + `</option>`)) + `
                `);

            });

        });
    </script>
</body>
</html>
