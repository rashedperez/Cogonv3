<?php 
    class Facility_model extends CI_Model{
        // Get all data in the database to show
        public function get_all_facilities()
        {
            $query = $this->db->get('facility');
            return $query->result();
        }
        // inserting data into facility table in db
        public function save_facility($data)
        {
            $result = $this->db->insert('facility', $data);
            return $result;
        }
        public function delete_facility($id)
        {
            $this->db->where ('id', $id);
            $this->db->delete('facility');
        }
        // update the data from facility table
        public function update_facility($id ,$data)
        {
            $this->db->where('id', $id);
            $query = $this->db->update('facility', $data);
            return $query;
        }
    }
?>