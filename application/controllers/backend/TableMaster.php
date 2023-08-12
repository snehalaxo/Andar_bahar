<?php
class TableMaster extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['TableMaster_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Table Master Management',
            'AllTableMaster' => $this->TableMaster_model->AllTableMasterList()
        ];
        $data['SideBarbutton'] = ['backend/TableMaster/add', 'Add Table Master'];
        template('table_master/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Table Master'
        ];

        template('table_master/add', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Table Master',
            'TableMaster' => $this->TableMaster_model->ViewTableMaster($id)
        ];

        template('table_master/edit', $data);
    }

    public function delete($id)
    {
        if ($this->TableMaster_model->Delete($id)) {
            $this->session->set_flashdata('msg', array('message' => 'Table Master Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/TableMaster');
    }

    public function insert()
    {
        $data = [
            'boot_value' => $this->input->post('boot_value'),
            'maximum_blind' => 4,
            'chaal_limit' => $this->input->post('chaal_limit'),
            'pot_limit' => $this->input->post('pot_limit'),
            'added_date' => date('Y-m-d H:i:s')
        ];
        $TableMaster = $this->TableMaster_model->AddTableMaster($data);
        if ($TableMaster) {
            $this->session->set_flashdata('msg', array('message' => 'Table Master Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/TableMaster');
    }

    public function update()
    {
        $data = [
            'boot_value' => $this->input->post('boot_value'),
            'maximum_blind' => 4,
            'chaal_limit' => $this->input->post('chaal_limit'),
            'pot_limit' => $this->input->post('pot_limit'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        $TableMaster = $this->TableMaster_model->UpdateTableMaster($data, $this->input->post('id'));
        if ($TableMaster) {
            $this->session->set_flashdata('msg', array('message' => 'Table Master Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/TableMaster');
    }

}