<?php

class Venues extends CI_Model {

    public function addVenue($title, $address, $telephone, $email, $web, $file_name) {
        $data = array(
            'title' => $title,
            'address' => $address,
            'telephone' => $telephone,
            'email' => $email,
            'web' => $web,
            'image' => $file_name
        );

        if ($this->db->insert('venues', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function allVenues() {
        $this->db->select("*");
        $this->db->from('venues');
        $this->db->order_by('title', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function record_count_all_venues() {

        return $this->db->count_all_results('venues');
    }

    public function getvenues($limit, $start) {

        $this->db->select("*");
        $this->db->from('venues');
        $this->db->limit($limit, $start);
        $this->db->order_by("title", 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deletevenue($id) {

        $this->db->where('venue_id', $id);

        if ($this->db->delete('venues')) {

            return 'ok';
        } else {

            return 1;
        }
    }

}
