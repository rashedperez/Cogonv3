<?php 
    class Amenity_model extends CI_Model
    {
        // Get all data in the database to show
        public function get_all_amenities()
        {
            $this->db->where('type', RESOURCE_AMENITY);
            $query = $this->db->get('resource');

            return $query->result();
        }

        // inserting data into resource table in db
        public function save_amenity($data)
        {
            // Merge Data with a type of Amenity Resource
            $result = $this->db->insert('resource', array_merge($data, ['type' => RESOURCE_AMENITY]));

            return $result;
        }

        // delete amenity
        public function delete_amenity($id)
        {
            $this->db->where ('id', $id);

            $result = $this->db->delete('resource');

            return $result;
        }
        
        // update the data from resource table
        public function update_amenity($id ,$data)
        {
            $this->db->where('id', $id);
            $result = $this->db->update('resource', $data);

            return $result;
        }
        
    }
?>