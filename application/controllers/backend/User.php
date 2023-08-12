<?php
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model', 'Setting_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'AllUser' => $this->Users_model->AllUserList()
        ];
        $data['SideBarbutton'] = ['backend/user/add', 'Add User'];
        template('user/list', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'User' => $this->Users_model->UserProfile($id)
        ];

        template('user/edit', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Bot'
        ];

        template('user/add', $data);
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

    public function delete($id)
    {
        if ($this->Users_model->Delete($id)) {
            $this->session->set_flashdata('msg', array('message' => 'User Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/user');
    }

    public function insert()
    {
        $data = [
            'name' => $this->input->post('name'),
            'profile_pic' => 'f_' . rand(1, 3) . '.png',
            'wallet' => $this->input->post('wallet'),
            'user_type' => 1,
            'added_date' => date('Y-m-d H:i:s')
        ];
        $user = $this->Users_model->AddBot($data);
        if ($user) {
            $this->session->set_flashdata('msg', array('message' => 'Bot Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/user');
    }

    public function update()
    {
        $user = $this->Users_model->UpdateWalletOrder($this->input->post('amount'), $this->input->post('user_id'));
        if ($user) {
            $user = $this->Users_model->WalletLog($this->input->post('amount'),$this->input->post('bonus'), $this->input->post('user_id'));
            $this->session->set_flashdata('msg', array('message' => 'User Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/user');
    }

    public function view($user_id)
    {
        $data = [
            'title' => 'View Logs',
            'AllWins' => $this->Users_model->View_Wins($user_id),
            'AllPurchase' => $this->Users_model->View_Purchase($user_id),
            'AllReffer' => $this->Users_model->View_Reffer($user_id),
            'AllPurchase_Reffer' => $this->Users_model->View_Purchase_Reffer($user_id),
            'AllWelcome_Reffer' => $this->Users_model->View_Welcome_Reffer($user_id),
            'AllWalletLog' => $this->Users_model->View_WalletLog($user_id),
            'Setting' => $this->Setting_model->Setting()
        ];

        template('user/view', $data);
    }

    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $Change = $this->Users_model->ChangeStatus($id, $status);
        if ($Change) {
            $this->session->set_flashdata('message', array('message' => 'Status Change Successfully', 'class' => 'success'));
        } else {
            $this->session->set_flashdata('message', array('message' => 'Something went to wrong', 'class' => 'success'));
        }
    }
   
}