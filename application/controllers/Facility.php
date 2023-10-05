<?php
    class Facility extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
    public function facility_index(){
        $data['facilities'] = $this->facility_model->get_all_facilities();
        $this->load->view('menu/menubar');
        $this->load->view('facility/facility_view',$data);
        $this->load->view('menu/footer');

    }
    public function add()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'description'=> $this->input->post('description'),
        );   
        if ($this->facility_model->save_facility($data))
        {
        // Saving the facility data through the facility_model
        $this->session->set_flashdata('added_facility','added_facility_success');
        redirect('facility/facility_index');
        }
        else
        {
            // Redirecting to Add Facility View if the add facility fails
        $this->session->set_flashdata('failed_facility','added_facility_failed');
        redirect('facility/facility_index');
        }
    }
    // Update Facility
    public function update()
    {
        $data = array (
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'description'=> $this->input->post('description'),
        );
        // Update Data
        if($this->facility_model->update_facility($this->input->post('id'), $data))
        {
            $this->session->set_flashdata('update_facility', 'update_facility_success');
            redirect('facility/facility_index');
        }
        else
        {
            $this->session->set_flashdata('update_facility', 'update_facility_failed');
            redirect('facility/facility_index');
        }
    }
    // Delete facility
    public function delete($delete_id)
    {
        
        if($this->facility_model->delete_facility($delete_id))
        {
            $this->session->set_flashdata('delete_facility', 'delete_facility_success');
            redirect('facility/facility_index');
        }
        else
        {
            $this->session->set_flashdata('delete_facility', 'delete_facility_failed');
            redirect('facility/facility_index');
        }
    }
    }
?>