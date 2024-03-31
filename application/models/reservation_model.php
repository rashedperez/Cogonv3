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
        public function add_reservation_detail($data)
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

        // get unpaid reservations
        public function get_unpaid_reservations()
        {
            // Applies to resident
            if ($this->session->userdata('role') == RESIDENT) {
                $resident = $this->resident_model->get_resident_by_user_id($this->session->userdata('user_id'));
                $this->db->where('Res_id', $resident->id);
            }
            
            $this->db->where('date_paid', NULL);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('reservation');

            return $query->result();
        }

        // get paid reservations
        public function get_paid_reservations()
        {
            // Applies to resident
            if ($this->session->userdata('role') == RESIDENT) {
                $resident = $this->resident_model->get_resident_by_user_id($this->session->userdata('user_id'));
                $this->db->where('Res_id', $resident->id);
            }

            $this->db->where('date_paid !=', NULL);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('reservation');

            return $query->result();
        }

        // get reservation by id
        public function get_reservation($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('reservation', 1);

            return $query->row();
        }

        // get reservation details
        public function get_reservation_details($reservation_id)
        {
            $this->db->where('reservation_id', $reservation_id);
            $query = $this->db->get('reservation_details');

            return $query->result();
        }

        // update reservation
        public function update_reservation($id, $data)
        {
            $this->db->where('id', $id);
            $result = $this->db->update('reservation', $data);

            return $result;
        }

        // update reservation detail
        public function update_reservation_detail($id, $data)
        {
            $this->db->where('id', $id);
            $result = $this->db->update('reservation_details', $data);

            return $result;
        }

        // delete reservation detail
        public function delete_reservation_detail($id)
        {
            $this->db->where('id', $id);
            $result = $this->db->delete('reservation_details');

            return $result;
        }

        // Get Confirmed Reservation
        public function get_confirmed_reservations()
        {
            $this->db->where('status', CONFIRMED);
            $query = $this->db->get('reservation');

            return $query->result();
        }

        // Get Pending Reservation
        public function get_pending_reservations()
        {
            $this->db->where('status', PENDING);
            $query = $this->db->get('reservation');

            return $query->result();
        }

        // Kwaon ang nakareserve ron
        public function get_paid_reservations_for_today() {

            $this->db->select('id');
            $this->db->where('date_paid !=', NULL);
            $this->db->where('status', CONFIRMED);
            $this->db->where('DATE_FORMAT(date_reserved, "%Y-%m-%d") =', date('Y-m-d'));
            $this->db->where('is_taken', FALSE);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('reservation');

            return $query->result();
        }
    }
?>