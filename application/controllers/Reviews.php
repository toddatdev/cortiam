<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Reviews extends CRTM_Controller {


    /**
     * Get All Data from this method.
     *
     * @return Response
     */

    function __construct(){
        parent::__construct();

        $this->load->database();

//        $this->load->model('review_model');

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
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/bootstrap-datepicker.min.js');
        $this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/pickers/daterangepicker.js');
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

//        if ($this->ion_auth->logged_in() && ($this->ion_auth->get_user_type() == 'Agent'))	{
//            $this->page_data["account"] =  $this->account = $this->agent_model->get_agent($this->ion_auth->get_user_id());
//            $this->page_data["pms"] = $this->agent_model->get_new_messages($this->ion_auth->get_user_id());
//            $this->page_data["usnos"] = $this->agent_model->get_new_offer_news($this->ion_auth->get_user_id());
//            $this->page_data["usnots"] = $this->agent_model->get_new_notifications($this->ion_auth->get_user_id());
//            $this->page_data["uswapp"] = $this->agent_model->get_aggrements($this->ion_auth->get_user_id(), array('status' => array('Open')));
//            $this->page_data["account"]['licenses'] =  $this->account['licenses'] = $this->agent_model->get_my_licenses($this->ion_auth->get_user_id());
//        }else{
//            redirect('/login', 'refresh');
//        }
//        if ($this->router->fetch_method() != 'edit_account') {
//            if ($this->account['licenses']['no_license'] || $this->account['licenses']['no_active_license']){
//                redirect('/agent/edit-account', 'refresh');
//            }
//        }
////		print_r($this->account['licenses']);
//        if ($this->account['licenses']['no_active_license']){
//            $this->_addjson('popmeup',array( 'messagetitle' => 'Your Real Estate Agent License(s) Has Expired.', 'messagetext' => 'Please update your '.implode(", ",$this->account['licenses']['expired_states']).' license information with your new license details before you continue using our system. After you update your license information, the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.'));
//        }
//        if ($this->account['licenses']['no_license']){
//            $this->_addjson('popmeup',array( 'messagetitle' => 'Please Add Your Real Estate Agent License', 'messagetext' => 'Please add your real estate agent license information before you continue using our system. After you update your license information, the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.'));
//        }
//        if ($this->session->flashdata('notify')) {
//            $this->_addjson('notify',array( 'position' => 'topCenter', 'transitionIn' => 'bounceInUp', 'transitionOut' => 'fadeOutUp', 'layout' => 2, 'theme' => $this->session->flashdata('notify'), 'message' => $this->session->flashdata('notify_message'), 'title' => $this->session->flashdata('notify_title'), 'maxWidth' => 1100, 'timeout' => 9000, 'drag' => false, 'imageWidth' => 150, 'image' => (($this->session->flashdata('notify_image'))? $this->session->flashdata('notify_image'):null)));
//        }else{
//            $this->_addjson('notify',array());
//        }
//        $this->_addjson('cortiamphotoajax',array("avataruploadurl" => cortiam_base_url('ajax/upload-avatar'),"loadingimage" => base_url('/images/loading.gif')));
//

    }

    /**
     * Display Data this method.
     *
     * @return Response
     */
    /**
     * Display Data this method.
     *
     * @return Response
     */

    public function index()
    {

        $this->load->view('agent/pages/review');

    }




}