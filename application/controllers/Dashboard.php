<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
 
    public function index() {

        // Get Todays Reservation
        $data['todays'] = $this->reservation_model->get_todays_reservations();

        // Get Upcoming Reservation
        $data['upcoming'] = $this->reservation_model->get_upcoming_reservations();

        $this->load->view('menu/menubar');
        $this->load->view('dashboard_view', $data);
        $this->load->view('menu/footer');
    }
 }

