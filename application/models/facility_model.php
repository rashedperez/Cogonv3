<?php 
    class Facility_model extends CI_Model
    {
        // Get all data in the database to show
        public function get_all_facilities()
        {
            $this->db->where('type', RESOURCE_FACILITY);
            $query = $this->db->get('resource');

            return $query->result();
        }

        // inserting data into facility table in db
        public function save_facility($data)
        {
            // Merge Data with a type of Facility Resource
            $result = $this->db->insert('resource', array_merge($data, ['type' => RESOURCE_FACILITY]));

            return $result;
        }

        // delete facility
        public function delete_facility($id)
        {
            $this->db->where('id', $id);

            $result = $this->db->delete('resource');

            return $result;
        }

        // update the data from facility table
        public function update_facility($id ,$data)
        {
            $this->db->where('id', $id);
            $result = $this->db->update('resource', $data);

            return $result;
        }

    }
?>