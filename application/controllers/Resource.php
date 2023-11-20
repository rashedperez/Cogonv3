<?php
    class Resource extends CI_Controller{
        public function __construct() {
            parent::__construct();

            // Check ug naka login
            if (!$this->user_model->is_logged_in()) {
                redirect();
            }

            // Tan awn ang resources nga nakawaan naba gireserve ron
            $this->resource_model->check_resources_for_todays_reservation();
        }

        public function resource_index()
        {
            $data['resources'] = $this->resource_model->get_all_resources();
            
            $this->load->view('menu/menubar');
            $this->load->view('resource/resources',$data);
        }

        // Add Resource
        public function add()
        {
            // Set validation
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('per', 'Measurement', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('description', 'Description', 'trim|max_length[100]');

            // Run validation
            if ($this->form_validation->run()) {

                // Check rental fee if kilometer
                if ($this->input->post('per') == KILOMETER) {
                    if ($this->input->post('rental_fee') == NULL) {
                        echo json_encode(['type' => 'error', 'message' => 'Rental Fee field is required.']);
                    }
                }

                $data = array(
                    'type' => $this->input->post('type'),
                    'name' => $this->input->post('name'),
                    'measurement' => $this->input->post('per'),
                    'price' => $this->input->post('price'),
                    'rental_fee' => $this->input->post('rental_fee'),
                    'quantity' => $this->input->post('quantity'),
                    'description'=> $this->input->post('description')
                );
    
                // Save Attempt with based-result notification
                if ($this->resource_model->save_resource($data)) {

                    $response = array(
                        'status' => TRUE,
                        'redirect' => base_url('resource/resource_index')
                    );

                    $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Successfully Added New Resource']);
                }
                else {
                    $response['message'] = ['type' => 'error', 'message' => 'Failed To Add New Resource'];
                }
            }
            else {
                $response['message'] = ['type' => 'error', 'message' => validation_errors()];
            }
            
            echo json_encode($response);
        }

        // Update Resource
        public function update()
        {

            // Set validation
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('per', 'Measurement', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('description', 'Description', 'trim|max_length[100]');

            // Run validation
            if ($this->form_validation->run()) {

                $data = array (
                    'type' => $this->input->post('type'),
                    'name' => $this->input->post('name'),
                    'measurement' => $this->input->post('per'),
                    'price' => $this->input->post('price'),
                    'rental_fee' => $this->input->post('rental_fee'),
                    'quantity' => $this->input->post('quantity'),
                    'description'=> $this->input->post('description')
                );

                // Update Data
                if ($this->resource_model->update_resource($this->input->post('id'), $data)) {

                    $response = array(
                        'status' => TRUE,
                        'redirect' => base_url('resource/resource_index')
                    );

                    $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Successfully Updated Resource']);
                }
                else {
                    $response['message'] = ['type' => 'error', 'message' => 'Failed To Update Resource'];
                }
            }
            else {
                $response['message'] = ['type' => 'error', 'message' => validation_errors()];
            }
            
            echo json_encode($response);
        }

        // Delete Resource
        public function delete($delete_id)
        {
            // Delete Attempt
            if ($this->resource_model->delete_resource($delete_id))
            {
                $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Successfully Deleted Resource']);
            }
            else
            {
                $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Failed To Delete Resource']);
            }

            redirect('resource/resource_index');
        }

        // Rented Resources
        public function rented() {

            // Iterate reservations
            $data['reservations'] = array_map(function($reservation) {

                // Formatted ID
                $reservation->formatted_id = format_reservation_id($reservation->id);

                // Foramatted Reference Number
                $reservation->reference_number = format_reference_number($reservation->id);

                // Get reserver
                $reservation->reserver = $this->resident_model->get_resident_by_id($reservation->Res_id)->name;

                // Get reserved resources
                $resources_reserved = $this->reservation_model->get_reservation_details($reservation->id);

                // Get resources data
                $reservation->resources = array_map(function($resource) {

                    // Get Data
                    $resource->data = $this->resource_model->get_resource_by_id($resource->resource_id);

                    // Format Quantity
                    $resource->formatted_quantity = format_short_quantity($resource->data->measurement, $resource->quantity);

                    return $resource;

                }, $resources_reserved);

                // Get total amount paid
                $reservation->total_amount_paid = number_format(array_sum(array_map(function($resource) {

                    // Get Data
                    $resource_data = $this->resource_model->get_resource_by_id($resource->resource_id);

                    return $resource_data->price * $resource->quantity;

                }, $resources_reserved)), 2);

                return $reservation;

            }, $this->reservation_model->get_paid_reservations());

            $this->load->view('menu/menubar');
            $this->load->view('resource/rented',$data);
        }
        
    }
?>