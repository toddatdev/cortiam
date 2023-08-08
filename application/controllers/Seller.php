<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Seller Display controller
 *
 * The base controller which displays the pages of the Cortiam Web Applications Seller Panel
 *
 * @package    Cortiam Web Application
 * @subpackage Controllers
 * @category   Controllers
 * @copyright  Copyright (c) 2021, The Webb Enterprises Inc.
 * @author     The Webb Enterprises Dev Team
 * @link       http://www.thewebbenterprises.com
 * @since      Version 1.0
 *
 */

class Seller extends CRTM_Controller {

	function __construct(){
		parent::__construct();
        $this->load->database();
        $this->load->model('seller_model');
        $this->load->helper(array('frontend'));

        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/animate.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/izitoast.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/select2.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/icons/icomoon/styles.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/cropper.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/swal.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/slick.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/bootstrap-datepicker.standalone.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/trumbowyg.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/trumbowyg.giphy.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/trumbowyg.colors.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/datatables_bootstrap.css');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/datatables.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/buttons.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/datetime-moment.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/notifications/izitoast.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/validation/validate.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/media/heic2any.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/media/cropper.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/list.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/notifications/sweet_alert.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/sliders/slick.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/styling/uniform.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/notifications/sweet_alert.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/formatter.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/maskmoney.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/title.min.js');
//		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/interactions.min.js');
//		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/widgets.min.js');
//		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/effects.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/maxlength.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/mousewheel.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/globalize/globalize.js"');
//        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/daterangepicker.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/selects/select2.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/trumbowyg.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/base64/trumbowyg.base64.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/cleanpaste/trumbowyg.cleanpaste.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/colors/trumbowyg.colors.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/insertaudio/trumbowyg.insertaudio.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/noembed/trumbowyg.noembed.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/template/trumbowyg.template.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/upload/trumbowyg.upload.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/editors/trumbowyg/plugins/pasteimage/trumbowyg.pasteimage.min.js');
       

