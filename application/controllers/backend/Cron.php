<?php
class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Web_model','Cron_model']);
    }
    
   
   
    public function index()
    {
        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $minValue= date("Y-m-d 10:00:00");
        $maxValue=date("Y-m-d 23:00:00");
        $current_time=date("Y-m-d H:i:s");
        
        if($current_time >= $minValue && $current_time <= $maxValue)
        {

        $data = [
          'date'=> date('d/m/Y h:i:s a'),
          'time'=>date('h:i'),
          'day'=>date('d/m/Y'),
             'status'=>0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $user = $this->Cron_model->AddBatch($data);
        $batch_id = $this->db->insert_id();
        $cards= $this->Web_model->game();

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
            
         $data3 = array(
        'batch_id'=>$batch_id
         );
        $this->db->insert('ax_andar_card_status',$data3); 
        
        $data4 = array(
        'batch_id'=>$batch_id
          );
        $this->db->insert('ax_bahar_card_status',$data4);  
        }
        else
        {
            echo "Comming soon";
        }

    }
    
  
        public function cards()
    {
                $card1 = $this->Cron_model->andar_card();
                $card2 = $this->Cron_model->bahar_card();
                $card3 = $this->Cron_model->andar_card_status();
                $card4 = $this->Cron_model->bahar_card_status();
                $batch_id = $this->Cron_model->batch_id();
                
        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $minValue= date("Y-m-d 10:00:00");
        $maxValue=date("Y-m-d 23:00:00");
        $current_time=date("Y-m-d H:i:s");
        
        if($current_time >= $minValue && $current_time <= $maxValue)
        {


            if((empty($card3[0]["card1"]))&& (empty($card4[0]["card1"])) )
            {
              
                    $this->db->set('card1', $card1[0]["card1"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                    $this->db->set('card1', $card2[0]["card1"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            else if((empty($card3[0]["card2"]))&& (empty($card4[0]["card2"])) )
            {
               
                    $this->db->set('card2', $card1[0]["card2"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                    $this->db->set('card2', $card2[0]["card2"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            else if((empty($card3[0]["card3"]))&& (empty($card4[0]["card3"])) )
            {
               
                    $this->db->set('card3', $card1[0]["card3"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                    $this->db->set('card3', $card2[0]["card3"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card4"]))&& (empty($card4[0]["card4"])))
            {
                    $this->db->set('card4', $card1[0]["card4"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card4', $card2[0]["card4"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card5"]))&& (empty($card4[0]["card5"])))
            {
                    $this->db->set('card5', $card1[0]["card5"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card5', $card2[0]["card5"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card6"]))&& (empty($card4[0]["card6"])))
            {
                    $this->db->set('card6', $card1[0]["card6"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card6', $card2[0]["card6"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card7"]))&& (empty($card4[0]["card7"])))
            {
                    $this->db->set('card7', $card1[0]["card7"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card7', $card2[0]["card7"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card8"]))&& (empty($card4[0]["card8"])))
            {
                    $this->db->set('card8', $card1[0]["card8"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card8', $card2[0]["card8"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card9"]))&& (empty($card4[0]["card9"])))
            {
                    $this->db->set('card9', $card1[0]["card9"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card9', $card2[0]["card9"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card10"]))&& (empty($card4[0]["card10"])))
            {
                    $this->db->set('card10', $card1[0]["card10"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card10', $card2[0]["card10"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card11"]))&& (empty($card4[0]["card11"])))
            {
                    $this->db->set('card11', $card1[0]["card11"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card11', $card2[0]["card11"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card12"]))&& (empty($card4[0]["card12"])))
            {
                    $this->db->set('card12', $card1[0]["card12"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card12', $card2[0]["card12"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card13"]))&& (empty($card4[0]["card13"])))
            {
                    $this->db->set('card13', $card1[0]["card13"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card13', $card2[0]["card13"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card14"]))&& (empty($card4[0]["card14"])))
            {
                    $this->db->set('card14', $card1[0]["card14"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card14', $card2[0]["card14"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card15"]))&& (empty($card4[0]["card15"])))
            {
                    $this->db->set('card15', $card1[0]["card15"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card15', $card2[0]["card15"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card16"]))&& (empty($card4[0]["card16"])))
            {
                    $this->db->set('card16', $card1[0]["card16"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card16', $card2[0]["card16"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card17"]))&& (empty($card4[0]["card17"])))
            {
                    $this->db->set('card17', $card1[0]["card17"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card17', $card2[0]["card17"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card18"]))&& (empty($card4[0]["card18"])))
            {
                    $this->db->set('card18', $card1[0]["card18"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card18', $card2[0]["card18"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card19"]))&& (empty($card4[0]["card19"])))
            {
                    $this->db->set('card19', $card1[0]["card19"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card19', $card2[0]["card19"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card20"]))&& (empty($card4[0]["card20"])))
            {
                    $this->db->set('card20', $card1[0]["card20"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card20', $card2[0]["card20"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card21"]))&& (empty($card4[0]["card21"])))
            {
                    $this->db->set('card21', $card1[0]["card21"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card21', $card2[0]["card21"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card22"]))&& (empty($card4[0]["card22"])))
            {
                    $this->db->set('card22', $card1[0]["card22"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                    $this->db->set('card22', $card2[0]["card22"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card23"]))&& (empty($card4[0]["card23"])))
            {
                    $this->db->set('card23', $card1[0]["card23"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card23', $card2[0]["card23"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card24"]))&& (empty($card4[0]["card24"])))
            {
                    $this->db->set('card24', $card1[0]["card24"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card24', $card2[0]["card24"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card25"]))&& (empty($card4[0]["card25"])))
            {
                    $this->db->set('card25', $card1[0]["card25"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card25', $card2[0]["card25"]);
                     $this->db->where('batch_id', $batch_id->id);
                     $this->db->update('ax_bahar_card_status');
            }
            
            else if((empty($card3[0]["card26"]))&& (empty($card4[0]["card26"])))
            {
                    $this->db->set('card26', $card1[0]["card26"]);
                    $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_andar_card_status');
                    
                     $this->db->set('card26', $card2[0]["card26"]);
                     $this->db->where('batch_id', $batch_id->id);
                    $this->db->update('ax_bahar_card_status');
            }
            
            else
            {
                     echo "not found";
            }
        }
        
        else
        {
            echo "Comming soon";
        }
        
    }
    
 
    
}