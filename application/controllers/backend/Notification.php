<?php
class Notification extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model');
        $this->load->model('Users_model');
    }

    public function index()
    {
        $data = [
            'title' => 'Notification',
            'AllNotification' => $this->Notification_model->List()
        ];
        $data['SideBarbutton'] = ['backend/Notification/add', 'Add Notification'];
        template('notification/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Send Notification'
        ];

        template('notification/add', $data);
    }

    public function insert()
    {
        $data = [
            'msg' => $this->input->post('msg'),
            'added_date' => date('Y-m-d H:i:s')
        ];

        $Noti = $this->Notification_model->Add($data);
        if ($Noti) {
            $userdata = $this->Users_model->AllUserList();
            // print_r($userdata);
            foreach ($userdata as $value) {

                if(!empty($value->fcm))
                {
                    $data['msg'] = "Teen Patti";
                    $data['title'] = $this->input->post('msg');
                    push_notification_android($value->fcm,$data);
                }
            }

            $this->session->set_flashdata('msg', array('message' => 'Notification Sent Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Notification');
    }

}