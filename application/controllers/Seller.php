<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library(array('email', 'form_validation', 'image_lib', 'encrypt'));
        $this->load->model(array('Category', 'Users', 'Items', 'Themes', 'Location', 'Venues', 'Itemspackage'));
    }

    // ------------------------------------------------------------------------
    /**
     * Index page
     */
    public function index() {
        $userId = $this->session->userdata('user_id');

        $data['pendingitem'] = $this->Items->pendingItems($userId);
        $numofitems = $this->Items->count_total_items_user($userId);
        $data['pendingpackage'] = $this->Itemspackage->pendingpackage($userId);
        $data['user'] = $this->Users->selectUser($userId);
        foreach ($data['user'] as $user) {
            $active = $user->shop_status;
            $hash = $user->hash;
            $link = $user->name_slug;
        }
        $data['totalitems'] = $numofitems;
        $data['shopactive'] = $active;
        $data['hash'] = $hash;
        $data['link'] = $link;
        $data['allprovinces'] = $this->Location->allprovinces();
        $this->load->view('seller/header', $data);
        $this->load->view('seller/index', $data);
        $this->load->view('public/footer');
    }

    public function editprofile() {

        $userId = $this->session->userdata('user_id');

        if ($this->input->post('action') == "update") {

            $fname = $this->input->post('username1');
            $lname = $this->input->post('username2');
            $company = $this->input->post('company');
            $mobile = $this->input->post('mobile');
            $city_id = $this->input->post('city');


            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }

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
            $data['name_slug'] = $this->slug->create_uri($data, $userId);
            $name_slug = $data['name_slug'];


            $updateuser = $this->Users->updateSellerUser($userId, $fname, $lname, $company, $mobile, $district, $city_id);

            if ($updateuser != '') {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Account Updated Successfully..!</span></div>');

                redirect("profile");
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Updating Account..!</span></div>');
                redirect("profile");
            }
        } else {

            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/edituser', $data);
            $this->load->view('public/footer');
        }
    }

    public function addItem() {
        $user_id = $this->session->userdata('user_id');
        if ($this->input->post()) {

            $cat = $this->input->post('scat');
            $title = $this->input->post('title');
            $des = $this->input->post('description');
            $pprice = $this->input->post('pprice');
            $rprice = $this->input->post('rprice');
            $package = $this->input->post('package');
            $theme = $this->input->post('theme');
            $city_id = $this->input->post('city');



            //get province_id

            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }

            $config = array(
                'field' => 'slug',
                'title' => 'title',
                'table' => 'items',
                'id' => 'id',
            );
            $this->load->library('slug', $config);

            $data = array(
                'title' => $title
            );
            $data['slug'] = $this->slug->create_uri($data);
            $slug = $data['slug'];
            date_default_timezone_set('Asia/Colombo');
            $post_date = date("Y/m/d H:i");
            $expire_date = date("Y/m/d H:i", strtotime($post_date . " + 180 days"));


            $additem = $this->Items->addItem_seller($slug, $cat, $title, $des, $pprice, $rprice, $package, $theme, $district, $city_id, $user_id, $post_date, $expire_date);

            if ($additem != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Upload Pictures * (Pleae make sure you upload real pictures of the item. In case you don\'t have a real picture or  If it\'s a Item/service, please upload the business logo)"</span></div>');
                $this->session->set_userdata('product_id', $additem);
                redirect("post-image");
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error adding Item...!</span></div>');
                redirect("post-item");
            }
        } else {


            $usercities = $this->Users->selectUser($user_id);

            foreach ($usercities as $usercity) {
                $user_city = $usercity->user_city;
            }
            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);

            $data['user_city'] = $user_city;
            $data['mcats'] = $this->Category->allcats();
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $this->load->view('seller/additem', $data);
            $this->load->view('public/footer');
        }
    }

    public function addImage() {
        if ($this->session->has_userdata('product_id')) {

            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;

            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/additemimage');
            $this->load->view('public/footer');
        } else {
            redirect("post-item");
        }
    }

    public function validate_image_upload() {
        $result = $this->Items->uploaded_imgs($this->session->userdata('product_id'));
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
    }

    public function imageUpload() {
        $result = $this->Items->uploaded_imgs($this->session->userdata('product_id'));
        if ($result < 5) {
            //$file_name = null;
            $file = $_FILES['file'];

            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/items",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => 5120,
                    'quality' => "100%",
                    'encrypt_name' => TRUE,
                    'width' => 600,
                    'height' => 450
                );



                $file_name = "";
                $this->load->library('upload', $upload_data);

                if ($this->upload->do_upload('file')) {


                    $uploaded_file = $this->upload->data();

                    $this->resize_crop($uploaded_file['full_path'], $upload_data["width"], $upload_data["height"]);


                    $file_name = $uploaded_file['file_name'];

                    $id = $this->session->userdata('product_id');
                    //$file_name = base_url() . 'files/item_gallery/' . $file_name;
                    $img_data = array('image' => $file_name, 'item_id' => $id);
                    $image_id = $this->Items->insert_image($img_data);

                    // activate posting if user upload images then put in pending
                    $this->Items->item_activate_seller($id);
                    $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('id' => $image_id)));
                }
            }
        }
    }

    public function addSubmit() {
        $this->session->unset_userdata('product_id');
        $this->session->unset_userdata('package_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Your item/package has been submitted for review. It will display on the website once approved ( and we will notify you by email)</span></div>');
        redirect("dashboard");
    }

    public function cancel_item_post() {
        $id = $this->session->userdata('product_id');
        //delete matched images
        $matchedimages = $this->Items->matched_images($id);
        foreach ($matchedimages as $mimage) {

            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

            $this->db->where('gallery_id', $mimage->gallery_id);
            $this->db->delete('item_gallery');
        }

        $delete_Item = $this->Items->deleteItem($id);

        if ($delete_Item != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Your item has been Canceled</span></div>');
            $this->session->unset_userdata('product_id');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Item..!</span></div>');
            $this->session->unset_userdata('product_id');
            redirect('dashboard');
        }
    }

    public function cancel_item_post_back_button() {
        $id = $this->session->userdata('product_id');
        //delete matched images
        $matchedimages = $this->Items->matched_images($id);
        foreach ($matchedimages as $mimage) {

            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

            $this->db->where('gallery_id', $mimage->gallery_id);
            $this->db->delete('item_gallery');
        }

        $this->Items->deleteItem($id);
        $this->session->unset_userdata('product_id');
    }

    public function cancel_package_post() {
        $id = $this->session->userdata('package_id');
        //delete matched images

        $matchedimages = $this->Itemspackage->matched_images($id);
        foreach ($matchedimages as $mimage) {

            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

            $this->db->where('package_gallery_id', $mimage->package_gallery_id);
            $this->db->delete('items_package_gallery');
        }

        $delete_Item_Package = $this->Itemspackage->deleteItemPackageById($id);

        if ($delete_Item_Package != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item Package has been Canceled</span></div>');
            $this->session->unset_userdata('package_id');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Item Package..!</span></div>');
            $this->session->unset_userdata('package_id');
            redirect('dashboard');
        }
    }

    public function cancel_package_post_back_button() {
        $id = $this->session->userdata('package_id');
        //delete matched images

        $matchedimages = $this->Itemspackage->matched_images($id);
        foreach ($matchedimages as $mimage) {

            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

            $this->db->where('package_gallery_id', $mimage->package_gallery_id);
            $this->db->delete('items_package_gallery');
        }

        $this->Itemspackage->deleteItemPackageById($id);
        $this->session->unset_userdata('package_id');
    }

    public function getsubcats() {
        if (isset($_POST['category_id'])) {
            // echo $_POST['category_id']['category_id'];
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Category->subCatByParent($_POST['category_id'])));

            // print_r($this->Category->subCatByParent($_POST['category_id']['category_id']));
        }
    }

    public function getcity() {

        if (isset($_POST['province_id'])) {
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Location->selectcitys($_POST['province_id'])));
        }
    }

    public function EditItem($slug) {

        $result = $this->Items->itemSlugTOId($slug);
        foreach ($result as $item) {
            $id = $item->id;
            $item_user_id = $item->user_id;
        }
        if ($this->input->post()) {
            $title = $this->input->post('title');
            $des = $this->input->post('description');
            $pprice = $this->input->post('pprice');
            $rprice = $this->input->post('rprice');
            $package = $this->input->post('package');
            $theme = $this->input->post('theme');
            $category = $this->input->post('category');
            $city_id = $this->input->post('city');

            $config = array(
                'field' => 'slug',
                'title' => 'title',
                'table' => 'items',
                'id' => 'id',
            );
            $this->load->library('slug', $config);

            $data = array(
                'title' => $title
            );
            $data['slug'] = $this->slug->create_uri($data, $id);
            $newslug = $data['slug'];

            //get province_id

            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }


            $user_id = $this->session->userdata('user_id');
            if ($item_user_id == $user_id) {
                $updateitem = $this->Items->updateItem_seller($id, $newslug, $title, $des, $pprice, $rprice, $package, $theme, $district, $city_id, $category);

                if ($updateitem != '') {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Your changes have been submitted for review.Once approved,the changes wll be applied</span></div>');

                    redirect("edit-item/" . $slug);
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error Updating Item...!</span></div>');
                    $userId = $this->session->userdata('user_id');
                    $data['user'] = $this->Users->selectUser($userId);
                    foreach ($data['user'] as $user) {
                        $active = $user->shop_status;
                    }
                    $data['shopactive'] = $active;
                    $data['themes'] = $this->Themes->allThemes();

                    $data['selecteditem'] = $this->Items->SelectedItem($id);
                    $data['slug'] = $slug;
                    $data['item_user_id'] = $item_user_id;
                    $data['id'] = $id;
                    $data['allcats'] = $this->Category->allcats();
                    $data['allscats'] = $this->Category->allsubcats();
                    $data['allImages'] = $this->Items->allItemImages($id);
                    $data['allprovinces'] = $this->Location->allprovinces();
                    $data['allcities'] = $this->Location->allcities();
                    $data['themes'] = $this->Themes->allThemes();
                    $data['allprovinces'] = $this->Location->allprovinces();
                    $this->load->view('seller/header', $data);
                    $this->load->view('seller/edititem', $data);
                    $this->load->view('public/footer');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error Updating Item...!</span></div>');

                $userId = $this->session->userdata('user_id');
                $data['user'] = $this->Users->selectUser($userId);
                foreach ($data['user'] as $user) {
                    $active = $user->shop_status;
                }
                $data['shopactive'] = $active;

                $data['selecteditem'] = $this->Items->SelectedItem($id);
                $data['slug'] = $slug;
                $data['item_user_id'] = $item_user_id;
                $data['id'] = $id;
                $data['allcats'] = $this->Category->allcats();
                $data['allscats'] = $this->Category->allsubcats();
                $data['allImages'] = $this->Items->allItemImages($id);
                $data['allprovinces'] = $this->Location->allprovinces();
                $data['allcities'] = $this->Location->allcities();
                $data['themes'] = $this->Themes->allThemes();
                $data['allprovinces'] = $this->Location->allprovinces();
                $this->load->view('seller/header', $data);
                $this->load->view('seller/edititem', $data);
                $this->load->view('public/footer');
            }
        } else {
            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;
            $data['selecteditem'] = $this->Items->SelectedItem($id);
            $data['slug'] = $slug;
            $data['id'] = $id;
            $data['allcats'] = $this->Category->allcats();
            $data['allscats'] = $this->Category->allsubcats();
            $data['item_user_id'] = $item_user_id;
            $data['allImages'] = $this->Items->allItemImages($id);
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/edititem', $data);
            $this->load->view('public/footer');
        }
    }

    public function deleteimagegallery() {

        if (isset($_POST['id'])) {
            $user_id = $this->session->userdata('user_id');
            $result = $this->Items->uploaded_imgs($_POST['pid']);
            if ($_POST['uid'] == $user_id) {
                if ($result != 1) {

                    $found = $this->Items->find_delete_image($_POST['id']);
                    foreach ($found as $image) {
                        $img = $image->image;
                    }
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $img);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $img);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $img);
                    $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode($this->Items->deleteimagegallery_seller($_POST['id'])));
                }
            }
        }
    }

    public function deleteImagegalleryById() {

        if (isset($_POST['id'])) {
            $found = $this->Items->find_delete_image($_POST['id']);
            foreach ($found as $image) {
                $img = $image->image;
            }
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $img);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $img);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $img);
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Items->deleteimagegallery_seller($_POST['id'])));
        }
    }

    public function EdititemimageUpload($slug) {
        $item_result = $this->Items->itemSlugTOId($slug);

        foreach ($item_result as $item) {
            $id = $item->id;
            $item_user_id = $item->user_id;
        }
        $result = $this->Items->uploaded_imgs($id);

        $user_id = $this->session->userdata('user_id');

        if ($item_user_id == $user_id) {

            if ($result < 5) {
                //$file_name = null;
                $file = $_FILES['file'];

                if ($file['name'] != '') {


                    $upload_data = array(
                        'upload_path' => "./files/items",
                        'allowed_types' => "gif|jpg|png|jpeg",
                        'max_size' => 5120,
                        'quality' => "100%",
                        'encrypt_name' => TRUE,
                        'width' => 600,
                        'height' => 450
                    );



                    $file_name = "";
                    $this->load->library('upload', $upload_data);

                    if ($this->upload->do_upload('file')) {


                        $uploaded_file = $this->upload->data();


                        $this->resize_crop($uploaded_file['full_path'], $upload_data["width"], $upload_data["height"]);


                        $file_name = $uploaded_file['file_name'];

//                $id = $this->session->userdata('product_id');
                        //$file_name = base_url() . 'files/item_gallery/' . $file_name;
                        $img_data = array('image' => $file_name, 'item_id' => $id);
                        $image_id = $this->Items->insert_image($img_data);
                        $this->output
                                ->set_content_type("application/json")
                                ->set_output(json_encode(array('id' => $image_id)));
                    }
                }
            }
        }
    }

    public function manageItems() {
        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->Users->selectUser($userId);
        foreach ($data['user'] as $user) {
            $active = $user->shop_status;
        }
        $data['shopactive'] = $active;
        $data['allscats'] = $this->Category->allsubcats();
        $data['pcatandsubcat'] = $this->Category->pcatAndSubcat();
        $uid = $this->session->userdata('user_id');
        $data['allitems'] = $this->Items->allSellerItems($uid);
        $data['themes'] = $this->Themes->allThemes();
        $data['allprovinces'] = $this->Location->allprovinces();
        $this->load->view('seller/header', $data);
        $this->load->view('seller/manageitems', $data);
        $this->load->view('public/footer');
    }

    public function deleteItem($slug) {
        $result = $this->Items->itemSlugTOId($slug);
        $item_user_id = '';
        foreach ($result as $item) {

            $item_user_id = $item->user_id;
            $id = $item->id;
        }

        $user_id = $this->session->userdata('user_id');

        if ($item_user_id == $user_id) {

            //delete matched linked items
            $matcheditems = $this->Itemspackage->MachedLinkeditems($id);
            foreach ($matcheditems as $mitems) {

                $this->db->where('linked_id', $mitems->linked_id);
                $this->db->delete('items_package_linked');
            }

            //delete matched images
            $matchedimages = $this->Items->matched_images($id);
            foreach ($matchedimages as $mimage) {

                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

                $this->db->where('gallery_id', $mimage->gallery_id);
                $this->db->delete('item_gallery');
            }


            $delete_Item = $this->Items->deleteItemBySlug($slug, $id);

            if ($delete_Item != 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item Deleted Successfully..!</span></div>');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Item..!</span></div>');

                redirect('dashboard');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleting others User Item...!</span></div>');

            redirect('dashboard');
        }
    }

    public function addItemPackage() {
        $user_id = $this->session->userdata('user_id');
        if ($this->input->post()) {

//common
            $title = $this->input->post('title');
            $theme = $this->input->post('theme');
            $description = $this->input->post('description');
            $package_type = $this->input->post('package_type');
            $package_for = $this->input->post('package_for');
            $venue = $this->input->post('venue');
            $city_id = $this->input->post('city');
            $delivery_cost = $this->input->post('delivery_cost');
            $service_charge = $this->input->post('service_charge');
            $other_charges = $this->input->post('other_charges');


            //get province_id

            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }



// slug
            $config = array(
                'field' => 'slug',
                'title' => 'title',
                'table' => 'items_package',
                'id' => 'package_id',
            );
            $this->load->library('slug', $config);

            $data = array(
                'title' => $title
            );
            $data['slug'] = $this->slug->create_uri($data);
            $slug = $data['slug'];

            date_default_timezone_set('Asia/Colombo');
            $post_date = date("Y/m/d H:i");
            $expire_date = date("Y/m/d H:i", strtotime($post_date . " + 180 days"));

// party packages

            $party_hours = $this->input->post('party_hours');
            $party_minutes = $this->input->post('party_minutes');
            $children_min = $this->input->post('children_min');
            $children_max = $this->input->post('children_max');
            $adult_min = $this->input->post('adult_min');
            $adult_max = $this->input->post('adult_max');
            $child_age_min = $this->input->post('child_age_min');
            $child_age_max = $this->input->post('child_age_max');
            $childern_per_head = $this->input->post('childern_per_head');
            $adult_per_head = $this->input->post('adult_per_head');
            $package_price = $this->input->post('package_price');


// food packages

            $type_food_package = $this->input->post('type_food_package');
            $no_persons_served = $this->input->post('no_persons_served');
            $waiters_provided = $this->input->post('waiters_provided');
            $food_per_head_charge = $this->input->post('food_per_head_charge');
            $food_package_price = $this->input->post('food_package_price');
            $food_plates = $this->input->post('food_plates');
            $food_cups = $this->input->post('food_cups');
            $food_straws = $this->input->post('food_straws');
            $food_napkins = $this->input->post('food_napkins');
            $food_cutlery = $this->input->post('food_cutlery');
            $food_chafing_dishes = $this->input->post('food_chafing_dishes');




            $additempackage = $this->Itemspackage->add_item_package_seller($slug, $title, $theme, $description, $district, $city_id, $user_id, $post_date, $expire_date, $package_type, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes);

            if ($additempackage != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Upload Pictures * (Pleae make sure you upload real pictures of the item. In case you don\'t have a real picture or  If it\'s a package/service, please upload the business logo)"</span></div>');
                $this->session->set_userdata('package_id', $additempackage);
                redirect("post-package-image");
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error adding Post Package...!</span></div>');
                redirect("post-package");
            }
        } else {

            $usercities = $this->Users->selectUser($user_id);

            foreach ($usercities as $usercity) {
                $user_city = $usercity->user_city;
            }
            $data['user_city'] = $user_city;

            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;

            $data['venues'] = $this->Venues->allVenues();
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/addpackage', $data);
            $this->load->view('public/footer');
        }
    }

    public function validate_image_upload_pack() {
        $result = $this->Itemspackage->uploaded_imgs($this->session->userdata('package_id'));
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
    }

    public function itemPackageImageUpload() {
        $result = $this->Itemspackage->uploaded_imgs($this->session->userdata('package_id'));
        if ($result < 5) {
//$file_name = null;
            $file = $_FILES['file'];

            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/items",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => 5120,
                    'quality' => "100%",
                    'encrypt_name' => TRUE,
                    'width' => 600,
                    'height' => 450
                );



                $file_name = "";
                $this->load->library('upload', $upload_data);

                if ($this->upload->do_upload('file')) {


                    $uploaded_file = $this->upload->data();


                    $this->resize_crop($uploaded_file['full_path'], $upload_data["width"], $upload_data["height"]);


                    $file_name = $uploaded_file['file_name'];

                    $id = $this->session->userdata('package_id');
                    //$file_name = base_url() . 'files/item_gallery/' . $file_name;
                    $img_data = array('image' => $file_name, 'item_package_id' => $id);
                    $image_id = $this->Itemspackage->insert_image($img_data);

                    // activate posting if user upload images then put in pending
                    $this->Itemspackage->item_activate_seller($id);
                    $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('id' => $image_id)));
                }
            }
        }
    }

    public function add_item_package_image() {
        if ($this->session->has_userdata('package_id')) {

            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;

            $data['themes'] = $this->Themes->allThemes();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/additempackageimage');
            $this->load->view('public/footer');
        } else {
            redirect("post-package");
        }
    }

    public function add_item_package_linked_Item() {
        if ($this->session->has_userdata('package_id')) {
            $pid = $this->session->userdata('package_id');
            if ($this->input->post()) {

                $item = $this->input->post('item');

                $max_item_inc = $this->input->post('max_item_inc');
                $item_extra_note = $this->input->post('item_extra_note');
                $package_id = $this->session->userdata('package_id');

                $linkitem = $this->Itemspackage->linkitem($package_id, $item, $max_item_inc, $item_extra_note);

                if ($linkitem != '') {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item Linked to Post package...!</span></div>');

                    redirect("post-package-link-item");

//                    $data['themes'] = $this->Themes->allThemes();
//                    $uid = $this->session->userdata('user_id');
//                    $data['items'] = $this->Items->allSellerPackageItems($uid);
//                    $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
//                    $this->load->view('seller/header', $data);
//                    $this->load->view('seller/linkitems', $data);
//                    $this->load->view('public/footer');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error with Linking Item to Post Package...!</span></div>');

                    $userId = $this->session->userdata('user_id');
                    $data['user'] = $this->Users->selectUser($userId);
                    foreach ($data['user'] as $user) {
                        $active = $user->shop_status;
                    }
                    $data['shopactive'] = $active;

                    $data['themes'] = $this->Themes->allThemes();
                    $data['allprovinces'] = $this->Location->allprovinces();
                    $uid = $this->session->userdata('user_id');
                    $data['items'] = $this->Items->allSellerPackageItems($uid);
                    $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
                    $this->load->view('seller/header', $data);
                    $this->load->view('seller/linkitems', $data);
                    $this->load->view('public/footer');
                }
            } else {
                $uid = $this->session->userdata('user_id');

                $userId = $this->session->userdata('user_id');
                $data['user'] = $this->Users->selectUser($userId);
                foreach ($data['user'] as $user) {
                    $active = $user->shop_status;
                }
                $data['shopactive'] = $active;
                $data['items'] = $this->Items->allSellerPackageItems($uid);
                $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
                $data['themes'] = $this->Themes->allThemes();
                $data['allprovinces'] = $this->Location->allprovinces();
                $this->load->view('seller/header', $data);
                $this->load->view('seller/linkitems');
                $this->load->view('public/footer');
            }
        } else {
            redirect("post-package");
        }
    }

    public function managePackages() {
        $uid = $this->session->userdata('user_id');

        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->Users->selectUser($userId);
        foreach ($data['user'] as $user) {
            $active = $user->shop_status;
        }
        $data['shopactive'] = $active;

        $data['allpackages'] = $this->Itemspackage->allSellerPackages($uid);
        $data['themes'] = $this->Themes->allThemes();
        $data['allprovinces'] = $this->Location->allprovinces();
        $this->load->view('seller/header', $data);
        $this->load->view('seller/managepackages', $data);
        $this->load->view('public/footer');
    }

    public function EditItemPackage($slug) {

        $result = $this->Itemspackage->packgeSlugTOId($slug);
        foreach ($result as $item) {
            $id = $item->package_id;
            $item_user_id = $item->user_id;
        }
        if ($this->input->post()) {
//common
            $title = $this->input->post('title');
            $theme = $this->input->post('theme');
            $package_for = $this->input->post('package_for');
            $venue = $this->input->post('venue');
            $delivery_cost = $this->input->post('delivery_cost');
            $service_charge = $this->input->post('service_charge');
            $other_charges = $this->input->post('other_charges');
            $city_id = $this->input->post('city');
            $description = $this->input->post('description');



// party packages

            $party_hours = $this->input->post('party_hours');
            $party_minutes = $this->input->post('party_minutes');
            $children_min = $this->input->post('children_min');
            $children_max = $this->input->post('children_max');
            $adult_min = $this->input->post('adult_min');
            $adult_max = $this->input->post('adult_max');
            $child_age_min = $this->input->post('child_age_min');
            $child_age_max = $this->input->post('child_age_max');
            $childern_per_head = $this->input->post('childern_per_head');
            $adult_per_head = $this->input->post('adult_per_head');
            $package_price = $this->input->post('package_price');


// food packages

            $type_food_package = $this->input->post('type_food_package');
            $no_persons_served = $this->input->post('no_persons_served');
            $waiters_provided = $this->input->post('waiters_provided');
            $food_per_head_charge = $this->input->post('food_per_head_charge');
            $food_package_price = $this->input->post('food_package_price');
            $food_plates = $this->input->post('food_plates');
            $food_cups = $this->input->post('food_cups');
            $food_straws = $this->input->post('food_straws');
            $food_napkins = $this->input->post('food_napkins');
            $food_cutlery = $this->input->post('food_cutlery');
            $food_chafing_dishes = $this->input->post('food_chafing_dishes');


            $config = array(
                'field' => 'slug',
                'title' => 'title',
                'table' => 'items_package',
                'id' => 'package_id',
            );
            $this->load->library('slug', $config);

            $data = array(
                'title' => $title
            );
            $data['slug'] = $this->slug->create_uri($data, $id);
            $newslug = $data['slug'];


//get province_id

            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }


            $user_id = $this->session->userdata('user_id');
            if ($item_user_id == $user_id) {
                $updateitempackage = $this->Itemspackage->update_item_package_seller($id, $title, $theme, $description, $district, $city_id, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes);

                if ($updateitempackage != '') {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Your changes have been submitted for review.Once approved,the changes wll be applied</span></div>');

                    redirect("edit-item-package/" . $slug);
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error Updating Package...!</span></div>');

                    $userId = $this->session->userdata('user_id');
                    $data['user'] = $this->Users->selectUser($userId);
                    foreach ($data['user'] as $user) {
                        $active = $user->shop_status;
                    }
                    $data['shopactive'] = $active;

                    $data['themes'] = $this->Themes->allThemes();
                    $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
                    $data['slug'] = $slug;
                    $data['item_user_id'] = $item_user_id;
                    $data['id'] = $id;
                    $data['allImages'] = $this->Items->allItemImages($id);
                    $data['allprovinces'] = $this->Location->allprovinces();
                    $data['allcities'] = $this->Location->allcities();
                    $data['venues'] = $this->Venues->allVenues();
                    $data['themes'] = $this->Themes->allThemes();
                    $this->load->view('seller/header', $data);
                    $this->load->view('seller/edititempackage', $data);
                    $this->load->view('public/footer');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error Updating Package...!</span></div>');


                $userId = $this->session->userdata('user_id');
                $data['user'] = $this->Users->selectUser($userId);
                foreach ($data['user'] as $user) {
                    $active = $user->shop_status;
                }
                $data['shopactive'] = $active;

                $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
                $data['slug'] = $slug;
                $data['item_user_id'] = $item_user_id;
                $data['id'] = $id;
                $data['allImages'] = $this->Items->allItemImages($id);
                $data['allprovinces'] = $this->Location->allprovinces();
                $data['allcities'] = $this->Location->allcities();
                $data['venues'] = $this->Venues->allVenues();
                $data['themes'] = $this->Themes->allThemes();
                $this->load->view('seller/header', $data);
                $this->load->view('seller/edititempackage', $data);
                $this->load->view('public/footer');
            }
        } else {

            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;

            $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
            $data['slug'] = $slug;
            $data['item_user_id'] = $item_user_id;
            $data['id'] = $id;
            $data['allImages'] = $this->Items->allItemImages($id);
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $data['venues'] = $this->Venues->allVenues();
            $data['themes'] = $this->Themes->allThemes();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/edititempackage', $data);
            $this->load->view('public/footer');
        }
    }

    public function edit_package_image($slug) {
        $package = $this->Itemspackage->packgeSlugTOId($slug);
        $id = '';
        foreach ($package as $itempack) {
            $id = $itempack->package_id;
            $user_id = $itempack->user_id;
        }
        $data['uid'] = $user_id;
        $data['pid'] = $id;
        $data['slug'] = $slug;
        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->Users->selectUser($userId);
        foreach ($data['user'] as $user) {
            $active = $user->shop_status;
        }
        $data['shopactive'] = $active;
        $data['themes'] = $this->Themes->allThemes();
        $data['allImages'] = $this->Itemspackage->allItemPackageImages($id);
        $this->load->view('seller/header', $data);
        $this->load->view('seller/edititempackageimage', $data);
        $this->load->view('public/footer');
    }

    public function Edit_item_package_image_Upload($slug) {

        $package = $this->Itemspackage->packgeSlugTOId($slug);
        foreach ($package as $itempack) {
            $id = $itempack->package_id;
            $package_user_id = $itempack->user_id;
        }
        $result = $this->Itemspackage->uploaded_imgs($id);
        $user_id = $this->session->userdata('user_id');

        if ($package_user_id == $user_id) {
            if ($result < 5) {
                //$file_name = null;
                $file = $_FILES['file'];

                if ($file['name'] != '') {


                    $upload_data = array(
                        'upload_path' => "./files/items",
                        'allowed_types' => "gif|jpg|png|jpeg",
                        'max_size' => 5120,
                        'quality' => "100%",
                        'encrypt_name' => TRUE,
                        'width' => 600,
                        'height' => 450
                    );



                    $file_name = "";
                    $this->load->library('upload', $upload_data);

                    if ($this->upload->do_upload('file')) {


                        $uploaded_file = $this->upload->data();


                        $this->resize_crop($uploaded_file['full_path'], $upload_data["width"], $upload_data["height"]);


                        $file_name = $uploaded_file['file_name'];
//                        $config = array(
//                            'source_image' => $uploaded_file['full_path'],
//                            'new_image' => "./files/thumb",
//                            'maintain_ratio' => false,
//                            'width' => 600,
//                            'height' => 450
//                        );
//
//
//
//                        //this is the magic line that enables you generate multiple thumbnails
//                        //you have to call the initialize() function each time you call the resize()
//                        //otherwise it will not work and only generate one thumbnail
//                        $this->image_lib->clear();
//                        $this->image_lib->initialize($config);
//                        $this->image_lib->resize();
//                $id = $this->session->userdata('product_id');
                        //$file_name = base_url() . 'files/item_gallery/' . $file_name;
                        $img_data = array('image' => $file_name, 'item_package_id' => $id);
                        $image_id = $this->Itemspackage->insert_image($img_data);
                        $this->output
                                ->set_content_type("application/json")
                                ->set_output(json_encode(array('id' => $image_id)));
                    }
                }
            }
        }
    }

    public function deletepackageimagegallery() {

        if (isset($_POST['id'])) {
            $user_id = $this->session->userdata('user_id');
            $result = $this->Itemspackage->uploaded_imgs($_POST['pid']);
            if ($_POST['uid'] == $user_id) {
                if ($result != 1) {

                    $found = $this->Itemspackage->find_delete_image($_POST['id']);
                    foreach ($found as $image) {
                        $img = $image->image;
                    }
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $img);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $img);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $img);

                    $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode($this->Itemspackage->deleteimagegallery($_POST['id'])));
                }
            }
        }
    }

    public function deletepackageimagegalleryById() {

        if (isset($_POST['id'])) {

            $found = $this->Itemspackage->find_delete_image($_POST['id']);
            foreach ($found as $image) {
                $img = $image->image;
            }
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $img);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $img);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $img);

            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Itemspackage->deleteimagegallery($_POST['id'])));
        }
    }

    public function Edit_item_package_linked_Item($slug) {
        $package = $this->Itemspackage->packgeSlugTOId($slug);
        foreach ($package as $itempack) {
            $pid = $itempack->package_id;
            $package_user_id = $itempack->user_id;
        }

        if ($this->input->post()) {

            $item = $this->input->post('item');
            $max_item_inc = $this->input->post('max_item_inc');
            $item_extra_note = $this->input->post('item_extra_note');
            $user_id = $this->session->userdata('user_id');

            if ($user_id == $package_user_id) {
                $linkitem = $this->Itemspackage->linkitem($pid, $item, $max_item_inc, $item_extra_note);

                if ($linkitem != '') {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item Linked to Post package...!</span></div>');
                    redirect("edit-package-linked-items/" . $slug);

//                    $data['slug'] = $slug;
//                    $data['themes'] = $this->Themes->allThemes();
//                    $uid = $this->session->userdata('user_id');
//                    $data['items'] = $this->Items->allSellerPackageItems($uid);
//                    $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
//                    $this->load->view('seller/header', $data);
//                    $this->load->view('seller/editlinkeditems', $data);
//                    $this->load->view('public/footer');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error with Linking Item to Post Package...!</span></div>');
                    $data['slug'] = $slug;
                    $userId = $this->session->userdata('user_id');
                    $data['user'] = $this->Users->selectUser($userId);
                    foreach ($data['user'] as $user) {
                        $active = $user->shop_status;
                    }
                    $data['shopactive'] = $active;
                    $data['themes'] = $this->Themes->allThemes();
                    $uid = $this->session->userdata('user_id');
                    $data['items'] = $this->Items->allSellerPackageItems($uid);
                    $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
                    $this->load->view('seller/header', $data);
                    $this->load->view('seller/editlinkeditems', $data);
                    $this->load->view('public/footer');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error with Linking Item to Post Package...!</span></div>');
                $data['slug'] = $slug;
                $userId = $this->session->userdata('user_id');
                $data['user'] = $this->Users->selectUser($userId);
                foreach ($data['user'] as $user) {
                    $active = $user->shop_status;
                }
                $data['shopactive'] = $active;
                $data['themes'] = $this->Themes->allThemes();
                $data['allprovinces'] = $this->Location->allprovinces();
                $uid = $this->session->userdata('user_id');
                $data['items'] = $this->Items->allSellerPackageItems($uid);
                $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
                $this->load->view('seller/header', $data);
                $this->load->view('seller/editlinkeditems', $data);
                $this->load->view('public/footer');
            }
        } else {
            $data['slug'] = $slug;
            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;
            $uid = $this->session->userdata('user_id');
            $data['items'] = $this->Items->allSellerPackageItems($uid);
            $data['linkeditems'] = $this->Itemspackage->packagelinkeditems($pid);
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/editlinkeditems');
            $this->load->view('public/footer');
        }
    }

    public function delete_item_package_linked_Item($id, $slug) {

        $delete_linked_Item = $this->Itemspackage->deleteLinkedItem($id);

        if ($delete_linked_Item != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Linked Item Deleted Successfully..!</span></div>');
            redirect('edit-package-linked-items/' . $slug);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Linked Item..!</span></div>');
            redirect('edit-package-linked-items/' . $slug);
        }
    }

    public function delete_item_package($slug) {

        $result = $this->Itemspackage->packgeSlugTOId($slug);
        $item_user_id = '';
        foreach ($result as $itempack) {

            $item_user_id = $itempack->user_id;
            $id = $itempack->package_id;
        }

        $user_id = $this->session->userdata('user_id');

        if ($item_user_id == $user_id) {


            //delete matched images
            $matchedimages = $this->Itemspackage->matched_images($id);
            foreach ($matchedimages as $mimage) {

                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

                $this->db->where('package_gallery_id', $mimage->package_gallery_id);
                $this->db->delete('items_package_gallery');
            }

            $delete_Item_Package = $this->Itemspackage->deleteItemPackageBySlug($slug, $id);

            if ($delete_Item_Package != 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item Package Deleted Successfully..!</span></div>');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Item Package..!</span></div>');

                redirect('dashboard');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleting others User Item Package...!</span></div>');

            redirect('dashboard');
        }
    }

    private function resize_crop($full_path, $width, $height) {

        $exif = exif_read_data($full_path);

        if (isset($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    // Need to rotate 180 deg


                    $config['source_image'] = $full_path; //full path for the source image
                    $config['rotation_angle'] = '180';

                    $this->image_lib->initialize($config);
                    //Rotate the image
                    $this->image_lib->rotate();
                    $this->image_lib->clear();
                    break;

                case 6:
                    // Need to rotate 90 deg clockwise

                    $config['source_image'] = $full_path; //full path for the source image
                    $config['rotation_angle'] = '270';
                    $this->image_lib->initialize($config);
                    //Rotate the image
                    $this->image_lib->rotate();
                    $this->image_lib->clear();
                    break;

                case 8:
                    // Need to rotate 90 deg counter clockwise

                    $config['source_image'] = $full_path; //full path for the source image
                    $config['rotation_angle'] = '90';
                    $this->image_lib->initialize($config);
                    //Rotate the image
                    $this->image_lib->rotate();
                    $this->image_lib->clear();


                    break;
            }
        }
//resie original Image
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $full_path;
        $image_config['maintain_ratio'] = true;
        $image_config['overwrite'] = TRUE;
        $image_config['new_image'] = './files/items';
        $image_config['quality'] = 100;
        $image_config['width'] = 600;
        $image_config['height'] = 450;
        $dim = (intval($width) / intval($height)) - ($image_config['width'] / $image_config['height']);
        $image_config['master_dim'] = ($dim > 0) ? "height" : "width";
        $this->image_lib->initialize($image_config);
        $this->image_lib->resize();

//thumb
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $full_path;
        $image_config['maintain_ratio'] = False;
        $image_config['overwrite'] = TRUE;
        $image_config['new_image'] = './files/thumb';
        $image_config['quality'] = 60;
        $image_config['width'] = 350;
        $image_config['height'] = 292;

        $this->image_lib->clear();
        $this->image_lib->initialize($image_config);
        $this->image_lib->resize();

//watermark
        $config['image_library'] = 'GD2';
        $config['source_image'] = $full_path;
        $config['wm_overlay_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . "/asset/images/watermark.png";
        $config['wm_type'] = 'overlay';
        $config['width'] = '80';
        $config['height'] = '32';
        $config['padding'] = '20';
        $config['wm_opacity'] = '100';
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'right';

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();


//gallery Image Crop
        $image_config['image_library'] = 'gd2';
        $image_config['source_image'] = $full_path;
        $image_config['new_image'] = './files/gallery';
        $image_config['quality'] = 100;
        $image_config['maintain_ratio'] = FALSE;
        $image_config['width'] = 600;
        $image_config['height'] = 450;
        $image_config['x_axis'] = '0';
        $image_config['y_axis'] = '0';

        $this->image_lib->clear();
        $this->image_lib->initialize($image_config);

        if (!$this->image_lib->crop()) {

            $this->image_lib->display_errors();
        }
    }

    public function phoneVerify() {
        if ($this->input->post('action') == "verify") {

// Initialize variables
            $app_id = '1835827223404024';
            $secret = 'a0094701ab174291e78702c3f80dbf9c';
            $version = 'v1.1'; // 'v1.1' for example
// Method to send Get request to url

            function doCurl($url) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $data = json_decode(curl_exec($ch), true);
                curl_close($ch);
                return $data;
            }

// Exchange authorization code for access token
            $token_exchange_url = 'https://graph.accountkit.com/' . $version . '/access_token?' .
                    'grant_type=authorization_code' .
                    '&code=' . $_POST['code'] .
                    "&access_token=AA|$app_id|$secret";
            $data = doCurl($token_exchange_url);
//$user_id = $data['id'];
            $user_access_token = $data['access_token'];
//$refresh_interval = $data['token_refresh_interval_sec'];
// Get Account Kit information
            $me_endpoint_url = 'https://graph.accountkit.com/' . $version . '/me?' .
                    'access_token=' . $user_access_token;
            $data = doCurl($me_endpoint_url);

            $mobile = isset($data['phone']) ? $data['phone']['national_number'] : '';
            if (!empty($mobile)) {

                $userId = $this->session->userdata('user_id');

                $mobile = '0' . $mobile;

                $verifyphone = $this->Users->verifyphone($userId, $mobile);

                if ($verifyphone != '') {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Your Phone Verified ..!</span></div>');
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Phone Verification..!</span></div>');
                    redirect('profile');
                }
            }
        }
    }

    public function changepassword() {

        if ($this->input->post()) {
            $id = $this->session->userdata('user_id');
            $oldpwd = sha1($this->input->post('oldpwd'));

            $newpwd = sha1($this->input->post('newpwd'));

            $checkpwd = $this->Users->checkpassword($id, $oldpwd);
            $foget_pwd = md5(rand(1000, 10000000));

            if ($checkpwd != '') {
                $updatepwd = $this->Users->updatepassword($id, $newpwd, $foget_pwd);
                if ($updatepwd) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Password Changed.</span></div>');
                    redirect('change-my-password');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><span>Error. Password change failed. Plase contact support@birthdays.lk</span></div>');
                    redirect('change-my-password');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Old Password not matched!</span></div>');
                redirect('change-my-password');
            }
        } else {

            $userId = $this->session->userdata('user_id');
            $data['user'] = $this->Users->selectUser($userId);
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
            }
            $data['shopactive'] = $active;
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/changepassword');
            $this->load->view('public/footer');
        }
    }

    public function createshop($hash) {
        $userId = $this->session->userdata('user_id');
        $result = $this->Users->checkvalidity($hash, $userId);
        if ($result) {

            $data['user'] = $this->Users->selectUser($userId);
            $store_info = array();
            foreach ($data['user'] as $user) {
                $active = $user->shop_status;
                $store_info = array(
                    "link" => $user->name_slug,
                    "overview" => $user->overview,
                    "address" => $user->address,
                    "company" => $user->company,
                    "cover_img" => $user->cover_image,
                    'mobile' => $user->mobile,
                    "monstart" => $user->monstart,
                    "monclose" => $user->monclose,
                    "tuestart" => $user->tuestart,
                    "tueclose" => $user->tueclose,
                    "wedstart" => $user->wedstart,
                    "wedclose" => $user->wedclose,
                    "thustart" => $user->thustart,
                    "thuclose" => $user->thuclose,
                    "fristart" => $user->fristart,
                    "friclose" => $user->friclose,
                    "satstart" => $user->satstart,
                    "satclose" => $user->satclose,
                    "sunstart" => $user->sunstart,
                    "sunclose" => $user->sunclose
                );
            }
            $data['store_info'] = $store_info;
            $data['shopactive'] = $active;
            $data['themes'] = $this->Themes->allThemes();
            $data['allprovinces'] = $this->Location->allprovinces();
            $this->load->view('seller/header', $data);
            $this->load->view('seller/createshop', $data);
            $this->load->view('public/footer');
        } else {
            http_response_code(404);
            redirect('404');
        }
    }

    public function shopsettings() {

        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->Users->selectUser($userId);
        $store_info = array();
        foreach ($data['user'] as $user) {
            $active = $user->shop_status;
            $store_info = array(
                "link" => $user->name_slug,
                "overview" => $user->overview,
                "address" => $user->address,
                "company" => $user->company,
                "cover_img" => $user->cover_image,
                'mobile' => $user->mobile,
                "monstart" => $user->monstart,
                "monclose" => $user->monclose,
                "tuestart" => $user->tuestart,
                "tueclose" => $user->tueclose,
                "wedstart" => $user->wedstart,
                "wedclose" => $user->wedclose,
                "thustart" => $user->thustart,
                "thuclose" => $user->thuclose,
                "fristart" => $user->fristart,
                "friclose" => $user->friclose,
                "satstart" => $user->satstart,
                "satclose" => $user->satclose,
                "sunstart" => $user->sunstart,
                "sunclose" => $user->sunclose
            );
        }
        $data['store_info'] = $store_info;
        $data['shopactive'] = $active;
        $data['themes'] = $this->Themes->allThemes();
        $data['allprovinces'] = $this->Location->allprovinces();
        $this->load->view('seller/header', $data);
        $this->load->view('seller/shopsettings', $data);
        $this->load->view('public/footer');
    }

    /// seller Store Settings

    public function checklink() {

        if (isset($_POST['link'])) {
            $link = mb_strtolower(url_title(convert_accented_characters($this->input->post('link'))));
            $result = $this->Users->checklink($link);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save link @ shopcreation
    public function savelink_shop_create() {

        if (isset($_POST['link'])) {
            $userId = $this->session->userdata('user_id');

            $link = mb_strtolower(url_title(convert_accented_characters($this->input->post('link'))));
            $result = $this->Users->savelink_shop_create($link, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save link
    public function savelink() {

        if (isset($_POST['link'])) {
            $userId = $this->session->userdata('user_id');

            $link = mb_strtolower(url_title(convert_accented_characters($this->input->post('link'))));
            $result = $this->Users->savelink($link, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save company name
    public function savecompany() {
        if (isset($_POST['companyname'])) {
            $userId = $this->session->userdata('user_id');
            $companyname = $this->input->post('companyname');
            $result = $this->Users->savecompany($companyname, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save company overview
    public function saveoverview() {
        if (isset($_POST['overview'])) {
            $userId = $this->session->userdata('user_id');
            $overview = $this->input->post('overview');
            $result = $this->Users->saveoverview($overview, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save company address
    public function saveaddress() {
        if (isset($_POST['address'])) {
            $userId = $this->session->userdata('user_id');
            $address = $this->input->post('address');
            $result = $this->Users->saveaddress($address, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save company address
    public function savephone() {
        if (isset($_POST['phone'])) {
            $userId = $this->session->userdata('user_id');
            $phone = $this->input->post('phone');
            $result = $this->Users->savephone($phone, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save company cover image
    public function savecoverimage() {

        $upload_data = array(
            'upload_path' => "./files/shops",
            'allowed_types' => "gif|jpg|png|jpeg",
            'max_size' => 5120,
            'quality' => 80,
            'overwrite' => FALSE,
            'width' => 1200,
            'height' => 375
        );


        $file_name = "";
        $this->load->library('upload', $upload_data);
        if ($this->upload->do_upload('userfile')) {

            $uploaded_file = $this->upload->data();
            $file_name = $uploaded_file['file_name'];

            $image_config["image_library"] = "gd2";
            $image_config["source_image"] = $uploaded_file['full_path'];
            $image_config['maintain_ratio'] = TRUE;
            $image_config['new_image'] = './files/shops';
            $image_config['quality'] = 80;
            $image_config['width'] = 1200;
            $image_config['height'] = 375;
            $dim = (intval($upload_data["width"]) / intval($upload_data["height"])) - ($image_config['width'] / $image_config['height']);
            $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

            $this->image_lib->initialize($image_config);

            $this->image_lib->resize();


            $image_config['image_library'] = 'gd2';
            $image_config['source_image'] = $uploaded_file['full_path'];
            $image_config['new_image'] = './files/shops';
            $image_config['quality'] = 80;
            $image_config['overwrite'] = TRUE;
            $image_config['maintain_ratio'] = FALSE;
            $image_config['width'] = 1200;
            $image_config['height'] = 375;
            $image_config['x_axis'] = '0';
            $image_config['y_axis'] = '0';

            $this->image_lib->clear();
            $this->image_lib->initialize($image_config);

            $this->image_lib->crop();

            $userId = $this->session->userdata('user_id');
            $result = $this->Users->savecoverimage($file_name, $userId);


            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    /// save company time
    public function storeopenclose() {
        if (isset($_POST['time'])) {
            $userId = $this->session->userdata('user_id');

            $monstart = (!empty($this->input->post('monstart'))) ? date("H:i", strtotime($this->input->post('monstart'))) : "";
            $monclose = (!empty($this->input->post('monclose'))) ? date("H:i", strtotime($this->input->post('monclose'))) : "";
            $tuestart = (!empty($this->input->post('tuestart'))) ? date("H:i", strtotime($this->input->post('tuestart'))) : "";
            $tueclose = (!empty($this->input->post('tueclose'))) ? date("H:i", strtotime($this->input->post('tueclose'))) : "";
            $wedstart = (!empty($this->input->post('wedstart'))) ? date("H:i", strtotime($this->input->post('wedstart'))) : "";
            $wedclose = (!empty($this->input->post('wedclose'))) ? date("H:i", strtotime($this->input->post('wedclose'))) : "";
            $thustart = (!empty($this->input->post('thustart'))) ? date("H:i", strtotime($this->input->post('thustart'))) : "";
            $thuclose = (!empty($this->input->post('thuclose'))) ? date("H:i", strtotime($this->input->post('thuclose'))) : "";
            $fristart = (!empty($this->input->post('fristart'))) ? date("H:i", strtotime($this->input->post('fristart'))) : "";
            $friclose = (!empty($this->input->post('friclose'))) ? date("H:i", strtotime($this->input->post('friclose'))) : "";
            $satstart = (!empty($this->input->post('satstart'))) ? date("H:i", strtotime($this->input->post('satstart'))) : "";
            $satclose = (!empty($this->input->post('satclose'))) ? date("H:i", strtotime($this->input->post('satclose'))) : "";
            $sunstart = (!empty($this->input->post('sunstart'))) ? date("H:i", strtotime($this->input->post('sunstart'))) : "";
            $sunclose = (!empty($this->input->post('sunclose'))) ? date("H:i", strtotime($this->input->post('sunclose'))) : "";


            $data = array(
                'monstart' => $monstart,
                'monclose' => $monclose,
                'tuestart' => $tuestart,
                'tueclose' => $tueclose,
                'wedstart' => $wedstart,
                'wedclose' => $wedclose,
                'thustart' => $thustart,
                'thuclose' => $thuclose,
                'fristart' => $fristart,
                'friclose' => $friclose,
                'satstart' => $satstart,
                'satclose' => $satclose,
                'sunstart' => $sunstart,
                'sunclose' => $sunclose
            );
            $result = $this->Users->storeopenclose($data, $userId);
            if ($result) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 1)));
            } else {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0)));
            }
        }
    }

    public function shopAnalytics() {

        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->Users->selectUser($userId);
        $data['allscats'] = $this->Category->allsubcats();
        $data['pcatandsubcat'] = $this->Category->pcatAndSubcat();
        $data['allitems'] = $this->Items->allSellerItems($userId);
        $data['allpackages'] = $this->Itemspackage->allSellerPackages($userId);
        foreach ($data['user'] as $user) {
            $active = $user->shop_status;
            $visits = $user->visits;
        }

        $data['shopactive'] = $active;
        $data['visits'] = $visits;
        $data['themes'] = $this->Themes->allThemes();
        $data['allprovinces'] = $this->Location->allprovinces();
        $this->load->view('seller/header', $data);
        $this->load->view('seller/shopanalytics', $data);
        $this->load->view('public/footer');
    }

}
