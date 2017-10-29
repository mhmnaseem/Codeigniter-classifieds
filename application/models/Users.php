<?php

class Users extends CI_Model {

    public function update_shop_view($id) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->select('ip');
        $this->db->from('users');
        $this->db->where('ip', $ip);
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            //don't update
        } else {
            $this->db->select('visits');
            $this->db->where('id', $id);
            $count = $this->db->get('users')->row();

            $data = array(
                'visits' => $count->visits + 1,
                'ip' => $ip
            );
            $this->db->where('id', $id);
            $this->db->update('users', $data);
        }
    }

    public function cron_email_sent($id) {

        $data = array(
            'email_shop_activation' => 1,
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('users', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function verify_user($user_name, $password) {

        $this->db->select('email, password, active');
        $this->db->from('users');
        $this->db->where('email', $user_name);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function userbyEmail($email) {

        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();

        if ($query->result()) {

            return $query->result();
        } else {

            return 1;
        }
    }

    public function check_active($user_name, $password) {

        $this->db->select('email, password, active');
        $this->db->from('users');
        $this->db->where('email', $user_name);
        $this->db->where('password', $password);
        $this->db->where('active', 1);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function userbyEmail_active($email) {

        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('active', 1);
        $query = $this->db->get();

        if ($query->result()) {

            return $query->result();
        } else {

            return 1;
        }
    }

    public function signup_admin($fname, $lname, $email, $password, $company, $mobile, $foget_pwd, $hash, $active, $utype) {

        $data = array(
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'password' => $password,
            'company' => $company,
            'mobile' => $mobile,
            'type' => $utype,
            'foget_pwd' => $foget_pwd,
            'reg_date' => date('Y-m-d'),
            'hash' => $hash,
            'active' => $active,
            'type' => $utype
        );

        if ($this->db->insert('users', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    public function signup_seller($fname, $lname, $email, $password, $company, $mobile, $foget_pwd, $hash, $active, $utype, $source, $district, $city) {

        $data = array(
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'password' => $password,
            'company' => $company,
            'mobile' => $mobile,
            'type' => $utype,
            'foget_pwd' => $foget_pwd,
            'reg_date' => date('Y-m-d'),
            'hash' => $hash,
            'active' => $active,
            'type' => $utype,
            'source' => $source,
            'user_district' => $district,
            'user_city' => $city,
        );

        if ($this->db->insert('users', $data)) {

            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    //	Automated Email Verification

    public function validate_email($email_address, $hash_code) {

        $this->db->select("email,hash");
        $this->db->from('users');
        $this->db->where('hash', $hash_code);
        $this->db->where('email', $email_address);
        $this->db->limit(1);
        $query = $this->db->get();

        $result = $query->result();
        $row = $query->row();


        if ($query->num_rows() === 1 && $row->hash) {


            $result = $this->activate_account($hash_code);

            if ($result === true) {

                return true;
            } else {
                //message
                return false;
            }
        } else {
            //message
            return false;
        }
    }

    private function activate_account($hash_code) {

        $data = array(
            'active' => 1
        );

        $this->db->where('hash', $hash_code);

        $this->db->update('users', $data);



        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            return false;
            // Message
        }
    }

    public function newpassword($id, $password, $foget_pwd) {

        $data = array(
            'password' => $password,
            'foget_pwd' => $foget_pwd
        );
        $this->db->where('id', $id);

        $quary = $this->db->update('users', $data);
        if ($quary) {

            return $this->db->insert_id();
        } else {

            return 1;
        }
    }

    public function recentusers() {

        $this->db->select("*");

        $this->db->from('users');

        $this->db->order_by("id", 'DESC');
        //$this->db->limit(5);
        $query = $this->db->get();

        return $query->result();
    }

    public function usershops() {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('shop_status', 1);
        $this->db->where('shop_expire >', $expire);
        $query = $this->db->get();
        return $query->result();
    }

    public function exportusers() {

        $this->db->select("*");

        $this->db->from('users');

        $this->db->order_by("id", 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function allAdminUsers() {

        $this->db->select("*");

        $this->db->from('users');
        $this->db->where('type', 'admin');
        $query = $this->db->get();

        return $query->result();
    }

    public function allSellerUsers() {

        $this->db->select("*");

        $this->db->from('users');
        $this->db->where('type', 'Seller');
        $query = $this->db->get();

        return $query->result();
    }

    public function allActiveUsers() {

        $this->db->select("*");

        $this->db->from('users');
        $this->db->where('active', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function deleteUsers($id) {

        $this->db->where('id', $id);



        if ($this->db->delete('users')) {

            return 'ok';
        } else {

            return 1;
        }
    }

    public function selectUser($id) {

        $this->db->select("*");

        $this->db->from('users');

        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->result();
    }

    public function singleUserBySlug($slug) {
        date_default_timezone_set('Asia/Colombo');
        $expire = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('name_slug', $slug);
        $this->db->where('shop_status', 1);
        $this->db->where('shop_expire >', $expire);
        $query = $this->db->get();
        return $query->result();
    }

    public function UserBySlug($slug) {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('name_slug', $slug);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateUser_admin($id, $fname, $lname, $company, $mobile, $utype, $status) {

        $data = array(
            'fname' => $fname,
            'lname' => $lname,
            'company' => $company,
            'mobile' => $mobile,
            'type' => $utype,
            'active' => $status,
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('users', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function updateSellerUser($id, $fname, $lname, $company, $mobile, $district, $city) {

        $data = array(
            'fname' => $fname,
            'lname' => $lname,
            'company' => $company,
            'mobile' => $mobile,
            'user_district' => $district,
            'user_city' => $city
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('users', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function verifyphone($id, $mobile) {

        $data = array(
            'mobile' => $mobile,
            'phone_verify' => 1
        );

        $this->db->where('id', $id);

        $quary = $this->db->update('users', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function update_profil_image($user_id, $file_name) {

        $data = array(
            'image' => $file_name
        );

        $this->db->where('id', $user_id);

        $quary = $this->db->update('users', $data);

        if ($quary) {

            return 'ok';
        } else {

            return false;
        }
    }

    public function allUsers() {

        $this->db->select("*");

        $this->db->from('users');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function checkpassword($id, $password) {

        $this->db->from('users');
        $this->db->where('id', $id);
        $this->db->where('password', $password);

        $quary = $this->db->get();
        if ($quary->num_rows() == 1) {

            return '1';
        } else {

            return false;
        }
    }

    public function updatepassword($id, $password, $foget_pwd) {

        $data = array(
            'password' => $password,
            'foget_pwd' => $foget_pwd
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return 1;
        } else {

            return false;
        }
    }

    public function checkvalidity($hash, $id) {
        $this->db->from('users');
        $this->db->where('hash', $hash);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checklink($link) {
        $this->db->from('users');
        $this->db->where('name_slug', $link);
        $query = $this->db->get();
        if ($query->num_rows() === 1) {

            return true;
        } else {

            return false;
        }
    }

    public function savelink_shop_create($link, $id) {
        date_default_timezone_set('Asia/Colombo');
        $post_date = date("Y/m/d H:i");
        $expire_date = date("Y/m/d H:i", strtotime($post_date . " +2 years"));


        $this->db->from('users');
        $this->db->where('name_slug', $link);
        $query = $this->db->get();
        if ($query->num_rows() === 1) {

            return false;
        } else {
            $data = array(
                'name_slug' => $link,
                'shop_status' => 1,
                'shop_expire' => $expire_date
            );
            $this->db->where('id', $id);


            if ($this->db->update('users', $data)) {

                return true;
            } else {

                return false;
            }
        }
    }

    public function savelink($link, $id) {
        $this->db->from('users');
        $this->db->where('name_slug', $link);
        $query = $this->db->get();
        if ($query->num_rows() === 1) {

            return false;
        } else {
            $data = array(
                'name_slug' => $link
            );
            $this->db->where('id', $id);


            if ($this->db->update('users', $data)) {

                return true;
            } else {

                return false;
            }
        }
    }

    public function savecompany($companyname, $id) {

        $data = array(
            'company' => $companyname
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return true;
        } else {

            return false;
        }
    }

    public function saveoverview($overview, $id) {

        $data = array(
            'overview' => $overview
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return true;
        } else {

            return false;
        }
    }

    public function saveaddress($address, $id) {

        $data = array(
            'address' => $address
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return true;
        } else {

            return false;
        }
    }

    public function savephone($phone, $id) {

        $data = array(
            'mobile' => $phone
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return true;
        } else {

            return false;
        }
    }

    public function savecoverimage($file_name, $id) {

        $data = array(
            'cover_image' => $file_name
        );
        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return true;
        } else {

            return false;
        }
    }

    public function storeopenclose($data, $id) {


        $this->db->where('id', $id);


        if ($this->db->update('users', $data)) {

            return true;
        } else {

            return false;
        }
    }

}
