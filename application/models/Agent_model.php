<?php
class Agent_model extends MY_Model
{

    public function AllAgentList()
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('tbl_agent.isDeleted', false);
        $this->db->order_by('tbl_agent.id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }

    public function WelcomeBonus($id = '')
    {
        if (!empty($id)) {
            $this->db->where('id', $id);
        }
        $Query = $this->db->get('tbl_welcome_reward');
        return $Query->result();
    }

    public function WelcomeBonusLog($user_id)
    {
        $this->db->select('*,DATE(added_date) as date');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'desc');
        $Query = $this->db->get('tbl_welcome_log');
        return $Query->result();
    }

    public function AddWelcomeBonus($amount, $user_id)
    {
        $this->db->set('wallet', 'wallet+' . $amount, FALSE);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $user_id);
        $this->db->update('tbl_agent');

        $data = [
            'user_id' => $user_id,
            'coin' => $amount,
            'added_date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tbl_welcome_log', $data);
        return $this->db->insert_id();
    }

    public function UpdateWelcomeBonus($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_welcome_reward', $data);
        return $this->db->affected_rows();
    }

    public function FreeUserList()
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('tbl_agent.isDeleted', false);
        $this->db->where('tbl_agent.table_id', false);
        $this->db->order_by('tbl_agent.id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }

    public function AllRedeemList()
    {
        $this->db->select('tbl_redeem.*,tbl_agent.name');
        $this->db->from('tbl_redeem');
        $this->db->join('tbl_agent', 'tbl_agent.id=tbl_redeem.user_id');
        $this->db->where('tbl_agent.isDeleted', false);
        $this->db->order_by('tbl_redeem.id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }

    public function RedeemList($user_id)
    {
        $this->db->select('id,amount,payment_method,status,reason,added_date');
        $this->db->from('tbl_redeem');
        $this->db->where('isDeleted', false);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }

    public function WinningList($user_id)
    {
        $this->db->from('tbl_game_rewards');
        $this->db->where('isDeleted', false);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }

    public function TodayUserList()
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('tbl_agent.isDeleted', false);
        $this->db->where('date(tbl_agent.created_date)', date("Y-m-d"));
        $Query = $this->db->get();
        return $Query->result();
    }

    public function InsertOTP($MobileNo, $OTP)
    {
        $this->db->where('mobile', $MobileNo);
        $Query = $this->db->get('tbl_otp');
        $OTPRecord = $Query->row();
        if ($OTPRecord) {
            //update otp
            $data = [
                'otp' => $OTP,
                'added_date' => date('Y-m-d H:i:s')
            ];
            $this->db->where('id', $OTPRecord->id);
            if ($this->db->update('tbl_otp', $data)) {
                return $OTPRecord->id;
            } else {
                return FALSE;
            }
        } else {
            //insert otp
            $data = [
                'otp' => $OTP,
                'mobile' => $MobileNo
            ];
            if ($this->db->insert('tbl_otp', $data)) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }

    public function OTPConfirm($Id, $OTP, $MobileNo)
    {
        $this->db->where('id', $Id);
        $this->db->where('otp', $OTP);
        $this->db->where('mobile', $MobileNo);
        $Query = $this->db->get('tbl_otp');
        return $Query->row();
    }

    public function TokenConfirm($user_id, $token)
    {
        $this->db->where('id', $user_id);
        $this->db->where('token', $token);
        $this->db->where('status', 0);
        $this->db->where('isDeleted', 0);
        $Query = $this->db->get('tbl_agent');
        return $Query->row();
    }

    public function UserByMobile($MobileNo)
    {
        $this->db->where('isDeleted', FALSE);
        $this->db->where('mobile', $MobileNo);
        $Query = $this->db->get('tbl_agent');
        return $Query->row();
    }

    public function UpdateUser($UserId, $fcm)
    {
        $data = [
            'fcm' => $fcm
        ];
        $this->db->where('id', $UserId);
        $this->db->update('tbl_agent', $data);
        return $this->db->affected_rows();
    }

    public function Delete($UserId)
    {
        $data = [
            'isDeleted' => 1
        ];
        $this->db->where('id', $UserId);
        $this->db->update('tbl_agent', $data);
        return $this->db->affected_rows();
    }

    public function UpdateAppVersion($UserId, $app_version)
    {
        $data = [
            'app_version' => $app_version
        ];
        $this->db->where('id', $UserId);
        $this->db->update('tbl_agent', $data);
        return $this->db->affected_rows();
    }

    public function UpdateToken($UserId, $token)
    {
        $data = [
            'token' => $token
        ];
        $this->db->where('id', $UserId);
        $this->db->update('tbl_agent', $data);
        return $this->db->affected_rows();
    }

    public function UpdateUserWallet($data, $UserId)
    {
        $this->db->where('id', $UserId);
        $this->db->update('tbl_agent', $data);
        return $this->db->affected_rows();
    }

    public function addAgent($data)
    {
        $this->db->insert('tbl_agent', $data);
        return $this->db->insert_id();
    }

    public function getAdhar($user){
        $this->db->select('*');
        $this->db->where('id', $user);
        $this->db->order_by('id', 'desc');
        $Query = $this->db->get('tbl_agent');
        return $Query->row()->adhar_card;
    }

    public function UpdateUserPic($UserId, $name, $profile_pic = '',$bank_detail,$adhar_card,$upi)
    {
        $data = [
            'name' => $name,
            'bank_detail' => $bank_detail,
            'adhar_card' => $adhar_card,
            'upi' => $upi,
            'updated_date' => date('Y-m-d H:i:s')
        ];

        if(!empty($profile_pic))
        {
            $data['profile_pic'] = $profile_pic;
        }
        $this->db->where('id', $UserId);
        $this->db->update('tbl_agent', $data);
        return $this->db->affected_rows();
    }

    public function ChangeStatus($id, $status)
    {
        $data = [
            'status' => $status
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_agent', $data);

        return $this->db->affected_rows();
    }

    public function RegisterUser($MobileNo, $Name, $profile_pic, $gender = 'm', $token)
    {
        if (empty($profile_pic)) {
            $profile_pic = ($gender == 'f') ? 'f_' . rand(1, 3) . '.png' : 'm_' . rand(1, 10) . '.png';
        }

        $data = [
            'mobile' => $MobileNo,
            'name' => $Name,
            'gender' => $gender,
            'profile_pic' => $profile_pic,
            'token' => $token,
            'added_date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tbl_agent', $data);
        $UserId =  $this->db->insert_id();

        return $UserId;
    }

    public function RegisterUserEmail($Email, $Name, $source, $profile_pic, $gender = 'm', $token)
    {
        if (empty($profile_pic)) {
            $profile_pic = ($gender == 'f') ? 'f_' . rand(1, 3) . '.png' : 'm_' . rand(1, 10) . '.png';
        }

        $data = [
            'email' => $Email,
            'name' => $Name,
            'source' => $source,
            'gender' => $gender,
            'profile_pic' => $profile_pic,
            'token' => $token,
            'added_date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tbl_agent', $data);
        $UserId =  $this->db->insert_id();

        return $UserId;
    }

    public function AddRedeem($data)
    {
        $this->db->insert('tbl_redeem', $data);
        $ReedemId =  $this->db->insert_id();

        $this->db->set('wallet', 'wallet-' . $data['amount'], FALSE);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $data['user_id']);
        $this->db->update('tbl_agent');

        $this->db->set('winning_wallet', 'winning_wallet-' . $amount, FALSE);
        $this->db->where('id', $user_id);
        $this->db->where('winning_wallet>', 0);
        $this->db->update('tbl_agent');

        return $ReedemId;
    }

    public function UpdateWallet($referer_id, $amount, $user_id)
    {
        $this->db->set('referred_by', $referer_id);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $user_id);
        $this->db->update('tbl_agent');

        $this->db->set('wallet', 'wallet+' . $amount, FALSE);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $referer_id);
        $this->db->update('tbl_agent');

        return true;
    }

    public function UpdateWalletOrder($amount, $agent_id)
    {
        $this->db->set('wallet', 'wallet+' . $amount, FALSE);
        $this->db->set('winning_wallet', 'winning_wallet+' . $amount, FALSE);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $agent_id);
        $this->db->update('tbl_agent');
        return true;
    }

    public function WalletLog($amount, $bonus, $agent_id)
    {
        $data = [
            'agent_id' => $agent_id,
            'bonus' => $bonus,
            'coin' => $amount,
            'added_date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tbl_agent_wallet_log', $data);
        return $this->db->insert_id();
    }

    public function View_WalletLog($agent_id)
    {
        $this->db->where('agent_id', $agent_id);
        $Query = $this->db->get('tbl_agent_wallet_log');
        return $Query->result();
    }

    public function TipAdmin($amount, $user_id, $table_id, $gift_id, $to_user_id)
    {
        $this->db->set('wallet', 'wallet-' . $amount, FALSE);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $user_id);
        $this->db->update('tbl_agent');

        $this->db->set('winning_wallet', 'winning_wallet-' . $amount, FALSE);
        $this->db->where('id', $user_id);
        $this->db->where('winning_wallet>', 0);
        $this->db->update('tbl_agent');

        $this->db->set('admin_coin', 'admin_coin+' . $amount, FALSE);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->update('tbl_admin');

        $data = [
            'user_id' => $user_id,
            'to_user_id' => $to_user_id,
            'gift_id' => $gift_id,
            'table_id' => $table_id,
            'coin' => $amount,
            'added_date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tbl_tip_log', $data);
        return $this->db->insert_id();
    }

    public function GiftList($table_id)
    {
        $curr = date('Y-m-d H:i:s');
        $last_min = date('Y-m-d H:i:s', strtotime('-30 seconds'));

        $this->db->select('tbl_tip_log.*,tbl_gift.image');
        $this->db->where('gift_id!=', 0);
        $this->db->where('table_id', $table_id);
        $this->db->where('tbl_tip_log.added_date >=', $last_min);
        $this->db->where('tbl_tip_log.added_date <=', $curr);
        $Query = $this->db->join('tbl_gift','tbl_gift.id=tbl_tip_log.gift_id');
        $Query = $this->db->get('tbl_tip_log');
        // echo $this->db->last_query();
        return $Query->result();
    }

    public function UpdateReferralCode($user_id)
    {
        $this->db->set('referral_code', 'TEENPATTI' . $user_id);
        $this->db->set('updated_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $user_id);
        $this->db->update('tbl_agent');
    }

    public function LoginUser($MobileNo, $Password)
    {
        $this->db->where('mobile', $MobileNo);
        $this->db->where('password', $Password);
        $user = $this->db->get('tbl_agent');

        return $user->result();
    }

    public function AgentProfile($id)
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('isDeleted', false);
        $this->db->where('tbl_agent.id', $id);

        $Query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $Query->result();
    }

    public function AddPurchaseReferLog($data)
    {
        $this->db->insert('tbl_purcharse_ref', $data);
        return $this->db->insert_id();
    }

    public function AddWelcomeReferLog($data)
    {
        $this->db->insert('tbl_welcome_ref', $data);
        return $this->db->insert_id();
    }

    public function GetFreeBot()
    {
        $this->db->from('tbl_agent');
        $this->db->where('isDeleted', false);
        $this->db->where('table_id', 0);
        $this->db->where('wallet>=', 10000);
        $this->db->where('user_type', 1);

        $Query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $Query->result();
    }

    public function Setting()
    {
        $this->db->from('tbl_admin');
        $this->db->where('isDeleted', false);

        $Query = $this->db->get();
        return $Query->row();
    }

    public function UpdateSetting($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_admin', $data);
        return $this->db->affected_rows();
    }

    public function UserWallet($user_id)
    {
        $this->db->select('tbl_agent.wallet');
        $this->db->from('tbl_agent');
        $this->db->where('isDeleted', false);
        $this->db->where('tbl_agent.id', $user_id);

        $Query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $Query->row();
    }

    public function UserProfileByMobile($MobileNo)
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('isDeleted', false);
        $this->db->where('tbl_agent.mobile', $MobileNo);

        $Query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $Query->result();
    }

    public function UserProfileByEmail($Email)
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('isDeleted', false);
        $this->db->where('tbl_agent.email', $Email);

        $Query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $Query->result();
    }

    public function IsValidReferral($referral_code)
    {
        $this->db->select('tbl_agent.*');
        $this->db->from('tbl_agent');
        $this->db->where('isDeleted', false);
        $this->db->where('tbl_agent.referral_code', $referral_code);

        $Query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $Query->result();
    }

    public function View_Wins($user_id)
    {
        $Query = $this->db->where('isDeleted', FALSE)
            ->where('winner_id', $user_id)
            ->get('tbl_game');
        return $Query->result();
    }

    public function View_Purchase($user_id)
    {
        $Query = $this->db->where('isDeleted', FALSE)
            ->where('user_id', $user_id)
            ->where('payment', 1)
            ->get('tbl_purchase');
        return $Query->result();
    }

    public function View_AllPurchase($user_id)
    {
        $Query = $this->db->query("SELECT * FROM (
            SELECT `coin`,`price`,`updated_date`, 'ONLINE PURCHASE' as type FROM `tbl_purchase` WHERE `payment`=1
            UNION
            SELECT `coin`,0 as price,`added_date`, IF(`bonus`=1,'BONUS','ADMIN PURCHASE') as type FROM `tbl_wallet_log`
            ) as a ORDER BY updated_date DESC");
        return $Query->result();
    }

    public function View_Reffer($user_id)
    {
        $Query = $this->db->where('isDeleted', FALSE)
            ->where('referred_by', $user_id)
            ->get('tbl_agent');
        return $Query->result();
    }

    public function Purchase_History()
    {
        $Query = $this->db->select('tbl_purchase.*,tbl_agent.name')
            ->from('tbl_purchase')
            ->join('tbl_agent', 'tbl_agent.id=tbl_purchase.user_id')
            ->where('tbl_purchase.payment', TRUE)
            ->where('tbl_purchase.isDeleted', FALSE)
            ->where('tbl_agent.isDeleted', FALSE)
            ->get();
        return $Query->result();
    }

    public function View_Purchase_Reffer()
    {
        $Query = $this->db->select('tbl_purcharse_ref.*,tbl_agent.name')
            ->from('tbl_purcharse_ref')
            ->join('tbl_agent', 'tbl_agent.id=tbl_purcharse_ref.user_id')
            ->where('tbl_agent.isDeleted', FALSE)
            ->get();
        return $Query->result();
    }

    public function View_Welcome_Reffer($user_id)
    {
        $Query = $this->db->select('tbl_welcome_ref.*,tbl_agent.name')
            ->from('tbl_welcome_ref')
            ->join('tbl_agent', 'tbl_agent.id=tbl_welcome_ref.bonus_user_id')
            ->where('tbl_agent.isDeleted', FALSE)
            ->where('tbl_welcome_ref.user_id', $user_id)
            ->get();
        return $Query->result();
    }

    public function ActiveUser()
    {
        $Query = $this->db->select('tbl_agent.*')
            ->from('tbl_agent')
            ->where('tbl_agent.isDeleted', false)
            ->where('DATE(tbl_agent.updated_date)>', 'DATE_SUB(CURRENT_TIMESTAMP, INTERVAL +2 DAY)', false)
            ->order_by('tbl_agent.id', 'desc')
            ->get();
        return $Query->result();
    }

    public function WalletAmount($user_id)
    {
        $this->db->select('tbl_ander_baher_bet.*,tbl_ander_baher.room_id');
        $this->db->from('tbl_ander_baher_bet');
        $this->db->join('tbl_ander_baher','tbl_ander_baher.id=tbl_ander_baher_bet.ander_baher_id');
        $this->db->where('tbl_ander_baher_bet.user_id', $user_id);
        $Query = $this->db->get();
        return $Query->result();
    }

    public function TeenPattiLog($user_id)
    {
        $Query = $this->db->query('SELECT `game_id`,SUM(`amount`) as invest,(SELECT IFNULL(user_winning_amt,0) FROM `tbl_game` WHERE winner_id='.$user_id.' AND id=`game_id`) as winning_amount,added_date FROM `tbl_game_log` WHERE `user_id`='.$user_id.' GROUP BY `game_id`');
        // $this->db->get();
        return $Query->result();
    }

    public function RummyLog($user_id)
    {
        $Query = $this->db->query('SELECT * FROM
        (SELECT `game_id`,`user_id`,`action`,`amount`,`added_date` FROM `tbl_rummy_log` WHERE `amount`!=0 AND `user_id`='.$user_id.'
        UNION
        SELECT `id`,`winner_id`,10,`user_winning_amt`,`added_date` FROM `tbl_rummy` WHERE  `winner_id`='.$user_id.') rummy
        ORDER BY added_date DESC');
        // $this->db->get();
        return $Query->result();
    }
}