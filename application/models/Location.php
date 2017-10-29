<?php

class Location extends CI_Model {

    public function selectcitys($id) {

        $this->db->select("*");

        $this->db->from('city');

        $this->db->where('province_id', $id);

        $query = $this->db->get();

        return $query->result();
    }

    public function allprovinces() {

        $this->db->select("*");

        $this->db->from('province');
        $this->db->order_by("pro_name", "asc");

        $query = $this->db->get();

        return $query->result();
    }

    public function allcities() {

        $this->db->select("*");

        $this->db->from('city');
        $this->db->order_by("city_name", "asc");

        $query = $this->db->get();

        return $query->result();
    }

    public function getProvinceId($city) {

        $this->db->select("*");
        $this->db->from('city');
        $this->db->where("id", $city);
        $query = $this->db->get();
        return $query->result();
    }

}
