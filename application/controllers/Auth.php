<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model(array('Users', 'Themes', 'Location'));
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library(array('email', 'form_validation', 'encrypt', 'user_agent', 'google_lib', 'facebook'));
    }

    public function index() {
        if ($this->google_lib->get_token()) {

            $this->google_sign();
        } else {
//
            $authUrl = $this->google_lib->get_url();


            $data['authUrl'] = $authUrl;

            $data['title'] = 'Seller Login | Birthdays.lk';

            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('public/header', $data);
            $this->load->view('public/login', $data);
            $this->load->view('public/footer');
        }
    }

    function google_sign() {

        $userData = $this->google_lib->get_userdata();

        $data['userData'] = $userData;

        $_SESSION['access_token'] = $this->google_lib->get_token();

        $useru = $this->Users->userbyEmail($userData->email);

        if ($useru != 1) {
            foreach ($useru as $user) {

                $data = array(
                    'user_name' => $user->fname,
                    'user_email' => $user->email,
                    'user_id' => $user->id,
                    'user_type' => $user->type,
                    'login_type' => "google"
                );

                $this->session->set_userdata($data);

                redirect('/dashboard');
            }
        } else {

            $fname = $userData->given_name;
            $lname = $userData->family_name;
            $email = $userData->email;
            $password = sha1('324234234234dfdssfd');
            $utype = "Seller";
            $company = "";
            $mobile = "";
            $foget_pwd = md5(rand(1, 10000000));
            $active = 1;
            $hash = sha1(rand(1000, 200000000));
            $source = "google";
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

            $insert_user = $this->Users->signup_seller($fname, $lname, $email, $password, $company, $mobile, $foget_pwd, $hash, $active, $utype, $source, $district, $city);

            if ($insert_user != '') {

                $data = array(
                    'user_name' => $fname,
                    'user_email' => $email,
                    'user_id' => $insert_user,
                    'user_type' => $utype,
                    'login_type' => "google"
                );
                $this->session->set_userdata($data);

                redirect('/dashboard');
            }
        }
    }

    public function login() {

        $user_name = $this->input->post('email');
        $password = sha1($this->input->post('password'));

        $result = $this->Users->verify_user($user_name, $password);

        if ($result === true) {

            $check_active = $this->Users->check_active($user_name, $password);

            if ($check_active === true) {

                $useru = $this->Users->userbyEmail_active($user_name);

                if ($useru != 1) {

                    foreach ($useru as $user) {

                        if ($user->password == $password) {

                            if ($user->type == 'Admin') {

                                $data = array(
                                    'user_name' => $user->fname,
                                    'user_id' => $user->id,
                                    'user_type' => $user->type
                                );

                                $this->session->set_userdata($data);

                                redirect('admin');
                            } else {

                                $data = array(
                                    'user_name' => $user->fname,
                                    'user_email' => $user->email,
                                    'user_id' => $user->id,
                                    'user_type' => $user->type,
                                );

                                $this->session->set_userdata($data);

                                redirect('dashboard');
                            }
                        } else {

                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>The email address or password you entered is not valid. Please enter the correct information. If you are not a registered member please sign up for a new account below.</span></div>');
                            redirect('login');
                        }
                    }
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>The email address or password you entered is not valid. Please enter the correct information. If you are not a registered member please sign up for a new account below.</span></div>');
                    redirect('login');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Please Activate Your Account with email we sent to you,</span></div>');
                redirect('login');
            }
        } else {

            if ($this->google_lib->get_token()) {

                $this->google_sign();
            } else {

                $authUrl = $this->google_lib->get_url();


                $data['authUrl'] = $authUrl;

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>The email address or password you entered is not valid. Please enter the correct information. If you are not a registered member please sign up for a new account below.</span></div>');

                $data['title'] = 'Seller Login | Birthdays.lk';


                $data['themes'] = $this->Themes->allThemes();
                $data['allprovinces'] = $this->Location->allprovinces();
                $this->load->view('public/header', $data);

                $this->load->view('public/login');

                $this->load->view('public/footer');
            }
        }
    }

    public function logout() {

        $array_items = array('user_name', 'user_id', 'user_type', 'login_type');
        $this->session->unset_userdata($array_items);

        $this->facebook->destroy_session();

        redirect('/login');
    }

// Unset session and logout

    public function glogout() {
        unset($_SESSION['access_token']);
        $array_items = array('user_name', 'user_id', 'user_type', 'login_type');
        $this->session->unset_userdata($array_items);
        redirect('/login');
    }

    public function register() {
        if ($this->input->post()) {

            $fname = $this->input->post('username1');
            $lname = $this->input->post('username2');
            $email = $this->input->post('email');
            $company = $this->input->post('company');
            $mobile = $this->input->post('mobile');
            $district = $this->input->post('province');
            $city = $this->input->post('city');

            $password = sha1($this->input->post('password'));
            $utype = 'Seller';
            $foget_pwd = md5(rand(1, 10000000));
            $hash = sha1(rand(1000, 200000000));
            $active = 0;
            $source = "direct";

            if (!empty($company)) {
                $title = $company;
            } else {
                $title = $fname . $lname;
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


            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');


            if ($this->form_validation->run() == false) {
                if ($this->google_lib->get_token()) {

                    $this->google_sign();
                } else {

                    $authUrl = $this->google_lib->get_url();


                    $data['authUrl'] = $authUrl;


                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><span>An account with that email address already exists. Please use a different email.</span></div>');
                    $data['themes'] = $this->Themes->allThemes();
                    $this->load->view('public/header', $data);
                    $this->load->view('public/register');
                    $this->load->view('public/footer');
                }
            } else {
                $insert_user = $this->Users->signup_seller($fname, $lname, $email, $password, $company, $mobile, $foget_pwd, $hash, $active, $utype, $source, $district, $city);
                if ($insert_user != '') {

                    $lname = $this->input->post('username2');

                    $email = $this->input->post('email');
                    $subject = 'Birthdays.lk new account activation.';
                    $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                    <p>Thank you for signing up with Birthdays.lk!</p>
<p>Your account has been created, you can login with the following credentials after you have activated your account by clicking the link below.</p>
<h4>Please click this link to activate your account: <a href="' . base_url('validate-email/') . $email . '/' . $hash . '"> CLICK TO ACTIVATE </a></h4>
<br>
<div style="color: black;padding: 15px 32px;text-decoration: none;font-size: 16px;
background-color: #ccc;"><br>
Username: ' . $email . '<br>
Password: Use the password created during the signup process<br>
</div>
<br>
<p>Thanks,<br>

The Birthdays.lk team</p>
';

                    $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');

                    $this->email->to($email);

                    $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');

                    $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

                <html xmlns="http://www.w3.org/1999/xhtml">

                <head>

                    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />

                    <title>' . html_escape($subject) . '</title>

                    <style type="text/css">

                        body {

                            font-family: Arial, Verdana, Helvetica, sans-serif;

                            font-size: 16px;

                        }

                    </style>

                </head>

                <body>



                ' . $message . '

                </body>

                </html>';

                    $this->email->subject($subject);

                    $this->email->message($body);

                    if ($this->email->send()) {

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>A verification email has been sent to your email address!. Please check your email and activate your account. Did not receive the activation mail yet? Please check the spam or junk folder of your email <br>Please add support@birthdays.lk to your email contact list to make sure you receive our mails to your inbox</span></div>');

                        redirect('/login');

                        //$this->load->view('public/footer');
                    } else {
                        $this->session->set_flashdata('message', 'Oops!Some Thing went horribly Wrong. Message not Send! We will look in to this governor. In the mean time please email us at support@birthdays.lk for additional support');
                        redirect('/login');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Error with Procssing.');
                    redirect('/login');
                }
            }
        } else {

            if ($this->google_lib->get_token()) {

                $this->google_sign();
            } else {

                $authUrl = $this->google_lib->get_url();


                $data['authUrl'] = $authUrl;


                $data['allprovinces'] = $this->Location->allprovinces();
                $data['themes'] = $this->Themes->allThemes();
                $this->load->view('public/header', $data);

                $this->load->view('public/register', $data);

                $this->load->view('public/footer');
            }
        }
    }

    public function validate_email($email_address, $hash_code) {
        trim($hash_code);
        $validated = $this->Users->validate_email($email_address, $hash_code);
        if ($validated === true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Your account is successfully activated..! Please login below.</span></div>');
            redirect('/login');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><span>Error: Your account activation failed. Please contact the site Admin.. or send us an email at : support@birthdays.lk !</span></div>');
            redirect('/login');
        }
    }

    public function forgotpassword() {

        if ($this->input->post()) {

            $email = $this->input->post('email');
            $useru = $this->Users->userbyEmail($email);

            if ($useru != 1) {

                foreach ($useru as $user) {

                    $code = $user->foget_pwd;
                }
                $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->to($email);
                $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');

                $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>We received a request to reset your password. Please find the details listed below.</p>

                Your Password Reset Code is  <br> <br>
                <div style="color: white;padding: 15px 32px;text-align: center; text-decoration: none;font-size: 16px;
background-color: #555555;">' . $code . '</div>
               <br>
               <h4><a href="' . base_url('change-password') . '"> Click  here </a> to reset your password</h4>
                   <br>
<p>Thanks,<br>

The Birthdays.lk team</p>';


                $this->email->subject('Password Reset Request : Birthdays.lk');

                $subject = 'Password Reset Request : Birthdays';

                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

                <html xmlns="http://www.w3.org/1999/xhtml">

                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />

                    <title>' . html_escape($subject) . '</title>

                    <style type="text/css">

                        body {

                            font-family: Arial, Verdana, Helvetica, sans-serif;

                            font-size: 16px;

                        }

                    </style>

                </head>

                <body>



                ' . $message . '

                </body>

                </html>';


                $this->email->message($body);

                if ($this->email->send()) {

                    if ($this->google_lib->get_token()) {

                        $this->google_sign();
                    } else {

                        $authUrl = $this->google_lib->get_url();


                        $data['authUrl'] = $authUrl;

                        $data['msg'] = '';

                        $data['msg'] = 'ok';

                        $data['themes'] = $this->Themes->allThemes();
                        $data['allprovinces'] = $this->Location->allprovinces();
                        $this->load->view('public/header', $data);
                        $this->load->view('public/forgotpassword', $data);

                        $this->load->view('public/footer');
                    }
                } else {

                    echo 'Error';
                }
            } else {
                if ($this->google_lib->get_token()) {

                    $this->google_sign();
                } else {

                    $authUrl = $this->google_lib->get_url();


                    $data['authUrl'] = $authUrl;

                    $data['msg'] = '';

                    $data['msg'] = 'error';

                    $data['themes'] = $this->Themes->allThemes();
                    $data['allprovinces'] = $this->Location->allprovinces();
                    $this->load->view('public/header', $data);

                    $this->load->view('public/forgotpassword', $data);

                    $this->load->view('public/footer');
                }
            }
        } else {

            if ($this->google_lib->get_token()) {

                $this->google_sign();
            } else {

                $authUrl = $this->google_lib->get_url();


                $data['authUrl'] = $authUrl;

                $data['msg'] = '';

                $data['themes'] = $this->Themes->allThemes();
                $data['allprovinces'] = $this->Location->allprovinces();
                $this->load->view('public/header', $data);

                $this->load->view('public/forgotpassword', $data);

                $this->load->view('public/footer');
            }
        }
    }

    public function newpwd() {

        if ($this->input->post()) {

            $email = $this->input->post('email');
            $password = sha1($this->input->post('password'));
            $code = $this->input->post('code');
            $useru = $this->Users->userbyEmail($email);

            if ($useru != 1) {

                foreach ($useru as $user) {

                    $usercode = $user->foget_pwd;

                    $id = $user->id;
                }

                if ($code == $usercode) {

                    $foget_pwd = md5(rand(1, 10000000));

                    $updatepwd = $this->Users->newpassword($id, $password, $foget_pwd);

                    if ($updatepwd != '1') {

                        $data['msg'] = 'ok';

                        $data['themes'] = $this->Themes->allThemes();
                        $data['allprovinces'] = $this->Location->allprovinces();
                        $this->load->view('public/header', $data);

                        $this->load->view('public/newpassword', $data);

                        $this->load->view('public/footer');
                    } else {

                        $data['themes'] = $this->Themes->allThemes();
                        $data['allprovinces'] = $this->Location->allprovinces();
                        $this->load->view('public/header', $data);

                        $this->load->view('public/fogotpassword', $data);

                        $this->load->view('public/footer');
                    }
                } else {
                    if ($this->google_lib->get_token()) {

                        $this->google_sign();
                    } else {

                        $authUrl = $this->google_lib->get_url();


                        $data['authUrl'] = $authUrl;

                        $data['msg'] = 'error';



                        $data['themes'] = $this->Themes->allThemes();
                        $data['allprovinces'] = $this->Location->allprovinces();
                        $this->load->view('public/header', $data);

                        $this->load->view('public/newpassword', $data);

                        $this->load->view('public/footer');
                    }
                }
            } else {

                if ($this->google_lib->get_token()) {

                    $this->google_sign();
                } else {

                    $authUrl = $this->google_lib->get_url();


                    $data['authUrl'] = $authUrl;

                    $data['msg'] = 'error';



                    $data['themes'] = $this->Themes->allThemes();
                    $data['allprovinces'] = $this->Location->allprovinces();
                    $this->load->view('public/header', $data);

                    $this->load->view('public/newpassword', $data);

                    $this->load->view('public/footer');
                }
            }
        } else {

            if ($this->google_lib->get_token()) {

                $this->google_sign();
            } else {

                $authUrl = $this->google_lib->get_url();


                $data['authUrl'] = $authUrl;

                $data['msg'] = '';

                $data['themes'] = $this->Themes->allThemes();
                $data['allprovinces'] = $this->Location->allprovinces();
                $this->load->view('public/header', $data);

                $this->load->view('public/newpassword', $data);

                $this->load->view('public/footer');
            }
        }
    }

}
