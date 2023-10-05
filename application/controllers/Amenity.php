<?php
    class Amenity extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
    public function amenity_index(){
        $data['amenities'] = $this->amenity_model->get_all_amenities();
        $this->load->view('menu/menubar');
        $this->load->view('amenity/amenity_view',$data);
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
        if ($this->amenity_model->save_amenity($data))
        {
        // Saving the amenity data through the amenity_model
        $this->session->set_flashdata('added_amenity','added_amenity_success');
        redirect('amenity/amenity_index');
        }
        else
        {
            // Redirecting to Add amenity View if the add amenity fails
        $this->session->set_flashdata('failed_amenity','added_amenity_failed');
        redirect('amenity/amenity_index');
        }
    }
    // Update amenity
    public function update()
    {
        $data = array (
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'description'=> $this->input->post('description'),
        );
        // Update Data
        if($this->amenity_model->update_amenity($this->input->post('id'), $data))
        {
            $this->session->set_flashdata('update_amenity', 'update_amenity_success');
            redirect('amenity/amenity_index');
        }
        else
        {
            $this->session->set_flashdata('update_amenity', 'update_amenity_failed');
            redirect('amenity/amenity_index');
        }
    }
    // Delete amenity
    public function delete($delete_id)
    {
        
        if($this->amenity_model->delete_amenity($delete_id))
        {
            $this->session->set_flashdata('delete_amenity', 'delete_amenity_success');
            redirect('amenity/amenity_index');
        }
        else
        {
            $this->session->set_flashdata('delete_amenity', 'delete_amenity_failed');
            redirect('amenity/amenity_index');
        }
    }
    }
?>