<?php

use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Setting_model extends MY_Model
{
    public function Setting()
    {
        $this->db->from('tbl_admin');
        $Query = $this->db->get();
        return $Query->row();
    }

    public function update($referral_amount, $level_1, $level_2, $level_3, $contact_us, $terms, $privacy_policy, $help_support, $default_otp, $game_for_private, $app_version, $joining_amount, $admin_commission, $whats_no, $bonus,$payment_gateway ,$symbol, $razor_api_key, $razor_secret_key, $share_text, $bank_detail_field, $adhar_card_field, $upi_field)
    {
        $data = ['updated_date' => date('Y-m-d H:i:s')];

        if (!empty($referral_amount)) {
            $data['referral_amount'] = $referral_amount;
        }
        if (!empty($level_1)) {
            $data['level_1'] = $level_1;
        }
        if (!empty($level_2)) {
            $data['level_2'] = $level_2;
        }
        if (!empty($level_3)) {
            $data['level_3'] = $level_3;
        }
        if (!empty($contact_us)) {
            $data['contact_us'] = $contact_us;
        }
        if (!empty($terms)) {
            $data['terms'] = $terms;
        }
        if (!empty($privacy_policy)) {
            $data['privacy_policy'] = $privacy_policy;
        }
        if (!empty($help_support)) {
            $data['help_support'] = $help_support;
        }
        if (!empty($default_otp)) {
            $data['default_otp'] = $default_otp;
        }
        if (!empty($game_for_private)) {
            $data['game_for_private'] = $game_for_private;
        }
        if (!empty($app_version)) {
            $data['app_version'] = $app_version;
        }
        if (!empty($joining_amount)) {
            $data['joining_amount'] = $joining_amount;
        }
        if (!empty($admin_commission)) {
            $data['admin_commission'] = $admin_commission;
        }
        if (!empty($whats_no)) {
            $data['whats_no'] = $whats_no;
        }
        // if (!empty($bonus)) {
            $data['bonus'] = $bonus;
        // }
        // if (!empty($payment_gateway)) {
            $data['payment_gateway'] = $payment_gateway;
        // }
        // if (!empty($symbol)) {
            $data['symbol'] = $symbol;
        // }
        if (!empty($razor_api_key)) {
            $data['razor_api_key'] = $razor_api_key;
        }
        if (!empty($razor_secret_key)) {
            $data['razor_secret_key'] = $razor_secret_key;
        }
        if (!empty($share_text)) {
            $data['share_text'] = $share_text;
        }
        if (!empty($bank_detail_field)) {
            $data['bank_detail_field'] = $bank_detail_field;
        }
        if (!empty($adhar_card_field)) {
            $data['adhar_card_field'] = $adhar_card_field;
        }
        if (!empty($upi_field)) {
            $data['upi_field'] = $upi_field;
        }

        if ($this->db->update('tbl_admin', $data))
            return $this->db->last_query();
        else
            return false;
    }

    public function AllTipLog()
    {
        $Query = $this->db->select('tbl_tip_log.*,tbl_users.name')
            ->from('tbl_tip_log')
            ->join('tbl_users', 'tbl_users.id=tbl_tip_log.user_id')
            ->get();
        return $Query->result();
    }

    public function AllCommissionLog()
    {
        $Query = $this->db->select('tbl_game.*,tbl_users.name')
            ->from('tbl_game')
            ->join('tbl_users', 'tbl_users.id=tbl_game.winner_id')
            ->where('tbl_game.winner_id!=', 0)
            ->where('tbl_game.amount!=', 0)
            ->order_by('tbl_game.id', 'DESC')
            ->get();
        return $Query->result();
    }
}