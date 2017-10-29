<?php

class Themes extends CI_Model {

    public function addtheme($themename, $type, $file_name) {

        $data = array(
            'themename' => $themename,
            'type' => $type,
            'image' => $file_name,
        );

        if ($this->db->insert('themes', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function allThemes() {

        $this->db->select("*");
        $this->db->from('themes');
        $this->db->order_by('themename', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteTheme($id) {

        $this->db->where('theme_id', $id);

        if ($this->db->delete('themes')) {

            return 'ok';
        } else {

            return 1;
        }
    }

    public function getPopularThemes() {
        $this->db->select("*");
        $this->db->from('themes');
        $this->db->where('type', 'Popular');
        $this->db->order_by('themename', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllThemes() {
        $this->db->select("*");
        $this->db->from('themes');
        $this->db->where('type', 'All');
        $this->db->order_by('themename', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

}
