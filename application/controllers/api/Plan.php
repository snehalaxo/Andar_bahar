<?php

use Restserver\Libraries\REST_Controller;
use Razorpay\Api\Api;

include APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/libraries/Format.php';
class Plan extends REST_Controller
{
    private $data;
    
    public function __construct()
    {
        parent::__construct();
        $header = $this->input->request_headers('token');

        if (!isset($header['token'])) {
            $data['message'] = 'Invalid Request';
            $data['code'] = HTTP_UNAUTHORIZED;
            $this->response($data, HTTP_OK);
            exit();
        }

        if ($header['token'] != getToken()) {
            $data['message'] = 'Invalid Authorization';
            $data['code'] = HTTP_METHOD_NOT_ALLOWED;
            $this->response($data, HTTP_OK);
            exit();
        }

        $this->data = $this->input->post();
        
        $this->load->model('Users_model');
        $this->load->model('Coin_plan_model');
        $this->load->model('Setting_model');
        $this->load->model('Gift_model');
    }

    public function index_post()
    {
        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $PlanDetails = $this->Coin_plan_model->List();
        if($PlanDetails){
            $data['code'] = HTTP_OK;
            $data['message'] = 'Success';
            $data['PlanDetails']=$PlanDetails;
            $this->response($data, 200);
        }else{
            $data['code'] = HTTP_NOT_FOUND;
            $data['message'] = 'Somthing Happend, try again later..';
            $this->response($data, 200);
        }
    }

    public function gift_post()
    {
        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $Gift = $this->Gift_model->List();
        if($Gift){
            $data['code'] = HTTP_OK;
            $data['message'] = 'Success';
            $data['Gift']=$Gift;
            $this->response($data, 200);
        }else{
            $data['code'] = HTTP_NOT_FOUND;
            $data['message'] = 'Somthing Happend, try again later..';
            $this->response($data, 200);
        }
    }

    public function Place_Order_Post()
    {
        $user_id = $this->input->post('user_id');

        if(!$this->Users_model->TokenConfirm($this->data['user_id'],$this->data['token']))
        {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_INVALID;
            $this->response($data, HTTP_OK);
            exit();
        }

        $plan_id = $this->input->post('plan_id');
        
        if (empty($user_id) || empty($plan_id)) {
            $data['message'] = 'Invalid Params';
            $data['code'] = HTTP_BLANK;
            $this->response($data, 200);
            exit();
        }

        if (empty($this->Users_model->UserProfile($user_id))) {
            $data['message'] = 'Invalid User';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $plan = $this->Coin_plan_model->View($plan_id);
        if (empty($plan)) {
            $data['message'] = 'Invalid Plan';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $Amount = $plan->price;             //Product Amount While the Time OF Order

        $Order_ID = $this->Coin_plan_model->GetCoin($user_id, $plan_id,$plan->coin,$Amount);
        
        if (empty($Order_ID)) {
            $data['message'] = 'Error while Creating Ticket';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }
        // create ORder in razor pay
        $RazorPay_order = $this->RazorPay_order($Order_ID, $Amount);
        
        
        $Update_Order_Master = $this->Coin_plan_model->UpdateOrder($user_id, $Order_ID, $RazorPay_order->id);

        
        if ($Update_Order_Master) {
            $data['order_id'] = $Order_ID;
            $data['Total_Amount'] = $Amount;
            $data['RazorPay_ID'] = $RazorPay_order->id;
            $data['message'] = 'Success';
            $data['code'] = HTTP_OK;
            $this->response($data, 200);
            exit();
        } else {
            $data['message'] = 'Technical Error';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }
    }

    public function RazorPay_order($Order_ID, $Amount)
    {
        $setting = $this->Setting_model->Setting();
        $api = new Api($setting->razor_api_key, $setting->razor_secret_key);
        $order = $api->order->create(
            array(
                'receipt' => $Order_ID,
                'amount' => ($Amount * 100),
                'payment_capture' => 0,
                'currency' => 'INR'
            )
        );
        return $order;
    }

    public function Pay_Now_post()
    {
        $user_id = $this->input->post('user_id');
        $order_id = $this->input->post('order_id');
        $Payment_ID = $this->input->post('payment_id');
        
        if (empty($user_id) || empty($order_id)  || empty($Payment_ID)) {
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

        $CheckTicket = $this->Coin_plan_model->GetUserByOrderId($order_id);
        if (empty($CheckTicket)) {
            $data['message'] = 'Invalid Ticket ID';
            $data['code'] = HTTP_NOT_ACCEPTABLE;
            $this->response($data, 200);
            exit();
        }

        $setting = $this->Setting_model->Setting();
        $api = new Api($setting->razor_api_key, $setting->razor_secret_key);
        try {
            $payment = $api->payment->fetch($Payment_ID);
        } catch (\Exception $e) {
            // print_r($e);
            $data['message'] = 'Invalid Payment Id';
            $data['code'] = HTTP_UNAUTHORIZED;
            $this->response($data, 200);
            exit();
        }

        if ($payment) {
            $R_Order_ID = $payment->order_id;

            if ($CheckTicket[0]->razor_payment_id != $R_Order_ID) {
                $data['message'] = 'Invalid Order Data';
                $data['code'] = HTTP_NOT_ACCEPTABLE;
                $this->response($data, 200);
                exit();
            }

            $Amount = $CheckTicket[0]->price;
            if ($payment->status = 'authorized' && $payment->amount >= $Amount) {

                $payment->capture(array('amount' => ($Amount * 100), 'currency' => 'INR'));
                $this->Coin_plan_model->UpdateOrderPayment($CheckTicket[0]->razor_payment_id, $payment);
                $this->Users_model->UpdateWalletOrder($CheckTicket[0]->coin,$CheckTicket[0]->user_id);

                
                for ($i=1; $i <= 3; $i++) { 
                    if($user[0]->referred_by!=0)
                    {
                        $level = 'level_'.$i;
                        $coins = (($CheckTicket[0]->coin*$setting->$level)/100);
                        $this->Users_model->UpdateWalletOrder($coins,$user[0]->referred_by);

                        $log_data = [
                            'user_id' => $user[0]->referred_by,
                            'purchase_id' => $order_id,
                            'purchase_user_id' => $user_id,
                            'coin' => $coins,
                            'level' => $i,
                        ];

                        $this->Users_model->AddPurchaseReferLog($log_data);
                        $user = $this->Users_model->UserProfile($user[0]->referred_by);
                    }
                    else
                    {
                        break;
                    }
                }
                
                $data['message'] = 'Success';
                $data['code'] = HTTP_OK;
                $this->response($data, 200);
                exit();
            } else {
                $data['message'] = 'Invalid Payment';
                $data['code'] = HTTP_NOT_FOUND;
                $this->response($data, 200);
                exit();
            }
        }
    }
}