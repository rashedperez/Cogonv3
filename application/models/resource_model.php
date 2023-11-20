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

        // get resource by id
        public function get_resource_by_id($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('resource', 1);

            return $query->row();
        }

        // Decrement resource
        public function decrement($id, $quantity) {

            // Get resource
            $resource = $this->get_resource_by_id($id);

            // Update new quantity
            $update_result = $this->update_resource($id, ['quantity' => (int) $resource->quantity - (int) $quantity]);

            return $update_result;
        }

        // Increment resource
        public function increment($id, $quantity) {

            // Get resource
            $resource = $this->get_resource_by_id($id);

            // Update new quantity
            $update_result = $this->update_resource($id, ['quantity' => (int) $resource->quantity + (int) $quantity]);

            return $update_result;
        }
        
        // Tan awn ang resources nga nakawaan naba gireserve ron
        public function check_resources_for_todays_reservation() {

            // Kwaon nakareserve ron
            $reserved_today = $this->reservation_model->get_paid_reservations_for_today();

            foreach  ($reserved_today as $reservation) {

                // Kwaon tanan gireserve nga resources
                $resources = $this->reservation_model->get_reservation_details($reservation->id);

                foreach ($resources as $resource) {

                    // Kwaan ang quantity
                    $this->decrement($resource->resource_id, $resource->quantity);
                }

                // Update nakwaan na
                $this->reservation_model->update_reservation($reservation->id, array(
                    'is_taken' => TRUE
                ));
            }
        }
    }
?>