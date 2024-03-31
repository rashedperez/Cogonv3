<?php 

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Check if logged in
    public function is_logged_in() {

        $is_logged_in = $this->session->userdata('logged_in');

        return $is_logged_in ? TRUE : FALSE;
    }

    // Login
    public function login($username, $password) {

        $this->db->where('name', $username);

        $query = $this->db->get('users');

        // If there is no results
        if($query->num_rows() == 0) {
            return FALSE;
        }

        // Get User
        $user = $query->row();

        // Compare the passwords from the database and input
        if(password_verify($password, $user->password)) {
            return $query->row();
        }
        else {
            return FALSE;
        }
    }

    // Get User By Name
    public function get_user_by_name($username) {

        $this->db->where('name', $username);

        $query = $this->db->get('users', 1);

        return $query->row();
    }

    // Get User by ID
    public function get_user_by_id($id) {

        // Build
        $this->db->where('id', $id);
        $query = $this->db->get('users', 1);

        // Return
        return $query->row();
    }

    // Get User
    public function get_users() {

        $query = $this->db->get('users');

        return $query->result();
    }

    // Add User
    public function add_user($data) {

        $result = $this->db->insert('users', $data);

        return $result ? $this->db->insert_id() : FALSE;
    }

    // Update User
    public function update_user($id, $data) {

        $this->db->where('id', $id);

        $result = $this->db->update('users', $data);

        return $result;
    }
}