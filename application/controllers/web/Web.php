<?php

//use Restserver\Libraries\REST_Controller;

// include APPPATH . '/libraries/REST_Controller.php';
// include APPPATH . '/libraries/Format.php';
class Web extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
         if(!$this->session->logged_in){
            redirect('backend/game_login');
         }
        $this->load->model([
            'Web_model','Printcoupon_model'
        ]);
    }

    public function index()
    {
    $data['cards']= $this->Web_model->game();
    $data['andar']= $this->Web_model->andar_cards();
    $data['bahar']= $this->Web_model->bahar_cards();
   $data['batch']= $this->Web_model->batch();
    $data['images'] = $this->Printcoupon_model->getImage();
    $this->load->view('web/index',$data);
    }
    public function game_cards()
    {
        $cards= $this->Web_model->game();
        $data = array(
        'card1'=>$cards[0][cards],
        'card2'=>$cards[1][cards],
        'card3'=>$cards[2][cards],
        'card4'=>$cards[3][cards],
        'card5'=>$cards[4][cards],
        'card6'=>$cards[5][cards],
        'card7'=>$cards[6][cards],
        'card8'=>$cards[7][cards],
        'card9'=>$cards[8][cards],
        'card10'=>$cards[9][cards],
        'card11'=>$cards[10][cards],
        'card12'=>$cards[11][cards],
        'card13'=>$cards[12][cards],
        'card14'=>$cards[13][cards],
        'card15'=>$cards[14][cards],
        'card16'=>$cards[15][cards],
        'card17'=>$cards[16][cards],
        'card18'=>$cards[17][cards],
        'card19'=>$cards[18][cards],
        'card20'=>$cards[19][cards],
        'card21'=>$cards[20][cards],
        'card22'=>$cards[21][cards],
        'card23'=>$cards[22][cards],
        'card24'=>$cards[23][cards],
        'card25'=>$cards[24][cards],
        'card26'=>$cards[25][cards]
          );
        $this->db->insert('ax_andar_card',$data);   
        
         $data1 = array(
        'card1'=>$cards[26][cards],
        'card2'=>$cards[27][cards],
        'card3'=>$cards[28][cards],
        'card4'=>$cards[29][cards],
        'card5'=>$cards[30][cards],
        'card6'=>$cards[31][cards],
        'card7'=>$cards[32][cards],
        'card8'=>$cards[33][cards],
        'card9'=>$cards[34][cards],
        'card10'=>$cards[35][cards],
        'card11'=>$cards[36][cards],
        'card12'=>$cards[37][cards],
        'card13'=>$cards[38][cards],
        'card14'=>$cards[39][cards],
        'card15'=>$cards[40][cards],
        'card16'=>$cards[41][cards],
        'card17'=>$cards[42][cards],
        'card18'=>$cards[43][cards],
        'card19'=>$cards[44][cards],
        'card20'=>$cards[45][cards],
        'card21'=>$cards[46][cards],
        'card22'=>$cards[47][cards],
        'card23'=>$cards[48][cards],
        'card24'=>$cards[49][cards],
        'card25'=>$cards[50][cards],
        'card26'=>$cards[51][cards]
          );
        $this->db->insert('ax_bahar_card',$data1);  
    }

    
}