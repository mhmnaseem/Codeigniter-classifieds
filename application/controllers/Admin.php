<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library(array('email', 'form_validation', 'image_lib'));
        $this->load->model(array('Category', 'Users', 'Items', 'Themes', 'Venues', 'Itemspackage', 'Location', 'Slider'));
    }

    // ------------------------------------------------------------------------
    /**
     * Index page
     */
    public function index() {
        $data['allscats'] = $this->Category->allsubcats();
        $data['pcatandsubcat'] = $this->Category->pcatAndSubcat();
        $data['pendingitems'] = $this->Items->adminPendingItems();
        $data['pendingitemsedits'] = $this->Items->adminPendingItemsEdits();
        $data['pendingitemspackage'] = $this->Itemspackage->adminPendingItemsPackage();
        $data['pendingitemspackageedit'] = $this->Itemspackage->adminPendingItemsPackageEdit();
        $data['recentusers'] = $this->Users->recentusers();
        $data['usershops'] = $this->Users->usershops();
        $this->load->view('admin/header');
        $this->load->view('admin/index', $data);
    }

    public function manageUser() {

        $data['alladminusers'] = $this->Users->allAdminUsers();
        $data['allsellerusers'] = $this->Users->allSellerUsers();


        $this->load->view('admin/header');
        $this->load->view('admin/manage-user', $data);
    }

    public function deleteusers($id) {

        $matcheditems = $this->Items->usermacheditems($id);
        $matchedpacks = $this->Items->usermachedpackages($id);

        foreach ($matcheditems as $mitems) {

            //delete matched images
            $matchedimages = $this->Items->matched_images($mitems->itemid);
            foreach ($matchedimages as $mimage) {

                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

                $this->db->where('gallery_id', $mimage->gallery_id);
                $this->db->delete('item_gallery');
            }

            $this->db->where('id', $mitems->itemid);
            $this->db->delete('items');
        }

        foreach ($matchedpacks as $mpacks) {

            //delete matched images
            $matchedimages = $this->Itemspackage->matched_images($mpacks->package_id);
            foreach ($matchedimages as $mimage) {
                //unlink($_SERVER['DOCUMENT_ROOT'] . '/dev/items/' . $mimage->image);

                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

                $this->db->where('item_package_id', $mimage->item_package_id);
                $this->db->delete('items_package_gallery');
            }


            $this->db->where('package_id', $mpacks->package_id);
            $this->db->delete('items_package');
        }


        $delete_user = $this->Users->deleteUsers($id);

        if ($delete_user != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Account Successfull..!</span></div>');
            redirect('admin/manageUser');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Account..!</span></div>');

            redirect('admin/manageUser');
        }
    }

    public function edituser($id) {

        if ($this->input->post()) {

            $utype = $this->input->post('acctype');

            $status = $this->input->post('status');

            $fname = $this->input->post('username1');

            $lname = $this->input->post('username2');

            //$email = $this->input->post('email');

            $company = $this->input->post('company');
            $mobile = $this->input->post('mobile');
            //$land = $this->input->post('land');


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
            $data['name_slug'] = $this->slug->create_uri($data, $id);
            $name_slug = $data['name_slug'];


            $updateuser = $this->Users->updateUser_admin($id, $fname, $lname, $company, $mobile, $utype, $status);

            if ($updateuser != '') {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Updating Account Successfull..!</span></div>');
                redirect('admin/edituser/' . $id);
//                $data['user'] = $this->Users->selectUser($id);
//                $data['userid'] = $id;
//                $this->load->view('admin/header');
//
//                $this->load->view('admin/edituser', $data);
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Updating Account..!</span></div>');
                $data['user'] = $this->Users->selectUser($id);
                $data['userid'] = $id;
                $this->load->view('admin/header');

                $this->load->view('admin/edituser', $data);
            }
        } else {

            $data['user'] = $this->Users->selectUser($id);
            $data['userid'] = $id;
            $this->load->view('admin/header');

            $this->load->view('admin/edituser', $data);
        }
    }

    public function adduser() {


        if ($this->input->post()) {

            $utype = $this->input->post('acctype');
            $fname = $this->input->post('username1');
            $lname = $this->input->post('username2');
            $email = $this->input->post('email');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
            $password = sha1($this->input->post('password'));
            $company = $this->input->post('company');
            $mobile = $this->input->post('mobile');

            $foget_pwd = md5(rand(1, 1000000));
            $hash = sha1(rand(1000, 200000000));
            $active = 1;


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



            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><span>An Account with that Email address already Exist!.  Please use a different email or use the forgotten password to reset your password</span></div>');

                redirect("admin/manageUser");
            } else {

                $insert_user = $this->Users->signup_admin($fname, $lname, $email, $password, $company, $mobile, $foget_pwd, $hash, $active, $utype);

                if ($insert_user != '') {


                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Adding New Account Successfull..!</span></div>');

                    redirect('admin/manageUser');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Updating Account..!</span></div>');
                    redirect('admin/manageUser');
                }
            }
        } else {

            $this->load->view('admin/header');
            $this->load->view('admin/add-user');
        }
    }

    public function addMainCat() {
        if ($this->input->post()) {
            $cname = $this->input->post('cname');
            $curl = $this->input->post('curl');
            $dis = $this->input->post('dis');



            //$file_name = null;
            $file = $_FILES['userfile'];



            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/catergory",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => 0,
                    'quality' => "100%",
                    'encrypt_name' => TRUE,
                );


                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {


                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];
                }

                $addmcat = $this->Category->addCategoryWImg($cname, $curl, $dis, $file_name);
            } else {
                $addmcat = $this->Category->addCategory($cname, $curl, $dis);
            }



            if ($addmcat != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Main Catergory Added Successfully...!</span></div>');
                redirect('admin/manageMainCat');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With adding Main Catergory...!</span></div>');
                $this->load->view('admin/header');
                $this->load->view('admin/addmaincat');
            }
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/addmaincat');
        }
    }

    public function ManageMainCat() {
        $data['allcats'] = $this->Category->allcats();
        $this->load->view('admin/header');
        $this->load->view('admin/managemaincat', $data);
    }

    public function EditMainCat($id) {

        if ($this->input->post()) {
            $cname = $this->input->post('cname');
            $id = $this->input->post('id');
            $curl = $this->input->post('curl');
            $dis = $this->input->post('dis');



            //$file_name = null;
            $file = $_FILES['userfile'];

            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/catergory",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => 0,
                    'quality' => "100%",
                    'encrypt_name' => TRUE
                );



                $this->load->library('upload', $upload_data);

                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {


                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];
                }

                $update = $this->Category->updateCategoryWImg($id, $cname, $curl, $dis, $file_name);
            } else {
                $update = $this->Category->updateCategory($id, $cname, $curl, $dis);
            }





            if ($update != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Main Catergory Updated Successfully...!</span></div>');
                redirect("admin/ManageMainCat");
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Updating Main Catergory...!</span></div>');
                $data['singlemaincat'] = $this->Category->singlemaincat($id);
                $data['maincatid'] = $id;
                $this->load->view('admin/header');
                $this->load->view('admin/editmaincat', $data);
            }
        } else {

            $data['singlemaincat'] = $this->Category->singlemaincat($id);
            $data['maincatid'] = $id;
            $this->load->view('admin/header');
            $this->load->view('admin/editmaincat', $data);
        }
    }

    public function deleteMainCat($id) {

        $delete_cat = $this->Category->deleteMainCat($id);

        if ($delete_cat != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Main Catergory Successfull..!</span></div>');
            redirect('admin/ManageMainCat');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Main Catergory..!</span></div>');

            redirect('admin/ManageMainCat');
        }
    }

    public function addSubCat() {

        if ($this->input->post()) {

            $curl = $this->input->post('curl');
            $scname = $this->input->post('cname');
            $pcat = $this->input->post('pcat');
            $dis = $this->input->post('dis');


            //$file_name = null;
            $file = $_FILES['userfile'];



            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/catergory",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => 0,
                    'quality' => "100%",
                    'encrypt_name' => TRUE,
                );


                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {


                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];
                }

                $addScat = $this->Category->addSubCategoryWImg($scname, $curl, $dis, $pcat, $file_name);
            } else {
                $addScat = $this->Category->addSubCategory($scname, $curl, $dis, $pcat);
            }



            if ($addScat != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Sub Catergory Added Successfully...!</span></div>');
                redirect('admin/manageSubCat');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With adding Sub Catergory...!</span></div>');
                $data['allMcats'] = $this->Category->allcats();
                $this->load->view('admin/header');
                $this->load->view('admin/addsubcat');
            }
        } else {
            $data['allMcats'] = $this->Category->allcats();
            $this->load->view('admin/header');
            $this->load->view('admin/addsubcat', $data);
        }
    }

    public function ManageSubCat() {
        $data['allsubcats'] = $this->Category->allsubcats();
        $data['allcats'] = $this->Category->allcats();
        $this->load->view('admin/header');
        $this->load->view('admin/managesubcat', $data);
    }

    public function EditSubCat($id) {

        if ($this->input->post()) {
            $cname = $this->input->post('cname');
            $pcat = $this->input->post('pcat');
            $curl = $this->input->post('curl');
            $dis = $this->input->post('dis');



            //$file_name = null;
            $file = $_FILES['userfile'];

            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/catergory",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => 0,
                    'quality' => "100%",
                    'encrypt_name' => TRUE
                );



                $this->load->library('upload', $upload_data);

                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {


                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];
                }

                $update = $this->Category->updateSubCategoryWImg($id, $cname, $curl, $dis, $pcat, $file_name);
            } else {
                $update = $this->Category->updateSubCategory($id, $cname, $curl, $dis, $pcat);
            }





            if ($update != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Sub Catergory Updated Successfully...!</span></div>');
                redirect("admin/ManagesubCat");
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Updating Sub Catergory...!</span></div>');
                $data['singlesubcat'] = $this->Category->singleSubcat($id);
                $data['cats'] = $this->Category->allcats();
                $data['subcatid'] = $id;
                $this->load->view('admin/header');
                $this->load->view('admin/editsubcat', $data);
            }
        } else {

            $data['singlesubcat'] = $this->Category->singleSubcat($id);
            $data['cats'] = $this->Category->allcats();
            $data['subcatid'] = $id;
            $this->load->view('admin/header');
            $this->load->view('admin/editsubcat', $data);
        }
    }

    public function deleteSubCat($id) {

        $delete_cat = $this->Category->deleteSubCat($id);

        if ($delete_cat != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Sub Catergory Successfull..!</span></div>');
            redirect('admin/ManageSubCat');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Sub Catergory..!</span></div>');

            redirect('admin/ManageSubCat');
        }
    }

    public function manageItems() {
        $data['allscats'] = $this->Category->allsubcats();
        $data['pcatandsubcat'] = $this->Category->pcatAndSubcat();
        $data['allitems'] = $this->Items->allItems();
        $this->load->view('admin/header');
        $this->load->view('admin/manageitems', $data);
    }

    public function managepackage() {

        $data['allpackages'] = $this->Itemspackage->allpackages();
        $this->load->view('admin/header');
        $this->load->view('admin/managepackages', $data);
    }

    public function deleteItemPackage($id) {

        //delete matched images
        $matchedimages = $this->Itemspackage->matched_images($id);
        foreach ($matchedimages as $mimage) {
            //unlink($_SERVER['DOCUMENT_ROOT'] . '/dev/items/' . $mimage->image);

            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/items/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/thumb/' . $mimage->image);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/gallery/' . $mimage->image);

            $this->db->where('item_package_id', $mimage->item_package_id);
            $this->db->delete('items_package_gallery');
        }

        $delete_Item_Package = $this->Itemspackage->deleteItemPackageById($id);

        if ($delete_Item_Package != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item Package Deleted Successfully..!</span></div>');
            redirect('admin/managepackage');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Item Package..!</span></div>');

            redirect('admin/managepackage');
        }
    }

    public function EditItem($id) {


        if ($this->input->post()) {
            $title = $this->input->post('title');
            $des = $this->input->post('description');
            $pprice = $this->input->post('pprice');
            $rprice = $this->input->post('rprice');
            $package = $this->input->post('package');
            $theme = $this->input->post('theme');
            $category = $this->input->post('category');
            $city_id = $this->input->post('city');


            //get province_id

            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }



            $updateitem = $this->Items->updateItem_admin($id, $title, $des, $pprice, $rprice, $package, $theme, $district, $city_id, $category);

            if ($updateitem != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Item updated Successfully..!</span></div>');

                redirect("admin/edititem/" . $id);
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error Updating Item...!</span></div>');
                $data['themes'] = $this->Themes->allThemes();

                $data['selecteditem'] = $this->Items->SelectedItem($id);
                $data['id'] = $id;
                $data['allcats'] = $this->Category->allcats();
                $data['allscats'] = $this->Category->allsubcats();
                $data['allImages'] = $this->Items->allItemImages($id);
                $data['allprovinces'] = $this->Location->allprovinces();
                $data['allcities'] = $this->Location->allcities();
                $data['themes'] = $this->Themes->allThemes();
                $this->load->view('admin/header', $data);
                $this->load->view('admin/edititem', $data);
            }
        } else {
            $data['selecteditem'] = $this->Items->SelectedItem($id);
            $data['id'] = $id;
            $data['allcats'] = $this->Category->allcats();
            $data['allscats'] = $this->Category->allsubcats();
            $data['allImages'] = $this->Items->allItemImages($id);
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $data['themes'] = $this->Themes->allThemes();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/edititem', $data);
        }
    }

    public function viewItem($id) {
        $data['selecteditem'] = $this->Items->SelectedItem($id);
        $data['allcats'] = $this->Category->allcats();
        $data['allscats'] = $this->Category->allsubcats();
        $data['allImages'] = $this->Items->allItemImages($id);
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['allcities'] = $this->Location->allcities();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/viewitem', $data);
    }

    public function viewEditItem($id) {
        $data['selecteditem'] = $this->Items->SelectedItem($id);
        $data['selecteditemedit'] = $this->Items->SelectedItemedit($id);
        $data['allcats'] = $this->Category->allcats();
        $data['allscats'] = $this->Category->allsubcats();
        $data['allImages'] = $this->Items->allItemImages($id);
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['allcities'] = $this->Location->allcities();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/view_edit_item', $data);
    }

    public function deleteItem($id) {

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

        $delete_Item = $this->Items->deleteItem($id);

        if ($delete_Item != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Item Successfull..!</span></div>');
            redirect('admin/ManageItems');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Item..!</span></div>');

            redirect('admin/ManageItems');
        }
    }

    public function EdititemimageUpload($id) {

        $result = $this->Items->uploaded_imgs($id);

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
        $image_config['quality'] = "100%";
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
        $image_config['quality'] = "100%";
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

    public function deleteimagegallery() {

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
                    ->set_output(json_encode($this->Items->deleteimagegallery($_POST['id'])));
        }
    }

    public function EditItemPackage($id) {


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



//get province_id

            $cities = $this->Location->getProvinceId($city_id);
            $district = '';
            foreach ($cities as $city) {
                $district = $city->province_id;
            }



            $updateitempackage = $this->Itemspackage->update_item_package_admin($id, $title, $theme, $description, $district, $city_id, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes);

            if ($updateitempackage != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Package Updated Successfully...!</span></div>');

                redirect("admin/EditItemPackage/" . $id);
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error Updating Package...!</span></div>');
                $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
                $data['id'] = $id;
                $data['allImages'] = $this->Itemspackage->allItemPackageImages($id);
                $data['allprovinces'] = $this->Location->allprovinces();
                $data['allcities'] = $this->Location->allcities();
                $data['venues'] = $this->Venues->allVenues();
                $this->load->view('admin/header', $data);
                $this->load->view('admin/editpackage', $data);
            }
        } else {

            $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
            $data['id'] = $id;
            $data['allImages'] = $this->Itemspackage->allItemPackageImages($id);
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['allcities'] = $this->Location->allcities();
            $data['venues'] = $this->Venues->allVenues();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/editpackage', $data);
        }
    }

    public function viewItemPackage($id) {

        $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
        $data['allImages'] = $this->Itemspackage->allItemPackageImages($id);
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['allcities'] = $this->Location->allcities();
        $data['venues'] = $this->Venues->allVenues();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/viewpackage', $data);
    }

    public function viewItemPackageedit($id) {

        $data['selecteditempackage'] = $this->Itemspackage->SelectedItemPackage($id);
        $data['packageedit'] = $this->Itemspackage->SelectedItemPackageedit($id);
        $data['allImages'] = $this->Itemspackage->allItemPackageImages($id);
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['allcities'] = $this->Location->allcities();
        $data['venues'] = $this->Venues->allVenues();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/view_edit_package', $data);
    }

    public function addTheme() {
        if ($this->input->post()) {
            $themename = $this->input->post('name');
            $type = $this->input->post('type');

            //$file_name = null;
            $file = $_FILES['userfile'];

            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/themes",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => '4048KB',
                    'quality' => "100%",
                    'overwrite' => FALSE,
                    'width' => 720,
                    'height' => 540
                );


                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {

                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];

                    $image_config["image_library"] = "gd2";
                    $image_config["source_image"] = $uploaded_file['full_path'];
                    $image_config['maintain_ratio'] = false;
                    $image_config['new_image'] = './files/themes';
                    $image_config['quality'] = "100%";
                    $image_config['width'] = 720;
                    $image_config['height'] = 540;
                    $dim = (intval($upload_data["width"]) / intval($upload_data["height"])) - ($image_config['width'] / $image_config['height']);
                    $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

                    $this->image_lib->initialize($image_config);

                    $this->image_lib->resize();


                    $image_config['image_library'] = 'gd2';
                    $image_config['source_image'] = $uploaded_file['full_path'];
                    $image_config['new_image'] = './files/themes';
                    $image_config['quality'] = "100%";
                    $image_config['overwrite'] = FALSE;
                    $image_config['maintain_ratio'] = FALSE;
                    $image_config['width'] = 720;
                    $image_config['height'] = 540;
                    $image_config['x_axis'] = '0';
                    $image_config['y_axis'] = '0';

                    $this->image_lib->clear();
                    $this->image_lib->initialize($image_config);

                    $this->image_lib->crop();


                    $addtheme = $this->Themes->addtheme($themename, $type, $file_name);
                }
            }

            if ($addtheme != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Theme Added Successfully...!</span></div>');
                redirect('admin/manageThemes');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With adding Theme...!</span></div>');
                $this->load->view('admin/header');
                $this->load->view('admin/addthemes');
            }
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/addthemes');
        }
    }

    public function manageThemes() {

        $data['allthemes'] = $this->Themes->allThemes();
        $this->load->view('admin/header');
        $this->load->view('admin/managethemes', $data);
    }

    public function deleteTheme($id) {

        $delete_Themes = $this->Themes->deleteTheme($id);

        if ($delete_Themes != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Theme Successfull..!</span></div>');
            redirect('admin/manageThemes');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Theme..!</span></div>');

            redirect('admin/manageThemes');
        }
    }

    public function addVenue() {
        if ($this->input->post()) {
            $title = $this->input->post('title');
            $address = $this->input->post('address');
            $telephone = $this->input->post('telephone');
            $email = $this->input->post('email');
            $web = $this->input->post('web');


            //$file_name = null;
            $file = $_FILES['userfile'];



            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/venues",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => '4048KB',
                    'quality' => "100%",
                    'overwrite' => FALSE,
                    'width' => 720,
                    'height' => 540
                );


                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {

                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];

                    $image_config["image_library"] = "gd2";
                    $image_config["source_image"] = $uploaded_file['full_path'];
                    $image_config['maintain_ratio'] = false;
                    $image_config['new_image'] = './files/venues';
                    $image_config['quality'] = "100%";
                    $image_config['width'] = 720;
                    $image_config['height'] = 540;
                    $dim = (intval($upload_data["width"]) / intval($upload_data["height"])) - ($image_config['width'] / $image_config['height']);
                    $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

                    $this->image_lib->initialize($image_config);

                    $this->image_lib->resize();
                }
                $addvenue = $this->Venues->addVenue($title, $address, $telephone, $email, $web, $file_name);
            }

            if ($addvenue != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Venue Added Successfully...!</span></div>');
                redirect('admin/manageVenues');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With adding Venue...!</span></div>');
                $this->load->view('admin/header');
                $this->load->view('admin/addvenues');
            }
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/addvenues');
        }
    }

    public function manageVenues() {

        $data['allvenues'] = $this->Venues->allVenues();
        $this->load->view('admin/header');
        $this->load->view('admin/managevenues', $data);
    }

    public function deleteVenue($id) {

        $delete_Venue = $this->Venues->deletevenue($id);

        if ($delete_Venue != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Venue Successfull..!</span></div>');
            redirect('admin/manageVenues');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Venue..!</span></div>');

            redirect('admin/manageVenues');
        }
    }

    public function approveItem() {
        $id = $this->input->get('var1');
        $option = $this->input->get('var2');

        $singleItem = $this->Items->itemById($id);

        $title = '';
        $user = '';
        foreach ($singleItem as $item) {
            $title = $item->title;
            $user = $item->user_id;
            $slug = $item->slug;
        }

        $select_user = $this->Users->selectUser($user);

        $user_email = '';
        foreach ($select_user as $user_data) {
            $user_email = $user_data->email;
        }

        if ($option == 'approve') {
            $val = 'yes';
            $approve = $this->Items->approveItem($id, $val);

            $this->email->clear();
            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->subject('Birthdays.lk Item Approved -' . $title);
            $subject = 'Birthdays.lk Item Approved -' . $title;
            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Item with Birthdays.lk has been approved and is now listed on our website.</p>
                        <p> Title : ' . $title . ' <br>
                        <p> Your Item is Here <a target="_blank" href="' . base_url('item/') . $slug . '"> Click Here to View </a>
                            <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

// Get full html:
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

            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Item Approved Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval ..!</span></div>');
            }
        } else if ($option == 'declin') {
            $val = 'declin';
            $approve = $this->Items->approveItem($id, $val);

            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');

            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Item with Birthdays.lk has not been approved.</p>
                        <p> Title : ' . $title . '<br><p>ID:' . $id . '</p>
                            <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

            $this->email->subject('Birthdays.lk Item Approval Declined -' . $title);

            $subject = 'Birthdays.lk Item Declined -' . $title;


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


            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Item Declined Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval ..!</span></div>');
            }
        }
    }

    public function editapproveItem() {
        $id = $this->input->get('var1');
        $option = $this->input->get('var2');

        $singleItem = $this->Items->itemById($id);
        $itemEditInfo = $this->Items->itemEditById($id);

        foreach ($itemEditInfo as $editdata) {
            $titleedit = $editdata->title;
            $category = $editdata->category;
            $description = $editdata->description;
            $rprice = $editdata->rprice;
            $pprice = $editdata->pprice;
            $package = $editdata->package;
            $district = $editdata->district;
            $city = $editdata->city;
            $theme = $editdata->theme;
        }

        $title = '';
        $user = '';
        foreach ($singleItem as $item) {
            $title = $item->title;
            $user = $item->user_id;
            $slug = $item->slug;
        }

        $select_user = $this->Users->selectUser($user);

        $user_email = '';
        foreach ($select_user as $user_data) {
            $user_email = $user_data->email;
        }

        if ($option == 'approve') {

            $approve = $this->Items->approveItemEdit($id, $titleedit, $category, $description, $rprice, $pprice, $package, $district, $city, $theme);

            $this->email->clear();
            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->subject('Birthdays.lk Item Changes Approved -' . $title);
            $subject = 'Birthdays.lk Item Changes Approved -' . $title;
            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Item Changes with Birthdays.lk has been approved and is now listed on our website.</p>
                        <p> Title : ' . $title . ' <br>
                        <p> Your Item is Here <a target="_blank" href="' . base_url('item/') . $slug . '"> Click Here to View </a> <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

// Get full html:
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

            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Item Edit Approved Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval of Item Edit..!</span></div>');
            }
        } else if ($option == 'declin') {
            $val = 'yes';
            $approve = $this->Items->approveItem($id, $val);

            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');

            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Item Changes with Birthdays.lk has not been approved.</p>
                        <p> Title : ' . $title . '<br><p>ID:' . $id . '</p> <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

            $this->email->subject('Birthdays.lk Item Changes Approval Declined -' . $title);

            $subject = 'Birthdays.lk Item Changes Declined -' . $title;


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


            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Item Changes Declined Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval of Item Edit..!</span></div>');
            }
        }
    }

    public function approvePackage() {
        $id = $this->input->get('var1');
        $option = $this->input->get('var2');

        $singlepackage = $this->Itemspackage->packgeById($id);

        $title = '';
        $user = '';
        foreach ($singlepackage as $package) {
            $title = $package->title;
            $user = $package->user_id;
            $slug = $package->slug;
        }

        $select_user = $this->Users->selectUser($user);

        $user_email = '';
        foreach ($select_user as $user_data) {
            $user_email = $user_data->email;
        }

        if ($option == 'approve') {
            $val = 'yes';
            $approve = $this->Itemspackage->approvePackage($id, $val);

            $this->email->clear();
            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->subject('Birthdays.lk Package Approved -' . $title);
            $subject = 'Birthdays.lk Package Approved -' . $title;
            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Package with Birthdays.lk has been approved and is now listed on our website.</p>
                       <p> Title : ' . $title . ' <br>
                       <p> Your Package is Here <a target="_blank" href="' . base_url('package/') . $slug . '"> Click Here to View </a> <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

// Get full html:
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

            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Package Approved Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval ..!</span></div>');
            }
        } else if ($option == 'declin') {
            $val = 'declin';
            $approve = $this->Itemspackage->approvePackage($id, $val);

            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');

            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Package with Birthdays.lk has not been approved.</p>
                        <p> Title : ' . $title . '<br><p>ID:' . $id . '</p> <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

            $this->email->subject('Birthdays.lk Package Approval Declined -' . $title);

            $subject = 'Birthdays.lk Package Declined -' . $title;


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


            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Package Declined Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval ..!</span></div>');
            }
        }
    }

    public function editapprovePackage() {
        $id = $this->input->get('var1');
        $option = $this->input->get('var2');

        $singlepackage = $this->Itemspackage->packgeById($id);
        $packEditInfo = $this->Itemspackage->editPackgeById($id);

        foreach ($packEditInfo as $editpackage) {

            $titleedit = $editpackage->title;
            $theme = $editpackage->theme;
            $description = $editpackage->description;
            $district = $editpackage->district;
            $city = $editpackage->city;
            $package_for = $editpackage->package_for;
            $venue = $editpackage->venue;
            $delivery_cost = $editpackage->delivery_cost;
            $service_charge = $editpackage->service_charge;
            $other_charges = $editpackage->other_charges;
            $party_hours = $editpackage->party_hours;
            $party_minutes = $editpackage->party_minutes;
            $children_min = $editpackage->children_min;
            $children_max = $editpackage->children_max;
            $adult_min = $editpackage->adult_min;
            $adult_max = $editpackage->adult_max;
            $child_age_min = $editpackage->child_age_min;
            $child_age_max = $editpackage->child_age_max;
            $childern_per_head = $editpackage->childern_per_head;
            $adult_per_head = $editpackage->adult_per_head;
            $package_price = $editpackage->package_price;
            $type_food_package = $editpackage->type_food_package;
            $no_persons_served = $editpackage->no_persons_served;
            $waiters_provided = $editpackage->waiters_provided;
            $food_per_head_charge = $editpackage->food_per_head_charge;
            $food_package_price = $editpackage->food_package_price;
            $food_plates = $editpackage->food_plates;
            $food_cups = $editpackage->food_cups;
            $food_straws = $editpackage->food_straws;
            $food_napkins = $editpackage->food_napkins;
            $food_cutlery = $editpackage->food_cutlery;
            $food_chafing_dishes = $editpackage->food_chafing_dishes;
        }






        $title = '';
        $user = '';
        foreach ($singlepackage as $package) {
            $title = $package->title;
            $user = $package->user_id;
            $slug = $package->slug;
        }

        $select_user = $this->Users->selectUser($user);

        $user_email = '';
        foreach ($select_user as $user_data) {
            $user_email = $user_data->email;
        }

        if ($option == 'approve') {

            $approve = $this->Itemspackage->approvePackageEdit($id, $titleedit, $theme, $description, $district, $city, $package_for, $venue, $delivery_cost, $service_charge, $other_charges, $party_hours, $party_minutes, $children_min, $children_max, $adult_min, $adult_max, $child_age_min, $child_age_max, $childern_per_head, $adult_per_head, $package_price, $type_food_package, $no_persons_served, $waiters_provided, $food_per_head_charge, $food_package_price, $food_plates, $food_cups, $food_straws, $food_napkins, $food_cutlery, $food_chafing_dishes);

            $this->email->clear();
            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->subject('Birthdays.lk Package Changes Approved -' . $title);
            $subject = 'Birthdays.lk Package Changes Approved -' . $title;
            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Package Changes with Birthdays.lk has been approved and is now listed on our website.</p>
                       <p> Title : ' . $title . ' <br>
                       <p> Your Package is Here <a target="_blank" href="' . base_url('package/') . $slug . '"> Click Here to View </a> <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

// Get full html:
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

            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Package Edit Approved Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval ..!</span></div>');
            }
        } else if ($option == 'declin') {
            $val = 'yes';
            $approve = $this->Itemspackage->approvePackage($id, $val);

            $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
            $this->email->to($user_email);
            $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');

            $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Package Changes with Birthdays.lk has not been approved.</p>
                        <p> Title : ' . $title . '<br><p>ID:' . $id . '</p> <br>
                        <p>Thanks,<br>

                        The Birthdays.lk team</p>';

            $this->email->subject('Birthdays.lk Package Changes Approval Declined -' . $title);

            $subject = 'Birthdays.lk Package Changes Declined -' . $title;


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


            if ($approve == 'ok') {

                if ($this->email->send()) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span> Package Declined Successfully ..!</span></div>');

                    redirect('admin');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Approval ..!</span></div>');
            }
        }
    }

    public function addslider() {

        if ($this->input->post()) {

            $link = $this->input->post('link');

            //$file_name = null;
            $file = $_FILES['userfile'];

            if ($file['name'] != '') {


                $upload_data = array(
                    'upload_path' => "./files/slider",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'max_size' => '4048KB'
                );


                $file_name = "";
                $this->load->library('upload', $upload_data);
                if ($this->upload->do_upload('userfile')) {

                    $uploaded_file = $this->upload->data();
                    $file_name = $uploaded_file['file_name'];

                    $image_config['image_library'] = 'gd2';
                    $image_config['source_image'] = $uploaded_file['full_path'];
                    $image_config['new_image'] = './files/slider';
                    $image_config['quality'] = 70;
                    $image_config['overwrite'] = FALSE;
                    $image_config['maintain_ratio'] = FALSE;
                    $image_config['width'] = 1400;
                    $image_config['height'] = 450;
                    $image_config['x_axis'] = '0';
                    $image_config['y_axis'] = '0';

                    $this->image_lib->clear();
                    $this->image_lib->initialize($image_config);

                    $this->image_lib->crop();
                }
                $addslide = $this->Slider->addslide($link, $file_name);
            }

            if ($addslide != '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Adding New Slider Successfull..!</span></div>');
                redirect('admin/manageslider');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Adding Slider..!</span></div>');
                //echo mysql_error();
                redirect('admin/manageslider');
            }
        } else {

            $this->load->view('admin/header');
            $this->load->view('admin/addslider');
        }
    }

    public function manageslider() {

        $data['allslides'] = $this->Slider->allslides();

        $this->load->view('admin/header');
        $this->load->view('admin/manageslider', $data);
    }

    public function deleteslide($id) {



        $delete_user = $this->Slider->deleteslide($id);

        if ($delete_user != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><span>Deleting Slide Successfull..!</span></div>');
            redirect('admin/manageslider');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><span>Error With Deleteing Slide..!</span></div>');

            redirect('admin/manageslider');
        }
    }

    public function download() {

        $subscribers = $this->Users->exportusers();

        require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

// Set document properties
        $spreadsheet->getProperties()->setCreator('Birthdays.lk ')
                ->setLastModifiedBy('Mahmud Naseem')
                ->setTitle('User Information')
                ->setSubject('export user Info')
                ->setDescription('export user Info');

        // add style to the header
        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'top' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'fill' => array(
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array(
                    'argb' => 'FFA0A0A0',
                ),
                'endcolor' => array(
                    'argb' => 'FFFFFFFF',
                ),
            ),
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);


        // auto fit column to content

        foreach (range('A', 'F') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }
        // set the names of header cells
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue("A1", 'First Name')
                ->setCellValue("B1", 'Last Name')
                ->setCellValue("C1", 'UserEmail')
                ->setCellValue("D1", 'Company')
                ->setCellValue("E1", 'Mobile')
                ->setCellValue("F1", 'Gender');

        // Add some data
        $x = 2;
        foreach ($subscribers as $sub) {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("A$x", $sub['fname'])
                    ->setCellValue("B$x", $sub['lname'])
                    ->setCellValue("C$x", $sub['email'])
                    ->setCellValue("D$x", $sub['company'])
                    ->setCellValue("E$x", $sub['mobile']);
            $x++;
        }



// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Users Information');

// set right to left direction
//		$spreadsheet->getActiveSheet()->setRightToLeft(true);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Users_data_sheet.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
        $writer->save('php://output');
        exit;

        //  create new file and remove Compatibility mode from word title
    }

    public function createshop($hash, $id) {

        //$userId = $this->session->userdata('user_id');
        $result = $this->Users->checkvalidity($hash, $id);
        if ($result) {

            $data['user'] = $this->Users->selectUser($id);
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
            $data['id'] = $id;
            $data['store_info'] = $store_info;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/createshop', $data);
        } else {
            http_response_code(404);
            redirect('404');
        }
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

            $userId = $this->input->post("id");

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
            $userId = $this->input->post("id");

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
            $userId = $this->input->post("id");
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
            $userId = $this->input->post("id");
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
            $userId = $this->input->post("id");
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
            $userId = $this->input->post("id");
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

            $userId = $this->input->post("id");
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
            $userId = $this->input->post("id");

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

}
