<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library(array('email', 'form_validation', 'pagination', 'encrypt'));
        $this->load->model(array('Category', 'Users', 'Items', 'Themes', 'Venues', 'Itemspackage', 'Slider', 'Location'));
    }

// ------------------------------------------------------------------------
    /**
     * Index page
     */
    public function index() {

        $data['allslides'] = $this->Slider->allslides();
        $data['allprovinces'] = $this->Location->allprovinces();


        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');

            $data['allitems'] = $this->Items->recentItems_filter($filter);
        } else {
            $data['allitems'] = $this->Items->recentItems();
        }

        $data['themes'] = $this->Themes->allThemes();

        $data['totalfood'] = $this->Itemspackage->record_countall_food_Package();
        $data['totalparty'] = $this->Itemspackage->record_countall_party_Package();

        $party = array('16', '17', '18', '19', '20', '24', '25');
        $food = array('26', '27', '28');
        $games = array('29', '30', '31');
        $decoration = array('20');
        $balloons = array('24');
        $birthdaycakes = array('26');
        $photography = array('108');
        $data['totalpartyitems'] = $this->Items->record_countall_home_main_cat($party);
        $data['totalfoods'] = $this->Items->record_countall_home_main_cat($food);
        $data['totalgames'] = $this->Items->record_countall_home_main_cat($games);
        $data['totaldecorations'] = $this->Items->record_countall_home_main_cat($decoration);
        $data['totalballoons'] = $this->Items->record_countall_home_main_cat($balloons);
        $data['totalbirthdaycakes'] = $this->Items->record_countall_home_main_cat($birthdaycakes);
        $data['totalvenues'] = $this->Venues->record_count_all_venues();
        $data['totalphotograpy'] = $this->Items->record_countall_subcat($photography);


        $data['meta'] = array(
            array('name' => 'keywords', 'content' => 'birthday, birthdays, party, party items, venue, venues, foods, services, Party Packages, cake, balloons'),
            array('name' => 'description', 'content' => 'party items, foods, services, venues, party packages in Sri Lanka')
        );

        $this->load->view('public/header', $data);
        $this->load->view('public/index', $data);
        $this->load->view('public/footer');
    }

