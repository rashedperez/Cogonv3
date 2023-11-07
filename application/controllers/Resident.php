<?php
    class Resident extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
        
        public function resident_index() {

            $data['resident'] = $this->resident_model->get_all_resident();

            $this->load->view('menu/menubar');
            $this->load->view('resident/resident_view',$data);
        }

        // Add resident
        public function add()
        {
            // Set validation
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('contact_num', 'Contact Number', 'trim|required|min_length[11]|max_length[15]');

            // Run validation
            if ($this->form_validation->run()) {

                $data = array(
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'contact_num' => $this->input->post('contact_num'),
                );
    
                // Save attempt
                if ($this->resident_model->save_resident($data)) {

                    $response = array(
                        'status' => TRUE,
                        'redirect' => base_url('resident/resident_index')
                    );

                    // Saving the resident data through the resident_model
                    $this->session->set_flashdata('resident_status', ['type' => 'success', 'message' => 'Successfully Added New Resident']);
                }
                else {
                    $response['message'] = ['type' => 'error', 'message' => 'Unsuccessful Added New Resident'];
                }
            }
            else {
                $response['message'] = ['type' => 'error', 'message' => validation_errors()];
            }
            
            echo json_encode($response);
        }

        // Update resident
        public function update()
        {
            // Set validation
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('contact_num', 'Contact Number', 'trim|required|min_length[11]|max_length[15]');

            // Run validation
            if ($this->form_validation->run()) {

                $data = array (
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'contact_num' => $this->input->post('contact_num'),
                );

                // Update Data
                if ($this->resident_model->update_resident($this->input->post('id'), $data)) {
                    
                    $response = array(
                        'status' => TRUE,
                        'redirect' => base_url('resident/resident_index')
                    );

                    $this->session->set_flashdata('resident_status', ['type' => 'success', 'message' => 'Successfully Updated Resident']);
                }
                else {
                    $response['message'] = ['type' => 'error', 'message' => 'Failed to Update Resident'];
                }
            }
            else {
                $response['message'] = ['type' => 'error', 'message' => validation_errors()];
            }
            
            echo json_encode($response);
        }

        // Delete resident
        public function delete($delete_id)
        {
            // Delete attempt
            if ($this->resident_model->delete_resident($delete_id))
            {
                $this->session->set_flashdata('resident_status', ['type' => 'success', 'message' => 'Successfully Deleted Resident']);
            }
            else
            {
                $this->session->set_flashdata('resident_status', ['type' => 'error', 'message' => 'Failed to Delete Resident']);
            }
            
            redirect('resident/resident_index');
        }

        // Notify Resident View
        public function notify() {
            
            $this->load->view('menu/menubar');
            $this->load->view('resident/notify');
        }
    }
?>