<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cortiam Web Applications Core controller
 *
 * The core controller which creates layout and displaying templates of the Cortiam Web Application
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

class CRTM_Controller extends CI_Controller {

	var $page_data = array();
	var $json_data = array();
	var $permissions = array();
	var $account = array();

	public function __construct(){
    parent::__construct();
		date_default_timezone_set('America/Toronto');
		$this->load->database();
		$this->load->model('agent_model');
		$this->load->model('seller_model');
		$this->load->model('buyer_model');
		$this->load->helper('url'); 
		$this->page_data['header_data']['css_files'][] = base_url('assets/css/dist/bootstrap.min.css');
		$this->page_data['header_data']['css_files'][] = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';

		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/jquery.min.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/interactions.min.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/widgets.min.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/extensions/jquery_ui/effects.min.js');

		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/bootstrap.bundle.min.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/dist/cslist.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/inputs/form.min.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/forms/validation/validate.min.js');
		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/plugins/loaders/blockui.min.js');


		$this->page_data['header_data']['meta_title'] = 'Cortiam';
		$this->page_data['header_data']['breadcrumb'][0] = 'Dashboard';
		$this->page_data['header_data']['breadcrumb_links'][0] = base_url('ct-admin');

	}

	/**
	 * Displays template
	 *
	 * @param  string $page Page template name
	 * @param  string $site_section Site section to display
	 * @return void
	 */
	public function _frontend($page, $site_section = "general"){


		switch ($site_section) {

			case "login":
				$this->page_data['header_data']['css_files'][] = base_url('assets/css/login.css');
				if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js')) {
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
				}
				$this->load->view('frontend/shared/login_header', $this->page_data);
				if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }
				$this->load->view('frontend/pages/'.$page);
				$this->load->view('frontend/shared/login_footer');
			break;

			case "agent_without_plan":

				$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
					if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js'))
					{
						$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
					}

					$this->load->view('frontend/shared/header', $this->page_data);
					if (isset($this->json_data['js_variables']))
					{
						$this->load->view('global/json', $this->json_data);
					}

				$this->load->view('agent/pages/'.$page, $this->page_data);
				$this->load->view('frontend/shared/footer');

			break;

			case "agent":

				$SurveyExist = $this->agent_model->checkAttributes($this->ion_auth->get_user_id());

			
				if(!isset($SurveyExist['user_id']) || empty($SurveyExist['user_id']))
				{
					$page = "attributes";
					$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');				
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');

					$this->load->view('frontend/shared/header', $this->page_data);

					if (isset($this->json_data['js_variables']))
					{
						$this->load->view('global/json', $this->json_data);
					}

					$this->load->view('agent/pages/'.$page, $this->page_data);
					$this->load->view('frontend/shared/footer');
					break;
				}
				//$SurveyExist = $this->agent_model->checkSurvey($this->ion_auth->get_user_id());


				// if(isset($SurveyExist['status']) && $SurveyExist['status'] == 3 && $SurveyExist['question_id'] == 0)
				// {

				// 	$page = "survey";
				// 	$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
				// 	if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js'))
				// 	{
				// 		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
				// 	}

				// 	$this->load->view('frontend/shared/header', $this->page_data);

				// 	if (isset($this->json_data['js_variables']))
				// 	{
				// 		$this->load->view('global/json', $this->json_data);
				// 	}

				// 	$this->load->view('agent/pages/'.$page, $this->page_data);
				// 	$this->load->view('frontend/shared/footer');
				// 	break;
				// }
			
		
				if(!isset($SurveyExist) && empty($SurveyExist))
				{	
					$SurveyExist = "notempty";
					redirect('agent/edit-account');
					break;		
				}

