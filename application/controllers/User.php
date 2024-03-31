<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    // Landing Page
    public function index() {

        // Check ug naka login
        if ($this->user_model->is_logged_in()) {
            redirect('dashboard');
        }

        $this->load->view('user/login_view');
    }

    // Login
    public function login() {

        // Check ug naka login
        if ($this->user_model->is_logged_in()) {
            redirect('dashboard');
        }

        // Set validation
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');

        try {

            // Run form validation
            if ($this->form_validation->run() === TRUE) {

                $POST = $this->input->post();

                // Login attempt
                if ($user = $this->user_model->login($POST['username'], $POST['password'])) {

                    // Check ug active
                    if ($user->status != ACTIVE) {
                        throw new Exception('User is currently not active');
                    }

                    $this->session->set_userdata(array(
                        'logged_in' => TRUE,
                        'user_id' => $user->id,
                        'id' => format_id_number($user->id),
                        'role' => $user->role,
                        'name' => $user->full_name
                    ));

                    // Check ug need machange pass
                    if ($user->password_change_required) {

                        $this->session->set_userdata('reset_password_user_id', $user->id);
                        redirect('user/reset_password');
                    }

                    // Based redirect
                    if ($user->role == RESIDENT) {
                        redirect('resource/rented');
                    }
                    else {
                        redirect('dashboard');
                    }
                }
                else {
                    throw new Exception('Invalid login attempt');
                }
            }
            else {
                throw new Exception(validation_errors());
            }
        }
        catch (Exception $e) {

            $this->session->set_flashdata('login_status', ['type' => 'error', 'message' => $e->getMessage()]);

            // Redirect balik login
            redirect();
        }
    }

    // Logout
    public function logout() {

        // Destroy whole session
        $this->session->sess_destroy();

        // Redirect to login
        redirect();
    }

    // Forgot Password
    public function forgot_password() {

        // Check ug naka login
        if ($this->user_model->is_logged_in()) {
            redirect('dashboard');
        }

        $this->load->view('user/forgot_password');
    }

    // Check Username
    public function check_username() {

        // Check ug naka login
        if ($this->user_model->is_logged_in()) {
            redirect('dashboard');
        }

        // Set validation
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]');

        try {

            // Run form validation
            if ($this->form_validation->run() === TRUE) {

                $POST = $this->input->post();

                // Get User
                $user = $this->user_model->get_user_by_name($POST['username']);

                // Tan awn ug naa ba
                if (!$user) {
                    throw new Exception('Username not found');
                }

                // Set flashdata for User ID
                $this->session->set_flashdata('forgot_password_user_id', $user->id);

                // Redirect to reset password
                redirect('user/reset_password');
            }
            else {
                throw new Exception(validation_errors());
            }
        }
        catch (Exception $e) {

            $this->session->set_flashdata('forgot_password_status', ['type' => 'error', 'message' => $e->getMessage()]);
            
            // Redirect forgot password
            redirect('user/forgot_password');
        }
    }

    // Reset Password
    public function reset_password() {

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }

        try {

            $user_id = $this->session->userdata('reset_password_user_id');

            // Check if naa ba user ID
            if (!$user_id) {
                throw new Exception();
            }
        } catch (Exception $e) {            
            // Redirect to dashboard
            redirect();
        }        

        $this->load->view('user/reset_password');
    }

    // Update New Password Endpoint
    public function update_new_password() {

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }

        // Set validation
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]|max_length[30]');

        try {

            // Check validation
            if (!$this->form_validation->run()) {
                throw new Exception(validation_errors());
            }
            
            $POST = $this->input->post();

            // Way ID
            if (!isset($POST['id'])) {
                throw new Exception('Failed to Update Password');
            }
            
            // Update attemmpt
            if ($this->user_model->update_user($POST['id'], ['password' => password_hash($POST['password'], PASSWORD_BCRYPT, ['cost' => 12]), 'password_change_required' => FALSE])) {


                // Get user
                $user = $this->user_model->get_user_by_id($POST['id']);

                // Unset Reset ID
                $this->session->unset_userdata('reset_password_user_id');

                // Set message
                $this->session->set_flashdata('login_status', ['type' => 'success', 'message' => 'Password Updated']);

                $response = array(
                    'status' => TRUE,
                    'redirect' => base_url($user->role == 'resident' ? 'resource/rented' : 'dashboard')
                );
            }
            else {
                throw new Exception('Failed to Update Password');
            }
        } catch (Exception $e) {
            $response['message'] = ['type' => 'error', 'message' => $e->getMessage()];
        }

        echo json_encode($response);
    }

    // Setup
    public function setup() {

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }

        // Only allow non-resident
        $this->session->userdata('role') == RESIDENT && redirect('resource/rented');

        $data['users'] = $this->user_model->get_users();

        $this->load->view('menu/menubar');
        $this->load->view('user/setup', $data);
    }

    // Add User
    public function add() {

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }

        // Set validation
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.name]|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]|max_length[30]');

        try {

            // Run form validation
            if ($this->form_validation->run() === TRUE) {

                // Post
                $POST = $this->input->post();

                // User details
                $user_details = array(
                    'role' => $POST['role'],
                    'full_name' => $POST['full_name'],
                    'name' => $POST['username'],
                    'password' => password_hash($POST['password'], PASSWORD_BCRYPT, ['cost' => 12]),
                    'password_change_required' => TRUE,
                    'status' => ACTIVE
                );

                // Save attemmpt
                if ($this->user_model->add_user($user_details)) {

                    // Set message
                    $this->session->set_flashdata('setup_status', ['type' => 'success', 'message' => 'User Added']);

                    $response = array(
                        'status' => TRUE,
                        'redirect' => base_url('user/setup')
                    );
                }
                else {
                    throw new Exception('Failed to Add User');
                }
            }
            else {
                throw new Exception(validation_errors());
            }
        }
        catch (Exception $e) {
            $response['message'] = ['type' => 'error', 'message' => $e->getMessage()];
        }

        echo json_encode($response);
    }

    // Update User
    public function update() {

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }

        // Set validation
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('password', 'Password', 'trim|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|matches[password]|max_length[30]');

        try {
            
            $POST = $this->input->post();

            // Way ID
            if (!isset($POST['id'])) {
                throw new Exception('Failed to Update User');
            }
            
            // Update attemmpt
            if ($this->user_model->update_user($POST['id'], ['status' => isset($POST['status']) ? ACTIVE : INACTIVE])) {

                // Set message
                $this->session->set_flashdata('setup_status', ['type' => 'success', 'message' => 'User Updated']);

                $response = array(
                    'status' => TRUE,
                    'redirect' => base_url('user/setup')
                );
            }
            else {
                throw new Exception('Failed to Update User');
            }
        } catch (Exception $e) {
            $response['message'] = ['type' => 'error', 'message' => $e->getMessage()];
        }

        echo json_encode($response);
    }

    // Reset Password Temporarily
    public function temp_reset() {

        // Check ug naka login
        if (!$this->user_model->is_logged_in()) {
            redirect();
        }

        try {
            
            $POST = $this->input->post();

            // Way ID
            if (!isset($POST['id'])) {
                throw new Exception('Failed to Reset Password');
            }

            // Temporary password
            $temp_password = random_string('alnum');

            // New Data
            $user_details = array(
                'password' => password_hash($temp_password, PASSWORD_BCRYPT, ['cost' => 12]),
                'password_change_required' => TRUE
            );
            
            // Update attemmpt
            if ($this->user_model->update_user($POST['id'], $user_details)) {

                // Set response
                $response = array(
                    'status' => TRUE,
                    'no_close' => TRUE,
                    'message' => array(
                        'position' => 'top',
                        'type' => 'info',
                        'message' => "Temporary Password: $temp_password"
                    )
                );
            }
            else {
                throw new Exception('Failed to Reset Password');
            }
        }
        catch (Exception $e) {
            $response['message'] = ['type' => 'error', 'message' => $e->getMessage()];
        }

        echo json_encode($response);
    }
}