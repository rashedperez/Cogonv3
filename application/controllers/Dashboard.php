<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }
    }
 
    public function index() {

        // Get Confirmed Reservation
        $data['confirmed'] = $this->reservation_model->get_confirmed_reservations();

        // Get Pending Reservation
        $data['pending'] = $this->reservation_model->get_pending_reservations();

        $this->load->view('menu/menubar');
        $this->load->view('dashboard_view', $data);
        $this->load->view('menu/footer');
    }
 }

