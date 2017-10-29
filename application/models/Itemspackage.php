<?php

class Itemspackage extends CI_Model {

    public function update_package_view($id) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->select('ip');
        $this->db->from('items_package');
        $this->db->where('ip', $ip);
        $this->db->where('package_id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            //don't update
        } else {
            $this->db->select('views');
            $this->db->where('package_id', $id);
            $count = $this->db->get('items_package')->row();

            $data = array(
                'views' => $count->views + 1,
                'ip' => $ip
            );
            $this->db->where('package_id', $id);
            $this->db->update('items_package', $data);
        }
    }

    public function get_all_package_expire() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('items_package');
        $this->db->where('expire_date <', $expire);
        $this->db->group_start();
        $this->db->where("status = 'yes'");
        $this->db->or_where("status = 'edit'");
        $this->db->group_end();
        $query = $this->db->get();
        return $query->result_array();
    }

    public function cron_expire_package_email_sent($id) {

        $data = array(
            'email_expire' => 1,
        );

        $this->db->where('package_id', $id);

        $quary = $this->db->update('items_package', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function getPackURLS() {

        $this->db->select('slug');
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $query = $this->db->get('items_package');
        return $query->result_array();
    }

    public function add_item_package_seller($slug, $title, $theme, $description, $district, $city, $user_id, $post_date, $expire_date, $package_type, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes) {
        $data = array(
            'slug' => $slug,
            'title' => $title,
            'theme' => $theme,
            'description' => $description,
            'district' => $district,
            'city' => $city,
            'user_id' => $user_id,
            'status' => 'none',
            'post_date' => $post_date,
            'expire_date' => $expire_date,
            'package_type' => $package_type,
            'package_for' => $package_for,
            'venue' => $venue,
            'delivery_cost' => $delivery_cost,
            'service_charge' => $service_charge,
            'other_charges' => $other_charges,
            'party_hours' => $party_hours,
            'party_minutes' => $party_minutes,
            'children_min' => $children_min,
            'children_max' => $children_max,
            'adult_min' => $adult_min,
            'adult_max' => $adult_max,
            'child_age_min' => $child_age_min,
            'child_age_max' => $child_age_max,
            'childern_per_head' => $childern_per_head,
            'adult_per_head' => $adult_per_head,
            'package_price' => $package_price,
            'type_food_package' => $type_food_package,
            'no_persons_served' => $no_persons_served,
            'waiters_provided' => $waiters_provided,
            'food_per_head_charge' => $food_per_head_charge,
            'food_package_price' => $food_package_price,
            'food_plates' => $food_plates,
            'food_cups' => $food_cups,
            'food_straws' => $food_straws,
            'food_napkins' => $food_napkins,
            'food_cutlery' => $food_cutlery,
            'food_chafing_dishes' => $food_chafing_dishes
        );

        if ($this->db->insert('items_package', $data)) {

            $last_insert_id = $this->db->insert_id();

            $data_edit = array(
                'package_id' => $last_insert_id,
                'title' => $title,
                'theme' => $theme,
                'description' => $description,
                'district' => $district,
                'city' => $city,
                'package_for' => $package_for,
                'venue' => $venue,
                'delivery_cost' => $delivery_cost,
                'service_charge' => $service_charge,
                'other_charges' => $other_charges,
                'party_hours' => $party_hours,
                'party_minutes' => $party_minutes,
                'children_min' => $children_min,
                'children_max' => $children_max,
                'adult_min' => $adult_min,
                'adult_max' => $adult_max,
                'child_age_min' => $child_age_min,
                'child_age_max' => $child_age_max,
                'childern_per_head' => $childern_per_head,
                'adult_per_head' => $adult_per_head,
                'package_price' => $package_price,
                'type_food_package' => $type_food_package,
                'no_persons_served' => $no_persons_served,
                'waiters_provided' => $waiters_provided,
                'food_per_head_charge' => $food_per_head_charge,
                'food_package_price' => $food_package_price,
                'food_plates' => $food_plates,
                'food_cups' => $food_cups,
                'food_straws' => $food_straws,
                'food_napkins' => $food_napkins,
                'food_cutlery' => $food_cutlery,
                'food_chafing_dishes' => $food_chafing_dishes
            );


            $this->db->insert('items_package_edit', $data_edit);

            return $last_insert_id;
        } else {

            return false;
        }
    }

    public function uploaded_imgs($id) {
        $this->db->select('*');
        $this->db->from('items_package_gallery');
        $this->db->where('item_package_id', $id);
        return $this->db->count_all_results();
    }

    public function matched_images($id) {
        $this->db->select('*');
        $this->db->from('items_package_gallery');
        $this->db->where('item_package_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function find_delete_image($id) {
        $this->db->from('items_package_gallery');
        $this->db->where('package_gallery_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_image($data) {
        $this->db->insert('items_package_gallery', $data);
        return $this->db->insert_id();
    }

    public function item_activate_seller($id) {
        $data = array('status' => 'pending');
        $this->db->where('package_id', $id);
        $this->db->update('items_package', $data);
    }

/// package Linked Items models

    public function linkitem($package_id, $item, $max_item_inc, $item_extra_note) {
        $data = array(
            'package_id' => $package_id,
            'item_id' => $item,
            'max_item_inc' => $max_item_inc,
            'item_extra_note' => $item_extra_note,
        );

        if ($this->db->insert('items_package_linked', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function MachedLinkeditems($id) {

        $this->db->select("*");

        $this->db->from('items_package_linked');
        $this->db->where('item_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function packagelinkeditems($pid) {
        $this->db->select('*');
        $this->db->from('items_package_linked');
        $this->db->join('items', 'items_package_linked.item_id = items.id', 'left');
        $this->db->where('package_id', $pid);
        $query = $this->db->get();
        return $query->result();
    }

    public function itemsLinkedPackages($itemid) {
        $this->db->select('*');
        $this->db->from('items_package_linked');
        $this->db->join('items_package', 'items_package.package_id = items_package_linked.package_id', 'left');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->where('item_id', $itemid);
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

///

    public function allpackages() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();

        return $query->result();
    }

    public function pendingpackage($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_start();
        $this->db->where("items_package.status = 'pending'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where('items_package.user_id', $id);

        $this->db->group_by("items_package_gallery.item_package_id");


        $query = $this->db->get();

        return $query->result();
    }

    public function comparepackage($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*,items_package.title as pack_title,items_package_gallery.image as pack_image");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->join('venues', 'venues.venue_id = items_package.venue', 'left');
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where_in('items_package.package_id', $id);
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function allSellerPackages($uid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');

        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();

        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where('items_package.user_id', $uid);
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function packgeSlugTOId($slug) {
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->where("slug", $slug);
        $query = $this->db->get();
        return $query->result();
    }

    public function SelectedItemPackage($id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('users', 'items_package.user_id = users.id');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where('items_package.package_id', $id);
        $this->db->group_by("items_package_gallery.item_package_id");


        $query = $this->db->get();

        return $query->result();
    }

    public function SelectedItemPackageedit($id) {

        $this->db->select("*");
        $this->db->from('items_package_edit');
        $this->db->where('package_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function update_item_package_seller($id, $title, $theme, $description, $district, $city_id, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes) {
        $data = array(
            'title' => $title,
            'theme' => $theme,
            'description' => $description,
            'district' => $district,
            'city' => $city_id,
            'package_for' => $package_for,
            'venue' => $venue,
            'delivery_cost' => $delivery_cost,
            'service_charge' => $service_charge,
            'other_charges' => $other_charges,
            'party_hours' => $party_hours,
            'party_minutes' => $party_minutes,
            'children_min' => $children_min,
            'children_max' => $children_max,
            'adult_min' => $adult_min,
            'adult_max' => $adult_max,
            'child_age_min' => $child_age_min,
            'child_age_max' => $child_age_max,
            'childern_per_head' => $childern_per_head,
            'adult_per_head' => $adult_per_head,
            'package_price' => $package_price,
            'type_food_package' => $type_food_package,
            'no_persons_served' => $no_persons_served,
            'waiters_provided' => $waiters_provided,
            'food_per_head_charge' => $food_per_head_charge,
            'food_package_price' => $food_package_price,
            'food_plates' => $food_plates,
            'food_cups' => $food_cups,
            'food_straws' => $food_straws,
            'food_napkins' => $food_napkins,
            'food_cutlery' => $food_cutlery,
            'food_chafing_dishes' => $food_chafing_dishes
        );

        $this->db->where('package_id', $id);

        $quary = $this->db->update('items_package_edit', $data);

        if ($quary) {
            $data_edit = array(
                'status' => 'edit',
            );

            $this->db->where('package_id', $id);

            $this->db->update('items_package', $data_edit);
            return 'ok';
        } else {

            return false;
        }
    }

    public function update_item_package_admin($id, $title, $theme, $description, $district, $city_id, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes) {
        $data = array(
            'title' => $title,
            'theme' => $theme,
            'description' => $description,
            'district' => $district,
            'city' => $city_id,
            'package_for' => $package_for,
            'venue' => $venue,
            'delivery_cost' => $delivery_cost,
            'service_charge' => $service_charge,
            'other_charges' => $other_charges,
            'party_hours' => $party_hours,
            'party_minutes' => $party_minutes,
            'children_min' => $children_min,
            'children_max' => $children_max,
            'adult_min' => $adult_min,
            'adult_max' => $adult_max,
            'child_age_min' => $child_age_min,
            'child_age_max' => $child_age_max,
            'childern_per_head' => $childern_per_head,
            'adult_per_head' => $adult_per_head,
            'package_price' => $package_price,
            'type_food_package' => $type_food_package,
            'no_persons_served' => $no_persons_served,
            'waiters_provided' => $waiters_provided,
            'food_per_head_charge' => $food_per_head_charge,
            'food_package_price' => $food_package_price,
            'food_plates' => $food_plates,
            'food_cups' => $food_cups,
            'food_straws' => $food_straws,
            'food_napkins' => $food_napkins,
            'food_cutlery' => $food_cutlery,
            'food_chafing_dishes' => $food_chafing_dishes
        );

        $this->db->where('package_id', $id);

        $quary = $this->db->update('items_package', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function allItemPackageImages($id) {

        $this->db->select("*");

        $this->db->from('items_package_gallery');
        $this->db->where('item_package_id', $id);

        $query = $this->db->get();

        return $query->result();
    }

    public function deleteimagegallery($id) {

        $this->db->where('package_gallery_id', $id);
        $this->db->delete('items_package_gallery');
        return array('result' => $id);
    }

    public function deleteLinkedItem($id) {

        $this->db->where('linked_id', $id);

        if ($this->db->delete('items_package_linked')) {

            return 'ok';
        } else {

            return 1;
        }
    }

    public function deleteItemPackageBySlug($slug, $id) {

        $this->db->where('slug', $slug);

        if ($this->db->delete('items_package')) {

            $this->db->where('package_id', $id);
            $this->db->delete('items_package_edit');

            return 'ok';
        } else {

            return 1;
        }
    }

    public function deleteItemPackageById($id) {

        $this->db->where('package_id', $id);

        if ($this->db->delete('items_package')) {

            $this->db->where('package_id', $id);
            $this->db->delete('items_package_edit');

            return 'ok';
        } else {

            return 1;
        }
    }

    public function adminPendingItemsPackage() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->where("items_package.status = 'pending'");
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->group_by("items_package_gallery.item_package_id");

        $query = $this->db->get();
        return $query->result();
    }

    public function adminPendingItemsPackageEdit() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->where("items_package.status = 'edit'");
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->group_by("items_package_gallery.item_package_id");

        $query = $this->db->get();
        return $query->result();
    }

    public function packgeById($id) {
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->where("package_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function editPackgeById($id) {
        $this->db->select("*");
        $this->db->from('items_package_edit');
        $this->db->where("package_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function approvePackage($id, $val) {

        $data = array(
            'status' => $val
        );

        $this->db->where('package_id', $id);

        $quary = $this->db->update('items_package', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function approvePackageEdit($id, $title, $theme, $description, $district, $city, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes) {

        $data = array(
            'title' => $title,
            'theme' => $theme,
            'description' => $description,
            'district' => $district,
            'city' => $city,
            'package_for' => $package_for,
            'venue' => $venue,
            'delivery_cost' => $delivery_cost,
            'service_charge' => $service_charge,
            'other_charges' => $other_charges,
            'party_hours' => $party_hours,
            'party_minutes' => $party_minutes,
            'children_min' => $children_min,
            'children_max' => $children_max,
            'adult_min' => $adult_min,
            'adult_max' => $adult_max,
            'child_age_min' => $child_age_min,
            'child_age_max' => $child_age_max,
            'childern_per_head' => $childern_per_head,
            'adult_per_head' => $adult_per_head,
            'package_price' => $package_price,
            'type_food_package' => $type_food_package,
            'no_persons_served' => $no_persons_served,
            'waiters_provided' => $waiters_provided,
            'food_per_head_charge' => $food_per_head_charge,
            'food_package_price' => $food_package_price,
            'food_plates' => $food_plates,
            'food_cups' => $food_cups,
            'food_straws' => $food_straws,
            'food_napkins' => $food_napkins,
            'food_cutlery' => $food_cutlery,
            'food_chafing_dishes' => $food_chafing_dishes,
            'status' => 'yes'
        );

        $this->db->where('package_id', $id);

        $quary = $this->db->update('items_package', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function record_countall_party_Package() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('package_type', 'Party-Packages');

        return $this->db->count_all_results('items_package');
    }

    public function record_countall_party_package_filter($filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->group_start();
        $this->db->where('expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('package_type', 'Party-Packages');
        $this->db->like('theme', $filter, 'both');
        $this->db->group_end();
        return $this->db->count_all_results('items_package');
    }

    public function partyPackages($limit, $start) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items_package.slug as packslug, items_package.package_id as pack_id");
        $this->db->from('items_package');
        $this->db->where('items_package.package_type', 'Party-Packages');
        $this->db->join('province', 'items_package.district = province.id', 'left');
        $this->db->join('city', 'items_package.city = city.id', 'left');
        $this->db->join('users', 'items_package.user_id = users.id', 'left');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items_package.post_date', 'Desc');
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function partyPackagesFilter($limit, $start, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items_package.slug as packslug, items_package.package_id as pack_id");
        $this->db->from('items_package');

        $this->db->join('province', 'items_package.district = province.id', 'left');
        $this->db->join('city', 'items_package.city = city.id', 'left');
        $this->db->join('users', 'items_package.user_id = users.id', 'left');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_start();
        $this->db->where('items_package.package_type', 'Party-Packages');
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where('items_package.status', 'yes');
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->like('items_package.theme', $filter, 'both');
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items_package.post_date', 'Desc');
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function record_countall_food_Package() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->where('expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('package_type', 'Food-Packages');

        return $this->db->count_all_results('items_package');
    }

    public function foodPackages($limit, $start) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items_package.slug as packslug, items_package.package_id as pack_id");
        $this->db->from('items_package');
        $this->db->where('items_package.package_type', 'Food-Packages');
        $this->db->join('province', 'items_package.district = province.id', 'left');
        $this->db->join('city', 'items_package.city = city.id', 'left');
        $this->db->join('users', 'items_package.user_id = users.id', 'left');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items_package.post_date', 'Desc');
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function record_countall_food_Package_Filter($filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->group_start();
        $this->db->where('expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('package_type', 'Food-Packages');
        $this->db->like('theme', $filter, 'both');
        $this->db->group_end();
        return $this->db->count_all_results('items_package');
    }

    public function foodPackagesFilter($limit, $start, $filter) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');

        $this->db->select("*,items_package.slug as packslug, items_package.package_id as pack_id");
        $this->db->from('items_package');

        $this->db->join('province', 'items_package.district = province.id', 'left');
        $this->db->join('city', 'items_package.city = city.id', 'left');
        $this->db->join('users', 'items_package.user_id = users.id', 'left');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_start();
        $this->db->where('items_package.package_type', 'Food-Packages');
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where('items_package.status', 'yes');
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->like('items_package.theme', $filter, 'both');
        $this->db->group_end();
        $this->db->limit($limit, $start);
        $this->db->order_by('items_package.post_date', 'Desc');
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function singlePackBySlug($slug) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*,items_package.package_id as pack_id");
        $this->db->from('items_package');
        $this->db->join('province', 'items_package.district = province.id', 'left');
        $this->db->join('city', 'items_package.city = city.id', 'left');
        $this->db->join('users', 'items_package.user_id = users.id');
        $this->db->where('items_package.slug', $slug);
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_by("items_package_gallery.item_package_id");
        $query = $this->db->get();
        return $query->result();
    }

    public function relatedPack($packtype, $id) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->where('package_type', $packtype);
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_by("items_package_gallery.item_package_id");
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where_not_in('items_package.package_id', $id);
        $this->db->order_by("items_package.package_id", 'RANDOM');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

    public function alllinkeditems($id) {
        $this->db->select('*');
        $this->db->from('items_package_linked');
        $this->db->join('items', 'items_package_linked.item_id = items.id', 'left');
        $this->db->join('item_gallery', 'item_gallery.item_id = items_package_linked.item_id', 'left');
        $this->db->group_by("item_gallery.item_id");
        $this->db->where('items_package_linked.package_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

//    public function alllinkeditemsimages($id) {
//        $this->db->select('*');
//        $this->db->from('items_package_linked');
//        $this->db->join('item_gallery', 'item_gallery.item_id = items_package_linked.item_id', 'left');
//        $this->db->group_by("item_gallery.item_id");
//        $this->db->where('items_package_linked.package_id', $id);
//        $query = $this->db->get();
//        return $query->result();
//    }


    public function allSellerShopPackages($uid) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('items_package');
        $this->db->join('items_package_gallery', 'items_package.package_id = items_package_gallery.item_package_id', 'left');
        $this->db->group_start();
        $this->db->where("items_package.status = 'yes'");
        $this->db->or_where("items_package.status = 'edit'");
        $this->db->group_end();
        $this->db->where('items_package.expire_date >', $expire);
        $this->db->where('items_package.user_id', $uid);
        $this->db->group_by("items_package_gallery.item_package_id");
        $this->db->order_by('items_package.package_id', 'RANDOM');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

}
