<?php

use phpDocumentor\Reflection\Types\True_;

class Table extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model', 'Game_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Table',
            'AllTable' => $this->Game_model->getActiveTable()
        ];

        template('table/list', $data);
    }

    public function delete($id)
    {
        if ($this->Game_model->DeleteTable($id)) {
            $this->session->set_flashdata('msg', array('message' => 'Table Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/table');
    }

    public function game($table_id)
    {
        $data = [
            'title' => 'Table',
            'AllGame' => $this->Game_model->getAllGameOnTable($table_id)
        ];

        template('table/game', $data);
    }
    public function ActiveGame($table_id)
    {
        $game=$this->Game_model->getActiveGameOnTable($table_id);
        if($game)
        {
            $data = [
                'title' => 'Table',
                'table_id' => $table_id,
                'AllGame' => $this->Game_model->GameAllUser($game->id)
            ];
        }
        else
        {
            $data = [
                'title' => 'Table',
                'table_id' => $table_id,
                'AllGame' => array()
            ];
        }

        template('table/view_active_game', $data);
    }
    public function view_game($game_id, $table_id)
    {
        $data = [
            'title' => 'Table',
            'table_id' => $table_id,
            'AllGame' => $this->Game_model->GameAllUser($game_id)
        ];

        template('table/view_game', $data);
    }

    public function insert()
    {
        $data = [
            'name' => $this->input->post('name'),
            'wallet' => $this->input->post('wallet'),
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
        $data = [
            'wallet' => $this->input->post('wallet'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        $user = $this->Users_model->UpdateUserWallet($data, $this->input->post('user_id'));
        if ($user) {
            $this->session->set_flashdata('msg', array('message' => 'User Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/user');
    }

    public function ChangeCard()
    {
        $game_id = $this->input->post('Game_id');
        $User_id = $this->input->post('User_id');
        $Position = $this->input->post('Position');
        $Card = $this->input->post('name');
        $ChangeCard = $this->Game_model->ChangeCard($game_id, $User_id, $Position, $Card);
        if ($ChangeCard) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function VacantCards()
    {
        $game_id = $this->input->post('Game_id');
        $User_id = $this->input->post('User_id');
        $Position = $this->input->post('Position');
        $AllCards = $this->Game_model->AllCards();
        $GameCards = $this->Game_model->GameCard($game_id);
        $DD = [];
        foreach ($GameCards as $key => $Card) {
            array_push($DD, $Card->card1, $Card->card2, $Card->card3);
        }
        $C = 0;
        $VCARDS = [];
        foreach ($AllCards as $key => $Card) {
            $VCARDS[$C] = $Card->cards;
            $C++;
        }
        $VacantCards = array_diff($VCARDS, $DD);
        echo json_encode($VacantCards);
        // print_r($VacantCards);exit;
    }
}
