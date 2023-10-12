<?php
    class Resident extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
        
        public function resident_index() {

            $data['resident'] = $this->resident_model->get_all_resident();

            $this->load->view('menu/menubar');
            $this->load->view('resident/resident_view',$data);
            $this->load->view('menu/footer');
        }

        // Add resident
        public function add()
        {
            $data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'contact_num' => $this->input->post('contact_num'),
            );

            // Save attempt
            if ($this->resident_model->save_resident($data))
            {
                // Saving the resident data through the resident_model
                $this->session->set_flashdata('resident_status', ['type' => 'success', 'message' => 'Successfully Added New Resident']);
            }
            else
            {
                // Redirecting to Add resident View if the add resident fails
                $this->session->set_flashdata('resident_status', ['type' => 'error', 'message' => 'Unsuccessful Added New Resident']);
            }
            
            redirect('resident/resident_index');
        }

        // Update resident
        public function update()
        {
            $data = array (
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'contact_num' => $this->input->post('contact_num'),
            );

            // Update Data
            if($this->resident_model->update_resident($this->input->post('id'), $data))
            {
                $this->session->set_flashdata('resident_status', ['type' => 'success', 'message' => 'Successfully Updated Resident']);
            }
            else
            {
                $this->session->set_flashdata('resident_status', ['type' => 'error', 'message' => 'Failed to Update Resident']);
            }
            
            redirect('resident/resident_index');
        }

        // Delete resident
        public function delete($delete_id)
        {
            // Delete attempt
            if($this->resident_model->delete_resident($delete_id))
            {
                $this->session->set_flashdata('resident_status', ['type' => 'success', 'message' => 'Successfully Deleted Resident']);
            }
            else
            {
                $this->session->set_flashdata('resident_status', ['type' => 'error', 'message' => 'Failed to Delete Resident']);
            }
            
            redirect('resident/resident_index');
        }
    }
?>