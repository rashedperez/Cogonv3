<?php
    class Reservation extends CI_Controller{

        public function _construct() {
            parent::_construct();
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

            }, $this->reservation_model->get_reservations());

            $this->load->view('menu/menubar');
            $this->load->view('reservation/reservation_list', $data);
            $this->load->view('menu/footer');
        }

        // Add reservation view
        public function reservation_index()
        {
            $data['residents'] = $this->resident_model->get_all_resident();
            $data['resources'] = $this->resource_model->get_all_resources();
            $data['latest_reservation'] = $this->reservation_model->get_latest_reservation();

            $this->load->view('menu/menubar');
            $this->load->view('reservation/reservation_view', $data);
            $this->load->view('menu/footer');
        }

        // Add Reservation
        public function add() {
            
            // Get Inputs
            $id = $this->input->post('id');
            $resident = $this->input->post('resident');
            $date_reserved = $this->input->post('date_reserved');
            $resource = $this->input->post('resource');
            $quantity = $this->input->post('quantity');

            // Add
            if (empty($id)) {

                // Reservation
                $reservation_data = array(
                    'Res_id' => $resident,
                    'date_reservation' => date('Y-m-d H:i:s'),
                    'date_reserved'=> $date_reserved
                );
                
                // Add reservation attempt
                $reservation = $this->reservation_model->add_reservation($reservation_data);

                // Check reservation is added
                if ($reservation !== FALSE) {

                    try {
                    
                        // Loop all reservation facilities
                        for ($i = 0; $i < count($resource); $i++) {

                            // Add reservation details
                            $reservation_details = array(
                                'reservation_id' => $reservation,
                                'resource_id' => $resource[$i],
                                'quantity' => $quantity[$i]
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
            $this->load->view('menu/footer');
        }
        
        // Pay Reservation
        public function pay($id) {

            // Pay attempt
            $pay_result = $this->reservation_model->update_reservation($id, array('date_paid' => date('Y-m-d H:i:s')));

            // Check if payment recorded
            if ($pay_result) {

                // Show error message
                $this->session->set_flashdata('reservation_status', ['type' => 'success', 'message' => 'The confirmed booking will be appear in the Rented Resources List']);

                redirect('reservation/list');
            }

            // Show error message
            $this->session->set_flashdata('reservation_status', ['type' => 'error', 'message' => 'Failed To Pay Reservation']);

            redirect('reservation/list');
        }
    }
?>