//    public function index() {
//
//        $this->load->view('public/maintance');
//    }

    public function singleItem($slug) {

        $data['singleitem'] = $this->Items->singleItemBySlug($slug);

        if (!empty($data['singleitem'])) {
            foreach ($data['singleitem'] as $singleItemId) {
                $id = $singleItemId->item_id;
                $subcat = $singleItemId->category;
            }

            $this->Items->update_item_view($id);
            $data['allImages'] = $this->Items->allItemImages($id);
            $data['pcatandsubcat'] = $this->Category->pcatAndSubcat();
            $data['allscats'] = $this->Category->allsubcats();
            $data['linkedpackages'] = $this->Itemspackage->itemsLinkedPackages($id);



            //related items

            $maincat = $this->Items->findParentCat($subcat);
            foreach ($maincat as $parentcat) {
                $parentcatid = $parentcat->parentcat;
            }

            foreach ($data['singleitem'] as $seotext) {

                $data['meta'] = array(
                    array('name' => 'keywords', 'content' => character_limiter($seotext->title, 60)),
                    array('name' => 'description', 'content' => character_limiter($seotext->description, 160))
                );

                $itemimage = base_url('files/items/') . $seotext->image;

                $data['title'] = character_limiter($seotext->title, 60);
                $data['description'] = character_limiter($seotext->description, 160);
                $data['single_image'] = $itemimage;
                $theme = $seotext->theme;
            }


            $data['relateditems'] = $this->Items->relatedItems($parentcatid, $id, $theme);

            $data['allprovinces'] = $this->Location->allprovinces();
            $data['themes'] = $this->Themes->allThemes();
            $this->load->view('public/header', $data);
            $this->load->view('public/singleitem', $data);
            $this->load->view('public/footer');
        } else {
            http_response_code(404);
            redirect('404');
        }
    }

    public function singlepackage($slug) {
        $data['singlepackage'] = $this->Itemspackage->singlePackBySlug($slug);
        if (!empty($data['singlepackage'])) {
            $id = '';
            $packtype = '';

            foreach ($data['singlepackage'] as $singlepackId) {
                $id = $singlepackId->pack_id;
                $packtype = $singlepackId->package_type;
            }
            $this->Itemspackage->update_package_view($id);
            $data['allImages'] = $this->Itemspackage->allItemPackageImages($id);

            //related packages
            $data['relatedpack'] = $this->Itemspackage->relatedPack($packtype, $id);

            $data['allprovinces'] = $this->Location->allprovinces();
            $data['themes'] = $this->Themes->allThemes();
            $data['allvenues'] = $this->Venues->allVenues();
            $data['linkeditems'] = $this->Itemspackage->alllinkeditems($id);
            //$data['alllinkeditemsimages'] = $this->Itemspackage->alllinkeditemsimages($id);


            foreach ($data['singlepackage'] as $seotext) {

                $data['meta'] = array(
                    array('name' => 'keywords', 'content' => character_limiter($seotext->title, 60)),
                    array('name' => 'description', 'content' => character_limiter($seotext->description, 160))
                );

                $itemimage = base_url('files/items/') . $seotext->image;

                $data['title'] = character_limiter($seotext->title, 60);
                $data['description'] = character_limiter($seotext->description, 160);
                $data['single_image'] = $itemimage;
            }

            $this->load->view('public/header', $data);
            $this->load->view('public/singlepackage', $data);
            $this->load->view('public/footer');
        } else {
            http_response_code(404);
            redirect('404');
        }
    }

    public function category($slug) {
        $filter = '';
        $id = '';
        $maincatslug = $this->Category->maincatslug($slug);

        if (!empty($maincatslug)) {
//print_r($maincatslug);
            foreach ($maincatslug as $mslug) {

                $id = $mslug->mcatid;
                $name = $mslug->name;
            }

//            if (count($_GET) > 0)
//                $config['suffix'] = '?' . http_build_query($_GET, '', "&");

            $config['base_url'] = base_url() . "category/" . $slug;

            if ($this->input->cookie('themeselected') != '') {
                $filter = $this->input->cookie('themevalue');
                $data['filter'] = $filter;

                $config['total_rows'] = $this->Items->record_countall_filter($id, $filter);
            } else {
                $config['total_rows'] = $this->Items->record_countall($id);
            }



            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config["uri_segment"] = 3;
            $config['display_pages'] = TRUE;
            $config['per_page'] = 15;


            // $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 1;
            $config['first_link'] = false;
            $config['last_link'] = false;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//        if (!empty($_GET['sort'])) {
//            $sort = $_GET['sort'];
//            $data["allmcatitems"] = $this->Items
//                    ->allItemsallcatsort($id, $config["per_page"], $page, $sort);
//        } else {
//            $data["allmcatitems"] = $this->Items
//                    ->allItemsallcat($id, $config["per_page"], $page);
//        }


            if ($this->input->cookie('themeselected') != '') {
                $filter = $this->input->cookie('themevalue');

                $data["allmcatitems"] = $this->Items
                        ->allItemsallcat_maincat_filter($id, $config["per_page"], $page, $filter);
            } else {
                $data["allmcatitems"] = $this->Items
                        ->allItemsallcat_maincat($id, $config["per_page"], $page);
            }

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['catid'] = $id;
            $data['items'] = $this->Items->allItems();
            $data['allcats'] = $this->Category->allcats();
            $data['allscats'] = $this->Category->allsubcats();

            $data['meta'] = array(
                array('name' => 'keywords', 'content' => character_limiter($name, 60)),
                array('name' => 'description', 'content' => character_limiter($name, 160))
            );
            $data['title'] = $name . ' | Birthdays.lk';
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['themes'] = $this->Themes->allThemes();
            $this->load->view('public/header', $data);
            $this->load->view('public/maincategory', $data);
            $this->load->view('public/footer');
        } else {
            http_response_code(404);
            redirect('404');
        }
    }

    public function subcategory($slug) {
        $filter = '';
        $id = '';
        $subcatslug = $this->Category->subcatslug($slug);

        if (!empty($subcatslug)) {
//print_r($maincatslug);
            foreach ($subcatslug as $sslug) {

                $id = $sslug->id;
                $name = $sslug->name;
            }

            $maincatslug = $this->Category->subCatSlugToMainCatSlug($slug);

            foreach ($maincatslug as $mslug) {

                $mainslug = $mslug->maincatslug;
            }
//            if (count($_GET) > 0)
//                $config['suffix'] = '?' . http_build_query($_GET, '', "&");

            $config['base_url'] = base_url() . "subcategory/" . $slug;

            if ($this->input->cookie('themeselected') != '') {
                $filter = $this->input->cookie('themevalue');
                $data['filter'] = $filter;

                $config['total_rows'] = $this->Items->record_countall_subcat_items_filter($id, $filter);
            } else {
                $config['total_rows'] = $this->Items->record_countall_subcat_items($id);
            }



            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config["uri_segment"] = 3;
            $config['display_pages'] = TRUE;
            $config['per_page'] = 15;


            // $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 1;
            $config['first_link'] = false;
            $config['last_link'] = false;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//        if (!empty($_GET['sort'])) {
//            $sort = $_GET['sort'];
//            $data["allmcatitems"] = $this->Items
//                    ->allItemsallcatsort($id, $config["per_page"], $page, $sort);
//        } else {
//            $data["allmcatitems"] = $this->Items
//                    ->allItemsallcat($id, $config["per_page"], $page);
//        }


            if ($this->input->cookie('themeselected') != '') {
                $filter = $this->input->cookie('themevalue');

                $data["allsubcatitems"] = $this->Items
                        ->allItems_sub_cat_filter($id, $config["per_page"], $page, $filter);
            } else {
                $data["allsubcatitems"] = $this->Items
                        ->allItems_sub_cat($id, $config["per_page"], $page);
            }

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['catid'] = $id;
            $data['maincatslug'] = $mainslug;
            $data['items'] = $this->Items->allItems();
            $data['allcats'] = $this->Category->allcats();
            $data['allscats'] = $this->Category->allsubcats();
            $data['pcatandsubcat'] = $this->Category->pcatAndSubcat();
            $data['subcatslug'] = $this->Items->slugTOcat();

            $data['meta'] = array(
                array('name' => 'keywords', 'content' => character_limiter($name, 60)),
                array('name' => 'description', 'content' => character_limiter($name, 160))
            );
            $data['title'] = $name . ' | Birthdays.lk';
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['themes'] = $this->Themes->allThemes();
            $this->load->view('public/header', $data);
            $this->load->view('public/subcategory', $data);
            $this->load->view('public/footer');
        } else {
            http_response_code(404);
            redirect('404');
        }
    }

    public function partyItems() {
        $filter = '';
        $id = array('16', '17', '18', '19', '20', '24', '25');
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['base_url'] = base_url() . "party-items";

        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');
            $data['filter'] = $filter;

            $config['total_rows'] = $this->Items->record_countall_home_main_cat_filter($id, $filter);
        } else {
            $config['total_rows'] = $this->Items->record_countall_home_main_cat($id);
        }
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config["uri_segment"] = 2;
        $config['display_pages'] = TRUE;
        $config['per_page'] = 15;
        $config['num_links'] = 1;

