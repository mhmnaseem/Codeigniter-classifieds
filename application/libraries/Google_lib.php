<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Google_lib {

    var $token;
    var $url;
    var $userData;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->config->load('google');


        require_once 'google/vendor/autoload.php';


// Create Client Request to access Google API

        $client = new Google_Client();

        $client->setApplicationName("birthdays");
        $client->setClientId($this->ci->config->item('Google_client_id'));
        $client->setClientSecret($this->ci->config->item('Google_client_secret'));
        $client->setRedirectUri($this->ci->config->item('Google_login_redirect_url'));
        $client->setDeveloperKey($this->ci->config->item('Google_simple_api_key'));
        $client->addScope("email");
        $client->addScope("profile");



// Send Client Request

        $objOAuthService = new Google_Service_Oauth2($client);


// Add Access Token to Session

        if (isset($_GET['code'])) {

            $client->authenticate($_GET['code']);

            $_SESSION['access_token'] = $client->getAccessToken();

            header('Location: ' . filter_var($this->ci->config->item('Google_login_redirect_url'), FILTER_SANITIZE_URL));
        }




// Set Access Token to make Request

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

            $client->setAccessToken($_SESSION['access_token']);
        }
        // Get User Data from Google and store them in $data


        if ($client->getAccessToken()) {

            $this->token = $client->getAccessToken();

            $this->userData = $objOAuthService->userinfo->get();
        } else {

            $this->url = $client->createAuthUrl();
        }
    }

    public function get_token() {
        return $this->token;
    }

    public function get_url() {
        return $this->url;
    }

    public function get_userdata() {
        return $this->userData;
    }

}
