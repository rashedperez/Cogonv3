<?php
    class Resident extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
    public function resident_index(){
        $data['resident'] = $this->resident_model->get_all_resident();
        $this->load->view('menu/menubar');
        $this->load->view('resident/resident_view',$data);
        $this->load->view('menu/footer');

    }
    public function add()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'contact_num' => $this->input->post('contact_num'),
        );   
        if ($this->resident_model->save_resident($data))
        {
        // Saving the resident data through the resident_model
        $this->session->set_flashdata('added_resident','added_resident_success');
        redirect('resident/resident_index');
        }
        else
        {
            // Redirecting to Add resident View if the add resident fails
        $this->session->set_flashdata('failed_resident','added_resident_failed');
        redirect('resident/resident_index');
        }
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
            $this->session->set_flashdata('update_resident', 'update_resident_success');
            redirect('resident/resident_index');
        }
        else
        {
            $this->session->set_flashdata('update_resident', 'update_resident_failed');
            redirect('resident/resident_index');
        }
    }
    // Delete resident
    public function delete($delete_id)
    {
        
        if($this->resident_model->delete_resident($delete_id))
        {
            $this->session->set_flashdata('delete_resident', 'delete_resident_success');
            redirect('resident/resident_index');
        }
        else
        {
            $this->session->set_flashdata('delete_resident', 'delete_resident_failed');
            redirect('resident/resident_index');
        }
    }
    }
?>