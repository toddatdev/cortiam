<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Agent Display controller
 *
 * The base controller which displays the pages of the Cortiam Web Applications Agent Panel
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
class Agent extends CRTM_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->model('agent_model');
        $this->load->helper(array('frontend', 'backend'));
        $this->load->helper('url');


        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/animate.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/select2.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/izitoast.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/cropper.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/icons/icomoon/styles.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/swal.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/datepicker.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/slick.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/trumbowyg.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/trumbowyg.giphy.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/trumbowyg.colors.min.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/ekko-lightbox.css');
        $this->page_data['header_data']['css_files'][] = 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css';
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/wickedpicker.min.css');

        //
//        $this->page_data['header_data']['css_files'][] = 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css';




        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/datatables.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/buttons.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/extensions/datetime-moment.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/styling/uniform.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/notifications/izitoast.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/validation/validate.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/media/heic2any.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/media/cropper.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/media/ekko-lightbox.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/notifications/sweet_alert.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/styling/uniform.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/notifications/sweet_alert.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/formatter.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/title.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/mousewheel.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/maxlength.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/globalize/globalize.js"');
//        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/datepicker.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/selects/select2.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/sliders/slick.min.js');
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

//        $this->page_data['footer_data']['js_files'][] = 'https://cdn.jsdelivr.net/jquery/latest/jquery.min.js';
        $this->page_data['footer_data']['js_files'][] = 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js';
        $this->page_data['footer_data']['js_files'][] = 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js';
        $this->page_data['footer_data']['js_files'][] = "https://cdn.jsdelivr.net/npm/jquery-ui-multidatespicker/jquery-ui.multidatespicker.js";
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/agent/wickedpicker.min.js');


        //
//        $this->page_data['footer_data']['js_files'][] = 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js';


        if ($this->ion_auth->logged_in() && ($this->ion_auth->get_user_type() == 'Agent')) {
            $this->page_data["account"] = $this->account = $this->agent_model->get_agent($this->ion_auth->get_user_id());
            $this->page_data["specializations"] = $this->specializations = $this->agent_model->get_specializations();
            $this->page_data["agentspecializations"] = $this->agentspecializations = $this->agent_model->get_specializations_for_agent($this->ion_auth->get_user_id());
            $this->page_data["pms"] = $this->agent_model->get_count_customers_messages($this->ion_auth->get_user_id());
            $this->page_data["usnos"] = $this->agent_model->get_new_offer_news($this->ion_auth->get_user_id());
            $this->page_data["usnots"] = $this->agent_model->get_new_notifications($this->ion_auth->get_user_id());
            $this->page_data["uswapp"] = $this->agent_model->get_aggrements($this->ion_auth->get_user_id(), array('status' => array('Open')));
            $this->page_data["account"]['licenses'] = $this->account['licenses'] = $this->agent_model->get_my_licenses($this->ion_auth->get_user_id());
            $plan_id  = $this->agent_model->get_plan($this->ion_auth->get_user_id());
            $this->agent_model->coupon_expired($this->ion_auth->get_user_id());
            $this->page_data["plan_id"] = $plan_id["plan_id"];

            $this->db->select('free_days');
            $this->db->where('state',$this->account['state']);
            $this->db->where('free_period','Yes');
            $this->db->from('state_costs');
            $state_free_time  = $this->db->get()->row_array();
            $state_free_time = $state_free_time['free_days'];

            $this->page_data['free_days'] = 0;

            if($state_free_time != NULL)
            {
                $your_date = $this->account['created_on'];
                $now = strtotime("now");
                $datediff = $now - (int)$your_date;
                $days_diff = round($datediff / (60 * 60 * 24));
                if ($days_diff < $state_free_time)
                {
                    $this->page_data['free_days'] =  1;
                    $this->page_data['free_days_count'] =  $state_free_time;

                }
            }
        } else {
            redirect('/login', 'refresh');
        }

//		print_r($this->account['licenses']);
        if ($this->account['licenses']['no_active_license']) {
            $this->page_data["nolicenses"] = "nolicenses";
            $this->_addjson('popmeup', array('messagetitle' => 'Your Real Estate Agent License(s) Has Expired.', 'messagetext' => 'Please update your ' . implode(", ", $this->account['licenses']['expired_states']) . ' license information with your new license details before you continue using our system. After you update your license information, the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.'));
        }
        if ($this->account['licenses']['no_license']) {
            $this->page_data["nolicenses"] = "nolicenses";
            $this->_addjson('popmeup', array('messagetitle' => 'Please Add Your Real Estate Agent License', 'messagetext' => 'Please add your real estate agent license information before you continue using our system. After you update your license information, the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.'));
        }
        if ($this->session->flashdata('notify')) {
            $this->_addjson('notify', array('position' => 'topCenter', 'transitionIn' => 'bounceInUp', 'transitionOut' => 'fadeOutUp', 'layout' => 2, 'theme' => $this->session->flashdata('notify'), 'message' => $this->session->flashdata('notify_message'), 'title' => $this->session->flashdata('notify_title'), 'maxWidth' => 1100, 'timeout' => 9000, 'drag' => false, 'imageWidth' => 150 ,'image' => (($this->session->flashdata('notify_image')) ? $this->session->flashdata('notify_image') : null)));
        } else {
            $this->_addjson('notify', array("updateaccepttos" => cortiam_base_url('ajax/updateaccepttos')));
        }
        $this->_addjson('cortiamphotoajax', array("avataruploadurl" => cortiam_base_url('ajax/upload-avatar'),  "loadingimage" => base_url('/images/loading.gif'), "updateaccepttos" => cortiam_base_url('ajax/updateaccepttos'), "termandcondition" => cortiam_base_url('ajax/agent-term-condotions')));

        if ($this->router->fetch_method() != 'edit_account') {

            $SurveyExist = $this->agent_model->checkSurvey($this->ion_auth->get_user_id());

            if (isset($SurveyExist) && !empty($SurveyExist)) {
                if ($this->account['licenses']['no_license'] || $this->account['licenses']['no_active_license']) {
                    $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/datepicker.js');
                    redirect('/agent/edit-account', 'refresh');
                }
            }
        }
    }

    /**
     * Displays the homepage/dashboard for Agent account
     * @return void
     * @uses agent_model::get_express_properties Gets list of expressed properties
     * @uses agent_model::get_saved_properties Gets list of saved properties
     * @uses agent_model::get_proposed_properties Gets list of proposed properties
     * @uses agent_model::get_win_properties Gets list of winned properties
     * @uses agent_model::get_message_list Gets agent messages list and details
     * @uses agent_model::get_licenses Gets agent licenses and details
     *
     * @uses agent_model::get_properties Gets properties and its details by given parameters
     */
    public function index()
    {

        $this->page_data['header_data']['meta_title'] .= ' - Dashboard';
        $this->page_data['header_data']['page_title'] = 'Dashboard';
        $this->page_data['header_data']['current_menu'] = 'dashboard';
        $this->page_data['header_data']['css_files'][] = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css';
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/circle.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/main.css');
        $this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/datatables_bootstrap.css');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/tables/datatables/datatables.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/calendar/main.js');