//        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
//        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['first_link'] = false;
        $config['last_link'] = false;

//        $choice = $config["total_rows"] / $config["per_page"];
//        $config["num_links"] = round($choice);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;



        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');


            $data["partyitems"] = $this->Items
                    ->homeMainCatFilter($id, $config["per_page"], $page, $filter);
        } else {
            $data["partyitems"] = $this->Items
                    ->homeMainCat($id, $config["per_page"], $page);
        }


//        if (!empty($_GET['sort'])) {
//            $sort = $_GET['sort'];
//            $data["allmcatitems"] = $this->Items
//                    ->allItemsallcatsort($id, $config["per_page"], $page, $sort);
//        } else {
//            $data["partyitems"] = $this->Items
//                    ->partyItemsCat($id, $config["per_page"], $page);
//        }



        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();


        $data['title'] = 'Party Items | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/partyitems', $data);
        $this->load->view('public/footer');
    }

    public function foods() {
        $filter = '';
        $id = array('26', '27', '28');
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['base_url'] = base_url() . "foods";

        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');
            $data['filter'] = $filter;

            $config['total_rows'] = $this->Items->record_countall_home_main_cat_filter($id, $filter);
        } else {
            $config['total_rows'] = $this->Items->record_countall_home_main_cat($id);
        }
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config["uri_segment"] = 2;
        $config['display_pages'] = TRUE;
        $config['per_page'] = 15;
        $config['num_links'] = 1;
        $config['first_link'] = false;
        $config['last_link'] = false;


