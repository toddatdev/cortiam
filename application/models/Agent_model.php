<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Agent model
 *
 * The system model with a series of CRUD functions (powered by CI's query builder), validation-in-model support, event callbacks and more for agents.
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
class Agent_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Lists of clients with details
     *
     * @return array List of clients with details
     */
    public function get_administrators($status = 'Active')
    {
        $this->db->select('accounts.*, administrators.*');
        $this->db->from('accounts');
        $this->db->join('administrators', 'administrators.admin_id = accounts.id', 'left');
        $this->db->where('accounts.active =', 1);
        $this->db->where('accounts.user_type =', 'Administrator');
        $this->db->order_by('accounts.id ASC');

        $admins = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $admins;
    }

    /**
     * Get details of selected administrator account
     *
     * @param integer $admin_id ID of system administrator to return
     * @return array Administrator details
     */
    public function get_administrator($admin_id)
    {
        $admin = $this->db->select('accounts.*, administrators.*')->from('accounts')->where("accounts.id =", $admin_id)->where("accounts.user_type =", 'Administrator')->join('administrators', 'administrators.admin_id = accounts.id', 'left')->get()->row_array();
        return $admin;
    }


    /**
     * Add new admin account
     *
     * @param array $data Details of admin account
     * @return boolean true|false
     */
    public function add_administrator($data)
    {
        $this->db->insert('administrators', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new admin account
     *
     * @param array $data Details of admin account
     * @return boolean true|false
     */
    public function edit_administrator($account_id, $data)
    {
        $this->db->update('administrators', $data, "admin_id = '" . $account_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }


    /**
     * Lists of clients with details
     *
     * @return array List of clients with details
     */
    public function get_sellers($status = 'Active')
    {
        $this->db->select('accounts.*, sellers.*');
        $this->db->from('accounts');
        $this->db->join('sellers', 'sellers.seller_id = accounts.id', 'left');
        $this->db->where('accounts.active =', 1);
        $this->db->where('accounts.user_type =', 'Seller');
        $this->db->order_by('accounts.id ASC');

        $sellers = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $sellers;
    }

    /**
     * Get details of selected seller account
     *
     * @param integer $seller_id ID of system seller to return
     * @return array Seller details
     */
    public function get_seller($seller_id)
    {
        $seller = $this->db->select('accounts.*, sellers.*')->from('accounts')->where("accounts.id =", $seller_id)->where("accounts.user_type =", 'Seller')->join('sellers', 'sellers.seller_id = accounts.id', 'left')->get()->row_array();
        return $seller;
    }

    /**
     * Add new seller account
     *
     * @param array $data Details of seller account
     * @return boolean true|false
     */
    public function add_seller($data)
    {
        $this->db->insert('sellers', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new seller account
     *
     * @param array $data Details of seller account
     * @return boolean true|false
     */
    public function edit_seller($account_id, $data)
    {
        $this->db->update('sellers', $data, "seller_id = '" . $account_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Lists of clients with details
     *
     * @return array List of clients with details
     */
    public function get_agents($status = 'Active')
    {
        $this->db->select('accounts.*, agents.*');
        $this->db->from('accounts');
        $this->db->join('agents', 'agents.agent_id = accounts.id', 'left');
        $this->db->where('accounts.active =', 1);
        $this->db->where('accounts.user_type =', 'Agent');
        $this->db->order_by('accounts.id ASC');

        $agents = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $agents;
    }

    /**
     * Get details of selected agent account
     *
     * @param integer $agent_id ID of system agent to return
     * @return array Agent details
     */
    public function get_agent($agent_id)
    {
        $agent = $this->db->select('accounts.*, agents.*')
            ->from('accounts')->where("accounts.id =", $agent_id)->where("accounts.user_type =", 'Agent')->join('agents', 'agents.agent_id = accounts.id', 'left')->get()->row_array();
        return $agent;
    }

    /**
     * Add new agent account
     *
     * @param array $data Details of agent account
     * @return boolean true|false
     */
    public function add_agent($data)
    {
        $this->db->insert('agents', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new agent account
     *
     * @param array $data Details of agent account
     * @return boolean true|false
     */
    public function edit_agent($account_id, $data)
    {
        $this->db->update('agents', $data, "agent_id = '" . $account_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_property($property_id)
    {
        $property = $this->db->select('properties.*, properties.winning_fee, state_costs.cost AS win_fee, accounts.email, sellers.first_name, sellers.last_name, sellers.phone')->from('properties')->where("properties.property_id =", $property_id)->join('state_costs', 'state_costs.state = properties.state', 'left')->join('sellers', 'properties.seller_id = sellers.seller_id', 'left')->join('accounts', 'properties.seller_id = accounts.id', 'left')->get()->row_array();
        return $property;
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function add_property($data)
    {
        $this->db->insert('properties', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function edit_property($account_id, $data)
    {
        $this->db->update('properties', $data, "property_id = '" . $account_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function get_notified($notification_id = null)
    {
        $this->db->select('accounts.id, accounts.email');
        $this->db->from('administrators');
        $this->db->join('accounts', 'administrators.admin_id = accounts.id', 'left');
        $this->db->like('administrators.notifications', 'i:' . $notification_id . ';s:3:"Yes";', 'both');
        if ($emails = $this->db->get()->result_array()) {
            $email_array = array_column($emails, "email", "id");
            return $email_array;
        } else {
            return false;
        }

    }


    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function add_approval($data)
    {
        $this->db->insert('approvals', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function list_approval_text($filter)
    {
        $this->db->select('approvals.*, CONCAT(administrators.first_name, " ", administrators.first_name) AS admin, administrators.avatar_string AS admin_image');
        $this->db->join('administrators', 'administrators.admin_id = approvals.admin_id', 'left');
        $this->db->from('approvals');
        if ($filter['seller_id']) {
            $this->db->select('CONCAT(sellers.first_name, " ", sellers.first_name) AS seller, sellers.avatar_string AS seller_image');
            $this->db->join('sellers', 'sellers.seller_id = approvals.seller_id', 'left');
            $this->db->where('approvals.seller_id =', $filter['seller_id']);
        }
        if ($filter['property_id']) {
            $this->db->where('approvals.property_id =', $filter['property_id']);
        }
        if ($filter['agent_id']) {
            $this->db->select('CONCAT(agents.first_name, " ", agents.first_name) AS agent, agents.avatar_string AS agent_image');
            $this->db->join('agents', 'agents.agent_id = approvals.agent_id', 'left');
            $this->db->where('approvals.agent_id =', $filter['agent_id']);
        }
        $this->db->order_by('approvals.app_id ASC');

        $sellers = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $sellers;
    }


    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function add_payment($data)
    {
        $this->db->insert('payments', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function add_invoice($data)
    {
        $this->db->insert('invoices', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function edit_invoice($invoice_id, $data)
    {
        $this->db->update('invoices', $data, "invoice_id = '" . $invoice_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_invoices($user_id, $status = null)
    {
        $this->db->select('invoices.*, agents.stripe_id, agents.payment_id, agent_coupons.coupon_code');
        $this->db->from('invoices');
        $this->db->where("invoices.agent_id =", $user_id);
        $this->db->where("invoices.payment_time <", time());
        if ($status) {
            $this->db->where_in("invoices.invoice_status", $status);
        } else {
            $this->db->where_in("invoices.invoice_status", array('Open', 'Failed'));
            $this->db->where("invoices.try_amount <=", 3);
        }
        $this->db->join('agents', 'invoices.agent_id = agents.agent_id', 'left');
        $this->db->join('agent_coupons', 'invoices.coupon_id = agent_coupons.use_id', 'left');
        $invoices = $this->db->get()->result_array();
        return $invoices;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_invoice($invoice_id)
    {
        $this->db->select('invoices.*, agents.stripe_id, agents.payment_id');
        $this->db->from('invoices');
        $this->db->where("invoices.invoice_id =", $invoice_id);
        $this->db->join('agents', 'invoices.agent_id = agents.agent_id', 'left');
        $invoice = $this->db->get()->row_array();
        return $invoice;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_credit_cards($agent_id)
    {
        $this->db->select('*');
        $this->db->from('credit_cards');
        $this->db->where("credit_cards.agent_id =", $agent_id);
        $this->db->order_by('credit_cards.card_id DESC');
        $cards = $this->db->get()->result_array();
        return $cards;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_credit_card($card_id)
    {
        $this->db->select('*');
        $this->db->from('credit_cards');
        $this->db->where("credit_cards.card_id =", $card_id);
        $card = $this->db->get()->row_array();
        return $card;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function add_credit_card($data)
    {
        $customer_id = $data['customer_id'];
        $last_digit  = $data['last_digit'];
        $brand       = $data['brand'];
        $this->db->select('*');
        $this->db->from('credit_cards');
        $this->db->where("credit_cards.customer_id =", $customer_id);
        $this->db->where("credit_cards.last_digit =", $last_digit);
        $this->db->where("credit_cards.brand =", $brand);
        $coupons = $this->db->get()->row_array();
        if(isset($coupons) && count($coupons) >= 1)
        {
            return false;
        }
        $this->db->insert('credit_cards', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function delete_credit_card($id)
    {
        if ($id) {
            $this->db->delete('credit_cards', array('card_id' => $id));
        }
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_coupons($agent_id)
    {
        $this->db->select('*');
        $this->db->from('agent_coupons');
        $this->db->where("agent_coupons.agent_id =", $agent_id);
        $this->db->order_by('agent_coupons.use_order ASC');
        $this->db->order_by('agent_coupons.added_on DESC');
        $coupons = $this->db->get()->result_array();
        return $coupons;
    }

    public function get_coupons_unused($agent_id)
    {
        $this->db->from('agent_coupons');
        $this->db->where("agent_coupons.agent_id =", $agent_id);
        $this->db->where("coupon_used","NO");
        $this->db->where("agent_coupons.coupon_used", "NO");
        $this->db->where("agent_coupons.end_date >", time());
        $this->db->order_by('agent_coupons.use_order ASC');
        $this->db->order_by('agent_coupons.added_on DESC');
        $coupons = $this->db->get()->result_array();
        return $coupons;
    }

    public function coupon_expired($agent_id)
    {
        $data = array(
            'coupon_used' => 'Expired'
        );
        $this->db->where('agent_id', $agent_id);
        $this->db->update('agent_coupons', $data, "end_date <'" . time() . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_first_coupon($agent_id)
    {
        $this->db->select('*');
        $this->db->from('agent_coupons');
        $this->db->where("agent_coupons.agent_id =", $agent_id);
        $this->db->where("agent_coupons.coupon_used =", 'No');
        $this->db->order_by('agent_coupons.use_order ASC');
        $this->db->order_by('agent_coupons.added_on DESC');
        $this->db->limit(1);
        $coupon = $this->db->get()->row_array();
        return $coupon;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function check_coupon_code($code)
    {
        $this->db->select('*');
        $this->db->from('coupons');
        $this->db->where("coupons.coupon_code =", $code);
        $coupon = $this->db->get()->row_array();
        return $coupon;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function check_coupon_used($coupon_id, $agent_id)
    {
        $this->db->select('*');
        $this->db->from('agent_coupons');
        $this->db->where("agent_coupons.coupon_id =", $coupon_id);
        $this->db->where("agent_coupons.agent_id =", $agent_id);
        $coupon = $this->db->get()->row_array();
        return $coupon;
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function add_coupon($data)
    {
        $this->db->insert('agent_coupons', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function edit_coupon($use_id, $data)
    {
        $this->db->update('agent_coupons', $data, "use_id = '" . $use_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function process_coupon($agent_id, $coupon_code)
    {
        if ($coupon = $this->check_coupon_code($this->security->xss_clean($coupon_code))) {
            if ($coupon['coupon_status'] != 'Active') {
                $response["fail"] = true;
                $response["fail_title"] = 'Coupon Not Exist!';
                $response["fail_message"] = 'This coupon code does not exist. Please try another coupon code to continue.';
            } elseif ($coupon['begin_date'] > time()) {
                $response["fail"] = true;
                $response["fail_title"] = 'Coupon Not Active!';
                $response["fail_message"] = 'This coupon cannot be used at this moment. Coupon will be activated on ' . date('F j, Y', $coupon['begin_date']) . '. Please try again after activation date.';
            } elseif ($coupon['end_date'] < time()) {
                $response["fail"] = true;
                $response["fail_title"] = 'Coupon Expired!';
                $response["fail_message"] = 'This coupon cannot be used, because its expired on ' . date('F j, Y', $coupon['end_date']) . '. Please try another coupon code to continue.';
            } elseif ($used = $this->check_coupon_used($coupon['coupon_id'], $agent_id)) {
                $response["fail"] = true;
                $response["fail_title"] = 'Coupon Already Used!';
                $response["fail_message"] = 'This coupon already used by you on ' . date('F j, Y', $used['added_on']) . '. Please try another coupon code to continue.';
            } else {
                $coupon_data = array(
                    'agent_id' => $agent_id,
                    'coupon_id' => $coupon['coupon_id'],
                    'coupon_code' => $coupon['coupon_code'],
                    'coupon_desc' => $coupon['coupon_desc'],
                    'coupon_type' => $coupon['coupon_type'],
                    'coupon_amount' => $coupon['coupon_amount'],
                    'begin_date' => $coupon['begin_date'],
                    'end_date' => $coupon['end_date'],
                    'end_date' => $coupon['end_date'],
                    'added_on' => time()
                );
                if ($use_id = $this->add_coupon($coupon_data)) {
                    if ($coupon['coupon_type'] == 'Win Limit') {
                        $this->set_extra_winexp($agent_id, number_format($coupon['coupon_amount']), 'win');
                        $use_data = array(
                            'used_on' => time(),
                            'coupon_used' => 'Yes'
                        );
                        $this->edit_coupon($use_id, $use_data);
                        $response["use_id"] = $use_id;
                        $response["success"] = true;
                        $response["success_title"] = 'Coupon Added & Used';
                        $response["success_message"] = $coupon['coupon_code'] . ' coupon added to your collection successfully. Because this coupon gives extra ' . number_format($coupon['coupon_amount']) . ' points to your win limit, its automatically used and added to your account.';
                    } elseif ($coupon['coupon_type'] == 'Interest Limit') {
                        $this->set_extra_winexp($agent_id, number_format($coupon['coupon_amount']), 'off');
                        $use_data = array(
                            'used_on' => time(),
                            'coupon_used' => 'Yes'
                        );
                        $this->edit_coupon($use_id, $use_data);
                        $response["success"] = true;
                        $response["success_title"] = 'Coupon Added & Used';
                        $response["success_message"] = $coupon['coupon_code'] . ' coupon added to your collection successfully. Because this coupon gives extra ' . number_format($coupon['coupon_amount']) . ' points to your interest limit, its automatically used and added to your account.';
                    } else {
                        $response["success"] = true;
                        $response["success_title"] = 'Coupon Added';
                        $response["success_message"] = $coupon['coupon_code'] . ' coupon added to your collection successfully. Please do not forget to use your coupon before it expires on ' . date('F j, Y', $coupon['end_date']);
                    }
                } else {
                    $response["fail"] = true;
                    $response["fail_title"] = 'Unexpected Error!';
                    $response["fail_message"] = 'There is an unexpected error occured, please refresh the page and try again.';
                }
            }
        } else {
            $response["fail"] = true;
            $response["fail_title"] = 'Unexpected Error!';
            $response["fail_message"] = 'There is an unexpected error occured, please refresh the page and try again.';
        }
        return $response;
    }

    /**
     * Add new property account
     *
     * @param array $data Details of property account
     * @return boolean true|false
     */
    public function set_extra_winexp($agent_id, $amount, $type = 'win')
    {
        if ($type == 'win') {
            $this->db->set('win_remain', 'win_remain+' . number_format($amount), FALSE);
        } elseif ($type == 'off') {
            $this->db->set('offer_remain', 'offer_remain+' . number_format($amount), FALSE);
        } else {
            $this->db->set('offer_remain', 'offer_remain+' . number_format($amount), FALSE);
        }
        $this->db->where('agents.agent_id =', $agent_id);
        $this->db->update('agents');
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Lists of clients with details
     *
     * @return array List of clients with details
     */
    public function get_properties($filter = null)
    {
        $this->db->select('properties.*, state_costs.cost AS win_fee');
        $this->db->from('properties');

        if (!$filter['status']) {
            $this->db->where('properties.status', 'Active');
        } else {
            $this->db->where_in('properties.status', $filter['status']);
        }
        if ($filter['city']) {
            $this->db->where('properties.city =', $filter['city']);
        }
        if ($filter['type']) {
            if ($filter['type'] != 'Both') {
                $this->db->where('properties.type =', $filter['type']);
            }
        }
        if ($filter['list']) {
            $this->db->where_in('properties.property_id', $filter['list']);
        }

        if ($filter['state']) {
            if ($filter['state']['Commercial']) {
                foreach ($filter['state']['Commercial'] as $state) {
                    $state_keyword[] = "(properties.state = '" . $state . "' AND properties.type = 'Commercial')";
                }
            }
            if ($filter['state']['Residential']) {
                foreach ($filter['state']['Residential'] as $state) {
                    $state_keyword[] = "(properties.state = '" . $state . "' AND properties.type = 'Residential')";
                }
            }
            $this->db->where("(" . implode(" OR ", $state_keyword) . ")");
        }

        $this->db->order_by('properties.approval_date DESC');
        if ($filter['limit']) {
            $this->db->limit($filter['limit']);
        }
        $this->db->join('state_costs', 'state_costs.state = properties.state', 'left');
        $properties = $this->db->get()->result_array();
        return $properties;
//	    $property = $this->db->select('properties.*, state_costs.cost AS win_fee, accounts.email, sellers.first_name, sellers.last_name')->from('properties')->where("properties.property_id =", $property_id)->join('state_costs', 'state_costs.state = properties.state', 'left')->join('sellers', 'properties.seller_id = sellers.seller_id', 'left')->join('accounts', 'properties.seller_id = accounts.id', 'left')->get()->row_array();
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_save_value($agent_id, $property_id)
    {
        $save = $this->db->from('saved_properties')->where('agent_id', $agent_id)->where('property_id', $property_id)->get()->row_array();
        return $save;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_saved_properties($agent_id, $array = false)
    {
        $saves = $this->db->from('saved_properties')->where('agent_id', $agent_id)->get()->result_array();
        if ($array) {
            if ($saves) {
                foreach ($saves as $save) {
                    $save_array[] = $save['property_id'];
                }
            } else {
                return array();
            }
            return $save_array;
        } else {
            return $saves;
        }
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function save_property($agent_id, $property_id)
    {
        $data['agent_id'] = $agent_id;
        $data['property_id'] = $property_id;
        $data['save_time'] = time();
        $this->db->insert('saved_properties', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function unsave_property($agent_id, $property_id)
    {
        if ($agent_id && $property_id) {
            $this->db->delete('saved_properties', array('agent_id' => $agent_id, 'property_id' => $property_id));
        }
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function drop_count($agent_id, $field_name, $calculation)
    {
        $this->db->set($field_name, $field_name . $calculation, FALSE);
        $this->db->where('agents.agent_id =', $agent_id);
        $this->db->update('agents');
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_proposal_value($agent_id, $property_id)
    {
        $save = $this->db->select('proposals.*, properties.state, properties.city')
            ->from('proposals')
            ->join('properties', 'proposals.property_id = properties.property_id', 'left')
            ->where('proposals.agent_id', $agent_id)
            ->where('proposals.property_id', $property_id)
            ->where_in('proposals.status', array('Unread', 'Read', 'Accepted', 'Declined'))
            ->get()->row_array();
        return $save;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_express_properties($agent_id, $array = false)
    {
        $saves = $this->db->select('proposals.property_id')->from('proposals')->where('proposals.agent_id', $agent_id)->where_in('proposals.status', array('Read', 'Unread'))->get()->result_array();
        if ($array) {
            foreach ($saves as $save) {
                $save_array[] = $save['property_id'];
            }
            return $save_array;
        } else {
            return $saves;
        }
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_offers_used($agent_id)
    {
        $proposals = $this->db->select('COUNT(prop_id) AS amount')->from('proposals')->where('proposals.agent_id', $agent_id)->where_in('proposals.status', array('Read', 'Unread'))->group_by('proposals.agent_id')->get()->row_array();
        return $proposals['amount'];
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_new_messages($agent_id)
    {
        $this->db->from('messages');
        $this->db->where('messages.agent_id =', $agent_id);
//        $this->db->where('messages.msg_from <>', 'Agent');
        $this->db->where('messages.status =', 'Unread');
        $messages = $this->db->get()->result_array();
        return $messages;
    }


    public function get_new_of_customers_messages($agent_id)
    {

        $this->db->select('messages.*, agents.first_name, agents.last_name');
        $this->db->from('messages');
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where('messages.msg_from <>', 'Agent');
        $this->db->where('messages.msg_from', 'Buyer');
        $this->db->or_where('messages.msg_from', 'Seller');
        $this->db->where('messages.status', 'Unread');
        $this->db->join('agents', 'messages.agent_id = agents.agent_id');
        $messages = $this->db->get()->result_array();
        return $messages;
    }


    public function get_count_customers_messages($agent_id)
    {

        $this->db->select('messages.*');
        $this->db->from('messages');
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where('messages.status', 'Unread');
        $this->db->where('messages.msg_from <>', 'Agent');
        $this->db->where_in('messages.msg_from', ['Buyer', 'Seller']);
        $messages = $this->db->get()->result_array();
        return $messages;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_new_offer_news($agent_id)
    {
        $this->db->select('proposals.*, sellers.first_name, sellers.last_name');
        $this->db->from('proposals');
        $this->db->join('sellers', 'proposals.seller_id = sellers.seller_id', 'left');
        $this->db->where('proposals.prop_to =', 'Agent');
        $this->db->where('proposals.agent_id =', $agent_id);
        $this->db->where('proposals.status =', 'Unread');
        $this->db->where('proposals.commission_rate IS NOT NULL', NULL);
        $this->db->where('proposals.contract_length IS NOT NULL', NULL);
        $this->db->order_by('proposals.prop_date DESC');

        $messages = $this->db->get()->result_array();
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_new_notifications($agent_id)
    {
        $this->db->from('notifications');
        $this->db->where('notifications.user_id =', $agent_id);
        $this->db->where('notifications.status =', 'Unread');
        $this->db->order_by('notifications.added_on DESC');

        $messages = $this->db->get()->result_array();
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_proposals($agent_id, $filter = null)
    {
        $this->db->select('proposals.*, properties.winning_fee, state_costs.cost AS win_fee, properties.default_image, properties.type, properties.building_size, properties.address, properties.unit, properties.city, properties.state');
        $this->db->from('proposals');
        $this->db->join('agents', 'proposals.agent_id = agents.agent_id', 'left');
        $this->db->join('properties', 'proposals.property_id = properties.property_id', 'left');
        $this->db->join('state_costs', 'state_costs.state = properties.state', 'left');
        $this->db->where('proposals.agent_id =', $agent_id);
        $this->db->where('proposals.commission_rate IS NOT NULL', NULL);
        $this->db->where('proposals.contract_length IS NOT NULL', NULL);
        if ($filter['status']) {
            $this->db->where_in('proposals.status', $filter['status']);
        }
        $this->db->where_in('properties.status', array('Active', 'Contracted', 'Inactivated'));
        $this->db->order_by('proposals.property_id DESC');
        $this->db->order_by('proposals.prop_date DESC');

        $messages = $this->db->get()->result_array();
        return $messages;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_proposed_properties($agent_id, $array = false)
    {
        $saves = $this->db->select('proposals.property_id')->from('agreements')->join('proposals', 'proposals.prop_id = agreements.prop_id', 'left')->where('agreements.agent_id', $agent_id)->where('agreements.agr_status', 'Open')->get()->result_array();
        if ($array) {
            foreach ($saves as $save) {
                $save_array[] = $save['property_id'];
            }
            return $save_array;
        } else {
            return $saves;
        }
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_win_properties($agent_id, $array = false)
    {
        $saves = $this->db->select('proposals.property_id')
            ->from('agreements')->join('proposals', 'proposals.prop_id = agreements.prop_id', 'left')
            ->where('agreements.agent_id', $agent_id)
            ->where('agreements.agr_status', 'Completed')
            ->get()
            ->result_array();
        if ($array) {
            foreach ($saves as $save) {
                $save_array[] = $save['property_id'];
            }
            return $save_array;
        } else {
            return $saves;
        }
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_proposal($agent_id, $proposal_id)
    {
        $this->db->select('proposals.*, properties.winning_fee, state_costs.cost AS win_fee, properties.default_image, properties.type, properties.building_size, properties.address, properties.unit, properties.city, properties.state');
        $this->db->from('proposals');
        $this->db->join('agents', 'proposals.agent_id = agents.agent_id', 'left');
        $this->db->join('properties', 'proposals.property_id = properties.property_id', 'left');
        $this->db->join('state_costs', 'state_costs.state = properties.state', 'left');
        $this->db->where('proposals.agent_id =', $agent_id);
        $this->db->where('proposals.prop_id =', $proposal_id);
        $this->db->where('proposals.commission_rate IS NOT NULL', NULL);
        $this->db->where('proposals.contract_length IS NOT NULL', NULL);
        $this->db->where('proposals.contract_length IS NOT NULL', NULL);
        $this->db->where_in('properties.status', array('Active', 'Contracted', 'Inactivated'));

        $messages = $this->db->get()->row_array();
//  		echo $this->db->last_query();exit();
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function check_newer_proposal($agent_id, $proposal_id)
    {
        $this->db->select('proposals.*, properties.city, properties.state');
        $this->db->from('proposals');
        $this->db->join('properties', 'proposals.property_id = properties.property_id', 'left');
        $this->db->where('proposals.main_id =', $proposal_id);
        $this->db->where('proposals.agent_id =', $agent_id);
        $this->db->where('proposals.commission_rate IS NOT NULL', NULL);
        $this->db->where('proposals.contract_length IS NOT NULL', NULL);

        $messages = $this->db->get()->row_array();
//  		echo $this->db->last_query();exit();
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_related_proposal($proposal_id)
    {
        $this->db->select('*');
        $this->db->from('proposals');
        $this->db->group_start();
        $this->db->where('base_id =', $proposal_id);
        $this->db->or_where('main_id =', $proposal_id);
        $this->db->or_where('prop_id =', $proposal_id);
        $this->db->group_end();
        $this->db->where('commission_rate IS NOT NULL', NULL);
        $this->db->where('contract_length IS NOT NULL', NULL);
        $this->db->where('status', 'Countered');

        $messages = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function add_proposal($data)
    {
        $this->drop_count($data['agent_id'], 'offer_remain', '-1');
        $this->db->insert('proposals', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function mark_proposal_read($agent_id, $proposal_id)
    {
        $this->db->set('status', 'Read');
        $this->db->set('seen_date', time());
        $this->db->where('proposals.prop_to =', 'Agent');
        $this->db->where('proposals.agent_id =', $agent_id);
        $this->db->where('proposals.status =', 'Unread');
        $this->db->where('proposals.prop_id =', $proposal_id);
        $this->db->update('proposals');
        return ($this->db->affected_rows() >= 0) ? true : false;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function edit_proposal($proposal_id, $data)
    {
        $this->db->update('proposals', $data, "prop_id = '" . $proposal_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_clear_favorites($property_id)
    {
        $this->db->delete('saved_properties', array('property_id' => $property_id));
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_clear_proposals($property_id)
    {
        $this->db->select('proposals.*, agents.first_name, agents.last_name, agents.notifications, accounts.email, properties.city, properties.state');
        $this->db->from('proposals');
        $this->db->join('agents', 'proposals.agent_id = agents.agent_id', 'left');
        $this->db->join('accounts', 'proposals.agent_id = accounts.id', 'left');
        $this->db->join('properties', 'proposals.property_id = properties.property_id', 'left');
        $this->db->where('proposals.property_id =', $property_id);
        $this->db->where('proposals.commission_rate IS NOT NULL', NULL);
        $this->db->where('proposals.contract_length IS NOT NULL', NULL);
        $this->db->where_in('proposals.status', array('Unread', 'Read'));
        $this->db->order_by('proposals.property_id DESC');
        $this->db->order_by('proposals.prop_date DESC');
        $proposals = $this->db->get()->result_array();
        return $proposals;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_counter_offer_value($agent_id, $property_id)
    {
        $offer = $this->db->from('proposals')->where('agent_id', $agent_id)->where('proposals.prop_from =', 'Agent')->where('property_id', $property_id)->where('commission_rate IS NOT NULL', NULL)->where('contract_length IS NOT NULL', NULL)->where_in('status', array('Read', 'Unread'))->get()->row_array();
        return $offer;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function add_message($data)
    {
        $this->db->insert('messages', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function mark_messages_read($agent_id, $user_id)
    {
            $this->db->set('status', 'Read');
            $this->db->set('seen_date', time());
            $this->db->where('messages.msg_from <>', 'Agent');
            $this->db->where('messages.buyer_id', $user_id);
            $this->db->or_where('messages.seller_id', $user_id);
            $this->db->update('messages');
            return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     *

     */
    public function get_message_list($agent_id, $customer, $customer_id)
    {

        $this->db->select('messages.*');
        $this->db->from('messages');
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where('messages.status', 'Unread');
        $this->db->where('messages.msg_from <>', 'Agent');
        $this->db->where_in('messages.msg_from', ['Buyer', 'Seller']);
        $this->db->group_by("messages.seller_id");
        $this->db->group_by("messages.buyer_id");
        $messages = $this->db->get()->result_row();

        $customer_id_array = array();
        foreach ($messages as $msg)
        {
            if(isset($msg['seller_id']) &&  $msg['seller_id'] !== '')
            {
                $customer_id_array[] = $msg['seller_id'];
            }

            if(isset($msg['buyer_id']) &&  $msg['buyer_id'] !== '')
            {
                $customer_id_array[] = $msg['buyer_id'];
            }
        }

        if($customer == "Seller")
        {
            $this->db->select('messages.*, sellers.first_name, sellers.last_name');
            $this->db->from('messages');
            $this->db->join('sellers', 'messages.seller_id = sellers.seller_id');
            $this->db->where('messages.agent_id =', $agent_id);
            $this->db->where('messages.status', 'Unread');
            $this->db->where('messages.seller_id', $customer_id);
            $this->db->where('messages.msg_from <>', 'Agent');
            $this->db->where('messages.msg_from', 'Seller');
            $this->db->group_by("messages.seller_id");
            $this->db->group_by("messages.admin_id");
            $this->db->order_by('messages.message_date DESC');
        }elseif($customer == "Buyer"){

            $this->db->select('messages.*, buyers.first_name, buyers.last_name');
            $this->db->from('messages');
            $this->db->join('buyers', 'messages.buyer_id = buyers.buyer_id');
            $this->db->where('messages.agent_id =', $agent_id);
            $this->db->where('messages.status', 'Unread');
            $this->db->where('messages.buyer_id', $customer_id);
            $this->db->where('messages.msg_from <>', 'Agent');
            $this->db->where('messages.msg_from', 'Buyer');
            $this->db->group_by("messages.buyer_id");
            $this->db->group_by("messages.admin_id");
            $this->db->order_by('messages.message_date DESC');
        }
        $messages = $this->db->get()->result_array();

        return $messages;
    }

    public function get_message_list_all($agent_id)
    {
        $this->db->select('messages.*, buyers.first_name, buyers.last_name');
        $this->db->from('messages');
        $this->db->where('messages.agent_id', $agent_id);
        //$this->db->join('buyers', 'messages.buyer_id = buyers.buyer_id', 'left');
        $this->db->join('buyers', 'messages.buyer_id = buyers.buyer_id OR (messages.buyer_id IS NULL AND messages.seller_id = buyers.buyer_id)', 'left');
        $this->db->order_by("messages.message_id", "desc");
        $this->db->order_by("messages.agent_id", "desc");
        $this->db->group_by("buyers.first_name");
        $messages = $this->db->get()->result_array();
        return $messages;
    }


    public function get_all_customers_message_list($agent_id)
    {
            $this->db->select('messages.*');
            $this->db->from('messages');
            $this->db->where('messages.agent_id =', $agent_id);
            $this->db->where('messages.status', 'Unread');
            $this->db->where('messages.msg_from <>', 'Agent');
            $this->db->where_in('messages.msg_from', ['Buyer', 'Seller']);
            $this->db->group_by("messages.seller_id");
            $this->db->group_by("messages.buyer_id");
            $messages = $this->db->get()->result_array();

            $customer_id_array = array();
            foreach ($messages as $msg)
            {
                if(isset($msg['seller_id']) &&  $msg['seller_id'] !== '')
                {
                    $customer_id_array[] = $msg['seller_id'];
                }

                if(isset($msg['buyer_id']) &&  $msg['buyer_id'] !== '')
                {
                    $customer_id_array[] = $msg['seller_id'];
                }
            }


        $this->db->select('messages.*, sellers.first_name, sellers.last_name');
        $this->db->from('messages');
        $this->db->join('sellers', 'messages.seller_id = sellers.seller_id');
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where('messages.status', 'Unread');
        $this->db->where('messages.msg_from <>', 'Agent');
        $this->db->where('messages.msg_from', 'Seller');
        $this->db->group_by("messages.seller_id");
        $this->db->group_by("messages.admin_id");
        $this->db->order_by('messages.message_date DESC');
        $sellerMessages = array();
        $sellerMessages = $this->db->get()->result_array();


        $this->db->select('messages.*, buyers.first_name, buyers.last_name');
        $this->db->from('messages');
        $this->db->join('buyers', 'messages.buyer_id = buyers.buyer_id');
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where('messages.status', 'Unread');
        $this->db->where('messages.msg_from <>', 'Agent');
        $this->db->where('messages.msg_from', 'Buyer');
        $this->db->group_by("messages.buyer_id");
        $this->db->group_by("messages.admin_id");
        $this->db->order_by('messages.message_date DESC');
        $buyerMessages = array();
        $buyerMessages = $this->db->get()->result_array();


        return array_merge($sellerMessages,$buyerMessages);


    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_messages_of($agent_id, $seller_id)
    {
        $this->db->select('messages.*, CONCAT(sellers.first_name, " ", sellers.last_name) AS seller, CONCAT(buyers.first_name, " ", buyers.last_name) AS buyer, sellers.avatar_string AS seller_image, buyers.avatar_string AS buyer_image, agents.avatar_string AS agent_image, buyers.avatar_string AS buyer_image');
        $this->db->from('messages');
        $this->db->join('sellers', 'messages.seller_id = sellers.seller_id', 'left');
        $this->db->join('buyers', 'messages.buyer_id = buyers.buyer_id', 'left');
        $this->db->join('agents', 'messages.agent_id = agents.agent_id', 'left');
        $this->db->where('messages.seller_id =', $seller_id);
        $this->db->or_where('messages.buyer_id =', $seller_id);
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where_in('messages.status', array('Read', 'Unread'));
        $this->db->order_by('messages.message_date ASC');

        $messages = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $messages;
    }




    public function msg_send_by_agent($agent_id, $user_id)
    {
        $this->db->select('messages.*');
        $this->db->from('messages');
        $this->db->where('messages.agent_id =', $agent_id);
        $this->db->where('messages.status', 'Unread');
        $this->db->where('messages.msg_from', 'Agent');
        $this->db->where('messages.seller_id', $user_id);
        $this->db->or_where('messages.buyer_id', $user_id);
        $this->db->where('messages.status', 'Unread');
        $this->db->group_by("messages.seller_id");
        $this->db->group_by("messages.buyer_id");
       return $messages = $this->db->get()->row_array();
    }

    /**
     * Get details of selected administrator account
     *
     * @param integer $admin_id ID of system administrator to return
     * @return array Administrator details
     */
    public function get_state_cost($property_id)
    {
        $property = $this->get_property($property_id);
        $state_cost = $this->db->from('state_costs')->where("state =", $property['state'])->get()->row_array();
        return $state_cost;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_aggrements($agent_id, $filter = null)
    {
        $time = time();
        $this->db->select('agreements.*, CONCAT(sellers.first_name, " ", sellers.last_name) AS seller, properties.property_id, properties.default_image, properties.type, properties.building_size, properties.address, properties.unit, properties.city, properties.state, proposals.commission_rate, proposals.contract_length');
        $this->db->from('agreements');
        $this->db->join('proposals', 'agreements.prop_id = proposals.prop_id');
        $this->db->join('properties', 'proposals.property_id = properties.property_id');
        $this->db->join('sellers', 'agreements.seller_id = sellers.seller_id', 'left');
        $this->db->where('agreements.agent_id =', $agent_id);

        if ($filter['status']) {
            $this->db->where_in('agreements.agr_status', $filter['status']);
        }
        $this->db->order_by('agreements.agr_id DESC');

        $aggrements = $this->db->get()->result_array();


//  		echo $this->db->last_query();exit();
        return $aggrements;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_aggrement($agent_id, $agree_id)
    {
        $this->db->select('agreements.*, CONCAT(sellers.first_name, " ", sellers.last_name) AS seller, properties.property_id, properties.default_image, properties.type, properties.building_size, properties.address, properties.unit, properties.city, properties.state');
        $this->db->from('agreements');
        $this->db->join('proposals', 'agreements.prop_id = proposals.prop_id', 'left');
        $this->db->join('properties', 'proposals.property_id = properties.property_id', 'left');
        $this->db->join('sellers', 'agreements.seller_id = sellers.seller_id', 'left');
        $this->db->where('agreements.agent_id =', $agent_id);
        $this->db->where('agreements.agr_id =', $agree_id);
        $this->db->order_by('agreements.agr_id DESC');

        $aggrement = $this->db->get()->row_array();
//  		echo $this->db->last_query();exit();
        return $aggrement;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function check_for_agreement($property_id)
    {
        $this->db->select('agreements.*, CONCAT(sellers.first_name, " ", sellers.last_name) AS seller, properties.property_id, properties.default_image, properties.type, properties.building_size, properties.address, properties.unit, properties.city, properties.state');
        $this->db->from('agreements');
        $this->db->join('proposals', 'agreements.prop_id = proposals.prop_id', 'left');
        $this->db->join('properties', 'proposals.property_id = properties.property_id', 'left');
        $this->db->join('sellers', 'agreements.seller_id = sellers.seller_id', 'left');
        $this->db->where('(agreements.agr_status !=', 'Canceled');
        $this->db->or_where("agreements.agr_status != 'Expired')");
        $this->db->where('properties.property_id =', $property_id);
        $this->db->order_by('agreements.agr_id DESC');

        $aggrement = $this->db->get()->row_array();
//  		echo $this->db->last_query();exit();
        return $aggrement;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function add_agreement($data)
    {

        $this->db->insert('agreements', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function edit_agreement($agreement_id, $data)
    {
        $this->db->update('agreements', $data, "agr_id = '" . $agreement_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Lists of clients with details
     *
     * @return array List of clients with details
     */
    public function list_properties($license_states, $filter = null)
    {
        $this->db->select('properties.*, saved_properties.save_time');
        $this->db->from('properties');
        $this->db->join('saved_properties', 'saved_properties.property_id = properties.property_id AND (saved_properties.agent_id = ' . $filter['agent_id'] . ')', 'left');

        $this->db->where('properties.status =', 'Active');
        if ($license_states != 'No License') {
            $this->db->where_in('properties.state', $license_states);
        }
        if ($filter['state']) {
            $this->db->where('properties.state =', $filter['state']);
        }
        if ($filter['city']) {
            $this->db->where('properties.city =', $filter['city']);
        }
        if ($filter['lat'] && $filter['long']) {
            $this->db->select('( ACOS( COS( RADIANS( ' . $filter['lat'] . ' ) ) * COS( RADIANS( properties.latitude ) ) * COS( RADIANS( properties.longitude ) - RADIANS( ' . $filter['long'] . ' ) ) + SIN( RADIANS( ' . $filter['lat'] . ' ) ) * SIN( RADIANS( properties.latitude ) )) * 6371) AS distance');
            $this->db->having('distance <', 20);
        }
        if ($filter['type']) {
            if ($filter['type'] != 'Both') {
                $this->db->where('properties.type =', $filter['type']);
            }
        }
        if ($filter['rate']) {
            $this->db->where('properties.commission_rate <=', $filter['rate']);
        }
        if ($filter['length']) {
            $this->db->where('properties.contract_length <=', $filter['length']);
        }

        $this->db->order_by("FIELD(properties.status,'Active','Inactivated','Contracted','Deleted'), properties.approval_date DESC");
        $properties = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $properties;
    }

    /**
     * Get details of selected agent account
     *
     * @param integer $agent_id ID of system agent to return
     * @return array Agent details
     */
    public function get_tutorial()
    {
        $record = $this->db->from('tutorial_pages')->where("page_id =", 'agent')->get()->row_array();
        return $record;
    }

    /**
     * Get details of selected agent account
     *
     * @param integer $agent_id ID of system agent to return
     * @return array Agent details
     */
    public function collect_trash($seller_id)
    {
        $this->db->set('properties.status', 'Deleted');
        $this->db->where('properties.seller_id =', $seller_id);
        $this->db->where('properties.status !=', 'Contracted');
        $this->db->update('properties');
        $this->db->reset_query();

        $this->db->set('proposals.status', 'Declined');
        $this->db->where('proposals.seller_id =', $seller_id);
        $this->db->where('proposals.status !=', 'Accepted');
        $this->db->update('proposals');
        $this->db->reset_query();

        $this->db->set('messages.status', 'Deleted');
        $this->db->where('messages.seller_id =', $seller_id);
        $this->db->where('messages.status !=', 'Read');
        $this->db->update('messages');
        return $record;
    }


    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_support_messages($agent_id)
    {
        $this->db->set('tickets.status', 'Read');
        $this->db->set('tickets.seen_date', time());
        $this->db->where('tickets.agent_id =', $agent_id);
        $this->db->where('tickets.status =', 'Unread');
        $this->db->where('tickets.msg_from =', 'Admin');
        $this->db->update('tickets');
        $this->db->reset_query();

        $this->db->select('tickets.*, CONCAT(administrators.first_name, " ", administrators.last_name) AS admin, administrators.avatar_string AS admin_image, agents.avatar_string AS agent_image');
        $this->db->from('tickets');
        $this->db->join('administrators', 'tickets.admin_id = administrators.admin_id', 'left');
        $this->db->join('agents', 'tickets.agent_id = agents.agent_id', 'left');
        $this->db->where('tickets.agent_id =', $agent_id);
        $this->db->where_in('tickets.status', array('Read', 'Unread'));
        $this->db->order_by('tickets.message_date asc');

        $messages = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function add_support($data)
    {
        $this->db->insert('tickets', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function get_settings($setting_name)
    {
        $setting = $this->db->from('settings')->where("setting_name =", $setting_name)->get()->row_array();
        return $setting;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function get_notifications($user_id)
    {
        $this->db->from('notifications');
        $this->db->where('notifications.user_id =', $user_id);
        $this->db->where_in('notifications.status', array('Read', 'Unread'));
        $this->db->order_by('notifications.added_on DESC');
        $messages = $this->db->get()->result_array();
        $this->db->reset_query();

        $this->db->set('notifications.status', 'Read');
        $this->db->where('notifications.user_id =', $user_id);
        $this->db->where('notifications.status =', 'Unread');
        $this->db->update('notifications');
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function set_notification_type_read($user_id, $notification_type)
    {
        $this->db->set('notifications.status', 'Read');
        $this->db->where('notifications.user_id =', $user_id);
        $this->db->where('notifications.action =', $notification_type);
        $this->db->where('notifications.status =', 'Unread');
        $this->db->update('notifications');
        return $messages;
    }

    /**
     * Get details of selected property account
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */
    public function add_notification($user_ids, $title, $message, $action = null, $action_id = null)
    {
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
        } else {
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
    public function get_licenses($agent_id, $status = null)
    {
        $this->db->from('licenses');
        if ($status) {
            $this->db->where('licenses.license_status =', $status);
        } else {
            $this->db->where('licenses.license_status !=', 'Removed');
        }
        $this->db->where("agent_id =", $agent_id);
        $this->db->order_by('licenses.license_id DESC');

        $records = $this->db->get()->result_array();
//  		echo $this->db->last_query();exit();
        return $records;
    }

    /**
     * Get details of selected administrator account
     *
     * @param integer $admin_id ID of system administrator to return
     * @return array Administrator details
     */
    public function get_license($agent_id, $license_id)
    {
        $record = $this->db->from('licenses')->where("agent_id =", $agent_id)->where("license_id =", $license_id)->get()->row_array();
        return $record;
    }


    /**
     * Add new admin account
     *
     * @param array $data Details of admin account
     * @return boolean true|false
     */
    public function add_license($data)
    {
        $this->db->insert('licenses', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Add new admin account
     *
     * @param array $data Details of admin account
     * @return boolean true|false
     */
    public function edit_license($license_id, $data)
    {
        $this->db->update('licenses', $data, "license_id = '" . $license_id . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    /**
     * Lists of clients with details
     *
     * @return array List of clients with details
     */
    public function get_my_licenses($agent_id)
    {
        $this->db->from('licenses');
        $this->db->where('licenses.license_status !=', 'Removed');
        $this->db->where("agent_id =", $agent_id);
        $this->db->order_by('licenses.license_id DESC');

        $records = $this->db->get()->result_array();
        if ($records) {
            $return['no_active_license'] = true;
            foreach ($records as $record) {
                if ($record['license_status'] == 'Active') {
                    $return['no_active_license'] = false;
                    if ($record['license_expire'] > time()) {
                        if ($record['interested'] == 'Both') {
                            $return['license_states'][$record['license_state']] = true;
                            $return['active_states']['Residential'][] = $record['license_state'];
                            $return['active_states']['Commercial'][] = $record['license_state'];
                            $return['interested'][$record['license_state']]['Residential'] = true;
                            $return['interested'][$record['license_state']]['Commercial'] = true;
                        } else {
                            $return['license_states'][$record['license_state']] = true;
                            $return['active_states'][$record['interested']][] = $record['license_state'];
                            $return['interested'][$record['license_state']][$record['interested']] = true;
                        }
                    } else {
                        $return['expired_license'] = true;
                        $return['expired_states'][] = $record['license_state'];
                    }
                } elseif ($record['license_status'] == 'Pending') {
                    $return['no_active_license'] = false;
                    $return['pending_license'] = true;
                    $return['pending_states'][] = $record['license_state'];

                } elseif ($record['license_status'] == 'Declined') {
                    $return['no_active_license'] = false;
                    $return['declined_license'] = true;
                    $return['declined_states'][] = $record['license_state'];
                } else {
                    $return['expired_license'] = true;
                    $return['expired_states'][] = $record['license_state'];
                }
            }
        } else {
            $return['no_license'] = true;
        }
        if ($return['expired_states']) {
            $expired_states = array_merge(array_flip(array_flip($return['expired_states'])));
            $return['expired_states'] = $expired_states;
        }
        return $return;
    }

    /**
     * Get details of selected agent account
     *
     * @param integer $agent_id ID of system agent to return
     * @return array Agent details
     */
    public function get_terms_of_service()
    {
        $record = $this->db->from('tos_pages')->where("user_type =", 'Agent')->get()->row_array();
        return $record['page_content'];
    }


    public function get_plan($anget_Id)
    {
        $record = $this->db->select('plan_id')->from('agents')->where("agent_id =", $anget_Id)->get()->row_array();
        return $record;
    }

    public function unsubscribe_plan($plan_id, $user_id)
    {
        $this->db->set('plan_id', NULL);
        $this->db->where('agent_id ', $user_id);
        $this->db->update('agents');


        $this->db->delete('save_premium_listing', array('agent_id' => $user_id));

        $this->db->set('plan_id', NULL);
        $this->db->where('agent_id ', $user_id);
        $this->db->where('offer_limit ', 0);
        $this->db->where('win_limit ', 0);
        $this->db->where('win_remain ', 0);
        $this->db->where('offer_remain ', 0);
        $this->db->update('agents');

        $this->db->set('status', 3);
        $this->db->where('user_id', $user_id);
        $this->db->where('plan_id', $plan_id);
        return $this->db->update('subscription_tbl');

    }

    public function membership_plans($plan_id)
    {

        if (isset($plan_id['plan_id']) && $plan_id['plan_id'] > 0) {
            $record = $this->db->from('member_ship_plans')->where('id <>', $plan_id['plan_id'])->get()->result_array();

        } else {
            $record = $this->db->from('member_ship_plans')->get()->result_array();

        }
        return $record;
    }

    public function getAllFeatures($id)
    {

        $this->db->select('plan_features.*');
        $this->db->join('plan_feature', 'plan_feature.feature_id = plan_features.id');
        $this->db->from('plan_features');
        $this->db->where("plan_feature.plan_id =", $id);
        return $records = $this->db->get()->result_array();


    }


    public function getselectedAllFeatures($agent_id, $plan_id)
    {

        $this->db->select('subscription_items.*');
        $this->db->join('subscription_tbl', 'subscription_tbl.id = subscription_items.subscription_id');
        $this->db->from('subscription_items');
        $this->db->where("subscription_tbl.status =", 1);
        $this->db->where("subscription_tbl.plan_id =", $plan_id);
        $this->db->where("subscription_tbl.user_id =", $agent_id);
        return $records = $this->db->get()->result_array();


    }

    public function planTitle($id)
    {
        $this->db->select('id,title');
        $this->db->from('member_ship_plans');
        $this->db->where("id =", $id);
        $records = $this->db->get()->row_array();

        return $records['title'];
    }

    public function getPlanPrice($id)
    {

        $this->db->select('SUM(plan_features.price) as price');
        $this->db->join('plan_feature', 'plan_feature.feature_id = plan_features.id');
        $this->db->from('plan_features');
        $this->db->where("plan_feature.plan_id =", $id);
        $records = $this->db->get()->row_array();
        return $records['price'];

    }


    public function set_member_plan($plan_id, $user_id)
    {
        $this->db->set('plan_id', $plan_id);
        $this->db->where('agent_id ', $user_id);
        $this->db->update('agents');
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function get_specializations()
    {
        $record = $this->db->from('specializations')->get()->result_array();
        return $record;
    }

    public function get_specializations_for_agent($agent_id)
    {
        $record = $this->db->from('agent_specializations')->where('agent_id =', $agent_id)->get()->result_array();
        return $record;
    }

    public function delete_specializations_for_agent($agent_id)
    {
        $this->db->delete('agent_specializations', array('agent_id' => $agent_id));
    }

    public function add_specializations_for_agent($agent_id, $specializations)
    {
        foreach ($specializations as $special) {
            $this->db->insert('agent_specializations', ['agent_id' => $agent_id, 'specialization_id' => $special]);
        }
    }

    public function get_agent_specializations($agent_id)
    {
        $records = array();
        $this->db->select('subscription_tbl.*');
        $this->db->from('subscription_tbl');
        $this->db->like('featture_enabled', 'specializations', 'both');
        $this->db->where('user_id', $agent_id);
        $this->db->where('status', 1);
        $record = $this->db->get()->row_array();

        if (isset($record['id']) && !empty($record['id'])) {
            $this->db->select('specializations.*');
            $this->db->from('specializations');
            $this->db->join('agent_specializations', 'agent_specializations.specialization_id = specializations.id');
            $this->db->where('agent_specializations.agent_id =', $agent_id);
            $records = $this->db->get()->result_array();
            //  		echo $this->db->last_query();exit();

        }
        return $records;
    }

    public function get_agent_slot_list($request, $agent_id)
    {
        $search = $request['search']['value']; // Search value
        $start = $request['start'];
        $rowperpage = $request['length']; // Rows display per page
        $columnIndex = $request['order'][0]['column']; // Column index
        $columnName = $request['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $request['order'][0]['dir']; // asc or desc

        $this->db->select('agent_available_slots.*');
        $this->db->from('agent_available_slots');
        $this->db->where('agent_id =', $agent_id);
        if (isset($search) && $search !== '') {
            $this->db->like('week_day', $search, 'both');
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $agent_slots = $this->db->get()->result_array();
        return $agent_slots;
    }

    public function get_total_agent_slot_list($agent_id, $search)
    {
        $this->db->select('agent_available_slots.*');
        $this->db->from('agent_available_slots');
        $this->db->where('agent_id =', $agent_id);
        if (isset($search) && $search !== '') {
            $this->db->like('week_day', $search, 'both');
        }
        $records = $this->db->get();
        return $records->num_rows();
    }

    public function save_agent_slots($request, $agent_id)
    {
        $daysString = preg_replace('/\s+/', '', $request['week-selection']);
        $daysArray  = explode("," ,$daysString );

        $existingDate = array();
        $existingTime = array();
        foreach ($daysArray as $day)
        {
            $data = array(
                'agent_id' => $agent_id,
                'week_day' => $day,
                'slot_time' => $request['time']
            );

            $this->db->from('agent_available_slots');
            $this->db->where('week_day =', $day);
            $this->db->where('slot_time =', $request['time']);
            $record = $this->db->get()->row_array();
            if (count($record) > 0)
            {
                $existingDate[] = $record["week_day"];
                $existingTime[] = $record["slot_time"];
               // return false;
            }else{
                $this->db->insert('agent_available_slots', $data);
            }
        }
        $existingDateTime = array();

        if(count($daysArray) == count($existingDate) )
        {
            $existingDateTime['fail'] = ["data" => "AllSaved"];
            return json_encode($existingDateTime);
        }

        if(count($existingDate) >  0)
        {
            $existingDateTime['existingDate'] =  $existingDate;
            $existingDateTime['existingTime'] =  $existingTime;
            return json_encode($existingDateTime);

        }else{
            $existingDateTime['dataSaved'] = ["data" => "AllSaved"];
            return json_encode($existingDateTime);

        }


//        return true;

//        $getDateTime = explode(" ", $request['week-selection'] );
//        $this->db->from('agent_available_slots');
//        $this->db->where('week_day =', $getDateTime[0]);
//        $this->db->where('slot_time =', $getDateTime[1]);
//        $records = $this->db->get()->result_array();
//        $date = date('h:i:s', $request['time']);
//        if (count($records) > 0) {
//            return false;
//        } else {
//            $this->db->insert('agent_available_slots', $data);
//        }
    }

    public function agent_slot_edit($id)
    {
        $this->db->from('agent_available_slots');
        $this->db->where("id =", $id);
        return $this->db->get()->result_array();
    }

    public function agent_slot_deleted($request)
    {
        $this->db->delete('agent_available_slots', array('id' => $request['id']));
        return true;
    }

    public function update_agent_slots($request)
    {
        $this->db->select('agent_available_slots.*');
        $this->db->from('agent_available_slots');
        $this->db->where('week_day', $request['week-selection']);
        $this->db->where('slot_time', $request['time']);
        $this->db->where('agent_id', $request['agent_id']);
        $result = $this->db->get()->num_rows();
        if($result > 0 ){
            return false;
        }
        $data = array(
            'week_day' => $request['week-selection'],
            'slot_time' => $request['time'],
        );
        $this->db->where('id', $request['id']);
        $this->db->update('agent_available_slots', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    function saveReviewForm($data)
    {
        $this->db->insert('reviews', $data);
        return true;
    }

    public function get_appointments($request, $agent_id)
    {
        $start = date('m/d/Y', $request['start']);
        $end = date('m/d/Y', $request['end']);
        $customers_appointments_array = array();
        $this->db->select('appointments.*, sellers.*');
        $this->db->from('appointments');
        $this->db->join('sellers', 'appointments.customer_id = sellers.seller_id');
        $this->db->where('appointments.agent_id =', $agent_id);
        $this->db->where("DATE(meet_date) >= '$start'");
        $this->db->where("DATE(meet_date) <= '$end'");
        $customers_appointments_array[] = $this->db->get()->result_array();

        $this->db->select('appointments.*, buyers.*');
        $this->db->from('appointments');
        $this->db->join('buyers', 'appointments.customer_id = buyers.buyer_id');
        $this->db->where('appointments.agent_id =', $agent_id);
        $this->db->where("DATE(meet_date) >= '$start'");
        $this->db->where("DATE(meet_date) <= '$end'");
       return $customers_appointments_array[] =  $this->db->get()->result_array();
    }

    public function couponAmount($coupon)
    {
        $this->db->select('coupons.coupon_id, coupons.coupon_type ,coupons.coupon_code, coupons.coupon_amount');
        $this->db->from('coupons');
        $this->db->where("coupon_code = ", $coupon['coupon']);
        return $record = $this->db->get()->row_array();
    }


    public function selectedPlan($plan_id)
    {
        $this->db->select('member_ship_plans.id, member_ship_plans.title, member_ship_plans.details, subscription_tbl.id as did');
        $this->db->join('subscription_tbl', 'member_ship_plans.id  = subscription_tbl.plan_id');
        $this->db->where('subscription_tbl.status', 1);
        $this->db->from('member_ship_plans');
        $this->db->where('member_ship_plans.id = ', $plan_id['plan_id']);
        return $records = $this->db->get()->row_array();

    }

    public function get_seller_info($seller_id)
    {
        $this->db->select('accounts.email');
        $this->db->from('accounts');
        $this->db->where('accounts.id = ', $seller_id);
        return $records = $this->db->get()->row_array();
    }


    public function getSellerName($seller_id)
    {
        $this->db->select('sellers.first_name, sellers.last_name');
        $this->db->from('sellers');
        $this->db->where('sellers.seller_id  = ', $seller_id);
        return $records = $this->db->get()->row_array();
    }

    public function get_questions()
    {

        $query = $this->db->get("questions");
        return $query->result_array();
    }


    function getAllQuestionChoices($id)
    {
        $this->db->select('question_choices.*');
        $this->db->from('question_choices');
        $this->db->where('question_id', $id);
        return $records = $this->db->get()->result_array();

    }


    function saveServeyForm($data)
    {
        $this->db->insert('survey', $data);
        return true;
    }

    function savePremiumSearchQuery($data, $agent_id)
    {
        $this->db->where('agent_id', $agent_id);
        $this->db->where('status_price <>', 'Canceled');
        $this->db->update('save_premium_listing', $data);
        return true;
    }

    function displaySearchQueryRecords($id)
    {
        // $query = $this->db->query("select * from save_premium_listing");
        // return $query->result();
        $this->db->select('save_premium_listing.*');
        $this->db->from('save_premium_listing');
        $this->db->where('save_premium_listing.agent_id = ', $id);

        return $this->db->get()->result_array();
    }

    function deletePremiumSearchQuery($id)
    {
        $query = "DELETE FROM `save_premium_listing` WHERE id=$id";
        $this->db->query($query);
    }


    public function checkSurvey($user_id)
    {
        $this->db->from('survey');
        $this->db->where('account_id', $user_id);
        return $records = $this->db->get()->row_array();
    }


    public function checkAttributes($user_id)
    {
        $this->db->from('users_attributes');
        $this->db->where('user_id', $user_id);
        return $records = $this->db->get()->row_array();
    }


    public function addAgentStripId($sessionChecked, $customer_id)
    {

        $this->db->select('agents.*');
        $this->db->from('agents');
        $this->db->where('agents.agent_id = ', $sessionChecked['user_id']);
        $this->db->where('agents.stripe_id = ', NULL);

        $records = $this->db->get()->row_array();
        if (isset($records['agent_id']) && $records['agent_id'] !== '') {
            $data = array('stripe_id' => $customer_id);
            $this->db->update('agents', $data, "agent_id = '" . $sessionChecked['user_id'] . "'");
        }

        return true;


    }

    public function cardsList($agent_id)
    {
        $this->db->select('brand, intent ,last_digit, card');
        $this->db->from('credit_cards');
        $this->db->where('credit_cards.card <> ', NULL);
        $this->db->or_where('credit_cards.intent <>', NULL);
        $this->db->where('credit_cards.agent_id = ', $agent_id);
        return $records = $this->db->get()->result_array();

    }

    public function getcardsList($agent_id)
    {
        $this->db->from('credit_cards');
        $this->db->where('credit_cards.agent_id', $agent_id);
        return $records = $this->db->get()->result_array();

    }


    public function update_credit_card($seti, $source)
    {
        $data = array('card' => $source);
        return $this->db->update('credit_cards', $data, "intent = '" . $seti . "'");
    }


    public function getAgentInformation($id)
    {
        $this->db->select('agents.*');
        $this->db->from('agents');
        $this->db->where('agent_id = ', $id);

        return $records = $this->db->get()->row_array();
    }


    public function get_attributes()
    {
        $this->db->select('match_making_attributes.*');
        $this->db->from('match_making_attributes');
        return $records = $this->db->get()->result_array();


    }


    public function getAllSelectAttributes($user_id)
    {
        $this->db->select('attribute_id');
        $this->db->from('users_attributes');
        $this->db->where('user_id', $user_id);
        return $records = $this->db->get()->result_array();
    }


    public function testing()
    {
        $sql = "SELECT * FROM agents 
		dsaWHERE agent_id IN ( select user_id from users_attributes)";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        exit;
    }

    public function checkPlanExpiry($user_id)
    {

        $this->db->select('created_at');
        $this->db->from('subscription_tbl');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $records = $this->db->get()->row_array();
        $subscriptionDate = $records['created_at'];
        $subscriptionDate = strtotime("+1 month", strtotime($subscriptionDate));
        $subscriptionDate = date('Y/m/d h:i:s', $subscriptionDate);

        if ($subscriptionDate >= date('Y/m/d h:i:s'))
            return 1;
        else
            return 0;

    }

    public function get_user_type_of_messsage($user_id)
    {
        $this->db->select('messages.*');
        $this->db->from('messages');
        $this->db->where('msg_to', 'Agent');
        $this->db->or_where('seller_id', $user_id);
        $this->db->or_where('agent_id', $user_id);
        $this->db->order_by('message_id', 'desc');
        $record = $this->db->get()->row_array();

        return $record['msg_from'];

    }

    public function get_active_user($user_id)
    {
        $this->db->select('accounts.id, accounts.email , user_type');
        $this->db->from('accounts');
        $this->db->where('id = ', $user_id);
        $this->db->where('active = ', 1);
        $record = $this->db->get()->row_array();

        if (isset($record['user_type'])) {
            return $record['user_type'] .','.$record['email'];
        }

    }

    public function check_save_premium_listing($agent_id, $state, $city)
    {
        $todayDate = date("Y-m-d");
        $this->db->select('save_premium_listing.*');
        $this->db->from('save_premium_listing');
        $this->db->where('agent_id = ', $agent_id);
        $this->db->where('city_id = ', $city);
        $this->db->where('state_id = ', $state);
        $this->db->where('status = ', 1);
        $this->db->where('status_price', 'Paid');
        $this->db->where('save_premium_listing.start_date <=', $todayDate);
        $this->db->where('save_premium_listing.end_date >=', $todayDate);
        $this->db->order_by('save_premium_listing.id', 'desc');
        $record = $this->db->get()->row_array();
        if (isset($record['id']) && $record['id'] > 0) {
            log_message("error", "Find matched id");
            log_message("error", $record['id']);

            return "bg-success";
        }

        return "";
    }

    public function check_save_premium_listing_2($agent_id, $state, $city)
    {
        $todayDate = date("Y-m-d");
        $this->db->select('save_premium_listing.*');
        $this->db->from('save_premium_listing');
        $this->db->where('agent_id = ', $agent_id);
        $this->db->where('city = ', $city);
        $this->db->where('state_name = ', $state);
        $this->db->where('status = ', 1);
        $this->db->where('status_price', 'Paid');
        $this->db->where('save_premium_listing.start_date <=', $todayDate);
        $this->db->where('save_premium_listing.end_date >=', $todayDate);
        $this->db->order_by('save_premium_listing.id', 'desc');
        $record = $this->db->get()->row_array();
        if (isset($record['id']) && $record['id'] > 0) {
            log_message("error", "Find matched id");
            log_message("error", $record['id']);

            return "bg-success";
        }

        return "";
    }

    public function getCities($state_id)
    {
        $this->db->select('cities.*');
        $this->db->from('cities');
        $this->db->where('state_id = ', $state_id);
        $this->db->where('city_status = ', 'Active');
        $this->db->group_by('city_id');
        $this->db->group_by('city_name');
        return $record = $this->db->get()->result_array();


    }

    public function getLicencesStateCities($state_id)
    {
        $this->db->select('cities.*,save_premium_listing.status');
        $this->db->from('cities');
        $this->db->join('save_premium_listing', 'cities.city_id  = save_premium_listing.city_id', 'left');
        $this->db->where('cities.state_id = ', $state_id);
        $this->db->group_by('cities.city_id');
        $this->db->group_by('city_name');
        return $record = $this->db->get()->result_array();
    }

    public function getAllCities($stateName)
    {
        $this->db->select('state_costs.*');
        $this->db->from('state_costs');
        $this->db->where('state = ', $stateName);
        $record = $this->db->get()->row_array();

        $this->db->select('cities.*');
        $this->db->from('cities');
        $this->db->where('state_id = ', $record['state_id']);
        $this->db->where('city_status = ', 'Active');
        $this->db->group_by('city_id');
        $this->db->group_by('city_name');
        return $record = $this->db->get()->result_array();

    }


    public function getAgentstates($agent_id)
    {
        $this->db->select('state_costs.state_id, assign_agents_to_states.state');
        $this->db->from('assign_agents_to_states');
        $this->db->join('state_costs', "state_costs.state = assign_agents_to_states.state");
        $this->db->join('licenses', 'state_costs.state = licenses.license_state');
        $this->db->where('state_costs.state_status', 'Active');
        $this->db->where('licenses.agent_id', $agent_id);
        $this->db->where('licenses.license_status', 'Active');
        //$this->db->where('assign_agents_to_states.number_of_agent > (select count(distinct(spl.agent_id)) from save_premium_listing spl where spl.start_date >= current_date() and spl.state_name = assign_agents_to_states.state)');
        $this->db->group_by('state_costs.state');
        return $data = $this->db->get()->result_array();

    }

    public function getAgentBundlestates($agent_id)
    {
        $this->db->select('state_costs.state_id, assign_agents_to_states.state , pay_for_spot.id, pay_for_spot.title, pay_for_spot.durattion_days, pay_for_spot.per_day_price');
        $this->db->from('assign_agents_to_states');
        $this->db->join('state_costs', "state_costs.state = assign_agents_to_states.state");
        $this->db->join('pay_for_spot', 'pay_for_spot.state = assign_agents_to_states.state', 'left');
        $this->db->join('licenses', 'pay_for_spot.state = licenses.license_state');
        $this->db->where('state_costs.state_status', 'Active');
        $this->db->where('licenses.agent_id', $agent_id);
        $this->db->where('licenses.license_status', 'Active');
        // $this->db->where('assign_agents_to_states.number_of_agent > (select count(distinct(spl.agent_id)) from save_premium_listing spl where spl.start_date >= current_date() and spl.state_name = assign_agents_to_states.state)');
        //$this->db->group_by('assign_agents_to_states.id');
        return $data = $this->db->get()->result_array();
    }

    /**
     * Save Premium Listing
     *
     * @param integer $property_id ID of system property to return
     * @return array Property details
     */

    public function saveCustomPremiumListing($request, $agent_id)
    {
        if(isset($request['order_id']) && $request['order_id'] !== '')
        {
            $this->db->delete('save_premium_listing', array('order_id' => $request['order_id']));
        }

        $date_range = explode("-", $request['date_range']);
//        $cities =   implode(",", $request['city_id']);

        $earlier = new DateTime($date_range[0]);
        $later = new DateTime($date_range[1]);

        $days_dif = $later->diff($earlier)->format("%a"); //3


        $days_diff = ++$days_dif;

        $this->db->select('state_costs.state_id, assign_agents_to_states.per_day_price');
        $this->db->from('state_costs');
        $this->db->join('assign_agents_to_states', 'state_costs.state = assign_agents_to_states.state');
        $this->db->where('state_costs.state_id', $request['state_id']);
        $record = $this->db->get()->row_array();

        $this->db->from('state_costs');
        $this->db->where('state_id', $request['state_id']);
        $state_name = $this->db->get()->row_array();

        $CustomizePrice = $record['per_day_price'] * $days_diff;
        $totalPrice = number_format($CustomizePrice, 2, ".", ",");
        $time = time();

        $ciies = $request['city_id'];

        foreach ($ciies as $city_id) {

            $city = $this->getCityName($city_id);

            $data = array(
                'type' => $request['type'],
                'order_id' => $time,
                'agent_id' => $agent_id,
                'bundle_id' => null,
                'start_date' => date('Y-m-d', strtotime($date_range[0])),
                'end_date' => date('Y-m-d', strtotime($date_range[1])),
                'date_range' => $request['date_range'],
                'count_date_range_days' => $days_diff,
                'state_id' => $request['state_id'],
                'state_name' => $state_name['state'],
                'city_id' => $city_id,
                'city' => $city,
                'price' => $totalPrice,
                'status' => 1,
            );


            $this->db->insert('save_premium_listing', $data);

            $premium_listing_id = $this->db->insert_id();

            $data2 = array(
                "premium_listing_id" => $premium_listing_id,
                'agent_id' => $agent_id,
                'date_range' => $request['date_range'],
                'city_id' => $city,
                'state_id' => $request['state_id'],

            );
            $this->db->insert('premium_cities', $data2);

        }


        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function saveBundlePremiumListing($request, $agent_id)
    {
        if(isset($request['order_id']) && $request['order_id'] !== '')
        {
            $this->db->delete('save_premium_listing', array('order_id' => $request['order_id']));
        }
        $date_range = explode("-", $request['date_range2']);
//        $cities =   implode(",", $request['city_id']);

        $earlier = new DateTime($date_range[0]);
        $later = new DateTime($date_range[1]);

        $days_dif = $later->diff($earlier)->format("%a"); //3


        $days_diff = ++$days_dif;

//        $cities =   implode(",", $request['city_id']);
        $this->db->from('pay_for_spot');
        $this->db->where('id', $request['bundle_id']);
        $record = $this->db->get()->row_array();

        $this->db->from('state_costs');
        $this->db->where('state', $record['state']);
        $state = $this->db->get()->row_array();

        $startDay = date("Y-m-d");
        $duration_days = $record['durattion_days'];
        $days = $duration_days - 1;

        $endDate = date('Y-m-d', strtotime($startDay . ' + ' . $days . ' days'));
        $data_range = date('m/d/Y', strtotime($startDay)) . " - " . date('m/d/Y', strtotime($endDate));

        $type = preg_replace('/\s+/', ' ', $request['type']);

        $city_id = $request['city_id'];
        $time = time();

        $ciies = $request['city_id'];

        foreach ($ciies as $city_id) {
            $city = $this->getCityName($city_id);


            $data = array(
                'type' => $type,
                'order_id' => $time,
                'agent_id' => $agent_id,
                'bundle_id' => $request['bundle_id'],
                'start_date' => date('Y-m-d', strtotime($date_range[0])),
                'end_date' => date('Y-m-d', strtotime($date_range[1])),
                'date_range' => $request['date_range2'],
                'count_date_range_days' => $days_diff,
                'state_id' => $state['state_id'],
                'state_name' => $state['state'],
                'city_id' => $city_id,
                'city' => $city,
                'price' => $record['per_day_price'],
                'status' => 1,
            );

            $this->db->insert('save_premium_listing', $data);


            $premium_listing_id = $this->db->insert_id();

            $data2 = array(
                "premium_listing_id" => $premium_listing_id,
                'agent_id' => $agent_id,
                'date_range' => $request['date_range'],
                'city_id' => $city,
                'state_id' => $request['state_id'],

            );
            $this->db->insert('premium_cities', $data2);
        }

        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function getCityName($city_id)
    {
        $this->db->select('city_name');
        $this->db->where('city_id', $city_id);
        $this->db->from('cities');
        $records = $this->db->get()->row_array();
        return $records['city_name'];
    }

    public function premiumlisting($agent_id)
    {
        $this->db->select('save_premium_listing.*, pay_for_spot.title');
        $this->db->from('save_premium_listing');
        $this->db->join('pay_for_spot', 'save_premium_listing.bundle_id = pay_for_spot.id', 'left');
        $this->db->where('agent_id', $agent_id);
//        $this->db->group_by('save_premium_listing.id');
        $this->db->order_by('save_premium_listing.date_range' , 'DESC');
        $this->db->group_by('save_premium_listing.date_range');
        $this->db->group_by('save_premium_listing.type');
        $this->db->group_by('save_premium_listing.id');
        $records = $this->db->get()->result_array();
        $data = array();
        foreach ($records as $record) {
            $data [] = array(

                'id' => $record['id'],
                'order_id' => $record['order_id'],
                'agent_id' => $record['agent_id'],
                'state_id' => $record['state_id'],
                'type' => $record['type'],
                'title' => $record['title'],
                'dateRange' => $record['date_range'],
                'state' => getStateName($record['state_id']),
                'city' => getCitiesName($record['agent_id'], $record['state_id'], $record['date_range'], $record['type'], $record['status_price']),
                'price' => $record['price'],
                'status_price' => $record['status_price'],

            );
        }


        return $data;
    }

    public function deletePremiumRecord($agent_id, $state_id, $date_range)
    {
        if ($agent_id) {
            $this->db->delete('save_premium_listing', array('agent_id' => $agent_id, 'state_id' => $state_id, 'date_range' => $date_range));
            $this->db->delete('premium_cities', array('agent_id' => $agent_id, 'state_id' => $state_id, 'date_range' => $date_range));

        }
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function previousUnpaidRecords($agent_id)
    {
        $currentDate = date('Y-m-d');

        $this->db->select('save_premium_listing.*');
        $this->db->from('save_premium_listing');
        $this->db->where('start_date < ', $currentDate);
        $this->db->where('status_price', 'Unpaid');
        $this->db->where('agent_id', $agent_id);

        $records = $this->db->get()->result_array();

        if (isset($records) && count($records) > 0) {

            $premiumIds = [];
            foreach ($records as $record) {
                $premiumIds[] = $record['id'];
            }

            $this->db->select('premium_cities.*');
            $this->db->from('premium_cities');
            $this->db->where_in('premium_listing_id', $premiumIds);
            $cityRecords = $this->db->get()->result_array();

            $premiumCityIds = [];
            foreach ($cityRecords as $record) {
                $premiumCityIds[] = $record['id'];
            }

            $this->db->where_in('id', $premiumIds);
            $this->db->delete('save_premium_listing');

            $this->db->where_in('id', $premiumCityIds);
            $this->db->delete('premium_cities');

            return ($this->db->affected_rows() >= 0) ? true : false;

        }

    }

    public function getCounterNumberOfAgents($state_id)
    {

//        $this->db->select('id, state_name');
//        $this->db->from('save_premium_listing');
//        $this->db->where('state_id', $state_id);
//        $count = $this->db->get()->num_rows();


        $this->db->select('state_name');
        $this->db->from('save_premium_listing');
        $this->db->where('state_id', $state_id);
        $data = $this->db->get()->row_array();


        $this->db->select('assign_agents_to_states.*');
        $this->db->from('assign_agents_to_states');
        $this->db->where('state', $data['state_name']);

        $data2 = $this->db->get()->row_array();

        if ($data2['number_of_agent'] < $count) {
            $response['error'] = "error";
            $response['title'] = "For this state Num";

        }

    }

    public function delete_city($request)
    {
        $city_id = $request['city_id'];
        $state_id = $request['state_id'];
        $agent_id = $request['agent_id'];
        $date_range = $request['date_range'];

        $this->db->delete('save_premium_listing', array('city_id' => $city_id, 'state_id' => $state_id, 'agent_id' => $agent_id, "date_range" => $date_range));
        $this->db->delete('premium_cities', array('agent_id' => $agent_id, 'state_id' => $state_id, 'city_id' => $city_id, "date_range" => $date_range));


        if ($this->db->affected_rows() >= 0) {
            $response['success'] = 'success';
            $response['title'] = 'Record deteleted successfully';
            return $response;

        }

    }

    public function account_isApproved($id)
    {
        $this->db->select('approval');
        $this->db->from('accounts');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();

    }

    public function get_reviewed($id)
    {
        $this->db->select('reviews.*');
        $this->db->from('reviews');
        $this->db->where('agent_id', $id);
        $this->db->where('status', 1);
        return $records = $this->db->get()->result_array();
    }

    public function setNotification($request, $agent_id)
    {

        $save = null;
        if($request['notification'] == 'true')
        {
            $save = 'Yes';
        }
        else{
            $save = "No";
        }
        $data = array('notifications' => $save );
        $this->db->where('agent_id', $agent_id);
        $this->db->update('agents', $data);

        return ($this->db->affected_rows() >= 0 ) ? true : false;
    }

    public function getSelectedRecord($request)
    {
        $this->db->select('save_premium_listing.*');
        $this->db->from('save_premium_listing');
        $this->db->where('agent_id', $request['agent_id']);
        $this->db->where('order_id', $request['order_id']);
        return $records = $this->db->get()->result_array();
    }

    public function selected_week_days($id)
    {
        $this->db->select('agent_available_slots.week_day');
        $this->db->from('agent_available_slots');
        $this->db->where('agent_id', $id);
        $this->db->where('slot_time <> (select slot_time)');
        return $records = $this->db->get()->result_array();
    }

    public function update_agent_day($request)
    {
        $this->db->select('agent_available_slots.week_day');
        $this->db->from('agent_available_slots');
        $this->db->where('agent_id', $request['agent_id']);
        $this->db->where('week_day', $request['selectDay']);
        return $records = $this->db->get()->row_array();
    }



    public function getCouponsList()
    {
        $this->db->select('coupons.*');
        $this->db->from('coupons');
        $this->db->where('coupon_status', 'Active');
        return $records['coupons'] = $this->db->get()->result_array();
    }

    public function get_coupon_discount($agent_Id)
    {
        $this->db->select('agent_coupons.*');
        $this->db->from('agent_coupons');
        $this->db->where('agent_coupons.agent_id', $agent_Id);
        $this->db->where('agent_coupons.coupon_used', 'No');
        $this->db->order_by('agent_coupons.use_order', 'asc');
        return $this->db->get()->row_array();
    }


    public function get_agent_coupons($agent_Id)
    {
        $this->db->select('agent_coupons.*');
        $this->db->from('agent_coupons');
        $this->db->where('agent_coupons.agent_id', $agent_Id);
        $this->db->where('agent_coupons.coupon_used', 'No');
        $this->db->order_by('agent_coupons.use_order', 'asc');
        return $this->db->get()->result_array();
    }

    public function updateCouponStatus($coupon)
    {
        $data = array(
            'used_on' => time(),
            'coupon_used' => 'Yes'
        );
        $this->db->update('agent_coupons', $data, "coupon_code = '" . $coupon['coupon'] . "'");
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function get_offer_remains($id)
    {
        $this->db->select('agents.offer_remain');
        $this->db->from('agents');
        $this->db->where('agent_id', $id);
        return $records['offer_remain'] = $this->db->get()->row_array();
    }

    public function get_agreement_property($agent_id, $seller_id, $prop_id)
    {
        $this->db->select('agreements.*');
        $this->db->from('agreements');
        $this->db->where('agent_id', $agent_id);
        $this->db->where('seller_id', $seller_id);
        $this->db->where('prop_id', $prop_id);
        return $record = $this->db->get()->row_array();
    }

    public function update_agreement_property($agr_id, $fee_amount = '', $coupon_type, $agentId, $sellerid,$propertyid)
    {

        if($fee_amount == '')
        {
            $this->db->select('agreements.*');
            $this->db->from('agreements');
            $this->db->where('agr_id', $agr_id);
            $this->db->where( 'agent_id' ,$agentId);
            $this->db->where( 'seller_id' ,$sellerid);
            $this->db->where( 'prop_id' ,$propertyid);
            $record = $this->db->get()->row_array();

            $fee_amount = $record['original_fee'];
        }
        $data = array(
            "agr_fee" => $fee_amount,
            "payment_status" => "Completed",
            "agr_status" => "Completed"
        );
        $this->db->where('agr_id', $agr_id);
        $this->db->where( 'agent_id' ,$agentId);
        $this->db->where( 'seller_id' ,$sellerid);
        $this->db->where( 'prop_id' ,$propertyid);
        $this->db->update('agreements', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;

    }

    public function update_account($data, $agent_id)
    {
        $this->db->where( 'id' ,$agent_id);
        $this->db->update('accounts', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function pay_property_payment($agent_id, $agr_id)
    {
        $time = time();
        $this->db->select('agreements.*, CONCAT(sellers.first_name, " ", sellers.last_name) AS seller, properties.property_id, properties.default_image, properties.type, properties.building_size, properties.address, properties.unit, properties.city, properties.state, proposals.commission_rate, proposals.contract_length');
        $this->db->from('agreements');
        $this->db->join('proposals', 'agreements.prop_id = proposals.prop_id');
        $this->db->join('properties', 'proposals.property_id = properties.property_id');
        $this->db->join('sellers', 'agreements.seller_id = sellers.seller_id', 'left');
        $this->db->where('agreements.agent_id =', $agent_id);
        $this->db->where("agreements.agr_id", $agr_id);

        if ($filter['status']) {
            $this->db->where_in('agreements.agr_status', $filter['status']);
        }
        $this->db->order_by('agreements.agr_id DESC');

        $aggrements = $this->db->get()->row_array();


//  		echo $this->db->last_query();exit();
        return $aggrements;
    }

    public function update_coupon_Status($coupon_code)
    {
        $data = array(
            "coupon_used" => "Yes"
        );
        $this->db->where( 'coupon_code' ,$coupon_code);
        $this->db->update('agent_coupons', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }


    public function agent_coupon_discount($agent_Id, $coupon_code)
    {
        $this->db->select('agent_coupons.*');
        $this->db->from('agent_coupons');
        $this->db->where('agent_coupons.agent_id', $agent_Id);
        $this->db->where('agent_coupons.coupon_code',$coupon_code);
        return $this->db->get()->row_array();
    }

    public function updateaccepttos($id)
    {
        $data = array(
            "accept_tos" => time()
        );
        $this->db->where('agent_id', $id);
        $this->db->update('agents', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;

    }

    public function trial_plan_info($user_id)
    {
        $this->db->select('invoices.payment_type');
        $this->db->from('invoices');
        $this->db->where('invoices.agent_id', $user_id);
        return $this->db->get()->row_array();
    }

}