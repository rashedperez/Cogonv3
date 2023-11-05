<?php
    class Reservation extends CI_Controller {

        public function __construct() {
            parent::__construct();
        }

        // Reservation list
        public function list() {

            // Iterate reservations
            $data['reservations'] = array_map(function($reservation) {

                // Formatted ID
                $reservation->formatted_id = format_reservation_id($reservation->id);

                // Get reserver
                $reservation->reserver = $this->resident_model->get_resident_by_id($reservation->Res_id)->name;

                // Get reserved resources
                $resources_reserved = $this->reservation_model->get_reservation_details($reservation->id);

                // Get resources data
                $reservation->resources = array_map(function($resource) {

                    // Get Data
                    $resource->data = $this->resource_model->get_resource_by_id($resource->resource_id);

                    return $resource;

                }, $resources_reserved);

                return $reservation;

            }, $this->reservation_model->get_unpaid_reservations());

            $this->load->view('menu/menubar');
            $this->load->view('reservation/reservation_list', $data);
        }

        // Add reservation view
        public function reservation_index()
        {
            $data['residents'] = $this->resident_model->get_all_resident();
            $data['resources'] = $this->resource_model->get_all_resources();
            $data['latest_reservation'] = $this->reservation_model->get_latest_reservation();

            $this->load->view('menu/menubar');
            $this->load->view('reservation/reservation_view', $data);
        }

        // Add Reservation
        public function add() {

            // Get Inputs
            $id = $this->input->post('id');
            $resident = $this->input->post('resident');
            $date_reserved = $this->input->post('date_reserved');
            $resource = $this->input->post('resource');
            $quantity = $this->input->post('quantity');
            $rental_fee = $this->input->post('rental_fee');
            $has_driver = $this->input->post('has_driver');
            $driver = $this->input->post('driver_name');
            $purpose = $this->input->post('purpose');
            $others = $this->input->post('others');

            // Set validation
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('resident', 'Resident', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('date_reserved', 'Date Reserved', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('resource', 'Resource', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('purpose', 'Purpose', 'trim|required|numeric|max_length[100]');

            // Additional validation for vehicles
            // Code here ...

            // Run validation
            if ($this->form_validation->run()) {

                // Add
                if (empty($id)) {

                    // Reservation
                    $reservation_data = array(
                        'Res_id' => $resident,
                        'date_reservation' => date('Y-m-d H:i:s'),
                        'date_reserved'=> $date_reserved,
                        'status' => PENDING
                    );
                    
                    // Add reservation attempt
                    $reservation = $this->reservation_model->add_reservation($reservation_data);

                    // Check reservation is added
                    if ($reservation !== FALSE) {

                        try {
                        
                            // Loop all reservation facilities
                            for ($i = 0; $i < count($resource); $i++) {

                                // Kwaon ang resource
                                $current_resource = $this->resource_model->get_resource_by_id($resource[$i]);

                                // Add reservation details
                                $reservation_details = array(
                                    'reservation_id' => $reservation,
                                    'resource_id' => $resource[$i],
                                    'quantity' => $quantity[$i],
                                    'rental_fee' => $current_resource->measurement == KILOMETER ? $rental_fee[$i] : NULL,
                                    'has_driver' => !empty($has_driver[$i]) ? TRUE : FALSE,
                                    'driver' => $current_resource->measurement == KILOMETER ? $driver[$i] : NULL,
                                    'purpose' => $purpose[$i],
                                    'purpose_specific' => $others[$i]
                                );

                                // Add attempt
                                $this->reservation_model->add_reservation_detail($reservation_details);
                            }

                            $this->session->set_flashdata('reservation_status', ['type' => 'success', 'message' => 'Reserved Successfully']);
                            
                            // Redirect to list of reservation
                            redirect('reservation/list');
                        }
                        // There is error
                        catch (\Throwable $th) {
                            $this->session->set_flashdata('reservation_status', ['type' => 'error', 'message' => 'Failed To Reserve']);

                            // Redirect to add reservation
                            redirect('reservation/reservation_index');
                        }
                    }
                }
                // Update
                else {

                    // Reservation
                    $reservation_data = array(
                        'Res_id' => $resident,
                        'date_reserved'=> $date_reserved
                    );

                    // Update reservation attempt
                    $reservation = $this->reservation_model->update_reservation($id, $reservation_data);

                    // Check reservation is added
                    if ($reservation !== FALSE) {

                        try {

                            // Current reservation details
                            $current_details = $this->reservation_model->get_reservation_details($id);
                        
                            // Loop all reservation facilities
                            for ($i = 0; $i < count($resource); $i++) {

                                // Add reservation details
                                $reservation_details = array(
                                    'reservation_id' => $id,
                                    'resource_id' => $resource[$i],
                                    'quantity' => $quantity[$i]
                                );

                                // Update existing if less
                                if ($i < count($current_details)) {
                                    // Update
                                    $this->reservation_model->update_reservation_detail($current_details[$i]->id, $reservation_details);
                                }
                                else {
                                    // Add attempt
                                    $this->reservation_model->add_reservation_detail($reservation_details);
                                }
                            }

                            // Delete excess
                            if ($i < count($current_details)) {
                                for ($i = $i; $i < count($current_details); $i++) {
                                    $this->reservation_model->delete_reservation_detail($current_details[$i]->id);
                                }
                            }

                            $this->session->set_flashdata('reservation_status', ['type' => 'success', 'message' => 'Reservation Updated']);
                            
                            // Redirect to list of reservation
                            redirect('reservation/list');
                        }
                        // There is error
                        catch (\Throwable $th) {
                            $this->session->set_flashdata('reservation_status', ['type' => 'error', 'message' => 'Failed To Update Reservation']);

                            // Redirect to add reservation
                            redirect('reservation/reservation_index');
                        }
                    }
                }
            }
            else {
                $response['message'] = ['type' => 'error', 'message' => validation_errors()];
            }

            echo json_encode($response);
        }

        // Edit Reservation
        public function edit($id)
        {
            $data['reservation'] = $this->reservation_model->get_reservation($id);
            $data['reservation']->resources = array_map(function ($resource) {

                // Get data
                $resource->data = $this->resource_model->get_resource_by_id($resource->resource_id);

                return $resource;

            }, $this->reservation_model->get_reservation_details($id));
            $data['residents'] = $this->resident_model->get_all_resident();
            $data['resources'] = $this->resource_model->get_all_resources();

            $this->load->view('menu/menubar');
            $this->load->view('reservation/reservation_edit', $data);
        }
        
        // Pay Reservation
        public function pay($id) {

            // Pay attempt
            $pay_result = $this->reservation_model->update_reservation($id, array('date_paid' => date('Y-m-d H:i:s'), 'status' => CONFIRMED));

            // Check if payment recorded
            if (!$pay_result) {

                // Show error message
                $this->session->set_flashdata('reservation_status', ['type' => 'error', 'message' => 'Failed To Pay Reservation']);

                redirect('reservation/list');
            }

            // Get Reservation Resources
            $resources = $this->reservation_model->get_reservation_details($id);

            // Update Resources Quantity
            foreach ($resources as $resource) {

                // Decrement resource quantity
                $this->resource_model->decrement($resource->resource_id, $resource->quantity);
            }

            // Show success message
            $this->session->set_flashdata('reservation_status', ['type' => 'success', 'message' => 'The confirmed booking will be appear in the Rented Resources List']);

            redirect('reservation/list');
        }

        // Cancel Reservation
        public function cancel($id) {

            // Cancel attempt
            $cancel_result = $this->reservation_model->update_reservation($id, array('status' => CANCELLED));

            // Check if cancelled
            if (!$cancel_result) {

                // Show error message
                $this->session->set_flashdata('resource_status', ['type' => 'error', 'message' => 'Failed To Cancel Reservation']);

                redirect('resource/rented');
            }

            // Show success message
            $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'The reservation has been cancelled']);

            redirect('resource/rented');
        }
    }
?>