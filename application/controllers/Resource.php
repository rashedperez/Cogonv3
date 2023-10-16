<?php
    class Resource extends CI_Controller{
        public function __construct() {
            parent::__construct();
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
            $data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'description'=> $this->input->post('description'),
            );

            // Save Attempt with based-result notification
            if ($this->resource_model->save_resource($data))
            {
                $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Successfully Added New Resource']);
            }
            else
            {
                $this->session->set_flashdata('resource_status', ['type' => 'error', 'message' => 'Failed To Add New Resource']);
            }

            
            redirect('resource/resource_index');
        }

        // Update Resource
        public function update()
        {
            $data = array (
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'description'=> $this->input->post('description'),
            );

            // Update Data
            if($this->resource_model->update_resource($this->input->post('id'), $data))
            {
                $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Successfully Updated Resource']);
            }
            else
            {
                $this->session->set_flashdata('resource_status', ['type' => 'error', 'message' => 'Failed To Update Resource']);
            }

            redirect('resource/resource_index');
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