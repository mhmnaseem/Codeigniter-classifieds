<?php

class Items extends CI_Model {

    public function update_item_view($id) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->select('ip');
        $this->db->from('items');
        $this->db->where('ip', $ip);
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            //don't update
        } else {
            $this->db->select('views');
            $this->db->where('id', $id);
            $count = $this->db->get('items')->row();

            $data = array(
                'views' => $count->views + 1,
                'ip' => $ip
            );
            $this->db->where('id', $id);
            $this->db->update('items', $data);
        }
    }

    public function get_all_items_expire() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where('exp_date <', $expire);
        $this->db->group_start();
        $this->db->where("status = 'yes'");
        $this->db->or_where("status = 'edit'");
        $this->db->group_end();
        $query = $this->db->get();
        return $query->result_array();
    }

    public function cron_expire_item_email_sent($id) {

        $data = array(
            'email_expire' => 1,
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('items', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function count_total_items_user($uid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('exp_date >', $expire);
        $this->db->where('user_id', $uid);
        $this->db->group_start();
        $this->db->where("status = 'yes'");
        $this->db->or_where("status = 'edit'");
        $this->db->group_end();

        return $this->db->count_all_results('items');
    }

    public function count_total_items_all_user() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select('users.id as uid,fname,lname,email,hash,email_shop_activation, COUNT(*) AS number_of_items');
        $this->db->from('items');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->join('users', 'items.user_id = users.id');
        $this->db->group_by("users.id");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getItemURLS() {

        $this->db->select('slug');
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $query = $this->db->get('items');
        return $query->result_array();
    }

    public function usermacheditems($id) {

        $this->db->select("*,items.id as itemid");

        $this->db->from('items');
        $this->db->where('items.user_id', $id);
        $this->db->join('users', 'items.user_id = users.id');

        $query = $this->db->get();

        return $query->result();
    }

    public function usermachedpackages($id) {

        $this->db->select("*");

        $this->db->from('items_package');
        $this->db->where('items_package.user_id', $id);
        $this->db->join('users', 'items_package.user_id = users.id');

        $query = $this->db->get();

        return $query->result();
    }

    public function recentItems() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.exp_date >', $expire);
        $this->db->order_by('items.id', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $this->db->limit(12);

        $query = $this->db->get();

        return $query->result();
    }

    public function recentItems_filter($filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->like('items.theme', $filter, 'both');
        $this->db->where('items.exp_date >', $expire);
        $this->db->order_by('items.id', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $this->db->limit(12);

        $query = $this->db->get();

        return $query->result();
    }

    public function allItems() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_by("item_gallery.item_id");


        $query = $this->db->get();

        return $query->result();
    }

    public function allSellerItems($uid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.exp_date >', $expire);
        $this->db->where('items.user_id', $uid);
        $this->db->group_by("item_gallery.item_id");


        $query = $this->db->get();

        return $query->result();
    }

    public function allSellerPackageItems($uid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where("items.package = 'yes'");
        $this->db->where('items.exp_date >', $expire);
        $this->db->where('items.user_id', $uid);
        $this->db->order_by('items.title', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function SelectedItem($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('users', 'items.user_id = users.id');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->where('items.id', $id);
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function SelectedItemedit($id) {
        $this->db->select("*");
        $this->db->from('items_edit');
        $this->db->where('item_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function singleItemBySlug($slug) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*,items.id as item_id");
        $this->db->from('items');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->join('users', 'items.user_id = users.id');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where("items.status = 'yes'");
        $this->db->where('items.slug', $slug);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();

        return $query->result();
    }

    public function allItemImages($id) {

        $this->db->select("*");

        $this->db->from('item_gallery');
        $this->db->where('item_id', $id);

        $query = $this->db->get();

        return $query->result();
    }

    public function addItem($slug, $cat, $title, $des, $price, $user_id, $post_date, $expire_date) {
        $data = array(
            'slug' => $slug,
            'category' => $cat,
            'title' => $title,
            'description' => $des,
            'price' => $price,
            'user_id' => $user_id,
            'status' => 'none',
            'post_date' => $post_date,
            'exp_date' => $expire_date
        );

        if ($this->db->insert('items', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function addItem_seller($slug, $cat, $title, $des, $pprice, $rprice, $package, $theme, $district, $city, $user_id, $post_date, $expire_date) {
        $data = array(
            'slug' => $slug,
            'category' => $cat,
            'title' => $title,
            'description' => $des,
            'pprice' => $pprice,
            'rprice' => $rprice,
            'package' => $package,
            'theme' => $theme,
            'district' => $district,
            'city' => $city,
            'user_id' => $user_id,
            'status' => 'none',
            'post_date' => $post_date,
            'exp_date' => $expire_date
        );

        if ($this->db->insert('items', $data)) {

            $last_insert_id = $this->db->insert_id();

            $data_edit = array(
                'item_id' => $last_insert_id,
                'slug' => $slug,
                'category' => $cat,
                'title' => $title,
                'description' => $des,
                'pprice' => $pprice,
                'rprice' => $rprice,
                'package' => $package,
                'theme' => $theme,
                'district' => $district,
                'city' => $city,
                'status' => 'none'
            );

            $this->db->insert('items_edit', $data_edit);

            return $last_insert_id;
        } else {

            return false;
        }
    }

    public function insert_image($data) {
        $this->db->insert('item_gallery', $data);
        return $this->db->insert_id();
    }

    public function item_activate($id) {
        $data = array('status' => 'yes');
        $this->db->where('id', $id);
        $this->db->update('items', $data);
    }

    public function item_activate_seller($id) {
        $data = array('status' => 'pending');
        $this->db->where('id', $id);
        $this->db->update('items', $data);
    }

    public function updateItem($id, $cat, $title, $des, $price) {
        $data = array(
            'category' => $cat,
            'title' => $title,
            'description' => $des,
            'price' => $price,
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('items', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function updateItem_seller($id, $newslug, $title, $des, $pprice, $rprice, $package, $theme, $district, $city, $category) {
        $data = array(
            'title' => $title,
            'slug' => $newslug,
            'description' => $des,
            'pprice' => $pprice,
            'rprice' => $rprice,
            'package' => $package,
            'theme' => $theme,
            'district' => $district,
            'city' => $city,
            'category' => $category,
            'status' => 'edit'
        );

        $this->db->where('item_id', $id);

        $quary = $this->db->update('items_edit', $data);

        if ($quary) {

            $data_edit = array(
                'status' => 'edit',
            );

            $this->db->where('id', $id);

            $this->db->update('items', $data_edit);

            return 'ok';
        } else {

            return false;
        }
    }

    public function updateItem_admin($id, $title, $des, $pprice, $rprice, $package, $theme, $district, $city, $category) {
        $data = array(
            'title' => $title,
            'description' => $des,
            'pprice' => $pprice,
            'rprice' => $rprice,
            'package' => $package,
            'theme' => $theme,
            'district' => $district,
            'city' => $city,
            'category' => $category,
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('items', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function deleteItem($id) {

        $this->db->where('id', $id);

        if ($this->db->delete('items')) {

            $this->db->where('item_id', $id);
            $this->db->delete('items_edit');

            return 'ok';
        } else {

            return 1;
        }
    }

    public function deleteimagegallery($id) {

        $this->db->where('gallery_id', $id);
        $this->db->delete('item_gallery');
        return array('result' => $id);
    }

    public function deleteimagegallery_seller($id) {

        $this->db->where('gallery_id', $id);
        $this->db->delete('item_gallery');
        return array('result' => $id);
    }

    public function uploaded_imgs($id) {
        $this->db->select('*');
        $this->db->from('item_gallery');
        $this->db->where('item_id', $id);
        return $this->db->count_all_results();
    }

    public function matched_images($id) {
        $this->db->select('*');
        $this->db->from('item_gallery');
        $this->db->where('item_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function find_delete_image($id) {
        $this->db->from('item_gallery');
        $this->db->where('gallery_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_countall_subcat($catid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where_in('subcategory.id', $catid);
        $this->db->join('subcategory', 'items.category = subcategory.id');

        return $this->db->count_all_results('items');
    }

    public function record_countall($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');

        return $this->db->count_all_results('items');
    }

    public function record_countall_filter($id, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->group_start();
        $this->db->where('items.exp_date >', $expire);
        $this->db->like('items.theme', $filter, 'both');
        $this->db->where_in('subcategory.parentcat', $id);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->join('subcategory', 'items.category = subcategory.id');

        return $this->db->count_all_results('items');
    }

    public function record_countall_maincat($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');

        return $this->db->count_all_results('items');
    }

    public function allItemsallcat_maincat_filter($id, $limit, $start, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');

        $this->db->group_start();
        $this->db->where('items.exp_date >', $expire);
        $this->db->where('subcategory.parentcat', $id);
        $this->db->like('items.theme', $filter, 'both');
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function allItemsallcat_maincat($id, $limit, $start) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->where('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function allItemsallcatsort_maincat($id, $limit, $start, $sort) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->where('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        if ($sort == 'date') {
            $this->db->order_by('items.id', 'desc');
        } elseif ($sort == 'price') {
            $this->db->order_by('items.price', 'ASC');
        }

        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();


        return $query->result();
    }

    public function record_countall_home_main_cat($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where_in('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');

        return $this->db->count_all_results('items');
    }

    public function record_countall_home_main_cat_filter($id, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->group_start();
        $this->db->where('items.exp_date >', $expire);
        $this->db->like('items.theme', $filter, 'both');
        $this->db->where_in('subcategory.parentcat', $id);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->join('subcategory', 'items.category = subcategory.id');

        return $this->db->count_all_results('items');
    }

    public function homeMainCat($id, $limit, $start) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug, items.id as item_id");
        $this->db->from('items');
        $this->db->where_in('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function homeMainCatFilter($id, $limit, $start, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');

        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');

        $this->db->group_start();
        $this->db->where_in('subcategory.parentcat', $id);
        $this->db->where('items.exp_date >', $expire);
        $this->db->like('items.theme', $filter, 'both');
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function allItemsallcatsort($id, $limit, $start, $sort) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->where_in('subcategory.parentcat', $id);
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('province', 'items.district = province.id', 'inner');
        $this->db->join('city', 'items.city = city.id', 'inner');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        if ($sort == 'date') {
            $this->db->order_by('items.id', 'desc');
        } elseif ($sort == 'price') {
            $this->db->order_by('items.price', 'ASC');
        }

        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();


        return $query->result();
    }

    public function record_countall_subcat_items_filter($catid, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->group_start();
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->like('items.theme', $filter, 'both');
        $this->db->where('items.category', $catid);
        $this->db->group_end();

        return $this->db->count_all_results('items');
    }

    public function record_countall_subcat_items($catid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.category', $catid);
        return $this->db->count_all_results('items');
    }

    public function allItems_sub_cat($id, $limit, $start) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->where('items.category', $id);
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function allItems_sub_cat_filter($id, $limit, $start, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');

        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->group_start();
        $this->db->where('items.category', $id);
        $this->db->where('items.exp_date >', $expire);
        $this->db->like('items.theme', $filter, 'both');
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function pendingItems($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_start();
        $this->db->where("items.status = 'pending' ");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.exp_date >', $expire);
        $this->db->where('items.user_id', $id);

        $this->db->group_by("item_gallery.item_id");


        $query = $this->db->get();

        return $query->result();
    }

    public function adminPendingItems() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where("items.status = 'pending'");
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function adminPendingItemsEdits() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where("items.status = 'edit'");
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function approveItem($id, $val) {

        $data = array(
            'status' => $val
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('items', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function approveItemEdit($id, $title, $category, $description, $rprice, $pprice, $package, $district, $city, $theme) {

        $data = array(
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'rprice' => $rprice,
            'pprice' => $pprice,
            'package' => $package,
            'district' => $district,
            'city ' => $city,
            'theme ' => $theme,
            'status' => 'yes'
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('items', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function itemById($id) {
        $this->db->select("*");
        $this->db->from('items');
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function itemEditById($id) {
        $this->db->select("*");
        $this->db->from('items_edit');
        $this->db->where("item_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function itemSlugTOId($slug) {
        $this->db->select("*");
        $this->db->from('items');
        $this->db->where("slug", $slug);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteItemBySlug($slug, $id) {

        $this->db->where('slug', $slug);

        if ($this->db->delete('items')) {

            $this->db->where('item_id', $id);
            $this->db->delete('items_edit');

            return 'ok';
        } else {

            return 1;
        }
    }

    public function compare($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.exp_date >', $expire);
        $this->db->where_in('items.id', $id);
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();

        return $query->result();
    }

    //fetch search items
    function get_items($start, $limit, $theme, $district, $search = NULL) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        if ($search == "NIL") {
            $search = "";
        }


        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->group_start();
        //$this->db->like('items.title', $search, 'both');
        // $this->db->or_like('items.description', $search, 'both');
        $searchTerms = explode(' ', $search);
        $i = 0;
        foreach ($searchTerms as $term) {
            $term = trim($term);
            if (!empty($term)) {
                if ($i == 0) {
                    $this->db->like('items.title', $term, 'both');
                    $this->db->or_like('items.description', $term, 'both');
                } else {
                    $this->db->or_like('items.title', $term, 'both');
                    $this->db->or_like('items.description', $term, 'both');
                }
            }
            $i++;
        }
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($start, $limit);
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('province', 'items.district = province.id', 'left');
        $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('exp_date >', $expire);

        if ($theme != "ALL") {
            $this->db->where('items.theme', $theme);
        }
        if ($district != "ALL") {
            $this->db->where('items.district', $district);
        }
        $this->db->order_by("items.post_date", 'desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    function get_items_count($theme, $district, $st = NULL) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        if ($st == "NIL") {
            $st = "";
        }
        $this->db->select("*,items.slug as itemslug");
        $this->db->from('items');
        $this->db->group_start();
        //$this->db->like('items.title', $st, 'both');
        //$this->db->or_like('items.description', $st, 'both');
        $searchTerms = explode(' ', $st);
        $i = 0;
        foreach ($searchTerms as $term) {
            $term = trim($term);
            if (!empty($term)) {
                if ($i == 0) {
                    $this->db->like('items.title', $term, 'both');
                    $this->db->or_like('items.description', $term, 'both');
                } else {
                    $this->db->or_like('items.title', $term, 'both');
                    $this->db->or_like('items.description', $term, 'both');
                }
            }
            $i++;
        }
        $this->db->group_end();
        $this->db->where('exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->join('subcategory', 'items.category = subcategory.id');
        // $this->db->join('province', 'items.district = province.id', 'left');
        // $this->db->join('city', 'items.city = city.id', 'left');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        if ($theme != "ALL") {
            $this->db->where('items.theme', $theme);
        }
        if ($district != "ALL") {
            $this->db->where('items.district', $district);
        }
        $this->db->order_by("post_date", 'desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_live_items($search_data, $district, $theme) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("title,slug,image");
        $this->db->from('items');
        $this->db->group_start();
        //$this->db->like('title', $search_data, 'both');
        //$this->db->or_like('description', $search_data, 'both');

        $searchTerms = explode(' ', $search_data);
        $i = 0;
        foreach ($searchTerms as $term) {
            $term = trim($term);
            if (!empty($term)) {
                if ($i == 0) {
                    $this->db->like('items.title', $term, 'both');
                    $this->db->or_like('items.description', $term, 'both');
                } else {
                    $this->db->or_like('items.title', $term, 'both');
                    $this->db->or_like('items.description', $term, 'both');
                }
            }
            $i++;
        }
        $this->db->group_end();
        //$this->db->join('province', 'items.district = province.id', 'left');
        //$this->db->join('city', 'items.city = city.id', 'left');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        if ($theme != "ALL") {
            $this->db->where('items.theme', $theme);
        }
        if ($district != "ALL") {
            $this->db->where('items.district', $district);
        }
        $this->db->limit(10);
        $this->db->order_by("post_date", 'desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function relatedItems($parentcatid, $id, $theme) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items.slug as item_slug");
        $this->db->from('items');
        $this->db->join('subcategory', 'items.category = subcategory.id');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->group_by("item_gallery.item_id");
        $this->db->where('subcategory.parentcat', $parentcatid);
        $this->db->where_not_in('items.id', $id);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where("items.theme", $theme);
        $this->db->where('items.exp_date >', $expire);
        $this->db->order_by("id", 'RANDOM');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

    public function findParentCat($id) {
        $this->db->select("parentcat");
        $this->db->from('subcategory');
        $this->db->where('subcategory.id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function slugTOcat() {
        $this->db->select("*,maincategory.slug as mslug");
        $this->db->from('maincategory');
        $this->db->join('subcategory', 'maincategory.mcatid = subcategory.parentcat');
        $query = $this->db->get();
        return $query->result();
    }

    public function record_countall_item_shop($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('user_id', $id);
        return $this->db->count_all_results('items');
    }

    public function shopItems($id, $limit, $start) {


        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*,(SELECT image FROM item_gallery WHERE item_id = items.id ORDER BY gallery_id ASC LIMIT 1) AS profile_img");
        $this->db->from('items');
        $this->db->join('item_gallery', 'items.id = item_gallery.item_id', 'left');
        $this->db->where('items.exp_date >', $expire);
        $this->db->group_start();
        $this->db->where("items.status = 'yes'");
        $this->db->or_where("items.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items.user_id', $id);
        $this->db->limit($limit, $start);
        $this->db->order_by('items.post_date', 'Desc');
        $this->db->group_by("item_gallery.item_id");
        $query = $this->db->get();
        return $query->result();
    }

}
