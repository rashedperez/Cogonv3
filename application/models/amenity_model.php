<?php 
    class Amenity_model extends CI_Model{
        // Get all data in the database to show
        public function get_all_amenities()
        {
            $query = $this->db->get('amenity');
            return $query->result();
        }
        // inserting data into amenity table in db
        public function save_amenity($data)
        {
            $result = $this->db->insert('amenity', $data);
            return $result;
        }
        public function delete_amenity($id)
        {
            $this->db->where ('id', $id);
            $this->db->delete('amenity');
        }
        // update the data from amenity table
        public function update_amenity($id ,$data)
        {
            $this->db->where('id', $id);
            $query = $this->db->update('amenity', $data);
            return $query;
        }
    }
?>