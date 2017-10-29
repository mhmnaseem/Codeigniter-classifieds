<?php

class Category extends CI_Model {

    public function addCategory($cname, $curl, $dis) {

        $data = array(
            'name' => $cname,
            'slug' => $curl,
            'description' => $dis,
        );

        if ($this->db->insert('maincategory', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function addCategoryWImg($cname, $curl, $dis, $file_name) {

        $data = array(
            'name' => $cname,
            'slug' => $curl,
            'description' => $dis,
            'image' => $file_name
        );

        if ($this->db->insert('maincategory', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function updateCategory($id, $cname, $curl, $dis) {

        $data = array(
            'mcatid' => $id,
            'name' => $cname,
            'slug' => $curl,
            'description' => $dis,
        );

        $this->db->where('mcatid', $id);

        $quary = $this->db->update('maincategory', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function updateCategoryWImg($id, $cname, $curl, $dis, $file_name) {

        $data = array(
            'mcatid' => $id,
            'name' => $cname,
            'slug' => $curl,
            'description' => $dis,
            'image' => $file_name
        );

        $this->db->where('mcatid', $id);

        $quary = $this->db->update('maincategory', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function allcats() {

        $this->db->select("*");

        $this->db->from('maincategory');
        $this->db->order_by("name", "asc");

        $query = $this->db->get();

        return $query->result();
    }

    public function pcatAndSubcat() {

        $this->db->select("*,maincategory.name as parentname, maincategory.slug as maincatslug");
        $this->db->from('maincategory');
        $this->db->join('subcategory', 'maincategory.mcatid = subcategory.parentcat', 'left');
        $this->db->order_by("maincategory.mcatid", "asc");

        $query = $this->db->get();

        return $query->result();
    }

    public function subCatSlugToMainCatSlug($slug) {

        $this->db->select("*, maincategory.slug as maincatslug");
        $this->db->from('maincategory');
        $this->db->join('subcategory', 'maincategory.mcatid = subcategory.parentcat', 'left');
        $this->db->where("subcategory.slug", $slug);
        $query = $this->db->get();

        return $query->result();
    }

    public function singlemaincat($id) {
        $this->db->select("*");
        $this->db->from('maincategory');
        $this->db->where("mcatid", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteMainCat($id) {

        $this->db->where('mcatid', $id);

        if ($this->db->delete('maincategory')) {

            return 'ok';
        } else {

            return 1;
        }
    }

    public function addSubCategory($scname, $curl, $dis, $pcat) {

        $data = array(
            'parentcat' => $pcat,
            'name' => $scname,
            'slug' => $curl,
            'description' => $dis
        );

        if ($this->db->insert('subcategory', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function addSubCategoryWImg($scname, $curl, $dis, $pcat, $file_name) {

        $data = array(
            'parentcat' => $pcat,
            'name' => $scname,
            'slug' => $curl,
            'description' => $dis,
            'image' => $file_name
        );

        if ($this->db->insert('subcategory', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function allsubcats() {

        $this->db->select("*");

        $this->db->from('subcategory');
        $this->db->order_by("name", "asc");

        $query = $this->db->get();

        return $query->result();
    }

    public function singleSubcat($id) {
        $this->db->select("*");
        $this->db->from('subcategory');
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateSubCategory($id, $cname, $curl, $dis, $pcat) {

        $data = array(
            'name' => $cname,
            'parentcat' => $pcat,
            'slug' => $curl,
            'description' => $dis,
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('subcategory', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function updateSubCategoryWImg($id, $cname, $curl, $dis, $pcat, $file_name) {

        $data = array(
            'name' => $cname,
            'parentcat' => $pcat,
            'slug' => $curl,
            'description' => $dis,
            'image' => $file_name
        );

        $this->db->where('id', $id);
        $quary = $this->db->update('subcategory', $data);
        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function deleteSubCat($id) {

        $this->db->where('id', $id);
        if ($this->db->delete('subcategory')) {
            return 'ok';
        } else {
            return 1;
        }
    }

    public function subCatByParent($id) {
        $this->db->select("*");
        $this->db->from('subcategory');
        $this->db->where('parentcat', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function maincatslug($slug) {
        $this->db->select("*");
        $this->db->from('maincategory');
        $this->db->where("slug", $slug);
        $query = $this->db->get();
        return $query->result();
    }

    public function subcatslug($slug) {
        $this->db->select("*");
        $this->db->from('subcategory');
        $this->db->where("slug", $slug);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCatURLS() {

        $this->db->select('slug');
        $query = $this->db->get('maincategory');
        return $query->result_array();
    }

    public function getSubCatURLS() {

        $this->db->select('slug');
        $query = $this->db->get('subcategory');
        return $query->result_array();
    }

}
