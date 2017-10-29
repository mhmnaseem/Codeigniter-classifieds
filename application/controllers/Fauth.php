<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fauth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library and url helper
        $this->load->library('facebook');
        $this->load->helper('url');
        $this->load->model('Users');
    }

    // ------------------------------------------------------------------------
    /**
     * Index page
     */
    public function index() {
        $this->load->view('public/header');
        $this->load->view('public/login');
        $this->load->view('public/footer');
    }

    // ------------------------------------------------------------------------
    /**
     * Web redirect login example page
     */
    public function web_login() {
        $data['user'] = array();
        $user = '';
        // Check if user is logged in
        if ($this->facebook->is_authenticated()) {
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=first_name,last_name,email');
            if (!isset($user['error'])) {
                $data['user'] = $user;
            }
        }
        $userArray = array();



        foreach ($data['user'] as $key => $value) {

            $userArray[] = $key = $value;
        }

        // print_r($userArray);
//        echo $first_name;
//        echo $last_name;
//        echo $email;
//        echo $id;

        $useru = $this->Users->userbyEmail($userArray[2]);

        //print_r($user_name);


        if ($useru != 1) {


            foreach ($useru as $user) {



                $data = array(
                    'user_name' => $user->fname,
                    'user_email' => $user->email,
                    'user_id' => $user->id,
                    'user_type' => $user->type,
                    'login_type' => "facebook"
                );

                $this->session->set_userdata($data);



                redirect('/dashboard');
            }
        } else {

            //create account
            $fname = $userArray[0];
            $lname = $userArray[1];
            $email = $userArray[2];
            $password = sha1('3453445sdfsfsdf');
            $utype = "Seller";
            $company = "";
            $mobile = "";
            $district = "";
            $city = "";
            if (!empty($fname)) {
                $title = $fname . $lname;
            } else {
                $title = explode("@", $email)[0];
                $fname = $title;
            }
            $config = array(
                'field' => 'name_slug',
                'title' => 'title',
                'table' => 'users',
                'id' => 'id',
            );
            $this->load->library('slug', $config);

            $data = array(
                'title' => $title
            );
            $data['name_slug'] = $this->slug->create_uri($data);
            $name_slug = $data['name_slug'];

            $foget_pwd = md5(rand(1, 10000000));
            $active = 1;
            $hash = sha1(rand(1000, 200000000));

            $source = "facebook";
            $insert_user = $this->Users->signup_seller($fname, $lname, $email, $password, $company, $mobile, $foget_pwd, $hash, $active, $utype, $source, $district, $city);

            if ($insert_user != '') {


                $data = array(
                    'user_name' => $fname,
                    'user_email' => $email,
                    'user_id' => $insert_user,
                    'user_type' => $utype,
                    'login_type' => "facebook"
                );

                $this->session->set_userdata($data);


                redirect('/dashboard');
            }
        }
    }

    // ------------------------------------------------------------------------
    /**
     * JS SDK login example
     */
    public function js_login() {
        // Load view
        $this->load->view('examples/js');
    }

    // ------------------------------------------------------------------------
    /**
     * AJAX request method for positing to facebook feed
     */
    public function post() {
        header('Content-Type: application/json');
        $result = $this->facebook->request('post', '/me/feed', array('message' => $this->input->post('message')));
        echo json_encode($result);
    }

    // ------------------------------------------------------------------------
    /**
     * Logout for web redirect example
     *
     * @return  [type]  [description]
     */
    public function logout() {

        $array_items = array('user_name', 'user_id', 'user_type', 'login_type');



        $this->session->unset_userdata($array_items);

        $this->facebook->destroy_session();

        // redirect('Oauth/web_login', redirect);
        redirect('login');
    }

}
