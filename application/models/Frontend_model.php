<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Frontend model
 *
 * The system model with a series of CRUD functions (powered by CI's query builder), validation-in-model support, event callbacks and more for frontend pages.
 *
 * @package    Cortiam Web Application
 * @subpackage Models
 * @category   Models
 * @copyright  Copyright (c) 2021, The Webb Enterprises Inc.
 * @author     The Webb Enterprises Dev Team
 * @link       http://www.thewebbenterprises.com
 * @since      Version 1.0
 *
 */
class Frontend_model extends CI_Model {

		public function __construct(){
    		$this->load->database();
			$this->load->model('agent_model');
			$this->load->model('frontend_model');
			$this->load->library('session');
			$this->load->helper(array('frontend'));


		}

	/**
	 * Add new seller account
	 *
	 * @param  array 	 $data Details of seller account
	 * @return boolean true|false
	 */
		public function add_token($data){
			$this->db->insert('zoho_tokens', $data);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

	/**
	 * Add new seller account
	 *
	 * @param  array 	 $data Details of seller account
	 * @return boolean true|false
	 */
		public function get_token($time){
			$this->db->select('*');
			$this->db->from('zoho_tokens');
			$this->db->where('token_time >', $time);
			if ($token = $this->db->get()->row_array()) {
				return $token;
			}else{
				$this->db->delete('zoho_tokens', array('token_time <' => $time));
				return false;
			}
		}

	/**
	 * Add new seller account
	 *
	 * @param  array 	 $data Details of seller account
	 * @return boolean true|false
	 */
		public function add_seller($data)
		{		
			$this->db->insert('sellers', $data);
      		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

		public function add_buyer($data)
		{		
			$this->db->insert('buyers', $data);
      		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

		public function save_attribute($userId, $attributes)
		{
		
			foreach ($attributes as $key => $val)
			{

				$data = array(

					'user_id'  		=> $userId,
					'attribute_id'	=> $val
				);

				$this->db->insert('users_attributes', $data);
			}

			return true;


		}


	/**
	 * Add new agent account
	 *
	 * @param  array 	 $data Details of agent account
	 * @return boolean true|false
	 */
		public function add_agent($data){
			$this->db->insert('agents', $data);
      		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}


	/**
	 * Get details of selected agent account
	 *
	 * @param  integer $agent_id ID of system agent to return
	 * @return array Agent details
	 */
		public function get_agent($agent_id)
		{
	    	$agent = $this->db->select('accounts.*, agents.*')->from('accounts')->where("accounts.id =", $agent_id)->where("accounts.user_type =", 'Agent')->join('agents', 'agents.agent_id = accounts.id', 'left')->get()->row_array();
    		return $agent;
		}

	/**
	 * Add new property account
	 *
	 * @param  array 	 $data Details of property account
	 * @return boolean true|false
	 */
		public function get_notified($notification_id = null){
			$this->db->select('accounts.id, accounts.email');
			$this->db->from('administrators');
			$this->db->join('accounts', 'administrators.admin_id = accounts.id', 'left');
			$this->db->like('administrators.notifications', 'i:'.$notification_id.';s:3:"Yes";', 'both');
            $this->db->where('accounts.active',1);
			if ($emails = $this->db->get()->result_array()) {
				$email_array = array_column($emails,"email","id");
				return $email_array;
			}else{
				return false;
			}

		}


	/**
	 * Add new property account
	 *
	 * @param  array 	 $data Details of property account
	 * @return boolean true|false
	 */

		public function find_zip($zip)
		{
			$this->db->select('save_premium_listing.city, agents.zipcode');
			$this->db->from('agents');
			$this->db->join('save_premium_listing','save_premium_listing.agent_id = agents.agent_id', 'left');
			$this->db->where('agents.zipcode =', $zip);
			return $this->db->get()->result_array();


		}
		public function locate_agent($latitude = NULL, $longitude = NULL, $state, $city)
		{
		
			if(isset($longitude) &&  $longitude !== NULL)
			{
				$distance2 = '( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( save_premium_listing.latitude ) ) * cos( radians( save_premium_listing.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin(radians(save_premium_listing.latitude)) ) ) AS distance2,';
				$this->db->select('save_premium_listing.agent_id as pm, save_premium_listing.city, agents.agent_id, CONCAT(agents.first_name, " ", agents.last_name) AS agent, agents.avatar_string AS agent_image, agents.brokerage_name, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( agents.latitude ) ) * cos( radians( agents.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin(radians(agents.latitude)) ) ) AS distance,'.$distance2.' accounts.active AS elligible, accounts.approval AS isapproved');
			}else{
				$this->db->select('save_premium_listing.agent_id as pm, save_premium_listing.city, agents.agent_id, CONCAT(agents.first_name, " ", agents.last_name) AS agent, agents.avatar_string AS agent_image, agents.brokerage_name, accounts.active AS elligible, accounts.approval AS isapproved');
			}
						
			$this->db->from('agents');
			$this->db->join('accounts', 'agents.agent_id = accounts.id', 'left');
			$this->db->join('save_premium_listing','save_premium_listing.agent_id = accounts.id', 'left');
			$this->db->join('licenses', 'licenses.agent_id  = accounts.id', 'left');

			
			if(isset($longitude) &&  $longitude !== NULL)
			{
				$this->db->having('distance2 <',200);
				$this->db->or_having('distance <',200);

			}

			$this->db->having('elligible =', 1);
			$this->db->having('isapproved =', 'Completed');	
			if(isset($city) && !empty($city)) 
			{
				$this->db->or_where('agents.city =', $city);
				$this->db->or_where('save_premium_listing.city', $city);

			}			
					
			if(isset($state) && !empty($state)) 
			{
				$this->db->where('licenses.license_state =', $state);
			}

			$this->db->order_by('agents.agent_id ASC');
			$this->db->group_by('agents.agent_id');
			$agents = $this->db->get()->result_array();		

			
		    return $agents;
		}

    public function locate_buyer_agent($latitude = NULL, $longitude = NULL, $state, $city)
    {

        $userId = $this->ion_auth->get_user_id();

        $this->db->select('attribute_id');
        $this->db->from('users_attributes');
        $this->db->where('user_id =', $userId);
        $buyer_attributes = $this->db->get()->result_array();
        $battrs = [];
        foreach ($buyer_attributes as $battr){
            $battrs[] = $battr['attribute_id'];
        }

        $battrs = array_filter($battrs);
        if (count($battrs) > 0){
            $battrs = ', (select count(*) from users_attributes where accounts.id = users_attributes.user_id and users_attributes.attribute_id in ('.implode(',', $battrs).')) as attr_counts';
        } else {
            $battrs = ', 0 as attr_counts';
        }


        if(isset($longitude) &&  $longitude !== NULL)
        {
            $distance2 = '( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( save_premium_listing.latitude ) ) * cos( radians( save_premium_listing.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin(radians(save_premium_listing.latitude)) ) ) AS distance2,';
            $this->db->select('agents.agent_id, CONCAT(agents.first_name, " ", agents.last_name) AS agent,save_premium_listing.id, save_premium_listing.city, agents.avatar_string AS agent_image, agents.brokerage_name, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( agents.latitude ) ) * cos( radians( agents.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin(radians(agents.latitude)) ) ) AS distance,'.$battrs.' accounts.active AS elligible, accounts.approval AS isapproved'.$battrs);
        }else{
            $this->db->select('agents.agent_id, CONCAT(agents.first_name, " ", agents.last_name) AS agent,save_premium_listing.id, save_premium_listing.city, agents.avatar_string AS agent_image, agents.brokerage_name, accounts.active AS elligible, accounts.approval AS isapproved'.$battrs);
        }


        $this->db->from('agents');
        $this->db->join('accounts', 'agents.agent_id = accounts.id', 'left');
        $this->db->join('save_premium_listing','save_premium_listing.agent_id = accounts.id', 'left');
        $this->db->join('licenses', 'licenses.agent_id  = accounts.id', 'left');
        $this->db->join('users_attributes', 'users_attributes.user_id  = accounts.id', 'left');


        if(isset($longitude) &&  $longitude !== NULL)
        {
            $this->db->having('distance2 <',200);
            $this->db->or_having('distance <',200);

        }

        $this->db->having('elligible =', 1);
        $this->db->having('isapproved =', 'Completed');
        if(isset($city) && !empty($city))
        {
            $this->db->or_where('agents.city =', $city);
            $this->db->or_where('save_premium_listing.city', $city);

        }

        if(isset($state) && !empty($state))
        {
            $this->db->where('licenses.license_state =', $state);
        }
        $this->db->order_by('save_premium_listing.id', 'desc');
        $this->db->order_by('attr_counts DESC');
        $this->db->group_by('agents.agent_id');
        $agents = $this->db->get()->result_array();


        return $agents;
    }

	/**
	 * Add new property account
	 *
	 * @param  array 	 $data Details of property account
	 * @return boolean true|false
	 */
// 		public function find_agent_by_names($filter){
// 			$this->db->select('accounts.*, agents.agent_id, CONCAT(agents.first_name, " ", agents.last_name) AS agent, agents.avatar_string AS agent_image, agents.brokerage_name, accounts.active AS elligible, accounts.approval AS isapproved');
// 			$this->db->from('accounts');
// 			$this->db->join('agents', 'agents.agent_id = accounts.id', 'left');
// 			$this->db->join('licenses', 'licenses.agent_id = agents.agent_id', 'left');
// 			$this->db->where('accounts.active =', 1);
// 			$this->db->where('accounts.approval =', 'Completed');
// 			$this->db->where('accounts.user_type =', 'Agent');
// 			if ($filter['state']) {
// 				$this->db->where('licenses.license_state =', $filter['state']);
// 			}
// 			if ($filter['city']) {
// 				$this->db->where('agents.city =', $filter['city']);
//                 $this->db->join('save_premium_listing', 'save_premium_listing.agent_id = agents.agent_id', 'right');
//                 $this->db->or_group_start();
//                 $this->db->where('save_premium_listing.query_type =', 'city');
//                 $this->db->where('save_premium_listing.city =', $filter['city']);
//                 $this->db->group_end();
//             }
// 			$this->db->where('accounts.user_type =', 'Agent');
// 			$this->db->order_by('accounts.id ASC');
// 			$this->db->group_by('accounts.id');

// 			$agents = $this->db->get()->result_array();
// //  		echo $this->db->last_query();exit();
// 	    return $agents;
// 		}

	/**
	 * Add new agent account
	 *
	 * @param  array 	 $data Details of agent account
	 * @return boolean true|false
	 */
		public function join_our_team($data){
			$this->db->insert('join_our_team', $data);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

	/**
	 * Add new agent account
	 *
	 * @param  array 	 $data Details of agent account
	 * @return boolean true|false
	 */
		public function contact_request($data){
			$this->db->insert('contact_requests', $data);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

	/**
	 * Get details of selected property account
	 *
	 * @param  integer $property_id ID of system property to return
	 * @return array Property details
	 */
		public function add_notification($user_ids, $title, $message, $action = null, $action_id = null){
			if (is_array($user_ids)) {
				foreach ($user_ids as $user_id => $email) {
					$data = array(
					'user_id' => $user_id,
					'message' => $message,
					'title' => $title,
					'action' => $action,
					'action_id' => $action_id,
					'added_on' => time()
					);
					$this->db->insert('notifications', $data);
				}
			}else{
				$data = array(
				'user_id' => $user_ids,
				'message' => $message,
				'title' => $title,
				'action' => $action,
				'action_id' => $action_id,
				'added_on' => time()
				);
				$this->db->insert('notifications', $data);
			}
          
			return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

	/**
	 * Lists of clients with details
	 *
	 * @return array List of clients with details
	 */
		public function get_agent_licenses($agent_id){
			$this->db->from('licenses');
			$this->db->where('licenses.license_status =', 'Active');
			$this->db->where("agent_id =", $agent_id);
			$this->db->order_by('licenses.license_id DESC');

			$records = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
	    return $records;
		}

	/**
	 * Lists of clients with details
	 *
	 * @return array List of clients with details
	 */
		public function check_state($state){
			$this->db->from('state_costs');
			$this->db->where('state_costs.signup =', 'Enabled');
			$this->db->where("state_costs.state = ", $state);

			if ($record = $this->db->get()->row_array()) {
				return true;
			}else{
				return false;
			}
		}


	/**
	 * Add new agent account
	 *
	 * @param  array 	 $data Details of agent account
	 * @return boolean true|false
	 */
		public function waiting_user($data){
			$this->db->insert('waiting_users', $data);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
		}

	public function all_membership_plans()
	{	
		$this->db->from('member_ship_plans');
		return $this->db->get()->result_array();
	}

	public function find_email($request)
	{	
		$this->db->from('accounts');
		$this->db->where("email = ", $request['email']);
		if ($record = $this->db->get()->row_array()) {
			return "true";
		}else{
			return "false";
		}
	}

	public function set_token_token($email, $token)
	{
		// $this->db->query("UPDATE accounts SET  email_verification_token = ".$token." WHERE email = '".$email."'");

		$this->db->set('email_verification_token', $token);
		$this->db->where('email', $email);
		$this->db->update('accounts');
     	return ($this->db->affected_rows() >= 0 ) ? true : false;
	}


	public function save_payment_info($meta_order_id,$charge_id, $plan_title,  $payment_id, $amount, $list_features, $totalDsicount, $user_id,  $plan_id, $featuresarray, $coupon, $couponAmount)
	{

        $this->db->set('plan_id', $plan_id);
        $this->db->set( 'offer_limit' , 0);
        $this->db->set( 'offer_remain' , 0);
        $this->db->set( 'win_limit' , 0);
        $this->db->set( 'win_remain' , 0);
        $this->db->where('agent_id', $user_id);
        $this->db->update('agents');


		$featuresarray = explode(",",$featuresarray);    

		$this->db->from('subscription_tbl');
		$this->db->where('user_id' , $user_id);
		$record = $this->db->get()->row_array();

		if(isset($record['id']) && $record['id'] > 0)
		{
			$this->db->set('status', 2);
			$this->db->where('user_id', $user_id);
			$this->db->update('subscription_tbl');
	
		}



		$data = array(
				'plan_name'        => $plan_title,
				'subtotal' 	  	   => 0,
				'totalprice' 	   => 0,
				'discount'   	   => 0,
				'payment_id'       => $payment_id,
				'charge_id'        => $charge_id,
				'user_id'          => $user_id,
				'plan_id'          => $plan_id,
				'meta_order_id'	   => $meta_order_id,
				'coupon'		   => $coupon,
				'coupon_discount'  => $couponAmount,
				'featture_enabled' => $list_features,
				'status' 		   => 1,

		   );

		$this->db->insert('subscription_tbl', $data);
		$insert_id = $this->db->insert_id();

		$this->db->set('payment_id', $payment_id);    
		$this->db->where('agent_id', $user_id);
		$this->db->update('agents');




	

		$subtotalPrice = 0;
		$totalDsicount = 0;

		foreach ($featuresarray as $key => $feature_id)
		{

			$feature  = getFeatureInformation($feature_id);
			$discount = 0;
			$total    = 0;
			if($feature['discount_type'] == 1)
			{
				$discount = $feature['discount_value'];				
			}else{
				$discount = $feature['price'] * ($feature['discount_value']/ 100);
			}			
			
			$subtotalPrice += $feature['price'];
			$totalDsicount += $discount;

			$data = array(
				'subscription_id' => $insert_id,
				'feature_id'      => $feature_id,
				'feature_name' 	  => $feature['title'],
				'discount_value'  => $feature['discount_value'],
				'price'           => $feature['price'],
				'discount_type'   => $feature['discount_type'],
				'discount'		  => $discount,
				'total_price'     => $feature['price'] - $discount,
				'feature_enabled' => $feature['slug_key'],
		   );

		   $this->db->insert('subscription_items', $data);
		
		
			$this->db->from('plan_feature_options');
			$this->db->where('feature_id =', $feature_id);
			$featureOptions = $this->db->get()->result_array();


			foreach ($featureOptions as $key => $option)
			{


				if($option['name'] == "offer_limit")
				{

					$this->db->set('plan_id', $plan_id);
					$this->db->set( 'offer_limit' , $option['value']);
					$this->db->set( 'offer_remain' , $option['value']);
					$this->db->where('agent_id', $user_id);
					$this->db->update('agents');
				}

				if($option['name'] == "win_limit")
				{

					$this->db->set('plan_id', $plan_id);
					$this->db->set( 'win_limit' , $option['value']);
					$this->db->set( 'win_remain' , $option['value']);
					$this->db->where('agent_id', $user_id);
					$this->db->update('agents');
				}
			}


		}

        $couponType = $this->db->select('coupon_type')->from("agent_coupons")->where('coupon_code', $coupon)->get()->row_array();

        $totalprice = '';
        if($couponType['coupon_type'] == 'Percentage')
        {
            if($couponAmount == 100)
            {
                $totalprice = 0;
            }else{
                $totalDsicount = ($couponAmount/  100) * $subtotalPrice;
                $totalprice = $subtotalPrice - $totalDsicount;
            }
        }

        $this->db->select('member_ship_plans.payment');
        $this->db->where('id', $plan_id);
        $this->db->from('member_ship_plans');
        $plan_payment= $this->db->get()->row_array();


		$this->db->set('discount', $totalDsicount);
		$this->db->set('subtotal', $subtotalPrice);
        if(isset($totalprice) && $totalprice !== '')
        {
            $this->db->set('totalprice', $totalprice);

        }else{
            $this->db->set('totalprice', $subtotalPrice - $totalDsicount - $couponAmount);

        }
        if($plan_payment['payment'] == 'yearly')
        {
            $this->db->set('sub_expire', strtotime("+1 year"));

        }
        else{
            $this->db->set('sub_expire', strtotime("+1 month"));

        }
		$this->db->where('id', $insert_id);
		$this->db->update('subscription_tbl');

        if($plan_payment['payment'] == 'yearly')
        {
            $this->db->set('membership_due' , strtotime("+1 year"));

        }elseif ($plan_payment['payment'] == 'monthly'){

            $this->db->set('membership_due', strtotime("+1 month"));

        }elseif ($plan_payment['payment'] == 'biannually'){

            $this->db->set('membership_due', strtotime("+6 month"));

        }elseif ($plan_payment['payment'] == 'quarterly'){

            $this->db->set('membership_due', strtotime("+3 month"));

        }


		$this->db->set('plan_id', $plan_id);
		$this->db->where('agent_id', $user_id);
		$this->db->update('agents');

		$data = array(
			'status' => 3,
			'account_id' =>$user_id
		);

		$this->db->insert('survey', $data);
		return true;
	}


	public function get_user_info($id)
	{
		$this->db->from('agents');
		$this->db->where("agent_id = ", $id);
		return $record = $this->db->get()->row_array();
	}



	public function activeFeatures($slug)
	{	
		$sessionChecked = $this->session->get_userdata('Agent');
		$this->db->select('subscription_tbl.*');
		$this->db->from('subscription_tbl');
		$this->db->like('featture_enabled', $slug, 'both');
		$this->db->where('user_id' , $sessionChecked['user_id']);
		$this->db->where('status' ,1);
		return $record = $this->db->get()->row_array();

	}


	public function userdiscount()
	{
		$sessionChecked = $this->session->get_userdata('Agent');
		$userInfo = $this->frontend_model->get_user_info($sessionChecked['user_id']);
		return $userInfo['amount_limit'];
		
	}



	public function activeChatFeatures($user_id, $slug)
	{	
		$this->db->from('subscription_tbl');
		$this->db->join('agents', 'subscription_tbl.plan_id = agents.plan_id');
	    $this->db->where('subscription_tbl.status =' , 1);
		$this->db->where('user_id =' , $user_id);		
		$this->db->like('featture_enabled', $slug, 'both');
		$this->db->order_by('id', 'desc');
		return $record = $this->db->get()->row_array();

	

	}


	public function getFeatureInformation($id)
	{
		$this->db->from('plan_features');
		$this->db->where('id' , $id);
		return $record = $this->db->get()->row_array();
	}


	public function addAgentStripId($stripe_id, $user_id)
	{
		$this->db->set('stripe_id', $stripe_id);
		$this->db->where('agent_id', $user_id);
		$this->db->update('agents');	

		return true;
	}

	public function get_active_states()
	{
		$this->db->select('state_id, state');
		$this->db->where('signup =', 'Enabled');
		$this->db->from('state_costs');	
		return $this->db->get()->result_array();

	}

	public function questions_rating($request, $review)
	{
        $this->db->where("review_id", $review);
        $this->db->delete("questions_rating");
		$ratingNumber = 0;
		foreach ($request['rating'] as $key => $value)
		{
		    $data = array(
			    'question_id' 	=> $key,
			    'rating_number' => $value,
				'review_id'     => $review,
			);

			$ratingNumber       = $ratingNumber + $value;
			$this->db->insert('questions_rating', $data);
		}		
		return $ratingNumber / count($request['rating']);

        // 
        // return true;
    }

	public function getAllAttributes()
	{
		$this->db->select('id, attribute_name as name');		
		$this->db->from('match_making_attributes');		
		return $record = $this->db->get()->result_array();

	}

	public function skip()
	{
		$userId = $this->ion_auth->get_user_id();	
		$this->db->insert('users_attributes', array('user_id' => $userId, 'status' => '2'));	
		return true;

	}

	public function userType($userid)
	{
		$this->db->select('id, user_type');	
		$this->db->where('id', $userid);
		$this->db->from('accounts');		
		return $record = $this->db->get()->row_array();
	}

	public function updateSubscriptionPlan($userid)
	{
		$this->db->select('id,totalprice, payment_id, charge_id, meta_order_id');	
		$this->db->where('user_id', $userid);
		$this->db->where('status', 1);
		$this->db->from('subscription_tbl');		
		$this->db->limit('id', 'desc');		
		$record = $this->db->get()->row_array();
		$this->db->where("subscription_id", $record['id']);
		$this->db->delete("subscription_items");
		$this->db->where("id", $record['id']);
        $this->db->delete("subscription_tbl"); 

		return $record;
		
	}


    public function getStagteName($state_id)
    {
        $this->db->select('state');
        $this->db->where('state_id', $state_id);
        $this->db->from('state_costs');
        $record = $this->db->get()->row_array();
        return $record['state'];
    }


    public function getCitiesName($agent_id, $state_id, $dateRange, $type, $status_price)
    {
        $this->db->select('save_premium_listing.*');
        $this->db->where('agent_id', $agent_id);
        $this->db->where('state_id', $state_id);
        $this->db->where('date_range', $dateRange);
        $this->db->where('type', $type);
        $this->db->where('status_price', $status_price);
        $this->db->from('save_premium_listing');
        $records = $this->db->get()->result_array();
        $data = array();
        foreach($records as $record)
        {
            $data[] = array (
                'city_id' => $record['city_id'],
                'city' => $record['city']
            );
        }

        return $data;
    }


    public function getDateRanges($agent_id)
    {
        $this->db->select('save_premium_listing.date_range');
        $this->db->where('agent_id', $agent_id);
//        $this->db->where('status_price', 'Unpaid');
        $this->db->from('save_premium_listing');
        $records = $this->db->get()->result_array();

        foreach($records as $record)
        {
            $data[] = array (
                'date_range' => $record['date_range'],
            );
        }

         return $data;
    }



    public function getCitieId($city)
    {
        $this->db->select('city_id');
        $this->db->where('city_name', $city);
        $this->db->from('cities');
        $records = $this->db->get()->row_array();

        return $records['city_id'];
    }




    public function getBuyerStateCity($buyerId)
    {
        $this->db->select('buyers.*');
        $this->db->where('buyers.buyer_id', $buyerId);
        $this->db->from('buyers');
         $records = $this->db->get()->row_array();

        if(!isset($records['city']) && !isset($records['state']))
        {
            $this->db->select('accounts.*');
            $this->db->where('accounts.id', $buyerId);
            $this->db->from('accounts');
            $records = $this->db->get()->row_array();
        }

        return $records;

    }

    public function getUserName($seller_id,$buyer_id)
    {

        if(isset($seller_id) && $seller_id != NULL)
        {
            $this->db->select('sellers.*');
            $this->db->where('seller_id =', $seller_id);
            $this->db->from('sellers');
            $data = $this->db->get()->row_array();
            $data['user_type'] = 'Seller';

        }

        if(isset($buyer_id) && $buyer_id != NULL)
        {
            $this->db->select('buyers.*');
            $this->db->where('buyer_id =', $buyer_id);
            $this->db->from('buyers');
            $data = $this->db->get()->row_array();
            $data['user_type'] = 'Buyer';
        }

        return $data;


    }

    public function check_agent_favorite($agent_id)
    {
        $buyer_id = $this->ion_auth->get_user_id();
        $this->db->select('favorite_agents.*');
        $this->db->where('buyer_id =', $buyer_id);
        $this->db->where('agent_id =', $agent_id);
        $this->db->from('favorite_agents');
        $row = $this->db->get()->row_array();

        if(isset($row['fav_id']) && $row['fav_id'] > 0)
        {
            return true;
        }

        return false;
    }


	public function getCityName($city_id)
    {
        $this->db->select('city_id, city_name');
        $this->db->where_in('city_id', $city_id);
        $this->db->from('cities');
        return $records = $this->db->get()->row_array();
    }

    public function getTotalAmount($order_id)
    {
        $this->db->select_sum('price');
        $this->db->where_in('order_id', $order_id);
        $this->db->from('save_premium_listing');
        $records = $this->db->get()->row_array();
        return $records['price'];
    }

    public function getAttributesTxt()
    {
        $this->db->select('settings.*');
        $this->db->from('settings');
        $this->db->where('setting_name', 'attribute_important');
        $resultArray = $this->db->get()->row_array();
        return $resultArray['setting_value'];
    }

    public function agentAttributesPrecentage($agent_id)
    {
        $this->db->select('users_attributes.attribute_id');
        $this->db->from('users_attributes');
        $this->db->where('user_id', $agent_id);
        $this->db->where('user_type', 'Agent');
        $results = $this->db->get()->result_array();
        $attributesIds = array();
        foreach ($results as $result)
        {
            $attributesIds[] = $result['attribute_id'];

        }
        return $attributesIds;
    }

    public function customerAttributesPrecentage($customer_id, $user)
    {
        $this->db->select('users_attributes.attribute_id');
        $this->db->from('users_attributes');
        $this->db->where('user_id', $customer_id);
        $this->db->where('user_type', $user);
        $results = $this->db->get()->result_array();
        $attributesIds = array();
        foreach ($results as $result)
        {
            $attributesIds[] = $result['attribute_id'];
        }

        return $attributesIds;
    }

    public function  getCustomerName($customer_id, $user_type)
    {

        if(isset($user_type) && $user_type == 'Seller'){
            $this->db->select('first_name,last_name');
            $this->db->from('sellers');
            $this->db->where('seller_id', $customer_id);
            return$results = $this->db->get()->row_array();
        }

        if(isset($user_type) && $user_type == 'Buyer'){
            $this->db->select('first_name,last_name');
            $this->db->from('buyers');
            $this->db->where('buyer_id', $customer_id);
            return$results = $this->db->get()->row_array();
        }

    }

    public function getLastMessageOfAgent($seller_id, $buyer_id, $agent_id)
    {
        $this->db->select('messages.*');
        $this->db->from('messages');
        if(isset($seller_id) && $seller_id !== '')
        {
            $this->db->where('seller_id', $seller_id);
        }
        if(isset($buyer_id) && $buyer_id !== '')
        {
            $this->db->where('buyer_id', $buyer_id);
        }
        $this->db->where('agent_id', $agent_id);
        $this->db->order_by('message_id', 'desc');
        $this->db->group_by('message_id');
        return $results = $this->db->get()->row_array();

    }
}
