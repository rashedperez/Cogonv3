<?php
class Users extends CI_Controller{
    public function change_pass1()
    {
        $this->load->view('menu/changepass_view1');
    }
    public function change_pass2()
    {
        $this->load->view('menu/changepass_view2');
    }
}
?>