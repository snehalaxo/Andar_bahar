<?php

use Restserver\Libraries\REST_Controller;

include APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/libraries/Format.php';
class User extends REST_Controller
{
    private $data;
    private $UserData;
    private $UserId;
    public function __construct()
    {
        parent::__construct();
        // $header = $this->input->request_headers('token');
        

        // if (!isset($header['token'])) {
        //     $data['message'] = 'Invalid Request';
        //     $data['code'] = HTTP_UNAUTHORIZED;
        //     $this->response($data, HTTP_OK);
        //     exit();
        // }

        // if ($header['token'] != getToken()) {
        //     $data['message'] = 'Invalid Authorization';
        //     $data['code'] = HTTP_METHOD_NOT_ALLOWED;
        //     $this->response($data, HTTP_OK);
        //     exit();
        // }

        $this->data = $this->input->post();
        
        $this->load->model([
            'Users_model',
            'Game_model',
            'Setting_model'
        ]);
    }

    public function send_otp_post()
    {
        $mobile = $this->data['mobile'];
        // $user = $this->Users_model->UserProfileByMobile($mobile);
        // if($user)
        // {
        //     $data['message'] = 'Mobile Already Exist, Please Login';
        //     $data['code'] = HTTP_NOT_FOUND;
        //     $this->response($data, HTTP_OK);
        //     exit();
        // }
        // else
        // {
            $otp = rand(1000,9999);

            // $otp = 9988;
            $otp_id = $this->Users_model->InsertOTP($mobile,$otp);
            $msg = "Yout OTP code is : ".$otp;
            // Send_SMS($mobile,$msg);
            Send_OTP($mobile, $otp);
            $data['message'] = 'Success';
            $data['otp_id'] = $otp_id;
            $data['code'] = HTTP_OK;
            $this->response($data, HTTP_OK);
            exit();
        // }
        
    }

    public function register_post()
    {
        // if($this->Users_model->OTPConfirm($this->data['otp_id'], $this->data['otp'], $this->data['mobile']) || $this->data['otp']==$this->Setting_model->Setting()->default_otp)
        if($this->Users_model->OTPConfirm($this->data['otp_id'], $this->data['otp'], $this->data['mobile']) || $this->data['otp']==DEFAULT_OTP)
        {
            $token = md5(uniqid(rand(), true));
            $user = $this->Users_model->UserProfileByMobile($this->data['mobile']);
            if($user)
            {
                if($user[0]->status==1)
                {
                    $data['message'] = 'You are blocked, Please contact to admin';
                    $data['code'] = HTTP_NOT_FOUND;
                    $this->response($data, HTTP_OK);
                    exit();
                }
                
                $this->Users_model->UpdateToken($user[0]->id,$token);
                $data['message'] = 'Mobile Already Exist';
                $data['user'] = $user;
                $data['token'] = $token;
                $data['code'] = 201;
                $this->response($data, HTTP_OK);
                exit();
            }
            else
            {
                $referral_user = array();
                if(!empty($this->data['referral_code']))
                {
                    $referral_user = $this->Users_model->IsValidReferral($this->data['referral_code']);
                    if(empty($referral_user))
                    {
                        $data['message'] = 'Referral Code is Not Valid';
                        $data['code'] = HTTP_NOT_FOUND;
                        $this->response($data, HTTP_OK);
                        exit();
                    }
                }

                $profile_pic = '';

                if (!empty($this->data['profile_pic'])) {

                    $img = $this->data['profile_pic'];
                    $img = str_replace(' ', '+', $img);
                    $img_data = base64_decode($img);
                    $profile_pic = uniqid().'.jpg';
                    $file = './data/post/'.$profile_pic;
                    file_put_contents($file, $img_data);
                }

                $gender = (strtolower(trim($this->input->post('gender')))=='female')?'f':'m';
                $user_id = $this->Users_model->RegisterUser($this->data['mobile'],$this->data['name'],$profile_pic,$gender,$token);
                $this->Users_model->UpdateReferralCode($user_id);
                if(!empty($referral_user))
                {
                    $setting = $this->Users_model->Setting();
                    $this->Users_model->UpdateWallet($referral_user[0]->id,$setting->referral_amount,$user_id);
                }
                $data['message'] = 'Success';
                $data['user_id'] = $user_id;
                $data['token'] = $token;
                $data['code'] = HTTP_OK;
                $this->response($data, HTTP_OK);
                exit();
            }
        }
        else
        {
            $data['message'] = 'OTP Not Matched';
            $data['code'] = HTTP_NOT_FOUND;
            $this->response($data, HTTP_OK);
            exit();
        }
        
    }

