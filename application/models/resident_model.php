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
        public function delete_resident($id)
        {
            $this->db->where ('id', $id);
            $this->db->delete('resident');
        }
        // update the data from resident table
        public function update_resident($id ,$data)
        {
            $this->db->where('id', $id);
            $query = $this->db->update('resident', $data);
            return $query;
        }
    }
?>