//        $choice = $config["total_rows"] / $config["per_page"];
//        $config["num_links"] = round($choice);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;



        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');


            $data["foods"] = $this->Items
                    ->homeMainCatFilter($id, $config["per_page"], $page, $filter);
        } else {
            $data["foods"] = $this->Items
                    ->homeMainCat($id, $config["per_page"], $page);
        }

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $data['title'] = 'Foods | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/foods', $data);
        $this->load->view('public/footer');
    }

    public function games() {
        $filter = '';
        $id = array('29', '30', '31');
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['base_url'] = base_url() . "games-activities-services";

        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');
            $data['filter'] = $filter;

            $config['total_rows'] = $this->Items->record_countall_home_main_cat_filter($id, $filter);
        } else {
            $config['total_rows'] = $this->Items->record_countall_home_main_cat($id);
        }
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config["uri_segment"] = 2;
        $config['display_pages'] = TRUE;
        $config['per_page'] = 15;
        $config['num_links'] = 1;
        $config['first_link'] = false;
        $config['last_link'] = false;


//        $choice = $config["total_rows"] / $config["per_page"];
//        $config["num_links"] = round($choice);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;



        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');


            $data["games"] = $this->Items
                    ->homeMainCatFilter($id, $config["per_page"], $page, $filter);
        } else {
            $data["games"] = $this->Items
                    ->homeMainCat($id, $config["per_page"], $page);
        }

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $data['title'] = 'Games Activities Services | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/games', $data);
        $this->load->view('public/footer');
    }

    public function venues() {

        $config['base_url'] = base_url() . "venues";
        $config['total_rows'] = $this->Venues->record_count_all_venues();
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config["uri_segment"] = 2;
        $config['display_pages'] = TRUE;
        $config['per_page'] = 15;
        $config['num_links'] = 1;
        $config['first_link'] = false;
        $config['last_link'] = false;


//        $choice = $config["total_rows"] / $config["per_page"];
//        $config["num_links"] = round($choice);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data["allvenues"] = $this->Venues->getvenues($config["per_page"], $page);

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $data['title'] = 'Venues | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/venues', $data);
        $this->load->view('public/footer');
    }

    public function partyPackages() {

        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['base_url'] = base_url() . "party-packages";

        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');
            $data['filter'] = $filter;

            $config['total_rows'] = $this->Itemspackage->record_countall_party_package_filter($filter);
        } else {
            $config['total_rows'] = $this->Itemspackage->record_countall_party_Package();
        }
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config["uri_segment"] = 2;
        $config['display_pages'] = TRUE;
        $config['per_page'] = 15;
        $config['num_links'] = 1;
        $config['first_link'] = false;
        $config['last_link'] = false;

//        $choice = $config["total_rows"] / $config["per_page"];
//        $config["num_links"] = round($choice);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;



        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');


            $data["partypack"] = $this->Itemspackage
                    ->partyPackagesFilter($config["per_page"], $page, $filter);
        } else {
            $data["partypack"] = $this->Itemspackage
                    ->partyPackages($config["per_page"], $page);
        }

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $data['title'] = 'Party Packages | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/partypackages', $data);
        $this->load->view('public/footer');
    }

    public function foodPackages() {
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['base_url'] = base_url() . "party-packages";

        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');
            $data['filter'] = $filter;

            $config['total_rows'] = $this->Itemspackage->record_countall_food_Package_Filter($filter);
        } else {
            $config['total_rows'] = $this->Itemspackage->record_countall_food_Package();
        }
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config["uri_segment"] = 2;
        $config['display_pages'] = TRUE;
        $config['per_page'] = 15;
        $config['num_links'] = 1;
        $config['first_link'] = false;
        $config['last_link'] = false;


