<?php
echo "hello world";

class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Game_model',
            'Setting_model',
            'AnderBahar_model',
            'Rummy_model'
        ]);
    }

    public function cron_draw()
    {
        echo"hi";
        $tables = $this->Game_model->getActiveTable();
        // print_r($tables);

        foreach ($tables as $val) {
            $game = $this->Game_model->getActiveGameOnTable($val->table_id);
            if($game)
            {
                $game_log = $this->Game_model->GameLog($game->id,1);
                $time = time()-strtotime($game_log[0]->added_date);

                if($time>35)
                {
                    $game_users = $this->Game_model->GameAllUser($game->id);

                    $chaal = 0;
                    $element = 0;
                    foreach ($game_users as $key => $value) {
                        if($value->user_id==$game_log[0]->user_id)
                        {
                            $element = $key;
                            break;
                        }
                    }

                    $index = 0;
                    foreach ($game_users as $key => $value) {

                        $index = ($key+$element)%count($game_users);
                        if($key>0)
                        {
                            if(!$game_users[$index]->packed)
                            {
                                $chaal = $game_users[$index]->user_id;
                                break;
                            }
                        }
                    }
                }

                $this->Game_model->PackGame($chaal,$game->id,1);
                $game_users = $this->Game_model->GameUser($game->id);

                if(count($game_users)==1)
                {
                    $comission = $this->Setting_model->Setting()->admin_commission;
                    $this->Game_model->MakeWinner($game->id,$game->amount,$game_users[0]->user_id,$comission);
                }

                $table_user_data = [
                    'table_id' => $val->table_id,
                    'user_id' =>$chaal
                ];
        
                $this->Game_model->RemoveTableUser($table_user_data);
            }

            echo '<br>Success';
        }
    }

    public function cron_rummy_draw()
    {
        $tables = $this->Rummy_model->getActiveTable();
        // print_r($tables);

        foreach ($tables as $val) {
            $game = $this->Rummy_model->getActiveGameOnTable($val->rummy_table_id);
            if($game)
            {
                $chaal = 0;
                $game_log = $this->Rummy_model->GameLog($game->id,1);
                $time = time()-strtotime($game_log[0]->added_date);

                if($time>65)
                {
                    $game_users = $this->Rummy_model->GameAllUser($game->id);

                    $element = 0;
                    foreach ($game_users as $key => $value) {
                        if($value->user_id==$game_log[0]->user_id)
                        {
                            $element = $key;
                            break;
                        }
                    }

                    $index = 0;
                    foreach ($game_users as $key => $value) {

                        $index = ($key+$element)%count($game_users);
                        if($key>0)
                        {
                            if(!$game_users[$index]->packed)
                            {
                                $chaal = $game_users[$index]->user_id;
                                break;
                            }
                        }
                    }
                }

                if($chaal>0)
                {
                    $table = $this->Rummy_model->isTableAvail($val->rummy_table_id);
                    $boot_value = $table->boot_value;
                    $ChaalCount = $this->Rummy_model->ChaalCount($game->id, $chaal);

                    $percent = ($ChaalCount>0)?CHAAL_PERCENT:NO_CHAAL_PERCENT;
                    $amount = round(($percent / 100) * $boot_value,2);

                    $this->Rummy_model->PackGame($chaal,$game->id,0,'',$amount,$percent);
                    $this->Rummy_model->MinusWallet($chaal,$amount);
                    $game_users = $this->Rummy_model->GameUser($game->id);

                    if(count($game_users)==1)
                    {
                        $game = $this->Rummy_model->getActiveGameOnTable($val->rummy_table_id);
                        $comission = $this->Setting_model->Setting()->admin_commission;
                        $this->Rummy_model->MakeWinner($game->id,$game->amount,$game_users[0]->user_id,$comission);
                        // $this->Rummy_model->MakeWinner($game->id,$amount,$game_users[0]->user_id);
                    }

                    $table_user_data = [
                        'table_id' => $val->rummy_table_id,
                        'user_id' =>$chaal
                    ];
            
                    $this->Rummy_model->RemoveTableUser($table_user_data);
                }
            }

            echo '<br>Success';
        }
    }

    public function all()
    {
        echo 'Date '.date('Y-m-d H:i:s').PHP_EOL;
        $room_data = $this->AnderBahar_model->getRoom();
        // print_r($room_data);
        if($room_data)
        {
            $limit = 1;
            foreach ($room_data as $key => $room) {
            
                $game_data = $this->AnderBahar_model->getActiveGameOnTable($room->id);
                // print_r($game_data);
                if(!$game_data)
                {
                    $card = $this->AnderBahar_model->GetCards($limit)[0]->cards;
                    $this->AnderBahar_model->Create($room->id,$card);
    
                    echo 'First Ander Baher Game Created Successfully'.PHP_EOL;
                    continue;
                }

                if($game_data[0]->status==0)
                {
                    echo (strtotime($game_data[0]->added_date)+22).PHP_EOL;
                    echo time().PHP_EOL;
                    if((strtotime($game_data[0]->added_date)+22)<=time())
                    {
                        $min = 1;
                        $max = 50;
                        
                        $AnderBetAmount = $this->AnderBahar_model->TotalBetAmount($game_data[0]->id,ANDER);
                        $BaharBetAmount = $this->AnderBahar_model->TotalBetAmount($game_data[0]->id,BAHAR);
                        $winning = ($AnderBetAmount>$BaharBetAmount)?BAHAR:ANDER; //0=ander,1=bahar
                        $exit = false;
                        do {
                            $number = rand($min,$max);
                            if($winning==1)
                            {
                                $exit = ($number % 2 != 0);
                            }
                            else
                            {
                                $exit = ($number % 2 == 0);
                            }
                        } while (!$exit);

                        $card_num = substr($game_data[0]->main_card, 2);
                        $middle_cards = $this->AnderBahar_model->GetCards($number,$card_num);
                        $alt_card = $this->AnderBahar_model->GetCards($limit,$game_data[0]->main_card,$card_num)[0]->cards;

                        foreach ($middle_cards as $key => $value) {
                            $this->AnderBahar_model->CreateMap($game_data[0]->id,$value->cards);
                        }
                        $this->AnderBahar_model->CreateMap($game_data[0]->id,$alt_card);

                        // Give winning Amount to user
                        $multiply = ($winning==ANDER)?1.97:1.98; //ander=1.97,bahar=1.98
                        $bets = $this->AnderBahar_model->ViewBet("",$game_data[0]->id,$winning);
                        if($bets)
                        {
                            // print_r($bets);
                            foreach ($bets as $key => $value) {
                                $this->AnderBahar_model->MakeWinner($value->user_id, $value->id, $value->amount*$multiply);
                            }
                            echo "Winning Amount Given".PHP_EOL;
                        }
                        else
                        {
                            echo "No Winning Bet Found".PHP_EOL;
                        }
                        $update_data['status'] = 1;
                        $update_data['winning'] = $winning;
                        $update_data['updated_date'] = date('Y-m-d H:i:s');
                        $update_data['end_datetime'] = date('Y-m-d H:i:s',strtotime('+ '.(count($middle_cards)+5).'seconds'));
                        $this->AnderBahar_model->Update($update_data, $game_data[0]->id);
                    }
                    else
                    {
                        echo "No Game to Start".PHP_EOL;
                    }
                }
                else
                {
                    if(strtotime($game_data[0]->end_datetime)<=time())
                    {
                        $card = $this->AnderBahar_model->GetCards($limit)[0]->cards;
                        $this->AnderBahar_model->Create($room->id,$card);

                        echo 'Ander Baher Game Created Successfully'.PHP_EOL;
                    }
                    else
                    {
                        echo "No Game to End".PHP_EOL;
                    }
                }
            }
        }
        else
        {
            echo 'No Rooms Available'.PHP_EOL;
        }
    }
}
?>