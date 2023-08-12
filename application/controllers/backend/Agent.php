<?php
class Agent extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Agent_model', 'Setting_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Agent',
            'AllAgent' => $this->Agent_model->AllAgentList()
        ];
        $data['SideBarbutton'] = ['backend/agent/add', 'Add Agent'];
        template('agent/list', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Agent',
            'Agent' => $this->Agent_model->AgentProfile($id)
        ];
        template('agent/edit', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Agent'
        ];
        template('agent/add', $data);
    }

    // public function sendNotification()
    // {
    //     $userdata = $this->Agent_model->AllUserList();

    //     foreach ($userdata as $key => $value) {

    //         if (!empty($value->fcm)) {
    //             $data['msg'] = "you can buy ticket ";
    //             $data['title'] = "new game";
    //             push_notification_android($value->fcm, $data);
    //         }
    //     }
    // }

    // public function delete($id)
    // {
    //     if ($this->Agent_model->Delete($id)) {
    //         $this->session->set_flashdata('msg', array('message' => 'User Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
    //     } else {
    //         $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
    //     }
    //     redirect('backend/agent');
    // }

    public function insert()
    {
        $data = [
            'name' => $this->input->post('name'),
            'profile_pic' => 'f_' . rand(1, 3) . '.png',
            'wallet' => $this->input->post('wallet'),
            'agent_type' =>$this->input->post('agent_type'),
            'added_date' => date('Y-m-d H:i:s')
        ];
        $user = $this->Agent_model->AddAgent($data);
        if ($user) {
            $this->session->set_flashdata('msg', array('message' => 'Agent Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/agent');
    }

    public function update()
    {
        $user = $this->Agent_model->UpdateWalletOrder($this->input->post('amount'), $this->input->post('agent_id'));
        if ($user) {
            $user = $this->Agent_model->WalletLog($this->input->post('amount'), $this->input->post('bonus'), $this->input->post('agent_id'));
            $this->session->set_flashdata('msg', array('message' => 'Agent Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/agent');
    }

    // public function view($user_id)
    // {
    //     $data = [
    //         'title' => 'View Logs',
    //         'AllWins' => $this->Agent_model->View_Wins($user_id),
    //         'AllPurchase' => $this->Agent_model->View_Purchase($user_id),
    //         'AllReffer' => $this->Agent_model->View_Reffer($user_id),
    //         'AllPurchase_Reffer' => $this->Agent_model->View_Purchase_Reffer($user_id),
    //         'AllWelcome_Reffer' => $this->Agent_model->View_Welcome_Reffer($user_id),
    //         'AllWalletLog' => $this->Agent_model->View_WalletLog($user_id),
    //         'Setting' => $this->Setting_model->Setting()
    //     ];
    //     template('user/agent', $data);
    // }

    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $Change = $this->Agent_model->ChangeStatus($id, $status);
        if ($Change) {
            $this->session->set_flashdata('message', array('message' => 'Status Change Successfully', 'class' => 'success'));
        } else {
            $this->session->set_flashdata('message', array('message' => 'Something went to wrong', 'class' => 'success'));
        }
    }
}