//        $choice = $config["total_rows"] / $config["per_page"];
//        $config["num_links"] = round($choice);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;



        if ($this->input->cookie('themeselected') != '') {
            $filter = $this->input->cookie('themevalue');


            $data["foodpack"] = $this->Itemspackage
                    ->foodPackagesFilter($config["per_page"], $page, $filter);
        } else {
            $data["foodpack"] = $this->Itemspackage
                    ->foodPackages($config["per_page"], $page);
        }





        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $data['themes'] = $this->Themes->allThemes();

        $data['title'] = 'Food Packages | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $this->load->view('public/header', $data);
        $this->load->view('public/foodpackages', $data);
        $this->load->view('public/footer');
    }

    public function faq() {
        $data['title'] = 'FAQ | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/faq');
        $this->load->view('public/footer');
    }

    public function themes() {
        $data['popthemes'] = $this->Themes->getPopularThemes();
        $data['allthemes'] = $this->Themes->getAllThemes();
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/themes', $data);
        $this->load->view('public/footer');
    }

    /* --  404  --- */

    public function page_missing() {
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('errors/html/error_404');
        $this->load->view('public/footer');
    }

    public function compare() {
        if (isset($_POST['id'])) {

            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Items->compare($_POST['id'])));
        }
    }

    public function packcompare() {
        if (isset($_POST['id'])) {

            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Itemspackage->comparepackage($_POST['id'])));
        }
    }

    public function search() {


        // get search string
        $search = ($this->input->post("search_term")) ? $this->input->post("search_term") : "NIL";
        $theme = ($this->input->post("theme")) ? $this->input->post("theme") : "NIL";
        $district = ($this->input->post("district")) ? $this->input->post("district") : "NIL";

        if ($search != "NIL") {
            $this->session->set_userdata('search', $search);
        }
        if ($theme != "NIL") {
            $this->session->set_userdata('theme', $theme);
        }
        if ($district != "NIL") {
            $this->session->set_userdata('district', $district);
        }

        if ($search == "NIL") {
            $search = $this->session->userdata('search');
        }
        if ($theme == "NIL") {
            $theme = $this->session->userdata('theme');
        }
        if ($district == "NIL") {
            $district = $this->session->userdata('district');
        }
        // pagination settings
        $config = array();
        //$config['base_url'] = site_url() . 'search/' . $district . '/' . $theme . '/' . $search;
        $config['base_url'] = site_url() . 'search/';
        $config['total_rows'] = $this->Items->get_items_count($theme, $district, $search);


        $config["uri_segment"] = 2;
        //$choice = $config["total_rows"] / $config["per_page"];
        //$config["num_links"] = floor($choice);
        // integrate bootstrap pagination
        $config['full_tag_open'] = "<ul class = 'pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class = 'disabled'><li class = 'active'><a href = '#'>";
        $config['cur_tag_close'] = "<span class = 'sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['display_pages'] = TRUE;

        $config['per_page'] = 15;
        $config['num_links'] = 1;
        $config['first_link'] = false;
        $config['last_link'] = false;

        $this->pagination->initialize($config);

        $data['search_term'] = $search;
        $data['found'] = $config['total_rows'];
        $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        //echo $config['per_page'];
        // get books list
        $data['result'] = $this->Items->get_items($config['per_page'], $data['page'], $theme, $district, $search);

        $data['pages'] = $this->pagination->create_links();

//        $num_pages = ceil($config['total_rows'] / $config['per_page']);
//        $pagination = '<p class="pagination-text">Found ' . $config['total_rows'] . ' records in ' . $num_pages . ' pages ' . $data['pagination'] . '</p>';
//        $data['pagination'] = $pagination;

        $data['title'] = 'Search | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/search_view', $data);
        $this->load->view('public/footer');
    }

    public function liveSearch() {

        $search_data = $this->input->post('search_data');
        $district = $this->input->post('district');
        $theme = $this->input->post('theme');

        $query = $this->Items->get_live_items($search_data, $district, $theme);

        foreach ($query as $row) {
            echo "<li><a href = '" . base_url() . "item/" . $row->slug . "'><img class=\"search-img\" src=" . base_url('files/thumb/') . $row->image . " width='50' height='50'></a>  <a href = '" . base_url() . "item/" . $row->slug . "'>" . $row->title . "</a></li>";
        }
    }

    public function sellerProfile($slug) {

        $data['singleuser'] = $this->Users->singleUserBySlug($slug);
        if (!empty($data['singleuser'])) {

            $time = array();
            foreach ($data['singleuser'] as $singleUserId) {
                $id = $singleUserId->id;
                $company = $singleUserId->company;
                $fname = $singleUserId->fname;
                $lname = $singleUserId->lname;
                $over_view = $singleUserId->overview;
                $cover_image = $singleUserId->cover_image;
                $address = $singleUserId->address;
                $mobile = $singleUserId->mobile;
                $time = array(
                    "monstart" => $singleUserId->monstart,
                    "monclose" => $singleUserId->monclose,
                    "tuestart" => $singleUserId->tuestart,
                    "tueclose" => $singleUserId->tueclose,
                    "wedstart" => $singleUserId->wedstart,
                    "wedclose" => $singleUserId->wedclose,
                    "thustart" => $singleUserId->thustart,
                    "thuclose" => $singleUserId->thuclose,
                    "fristart" => $singleUserId->fristart,
                    "friclose" => $singleUserId->friclose,
                    "satstart" => $singleUserId->satstart,
                    "satclose" => $singleUserId->satclose,
                    "sunstart" => $singleUserId->sunstart,
                    "sunclose" => $singleUserId->sunclose
                );
            }

            $this->Users->update_shop_view($id);

            if (!empty($company)) {
                $name = $company;
            } else {
                $name = $fname . ' ' . $lname;
            }

            $config['base_url'] = base_url() . "shops/" . $slug;
            $config['total_rows'] = $this->Items->record_countall_item_shop($id);
            $config['full_tag_open'] = "<ul class = 'pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class = 'disabled'><li class = 'active'><a href = '#'>";
            $config['cur_tag_close'] = "<span class = 'sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config["uri_segment"] = 3;
            $config['display_pages'] = TRUE;
            $config['per_page'] = 12;
            $config['num_links'] = 1;
            $config['first_link'] = false;
            $config['last_link'] = false;

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["items"] = $this->Items
                    ->shopItems($id, $config["per_page"], $page);
            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data["packages"] = $this->Itemspackage->allSellerShopPackages($id);
            $data['name'] = $name;
            $data['cover_image'] = $cover_image;
            $data['over_view'] = $over_view;
            $data['address'] = $address;
            $data['mobile'] = $mobile;
            $data['times'] = $time;
            $data['slug'] = $slug;
            $data['id'] = $id;
            $data['title'] = $name . ' | Birthdays.lk';
            $data['allprovinces'] = $this->Location->allprovinces();
            $data['themes'] = $this->Themes->allThemes();

            $data['meta'] = array(
                array('name' => 'keywords', 'content' => character_limiter($name, 60)),
                array('name' => 'description', 'content' => character_limiter($over_view, 160))
            );
            if (!empty($cover_image)) {
                $itemimage = base_url('files/shops/') . $cover_image;
            } else {
                $itemimage = base_url('asset/images/default_shop_background.jpg');
            }

            $data['title'] = character_limiter($name, 60);
            $data['description'] = character_limiter($over_view, 160);
            $data['single_image'] = $itemimage;

            $this->load->view('public/header', $data);
            $this->load->view('public/sellerprofile');
            $this->load->view('public/footer');
        } else {
            http_response_code(404);
            redirect('404');
        }
    }

    public function contact() {

        $data['title'] = 'Contact Us | Birthdays.lk';
        $data['allprovinces'] = $this->Location->allprovinces();
        $data['themes'] = $this->Themes->allThemes();
        $this->load->view('public/header', $data);
        $this->load->view('public/contact');
        $this->load->view('public/footer');
    }

    public function contactus() {

        $name = $this->input->post('name');
        $reply_email = $this->input->post('email');
        $usermessage = $this->input->post('message');


        $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
        $this->email->to('support@birthdays.lk');

        $this->email->reply_to($reply_email);

        $message = '<p>Full name : ' . $name . '</p>' . '<p>Email : ' . $reply_email . '</p>' . '<p>Message : ' . $usermessage . '</p>';

        $this->email->subject('Customer Contact');

        $subject = 'Customer Contact';


        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns = "http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv = "Content-Type" content = "text/html; charset=' . strtolower(config_item('charset')) . '" />
                <title>' . html_escape($subject) . '</title>
                <style type = "text/css">
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
            $this->session->set_flashdata('message', '<div class = "alert alert-success" role = "alert"><span>Email Sent Successfully..!</span></div>');
        } else {
            $this->session->set_flashdata('message', '<div class = "alert alert-danger" role = "alert"><span>Error with Sending Email..!</span></div>');
        }

        redirect('contact');
    }

    public function contactseller($slug) {

        $userinfo = $this->Users->UserBySlug($slug);

        $name = $this->input->post('name');
        $reply_email = $this->input->post('email');
        $usermessage = $this->input->post('message');
        $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
        $this->email->to($userinfo->email);

        $this->email->reply_to($reply_email);

        $message = '<p>Full name : ' . $name . '</p>' . '<p>Email : ' . $reply_email . '</p>' . '<p>Message : ' . $usermessage . '</p>';

        $this->email->subject('Customer Contact from Birthdays.lk');

        $subject = 'Customer Contact';


        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns = "http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv = "Content-Type" content = "text/html; charset=' . strtolower(config_item('charset')) . '" />
                <title>' . html_escape($subject) . '</title>
                <style type = "text/css">
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
            $this->session->set_flashdata('message', '<div class = "alert alert-success" role = "alert"><span>Email Sent Successfully..!</span></div>');
        } else {
            $this->session->set_flashdata('message', '<div class = "alert alert-danger" role = "alert"><span>Error with Sending Email..!</span></div>');
        }

        redirect(base_url('shops/' . $slug));
    }

    function sitemap() {

        $data['singleitem'] = $this->Items->getItemURLS();
        $data['singlepack'] = $this->Itemspackage->getPackURLS();
        $this->load->view("public/sitemap_view", $data);
    }

    function sitemap_Cat() {

        $data['catlist'] = $this->Category->getCatURLS();
        $data['subcatlist'] = $this->Category->getSubCatURLS();
        $this->load->view("public/sitemap_cat_view", $data);
    }

    function sitemap_shop() {

        $data['shops'] = $this->Users->usershops();
        $this->load->view("public/sitemap_shops_view", $data);
    }

    public function cron_email_shopactivation() {

        $numofitems = $this->Items->count_total_items_all_user();
        foreach ($numofitems as $items) {
            if ($items['number_of_items'] >= 15 && $items['email_shop_activation'] != 1) {

                //echo "sent email...!";
                //echo '# ' . $items['uid'] . ' -  Name: ' . $items['fname'] . ' ' . $items['lname'] . ' -  No of Items - ' . $items['number_of_items'] . '<br>';

                $this->email->clear();
                $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->to($items['email']);
                //$this->email->to('mhmnaseem@gmail.com');
                $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->subject('Your Shop is Ready to Activate');
                $subject = 'Your Shop is Ready to Activate';
                $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                <p>Your Shop With Birthdays.lk has been Reserved for you, Activate your Shop Today.</p>

                        <p> Your Shop Activation Link Is Here <a target="_blank" href="' . base_url('createshop/' . $items['hash']) . '"> Click Here to Activate </a>
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

                $this->email->send();

                $this->Users->cron_email_sent($items['uid']);

//            echo '# ' . $items['id'] . - ' Name: ' . $items['fname'] . ' ' . $items['fname'] . ' -  No of Items - ' . $items['number_of_items'] . '<br>';
            }
        }
    }

    public function cron_email_item_expire() {

        $expirditems = $this->Items->get_all_items_expire();
        foreach ($expirditems as $item) {
            if ($item['email_expire'] != 1) {

                $select_user = $this->Users->selectUser($item['user_id']);

                $user_email = '';
                foreach ($select_user as $user_data) {
                    $user_email = $user_data->email;
                }
                $this->email->clear();
                $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->to($user_email);
                //$this->email->to('mhmnaseem@gmail.com');
                $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->subject('Birthdays.lk Item Expired -' . $item['title']);
                $subject = 'Birthdays.lk Item Expired -' . $item['title'];
                $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                      <p> Title : ' . $item['title'] . ' <br>
                <p>Your Item with Birthdays.lk expired and is now removed from our website.</p><br>

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

                $this->email->send();
                $this->Items->cron_expire_item_email_sent($item['id']);
            }
        }
    }

    public function cron_email_package_expire() {

        $expirdpackeges = $this->Itemspackage->get_all_package_expire();
        foreach ($expirdpackeges as $package) {
            if ($package['email_expire'] != 1) {

                $select_user = $this->Users->selectUser($package['user_id']);

                $user_email = '';
                foreach ($select_user as $user_data) {
                    $user_email = $user_data->email;
                }
                $this->email->clear();
                $this->email->from('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->to($user_email);
                //$this->email->to('mhmnaseem@gmail.com');
                $this->email->reply_to('support@birthdays.lk', 'Birthdays.lk Support');
                $this->email->subject('Birthdays.lk Package Expired -' . $package['title']);
                $subject = 'Birthdays.lk Package Expired -' . $package['title'];
                $message = '<img height="60" src="' . base_url('asset/images/logo.png') . '"><br>
                      <p> Title : ' . $package['title'] . ' <br>
                <p>Your Package with Birthdays.lk expired and is now removed from our website.</p><br>

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

                $this->email->send();
                $this->Itemspackage->cron_expire_package_email_sent($package['package_id']);
            }
        }
    }

}
