<?php
class Batch extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Batch_model', 'Setting_model','Web_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Batch',
            'AllUser' => $this->Batch_model->AllUserList()
        ];
         
         $role=$this->session->userdata('role');
         $id=$this->session->userdata('admin_id');
        if($role=="admin")
        {  
        $data['SideBarbutton'] = ['backend/Batch/add', 'Add Batch'];
        }
        template('batch/list', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Batch',
            'User' => $this->Batch_model->BatchEdit($id),
           //'batchstatus' => $this->Batch_model-> getBatchStatus()
        ];

        template('batch/edit', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Batch'
        ];

        template('batch/add', $data);
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
        if ($this->Batch_model->Delete($id)) {
            $this->session->set_flashdata('msg', array('message' => 'Batch Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/batch');
    }

    public function insert()
    {
        $data = [
            'time' => $this->input->post('time'),
            'date' =>  $this->input->post('date'),
             'status'=>0,
            'created_at' => date('Y-m-d H:i:s')
        ];
         $user = $this->Batch_model->AddBatch($data);
        // $batch_id=$user->id;
         $batch_id = $this->db->insert_id();
  
         
        if ($user) {
            
            $this->session->set_flashdata('msg', array('message' => 'Batch Added Successfully', 'class' => 'success', 'position' => 'top-right'));
            
            $cards= $this->Web_model->game();
    //var_dump($cards);die();
       $data = array(
        'card1'=>$cards[0]["cards"],
        'card2'=>$cards[1]["cards"],
        'card3'=>$cards[2]["cards"],
        'card4'=>$cards[3]["cards"],
        'card5'=>$cards[4]["cards"],
        'card6'=>$cards[5]["cards"],
        'card7'=>$cards[6]["cards"],
        'card8'=>$cards[7]["cards"],
        'card9'=>$cards[8]["cards"],
        'card10'=>$cards[9]["cards"],
        'card11'=>$cards[10]["cards"],
        'card12'=>$cards[11]["cards"],
        'card13'=>$cards[12]["cards"],
        'card14'=>$cards[13]["cards"],
        'card15'=>$cards[14]["cards"],
        'card16'=>$cards[15]["cards"],
        'card17'=>$cards[16]["cards"],
        'card18'=>$cards[17]["cards"],
        'card19'=>$cards[18]["cards"],
        'card20'=>$cards[19]["cards"],
        'card21'=>$cards[20]["cards"],
        'card22'=>$cards[21]["cards"],
        'card23'=>$cards[22]["cards"],
        'card24'=>$cards[23]["cards"],
        'card25'=>$cards[24]["cards"],
        'card26'=>$cards[25]["cards"],
        'batch_id'=>$batch_id
          );
        $this->db->insert('ax_andar_card',$data);      
               $data1 = array(
        'card1'=>$cards[26]["cards"],
        'card2'=>$cards[27]["cards"],
        'card3'=>$cards[28]["cards"],
        'card4'=>$cards[29]["cards"],
        'card5'=>$cards[30]["cards"],
        'card6'=>$cards[31]["cards"],
        'card7'=>$cards[32]["cards"],
        'card8'=>$cards[33]["cards"],
        'card9'=>$cards[34]["cards"],
        'card10'=>$cards[35]["cards"],
        'card11'=>$cards[36]["cards"],
        'card12'=>$cards[37]["cards"],
        'card13'=>$cards[38]["cards"],
        'card14'=>$cards[39]["cards"],
        'card15'=>$cards[40]["cards"],
        'card16'=>$cards[41]["cards"],
        'card17'=>$cards[42]["cards"],
        'card18'=>$cards[43]["cards"],
        'card19'=>$cards[44]["cards"],
        'card20'=>$cards[45]["cards"],
        'card21'=>$cards[46]["cards"],
        'card22'=>$cards[47]["cards"],
        'card23'=>$cards[48]["cards"],
        'card24'=>$cards[49]["cards"],
        'card25'=>$cards[50]["cards"],
        'card26'=>$cards[51]["cards"],
         'batch_id'=>$batch_id
          );
        $this->db->insert('ax_bahar_card',$data1);  
            
            
            
            
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/batch');
    }

    public function update()
    {
        $user = $this->Batch_model->UpdateBatch($this->input->post('date'),$this->input->post('user_id'),$this->input->post('time'),$this->input->post('status'));
      // var_dump($user);die();
        // if ($user) {
                
           // $user = $this->batch_model->WalletLog($this->input->post('date'), $this->input->post('user_id'),$this->input->post('time'));
           
           
           
            $this->session->set_flashdata('msg', array('message' => 'Batch Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
            
        // } else {
        //     $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        // }
        redirect('backend/batch');
    }

    public function view($user_id)
    {
        $data = [
            'title' => 'View Logs',
            'AllWins' => $this->Batch_model->View_Wins($user_id),
            'AllPurchase' => $this->Batch_model->View_Purchase($user_id),
            'AllReffer' => $this->Batch_model->View_Reffer($user_id),
            'AllPurchase_Reffer' => $this->Batch_model->View_Purchase_Reffer($user_id),
            'AllWelcome_Reffer' => $this->Batch_model->View_Welcome_Reffer($user_id),
            'AllWalletLog' => $this->Batch_model->View_WalletLog($user_id),
            'Setting' => $this->Setting_model->Setting()
        ];

        template('batch/view', $data);
    }

    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $Change = $this->Batch_model->ChangeStatus($id, $status);
        
        if ($Change) {
            $this->session->set_flashdata('message', array('message' => 'Status Change Successfully', 'class' => 'success'));
        } else {
            $this->session->set_flashdata('message', array('message' => 'Something went to wrong', 'class' => 'success'));
        }
    }
    
        public function batch_history()
    {
            // 'batch_id' => $this->input->post('batch_id'),
        $batch_id = $this->input->post('batch_id');

        $data = [
            'title' => 'Batch History',

            'andar_card' => $this->Batch_model->andar_card($batch_id),
            'bahar_card' => $this->Batch_model->bahar_card($batch_id),
        
        ];

        template('batch/batch_history', $data);
    }
    
 
    
}