    public function email_login_post()
    {
        // if($this->Users_model->OTPConfirm($this->data['otp_id'], $this->data['otp'], $this->data['mobile']) || $this->data['otp']==$this->Setting_model->Setting()->default_otp)
        // {
            $token = md5(uniqid(rand(), true));
            $user = $this->Users_model->UserProfileByEmail($this->data['email']);
            if($user)
            {
                if($user[0]->status==1)
                {
                    $data['message'] = 'You are blocked, Please contact to admin';
                    $data['code'] = HTTP_NOT_FOUND;
                    $this->response($data, HTTP_OK);
                    exit();
                }
                
                $this->Users_model->UpdateToken($user[0]->id,$token);
                $data['message'] = 'Email Already Exist';
                $data['user'] = $user;
                $data['token'] = $token;
                $data['code'] = 201;
                $this->response($data, HTTP_OK);
                exit();
            }
            else
            {
                $referral_user = array();
                if(!empty($this->data['referral_code']))
                {
                    $referral_user = $this->Users_model->IsValidReferral($this->data['referral_code']);
                    if(empty($referral_user))
                    {
                        $data['message'] = 'Referral Code is Not Valid';
                        $data['code'] = HTTP_NOT_FOUND;
                        $this->response($data, HTTP_OK);
                        exit();
                    }
                }

                $profile_pic = '';

                if (!empty($this->data['profile_pic'])) {

                    $img = $this->data['profile_pic'];
                    $img = str_replace(' ', '+', $img);
                    $img_data = base64_decode($img);
                    $profile_pic = uniqid().'.jpg';
                    $file = './data/post/'.$profile_pic;
                    file_put_contents($file, $img_data);
                }

                $gender = (strtolower(trim($this->input->post('gender')))=='female')?'f':'m';
                $user_id = $this->Users_model->RegisterUserEmail($this->data['email'],$this->data['name'],$this->data['source'],$profile_pic,$gender,$token);
                $this->Users_model->UpdateReferralCode($user_id);
                if(!empty($referral_user))
                {
                    $setting = $this->Users_model->Setting();
                    $this->Users_model->UpdateWallet($referral_user[0]->id,$setting->referral_amount,$user_id);
                }
                $data['message'] = 'Success';
                $data['user_id'] = $user_id;
                $data['token'] = $token;
                $data['code'] = HTTP_OK;
                $this->response($data, HTTP_OK);
                exit();
            }
        // }
        // else
        // {
        //     $data['message'] = 'OTP Not Matched';
        //     $data['code'] = HTTP_NOT_FOUND;
        //     $this->response($data, HTTP_OK);
        //     exit();
        // }
        
    }

    public function login_post()
    {
        $user = $this->Users_model->LoginUser($this->data['mobile'],$this->data['password']);
        if($user)
        {
            if($user[0]->status==1)
            {
                $data['message'] = 'You are blocked, Please contact to admin';
                $data['code'] = HTTP_NOT_FOUND;
                $this->response($data, HTTP_OK);
                exit();
            }

            $data['message'] = 'Success';
            $data['user_data'] = $user;
            $data['code'] = HTTP_OK;
            $this->response($data, HTTP_OK);
            exit();
        }
        else
        {
            if($this->Users_model->UserProfileByMobile($this->data['mobile']))
            {
                $data['message'] = 'Incorrect Password';
                $data['code'] = 408;
                $this->response($data, HTTP_OK);
                exit();
            }
            else
            {
                $data['message'] = 'User Not Found With This Mobile Number';
                $data['code'] = HTTP_NOT_FOUND;
                $this->response($data, HTTP_OK);
                exit();
            }
        }
    }

