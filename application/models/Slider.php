<?php

class Slider extends CI_Model {

    public function addslide($link, $file_name) {

        $data = array(
            'link' => $link,
            'slider_img' => $file_name,
        );

        if ($this->db->insert('slider', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function allslides() {
        $this->db->select("*");
        $this->db->from('slider');
        $this->db->order_by('slider_id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteslide($id) {

        $this->db->where('slider_id', $id);



        if ($this->db->delete('slider')) {

            return 'ok';
        } else {

            return 1;
        }
    }

}
