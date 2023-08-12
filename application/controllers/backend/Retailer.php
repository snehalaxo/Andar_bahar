<?php
class Retailer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Retailer_model', 'Setting_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Retailer',
            'AllUser' => $this->Retailer_model->AllUserList()
        ];
        $data['SideBarbutton'] = ['backend/retailer/add', 'Add Retailer'];

        template('retailer/list', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Retailer',
            'User' => $this->Retailer_model->UserProfile($id)
        ];

        template('retailer/edit', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Retailer'
        ];

        template('retailer/add', $data);
    }

    public function sendNotification()
    {
        $userdata = $this->Users_model->AllUserList();

        foreach ($userdata as $key => $value) {

            if (!empty($value->fcm)) {
                $data['msg'] = "you can buy ticket ";
                $data['title'] = "new game";
                push_notification_android($value->fcm, $data);
            }
        }
    }

    public function delete($user_id)
    {
        if ($this->Retailer_model->Delete($user_id)) {
            $this->session->set_flashdata('msg', array('message' => 'Retailer Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/retailer');
    }

    public function insert()
    {
       
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' =>  $this->input->post('last_name'),
            'email_id' => $this->input->post('email_id'),
            'whats_no' => $this->input->post('whats_no'),
            'password' => $this->input->post('password'),
            'sw_password' => md5($this->input->post('password')),
            
            'role' => 'retailer',

            // 'user_type' => 1,
            //'added_date' => date('Y-m-d H:i:s')
        ];
        
        
        
        $user = $this->Retailer_model->AddBot($data);
        if ($user) {
            $this->session->set_flashdata('msg', array('message' => 'Retailer Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/retailer');
    }

    public function update()
    {
        $user = $this->Retailer_model->UpdateWalletOrder($this->input->post('wallet'), $this->input->post('user_id'));
        if ($user) {
            $user = $this->Retailer_model->WalletLog($this->input->post('wallet'), $this->input->post('user_id'));
            $this->session->set_flashdata('msg', array('message' => 'User Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/retailer');
    }

    public function view($user_id)
    {
        $data = [
            'title' => 'View Logs',
            'AllWins' => $this->Retailer_model->View_Wins($user_id),
            'AllPurchase' => $this->Retailer_model->View_Purchase($user_id),
            'AllReffer' => $this->Retailer_model->View_Reffer($user_id),
            'AllPurchase_Reffer' => $this->Retailer_model->View_Purchase_Reffer($user_id),
            'AllWelcome_Reffer' => $this->Retailer_model->View_Welcome_Reffer($user_id),
            'AllWalletLog' => $this->Retailer_model->View_WalletLog($user_id),
            'Setting' => $this->Setting_model->Setting(),
            'bethistory' => $this->Retailer_model->View_bet_history($user_id)

        ];

        template('retailer/view', $data);
    }

    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $Change = $this->Retailer_model->ChangeStatus($id, $status);
        
        if ($Change) {
            $this->session->set_flashdata('message', array('message' => 'Status Change Successfully', 'class' => 'success'));
        } else {
            $this->session->set_flashdata('message', array('message' => 'Something went to wrong', 'class' => 'success'));
        }
    }
}