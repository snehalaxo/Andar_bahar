<?php
class Setting extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_model');
    }

    public function index()
    {
        $data = [
            'title' => 'Setting',
            'Setting' => $this->Setting_model->Setting()
        ];

        template('setting/index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Setting',
            'Setting' => $this->Setting_model->Setting(),
        ];

        template('setting/edit', $data);
    }

    public function update()
    {
        $referral_amount = $this->input->post('referral_amount');
        $level_1 = $this->input->post('level_1');
        $level_2 = $this->input->post('level_2');
        $level_3 = $this->input->post('level_3');
        $contact_us = $this->input->post('contact_us');
        $terms = $this->input->post('terms');
        $privacy_policy = $this->input->post('privacy_policy');
        $help_support = $this->input->post('help_support');
        $default_otp = $this->input->post('default_otp');
        $game_for_private = $this->input->post('game_for_private');
        $app_version = $this->input->post('app_version');
        $joining_amount = $this->input->post('joining_amount');
        $admin_commission = $this->input->post('admin_commission');
        $whats_no = $this->input->post('whats_no');
        $bonus = $this->input->post('bonus');
        $payment_gateway = $this->input->post('payment_gateway');
        $symbol = $this->input->post('symbol');
        $razor_api_key = $this->input->post('razor_api_key');
        $razor_secret_key = $this->input->post('razor_secret_key');
        $share_text = $this->input->post('share_text');
        $bank_detail_field = $this->input->post('bank_detail_field');
        $adhar_card_field = $this->input->post('adhar_card_field');
        $upi_field = $this->input->post('upi_field');

        $UpdateProduct = $this->Setting_model->update($referral_amount, $level_1, $level_2, $level_3, $contact_us, $terms, $privacy_policy, $help_support, $default_otp, $game_for_private, $app_version, $joining_amount, $admin_commission,$whats_no,$bonus,$payment_gateway,$symbol,$razor_api_key,$razor_secret_key,$share_text,$bank_detail_field,$adhar_card_field,$upi_field);
        if ($UpdateProduct) {
            $this->session->set_flashdata('msg', array('message' => 'Setting Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/setting');
    }

    public function AdminCoin_log()
    {
        $data = [
            'title' => 'Admin Coin Log',
            'AllTipLog' => $this->Setting_model->AllTipLog(),
            'AllCommissionLog' => $this->Setting_model->AllCommissionLog(),
        ];
        template('setting/AdminCoin_log', $data);
    }
}