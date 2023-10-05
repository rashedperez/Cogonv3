<?php
    class Reservation extends CI_Controller{

    public function reservation_index()
    {
        $this->load->view('menu/menubar');
        $this->load->view('reservation/reservation_view');
        $this->load->view('menu/footer');
    }
    }
?>