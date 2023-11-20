<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
            <main class="content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <?php $current_reservation_id = format_reservation_id($latest_reservation ? $latest_reservation->id : 1); ?>
                            <div>
                                <h5 class="card-title">Add Reservation</h5>
                                <b>Reservation ID<span class="ml-3"><?php echo $current_reservation_id; ?></span></b>
                            </div>
                            <b>Date of Reservation: <span class="ml-2"><?php echo date('F j, Y'); ?></span></b>
                        </div>
                        <div class="card-body">
                            <?php echo form_open('reservation/add'); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6 d-flex flex-column">
                                        <label>Resident</label>
                                        <select id="resident" class="form-control sumoselect" name="resident">
                                            <option selected disabled>Choose...</option>
                                            <?php foreach ($residents as $resident): ?>
                                            <option value="<?php echo $resident->id; ?>"><?php echo $resident->name; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 my-0">
                                        <div class="contact-detail mb-3" style="display: none">
                                            <div class="d-flex align-items-center">
                                                <p class="label mb-0" style="font-weight: 500">Contact Number: <span class="label">09123456789</span></p>
                                                <div class="spinner-border spinner-border-sm text-secondary ml-3" role="status" style="display: none"></div>
                                                <a href="#" id="generate-otp" class="btn-link text-success ml-3 label" style="font-weight: bold">Send Code</a>
                                                <div class="input-group w-auto ml-3" style="display: none">
                                                    <input type="text" class="form-control form-control-sm label" id="otp-input" style="width: 225px"/>
                                                    <button type="button" class="btn btn-success btn-sm btn-verify label">Verify</button>
                                                </div>
                                                <div class="ml-3 text-success" id="otp-verified" style="display: none">verified number</div>
                                                <button type="button" class="btn btn-transparent p-0 ml-3 disabled resend" style="display: none">resend after <span class="label">200s</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Date Reserved</label>
                                        <input type="date" name="date_reserved" class="form-control flatpickr" placeholder="Choose..."/>
                                    </div>
                                </div>
                                <div class="resources"></div>
                                <div class="w-100">
                                    <button type="button" class="btn btn-primary btn-new">Add New Resource</button>
                                </div>
                                <button type="submit" class="btn btn-success btn-submit float-right">Submit</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

                <!-- Offcanvas -->
                <aside class="offcanvas" id="map-canvas">
                    <div class="canvas-header p-3">
                        <button class="btn btn-close font-weight-bold canvas-title p-0 m-0"><i data-feather="x"></i></button>
                    </div>
                    <div class="canvas-content px-3">
                        <h3 class="title text-center">Map</h3>
                        <p class="mb-0">Use the direction to find out how many kilometers it is from your starting point in the barangay to your destination</p>
                        
                        <!-- Map -->
                        <div class="my-3" id="map" style="height: 40vh">
                            <img src="https://cdn.discordapp.com/attachments/1087225088069353572/1166763585939189812/image.png?ex=654bac44&is=65393744&hm=928eaaa66773f9a9fcd8610da63f3610dc5c55dde231232938ef339f1d611552&" alt="Google Map Image" class="img-fluid"/>
                        </div>
                        <!-- Map -->

                        <h4>Direction</h4>
                        <div class="form-group">
                            <label class="text-danger">Starting Point</label>
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <input type="text" class="form-control" id="origin-input" placeholder="Search ..."/>
                                </div>
                                <select id="origin-output" class="form-control">
                                    <option selected disabled>Enter location</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-success">Destination</label>
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <input type="text" class="form-control" id="destination-input" placeholder="Search ..."/>
                                </div>
                                <select id="destination-output" class="form-control">
                                    <option selected disabled>Enter location</option>
                                </select>
                            </div>
                        </div>
                        <h4 class="distance" style="display: none">Distance: <span style="font-weight: 400">69</span><small>km</small></h4>
                    </div>
                </aside>
                <!-- Offcanvas -->
            </main>
            <?php include('application\views\menu\footer.php'); ?>
        </div>
    </div>

	<script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>

    <script>
        $(document).ready(() => {

            /**
             * Map
             */

            class Map {

				constructor() {

					this.access_token = 'pk.eyJ1IjoicmFzaGVkMDkiLCJhIjoiY2xvbGEzdm43MjBtczJqbzExNms0ZjdueCJ9.aq4gxSM8lvD2KJLH7SdSLw';

					// Access token
					mapboxgl.accessToken = this.access_token;
					
					// Pardo LatLng
					const pardo = new mapboxgl.LngLat(123.8604274375296, 10.274636914843141);

					// Buhat map instance
					this.map = new mapboxgl.Map({
						container: 'map',
						style: 'mapbox://styles/mapbox/streets-v12',
						center: pardo,
						zoom: 15
					});

					this.map.addControl(new mapboxgl.GeolocateControl());

					this.session_token = '<?php echo strtolower(random_string('alpha', 8)); ?>';

					// Marker sa pardo
					this.origin_marker = new mapboxgl.Marker({
						color: '#E03444',
						draggable: true
					}).setLngLat(pardo).addTo(this.map);

					// Destination
					this.destination_marker = new mapboxgl.Marker({
						color: '#4BBF73',
						draggable: true
					});
				}

				set_search_output_element(input_element, output_element) {

					let timeout;
					
					input_element.on('keyup', ({ currentTarget }) => {

						clearTimeout(timeout);

						// Update after 5 seconds
						timeout = setTimeout(async () => {
							output_element.prop('disabled', true);
							await map.search(currentTarget.value, output_element);
							output_element.prop('disabled', false);
						}, 1000);
					});
				}

				async search(query, output) {

					output.append(`<option selected disabled>Searching ...</option>`);

					query = encodeURIComponent(query);
					
					const search_endpoint = `https://api.mapbox.com/search/searchbox/v1/suggest?q=${query}&country=PH&access_token=${this.access_token}&session_token=${this.session_token}`;

					await fetch(search_endpoint).then(response => response.json()).then(data => {
						
						// Nay sud ang suggestion
						if (data.suggestions.length > 0) {

							output.empty().append(`<option selected disabled>Select Location</option>`);

							data.suggestions.map(suggestion => {
								output.append(`
									<option value="${suggestion.mapbox_id}">${[suggestion.name, suggestion.place_formatted].join(', ')}</option>
								`);
							});

							output.unbind('change').change(async ({ currentTarget }) => {

								const retrieve_endpoint = `https://api.mapbox.com/search/searchbox/v1/retrieve/${currentTarget.value}?access_token=${this.access_token}&session_token=${this.session_token}`;

								await fetch(retrieve_endpoint).then(retrieve_response => retrieve_response.json()).then(retrieve_data => {

									const [longitude, latitude] = retrieve_data.features[0].geometry.coordinates;
									const coordinates = new mapboxgl.LngLat(longitude, latitude);

									if (output.attr('id') == 'origin-output') {
										this.origin_marker.setLngLat(coordinates);
									}
									else {
										this.destination_marker.setLngLat(coordinates).addTo(this.map);
									}

									this.map.panTo(coordinates);
									this.compute_distance();
								}).catch((error) => console.error(error));
							});
						}
						else {
							throw new Error();
						}
					}).catch(() => output.empty().append(`<option selected disabled>No results found</option>`));
				}

				compute_distance() {
					
					const origin = this.origin_marker.getLngLat();
					const destination = this.destination_marker.getLngLat();

					// Check naa bay origin ug destination
					if (!origin || !destination) {
						return false;
					}

                    // Calculate the bounds to fit both markers
                    const bounds = new mapboxgl.LngLatBounds().extend(origin).extend(destination);

                    // Fit the map to the bounds
                    this.map.fitBounds(bounds, { padding: 50 });

                    const start = turf.point([origin.lng, origin.lat]);
                    const end = turf.point([destination.lng, destination.lat]);
                    const distance = turf.distance(start, end);

                    // Display bag o distance
                    $('.distance').show().find('span').text(distance.toFixed(1));
				}
			}
			
			// Set map instance
			const map = new Map();

			// Set origin mangita
			map.set_search_output_element($('#origin-input'), $('#origin-output'));

			// Set destination padung
			map.set_search_output_element($('#destination-input'), $('#destination-output'));

            /**
             * Mga Mamuhatay
             */

            // Hawanan ang session
            sessionStorage.clear();

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

            // Open one resource
            $('.btn-new').trigger('click');

            // All resources
            const resources = <?php echo json_encode($resources); ?>

            /**
             * Mga Maminaway
             */

            // Magbantay sa resident ug mausab, (currentTarget: ang element nga nagtrigger anang usab)
            $('#resident').change(({ currentTarget }) => {

                // Hawanan ang session
                sessionStorage.clear();

                // Pakita verify balik
                $('#generate-otp').closest('div').find('*').not('.label').hide().closest('div').find('#generate-otp').show();

                // Clear Input
                $('#otp-input').val('');

                // Tanan resident
                const residents = <?php echo json_encode($residents); ?>;

                // Pangitaon to ang karon nga gipili
                const selected_resident = residents.find(x => x.id == currentTarget.value);

                // Ipakita ang contact detail niya usbon ang contact number sa gipili nga resident
                $('.contact-detail').slideDown().find('p span').text(selected_resident.contact_num ? selected_resident.contact_num : 'None');
            });

            // Magbantay ug pisliton ang send code
            $('#generate-otp').click((e) => {
                
                // Para dili muredirect kay <a></a> man siya
                e.preventDefault();

                // Taguon ang nagtrigger sa click
                $(e.currentTarget).hide();

                // Ipakita ang spinner
                $('.spinner-border').show();

                // Padaganon ang Api Controller kay mokuha ug otp
                $.ajax({
                    url: '../api/generate_otp',
                    method: 'POST',
                    dataType: 'json',
                    data: { make_request: true, number: $('.contact-detail').slideDown().find('p span').text() }
                })
                .done(({ status, message, otp }) => {

                    // Taguon ang spinner
                    $('.spinner-border').hide();

                    // Tanawn ug ok ba ang status
                    if (status && status == true) {

                        // Taguon ang send code button, ipakita ang resend
                        $('.resend').show();

                        // Ipakita and otp input
                        $('#otp-input').closest('div').show();

                        // Start ang countdown makasend otp balik
                        start_countdown(200, $('.contact-detail').find('button span').get(0), () => {

                            // Ipakita ang nagtrigger sa click
                            $(e.currentTarget).show();

                            // Ipakita ang send code button, tagoun ang resend
                            $('.resend').hide();

                            // Pakita ang otp input
                            $('#otp-input').closest('div').hide();
                        })

                        // Inotify unsa ang OTP
                        Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            showCloseButton: true,
                        }).fire({
                            icon: 'info',
                            title: `<b>One Time Pin</b><br/>${otp}`
                        });
                    }
                    else {

                        // Ipakita ang nagtrigger sa click
                        $(e.currentTarget).show();

                        // Error message
                        window.notyf.open({
                            type: 'error',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });
                    }
                })
                .fail(() => {

                    // Taguon ang spinner
                    $('.spinner-border').hide();

                    // Ipakita ang nagtrigger sa click
                    $(e.currentTarget).show();

                    // Error message
                    window.notyf.open({
                        type: 'error',
                        message: 'Failed to generate OTP.<br/>Please try again later.',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });
                });
            });

            // Magbantay pisliton ang otp
            $('.btn-verify').click(() => {
                
                const input = $('#otp-input').val();

                try {
                    // Tan awn ug naa ba input
                    if (!input) {
                        throw 'Please enter code'
                    };
                }
                catch (error) {
                    // Prompt Error
                    window.notyf.open({
                        type: 'error',
                        message: error,
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });

                    return false;
                }

                // Taguon ang input
                $('.btn-verify').closest('div').hide();

                // Ipakita ang spinner, taguon ang resend
                $('.spinner-border, .resend').toggle();

                // Padaganon ang Api Controller kay iverify ang otp
                $.ajax({
                    url: '../api/verify_otp',
                    method: 'POST',
                    dataType: 'json',
                    data: {  make_request: true, code: input }
                })
                .done(({ status, message }) => {

                    // Taguon ang spinner
                    $('.spinner-border').hide();

                    // Tanawn ug ok ba ang status
                    if (status && status == true) {

                        sessionStorage.setItem('<?php echo $current_reservation_id; ?>', true);

                        $('#otp-verified').show();

                        // Inotify unsa ang OTP
                        window.notyf.open({
                            type: 'success',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });
                    }
                    else {

                        // Ipakita ang input, erason ang sud
                        $('#otp-input').val('').closest('div').show();

                        // Ipakita ang resend
                        $('.resend').show();

                        // Error message
                        window.notyf.open({
                            type: 'error',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });
                    }
                })
                .fail((error) => {console.log(error)

                    // Taguon ang spinner, ipakita ang resend
                    $('.spinner-border, .resend').toggle();

                    // Ipakita ang input, erason ang sud
                    $('#otp-input').val('').closest('div').show();

                    // Error message
                    window.notyf.open({
                        type: 'error',
                        message: 'Failed to verify OTP.<br/>Please try again later.',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });
                });
            });

            // Event Listener for add resource
            $('.btn-new').click(() => {

                const resident = $('#resident option:selected').not(':disabled').val();
                const is_resident_verified = sessionStorage.getItem('<?php echo $current_reservation_id; ?>');
                const date_reserved = $('[name="date_reserved"]').val();

                try {
                    // Tan awn ug naa ba resident gipili
                    if (!resident) {
                        throw 'Please Select Resident';
                    }

                    // Tan awn ug verified
                    if (!is_resident_verified) {
                        throw 'Verify Resident Mobile Number';
                    }

                    // Tan awn ug naa date gipili
                    if (!date_reserved) {
                        throw 'Select Date First';
                    }
                }
                catch (error) {
                    // Prompt Error
                    window.notyf.open({
                        type: 'error',
                        message: error,
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });

                    return false;
                }

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
                                        <input class="form-check-input watch-change" type="checkbox" name="has_driver[]">
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
                    $(currentTarget).closest('.resource').find('.resource-item').empty().append(`
                        ` + (selected_resource_types.map(x => `<option value="` + x.id + `">` + x.name + `</option>`)) + `
                    `);

                    // Trigger change
                    $(currentTarget).closest('.resource').find('.resource-item').trigger('change');

                    // Update Resource Label with uppercase first letter
                    $(currentTarget).closest('.resource').find('.resource-label').text(type_selected.charAt(0).toUpperCase() + type_selected.slice(1));
                });

                // Magbantay mapislit ang offcanvas
                $('[data-toggle="offcanvas"]').unbind('click').click((e) => {

                    e.preventDefault();
                    e.stopPropagation();

                    // Show offcanvas
                    $($(e.currentTarget).data('target')).toggleClass('show');
                    $('body').toggleClass('offcanvas-active');
                }); 

                // Minaw pisliton ang close sa sud sa offcanvas
                $('.offcanvas .btn-close').click(() => {

                    // Hide offcanvas
                    $('.offcanvas').removeClass('show');
                    $('body').removeClass('offcanvas-active');
                });

                // Magbantay ug mausab ang resource
                $('.resource-item').unbind('change').change(({ currentTarget }) => {

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

                // Event Listener for resource and quantity change
                $('.watch-change').change(({ currentTarget }) => {

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
                            $(e.currentTarget).attr('data-submit', true).trigger('click')
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

                            // Hawanan ang session
                            sessionStorage.clear();

                            // Balhin
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

            /**
             * Mga Function
             */

            // Magbuhat ug countdown
            function start_countdown(duration, element, callback) {

                // Set ang timer sa gihatag na duration
                let timer = duration;

                // Update timer
                function update_timer() {

                    // Update ang element display
                    element.innerHTML = timer + 's';

                    // Countdown is done
                    if (timer <= 0) {

                        // Clear interval
                        clearInterval(interval);
                        
                        // Iparun ang mahitabo ig human
                        callback();
                    }

                    timer--;
                }

                // Display ang initial nga time
                update_timer();

                // Set Interval
                const interval = setInterval(update_timer, 1000);
            }
        });
    </script>
</body>
</html>
