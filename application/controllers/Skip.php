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

class Skip extends CRTM_Controller {

	function __construct(){
		parent::__construct();
        $this->load->database();
        $this->load->model('frontend_model');      
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
        $userType =  $this->ion_auth->get_user_type();
        $account_id =$this->ion_auth->get_user_id();


        if($userType == 'Buyer' || $userType == 'Seller')
        {

            $this->db->select('id');
            $this->db->where('user_id',$account_id);
            $this->db->where('user_type',$userType);
            $this->db->from('users_attributes');
            $query = $this->db->get();        
            $attributes = $query->row();

            if(isset($attributes->id) && !empty($attributes->id))
		    {
			   $this->db->delete('users_attributes', array('user_id' => $account_id));

		    }


           $this->frontend_model->skip();

            if($userType == 'Buyer')
            {
                $this->db->select('buyer_id');
                $this->db->where('already_loged_in',0);
                $this->db->where('buyer_id',$account_id);
                $this->db->from('buyers');
                $query = $this->db->get();
                $user = $query->row();

              						
                if(isset($user->buyer_id) && !empty($user->buyer_id))
                {
                    $this->db->set('already_loged_in',1);
                    $this->db->where('buyer_id =', $user->buyer_id);
                    $this->db->update('buyers');		

                }
                redirect(base_url('/buyer'));

            }else{

                $this->db->select('seller_id');
                $this->db->where('already_loged_in',0);
                $this->db->where('seller_id',$account_id);
                $this->db->from('sellers');
                $query = $this->db->get();
                $user = $query->row();

                if(isset($user->seller_id) && !empty($user->seller_id))
                {

                    $this->db->set('already_loged_in',1);
                    $this->db->where('seller_id =', $user->seller_id);
                    $this->db->update('sellers');
                    redirect(base_url('/seller/add-property'));	
                }else {
                    redirect(base_url('/seller'));

                }		
            }
        

            
        }
    }
}