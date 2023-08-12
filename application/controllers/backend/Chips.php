<?php
class Chips extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Chips_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Chips Management',
            'AllChips' => $this->Chips_model->AllChipsList()
        ];
        $data['SideBarbutton'] = ['backend/Chips/add', 'Add Chips'];
        template('chips/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Chips'
        ];

        template('chips/add', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Chips',
            'Chips' => $this->Chips_model->ViewChips($id)
        ];

        template('chips/edit', $data);
    }

    public function delete($id)
    {
        if ($this->Chips_model->Delete($id)) {
            $this->session->set_flashdata('msg', array('message' => 'Chips Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Chips');
    }

    public function insert()
    {
        $data = [
            'coin' => $this->input->post('coin'),
            'price' => $this->input->post('price'),
            'added_date' => date('Y-m-d H:i:s')
        ];
        $Chips = $this->Chips_model->AddChips($data);
        if ($Chips) {
            $this->session->set_flashdata('msg', array('message' => 'Chips Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Chips');
    }

    public function update()
    {
        $data = [
            'coin' => $this->input->post('coin'),
            'price' => $this->input->post('price'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        $Chips = $this->Chips_model->UpdateChips($data, $this->input->post('id'));
        if ($Chips) {
            $this->session->set_flashdata('msg', array('message' => 'Chips Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Chips');
    }

}