//$this->page_data['open_properties']  =	$this->agent_model->get_properties(array('state' => $this->account['licenses']['active_states'], 'limit' => 15));
        if ($expressed_properties = $this->agent_model->get_express_properties($this->ion_auth->get_user_id(), true)) {
            $this->page_data['express_properties'] = $this->agent_model->get_properties(array('list' => $expressed_properties, 'limit' => 15));
        }
        if ($saved_properties = $this->agent_model->get_saved_properties($this->ion_auth->get_user_id(), true)) {
            $this->page_data['saved_properties'] = $this->agent_model->get_properties(array('list' => $saved_properties, 'limit' => 15));
        }
        if ($pending_properties = $this->agent_model->get_proposed_properties($this->ion_auth->get_user_id(), true)) {
            $this->page_data['pending_properties'] = $this->agent_model->get_properties(array('list' => $pending_properties, 'limit' => 15));
        }
        if ($win_properties = $this->agent_model->get_win_properties($this->ion_auth->get_user_id(), true)) {
            $statuses = array('Contracted');
            $this->page_data['win_properties'] = $this->agent_model->get_properties(array('list' => $win_properties, 'limit' => 15, 'status' => $statuses));
        }


        $this->page_data['messages'] = $this->agent_model->get_all_customers_message_list($this->ion_auth->get_user_id());
        $this->page_data['licenses'] = $this->agent_model->get_licenses($this->ion_auth->get_user_id());

        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'),  "setNotification"=>  cortiam_base_url('ajax/notification') , "getallcities" => cortiam_base_url('ajax/get-all-cities'), "savepropertyurl" => cortiam_base_url('ajax/save-property'), "favoriteupdateurl" => cortiam_base_url('ajax/get-favorite-properties'), "datatableajaxurl" => cortiam_base_url('ajax/list-properties'), "getappointmentsurl" => cortiam_base_url('ajax/get-appointments')));
        $this->_frontend('dashboard', 'agent');
    }

    /**
     * Displays the profile page of Agent account
     * @return void
     * @uses agent_model::get_licenses Gets agent licenses and details
     *
     */
    public function my_profile()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Preview Profile';
        $this->page_data['header_data']['page_title'] = 'Preview Profile';
        $this->page_data['header_data']['current_menu'] = 'profile';

        $id = $this->account['id'];

        $query = $this->db->query("select * from reviews where agent_id = $id AND status ='1' ");
        $resultSet = $query->result();

        $this->page_data['review'] = $resultSet;
        $this->page_data['licenses'] = $this->agent_model->get_licenses($this->ion_auth->get_user_id());

        $this->page_data['agent_specializations'] = $this->agent_specializations = $this->agent_model->get_agent_specializations($this->ion_auth->get_user_id());
        $this->page_data['week_days'] = $this->week_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $this->page_data['agentreviewed'] = $this->agent_model->get_reviewed($id);
        $this->page_data['selected_week_days'] = $this->agent_model->selected_week_days($id);
        $selected_days = array();
        if(isset($this->page_data['selected_week_days']) && $this->page_data['selected_week_days'] !== '')
        {

            foreach ($this->page_data['selected_week_days'] as $days)
            {
                $selected_days[] = $days['week_day'];
            }
        }
        $this->page_data['selected_days'] = implode(",", $selected_days);
        $this->page_data['agent_id']      = $id;
        $selected_days = array();
        if(isset($this->page_data['selected_week_days']) && $this->page_data['selected_week_days'] !== '')
        {

            foreach ($this->page_data['selected_week_days'] as $days)
            {
                $date = strtotime($days['week_day']);
                $makeDateFormat = date('Y-m-d', $date);
                $selected_days[] = $makeDateFormat;
            }
        }
        $this->page_data['formated_selected_days'] = implode(",", $selected_days);

//        $this->page_data['time_slots'] = $this->time_slots = ['9 PM','9:30 PM','10 PM','10:30 PM','11 PM','11:30 PM','12 PM'];
//        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/agent/agent_available_slots.js');


        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif')));

