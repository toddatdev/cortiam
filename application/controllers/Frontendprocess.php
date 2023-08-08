
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Frontend Process controller
 *
 * The base controller which process page actions of the Cortiam Web Application Frontend Panel
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

class Frontendprocess extends CRTM_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('frontend_model');
		$this->load->helper(array('backend'));
		$this->load->library('session');


	}

	/**
	 * Add new seller account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function signup_seller(){
		if (!$this->input->post("first_name")) {$response["errorfields"]['first_name'] = "First Name";}
		if (!$this->input->post("last_name")) {$response["errorfields"]['last_name'] = "Last Name";}
		if (!$this->input->post("email")) {$response["errorfields"]['email'] = "Email Address";}
		if (!$this->input->post("phone")) {$response["errorfields"]['phone'] = "Phone Number";}
		if (!$this->input->post("state")) {$response["errorfields"]['statecontainer'] = "State";}
		if (!$this->input->post("customer_type")) {$response["errorfields"]['customer_type'] = "Type";}
		if (!$this->input->post("city")) {$response["errorfields"]['citycontainer'] = "City";}
		if (!$this->input->post("password")) {$response["errorfields"]['password'] = "Password";}
		if (!$this->input->post("passwordagain")) {$response["errorfields"]['passwordagain'] = "Password Confirmation";}

		try {
			//code...
		if ( isset($response["errorfields"]) && count($response["errorfields"]) > 0)
		{
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Required/Missing Fields</h4>'.implode(', ',$response["errorfields"]). ' field(s) are required. Please fill out all the required/missing fields and try again.</div>';

		}elseif (!preg_match($this->config->item('email_pattern'), $this->input->post("email"))) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Invalid Email Address</h4>Your email address format is invalid, please use a valid email address and try again.</div>';
		}elseif (!preg_match($this->config->item('phone_pattern'), $this->input->post("phone"))) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Invalid Phone Number</h4>Your phone number format is invalid, please use a valid phone number and try again.</div>';
		}elseif ($this->input->post("password") != $this->input->post("passwordagain")) {
			$response["errorfields"]['password'] = "Password";
			$response["errorfields"]['passwordagain'] = "Password Confirmation";
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Password Doesnt Match</h4>The password and password confirmation fields does not match. Please check out password fields and try again.</div>';
		}else{

			if ($this->frontend_model->check_state($this->input->post("state"))) {
				$additional_data = array(
					'first_name' => $this->input->post("first_name"),
					'last_name' => $this->input->post("last_name"),
					'phone' => $this->input->post("phone"),
					'avatar_string' => 'images/avatar/'.uniqid('usr_',true).'.jpg',
					'city'=>$this->input->post("city"),
					'state'=>$this->input->post("state"),
				);
                $email_verification_token = md5(uniqid());
				

				if ($hesapid = $this->ion_auth->register($this->input->post("email"), $this->input->post("password"), $this->input->post("email"), array('user_type' => $this->input->post("customer_type"),'approval' => 'Completed', 'approval_date' => time(), 'email_verification_token' => $email_verification_token))) {

					$details = array(
					'first_name' => $this->input->post("first_name"),
					'last_name' => $this->input->post("last_name"),
					'phone' => $this->input->post("phone"),
					'email' => $this->input->post("email"),
					'source' => 'Web Seller Account',
					);
					if ($ztoken = $this->zoho_access_token()) {
						$this->zoho_add_lead($ztoken,$details);
					}


					if($this->input->post("customer_type")== 'Buyer')
					{
						$additional_data['buyer_id'] = $hesapid;

						$this->frontend_model->add_buyer($additional_data);

					}else{
						$additional_data['seller_id'] = $hesapid;

						$this->frontend_model->add_seller($additional_data);

					}			
					// $this->frontend_model->save_attribute($hesapid,  $this->input->post('attributes'));

					$this->create_avatar($additional_data['avatar_string'],$additional_data['first_name'],$additional_data['last_name']);
					$this->ion_auth->verify_email($email_verification_token);
					$response["success"] = true;

					// $this->ion_auth->dologin($this->input->post("email"));

					$response["redirect_to"] = base_url('signup-successfully');

					$admin_email_text = '<h3 style="color:#4c525e;">NEW PROPERTY OWNER ACCOUNT</h3><p style="color:#848994;">'.$additional_data['first_name'].' '.$additional_data['last_name'].' created new property owner account on Cortiam.</p><p style="text-align:center;"><a href="'.base_url('login').'" style="border-radius:5px;padding:10px 30px;background:#00c48d;color:#ffffff;text-align:center;text-transform:uppercase;font-weight:bold;margin:10px 0px;display:inline-block;text-decoration:none;" target="_blank" class="loginlink">Login to Cortiam</a></p>';
					$admin_emails = $this->frontend_model->get_notified(70);
					//$this->frontend_model->add_notification($admin_emails, 'New Property Owner Account Created', $additional_data['first_name'].' '.$additional_data['last_name'].' created new property owner account on Cortiam.', 'seller_edit', $hesapid);
					//$this->mailer->regular_email('New Property Owner Account Created', $admin_email_text, 'accounts@cortiam.com');
				}else{
					$response["fail"] = true;
					$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Error!</h4>'.(($this->ion_auth->errors())? $this->ion_auth->errors():'There is an unexpected error occured, please refresh the page and try again.').'</div>';
				}
			}else{
				$response["askfor"] = true;
				$response["askfor_title"] = 'Be The First To Be Notified!';
				$response["askfor_message"] = 'We are sorry, Cortiam is currently not available in your location. If you would like us to contact you when we are available in your area, please click the below "<b>Accept</b>" button to share your information with us.';
				$response["cancelty_title"] = 'Thank You For Interest in Cortiam!';
				$response["cancelty_message"] = 'As your requests, your details not shared with us. Please check back with us soon if we are available in your area.';
			}
		}

		} catch (\Throwable $th) {
			echo '<pre>';
			print_r($th);
			exit;

		}
		$this->session->unset_userdata('Seller');
		echo json_encode($response);die();
	}


	/**
	 * Add new agent account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function signup_agent(){

    	if (!$this->input->post("first_name")) {$response["errorfields"]['first_name'] = "First Name";}
		if (!$this->input->post("last_name")) {$response["errorfields"]['last_name'] = "Last Name";}
		if (!$this->input->post("email")) {$response["errorfields"]['email'] = "Email Address";}
		if (!$this->input->post("phone")) {$response["errorfields"]['phone'] = "Phone Number";}
		if (!$this->input->post("state")) {$response["errorfields"]['statecontainer'] = "State";}
		if (!$this->input->post("city")) {$response["errorfields"]['citycontainer'] = "City";}
		if (!$this->input->post("password")) {$response["errorfields"]['password'] = "Password";}
		if (!$this->input->post("passwordagain")) {$response["errorfields"]['passwordagain'] = "Password Confirmation";}

		if (isset($response["errorfields"]) && is_array($response["errorfields"]) && count($response["errorfields"])) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Required/Missing Fields</h4>'.implode(', ',$response["errorfields"]). ' field(s) are required. Please fill out all the required/missing fields and try again.</div>';
		}elseif (!preg_match($this->config->item('email_pattern'), $this->input->post("email"))) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Invalid Email Address</h4>Your email address format is invalid, please use a valid email address and try again.</div>';
		} elseif (!preg_match($this->config->item('phone_pattern'), $this->input->post("phone"))) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Invalid Phone Number</h4>Your phone number format is invalid, please use a valid phone number and try again.</div>';
		}
        elseif ($this->input->post("password") != $this->input->post("passwordagain")) {
			$response["errorfields"]['password'] = "Password";
			$response["errorfields"]['passwordagain'] = "Password Confirmation";
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Password Doesnt Match</h4>The password and password confirmation fields does not match. Please check out password fields and try again.</div>';
		}else{

			$this->db->select('free_days');
			$this->db->where('state',$this->input->post("state"));
			$this->db->where('free_period','Yes');
			$this->db->from('state_costs');
			$state_free_time  = $this->db->get()->row_array();
			$state_free_time = $state_free_time['free_days'];
			$now = null;
			$then = null;

			if($state_free_time != NULL)
			{
				$now = strtotime("now");
				$then = strtotime("+". $state_free_time. "days");
			}

			if ($this->frontend_model->check_state($this->input->post("state")))
			{
				$additional_data = array(
					'first_name' => $this->input->post("first_name"),
					'last_name' => $this->input->post("last_name"),
					'phone' => $this->input->post("phone"),
					'city'=>$this->input->post("city"),
					'state'=>$this->input->post("state"),
					'free_starts' => $now,
					'free_ends' => $then
				);
                $email_verification_token = md5(uniqid());

				if ($hesapid = $this->ion_auth->register($this->input->post("email"), $this->input->post("password"), $this->input->post("email"), array('user_type' => 'Agent', 'approval_date' => time(), 'previously_approved' => 'No', 'email_verification_token' => $email_verification_token)))
				{
					$details = array(
					'first_name' => $this->input->post("first_name"),
					'last_name' => $this->input->post("last_name"),
					'phone' => $this->input->post("phone"),
					'email' => $this->input->post("email"),
					'source' => 'Web Agent Account',
					);
					if ($ztoken = $this->zoho_access_token())
					{
						$this->zoho_add_lead($ztoken,$details);
					}			
					
					$additional_data['agent_id'] = $hesapid;
					// $this->frontend_model->save_attribute($hesapid,  $this->input->post('attributes'));

					$this->frontend_model->add_agent($additional_data);
					$this->ion_auth->verify_email($email_verification_token);
					$response["success"] = true;
					$response["redirect_to"] = base_url('signup-successfully');			

				}else{
					$response["fail"] = true;
					$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Error!</h4>'.(($this->ion_auth->errors())? $this->ion_auth->errors():'There is an unexpected error occured, please refresh the page and try again.').'</div>';
				}
			}else{
				$response["askfor"] = true;
				$response["askfor_title"] = 'Be The First To Be Notified!';
				$response["askfor_message"] = 'We are sorry, Cortiam is currently not available in your location. If you would like us to contact you when we are available in your area, please click to "<b>Accept</b>" button to share your information with us.';
				$response["cancelty_title"] = 'Thank You For Interest in Cortiam!';
				$response["cancelty_message"] = 'As your requests, your details not shared with us. Please check back with us soon if we are available in your area.';
			}
		}

		echo json_encode($response);die();
	}


	public function signup_email()
	{
		$findEmail    = $this->frontend_model->find_email($_REQUEST);
		if($findEmail == "true")
		{
			$response["success"]  = "success";
			$response["messsage"] = 'Email already in use please enter another one';
			echo json_encode($response);die();
		}


	}

	/**
	 * Add new agent account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function notify_seller(){
		$details = array(
		'first_name' => $this->input->post("first_name"),
		'last_name' => $this->input->post("last_name"),
		'phone' => $this->input->post("phone"),
		'email' => $this->input->post("email"),
		'state' => $this->input->post("state"),
		'city' => $this->input->post("city"),
		'user_type' => 'Property Owner',
		'signup_time' => time(),
		);
		if ($hesapid = $this->frontend_model->waiting_user($details)) {
			$admin_email_text = '<h3 style="color:#4c525e;">NEW PROPERTY OWNER ADDED TO WAITING LIST</h3><p style="color:#848994;">'.$details['first_name'].' '.$details['last_name'].' requested notification when Cortiam will be available in '.$details['state'].' - '.$details['city'].'.</p><p style="text-align:center;"><a href="'.base_url('login').'" style="border-radius:5px;padding:10px 30px;background:#00c48d;color:#ffffff;text-align:center;text-transform:uppercase;font-weight:bold;margin:10px 0px;display:inline-block;text-decoration:none;" target="_blank" class="loginlink">Login to Cortiam</a></p>';
			$admin_emails = $this->frontend_model->get_notified(10);
			$this->frontend_model->add_notification($admin_emails, 'New Property Owner Added To Waiting List', $details['first_name'].' '.$details['last_name'].' added to waiting list.', 'seller_edit', $hesapid);
			$this->mailer->regular_email('New Property Owner Added To Waiting List', $admin_email_text, $admin_emails);
			$response["success"] = true;
			$response["redirect_to"] = base_url('notification-successfully');
		}else{
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Error!</h4>'.(($this->ion_auth->errors())? $this->ion_auth->errors():'There is an unexpected error occured, please refresh the page and try again.').'</div>';
		}
		echo json_encode($response);die();
	}

	/**
	 * Add new agent account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function notify_agent(){
		$details = array(
		'first_name' => $this->input->post("first_name"),
		'last_name' => $this->input->post("last_name"),
		'phone' => $this->input->post("phone"),
		'email' => $this->input->post("email"),
		'state' => $this->input->post("state"),
		'city' => $this->input->post("city"),
		'user_type' => 'Real Estate Agent',
		'signup_time' => time(),
		);
		if ($hesapid = $this->frontend_model->waiting_user($details)) {
			
			try {
				$admin_email_text = '<h3 style="color:#4c525e;">NEW AGENT ADDED TO WAITING LIST</h3><p style="color:#848994;">'.$details['first_name'].' '.$details['last_name'].' requested notification when Cortiam will be available in '.$details['state'].' - '.$details['city'].'.</p><p style="text-align:center;"><a href="'.base_url('login').'" style="border-radius:5px;padding:10px 30px;background:#00c48d;color:#ffffff;text-align:center;text-transform:uppercase;font-weight:bold;margin:10px 0px;display:inline-block;text-decoration:none;" target="_blank" class="loginlink">Login to Cortiam</a></p>';
				$admin_emails = $this->frontend_model->get_notified(10);
				$this->frontend_model->add_notification($admin_emails, 'New Agent Added To Waiting List', $details['first_name'].' '.$details['last_name'].' added to waiting list.', 'seller_edit', $hesapid);
				$this->mailer->regular_email('New Agent Added To Waiting List', $admin_email_text, $admin_emails);
			} catch (\Throwable $th) {
				$admin_emails = "michelle@thewebbenterprises.com";
			}	
			$response["success"] = true;
			$response["redirect_to"] = base_url('notification-successfully');
		}else{
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Error!</h4>'.(($this->ion_auth->errors())? $this->ion_auth->errors():'There is an unexpected error occured, please refresh the page and try again.').'</div>';
		}
		echo json_encode($response);die();
	}


	/**
	 * Add new agent account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function locate_agent()
	{
		if ((!$this->input->post("zipcode")) && (!$this->input->post("city")) && (!$this->input->post("state")))
		{
			$response["fail"] = true;
			$response["fail_title"] = 'Missing Search Parameter!';
			$response["fail_message"] = 'Please enter at least one of the Zip Code, City or State fields to define your search.';
		}else{
			$response["success"] = true;

			$city  = $this->input->post("city");
			$state = $this->input->post("state");
			$zip   = $this->input->post("zipcode");




			if(isset($zip) && !empty($zip))
			{	
				$zip   =  $this->frontend_model->find_zip($zip);

			   if(isset($zip) && count($zip) > 0)
				{
					$latlong   = geolocate_address($city, $state, $zip,null,null);
					$latitude  = $latlong['latitude'];
					$longitude = $latlong['longitude'];
				}else{
					echo json_encode($response);die();
				}
			
			
			}
	
		
		 	$agents = $this->frontend_model->locate_agent($latitude, $longitude, $state, $city);
			if ($agents)
			{
				foreach ($agents as $agent)
				{

			  		$purl = base_url('agent-profile/').$agent['agent_id'].'-'.url_title( trim( preg_replace( "/[^0-9a-z]+/i", " ",  $agent['agent'])), 'underscore', true);
					$response['html'] .= '<a target="_blank" href="'.$purl.'" class="col-md-4 col-xl-3"><div class="card form-shadow agentcard"><div class="agentbox"><div class="agentimage"><img class="card-img-top bg-image shadow-sm" src="'.(($agent['agent_image'])? base_url($agent['agent_image']):base_url('images/userphoto.jpg')).'" alt="Listing Image" style="background-image:url('.base_url('images/border.png') .'); background-size: 100%;padding:11px;object-fit: contain; "><div class="agenttext"><div class="placer"><h3 class="text-center text-capitalize">'.$agent['agent'].'</h3><p class="text-center text-capitalize">'.$agent['brokerage_name'].'</p></div></div></div></div></div></a>';
				}
			}else{
				$response['html'] = '<div class="col-md-7"><div class="agentsnoresult">Sorry, we are unable to find an agent that matches with your search criterias</div></div>';
			}
		}
		echo json_encode($response);die();
	}

	public function locate_buyer_agent()
	{
		if ((!$this->input->post("zipcode")) && (!$this->input->post("city")) && (!$this->input->post("state")))
		{
			$response["fail"] = true;
			$response["fail_title"] = 'Missing Search Parameter!';
			$response["fail_message"] = 'Please enter at least one of the Zip Code, City or State fields to define your search.';
		}else{
			$response["success"] = true;

			$city  = $this->input->post("city");
			$state = $this->input->post("state");
			$zip   = $this->input->post("zipcode");




			if(isset($zip) && !empty($zip))
			{
				$zip   =  $this->frontend_model->find_zip($zip);

				if(isset($zip) && count($zip) > 0)
				{
					$latlong   = geolocate_address($city, $state, $zip,null,null);
					$latitude  = $latlong['latitude'];
					$longitude = $latlong['longitude'];
				}else{
					echo json_encode($response);die();
				}


			}


			$agents = $this->frontend_model->locate_buyer_agent($latitude, $longitude, $state, $city);

			if ($agents)
			{
				foreach ($agents as $agent)
				{
					$user = "buyer" ;
					$login_account_id = $this->ion_auth->get_user_id();
					$bg = check_save_premium_listing_2($agent['agent_id'], $state, $city);
					$result = agentAttributesPrecentage($agent['agent_id'], $login_account_id, $user);

					$purl = base_url('agent-profile/').$agent['agent_id'].'-'.url_title( trim( preg_replace( "/[^0-9a-z]+/i", " ",  $agent['agent'])), 'underscore', true);
					if(isset($login_account_id) && $login_account_id > 0)
					{

					$response['html'] .= '
								<div class="col-md-4 col-xl-3" id="favagent-' . $agent['agent_id'] . '">
                                            <a href="' . $purl . '">
                                            <div class="card form-shadow agentcard proplisting" style="min-height: 300px">
                                            ' . (($bg == 'bg-success') ? '<div class="ribbon ribbon-top-right ribbonyellow"><span>Premium</span></div>' : '') . '
                                                <div >
                                                    <div class="agentbox">
                                                            <div class="agentimage mb-0">
                                                                <img class="card-img-top bg-image shadow-sm mx-auto" src="' . (($agent['agent_image']) ? base_url($agent['agent_image']) : base_url('images/userphoto.jpg')) . '" alt="Listing Image" style="background-image:url(' . base_url('images/border.png') . '); background-size: 100%;padding:11px;object-fit: contain; ">
                                                                <div class="agenttext p-2" style="min-height: 120px !important;">
                                                                    <div class="placer">
                                                                        <h3 class="text-center text-capitalize">' . $agent['agent'] . '</h3>
                                                                        <p class="text-center text-capitalize mb-0">' . $agent['brokerage_name'] . '</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    
                                                       <span class="text-center text-dark">Attributes Match</span>
                                                     <div class="progress" style="height: 14px !important;">
                                                       <div class="progress-bar bg-success" role="progressbar" style="width: ' . $result . '%;" aria-valuenow="' . $result . '" aria-valuemin="0" aria-valuemax="100">' . $result . '%</div>
                                                    </div>
                                                </div>
                                                </div>                                                
                                            </a>
                                           
                                      </div>';
					}else{
						$response['html'] .= '
								<div class="col-md-4 col-xl-3" id="favagent-' . $agent['agent_id'] . '">
                                            <a href="' . $purl . '">
                                            <div class="card form-shadow agentcard proplisting" style="max-height: 250px">
                                            ' . (($bg == 'bg-success') ? '<div class="ribbon ribbon-top-right ribbonyellow"><span>Premium</span></div>' : '') . '
                                                <div >
                                                    <div class="agentbox">
                                                            <div class="agentimage mb-0">
                                                                <img class="card-img-top bg-image shadow-sm mx-auto" src="' . (($agent['agent_image']) ? base_url($agent['agent_image']) : base_url('images/userphoto.jpg')) . '" alt="Listing Image" style="background-image:url(' . base_url('images/border.png') . '); background-size: 100%;padding:11px;object-fit: contain; ">
                                                                <div class="agenttext p-2" style="min-height: 120px !important;">
                                                                    <div class="placer">
                                                                        <h3 class="text-center text-capitalize">' . $agent['agent'] . '</h3>
                                                                        <p class="text-center text-capitalize mb-0">' . $agent['brokerage_name'] . '</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    
                                                     
                                                </div>
                                                </div>                                                
                                            </a>
                                           
                                      </div>';

					}

				}
			}else{
				$response['html'] = '<div class="col-md-7"><div class="agentsnoresult">Sorry, we are unable to find an agent that matches with your search criterias</div></div>';
			}
		}
		echo json_encode($response);die();
	}


	/**
	 * Add new agent account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function join_our_team(){
		if (!$this->input->post("first_name")) {$response["errorfields"]['first_name'] = "First Name";}
		if (!$this->input->post("last_name")) {$response["errorfields"]['last_name'] = "Last Name";}
		if (!$this->input->post("email")) {$response["errorfields"]['email'] = "Email Address";}
		if (!$this->input->post("phone")) {$response["errorfields"]['phone'] = "Phone Number";}


		if (count($response["errorfields"])) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Required/Missing Fields</h4>'.implode(', ',$response["errorfields"]). ' field(s) are required. Please fill out all the required/missing fields and try again.</div>';
		}else{
			$data = array(
				'first_name' => $this->security->xss_clean($this->input->post("first_name")),
				'last_name' => $this->security->xss_clean($this->input->post("last_name")),
				'email' => $this->security->xss_clean($this->input->post("email")),
				'phone' => $this->security->xss_clean($this->input->post("phone")),
				'added_on' => time(),
			);
			if ($join_id = $this->frontend_model->join_our_team($data)) {
				$response["success"] = true;
				$response["redirect_to"] = base_url('joinus-successfully');

				$user_email_text = '<h4 style="color:#4c525e;">Thank you for your interest in joining our team!</h4><p>Your information has been submitted successfully. We will contact you as future opportunities become available.</p>';
				$this->mailer->regular_email('Thank you for Your Interest in Joining Our Team', $user_email_text, $this->input->post("email"));
				$admin_email_text = '<h4 style="color:#4c525e;">JOIN OUR TEAM</h4><p>There is a new application sent from the Join Our Team form on the Cortiam website. Details displayed below;</p>
				<p style="color:#848994;">
				<b>First Name: </b>'.$data['first_name'].'<br>
				<b>Last Name: </b>'.$data['last_name'].'<br>
				<b>Email Adress: </b>'.$data['email'].'<br>
				<b>Phone Number: </b>'.preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $data['phone']).'</p>';
//				$admin_emails = $this->frontend_model->get_notified(160);
//				if ($admin_emails) {$this->mailer->regular_email('We Are Hiring Application', $admin_email_text, $admin_emails);}
				$this->mailer->regular_email('We Are Hiring Application', $admin_email_text, "careers@cortiam.com");
			}else{
				$response["fail"] = true;
				$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Error!</h4>'.(($this->ion_auth->errors())? $this->ion_auth->errors():'There is an unexpected error occured, please refresh the page and try again.').'</div>';
			}
		}
		echo json_encode($response);die();
	}


	/**
	 * Add new agent account
	 * @uses system_model::add_seller To add details of seller account
	 *
	 * @return json true or false
	 */
	public function contact_us(){
		if (!$this->input->post("first_name")) {$response["errorfields"]['first_name'] = "First Name";}
		if (!$this->input->post("last_name")) {$response["errorfields"]['last_name'] = "Last Name";}
		if (!$this->input->post("email")) {$response["errorfields"]['email'] = "Email Address";}
		if (!$this->input->post("phone")) {$response["errorfields"]['phone'] = "Phone Number";}
		if (!$this->input->post("comments")) {$response["errorfields"]['comments'] = "Comments";}

		$admin_emails = $this->frontend_model->get_notified(150);
		$response['emails'] = $admin_emails;
		if (count($response["errorfields"])) {
			$response["fail"] = true;
			$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Required/Missing Fields</h4>'.implode(', ',$response["errorfields"]). ' field(s) are required. Please fill out all the required/missing fields and try again.</div>';
		}else{
			$data = array(
				'first_name' => $this->security->xss_clean($this->input->post("first_name")),
				'last_name' => $this->security->xss_clean($this->input->post("last_name")),
				'email' => $this->security->xss_clean($this->input->post("email")),
				'phone' => $this->security->xss_clean($this->input->post("phone")),
				'comments' => $this->security->xss_clean($this->input->post("comments")),
				'added_on' => time(),
			);
			if ($join_id = $this->frontend_model->contact_request($data)) {
				$response["success"] = true;
				$response["html"] = '<h3>THANK YOU</h3><p>Your message was sent successfully! Thank you for contacting us and for visiting Cortiam.com. A member of the team will be in touch with you shortly to discuss your request.</p>';

				$user_email_text = '<h4 style="color:#4c525e;">THANK YOU</h4><h5 style="color:#848994;">Your message send successfully!</h5><p>Thank you for contacting us and for visiting Cortiam.com. A member of the team will be in touch with you shortly to discuss your request.</p>';
				$this->mailer->regular_email('Thanks for Contacting Cortiam', $user_email_text, $this->input->post("email"));
				$admin_email_text = '<h4 style="color:#4c525e;">CONTACT REQUEST</h4><p>There is a new contact request made from the Cortiam website. Details displayed below;</p>
				<p style="color:#848994;">
				<b>First Name: </b>'.$data['first_name'].'<br>
				<b>Last Name: </b>'.$data['last_name'].'<br>
				<b>Email Adress: </b>'.$data['email'].'<br>
				<b>Phone Number: </b>'.preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $data['phone']).'<br>
				<b>Comments: </b>'.$data['comments'].'</p>';
//				$admin_emails = $this->frontend_model->get_notified(160);
//				if ($admin_emails) {$this->mailer->regular_email('Contact Request', $admin_email_text, $admin_emails);}
				$this->mailer->regular_email('Contact Request', $admin_email_text, "customerservice@cortiam.com");
			}else{
				$response["fail"] = true;
				$response["fail_message"] = '<div class="cortiam-alert" role="alert"><h4>Error!</h4>'.(($this->ion_auth->errors())? $this->ion_auth->errors():'There is an unexpected error occured, please refresh the page and try again.').'</div>';
			}
		}
		echo json_encode($response);die();
	}

	/**
	 * Deletes selected client
	 * @uses system_model::update_account Updates selected client details
	 *
	 * @return json Details of actions response success/fail, error, message, redirection, etc..
	 */
	public function create_avatar($avatar_string, $first_name, $last_name){
		$source_image = FCPATH.'images/avatar_base.jpg';
	  $folderPath = FCPATH.'images/avatar/';
	  $imagename = substr(basename($avatar_string),0,-4);

		$image = imagecreatefromjpeg($source_image);
		$white_color = imagecolorallocate($image, 255, 255, 255);

		$font_path = FCPATH.'assets/fonts/robotomono-bold.ttf';
		$size=80;
		$angle=0;
		$left=60;
		$top=165;

		@imagettftext($image, $size,$angle,$left,$top, $white_color, $font_path, $first_name[0].$last_name[0]);
		imagejpeg($image, $folderPath . $imagename . ".jpg", 80);
		$thubnail = imagecreatetruecolor(100, 100);
		imagecopyresampled($thubnail, $image, 0, 0, 0, 0, 100, 100, 250, 250);
		imagedestroy($image);
		imagejpeg($thubnail, $folderPath . $imagename . "_mini.jpg", 80);
		imagedestroy($thubnail);
	}

	/**
	 * Deletes selected client
	 * @uses system_model::update_account Updates selected client details
	 *
	 * @return json Details of actions response success/fail, error, message, redirection, etc..
	 */
	public function zoho_access_token(){
		if ($dbtoken = $this->frontend_model->get_token(time())) {
		  return $dbtoken['token'];
		}else{
		  $curl_pointer = curl_init();

		  $curl_options = array();
		  $refresh_token = "1000.29eab2ad64692d22691199b10077e6b8.502095d3d263c8774e00763ed75c6845";
		  $client_id = "1000.POKL5UPMAVIPGZCRL0D4EM9KJL2Q2O";
		  $client_secret = "a68bb60349c1e1c8a877a5d07c4628993cd73cf0e0";
		  $grant_type = "refresh_token";
		  $url = "https://accounts.zoho.com/oauth/v2/token?refresh_token=$refresh_token&client_id=$client_id&client_secret=$client_secret&grant_type=$grant_type";

		  $curl_options[CURLOPT_URL] =$url;
		  $curl_options[CURLOPT_RETURNTRANSFER] = true;
		  $curl_options[CURLOPT_HEADER] = false;
		  $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";

		  curl_setopt_array($curl_pointer, $curl_options);

		  $result = json_decode(curl_exec($curl_pointer), true);
		  curl_close($curl_pointer);
		  if ($result['access_token']) {
		  	$tokendata['token'] = $result['access_token'];
		  	$tokendata['token_time'] = time()+3400;
		  	$this->frontend_model->add_token($tokendata);
		  	return $result['access_token'];
		  }else{
		  	return false;
		  }
		}
	}

	/**
	 * Deletes selected client
	 * @uses system_model::update_account Updates selected client details
	 *
	 * @return json Details of actions response success/fail, error, message, redirection, etc..
	 */
	public function zoho_add_lead($token, $account_details){
	  $curl_pointer = curl_init();

	  $curl_options = array();
	  $url = "https://www.zohoapis.com/crm/v2/Leads";

	  $curl_options[CURLOPT_URL] =$url;
	  $curl_options[CURLOPT_RETURNTRANSFER] = true;
	  $curl_options[CURLOPT_HEADER] = false;
	  $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
	  $requestBody = array();
	  $recordArray = array();
	  $recordObject = array();
	  $recordObject["First_Name"] = $account_details["first_name"];
	  $recordObject["Last_Name"] = $account_details["last_name"];
	  $recordObject["Phone"] = $account_details["phone"];
	  $recordObject["Email"] = $account_details["email"];
	  $recordObject["Lead_Source"] = $account_details["source"];

	  $recordArray[] = $recordObject;
	  $requestBody["data"] =$recordArray;
	  $curl_options[CURLOPT_POSTFIELDS]= json_encode($requestBody);
	  $headersArray = array();

	  $headersArray[] = "Authorization". ":" . "Zoho-oauthtoken " . $token;

	  $curl_options[CURLOPT_HTTPHEADER]=$headersArray;

	  curl_setopt_array($curl_pointer, $curl_options);

	  $result = curl_exec($curl_pointer);
	  curl_close($curl_pointer);
	}


	public function savepremiumlisting(){


		$sessionChecked = $this->session->get_userdata('Agent');

		if($_REQUEST['type'] == 'customize')
		{
			echo $customize  = $this->agent_model->saveCustomPremiumListing($_REQUEST, $sessionChecked['user_id']);
			exit;

		}else{

			echo $bundle  = $this->agent_model->saveBundlePremiumListing($_REQUEST, $sessionChecked['user_id']);
			exit;

		}

	}

	public function premiumlisting()
	{
		$sessionChecked = $this->session->get_userdata('Agent');
		$premiumlisting  = $this->agent_model->premiumlisting($sessionChecked['user_id']);
		echo json_encode(["data" =>  $premiumlisting]);
	}


	public function deletePremiumRecord()
	{

		$agent_id = $_REQUEST['agent_id'];
		$state_id = $_REQUEST['state_id'];
		$date_range = $_REQUEST['date_range'];

		$premiumlisting  = $this->agent_model->deletePremiumRecord($agent_id, $state_id, $date_range);

		if($premiumlisting)
		{
			echo json_encode(['success' => true, 'message' => "Record deleted successfully!"]);
		}

	}


	public function payment()
	{
		$sessionChecked = $this->session->get_userdata('Agent');
		require_once(APPPATH.'/third_party/stripe/init.php');
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

	    $actualPrice  = $_REQUEST['plan_price'];
		$amount       = $_REQUEST['totalDsicount'];
		$plan_title   = $_REQUEST['plan_title'];
		$coupon       = $_REQUEST['coupon'];
		$payment_id   = $_REQUEST['payment_id'];
		$userInfo 	  = $this->frontend_model->get_user_info($sessionChecked['user_id']);
	    $process_time = time();

		$updateCouponStatus  = $this->agent_model->updateCouponStatus($_REQUEST);

		
		$this->db->set('plan_id', NULL);
		$this->db->where('agent_id ', $sessionChecked['user_id']);
		$this->db->where('offer_limit ', 0);
		$this->db->where('win_limit ', 0);
		$this->db->where('win_remain ', 0);
		$this->db->where('offer_remain ', 0);
		$this->db->update('agents');


		// item details for which payment made
		$itemName     = $plan_title;
		$totalAmount  = floatval($amount);
		$couponPrice  = $this->agent_model->couponAmount($_REQUEST);


		$this->agent_model->addAgentStripId($sessionChecked, $userInfo['stripe_id']);
	
		$couponAmount = 0;

		if(isset($couponPrice) && isset($couponPrice['coupon_amount']) && !empty($couponPrice))
		{
			$couponAmount = $couponPrice["coupon_amount"];
		}	

		$cents      = $totalAmount - $couponAmount;

		if($_REQUEST['upgratePlan'] == 1)
		{
			$record = $this->frontend_model->updateSubscriptionPlan($sessionChecked['user_id']);

			try {

			
				$stripe = new \Stripe\StripeClient(
					$this->config->item('stripe_secret')
				  );

				  log_message('error', $record['charge_id']);
				  $stripe->refunds->create([
					'charge' => $record['charge_id'],
				  ]);
				if(isset($record["payment_id"]) && !empty($record["payment_id"]))
				{	
					$stripe->paymentMethods->detach($record["payment_id"]);
				}  

				// $stripe = new \Stripe\StripeClient($this->config->item('stripe_secret'));			
				// $stripe->paymentMethods->detach($record["payment_id"]);
				
				// Set your secret key. Remember to switch to your live secret key in production.
				// See your keys here: https://dashboard.stripe.com/apikeys
				// $stripe = new \Stripe\StripeClient('sk_test_51KZlwVK9NrQ9sEyeiAiAM8rZUXyjkV9ywRG1Iz8mHD6f321wv67bsERBZRcQKplsf4ZcODNRX6tEzNehX3bvIQtM00D4Iro3gF');

				// $stripe->refunds->create(['payment_intent' => 'pi_Aabcxyz01aDfoo', 'amount' => 1000]);

			} catch (\Throwable $th) {
				
				log_message("error", $th->getMessage() );
			}


		}
			$meta_order_id = time();
			if($_REQUEST['selectedCard'] == '')
			{
				if($_REQUEST['plan_price'] > $_REQUEST['totalDsicount']) {
					$payDetails = \Stripe\PaymentIntent::create([
						'amount'   	        => $cents * 100,
						'currency' 	  		=> 'usd',
						'customer'          => $userInfo['stripe_id'],
						"description"       => $itemName,
						'off_session'       => true,
						'confirm'           => true,
						"metadata[order_id]"=>$meta_order_id
					]);
					$paymenyResponse = $payDetails->jsonSerialize();

				}
			}else{

					$params = [
						'amount'   	  		=> $cents * 100,
						'currency' 	  		=> 'usd',
						'customer'    		=> $userInfo['stripe_id'],
						"description" 		=> $itemName,
						"metadata[order_id]"=>$meta_order_id

					];
			
				
				$payDetails = \Stripe\Charge::create($params);
				$paymenyResponse = $payDetails->jsonSerialize();

			}

		if($_REQUEST['plan_price'] > $_REQUEST['totalDsicount']) {
			$charge_id       = $paymenyResponse['id'];
		}

		$plan_title 	 = $_REQUEST['plan_title'];
		$list_features   = $_REQUEST['list_features'];
		$totalDsicount   = $_REQUEST['plan_price'] - $totalAmount + $couponAmount;
		$payment_id 	 = $payment_id;
		$amount     	 = $paymenyResponse['amount'];
		$plan_id         = $_REQUEST['plan_id'];
		$coupon          = $_REQUEST['coupon'];

		if(isset($paymenyResponse['source']) && !empty($paymenyResponse['source']))
		{
			if(is_array($paymenyResponse['source']))
			{	
				$source = $paymenyResponse['source']['id'];

			}else{
				$source = $paymenyResponse['source'];

			}

		}

		
		if(isset($coupon) && !empty($coupon))
		{
			$invoice_data['coupon_id'] = $couponPrice["coupon_id"];
			$invoice_data['discount_amount'] = $couponAmount;
			$coupon_data = array(
				'coupon_used' => 'Yes',
				'used_on' => $process_time,
			);
			$this->agent_model->edit_coupon($coupon_id, $coupon_data);
		}

				$agent_details = $this->agent_model->get_agent($sessionChecked['user_id']);
				$update_date_to = (($agent_details['membership_due'])? strtotime("+1 month", $agent_details['membership_due']):strtotime("+1 month", $process_time));
				$used_expressions = $this->agent_model->get_offers_used($sessionChecked['user_id']);

				$additional_data = array(
					'win_remain' => $agent_details['win_limit'],
					'offer_remain' => ($agent_details['offer_limit'] - $used_expressions),
					'membership_due' => $update_date_to,
				);

				$this->agent_model->edit_agent($sessionChecked['user_id'], $additional_data);

				$membership_fee 		 	 = $this->agent_model->get_settings('membership_fee');				
				// $new_invoice['real_amount']  = (($agent_details['membership_fee'])? $agent_details['membership_fee']:$membership_fee['setting_value']);
				// $inserted_id_invoice		 = $this->agent_model->add_invoice($new_invoice);

				if(!isset($_REQUEST['selectedCard']) || $_REQUEST['selectedCard'] == '')
				{

						if($_REQUEST['plan_price'] > $_REQUEST['totalDsicount']) {
						$payment_method_details = \Stripe\PaymentMethod::retrieve($this->input->post("payment_id"));

						$card_data = array(
							'agent_id' => $this->ion_auth->get_user_id(),
							'customer_id' => $payment_method_details['customer'],
							'card'       => $source,
							'payment_id' => $payment_id,
							'brand' => card_names($payment_method_details['card']['brand']),
							'last_digit' => $payment_method_details['card']['last4'],
							'expire_date' => mktime(1,1,1,$payment_method_details['card']['exp_month'],1,$payment_method_details['card']['exp_year']),
							'added_on' => time()
						);
						
						$this->agent_model->add_credit_card($card_data);
					}
				}
				

				if (strpos($_REQUEST['selectedCard'], 'seti') !== false)
				{

					$this->agent_model->update_credit_card($_REQUEST['selectedCard'], $source);
				}

				$payment_data = array(
					'invoice_id'   => $inserted_id_invoice,
					'log_time'     => $process_time,
					'log_status'   => 'Success',
					'log_response' => serialize($paymenyResponse),
				);

				$this->agent_model->add_payment($payment_data);

				$invoice_data = array(
					'agent_id'       => $sessionChecked['user_id'],
					'try_time'       => ($update_date_to - 86400),
					'payment_desc'   => 'Cortiam Agent Monthly Subscription Price',
					'payment_time'   => $process_time,
					'real_amount'    => $actualPrice,
					'discount_amount'=> $totalDsicount,
					'final_amount' 	 => $cents,
					'pay_id' 		 => $payDetails->id,
					'invoice_status' => 'Completed',
				);

				$this->agent_model->add_invoice($invoice_data);
				$success    	 = $this->frontend_model->save_payment_info($meta_order_id, $charge_id, $plan_title, $payment_id, $amount, $list_features, $totalDsicount, $sessionChecked['user_id'], $plan_id, $_REQUEST['featuresarray'], $coupon, $couponAmount);
				echo "true";
				exit;

	}


	public function resend_email()
	{
		$email = $this->session->userdata('email');

		$email_verification_token = md5(uniqid());
		$success = $this->frontend_model->set_token_token($email,  $email_verification_token);

		if($success)
		{
			$user_email_text = '<a href="'.base_url('verify/email').'/' . $email_verification_token. '" style="border-radius:5px;padding:10px 30px;background:#00c48d;color:#ffffff;text-align:center;font-weight:bold;text-transform:uppercase;margin:10px 0px;display:inline-block;text-decoration:none;" target="_blank" class="loginlink">Verify Email</a></p>';
			$this->mailer->regular_email('Resend Your Email Cortiam!', $user_email_text, $email);
		
		}

		echo "true";
		exit;
	}


	public function survey_answer()
    {
		$this->db->delete('survey', array('account_id' =>  $this->ion_auth->get_user_id()));

        $data = array(

            'account_id' => $this->ion_auth->get_user_id(),
            'status'     => 1 ,
        );

        $this->db->insert('survey', $data);
        echo "true";

    }


	public function premiumn_payment()
	{
		$sessionChecked = $this->session->get_userdata('Agent');
		require_once(APPPATH.'/third_party/stripe/init.php');
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

		$actualPrice  = $_REQUEST['plan_price'];
		$plan_title   = $_REQUEST['plan_title'];
		$payment_id   = $_REQUEST['payment_id'];
		$order_id     = $_REQUEST['order_id'];
		$userInfo 	  = $this->frontend_model->get_user_info($sessionChecked['user_id']);
		$process_time = time();
		$totalAmount  = floatval($actualPrice);


		$meta_order_id = time();
		if($_REQUEST['selectedCard'] == '')
		{

			$payDetails = \Stripe\PaymentIntent::create([
				'amount'   	        => $totalAmount * 100,
				'currency' 	  		=> 'usd',
				'customer'          => $userInfo['stripe_id'],
				"description"       => 'premimum search query',
				'off_session'       => true,
				'confirm'           => true,
				"metadata[order_id]"=>$meta_order_id
			]);

		}else{

			$params = [
				'amount'   	  		=> $totalAmount * 100,
				'currency' 	  		=> 'usd',
				'customer'    		=> $userInfo['stripe_id'],
				"description" 		=> 'premimum search query',
				"metadata[order_id]"=>$meta_order_id

			];


			$payDetails = \Stripe\Charge::create($params);

		}


		$paymenyResponse = $payDetails->jsonSerialize();

		$charge_id       = $paymenyResponse['id'];
		$plan_title 	 = $_REQUEST['plan_title'];
		$payment_id 	 = $payment_id;
		$amount     	 = $paymenyResponse['amount'];

		if(isset($paymenyResponse['source']) && !empty($paymenyResponse['source']))
		{
			if(is_array($paymenyResponse['source']))
			{
				$source = $paymenyResponse['source']['id'];

			}else{
				$source = $paymenyResponse['source'];

			}

		}
		$agent_details = $this->agent_model->get_agent($sessionChecked['user_id']);

		if($_REQUEST['selectedCard'] == '')
		{


			$payment_method_details = \Stripe\PaymentMethod::retrieve($this->input->post("payment_id"));

			$card_data = array(
				'agent_id' => $this->ion_auth->get_user_id(),
				'customer_id' => $payment_method_details['customer'],
				'card'       => $source,
				'payment_id' => $payment_id,
				'brand' => card_names($payment_method_details['card']['brand']),
				'last_digit' => $payment_method_details['card']['last4'],
				'expire_date' => mktime(1,1,1,$payment_method_details['card']['exp_month'],1,$payment_method_details['card']['exp_year']),
				'added_on' => time()
			);

			$this->agent_model->add_credit_card($card_data);
		}

		if (strpos($_REQUEST['selectedCard'], 'seti') !== false)
		{

			$this->agent_model->update_credit_card($_REQUEST['selectedCard'], $source);
		}


		if(isset($_REQUEST['selectedCoupon']) && !empty($_REQUEST['selectedCoupon']))
		{
			$this->agent_model->update_coupon_Status($_REQUEST['selectedCoupon']);

		}

		$payment_desc = 'Cortiam Agent Premium Search Query Charge';

		if(isset($_REQUEST['prop_id']) && !empty($_REQUEST['prop_id']))
		{

			if(isset($_REQUEST['coupon_code']) && $_REQUEST['coupon_code'] !== '')
			{
				$agentCoupon  = $this->agent_model->agent_coupon_discount($_REQUEST['agent_id'], $_REQUEST['coupon_code']);
			}

			$getAgreementProperty = $this->agent_model->get_agreement_property($_REQUEST['agent_id'], $_REQUEST['seller_id'],$_REQUEST['prop_id']);



			$fee_amount = "";
			if(isset($agentCoupon['coupon_type']) && $agentCoupon['coupon_type'] == 'Percentage')
			{
				$remaining_amount = ($agentCoupon['coupon_amount'] / 100) * $getAgreementProperty['original_fee'];
				$fee_amount       = $getAgreementProperty['original_fee'] - $remaining_amount;

			}else{
				$fee_amount       = $getAgreementProperty['original_fee'] - $agentCoupon['coupon_amount'];
			}


			$getAgreementProperty = $this->agent_model->update_agreement_property($_REQUEST['agr_id'], $fee_amount, $agentCoupon['coupon_type'], $_REQUEST['agent_id'], $_REQUEST['seller_id'],$_REQUEST['prop_id']);

			$payment_desc = 'Cortiam Agent Property Win Charge';
			$this->db->set('win_remain', 'win_remain-1', FALSE);
			$this->db->where('agents.agent_id =', $_REQUEST['agent_id']);
			$this->db->update('agents');
			$getlastestValues     = $this->agent_model->get_agreement_property($_REQUEST['agent_id'], $_REQUEST['seller_id'],$_REQUEST['prop_id']);

		}

		$payment_data = array(
			'invoice_id'   => $inserted_id_invoice,
			'log_time'     => $process_time,
			'log_status'   => 'Success',
			'log_response' => serialize($paymenyResponse),
			'order_id' => $order_id
		);

		$this->agent_model->add_payment($payment_data);


//		$update_date_to = (($agent_details['membership_due'])? strtotime("+1 month", $agent_details['membership_due']):strtotime("+1 month", $process_time));
//		$used_expressions = $this->agent_model->get_offers_used($sessionChecked['user_id']);

		$invoice_data = array(
			'agent_id'       => $sessionChecked['user_id'],
			'try_time'       => $process_time,
			'payment_desc'   => $payment_desc,
			'payment_time'   => $process_time,
			'real_amount'    => $totalAmount,
			'final_amount' 	 => $totalAmount,
			'pay_id' 		 => $payDetails->id,
			'invoice_status' => 'Completed',
			'order_id' => $order_id
		);

		$this->agent_model->add_invoice($invoice_data);


		$data = [
			'status_price' => 'Paid',

		];

		$response = $this->agent_model->savePremiumSearchQuery($data, $sessionChecked['user_id']);

		echo "true";
		exit;
	}
	

}
?>
