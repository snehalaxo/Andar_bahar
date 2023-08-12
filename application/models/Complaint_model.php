<?php
class Complaint_model extends MY_Model
{

    public function AllComplaintList()
    {
        $this->db->select('tbl_complaints.*');
        $this->db->from('tbl_complaints');
        $this->db->where('tbl_complaints.isDeleted', false);
        $this->db->order_by('tbl_complaints.id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }
    public function ChangeStatus($id, $status)
    {
        $data = [
            'status' => $status
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_complaints', $data);

        return $this->db->affected_rows();
    }
}