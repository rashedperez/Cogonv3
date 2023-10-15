<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
 
    public function index() {

        $this->load->view('menu/menubar');
        $this->load->view('dashboard_view');
        $this->load->view('menu/footer');
    }
 }

