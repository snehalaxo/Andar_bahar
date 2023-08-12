<?php
class Printcoupon extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Printcoupon_model', 'Setting_model']);

    }

    public function index()
    {
        $data = [
            'title' => 'Print',
         //   'AllUser' => $this->Printcoupon_model->AllUserList(),
             'groups' => $this->Printcoupon_model->getBatchList(),
              'images' => $this->Printcoupon_model->getImage()
        ];
        
        
      //  $data['SideBarbutton'] = ['backend/Printcoupon/add', 'Add Batch'];
        template('Printcoupon/list', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Batch',
            'User' => $this->Printcoupon_model->print()
        ];
        template('Printcoupon/edit', $data);
    }

   
   public function insert()
    {
        $wallet=$this->Printcoupon_model->getwallet();
        $user_id = mt_rand(100000, 999999); // generate 6 digit random numer
        $retailer_id=$this->session->userdata('admin_id');
        
        //load library /////barcode
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$user_id), array())->draw();
        $img=imagepng($imageResource, 'barcodes/'.$user_id.'.png');
        
        
        
            $data = [
                        'batch_id' => $this->input->post('batch_id'),
                        'card' =>  $this->input->post('inlineRadioOptions'),
                        'amount' => $this->input->post('quant[2]'),
                        'quantity' =>  $this->input->post('quantity'),
                        'type' =>  $this->input->post('inlineCheckbox1'),
                        'total' =>  $this->input->post('tot_amount'),
                        'user_id' => $user_id,
                        'retailer_id' => $retailer_id,
                        'status'=>0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'barcode' => 'http://bazarsatta.in/admin/barcodes/'.$user_id.'.png'
                   ];
                   
                  

	
    	//$data['barcode'] = 'http://bazarsatta.in/admin/barcodes/'.$user_id.'.png';
    
        if ($wallet->wallet >= $this->input->post('tot_amount'))
            {
        $user = $this->Printcoupon_model->AddBet($data);
                     if ($user) {
                    $walletdeduct=$this->Printcoupon_model->wallet_money_deduct($this->input->post('tot_amount'));
                    $status=0;
                    $walletlog=$this->Printcoupon_model->RetailerWalletLog($user_id,$retailer_id,$this->input->post('tot_amount'),$status);

                    $this->session->set_flashdata('msg', array('message' => 'Bet Added Successfully', 'class' => 'success', 'position' => 'top-right'));
                    } else {
                    $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
                    }
                    redirect('backend/Printcoupon/edit');
             }
        else
            {
        $this->session->set_flashdata('msg', array('message' => 'Insufficient coins', 'class' => 'danger', 'position' => 'top-right'));
        redirect('backend/Printcoupon');
            }
                    
    }
    
  
    public function view()
    {
        $data = [
            'title' => 'View Bet History',
            'bethistory' => $this->Printcoupon_model->View_bet_history(),
           
        ];

        template('Printcoupon/bethistory', $data);
    }
  
      public function reprint()
    {
         
        $data = [
            'title' => 'Reprint',
        ];

        template('Printcoupon/reprint', $data);
    }
    
       public function reprint_ticket()
    {
         
        $data = [
            'user_id' => $this->input->post('user_id'),
             'title' => 'Reprint',
        'User' => $this->Printcoupon_model->reprint($this->input->post('user_id')),
           
        ];
  
        template('Printcoupon/edit', $data);
    }
      public function Allbethistory()
    {
        $data = [
            'title' => 'View Bet History',
            'bethistory' => $this->Printcoupon_model->All_bet_history(),
           
        ];

        template('Printcoupon/bethistory', $data);
    }
    
    
      public function cancle_ticket()
    {
        $data = [
            'title' => 'Cancle Ticket',
             'BetList' => $this->Printcoupon_model->BetList(),
        ];

        template('Printcoupon/cancle_ticket', $data);
    }
    
     public function cancle_ticket1()
    {
        $user_id = $this->Printcoupon_model->cancle($this->input->post('user_id'));
        $batch_id=$user_id->batch_id;
        
if($user_id->status==0)
{
    
             $batch_cards = $this->Printcoupon_model->batch_bahar_cards($batch_id);
             $andar_cards = $this->Printcoupon_model->batch_andar_cards($batch_id);

            $input = substr("$user_id->card",2);
            $data=array($batch_cards->card1,$batch_cards->card2,$batch_cards->card3,$batch_cards->card4,$batch_cards->card5,$batch_cards->card6,$batch_cards->card7,$batch_cards->card8,$batch_cards->card9,$batch_cards->card10,
                        $batch_cards->card11,$batch_cards->card12,$batch_cards->card13,$batch_cards->card14,$batch_cards->card15,$batch_cards->card16,$batch_cards->card17,$batch_cards->card18,$batch_cards->card19,$batch_cards->card20,
                        $batch_cards->card21,$batch_cards->card22,$batch_cards->card23,$batch_cards->card24,$batch_cards->card25,$batch_cards->card26,
                        $andar_cards->card1,$andar_cards->card2,$andar_cards->card3,$andar_cards->card4,$andar_cards->card5,$andar_cards->card6,$andar_cards->card7,$andar_cards->card8,$andar_cards->card9,$andar_cards->card10,
                        $andar_cards->card11,$andar_cards->card12,$andar_cards->card13,$andar_cards->card14,$andar_cards->card15,$andar_cards->card16,$andar_cards->card17,$andar_cards->card18,$andar_cards->card19,$andar_cards->card20,
                        $andar_cards->card21,$andar_cards->card22,$andar_cards->card23,$andar_cards->card24,$andar_cards->card25,$andar_cards->card26);
            $result = array_filter($data, function ($item) use ($input) {
            if (stripos($item, $input) !== false) {
            return true;
        }
            return false;
        });
                   
                 if(count($result) < 4)
                 {
                    $cancle_ticket = $this->Printcoupon_model->cancle_ticket($this->input->post('user_id'));
                    // $cancle = $this->Printcoupon_model->cancle($this->input->post('user_id'));
                     $total=$user_id->total;
                    $this->Printcoupon_model->RetailerWalletLogdeduct($user_id->user_id,$user_id->retailer_id,$user_id->total);
                    $cancle_ticket1 = $this->Printcoupon_model->cancle_ticket_add_wallet($this->input->post('user_id'),$total);
                    $this->session->set_flashdata('msg', array('message' => 'Ticket Cancle Sucessfully', 'class' => 'success', 'position' => 'top-right'));
                    redirect('backend/Printcoupon/cancle_ticket');
    
                 }else{
                 $this->session->set_flashdata('msg', array('message' => 'You cannot cancle ticket ', 'class' => 'error', 'position' => 'top-right'));
                 redirect('backend/Printcoupon/cancle_ticket');
    }
}
else
{
     $this->session->set_flashdata('msg', array('message' => 'Ticket is allready cancelled ', 'class' => 'error', 'position' => 'top-right'));
       redirect('backend/Printcoupon/cancle_ticket');
}
}

    
   public function claim_ticket()
    {
        $data = [
            'title' => 'Claim Ticket',
          
        ];

        template('Printcoupon/claim_ticket', $data);
    }
    
      public function claim_ticket1()
{
    $user_id = $this->Printcoupon_model->claim($this->input->post('user_id'));
    $batch_id=$user_id->batch_id;
    $batch_cards = $this->Printcoupon_model->batch_bahar_cards($batch_id);
    $andar_cards = $this->Printcoupon_model->batch_andar_cards($batch_id);
    $input = substr("$user_id->card",2);
    $retailer_id=$this->session->userdata('admin_id');

    if($user_id->claim==0 && $user_id->type=="single")
        {
           
            $data=array($batch_cards->card1,$batch_cards->card2,$batch_cards->card3,$batch_cards->card4,$batch_cards->card5,$batch_cards->card6,$batch_cards->card7,$batch_cards->card8,$batch_cards->card9,$batch_cards->card10,$batch_cards->card11,$batch_cards->card12,$batch_cards->card13,$batch_cards->card14,$batch_cards->card15,$batch_cards->card16,$batch_cards->card17,$batch_cards->card18,$batch_cards->card19,$batch_cards->card20,$batch_cards->card21,$batch_cards->card22,$batch_cards->card23,$batch_cards->card24,$batch_cards->card25,$batch_cards->card26);
            $result = array_filter($data, function ($item) use ($input) 
            {
            if (stripos($item, $input) !== false)
            {
            return true;
            }
            return false;
             });
        
    if($result)
    {
        $this->Printcoupon_model->claim_status($user_id->user_id); 
        
            $data = [
                        'batch_id' => $batch_id,
                        'card' =>  $user_id->card,
                        'amount' => $user_id->amount,
                        'winning_amount' => ($user_id->amount)*2,
                        'type' =>  $user_id->type,
                        'total' =>$user_id->total,
                        'user_id' => $user_id->user_id,
                        'retailer_id' =>$retailer_id,
                        'status'=>1
                       
                   ];
         $this->Printcoupon_model->add_claim_ticket($data); 
        $total=(($user_id->amount)*2);
         $this->Printcoupon_model->add_claim_amount($total);
        
        $this->session->set_flashdata('msg', array('message' => 'Ticket claim Succesfully',  'class' => 'success', 'position' => 'top-right'));
         redirect('backend/Printcoupon/claim_ticket');
    }
    else
    {
        echo"not";
    }
        }
    else if($user_id->claim==0 && $user_id->type=="jod")
    {
        
        
       $data1=array(substr("$batch_cards->card1",2),substr("$batch_cards->card2",2),substr("$batch_cards->card3",2),substr("$batch_cards->card4",2),substr("$batch_cards->card5",2),substr("$batch_cards->card6",2),substr("$batch_cards->card7",2),substr("$batch_cards->card8",2),substr("$batch_cards->card9",2),substr("$batch_cards->card10",2),substr("$batch_cards->card11",2),substr("$batch_cards->card12",2),substr("$batch_cards->card13",2),substr("$batch_cards->card14",2),substr("$batch_cards->card15",2),substr("$batch_cards->card16",2),substr("$batch_cards->card17",2),substr("$batch_cards->card18",2),substr("$batch_cards->card19",2),substr("$batch_cards->card20",2),substr("$batch_cards->card21",2),substr("$batch_cards->card22",2),substr("$batch_cards->card23",2),substr("$batch_cards->card24",2),substr("$batch_cards->card25",2),substr("$batch_cards->card26",2));
       
       $data2=array(substr("$andar_cards->card1",2),substr("$andar_cards->card2",2),substr("$andar_cards->card3",2),substr("$andar_cards->card4",2),substr("$andar_cards->card5",2),substr("$andar_cards->card6",2),substr("$andar_cards->card7",2),substr("$andar_cards->card8",2),substr("$andar_cards->card9",2),substr("$andar_cards->card10",2),substr("$andar_cards->card11",2),substr("$andar_cards->card12",2),substr("$andar_cards->card13",2),substr("$andar_cards->card14",2),substr("$andar_cards->card15",2),substr("$andar_cards->card16",2),substr("$andar_cards->card17",2),substr("$andar_cards->card18",2),substr("$andar_cards->card19",2),substr("$andar_cards->card20",2),substr("$andar_cards->card21",2),substr("$andar_cards->card22",2),substr("$andar_cards->card23",2),substr("$andar_cards->card24",2),substr("$andar_cards->card25",2),substr("$andar_cards->card26",2));
       $result_array = array_intersect_assoc($data1, $data2);

if (in_array($input, $result_array))
{
    
   $this->Printcoupon_model->claim_status($user_id->user_id); 
        
            $data = [
                        'batch_id' => $batch_id,
                        'card' =>  $user_id->card,
                        'amount' => $user_id->amount,
                        'winning_amount' => ($user_id->amount)*2,
                        'type' =>  $user_id->type,
                        'total' =>$user_id->total,
                        'user_id' => $user_id->user_id,
                        'retailer_id' =>$retailer_id,
                        'status'=>1
                       
                   ];
         $this->Printcoupon_model->add_claim_ticket($data); 
        $total=(($user_id->amount)*2);
         $this->Printcoupon_model->add_claim_amount($total);
        
        $this->session->set_flashdata('msg', array('message' => 'Ticket claim Succesfully',  'class' => 'success', 'position' => 'top-right'));
         redirect('backend/Printcoupon/claim_ticket');
}

else
{
     return false;
}
}
    else{
    $this->session->set_flashdata('msg', array('message' => 'Ticket is Not Valid', 'class' => 'error', 'position' => 'top-right'));
    redirect('backend/Printcoupon/claim_ticket');

        
    }         
}



  

}