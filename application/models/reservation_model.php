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

        // delete reservation
        public function delete_reservation($id)
        {
            $this->db->where('id', $id);
            $result = $this->db->delete('reservation');

            return $result;
        }

        // get latest reservation
        public function get_latest_reservation()
        {
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('reservation', 1);

            return $query->row();
        }

        // get all reservations
        public function get_reservations()
        {
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('reservation');

            return $query->result();
        }

        // get reservation details
        public function get_reservation_details($reservation_id)
        {
            $this->db->where('reservation_id', $reservation_id);
            $query = $this->db->get('reservation_details');

            return $query->result();
        }
    }
?>