        if ($this->ion_auth->logged_in() && $this->ion_auth->get_user_type() == 'Seller') {
            $this->page_data["account"] = $this->account = $this->seller_model->get_seller($this->ion_auth->get_user_id());
            $this->page_data["pms"] = $this->seller_model->get_new_messages($this->ion_auth->get_user_id());
            $this->page_data["usnos"] = $this->seller_model->get_new_offer_news($this->ion_auth->get_user_id());
            $this->page_data["usnots"] = $this->seller_model->get_new_notifications($this->ion_auth->get_user_id());
            $this->page_data['userType'] = $this->ion_auth->get_user_type();

        } else {

            redirect('/login', 'refresh');
        }
        if ($this->session->flashdata('notify')) {
            $this->_addjson('notify', array('position' => 'topCenter', 'transitionIn' => 'bounceInUp', 'transitionOut' => 'fadeOutUp', 'layout' => 2, 'theme' => $this->session->flashdata('notify'), 'message' => $this->session->flashdata('notify_message'), 'title' => $this->session->flashdata('notify_title'), 'maxWidth' => 1100, 'timeout' => 9000, 'drag' => false, 'imageWidth' => 150, 'image' => (($this->session->flashdata('notify_image')) ? $this->session->flashdata('notify_image') : null)));
        } else {
            $this->_addjson('notify', array());
        }
        $this->_addjson('cortiamgeneralajax', array("withdrawform" => cortiam_base_url('ajax/withdraw-form'), "setNotification" => cortiam_base_url('ajax/notification'),  "withdrawurl" => cortiam_base_url('ajax/withdraw-listing'), "loadingimage" => base_url('/images/loading.gif')));
    }


    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function index()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard';
        $this->page_data['header_data']['current_menu'] = 'dashboard';
        $this->page_data['get_seller_data'] = $this->get_seller_data = $this->seller_model->get_seller_data($this->ion_auth->get_user_id());
        $this->page_data['get_zoom_auth_url'] = $this->config->item('zoom_auth_url');
        $this->page_data['seller_id'] = $this->ion_auth->get_user_id();

        $this->page_data['my_properties'] = $this->seller_model->get_my_properties($this->ion_auth->get_user_id(), 12);


        if ($expressed_agents = $this->seller_model->get_express_list($this->ion_auth->get_user_id(), true)) {
            $this->page_data['express_agents'] = $this->seller_model->list_agents(array('seller_id' => $this->ion_auth->get_user_id(), 'list' => $expressed_agents, 'limit' => 15));
        }
        if ($dealed_agents = $this->seller_model->get_dealed_list($this->ion_auth->get_user_id(), true)) {
            $this->page_data['dealed_agents'] = $this->seller_model->list_agents(array('seller_id' => $this->ion_auth->get_user_id(), 'list' => $dealed_agents, 'limit' => 15));
        }
        if ($saved_agents = $this->seller_model->get_favorite_list($this->ion_auth->get_user_id(), true)) {
            $this->page_data['saved_agents'] = $this->seller_model->list_agents(array('seller_id' => $this->ion_auth->get_user_id(), 'list' => $saved_agents, 'limit' => 15));
        }

       
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "sellerGetAgents" => cortiam_base_url('ajax/get-agent') ,"sellerMyAgents" => cortiam_base_url('ajax/get-My-agent') , "favoriteAgentsurl" => cortiam_base_url('ajax/get-favorite-agent'), "favoriteurl" => cortiam_base_url('ajax/favorite-agent'), "agentappointmentstableajaxurl" => cortiam_base_url('ajax/get-agent-appointments')));
        $this->_frontend('dashboard', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function edit_account()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Edit Your Account';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Edit Your Account';
        $this->page_data['header_data']['current_menu'] = 'editaccount';

        $this->_addjson('cortiamajax', array("confirmpassword" => base_url('/images/confirm_pass.svg'), "createpassword" => base_url('/images/eye.svg'), "loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "passwordajaxurl" => cortiam_base_url('ajax/change-password')));

        $this->_frontend('editaccount', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function add_property()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Add Property';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Add Property';
        $this->page_data['header_data']['current_menu'] = 'addproperty';

        $this->page_data['my_properties'] = $this->seller_model->get_my_properties($this->ion_auth->get_user_id(), 12);

        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/bootstrap-datepicker.min.js');


        $this->_addjson('property_types', array("residental" => $this->config->item('residental_types'), "commercial" => $this->config->item('commercial_types')));
        $this->_addjson('cortiamajax', array("emptyimage" => base_url('/images/empty.png'), "loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/add-property'), "propimageuploadurl" => cortiam_base_url('ajax/upload-property-image'), "getlocationajaxurl" => cortiam_base_url('ajax/get-map-location'), "map_key" => $this->config->item('bing_token'), "latitude" => $this->page_data['property']['latitude'], "longitude" => $this->page_data['property']['longitude'], "accepttosurl" => cortiam_base_url('ajax/accept-tos')));

        $this->_frontend('addproperty', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function list_properties()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - List of All Your Properties';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - List of All Your Properties';
        $this->page_data['header_data']['current_menu'] = 'allproperty';

        $this->page_data['my_properties'] = $this->seller_model->get_my_properties($this->ion_auth->get_user_id());

        $this->_frontend('listproperties', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function edit_property($property_id = null)
    {
        if (!$property_id) {
            redirect('/seller', 'refresh');
        }
        if (!$this->page_data['property'] = $this->seller_model->get_my_property($this->ion_auth->get_user_id(), $property_id)) {
            redirect('/seller', 'refresh');
        }

        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Edit Property';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Edit Property';
        $this->page_data['header_data']['current_menu'] = 'addproperty';

        $this->_addjson('property_types', array("residental" => $this->config->item('residental_types'), "commercial" => $this->config->item('commercial_types'), "current" => $this->page_data['property']['type'], "sub_type" => $this->page_data['property']['sub_type']));
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/edit-property/' . $property_id), "propimageuploadurl" => cortiam_base_url('ajax/upload-property-image/' . $property_id), "getlocationajaxurl" => cortiam_base_url('ajax/get-map-location'), "map_key" => $this->config->item('bing_token'), "latitude" => $this->page_data['property']['latitude'], "longitude" => $this->page_data['property']['longitude']));

        $this->_frontend('editproperty', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function approval_process()
    {

        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - My Approval Process';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - My Approval Process';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';
        if ($this->account['approval'] == 'Completed') {
            redirect(cortiam_base_url(''), 'refresh');
        }

        $this->page_data['history'] = $this->seller_model->list_approval_text(array('seller_id' => $this->ion_auth->get_user_id()));
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/request-approval/')));
        $this->_frontend('approvalpage', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function review_property($property_id)
    {
        if (!$property_id) {
            redirect(cortiam_base_url(''), 'refresh');
        }
        if (!$this->page_data['property'] = $this->seller_model->get_my_property($this->ion_auth->get_user_id(), $property_id)) {
            redirect('/seller', 'refresh');
        }
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard -My Property Approval Process';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - My Property Approval Process';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';
        if ($this->page_data['property']['status'] != 'Declined') {
            redirect(cortiam_base_url(''), 'refresh');
        }

        $this->page_data['history'] = $this->seller_model->list_approval_text(array('seller_id' => $this->ion_auth->get_user_id(), 'property_id' => $property_id));
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/request-property-approval/' . $property_id)));
        $this->_frontend('reviewproperty', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function agents()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Agents & Interests';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Agents';
        $this->page_data['header_data']['current_menu'] = 'agents';
//		$this->page_data['header_data']['auto_refresh'] = 30;

        $this->page_data['proposals'] = $this->seller_model->get_proposals($this->ion_auth->get_user_id());
        $this->page_data['agreements'] = $this->seller_model->get_aggrements($this->ion_auth->get_user_id());
        
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "counterofferform" => cortiam_base_url('ajax/counter-offer-form'), "counterofferurl" => cortiam_base_url('ajax/send-counter-offer'), "acceptproposalurl" => cortiam_base_url('ajax/accept-proposal'), "declineproposalurl" => cortiam_base_url('ajax/decline-proposal'), "accepturl" => cortiam_base_url('ajax/accept-agreement'), "declineurl" => cortiam_base_url('ajax/decline-agreement'), "withdrawproposalurl" => cortiam_base_url('ajax/withdraw-proposal')));
        $this->_frontend('agents', 'seller');
    }
    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function view_interest($proposal_string = null)
    {
        if ($proposal_string) {
            $url = explode('-', $proposal_string);
            $proposal_id = (int)$url[0];
            if ($this->page_data['proposal'] = $this->seller_model->get_proposal($this->ion_auth->get_user_id(), $proposal_id)) {
                if ($newer_proposal = $this->seller_model->check_newer_proposal($this->ion_auth->get_user_id(), $proposal_id)) {
                    redirect(cortiam_base_url('view-interest/') . $newer_proposal['prop_id'] . '-' . url_title(trim(preg_replace("/[^0-9a-z]+/i", " ", $newer_proposal['first_name'] . ' ' . $newer_proposal['last_name'])), 'underscore', true), 'refresh');
                    exit();
                } else {
                    $this->page_data['property'] = $this->seller_model->get_my_property($this->ion_auth->get_user_id(), $this->page_data['proposal']['property_id']);
                    if ($this->page_data['proposal']['base_id'] || $this->page_data['proposal']['main_id']) {
                        $this->page_data['related_proposals'] = $this->seller_model->get_related_proposal((($this->page_data['proposal']['base_id']) ? $this->page_data['proposal']['base_id'] : $this->page_data['proposal']['main_id']));
                    }
                    $this->page_data['agent_account'] = $this->seller_model->get_agent($this->page_data['proposal']['agent_id']);
                    $this->page_data['header_data']['meta_title'] .= ' - View Agents Interest';
                    $this->page_data['header_data']['page_title'] = 'View Interest';
                    $this->page_data['header_data']['current_menu'] = 'agents';

                    $this->seller_model->mark_proposal_read($this->ion_auth->get_user_id(), $proposal_id);
                    $this->page_data['agent_specializations'] = $this->agent_specializations = $this->seller_model->get_agent_specializations($this->page_data['proposal']['agent_id']);

                  
                    $this->page_data['agent_licenses'] = $this->seller_model->get_agent_licenses($this->page_data['proposal']['agent_id']);


                    $agent_id=$this->page_data['proposal']['agent_id'];
                    $this->page_data['appointments'] = $this->seller_model->get_appointment_Days($agent_id);


                    // get All time of All appointments.
                    $agetTimes = array();
                    $get_dates = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $get_dates[] = $appointment['week_day'];
                        $agetTimes[] = $appointment['slot_time'];
                    }
                    $this->page_data['bookedAppointments'] = $this->seller_model->get_booked_Days($agent_id, $agetTimes, $get_dates);

                    $this->page_data['agentreviewed'] = $this->seller_model->get_reviewed($agent_id);

                    $monthArray = array();
                    $yearArray = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $currentArray = explode('/', $appointment['week_day']);
                        $monthArray[]   = $currentArray[0];
                        $yearArray[]    = $currentArray[2];
                    }

                    $monthArray  = array_unique($monthArray);
                    $this->page_data['monthArray'] = $monthArray;
                    $this->page_data['yearArray'] = $yearArray;

                    $days = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $days[] = $appointment['week_day'];
                    }


                    $bookdays = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $bookdays[] = date("Y-m-d", strtotime($appointment['week_day']));
                    }
                    foreach ($days as $date)
                    {
                        $fullmontDays[] = date('Y-m-d', strtotime($date));
                    }
                    $findaysResults =$bookdays;

                    $maxDays   = date('t');
                    $startDays = date('j');

                    $otherDaysArray = array();
                    for ($startDays; $startDays <= $maxDays;  $startDays++)
                    {
                        if($startDays < 10)
                        {
                            $startDays = '0'.$startDays;
                        }
                        $otherDaysArray[] =date('Y')."-".date("m")."-".$startDays;
                    }

                    $other_Month_year = array_diff($findaysResults, $otherDaysArray);
                    $findaysResults = array_diff($otherDaysArray,$findaysResults);

                    $otherMonthsYears = array();
                    foreach($other_Month_year as $date)
                    {
                        if(date('Y-m',strtotime($date)) != date('Y-m'))
                        {
                            $maxDays = date("t",strtotime($date));
                            $m  =  date("m",strtotime($date));
                            $y  =  date("Y",strtotime($date));

                            for ($startDays = 0; $startDays <= $maxDays;  $startDays++)
                            {
                                if($startDays < 10)
                                {
                                    $startDays = '0'.$startDays;
                                }
                                $otherMonthsYears[]  =  date("Y-m-d",strtotime($y. "-".$m."-".$startDays));;
                            }
                        }
                    }

                    $findotherdaysResults = array_diff($otherMonthsYears,$other_Month_year);
                    $findaysResults = array_merge($findaysResults,$findotherdaysResults);

                    $this->page_data['seller_id'] = $this->account['id'];
                    $this->page_data['days'] = $findaysResults;

                    $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "proposal_id" => $proposal_id, "acceptproposalurl" => cortiam_base_url('ajax/accept-proposal'),  "agent_id" => $agent_id, "bookavailableagentslot" => cortiam_base_url('ajax/book-available-agent-slot'), "getagentslotsurl" => cortiam_base_url('ajax/get-agent-slots'), "declineproposalurl" => cortiam_base_url('ajax/decline-proposal'), "counterofferform" => cortiam_base_url('ajax/counter-offer-form'), "counterofferurl" => cortiam_base_url('ajax/send-counter-offer'), "withdrawproposalurl" => cortiam_base_url('ajax/withdraw-proposal')));

                    $this->_frontend('interest_view', 'seller');
                }
            } else {
                $this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('notify_message', 'Requested proposal cannot be found. Please check your URL and try again.');
                $this->session->set_flashdata('notify_title', 'Requested Proposal Cannot Found');
                redirect(cortiam_base_url('agents'), 'refresh');
                exit();
            }
        } else {
            $this->session->set_flashdata('notify', 'error');
            $this->session->set_flashdata('notify_message', 'Requested proposal cannot be found. Please check your URL and try again.');
            $this->session->set_flashdata('notify_title', 'Requested Proposal Cannot Found');
            redirect(cortiam_base_url(''), 'refresh');
            exit();
        }
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function agent_profile($agent_string = null)
    {

        if ($agent_string) {
            $url = explode('-', $agent_string);
            $agent_id = (int)$url[0];
            if ($this->page_data['agent_account'] = $this->seller_model->get_agent($agent_id)) {
                if ($this->page_data['agent_account']['approval'] == 'Completed') {
                    $this->page_data['header_data']['meta_title'] .= ' - View Agent Profile';
                    $this->page_data['header_data']['page_title'] = 'View Agent Profile';
                    $this->page_data['header_data']['current_menu'] = 'proposals';

                    $this->page_data['get_seller_data'] = $this->get_seller_data = $this->seller_model->get_seller_data($this->ion_auth->get_user_id());

                    $this->page_data['get_zoom_auth_url']  = $this->config->item('zoom_auth_url');

					$this->page_data['favorite_status'] = $this->seller_model->get_favorite_value($this->account['id'], $agent_id);
                    $this->page_data['agent_proposals'] = $this->seller_model->get_agent_proposals($this->account['id'], $agent_id);
                    $this->page_data['agent_licenses'] = $this->seller_model->get_agent_licenses($agent_id);
                    $this->page_data['agent_specializations'] = $this->agent_specializations = $this->seller_model->get_agent_specializations($agent_id);

                    $attributes = $this->seller_model->getAllSelectAttributes($agent_id, "Agent");
                    if($attributes)
                    {
                        $attr = array();
                        foreach ($attributes as $attribute)
                        {
                            array_push($attr,$attribute['attribute_id']);
                            //array_push($attr, $attribute->attribute_id);
                        }
                        $this->page_data['agent_attributes'] = $this->seller_model->getAttributesValue($attr);
                    }
                    else{
                        $this->page_data['agent_attributes'] = null;
                    }


                    $attributes = $this->seller_model->getAllSelectAttributes($this->account['id'], "Seller");
                    $attr = array();
                    if($attributes)
                    {
                        foreach ($attributes as $attribute)
                        {
                            array_push($attr,$attribute['attribute_id']);
                            //array_push($attr, $attribute->attribute_id);
                        }

                        $seller_attributes = $this->seller_model->getAttributesValue($attr);

                        $attr = array();
                        foreach ($seller_attributes as $attribute)
                        {
                            array_push($attr,$attribute['attribute_name']);
                            //array_push($attr, $attribute->attribute_id);
                        }

                    }

                    $this->page_data['seller_attributes'] = $attr;
					$this->page_data['agent_video'] = $this->seller_model->get_meeting_video($agent_id);
					$this->page_data['agent_chat'] = $this->seller_model->get_meeting_chat($agent_id);

                    $this->page_data['agent_win_limit'] = $this->seller_model->get_agent_chat($agent_id);

                    $this->page_data['appointments'] = $this->seller_model->get_appointment_Days($agent_id);


                    // get All time of All appointments.
                    $agetTimes = array();
                    $get_dates = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $get_dates[] = $appointment['week_day'];
                        $agetTimes[] = $appointment['slot_time'];
                    }
                    $this->page_data['bookedAppointments'] = $this->seller_model->get_booked_Days($agent_id, $agetTimes, $get_dates);

                    $this->page_data['agentreviewed'] = $this->seller_model->get_reviewed($agent_id);

                    $monthArray = array();
                    $yearArray = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $currentArray = explode('/', $appointment['week_day']);
                        $monthArray[]   = $currentArray[0];
                        $yearArray[]    = $currentArray[2];
                    }

                    $monthArray  = array_unique($monthArray);
                    $this->page_data['monthArray'] = $monthArray;
                    $this->page_data['yearArray'] = $yearArray;

                    $days = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $days[] = $appointment['week_day'];
                    }


                    $bookdays = array();
                    foreach ($this->page_data['appointments'] as $appointment)
                    {
                        $bookdays[] = date("Y-m-d", strtotime($appointment['week_day']));
                    }
                    foreach ($days as $date)
                    {
                        $fullmontDays[] = date('Y-m-d', strtotime($date));
                    }
                    $findaysResults =$bookdays;

                    $maxDays   = date('t');
                    $startDays = date('j');

                    $otherDaysArray = array();
                    for ($startDays; $startDays <= $maxDays;  $startDays++)
                    {
                        if($startDays < 10)
                        {
                            $startDays = '0'.$startDays;
                        }
                        $otherDaysArray[] =date('Y')."-".date("m")."-".$startDays;
                    }

                    $other_Month_year = array_diff($findaysResults, $otherDaysArray);
                    $findaysResults = array_diff($otherDaysArray,$findaysResults);

                    $otherMonthsYears = array();
                    foreach($other_Month_year as $date)
                    {
                        if(date('Y-m',strtotime($date)) != date('Y-m'))
                        {
                            $maxDays = date("t",strtotime($date));
                            $m  =  date("m",strtotime($date));
                            $y  =  date("Y",strtotime($date));

                            for ($startDays = 0; $startDays <= $maxDays;  $startDays++)
                            {
                                if($startDays < 10)
                                {
                                    $startDays = '0'.$startDays;
                                }
                                $otherMonthsYears[]  =  date("Y-m-d",strtotime($y. "-".$m."-".$startDays));;
                            }
                        }
                    }

                    $findotherdaysResults = array_diff($otherMonthsYears,$other_Month_year);
                    $findaysResults = array_merge($findaysResults,$findotherdaysResults);

                    $this->page_data['seller_id'] = $this->account['id'];
                    $this->page_data['days'] = $findaysResults;


                    $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "agent_id" => $agent_id, "favoriteurl" => cortiam_base_url('ajax/favorite-agent'), "messageformurl" => cortiam_base_url('ajax/message-form'), "messagesendurl" => cortiam_base_url('ajax/send-message'), "acceptproposalurl" => cortiam_base_url('ajax/accept-proposal'), "declineproposalurl" => cortiam_base_url('ajax/decline-proposal'), "counterofferform" => cortiam_base_url('ajax/counter-offer-form'), "counterofferurl" => cortiam_base_url('ajax/send-counter-offer'), "withdrawproposalurl" => cortiam_base_url('ajax/withdraw-proposal'), "getagentslotsurl" => cortiam_base_url('ajax/get-agent-slots'), "bookavailableagentslot" => cortiam_base_url('ajax/book-available-agent-slot')));
                    $this->_frontend('agent_profile', 'seller');
                } else {
                    $this->session->set_flashdata('notify', 'error');
                    $this->session->set_flashdata('notify_message', 'Requested agent is currently inactive, because of this agent profile not available.');
                    $this->session->set_flashdata('notify_title', 'Requested Agent Profile Currently Not Available');
                    redirect(cortiam_base_url(''), 'refresh');
                    exit();
                }
            } else {
                $this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('notify_message', 'Requested agent profile cannot be found. Please check your URL and try again.');
                $this->session->set_flashdata('notify_title', 'Requested Agent Profile Cannot Found');
                redirect(cortiam_base_url(''), 'refresh');
                exit();
            }
        } else {
            $this->session->set_flashdata('notify', 'error');
            $this->session->set_flashdata('notify_message', 'Requested agent profile cannot be found. Please check your URL and try again.');
            $this->session->set_flashdata('notify_title', 'Requested Agent Profile Cannot Found');
            redirect(cortiam_base_url(''), 'refresh');
            exit();
        }
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function message_center()
    {
     
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Message Center';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Message Center';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';

        $this->db->select('accounts.*,agents.plan_id');
        $this->db->from('accounts');
        $this->db->join('agents', 'agents.agent_id = accounts.id');
        $this->db->join('proposals', 'proposals.agent_id = accounts.id');
        $this->db->join('subscription_tbl', 'subscription_tbl.user_id = accounts.id');        
        $this->db->like('subscription_tbl.featture_enabled', 'chat', 'both');
        // $this->db->where('subscription_tbl.plan_id', 'agents.plan_id');
        
        $this->db->where('accounts.user_type in("Agent")');
        $this->db->where('proposals.seller_id', $this->account['id']);
        $this->db->group_by('accounts.id'); 
        $query = $this->db->get();    
        $data = $query->result();

     

        $this->page_data['users'] = $this->users = $data;
        $this->page_data['messages'] = $this->seller_model->get_message_list($this->ion_auth->get_user_id());
        $this->_frontend('message_center', 'seller');
    }


    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function matchmaking()
    {
        // $this->page_data['header_data']['meta_title'] .= ' - Survey';
        // $this->page_data['header_data']['page_title'] = 'Survey';
        // $this->page_data['header_data']['current_menu'] = 'Survey';

        // $this->page_data['questions'] = $this->questions = $this->seller_model->get_questions();
        // $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif')));
        // $this->_frontend('survey', 'survery');

        $selectedAttributes = $this->seller_model->getAllSelectAttributes($this->account['id'], "Seller");

        $selecteAttributes = array();
       foreach ($selectedAttributes as $key => $val)
       {
            $selecteAttributes[] = $val['attribute_id'];
       }

        $this->page_data['attributesSelectedArray'] =  $selecteAttributes;
       

            $page = "attributes";
            $this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
            if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js'))
            {
                $this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
            }
            $this->page_data['user_type'] = $this->account['user_type'];
            $this->load->view('frontend/shared/header', $this->page_data);

            if (isset($this->json_data['js_variables']))
            {
                $this->load->view('global/json', $this->json_data);
            }

            $this->load->view('seller/pages/'.$page, $this->page_data);
            $this->load->view('frontend/shared/footer');

		
    }

    public function survey_submit()
    {
        $sessionChecked = $this->session->get_userdata('Seller');

        if ($this->input->post('survey_submit_request') == 1) {
         
            $account_id = $this->account['id'];

            $query = $this->db->where('account_id =', $account_id)
                ->from('survey')->get();

            $resultSet = $query->result_array();

            if (isset($resultSet) && count($resultSet) > 0) {
                foreach ($resultSet as $result) {
                    $this->db->where("id", $result['id']);
                    $this->db->delete("survey");
                }
            }

            $choices = $this->input->post('choices');
       

            foreach ($choices as $question_id => $choice_id)
            {
                $data['account_id'] = $sessionChecked['user_id'];
                $data['question_id'] = $question_id;
                $data['answer_id'] = $choice_id;
                $data['status'] = 1;
                $response = $this->seller_model->saveServeyForm($data);
            }

            if ($response == true) {

                $this->session->set_flashdata('msg', 'Servey Form Submitted Successfully');
                redirect(base_url('/customer'));
            } else {
                echo "Insert error !";
            }
        }
    }


    /**
     * Displays the Messages page
     * @return void
     * @uses agent_model::get_message_list Gets list and details of messages grouped by user
     *
     */
    public function read_admin_message()
    {
        $seller_id = $this->input->post("seller_id");
        $admin_id = $this->input->post("admin_id");

        $data = [
            'status' => 'Read',
            'seen_date' => time(),
        ];

        $this->db->where('seller_id', $seller_id);
        $this->db->where('admin_id', $admin_id);
        $this->db->update('messages', $data);

        redirect(base_url('/seller/message-from-administrator'));

    }

    public function message_from_administrator()
    {

        $id = $this->account['id'];

        $query = $this->db->where('seller_id =', $id)
            ->where('admin_id !=', null)
            ->from('messages')->get();

        $resultSet = $query->result_array();

        $this->page_data['messages'] = $this->messages = $resultSet;

        $this->_frontend('message_from_administrator', 'seller');

    }


    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function view_messages($agent, $agent_id)
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Message Box';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Message Box';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';
        if ($agent) {
            $agent_id = $agent_id;
            if ($this->page_data['messages'] = $this->seller_model->get_messages_of($this->ion_auth->get_user_id(), $agent_id)) {
                $this->seller_model->mark_messages_read($this->ion_auth->get_user_id(), $agent_id);
                $this->page_data["pms"] = $this->buyer_model->get_new_all_messages($this->ion_auth->get_user_id(), $agent_id);

            }
            $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/send-message-to/'. $agent.'/'. $agent_id)));
            $this->_frontend('messages', 'seller');
        } else {
            $this->session->set_flashdata('notify', 'error');
            $this->session->set_flashdata('notify_message', 'Requested message history cannot be found. Please check your URL and try again.');
            $this->session->set_flashdata('notify_title', 'Requested Message History Cannot Found');
            redirect(cortiam_base_url(''), 'refresh');
            exit();
        }
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function agreements()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Agreements';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Agreements';
        $this->page_data['header_data']['current_menu'] = 'agreements';

        $this->page_data['agreements'] = $this->seller_model->get_aggrements($this->ion_auth->get_user_id());
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "accepturl" => cortiam_base_url('ajax/accept-agreement'), "declineurl" => cortiam_base_url('ajax/decline-agreement')));

        $this->_frontend('agreements', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function tutorials()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Tutorials';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Tutorials';
        $this->page_data['header_data']['current_menu'] = 'tutorial';

        $this->page_data['content'] = $this->seller_model->get_tutorial();
        $this->_frontend('tutorial', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function support_center()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Support Request';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Support Request';
        $this->page_data['header_data']['current_menu'] = 'support';

        $this->page_data['messages'] = $this->seller_model->get_support_messages($this->ion_auth->get_user_id());
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/send-support/')));

        $this->_frontend('support_center', 'seller');
    }

    /**
     * Displays the homepage/dashboard of the Lead Distribution Application
     * @return void
     * @uses system_model::system_report To get latest system actions
     * @uses system_model::get_campaigns To get active system campaigns
     * @uses system_model::next_week_graphic_stats To get next weeks lead distribution details
     *
     * @uses system_model::lead_graphic_stats To get latest weeks active, send and removed lead stats
     */
    public function notifications()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - System Notifications';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - System Notifications';
        $this->page_data['header_data']['current_menu'] = 'notifications';

        $this->page_data['notifications'] = $this->seller_model->get_notifications($this->ion_auth->get_user_id());
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif')));

        $this->_frontend('notifications', 'seller');
    }

    public function zoom_callback()
    {
        require_once('vendor/autoload.php');


        try {
            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);

            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => 'Basic' . base64_encode($this->config->item('zoom_client_id') . ':' . $this->config->item('zoom_client_secret')),

                ], GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'code' => $_GET['code'],
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $this->config->item('zoom_redirect_uri'),
                ],
            ]);

            $token = json_decode($response->getBody()->getContents(), true);

            $this->db->update('sellers', ['zoom_jwt' => $token['access_token'], 'zoom_jwt_refresh' => $token['refresh_token'], 'zoom_jwt_expires_in' => $token['expires_in'] ], 'seller_id = ' . $this->ion_auth->get_user_id());

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        redirect('/seller');
    }



    public function survey_skip()
    {
        $data = array(  

            'account_id' => $this->ion_auth->get_user_id(),
            'status'     => 2 ,
        );

        $this->db->insert('survey', $data);
        echo "true";
        
    }


    public function switch(){

       
        $data = array('user_type' => 'Buyer');
        $this->db->where('id', $this->ion_auth->get_user_id());
        $this->db->update('accounts', $data);

        $query = $this->db->select('accounts.*')
        ->where('id', $this->ion_auth->get_user_id())        
        ->get('accounts');  
        $user = $query->row();

        $buyerQuery = $this->db->select('buyer_id')
                                            ->where('buyer_id', $user->id)   
                                            ->from('buyers')
                                            ->get();       

                        $getbuyerUSer = $buyerQuery->row();

                       $sellerQuery = $this->db->select('sellers.*')
                            ->where('seller_id', $user->id)
                            ->from('sellers')     
                            ->get();
                        $getSellerUser = $sellerQuery->row();

                        $data = array('status' => 0);
                        $this->db->where('seller_id', $this->ion_auth->get_user_id());
                        $this->db->update('sellers', $data);
   
                        $data = array(
                                    'buyer_id'            => $user->id,
                                    'first_name'          => $getSellerUser->first_name,
                                    'last_name'           => $getSellerUser->last_name,
                                    'phone'               => $getSellerUser->phone,
                                    'address'             => $getSellerUser->address,
                                    'unit'                => $getSellerUser->unit,
                                    'city'                => $getSellerUser->city,
                                    'state'               => $getSellerUser->state,
                                    'zipcode'             => $getSellerUser->zipcode,
                                    'latitude'            => $getSellerUser->latitude,
                                    'longitude'           => $getSellerUser->longitude,
                                    'avatar_string'       => $getSellerUser->avatar_string,
                                    'accept_tos'          => $getSellerUser->accept_tos,
                                    'zoom_jwt'            => $getSellerUser->zoom_jwt,
                                    'zoom_jwt_refresh'    => $getSellerUser->zoom_jwt_refresh,
                                    'zoom_jwt_expires_at' => $getSellerUser->zoom_jwt_expires_at,
                                    'status'              => 1,


                                );

                          

                            if(!isset($getbuyerUSer->buyer_id) && empty($getbuyerUSer->buyer_id))
                            {                             
                               $this->db->insert('buyers', $data);
                            }else{                                                        
                                $this->db->where('buyer_id', $user->id);
                                $this->db->update('buyers', $data);
                            }


        $session_data = [
            'email' => $user->email,
            'user_id' => $user->id, //everyone likes to overwrite id so we'll use user_id
            'user_type' => $user->user_type, //everyone likes to overwrite id so we'll use user_id
            'old_last_login' => $user->last_login,
            'last_check' => time(),
        ];

        $this->session->set_userdata($session_data);
        $header_data['current_menu'] ='switch';


        $account_id =$this->ion_auth->get_user_id();


		$this->db->select('id');
		$this->db->where('user_id',$account_id);
		$this->db->where('user_type', 'Buyer');
		$this->db->from('users_attributes');
		$query = $this->db->get();
		$attributes = $query->row();


        $account_id =$this->ion_auth->get_user_id();
        $this->db->select('buyer_id');
        $this->db->where('already_loged_in',0);
        $this->db->where('buyer_id',$account_id);
        $this->db->from('buyers');
        $query = $this->db->get();
        $user = $query->row();

        $this->db->set('already_loged_in',1);
        $this->db->where('buyer_id =', $account_id);
        $this->db->update('buyers');

		if(isset($user->buyer_id) && !empty($user->buyer_id))
		{

            redirect(base_url('/buyer'));


        }else{
        
            redirect('/buyer');
        }

     
    }

    public function reviews()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Seller Dashboard - Reviews';
        $this->page_data['header_data']['page_title'] = 'Seller Dashboard - Reviews';
        $this->page_data['header_data']['current_menu'] = 'reviews';

        $seller_id = $this->ion_auth->get_user_id();
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "agentlist" => cortiam_base_url('ajax/seller-agent-rating-list'), "getratingdetails" =>cortiam_base_url('ajax/seller-rating-details-list'),  "deleterecord" => cortiam_base_url('ajax/delete-agent-rating')));
        $this->db->select('reviews.*');
        $this->db->where('seller_id',$seller_id);
        $this->db->where_in('status', [1, 2]);
        $this->db->from('reviews');
        $this->page_data['reviews'] = $this->db->get()->result_array();
        $this->_frontend('reviews', 'seller');
    }


}
?>