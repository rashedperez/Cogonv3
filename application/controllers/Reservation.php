<?php
    class Reservation extends CI_Controller{

        public function _construct() {
            parent::_construct();
        }

        // Reservation list
        public function list() {

            // Iterate reservations
            $data['reservations'] = array_map(function($reservation) {

                // Get reserver
                $reservation->reserver = $this->resident_model->get_resident_by_id($reservation->Res_id)->name;

                // Get reserved resources
                $resources_reserved = $this->reservation_model->get_reservation_details($reservation->id);

                // Filter facilities
                $reservation->facilities = array_filter(array_map(function($resource_reserved) {
                    
                    // Get resource
                    $resource = $this->resource_model->get_resource_by_d($resource_reserved->resource_id);

                    // Only return facility
                    if ($resource->type == RESOURCE_FACILITY) {
                        return $resource;
                    }
                }, $resources_reserved));

                // Filter amenities
                $reservation->amenities = array_filter(array_map(function($resource_reserved) {
                    
                    // Get resource
                    $resource = $this->resource_model->get_resource_by_d($resource_reserved->resource_id);

                    // Only return amenuty
                    if ($resource->type == RESOURCE_AMENITY) {
                        return $resource;
                    }
                }, $resources_reserved));

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
            $resident = $this->input->post('resident');
            $date_reserved = $this->input->post('date_reserved');
            $resource = $this->input->post('resource');
            $quantity = $this->input->post('quantity');

            // Reservation
            $reservation_data = array(
                'Res_id' => $resident,
                'date_reservation' => date('Y-m-d H:i:s'),
                'date_reserved'=> date('Y-m-d H:i:s')
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
                        $this->reservation_model->add_reservation_details($reservation_details);
                    }

                    $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Reserved Successfully']);
                    
                    // Redirect to list of reservation
                    redirect('reservation/list');
                }
                // There is error
                catch (\Throwable $th) {
                    $this->session->set_flashdata('resource_status', ['type' => 'error', 'message' => 'Failed To Reserve']);

                    // Redirect to add reservation
                    redirect('reservation/reservation_index');
                }
            }
        }
    }
?>