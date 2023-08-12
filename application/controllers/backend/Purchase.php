<?php
class Purchase extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Purchase History Management',
            'AllPurchase' => $this->Users_model->Purchase_History()
        ];
        template('Purchase/index', $data);
    }

}
