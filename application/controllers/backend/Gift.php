<?php
class Gift extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Gift_model', 'Setting_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Gift',
            'AllGift' => $this->Gift_model->List()
        ];
        $data['SideBarbutton'] = ['backend/Gift/add', 'Add Gift'];
        template('gift/list', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Gift'
        ];

        template('gift/add', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Gift',
            'Gift' => $this->Gift_model->View_Gift($id)
        ];

        template('gift/edit', $data);
    }

    public function delete($id)
    {
        $data = [
            'isDeleted' => TRUE,
            'updated_date' => date('Y-m-d H:i:s')
        ];
        if ($this->Gift_model->UpdateGift($data, $id)) {
            $this->session->set_flashdata('msg', array('message' => 'Gift Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/gift');
    }

    public function insert()
    {
        $image = '';
        if (!empty($_FILES["image"]['name'])) {
            $config['upload_path'] = './data/post/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG';
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('msg', array('message' => $error['error'], 'class' => 'error', 'position' => 'top-right'));
                redirect('backend/gift');
            } else {

                $file = $this->upload->data();
                $image = $file['file_name'];
            }
        }

        $Gift = $this->Gift_model->AddGift($image);
        if ($Gift) {
            $this->session->set_flashdata('msg', array('message' => 'Gift Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Gift');
    }

    public function update()
    {
        $image = '';
        if (!empty($_FILES["image"]['name'])) {
            $config['upload_path'] = './data/post/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG';
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('msg', array('message' => $error['error'], 'class' => 'error', 'position' => 'top-right'));
                redirect('backend/gift');
            } else {

                $file = $this->upload->data();
                $image = $file['file_name'];
            }
        }
        $data = [
            'name' => $this->input->post('name'),
            'coin' => $this->input->post('coin'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        if ($image) {
            $data['image'] = $image;
        }
        $Gift = $this->Gift_model->UpdateGift($data, $this->input->post('id'));
        if ($Gift) {
            $this->session->set_flashdata('msg', array('message' => 'Gift Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Gift');
    }
}