//        $this->page_data['time_slots'] = $this->time_slots = $this->agent_model->get_agent_specializations($this->ion_auth->get_user_id());
        $this->_frontend('myprofile', 'agent');
    }

    /**
     * Displays the edit account page of Agent account
     * @return void
     * @uses agent_model::get_licenses Gets agent licenses and details
     * @uses agent_model::get_invoices Gets agent invoices and details
     *
     * @uses agent_model::get_credit_cards Gets agent saved credit cards and details
     */
    public function edit_account()
    {

        $this->page_data['header_data']['meta_title'] .= ' - Edit My Account';
        $this->page_data['header_data']['page_title'] = 'Edit My Account';
        $this->page_data['header_data']['current_menu'] = 'editaccount';
        $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';
//        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/datepicker.js');

        $this->page_data['header_data']['css_files'][]  = "//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css";
//      $this->page_data['footer_data']['js_files'][]   = "https://code.jquery.com/jquery-3.6.0.js";
        $this->page_data['footer_data']['js_files'][]   = "https://code.jquery.com/ui/1.10.2/jquery-ui.js";


        $this->_addjson('cortiamajax', array("getcalenderyear" => base_url('agent/ajax/get-calender-year'), "confirmpassword" => base_url('/images/confirm_pass.svg'), "alreadySeletedDates" => cortiam_base_url("ajax/alreadySeletedDates"), "agentslotstableajaxurl" => cortiam_base_url('ajax/list-agent-slots'), "updateagentday" => cortiam_base_url('ajax/update-agent-day') ,"addagentslotajaxurl" => cortiam_base_url('ajax/add-agent-slots'), "updateagentslotajaxurl" => cortiam_base_url('ajax/update-agent-slots'), "deletePremiumRecord" => base_url('/ajax/deletePremiumRecord'), "premiumlisting" => base_url('/ajax/premiumlisting') ,  "savePackage" => base_url('/ajax/savepremiumlisting')  , "createpassword" => base_url('/images/eye.svg'), "loadingimage" => base_url('/images/loading.gif'), "myplan" => base_url('/agent/my-plan'), "paymentajaxurl" => base_url('/ajax/payment'),"freeajaxurl" => base_url('agent/ajax/free-plan-activation'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "planajaxurl" => cortiam_base_url('ajax/update-plan'), "passwordajaxurl" => cortiam_base_url('ajax/change-password'), "changepaymenturl" => cortiam_base_url('ajax/change-payment'), "getlicenseformurl" => cortiam_base_url('ajax/get-licenseform'), "addlicenseurl" => cortiam_base_url('ajax/add-license'), "editlicenseurl" => cortiam_base_url('ajax/edit-license'), "deletelicenseurl" => cortiam_base_url('ajax/delete-license'), "listlicenseurl" => cortiam_base_url('ajax/list-licenses'), "getformurl" => cortiam_base_url('ajax/get-paymentform'), "deletecardurl" => cortiam_base_url('ajax/delete-card'), "updatecardurl" => cortiam_base_url('ajax/get-my-cards'), "newcreditcarddirect" => cortiam_base_url('ajax/new-credit-card-direct')  , "newcardurl" => cortiam_base_url('ajax/new-credit-card'), "setpaymenturl" => cortiam_base_url('ajax/set-payment'), "listpackagesurl" => cortiam_base_url('ajax/list-packages'), "buypackageurl" => cortiam_base_url('ajax/buy-package'), "listinvoicesurl" => cortiam_base_url('ajax/list-payments'), "listmypackagesurl" => cortiam_base_url('ajax/list-mypackages'), "stripekey" => $this->config->item('stripe_key'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "accepttosurl" => cortiam_base_url('ajax/accept-tos'), "couponamount" => cortiam_base_url('ajax/coupon-amount'), "createStripCustomre" => cortiam_base_url('ajax/create-stripe-customer')));

        $query = $this->db->query("select * from reviews where agent_id = ".$this->account['id']." AND status ='1' ");
        $resultSet = $query->result();

        $this->page_data['review'] = $resultSet;



        $this->page_data['licenses'] = $this->agent_model->get_licenses($this->ion_auth->get_user_id());

        $this->page_data['invoices'] = $this->agent_model->get_invoices($this->account['id'], array('Completed', 'Failed', 'Refund'));

        $plan_id = $this->agent_model->get_plan($this->ion_auth->get_user_id());
        $this->page_data['plans'] = $this->agent_model->membership_plans($plan_id);

        $this->page_data['planId'] = $plan_id['plan_id'];
        $state_results = $this->agent_model->getAgentstates($this->account['id']);
        $state_bundle_results = $this->agent_model->getAgentBundlestates($this->account['id']);

        // $this->page_data['cities'] = $this->cities = $city_results;
        $this->page_data['state_results'] = $state_results;
        $this->page_data['state_bundle_results'] = $state_bundle_results;
        $this->page_data['getSettingValue'] = getSettingValue('agent_pay_max_no_days');
        $this->page_data['agent_id']      = $id = $this->account['id'];


        $this->page_data['week_days'] = $this->week_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $this->page_data['agentreviewed'] = $this->agent_model->get_reviewed($id);
        $this->page_data['selected_week_days'] = $this->agent_model->selected_week_days($id);
        $selected_days = array();
        if(isset($this->page_data['selected_week_days']) && $this->page_data['selected_week_days'] !== '')
        {

            foreach ($this->page_data['selected_week_days'] as $days)
            {
                $selected_days[] = $days['week_day'];
            }
        }
        $this->page_data['selected_days'] = implode(",", $selected_days);

        $selected_days = array();
        if(isset($this->page_data['selected_week_days']) && $this->page_data['selected_week_days'] !== '')
        {

            foreach ($this->page_data['selected_week_days'] as $days)
            {
                $date = strtotime($days['week_day']);
                $makeDateFormat = date('Y-m-d', $date);
                $selected_days[] = $makeDateFormat;
            }
        }
        $this->page_data['formated_selected_days'] = implode(",", $selected_days);

        if (isset($plan_id['plan_id']) && $plan_id['plan_id'] !== '') {



//          $this->page_data['footer_data']['js_files']   = NULL;
////        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/jquery.min.js');
//          $this->page_data['footer_data']['js_files'][] = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js";
//          $this->page_data['footer_data']['js_files'][] =  "http://malsup.github.io/jquery.blockUI.js";
//            $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';
            $this->_frontend('editaccount', 'agent');

        } else {

            $this->db->select('free_days');
            $this->db->where('state',$this->account['state']);
            $this->db->where('free_period','Yes');
            $this->db->from('state_costs');
            $state_free_time  = $this->db->get()->row_array();
            $state_free_time = $state_free_time['free_days'];

            $this->page_data['free_days'] = 0;

            if($state_free_time != NULL)
            {
                $your_date = $this->account['created_on'];
                $now = strtotime("now");
                $datediff = $now - (int)$your_date;
                $days_diff = round($datediff / (60 * 60 * 24));
                if ($days_diff < $state_free_time)
                {
                    $this->page_data['free_days'] =  1;
                }
            }

            $this->page_data['footer_data']['js_files']   = NULL;
            $this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/jquery.min.js');
            $this->page_data['footer_data']['js_files'][] = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js";
            $this->page_data['footer_data']['js_files'][] =  "http://malsup.github.io/jquery.blockUI.js";
            $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';
            $this->page_data['plans']     = $this->agent_model->membership_plans($plan_id);
            $this->page_data['cardsList'] = $this->agent_model->getcardsList($this->ion_auth->get_user_id());
            $this->page_data['coupons'] = $this->agent_model->get_coupons_unused($this->ion_auth->get_user_id());
            $this->page_data['phone']    = $this->account['phone'];
            $this->page_data['username'] = $this->account['username'];

            $this->_frontend('agentplans', 'newaccount');
        }
    }


    public function premium_account()
    {

        $this->agent_model->previousUnpaidRecords($this->account['id']);

        $this->page_data['header_data']['meta_title'] .= ' - Premium Placement';
        $this->page_data['header_data']['page_title'] = 'Premium Placement';
        $this->page_data['header_data']['current_menu'] = 'premium';

        $state_results = $this->agent_model->getAgentstates($this->account['id']);
        $state_bundle_results = $this->agent_model->getAgentBundlestates($this->account['id']);

        // $this->page_data['cities'] = $this->cities = $city_results;
        $this->page_data['state_results'] = $state_results;
        $this->page_data['state_bundle_results'] = $state_bundle_results;
        $this->page_data['getSettingValue'] = getSettingValue('agent_pay_max_no_days');

        $this->_addjson('cortiamajax', array("confirmpassword" => base_url('/images/confirm_pass.svg'), "choosendata" => base_url('/ajax/get-premium-data'), "deletePremiumRecord" => base_url('/ajax/deletePremiumRecord'), "premiumlisting" => base_url('/ajax/premiumlisting') ,  "savePackage" => base_url('/ajax/savepremiumlisting')  , "createpassword" => base_url('/images/eye.svg'), "loadingimage" => base_url('/images/loading.gif'), "myplan" => base_url('/agent/my-plan'), "paymentajaxurl" => base_url('/ajax/payment'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "planajaxurl" => cortiam_base_url('ajax/update-plan'), "passwordajaxurl" => cortiam_base_url('ajax/change-password'), "changepaymenturl" => cortiam_base_url('ajax/change-payment'), "getlicenseformurl" => cortiam_base_url('ajax/get-licenseform'), "addlicenseurl" => cortiam_base_url('ajax/add-license'), "editlicenseurl" => cortiam_base_url('ajax/edit-license'), "deletelicenseurl" => cortiam_base_url('ajax/delete-license'), "listlicenseurl" => cortiam_base_url('ajax/list-licenses'), "getformurl" => cortiam_base_url('ajax/get-paymentform'), "deletecardurl" => cortiam_base_url('ajax/delete-card'), "updatecardurl" => cortiam_base_url('ajax/get-my-cards'), "newcreditcarddirect" => cortiam_base_url('ajax/new-credit-card-direct')  , "newcardurl" => cortiam_base_url('ajax/new-credit-card'), "setpaymenturl" => cortiam_base_url('ajax/set-payment'), "listpackagesurl" => cortiam_base_url('ajax/list-packages'), "buypackageurl" => cortiam_base_url('ajax/buy-package'), "listinvoicesurl" => cortiam_base_url('ajax/list-payments'), "listmypackagesurl" => cortiam_base_url('ajax/list-mypackages'), "stripekey" => $this->config->item('stripe_key'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "accepttosurl" => cortiam_base_url('ajax/accept-tos'), "couponamount" => cortiam_base_url('ajax/coupon-amount'), "createStripCustomre" => cortiam_base_url('ajax/create-stripe-customer')));
        $this->_frontend('premiumaccount', 'agent');


    }

    public function checkout_premium_bundle($price, $order_id)
    {
        $this->page_data['footer_data']['js_files']   = NULL;
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/jquery.min.js');
        $this->page_data['footer_data']['js_files'][] = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js";
        $this->page_data['footer_data']['js_files'][] =  "http://malsup.github.io/jquery.blockUI.js";
        $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';
        $this->page_data['plans']     = $this->agent_model->membership_plans($plan_id);
        $this->page_data['cardsList'] = $this->agent_model->getcardsList($this->ion_auth->get_user_id());
        $this->page_data['phone']    = $this->account['phone'];

        $this->page_data['username'] = $this->account['username'];

       $this->page_data['agent_payment_id'] = $this->account['payment_id'];


        $this->_addjson('cortiamajax', array("confirmpassword" => base_url('/images/confirm_pass.svg'), "deletePremiumRecord" => base_url('/ajax/deletePremiumRecord'), "premiumlisting" => base_url('/ajax/premiumlisting') ,  "savePackage" => base_url('/ajax/savepremiumlisting')  , "createpassword" => base_url('/images/eye.svg'), "loadingimage" => base_url('/images/loading.gif'), "myplan" => base_url('/agent/my-plan'), "paymentajaxurl" => base_url('/ajax/premiumn-payment'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "planajaxurl" => cortiam_base_url('ajax/update-plan'), "passwordajaxurl" => cortiam_base_url('ajax/change-password'), "changepaymenturl" => cortiam_base_url('ajax/change-payment'), "getlicenseformurl" => cortiam_base_url('ajax/get-licenseform'), "addlicenseurl" => cortiam_base_url('ajax/add-license'), "editlicenseurl" => cortiam_base_url('ajax/edit-license'), "deletelicenseurl" => cortiam_base_url('ajax/delete-license'), "listlicenseurl" => cortiam_base_url('ajax/list-licenses'), "getformurl" => cortiam_base_url('ajax/get-paymentform'), "deletecardurl" => cortiam_base_url('ajax/delete-card'), "updatecardurl" => cortiam_base_url('ajax/get-my-cards'), "newcreditcarddirect" => cortiam_base_url('ajax/new-credit-card-direct')  , "newcardurl" => cortiam_base_url('ajax/new-credit-card'), "setpaymenturl" => cortiam_base_url('ajax/set-payment'), "listpackagesurl" => cortiam_base_url('ajax/list-packages'), "buypackageurl" => cortiam_base_url('ajax/buy-package'), "listinvoicesurl" => cortiam_base_url('ajax/list-payments'), "listmypackagesurl" => cortiam_base_url('ajax/list-mypackages'), "stripekey" => $this->config->item('stripe_key'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "accepttosurl" => cortiam_base_url('ajax/accept-tos'), "couponamount" => cortiam_base_url('ajax/coupon-amount'), "createStripCustomre" => cortiam_base_url('ajax/create-stripe-customer')));

        $this->page_data['price'] = $price;
        $this->page_data['order_id'] = $order_id;
        $this->_frontend('agentpremiumamount');
    }


    public function my_plan()
    {

        $this->page_data['header_data']['meta_title'] .= ' - My Plan';
        $this->page_data['header_data']['page_title'] = 'My Plan';
        $this->page_data['header_data']['current_menu'] = 'myplan';
        $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';
//        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/datepicker.js');

        $this->page_data['header_data']['css_files'][]  = "//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css";
//      $this->page_data['footer_data']['js_files'][]   = "https://code.jquery.com/jquery-3.6.0.js";
        $this->page_data['footer_data']['js_files'][]   = "https://code.jquery.com/ui/1.10.2/jquery-ui.js";
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/agent/editaccount.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/agent/coupons.js');

        $plan_id = $this->agent_model->get_plan($this->ion_auth->get_user_id());

        $this->page_data['planInfo'] = $this->agent_model->selectedPlan($plan_id);
        $this->page_data['featuresInfo'] = $this->agent_model->getselectedAllFeatures($this->ion_auth->get_user_id(), $plan_id['plan_id']);
        $this->page_data['allPlans'] = $this->allPlans($this->ion_auth->get_user_id());
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/agent_plans.js');
        $this->page_data['coupons'] = $this->agent_model->get_coupons_unused($this->ion_auth->get_user_id());
        $this->page_data['usedCoupons'] = $this->agent_model->get_coupons($this->account['id']);
        $this->page_data['plan_id'] = $plan_id['plan_id'];
        $this->page_data['credit_cards'] = $this->agent_model->get_credit_cards($this->ion_auth->get_user_id());
        $this->page_data['invoices'] = $this->agent_model->get_invoices($this->account['id'], array('Completed', 'Failed', 'Refund'));
//        $this->_addjson('cortiamajax', array("agentoldplans" => cortiam_base_url('agent-oldplans'), 'agentoldplansFeatures' => cortiam_base_url('agent-oldfeatures')));
        $this->_addjson('cortiamajax', array("agentoldplans" => cortiam_base_url('agent-oldplans'),'agentoldplansFeatures' => cortiam_base_url('agent-oldfeatures') ,'couponadd' => cortiam_base_url('ajax/add-coupon'), "updateurl" => cortiam_base_url('ajax/get-my-coupons'),"getcalenderyear" => base_url('agent/ajax/get-calender-year'), "confirmpassword" => base_url('/images/confirm_pass.svg'), "alreadySeletedDates" => cortiam_base_url("ajax/alreadySeletedDates"), "agentslotstableajaxurl" => cortiam_base_url('ajax/list-agent-slots'), "updateagentday" => cortiam_base_url('ajax/update-agent-day') ,"addagentslotajaxurl" => cortiam_base_url('ajax/add-agent-slots'), "updateagentslotajaxurl" => cortiam_base_url('ajax/update-agent-slots'), "deletePremiumRecord" => base_url('/ajax/deletePremiumRecord'), "premiumlisting" => base_url('/ajax/premiumlisting') ,  "savePackage" => base_url('/ajax/savepremiumlisting')  , "createpassword" => base_url('/images/eye.svg'), "loadingimage" => base_url('/images/loading.gif'), "myplan" => base_url('/agent/my-plan'), "paymentajaxurl" => base_url('/ajax/payment'),"freeajaxurl" => base_url('agent/ajax/free-plan-activation'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "planajaxurl" => cortiam_base_url('ajax/update-plan'), "passwordajaxurl" => cortiam_base_url('ajax/change-password'), "changepaymenturl" => cortiam_base_url('ajax/change-payment'), "getlicenseformurl" => cortiam_base_url('ajax/get-licenseform'), "addlicenseurl" => cortiam_base_url('ajax/add-license'), "editlicenseurl" => cortiam_base_url('ajax/edit-license'), "deletelicenseurl" => cortiam_base_url('ajax/delete-license'), "listlicenseurl" => cortiam_base_url('ajax/list-licenses'), "getformurl" => cortiam_base_url('ajax/get-paymentform'), "deletecardurl" => cortiam_base_url('ajax/delete-card'), "updatecardurl" => cortiam_base_url('ajax/get-my-cards'), "newcreditcarddirect" => cortiam_base_url('ajax/new-credit-card-direct')  , "newcardurl" => cortiam_base_url('ajax/new-credit-card'), "setpaymenturl" => cortiam_base_url('ajax/set-payment'), "listpackagesurl" => cortiam_base_url('ajax/list-packages'), "buypackageurl" => cortiam_base_url('ajax/buy-package'), "listinvoicesurl" => cortiam_base_url('ajax/list-payments'), "listmypackagesurl" => cortiam_base_url('ajax/list-mypackages'), "stripekey" => $this->config->item('stripe_key'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "accepttosurl" => cortiam_base_url('ajax/accept-tos'), "couponamount" => cortiam_base_url('ajax/coupon-amount'), "createStripCustomre" => cortiam_base_url('ajax/create-stripe-customer')));

        $this->_frontend('myplan', 'agent');
    }


    public function update_plan($plan_id)
    {


        $this->page_data['header_data']['meta_title'] .= ' - Edit My Account';
        $this->page_data['header_data']['page_title'] = 'Edit My Account';
        $this->page_data['header_data']['current_menu'] = 'editaccount';
        $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';

        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "freeajaxurl" => base_url('agent/ajax/free-plan-activation'), "paymentajaxurl" => base_url('/ajax/payment'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "planajaxurl" => cortiam_base_url('ajax/update-plan'), "passwordajaxurl" => cortiam_base_url('ajax/change-password'), "changepaymenturl" => cortiam_base_url('ajax/change-payment'), "getlicenseformurl" => cortiam_base_url('ajax/get-licenseform'), "addlicenseurl" => cortiam_base_url('ajax/add-license'), "editlicenseurl" => cortiam_base_url('ajax/edit-license'), "deletelicenseurl" => cortiam_base_url('ajax/delete-license'), "listlicenseurl" => cortiam_base_url('ajax/list-licenses'), "getformurl" => cortiam_base_url('ajax/get-paymentform'), "deletecardurl" => cortiam_base_url('ajax/delete-card'), "updatecardurl" => cortiam_base_url('ajax/get-my-cards'), "newcardurl" => cortiam_base_url('ajax/new-credit-card'), "setpaymenturl" => cortiam_base_url('ajax/set-payment'), "listpackagesurl" => cortiam_base_url('ajax/list-packages'), "buypackageurl" => cortiam_base_url('ajax/buy-package'), "listinvoicesurl" => cortiam_base_url('ajax/list-payments'), "listmypackagesurl" => cortiam_base_url('ajax/list-mypackages'), "stripekey" => $this->config->item('stripe_key'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "accepttosurl" => cortiam_base_url('ajax/accept-tos'), "couponamount" => cortiam_base_url('ajax/coupon-amount'), "createStripCustomre" => cortiam_base_url('ajax/create-stripe-customer')));
        if ($this->account['payment_id']) {
            $this->page_data['credit_cards'] = $this->agent_model->get_credit_cards($this->ion_auth->get_user_id());
        }
        $this->page_data['licenses'] = $this->agent_model->get_licenses($this->ion_auth->get_user_id());
        $this->page_data['invoices'] = $this->agent_model->get_invoices($this->account['id'], array('Completed', 'Failed', 'Refund'));
        $plan_id = $this->agent_model->get_plan($this->ion_auth->get_user_id());
        $this->page_data['plans'] = $this->agent_model->membership_plans($plan_id);
        $this->page_data['planId'] = $plan_id['plan_id'];
        $this->page_data['footer_data']['js_files']   = NULL;
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/jquery.min.js');
        $this->page_data['footer_data']['js_files'][] =  "http://malsup.github.io/jquery.blockUI.js";
        $this->page_data['footer_data']['js_files'][] = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js";    
        $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';
        $this->page_data['cardsList'] = $this->agent_model->getcardsList($this->ion_auth->get_user_id());
        $this->page_data['planExpiry'] = $this->agent_model->checkPlanExpiry($this->ion_auth->get_user_id());
        $this->page_data['coupons'] = $this->agent_model->get_coupons_unused($this->ion_auth->get_user_id());
        $this->page_data['phone']    = $this->account['phone'];
        $this->page_data['username'] = $this->account['username'];

        if(isset($this->account['plan_id']) && $this->account['plan_id'] !== NULL )
        {

            $trial_invoice = $this->agent_model->trial_plan_info($this->ion_auth->get_user_id());
            $this->page_data['trial'] = $trial_invoice['payment_type'];
        }

        $this->db->select('free_days');
        $this->db->where('state',$this->account['state']);
        $this->db->where('free_period','Yes');
        $this->db->from('state_costs');
        $state_free_time  = $this->db->get()->row_array();
        $state_free_time = $state_free_time['free_days'];

        $this->page_data['free_days'] = 0;

        if($state_free_time != NULL)
        {
            $your_date = $this->account['created_on'];
            $now = strtotime("now");
            $datediff = $now - (int)$your_date;
            $days_diff = round($datediff / (60 * 60 * 24));
            if ($days_diff < $state_free_time)
            {
                $this->page_data['free_days'] =  1;
            }
        }






        $this->_frontend('agentplans', 'newaccount');
    }

    public function unsubscribe_plan($plan_id)
    {
        
        $this->agent_model->unsubscribe_plan($plan_id, $this->ion_auth->get_user_id());
        redirect(base_url('/agent/my-plan'), 'refresh');

    }

    /**
     * Displays the approval process page of Agent account
     * @return void
     * @uses agent_model::list_approval_text Gets agent approval history and details
     *
     */
    public function approval_process()
    {
        $this->page_data['header_data']['meta_title'] .= ' - My Approval Process';
        $this->page_data['header_data']['page_title'] = 'My Approval Process';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';
        if ($this->account['approval'] == 'Completed') {
            redirect(cortiam_base_url(''), 'refresh');
        }

        $this->agent_model->set_notification_type_read($this->ion_auth->get_user_id(), 'account_declined');
        $this->page_data['history'] = $this->agent_model->list_approval_text(array('agent_id' => $this->ion_auth->get_user_id()));
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/request-approval/')));
        $this->_frontend('approvalpage', 'seller');
    }

    /**
     * Displays the coupons page of Agent account
     * @return void
     * @uses agent_model::get_coupons Gets list of agent coupons and details
     *
     */
    public function my_coupons()
    {
        $this->page_data['header_data']['meta_title'] .= ' - My Coupons';
        $this->page_data['header_data']['page_title'] = 'My Coupons';
        $this->page_data['header_data']['current_menu'] = 'discount';

        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/add-coupon'), "updateurl" => cortiam_base_url('ajax/get-my-coupons'), "orderurl" => cortiam_base_url('ajax/change-coupon-order')));
        $this->page_data['coupons'] = $this->agent_model->get_coupons($this->account['id']);
        $this->_frontend('coupons', 'agent');
    }

    /**
     * Adds the coupon to the Agent account
     * @param string $coupon_code Coupon Code
     * @return void
     * @uses agent_model::process_coupon Adds agent coupons and details
     *
     */
    public function add_coupon($coupon_code = null)
    {
        if ($coupon_code) {
            $response = $this->agent_model->process_coupon($this->account['id'], $coupon_code);
            if ($response['success']) {
                $this->session->set_flashdata('notify', 'success');
                $this->session->set_flashdata('notify_message', $response["success_message"]);
                $this->session->set_flashdata('notify_title', $response["success_title"]);
            } else {
                $this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('notify_message', $response["fail_message"]);
                $this->session->set_flashdata('notify_title', $response["fail_title"]);
            }
            redirect(cortiam_base_url('my-coupons'), 'refresh');
        } else {
            redirect(cortiam_base_url('my-coupons'), 'refresh');
            exit();
        }
    }

    /**
     * Displays the Property page
     * @param string $property_string Property URL String
     * @return void
     * @uses agent_model::get_proposal_value Gets list of proposals of property by this agent
     * @uses agent_model::get_counter_offer_value Gets list of counter offers of property by this agent
     * @uses agent_model::get_win_properties Gets list of properties agent wins
     *
     * @uses agent_model::get_property Gets details of selected property
     * @uses agent_model::get_save_value Gets list of saved properties
     */
    public function view_property($property_string = null)
    {
        $agent_info = $this->agent_model->get_agent($this->ion_auth->get_user_id());


        if ($property_string) {
            $url = explode('-', $property_string);
            $property_id = (int)$url[0];
            if ($this->page_data['property'] = $this->agent_model->get_property($property_id)) {
                $this->page_data['header_data']['meta_title'] .= ' - View Listing';
                $this->page_data['header_data']['page_title'] = 'View Listing';
                $this->page_data['header_data']['current_menu'] = 'listing';

                $this->page_data['save_status'] = $this->agent_model->get_save_value($this->account['id'], $property_id);
                $this->page_data['proposal_status'] = $this->agent_model->get_proposal_value($this->account['id'], $property_id);
                $this->page_data['cof_status'] = $this->agent_model->get_counter_offer_value($this->account['id'], $property_id);
                $this->page_data['win_properties'] = $this->agent_model->get_win_properties($this->account['id'], true);
                $this->page_data['amount_limit'] = $agent_info['amount_limit'];

                $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "property_id" => $property_id, "savepropertyurl" => cortiam_base_url('ajax/save-property'), "expresspropertyurl" => cortiam_base_url('ajax/express-property'), "counterofferform" => cortiam_base_url('ajax/counter-offer-form'), "counterofferurl" => cortiam_base_url('ajax/send-proposal'), "withdrawproposalurl" => cortiam_base_url('ajax/withdraw-proposal')));
                $this->_frontend('property', 'agent');
            } else {
                $this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('notify_message', 'Requested property cannot be found. Please check your URL and try again.');
                $this->session->set_flashdata('notify_title', 'Requested Property Cannot Found');
                redirect(cortiam_base_url(''), 'refresh');
                exit();
            }
        } else {
            $this->session->set_flashdata('notify', 'error');
            $this->session->set_flashdata('notify_message', 'Requested property cannot be found. Please check your URL and try again.');
            $this->session->set_flashdata('notify_title', 'Requested Property Cannot Found');
            redirect(cortiam_base_url(''), 'refresh');
            exit();
        }
    }

    /**
     * Displays the proposals page
     * @return void
     * @uses agent_model::get_win_properties Gets list of properties agent wins
     *
     * @uses agent_model::get_proposals Gets list of proposals by this agent by selected criterias
     */
    public function proposals()
    {

        $this->page_data['header_data']['meta_title'] .= ' - Proposals';
        $this->page_data['header_data']['page_title'] = 'Proposals';
        $this->page_data['header_data']['current_menu'] = 'proposals';

        $this->page_data['waiting_proposals'] = $this->agent_model->get_proposals($this->ion_auth->get_user_id(), array('status' => array('Read', 'Unread')));
        $this->page_data['accepted_proposals'] = $this->agent_model->get_proposals($this->ion_auth->get_user_id(), array('status' => array('Accepted')));
        $this->page_data['declined_proposals'] = $this->agent_model->get_proposals($this->ion_auth->get_user_id(), array('status' => array('Declined')));
        $this->page_data['win_properties'] = $this->agent_model->get_win_properties($this->account['id'], true);

        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "counterofferform" => cortiam_base_url('ajax/counter-offer-form'), "counterofferurl" => cortiam_base_url('ajax/send-counter-offer'), "acceptproposalurl" => cortiam_base_url('ajax/accept-proposal'), "declineproposalurl" => cortiam_base_url('ajax/decline-proposal'), "withdrawproposalurl" => cortiam_base_url('ajax/withdraw-proposal')));

        $this->_frontend('proposals', 'agent');
    }

    /**
     * Displays the proposal page itself
     * @param string $proposal_string Proposals URL String
     * @return void
     * @uses agent_model::get_proposal Gets details of selected proposal
     * @uses agent_model::check_newer_proposal Checks and gets details of newer proposal if any
     * @uses agent_model::get_related_proposal Gets list and details proposals which related with selected proposal
     * @uses agent_model::get_property Gets details of selected property
     * @uses agent_model::get_save_value Gets list of saved properties
     * @uses agent_model::get_proposal_value Gets list of proposals of property by this agent
     * @uses agent_model::get_counter_offer_value Gets list of counter offers of property by this agent
     * @uses agent_model::get_win_properties Gets list of properties agent wins
     * @uses agent_model::mark_proposal_read Marks current proposal as read
     *
     */
    public function view_proposal($proposal_string = null)
    {
        if ($proposal_string) {
            $url = explode('-', $proposal_string);
            $proposal_id = (int)$url[0];
            if ($this->page_data['proposal'] = $this->agent_model->get_proposal($this->ion_auth->get_user_id(), $proposal_id)) {
                if ($newer_proposal = $this->agent_model->check_newer_proposal($this->ion_auth->get_user_id(), $proposal_id)) {
                    redirect(cortiam_base_url('view-proposal/') . $newer_proposal['prop_id'] . '-' . url_title(trim(preg_replace("/[^0-9a-z]+/i", " ", $newer_proposal['city'] . ' ' . $newer_proposal['state'])), 'underscore', true), 'refresh');
                    exit();
                } else {
                    if ($this->page_data['proposal']['base_id'] || $this->page_data['proposal']['main_id']) {
                        $this->page_data['related_proposals'] = $this->agent_model->get_related_proposal((($this->page_data['proposal']['base_id']) ? $this->page_data['proposal']['base_id'] : $this->page_data['proposal']['main_id']));
                    }
                    $this->page_data['property'] = $this->agent_model->get_property($this->page_data['proposal']['property_id']);
                    $this->page_data['save_status'] = $this->agent_model->get_save_value($this->account['id'], $property_id);
                    $this->page_data['proposal_status'] = $this->agent_model->get_proposal_value($this->account['id'], $property_id);
                    $this->page_data['header_data']['meta_title'] .= ' - View Proposal';
                    $this->page_data['header_data']['page_title'] = 'View Proposal';
                    $this->page_data['header_data']['current_menu'] = 'proposals';
                    $this->page_data['win_properties'] = $this->agent_model->get_win_properties($this->account['id'], true);

                    $this->agent_model->mark_proposal_read($this->ion_auth->get_user_id(), $proposal_id);
                    $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "proposal_id" => $proposal_id, "acceptproposalurl" => cortiam_base_url('ajax/accept-proposal'), "declineproposalurl" => cortiam_base_url('ajax/decline-proposal'), "counterofferform" => cortiam_base_url('ajax/counter-offer-form'), "counterofferurl" => cortiam_base_url('ajax/send-counter-offer'), "withdrawproposalurl" => cortiam_base_url('ajax/withdraw-proposal')));

                    $this->_frontend('proposal_view', 'agent');
                }
            } else {
                $this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('notify_message', 'Requested proposal cannot be found. Please check your URL and try again.');
                $this->session->set_flashdata('notify_title', 'Requested Proposal Cannot Found');
                redirect(cortiam_base_url(''), 'refresh');
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
     * Displays the Messages page
     * @return void
     * @uses agent_model::get_message_list Gets list and details of messages grouped by user
     *
     */
    public function message_center($customer, $customer_id)
    {
        $this->page_data['header_data']['meta_title'] .= ' - Message Center';
        $this->page_data['header_data']['page_title'] = 'Message Center';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';

        $this->page_data['messages'] = $this->agent_model->get_message_list($this->ion_auth->get_user_id(), $customer, $customer_id);

        $this->_frontend('message_center', 'agent');
    }

    public function message_center_all()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Message Center';
        $this->page_data['header_data']['page_title'] = 'Message Center';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';

        $this->page_data['messages'] = $this->agent_model->get_message_list_all($this->ion_auth->get_user_id());



        $this->_frontend('message_center', 'agent');
    }

    /**
     * Displays the Messages page
     * @return void
     * @uses agent_model::get_message_list Gets list and details of messages grouped by user
     *
     */
    public function read_admin_message()
    {
        $agent_id = $this->input->post("agent_id");
        $admin_id = $this->input->post("admin_id");

        $data = [
            'status' => 'Read',
            'seen_date' => time(),
        ];

        $this->db->where('agent_id', $agent_id);
        $this->db->where('admin_id', $admin_id);
        $this->db->update('messages', $data);

        redirect(base_url('/agent/message-from-administrator'));

    }

    public function message_from_administrator()
    {

        $id = $this->account['id'];

        $query = $this->db->where('agent_id =', $id)
            ->where('admin_id !=', null)
            ->from('messages')->get();

        $resultSet = $query->result_array();

        $this->page_data['messages'] = $this->messages = $resultSet;

        $this->_frontend('message_from_administrator', 'agent');

    }

    /**
     * Displays the Message page of user
     * @param string $seller_string Sellers URL String
     * @return void
     * @uses agent_model::get_messages_of Gets list and details of messages by selected user
     * @uses agent_model::mark_messages_read Marks messages by selected user as read
     *
     */
    public function view_messages($customer, $user_id)
    {
        $this->page_data['header_data']['meta_title'] .= ' - Message Box';
        $this->page_data['header_data']['page_title'] = 'Message Box';
        $this->page_data['header_data']['current_menu'] = 'messagecenter';

        if ($customer !== '')
        {
            $this->page_data['user_id'] = $user_id;
            $user_information = $this->agent_model->get_active_user($user_id);
            $user_information = explode(",", $user_information);
            $this->page_data['user_type'] = $user_type = $customer;
            $this->page_data['email'] = $user_information[1];
            $this->page_data["pms"] = NULL;

            if(isset($user_type) && $user_type == 'seller' || $user_type == 'Seller')
            {
               $this->page_data['messages'] = $this->seller_model->get_messages_for_agent($user_id,$this->ion_auth->get_user_id());
            }elseif(isset($user_type) && $user_type == 'buyer' || $user_type == "Buyer"){
                $this->page_data['messages'] = $this->buyer_model->get_messages_for_agent($user_id,$this->ion_auth->get_user_id());
            }else{
                $this->page_data['messages'] = $this->page_data["pms"];
            }

            $sendByTheAgent = $this->agent_model->msg_send_by_agent($this->ion_auth->get_user_id(), $user_id);

            if($sendByTheAgent['msg_from'] !== 'Agent')
            {
               $this->agent_model->mark_messages_read($this->ion_auth->get_user_id(), $user_id);
            }
            $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/send-message/' . $seller_id)));
            $this->_frontend('messages', 'agent');
        } else {
            $this->session->set_flashdata('notify', 'error');
            $this->session->set_flashdata('notify_message', 'Requested message history cannot be found. Please check your URL and try again.');
            $this->session->set_flashdata('notify_title', 'Requested Message History Cannot Found');
            redirect(cortiam_base_url(''), 'refresh');
            exit();
        }

    }

    /**
     * Displays the Agreements page
     * @return void
     * @uses agent_model::get_aggrements Gets list and details of agents agreements
     *
     */
    public function agreements()
    {
        $this->page_data['header_data']['meta_title']  .= ' - Agreements';
        $this->page_data['header_data']['page_title']   = 'Agreements';
        $this->page_data['header_data']['current_menu'] = 'agreements';
        $this->page_data['agreements']                  = $this->agent_model->get_aggrements($this->ion_auth->get_user_id());
        $this->page_data['agent_coupon_info']           = $this->agent_model->get_coupon_discount($this->ion_auth->get_user_id());
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "latestcoupon" => cortiam_base_url('ajax/lastest-coupon') ,"accepturl" => cortiam_base_url('ajax/accept-agreement'), "declineurl" => cortiam_base_url('ajax/decline-agreement')));

        $this->_frontend('agreements', 'agent');
    }

    public function property_payment($agr_id)
    {
        $this->page_data['footer_data']['js_files']= array();
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/jquery.min.js');
        $this->page_data['footer_data']['js_files'][] = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js";
        $this->page_data['footer_data']['js_files'][] =  "http://malsup.github.io/jquery.blockUI.js";
        $this->page_data['footer_data']['js_files'][] = 'https://js.stripe.com/v3/';

        $this->page_data['header_data']['meta_title']  .= ' - Property payment';
        $this->page_data['header_data']['page_title']   = 'Property payment';
        $this->page_data['header_data']['current_menu'] = 'Property payment';
        $this->page_data['agreements']                  = $this->agent_model->pay_property_payment($this->ion_auth->get_user_id(),$agr_id);
        $this->page_data['price']                       = $this->page_data['agreements']['original_fee'];
        $this->page_data['agent_coupon_info']           = $this->agent_model->get_agent_coupons($this->ion_auth->get_user_id());

        $this->page_data['cardsList']                   = $this->agent_model->getcardsList($this->ion_auth->get_user_id());

        $this->_addjson('cortiamajax', array("confirmpassword" => base_url('/images/confirm_pass.svg'), "deletePremiumRecord" => base_url('/ajax/deletePremiumRecord'), "premiumlisting" => base_url('/ajax/premiumlisting') ,  "savePackage" => base_url('/ajax/savepremiumlisting')  , "createpassword" => base_url('/images/eye.svg'), "loadingimage" => base_url('/images/loading.gif'), "myplan" => base_url('/agent/my-plan'), "paymentajaxurl" => base_url('/ajax/premiumn-payment'), "formajaxurl" => cortiam_base_url('ajax/update-account'), "planajaxurl" => cortiam_base_url('ajax/update-plan'), "passwordajaxurl" => cortiam_base_url('ajax/change-password'), "changepaymenturl" => cortiam_base_url('ajax/change-payment'), "getlicenseformurl" => cortiam_base_url('ajax/get-licenseform'), "addlicenseurl" => cortiam_base_url('ajax/add-license'), "editlicenseurl" => cortiam_base_url('ajax/edit-license'), "deletelicenseurl" => cortiam_base_url('ajax/delete-license'), "listlicenseurl" => cortiam_base_url('ajax/list-licenses'), "getformurl" => cortiam_base_url('ajax/get-paymentform'), "deletecardurl" => cortiam_base_url('ajax/delete-card'), "updatecardurl" => cortiam_base_url('ajax/get-my-cards'), "newcreditcarddirect" => cortiam_base_url('ajax/new-credit-card-direct')  , "newcardurl" => cortiam_base_url('ajax/new-credit-card'), "setpaymenturl" => cortiam_base_url('ajax/set-payment'), "listpackagesurl" => cortiam_base_url('ajax/list-packages'), "stripekey" => $this->config->item('stripe_key'), "deactivateurl" => cortiam_base_url('ajax/deactivate-me'), "accepttosurl" => cortiam_base_url('ajax/accept-tos'), "couponamount" => cortiam_base_url('ajax/coupon-amount'), "createStripCustomre" => cortiam_base_url('ajax/create-stripe-customer')));

        $this->_frontend('agentpaymentamount');
    }

    /**
     * Displays the Tutorial page
     * @return void
     * @uses agent_model::get_tutorial Gets tutorials page content
     *
     */
    public function tutorials()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Tutorials';
        $this->page_data['header_data']['page_title'] = 'Tutorials';
        $this->page_data['header_data']['current_menu'] = 'tutorial';

        $this->page_data['content'] = $this->agent_model->get_tutorial();
        $this->_frontend('tutorial', 'agent');
    }

    public function video()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Introduction video';
        $this->page_data['header_data']['page_title'] = 'Introduction video';
        $this->page_data['header_data']['current_menu'] = 'introduction video';

        $this->page_data['content'] = $this->agent_model->get_tutorial();
        $this->_frontend('video', 'agent');
    }

    /**
     * Displays the support center page
     * @return void
     * @uses agent_model::get_support_messages Gets support messages history
     *
     */
    public function support_center()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Support Request';
        $this->page_data['header_data']['page_title'] = 'Support Request';
        $this->page_data['header_data']['current_menu'] = 'support';

        $this->page_data['messages'] = $this->agent_model->get_support_messages($this->ion_auth->get_user_id());
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "formajaxurl" => cortiam_base_url('ajax/send-support/')));

        $this->_frontend('support_center', 'agent');
    }


    /**
     * Displays the notifications page
     * @return void
     * @uses agent_model::get_notifications Gets list of agents notifications
     *
     */
    public function notifications()
    {
        $this->page_data['header_data']['meta_title'] .= ' - System Notifications';
        $this->page_data['header_data']['page_title'] = 'System Notifications';
        $this->page_data['header_data']['current_menu'] = 'notifications';

        $this->page_data['notifications'] = $this->agent_model->get_notifications($this->ion_auth->get_user_id());
        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif')));

        $this->_frontend('notifications', 'agent');
    }

    public function reviews()
    {
        $this->page_data["account"] = $this->account = $this->agent_model->get_agent($this->ion_auth->get_user_id());
        $this->_frontend('review_form', 'agent');
    }

    public function submitReviewForm()
    {
        $this->_frontend('review_form', 'agent');

        $this->page_data["account"] = $this->account = $this->agent_model->get_agent($this->ion_auth->get_user_id());

        if ($this->input->post('save_review_form')) {
            $data = [
                'agent_id' => $this->account['id'] ?? null,
                'account_id' => null,
                'seller_id' => null,
                'type'       => $this->account['user_type'] ?? null,
                'name' => $this->input->post('name') ?? null,
                'email' => $this->input->post('email') ?? null,
                'slug' => uniqid(),
                'rating' => 0,
                'comment' => null,
                'status' => null,
            ];

            $user_email_text = '<h3 style="color:#4c525e;">
            WELCOME TO CORTIAM</h3>
            <h4 style="color:#848994;">Please Give Review to agent!</h4>
            <p>Please click on the button to open review form.</p><p style="text-align:center;">';
            $user_email_text .= '<a href="' . base_url('review-submit-form') . '/' . $data['slug'] . '" 
            style="border-radius:5px;padding:10px 30px;background:#00c48d;color:#ffffff;text-align:center;font-weight:bold;
            text-transform:uppercase;margin:10px 0px;display:inline-block;text-decoration:none;" target="_blank" class="loginlink">Give Review to Agent</a></p>';

            $this->mailer->regular_email('Review mail', $user_email_text, $this->account['email']);

            $response = $this->agent_model->saveReviewForm($data);

            if ($response == true) {
                echo "Records Saved Successfully";
            } else {
                echo "Insert error !";
            }
        }

        $this->_frontend('notifications', 'agent');
    }

    public function agent_avaiability_slots()
    {

//        echo 'Nadeem';
//        $this->page_data['header_data']['meta_title'] .= ' - Specializations';
//        $this->page_data['header_data']['main_title'] = 'Specializations';
//        $this->page_data['header_data']['page_title'] = 'Specializations List';
//        $this->page_data['header_data']['breadcrumb'][1] = 'Specializations';
//        $this->page_data['header_data']['breadcrumb_links'][1] = null;
//        $this->page_data['header_data']['menusection'] = 'specializations';
//        $this->page_data['header_data']['menuitem'] = 'specializations';
////        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/backend/specializations.js');

        $this->_addjson('cortiamajax', array("loadingimage" => base_url('/images/loading.gif'), "specializationtableajaxurl" => base_url('/ajax/backend/list-specializations'), "addspecializationajaxurl" => base_url('/ajax/backend/add-specializations'), "specializationupdateajaxurl" => base_url('/ajax/backend/update-specializations')));
        $this->_backend('myprofile');
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

        $selectedAttributes = $this->agent_model->getAllSelectAttributes($this->account['id']);

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


        $this->page_data['questions'] = $this->questions = $this->agent_model->get_questions();
        $this->load->view('agent/pages/'.$page, $this->page_data);
        $this->load->view('frontend/shared/footer');
    }

  

    public function save_premium_listing_listing()
    {
        $data = $this->agent_model->displaySearchQueryRecords($this->account['id']);
        $i = 1;
        foreach ($data as $row)
        {
            echo "<tr>";
            echo "<td style='padding: 5px 20px !important;'>" . $i . "</td>";
            echo "<td class='' style='padding: 5px 20px;text-transform: capitalize !important;'>" . $row['query_type'] . "</td>";
            echo "<td class='' style='padding: 5px 20px;text-transform: capitalize !important;'>" . $row['query_value'] . "</td>";
            echo "<td class='text-center' style='padding: 5px 20px !important;'><button type='button' class='btn text-danger font-weight-bold deletePremiumSearchQuery' data-id='" . $row['id'] . "'> 

            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
              <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
            </svg></button></td>";
            echo "</tr>";
            $i++;
        }
    }

    public function delete_save_premium_listing()
    {
        $id = $this->input->post('id');
        $this->agent_model->deletePremiumSearchQuery($id);
        echo json_encode(array(
            "statusCode" => 200
        ));
    }

    public function save_premium_listing()
    {   
        $agent_id = $this->account['id'];

        $this->db->select('agents.plan_id');
        $this->db->from('agents');
        $this->db->where('agent_id =', $agent_id);
        $record = $this->db->get()->row_array();     
        $plan_id = $record['plan_id'];
        $data = $this->input->post('list_premium_query');

        foreach ($data as $dt) {

            $query = $this->db->where('query_type =', $dt['query_type'])
                ->where('query_value =', $dt['query_value'])
                ->where('agent_id =', $dt['agent_id'])
                ->from('save_premium_listing')->get();

            $resultSet = $query->result_array();

            if (isset($resultSet) && count($resultSet) > 0) {

                echo json_encode(array(
                    "status" => "record_exists"
                ));

            } else {     

                $data = [
                    'agent_id' => $agent_id,
                    'plan_id'   => $plan_id,
                    'query_type' => $dt['query_type'],
                    'query_value' => $dt['query_value'],
                    'latitude' => $dt['latitude'] ?? null,
                    'longitude' => $dt['longitude'] ?? null,
                ];
               

                $response = $this->agent_model->savePremiumSearchQuery($data);

                echo json_encode(array(
                    "statusSave" => "success"
                ));

            }

        }
    }



    public function allPlans($agent_id)
    {
        $this->db->from('subscription_tbl');
        $this->db->where('user_id =', $agent_id);
        return $records = $this->db->get()->row_array();
    }
    public function agent_oldplans()
    {   
        $draw     = $_REQUEST['draw'];
        $agent_id = $this->account['id'];

        $search 		 = $_REQUEST['search']['value']; // Search value	
        $start 			 = $_REQUEST['start'];
        $rowperpage 	 = $_REQUEST['length']; // Rows display per page
        $columnIndex 	 = $_REQUEST['order'][0]['column']; // Column index
        $columnName 	 = $_REQUEST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_REQUEST['order'][0]['dir']; // asc or desc

        $this->db->from('subscription_tbl');
        $this->db->where('user_id =', $agent_id);
        $this->db->like('plan_name', $search, 'both');
        $this->db->order_by('id', 'desc');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result_array();

        $data = array();
        if (isset($records) && !empty($records))
        {           
           foreach ($records as $key => $record)
            {
                $data[] = array(
                                "id"	     => $record['id'],
                                "plan_name"	 => $record['plan_name'], 
                                "subtotal"   => "$".$record['subtotal'],
                                "discount"   => "$".$record['discount'],
                                "totalprice" => "$".$record['totalprice'],
                                "status"    => $record['status']

				            );
            }
        }

        $totalRecordwithFilter = count($records);

        $this->db->from('subscription_tbl');
        $this->db->where('user_id =', $agent_id);
        $this->db->like('plan_name', $search, 'both');
        $totalRecords = $this->db->get()->result_array();

        $totalRecords 		   = count($totalRecords);
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecordwithFilter,
			"iTotalDisplayRecords" => $totalRecords,
			"data" => $data
		);


		echo json_encode($response);die();

        
    }


    public function agent_oldfeatures()
    {  
        $subscription_id = $_REQUEST['subscription_id'];
        
        $this->db->from('subscription_items');
        $this->db->where('subscription_id =', $subscription_id);        
        
        $records = $this->db->get()->result_array();
        echo json_encode($records);die();
        exit;

    }

    public function term_and_condition()
    {
        $this->page_data['header_data']['meta_title'] .= ' - Term and Conditions';
        $this->page_data['header_data']['page_title'] = 'Term and Conditions';
        $this->page_data['header_data']['current_menu'] = 'termandconditions';

        $this->page_data['content'] = $this->agent_model->get_tutorial();
        $this->_frontend('termandconditions', 'agent');
    }
}

?>