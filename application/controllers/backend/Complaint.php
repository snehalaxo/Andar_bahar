<?php
class Complaint extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Complaint_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Complaint',
            'AllComplaint' => $this->Complaint_model->AllComplaintList()
        ];
        template('complaints/index', $data);
    }
    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $Change = $this->Complaint_model->ChangeStatus($id, $status);
        if ($Change) {
            $this->session->set_flashdata('message', array('message' => 'Status Change Successfully', 'class' => 'success'));
        } else {
            $this->session->set_flashdata('message', array('message' => 'Something went to wrong', 'class' => 'success'));
        }
    }
}
?>