				$this->page_data['header_data']['css_files'][] = base_url('assets/css/agent.css');
				$this->page_data['footer_data']['js_files'][] = base_url('assets/js/agent.js');
				if (file_exists(FCPATH.'assets/js/pages/agent/'.$page.'.js'))
				{
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/agent/'.$page.'.js');
				}
				$this->load->view('agent/shared/agent_header', $this->page_data);
				if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }
				$this->load->view('agent/pages/'.$page);
				$this->load->view('agent/shared/agent_footer');

				break;
			case "buyer":

				$SurveyExist = $this->agent_model->checkAttributes($this->ion_auth->get_user_id());
				$this->page_data['userType'] = $this->ion_auth->get_user_type();

					
				if(!isset($SurveyExist['user_id']) || empty($SurveyExist['user_id']))
				{
					$page = "attributes";
					$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');				
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');

					$this->load->view('frontend/shared/header', $this->page_data);

					if (isset($this->json_data['js_variables']))
					{
						$this->load->view('global/json', $this->json_data);
					}

					$this->load->view('buyer/pages/'.$page, $this->page_data);
					$this->load->view('frontend/shared/footer');
					break;
				}

				// $SurveyExist = $this->seller_model->checkSurvey($this->ion_auth->get_user_id());
        
				// if(!isset($SurveyExist) && empty($SurveyExist))
				// {
				// 	$page = "survey";
				// 	$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
				// 	if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js'))
				// 	{
				// 		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
				// 	}

				// 	$this->load->view('frontend/shared/header', $this->page_data);

				// 	if (isset($this->json_data['js_variables']))
				// 	{
				// 		$this->load->view('global/json', $this->json_data);
				// 	}

				// 	$this->load->view('seller/pages/'.$page, $this->page_data);
				// 	$this->load->view('frontend/shared/footer');

				// 	break;
		
				// }

			$this->page_data['header_data']['css_files'][] = base_url('assets/css/seller.css');				
	    	$this->load->view('buyer/shared/seller_header', $this->page_data);
    		if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }
		    $this->load->view('buyer/pages/'.$page);
		    $this->load->view('buyer/shared/seller_footer');
			break;



			case "seller":

				$SurveyExist = $this->agent_model->checkAttributes($this->ion_auth->get_user_id());
				$this->page_data['userType'] = $this->ion_auth->get_user_type();
					
				if(!isset($SurveyExist['user_id']) || empty($SurveyExist['user_id']))
				{
					$page = "attributes";
					$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');				
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');

					$this->load->view('frontend/shared/header', $this->page_data);

					if (isset($this->json_data['js_variables']))
					{
						$this->load->view('global/json', $this->json_data);
					}

					$this->load->view('seller/pages/'.$page, $this->page_data);
					$this->load->view('frontend/shared/footer');
					break;
				}

				// $SurveyExist = $this->seller_model->checkSurvey($this->ion_auth->get_user_id());
        
				// if(!isset($SurveyExist) && empty($SurveyExist))
				// {
				// 	$page = "survey";
				// 	$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
				// 	if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js'))
				// 	{
				// 		$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
				// 	}

				// 	$this->load->view('frontend/shared/header', $this->page_data);

				// 	if (isset($this->json_data['js_variables']))
				// 	{
				// 		$this->load->view('global/json', $this->json_data);
				// 	}

				// 	$this->load->view('seller/pages/'.$page, $this->page_data);
				// 	$this->load->view('frontend/shared/footer');

				// 	break;
		
				// }

				$this->page_data['header_data']['css_files'][] = base_url('assets/css/seller.css');
				$this->page_data['footer_data']['js_files'][] = base_url('assets/js/seller.js');
				if (file_exists(FCPATH.'assets/js/pages/seller/'.$page.'.js')) {
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/seller/'.$page.'.js');
				}
	    	$this->load->view('seller/shared/seller_header', $this->page_data);
    		if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }
		    $this->load->view('seller/pages/'.$page);
		    $this->load->view('seller/shared/seller_footer');
			break;



			case "newaccount":
				$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
					if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js')) {
						$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
					}
				$this->load->view('frontend/shared/newaccountheader', $this->page_data);
				if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }


				$this->load->view('frontend/pages/'.$page, $this->page_data);
				$this->load->view('frontend/shared/footer');
			break;

			case "general":
			default:
				$this->page_data['header_data']['css_files'][] = base_url('assets/css/cortiam.css');
				if (file_exists(FCPATH.'assets/js/pages/frontend/'.$page.'.js')) {
					$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/frontend/'.$page.'.js');
				}
	    	$this->load->view('frontend/shared/header', $this->page_data);
    		if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }


					$this->load->view('frontend/pages/'.$page, $this->page_data);
					$this->load->view('frontend/shared/footer');
				break;


		}
	}


	/**
	 * Displays template
	 *
	 * @param  string $page Page template name
	 * @param  string $site_section Site section to display
	 * @return void
	 */
	public function _backend($page, $site_section = "general"){
		$this->page_data['header_data']['css_files'][] = base_url('assets/css/backend.css');
		if (file_exists(FCPATH.'assets/js/pages/backend/'.$page.'.js')) {
			$this->page_data['footer_data']['js_files'][] = base_url('assets/js/pages/backend/'.$page.'.js');
		}
		switch ($site_section) {
			case "blank":
	    	$this->load->view('backend/shared/blank_header', $this->page_data);
		    $this->load->view('backend/pages/'.$page);
		    $this->load->view('backend/shared/blank_footer');
				break;
			case "general":
			default:
	    	$this->load->view('backend/shared/header', $this->page_data);
    		if (isset($this->json_data['js_variables'])) { $this->load->view('global/json', $this->json_data); }
	    	$this->load->view('backend/shared/navigation', $this->page_data);
		    $this->load->view('backend/pages/'.$page, $this->page_data);
		    $this->load->view('backend/shared/footer');
				break;
		}
	}

	/**
	 * Displays template
	 *
	 * @param  string $page Page template name
	 * @param  string $site_section Site section to display
	 * @return void
	 */
	public function _variabletemplate($page, $site_section = "general"){
		switch ($site_section) {
			case "blank":
	    	$this->load->view('global/blank_header', $this->page_data);
		    $this->load->view('pages/'.$page);
		    $this->load->view('global/blank_footer');
				break;
			case "general":
			default:
    		if (isset($this->json_data['js_variables'])) { $toreturn = $this->load->view('global/json', $this->json_data, true); }
		    $toreturn .= $this->load->view('pages/'.$page, $this->page_data, true);
				break;
		}
		return $toreturn;
	}


	/**
	 * Adds json variables to displayed template
	 *
	 * @param  string $variable_name Name of the json variable
	 * @param  array $variables Array of the variables to be displayed as json
	 * @return void
	 */
	public function _addjson($variable_name, $variables){
		$this->json_data['js_variables'][] = "var ".$variable_name." = ".json_encode($variables).";";
	}

}

?>