    public function forgot_password_post()
    {
        $user_data = $this->Users_model->UserProfileByMobile($this->data['mobile']);
        if($user_data)
        {
            $msg = "Your Password is ".$user_data[0]->password.", Keep Playing Teen Patti.";
            Send_SMS($this->data['mobile'],$msg);
            $data['message'] = 'Password Sent.';
            $data['code'] = HTTP_OK;
            $this->response($data, HTTP_OK);
            exit();
        }
        else
        {
            $data['message'] = 'User Not Found With This Mobile Number';
            $data['code'] = HTTP_NOT_FOUND;
            $this->response($data, HTTP_OK);
            exit();
        }
    }

    public function profile_post()
    {
        if(!$this->Users_model->TokenConfirm($this->data['id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $fcm = $this->input->post('fcm');
        
        if(!empty($fcm))
        {
            $this->Users_model->UpdateUser($this->data['id'], $fcm);
        }

        $app_version = $this->input->post('app_version');
        if(!empty($app_version))
        {
            $this->Users_model->UpdateAppVersion($this->data['id'], $app_version);
        }
        $UserData = $this->Users_model->UserProfile($this->data['id']);
        $setting = $this->Setting_model->Setting();
        
        $data['message'] = 'Success';
        $data['user_data'] = $UserData;
        $data['setting'] = $setting;
        $data['code'] = HTTP_OK;
        $this->response($data, HTTP_OK);
        exit();
    }

    public function leaderboard_post()
    {
        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }
        
        $leaderboard = $this->Game_model->Leaderboard();
        
        $data['message'] = 'Success';
        $data['leaderboard'] = $leaderboard;
        $data['code'] = HTTP_OK;
        $this->response($data, HTTP_OK);
        exit();
    }

    public function setting_post()
    {
        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $setting = $this->Setting_model->Setting();
        
        $data['message'] = 'Success';
        $data['setting'] = $setting;
        $data['code'] = HTTP_OK;
        $this->response($data, HTTP_OK);
        exit();
    }

    public function list_post()
    {
        $Users = $this->Users_model->AllUserList();
        if ($Users) {
            $data = [
                'List' => $Users,
                'message' => 'Success',
                'code' => HTTP_OK,
            ];
            $this->response($data, HTTP_OK);
        } else {
            $data = [
                'message' => 'Please try after sometime',
                'code' => HTTP_NOT_FOUND,
            ];
            $this->response($data, HTTP_OK);
        }
    }

    public function bot_post()
    {
        $Users = $this->Users_model->GetFreeBot();
        if ($Users) {
            $data = [
                'List' => $Users,
                'message' => 'Success',
                'code' => HTTP_OK,
            ];
            $this->response($data, HTTP_OK);
        } else {
            $data = [
                'message' => 'Please try after sometime',
                'code' => HTTP_NOT_FOUND,
            ];
            $this->response($data, HTTP_OK);
        }
    }

    public function winning_history_post()
    {
        $user_id = $this->input->post('user_id');
        
        if (empty($user_id)) {
            $data['message'] = 'Invalid Params';
            $data['code'] = HTTP_BLANK;
            $this->response($data, 200);
            exit();
        }

        $user = $this->Users_model->UserProfile($user_id);
        if (empty($user)) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $data = [
            'GameWins' => $this->Users_model->View_Wins($user_id),
            'TeenPattiGameLog' => $this->Users_model->TeenPattiLog($user_id),
            'RummyGameLog' => $this->Users_model->RummyLog($user_id),
            'AllPurchase' => $this->Users_model->View_AllPurchase($user_id),
            'message' => 'Success',
            'code' => HTTP_OK,
        ];
        $this->response($data, HTTP_OK);
    }

    public function wallet_history_post()
    {
        $user_id = $this->input->post('user_id');
        
        if (empty($user_id)) {
            $data['message'] = 'Invalid Params';
            $data['code'] = HTTP_BLANK;
            $this->response($data, 200);
            exit();
        }

        $user = $this->Users_model->UserProfile($user_id);
        if (empty($user)) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $data = [
            'GameLog' => $this->Users_model->WalletAmount($user_id),
            'AllPurchase' => $this->Users_model->View_Purchase($user_id),
            'MinRedeem' => min_redeem(),
            'message' => 'Success',
            'code' => HTTP_OK,
        ];
        $this->response($data, HTTP_OK);
    }

    public function min_amount_post()
    {
        $user_id = $this->input->post('user_id');
        
        if (empty($user_id)) {
            $data['message'] = 'Invalid Params';
            $data['code'] = HTTP_BLANK;
            $this->response($data, 200);
            exit();
        }

        $user = $this->Users_model->UserProfile($user_id);
        if (empty($user)) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }
        
        $data = [
            'Wallet' => $user[0]->wallet,
            'Min_Redeem' => min_redeem(),
            'message' => 'Success',
            'code' => HTTP_OK,
        ];
        $this->response($data, HTTP_OK);
    }

    public function check_adhar_post(){
        $user_id = $this->input->post('user_id');
       
        
        if (empty($user_id) ) {
            $data['message'] = 'Invalid Params';
            $data['code'] = HTTP_BLANK;
            $this->response($data, 200);
            exit();
        }
        $adhar = $this->Users_model->getAdhar($user_id);
        if($adhar==''){
            $data['message'] = '0';
            $data['code'] = 200;
            $this->response($data, 200);
            exit();
        }else{
            $data['message'] = '1';
            $data['code'] = 200;
            $this->response($data, 200);
            exit();
        }
       
    }

    public function update_profile_post()
    {
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('name');
        $bank_detail = $this->input->post('bank_detail');
        $adhar_card = $this->input->post('adhar_card');
        $upi = $this->input->post('upi');
        
        if (empty($user_id) ) {
            $data['message'] = 'Invalid Params';
            $data['code'] = HTTP_BLANK;
            $this->response($data, 200);
            exit();
        }

        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $user = $this->Users_model->UserProfile($user_id);
        if (empty($user)) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        // $img = $profile_pic;
        // $img = str_replace(' ', '+', $img);
        // $img_data = base64_decode($img);
        // $profile_pic_name = uniqid().'.jpg';
        // $file = './data/post/'.$profile_pic_name;
        // file_put_contents($file, $img_data);

        $profile_pic = '';
        if (!empty($this->data['profile_pic'])) {

            $img = $this->data['profile_pic'];
            $img = str_replace(' ', '+', $img);
            $img_data = base64_decode($img);
            $profile_pic = uniqid().'.jpg';
            $file = './data/post/'.$profile_pic;
            file_put_contents($file, $img_data);
        }

        $this->Users_model->UpdateUserPic($user_id,$name,$profile_pic,$bank_detail,$adhar_card,$upi);
        $data['message'] = 'Success';
        $data['code'] = HTTP_OK;
        $this->response($data, HTTP_OK);
        exit();
    }

    public function welcome_bonus_post()
    {
        if (empty($this->data['user_id'])) {
            $data['message'] = 'Invalid Parameter';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $user = $this->Users_model->UserProfile($this->data['user_id']);
        if (empty($user)) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $WelcomeBonus = $this->Users_model->WelcomeBonus();
        if($WelcomeBonus)
        {
            $bonus_log = $this->Users_model->WelcomeBonusLog($this->data['user_id']);

            $data['message'] = 'Success';
            $data['collected_days'] = count($bonus_log);
            $data['welcome_bonus'] = $WelcomeBonus;
            $data['code'] = HTTP_OK;
            $this->response($data, HTTP_OK);
            exit();
        }

        $data['message'] = 'Invalid Bonus';
        $data['code'] = HTTP_NOT_ACCEPTABLE;
        $this->response($data, 200);
        exit();
    }

    public function collect_welcome_bonus_post()
    {
        if (empty($this->data['user_id'])) {
            $data['message'] = 'Invalid Parameter';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $user = $this->Users_model->UserProfile($this->data['user_id']);
        if (empty($user)) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $WelcomeBonus = $this->Users_model->WelcomeBonus();

        $bonus_log = $this->Users_model->WelcomeBonusLog($this->data['user_id']);
        if (empty($bonus_log)) {

            if($WelcomeBonus[0]->game_played<=$user[0]->game_played)
            {
                $this->Users_model->AddWelcomeBonus($WelcomeBonus[0]->coin,$this->data['user_id']);
                $setting = $this->Setting_model->Setting();
                for ($i=1; $i <= 3; $i++) { 
                    if($user[0]->referred_by!=0)
                    {
                        $level = 'level_'.$i;
                        $coins = (($WelcomeBonus[0]->coin*$setting->$level)/100);
                        $this->Users_model->UpdateWalletOrder($coins,$user[0]->referred_by);

                        $log_data = [
                            'user_id' => $user[0]->referred_by,
                            'day' => $WelcomeBonus[0]->id,
                            'bonus_user_id' => $this->data['user_id'],
                            'coin' => $coins,
                            'added_date' => date('Y-m-d H:i:s'),
                            'level' => $i,
                        ];

                        $this->Users_model->AddWelcomeReferLog($log_data);
                        $user = $this->Users_model->UserProfile($user[0]->referred_by);
                    }
                    else
                    {
                        break;
                    }
                }
                $data['message'] = 'Success';
                $data['coin'] = $WelcomeBonus[0]->coin;
                $data['code'] = HTTP_OK;
                $this->response($data, HTTP_OK);
                exit();
            }

            $data['message'] = 'You Have To Play '.($WelcomeBonus[0]->game_played-$user[0]->game_played).' More Games to Collect Bonus';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }
        else
        {
            $last_date = $bonus_log[0]->date;
            
            if(strtotime($last_date)<strtotime(date('Y-m-d')))
            {
                $collected_days = count($bonus_log);
                if($WelcomeBonus[$collected_days]->game_played<=$user[0]->game_played)
                {
                    $this->Users_model->AddWelcomeBonus($WelcomeBonus[$collected_days]->coin,$this->data['user_id']);

                    $setting = $this->Setting_model->Setting();
                    for ($i=1; $i <= 3; $i++) { 
                        if($user[0]->referred_by!=0)
                        {
                            $level = 'level_'.$i;
                            $coins = (($WelcomeBonus[$collected_days]->coin*$setting->$level)/100);
                            $this->Users_model->UpdateWalletOrder($coins,$user[0]->referred_by);

                            $log_data = [
                                'user_id' => $user[0]->referred_by,
                                'day' => $WelcomeBonus[$collected_days]->id,
                                'bonus_user_id' => $this->data['user_id'],
                                'coin' => $coins,
                                'added_date' => date('Y-m-d H:i:s'),
                                'level' => $i,
                            ];

                            $this->Users_model->AddWelcomeReferLog($log_data);
                            $user = $this->Users_model->UserProfile($user[0]->referred_by);
                        }
                        else
                        {
                            break;
                        }
                    }
                    
                    $data['message'] = 'Success';
                    $data['coin'] = $WelcomeBonus[$collected_days]->coin;
                    $data['code'] = HTTP_OK;
                    $this->response($data, HTTP_OK);
                    exit();
                }
            
                $data['message'] = 'You Have To Play '.($WelcomeBonus[$collected_days]->game_played-$user[0]->game_played).' More Games to Collect Bonus';
                $data['code'] = HTTP_NOT_ACCEPTABLE;
                $this->response($data, 200);
                exit();
            }

            $data['message'] = "Today's Bonus Already Collected";
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $data['message'] = 'Invalid Bonus';
        $data['code'] = HTTP_NOT_ACCEPTABLE;
        $this->response($data, 200);
        exit();
    }
}