<?php 
    class Resource_model extends CI_Model
    {
        // Get all data in the database to show
        public function get_all_resources()
        {
            $query = $this->db->get('resource');

            return $query->result();
        }

        // inserting data into resource table in db
        public function save_resource($data)
        {
            $result = $this->db->insert('resource', $data);

            return $result;
        }

        // delete resource
        public function delete_resource($id)
        {
            $this->db->where ('id', $id);

            $result = $this->db->delete('resource');

            return $result;
        }
        
        // update the data from resource table
        public function update_resource($id ,$data)
        {
            $this->db->where('id', $id);
            $result = $this->db->update('resource', $data);

            return $result;
        }
        
    }
?>