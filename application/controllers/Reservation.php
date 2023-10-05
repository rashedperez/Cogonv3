<?php
    class Reservation extends CI_Controller{

        public function _construct() {
            parent::_construct();
        }

        public function reservation_index()
        {
            $data['residents'] = $this->resident_model->get_all_resident();
            $data['resources'] = $this->resource_model->get_all_resources();

            $this->load->view('menu/menubar');
            $this->load->view('reservation/reservation_view', $data);
            $this->load->view('menu/footer');
        }

        // Add Reservation
        public function add() {
            
            // Get Inputs
            $resident = $this->input->post('resident');
            $reservation_start = $this->input->post('start_date');
            $reservation_end = $this->input->post('end_date');
            $resource = $this->input->post('resource');
            $quantity = $this->input->post('quantity');

            // Check if start is greater than end
            if (strtotime($reservation_start) > strtotime($reservation_end)) {
                $this->session->set_flashdata('resource_status', ['type' => 'error', 'message' => 'End date cannot be before start date']);

                redirect('reservation/reservation_index');
            }

            $reservation_data = array(
                'Res_id' => $resident,
                'date_reservation' => $reservation_start,
                'time_release' => $reservation_end,
                'date_reserved'=> date('Y-m-d H:i:s')
            );
            
            // Add reservation attempt
            $reservation = $this->reservation_model->add_reservation($reservation_data);

            // Check reservation is added
            if ($reservation !== FALSE) {

                // Add reservation details
                $reservation_details = array(
                    'reservation_id' => $reservation,
                    'resource_id' => $resource,
                    'quantity' => $quantity
                );

                // Save Attempt with based-result notification
                if ($this->reservation_model->add_reservation_details($reservation_details))
                {
                    $this->session->set_flashdata('resource_status', ['type' => 'success', 'message' => 'Reserved Successfully']);
                }
                else
                {
                    $this->session->set_flashdata('resource_status', ['type' => 'error', 'message' => 'Failed To Reserve']);
                }

            }

            
            redirect('resource/resource_index');
        }
    }
?>