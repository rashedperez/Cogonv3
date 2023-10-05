<?php 
    class Reservation_model extends CI_Model
    {
        // Get all data in the database to show
        public function get_all_reservation()
        {
            $query = $this->db->get('reservation');

            return $query->result();
        }

        // inserting data into reservation table in db
        public function add_reservation($data)
        {
            $result = $this->db->insert('reservation', $data);

            // Return Id of reservation if inserted or result is true
            return $result === TRUE? $this->db->insert_id() : FALSE;
        }

        // inserting data into reservation_details table in db
        public function add_reservation_details($data)
        {
            $result = $this->db->insert('reservation_details', $data);

            return $result;
        }
    }
?>