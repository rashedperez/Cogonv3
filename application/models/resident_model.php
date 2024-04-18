<?php 
    class Resident_model extends CI_Model{
        // Get all data in the database to show
        public function get_all_resident()
        {
            $query = $this->db->get('resident');
            
            return $query->result();
        }

        // inserting data into resident table in db
        public function save_resident($data)
        {
            $result = $this->db->insert('resident', $data);

            return $result;
        }

        // delete resident
        public function delete_resident($id)
        {
            $this->db->where ('id', $id);
            $result = $this->db->delete('resident');

            return $result;
        }
        // update the data from resident table
        public function update_resident($id ,$data)
        {
            $this->db->where('id', $id);
            $query = $this->db->update('resident', $data);
            return $query;
        }

        // get resident by id
        public function get_resident_by_id($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('resident', 1);
            
            return $query->row();
        }

        // Get Resident by User ID
        public function get_resident_by_user_id($user_id) {

            // Build
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('resident', 1);
            
            // Return
            return $query->row();
        }

        // Get Voter by ID
        public function get_voter_by_id($voters_id) {

            // Build
            $this->db->select('rv.*, r.id as resident');
            $this->db->join('resident r', 'r.voters_id = rv.voters_id', 'left');
            $this->db->where('rv.voters_id', $voters_id);
            $query = $this->db->get('registered_voters rv', 1);

            // Return
            return $query->row();
        }
    }
?>