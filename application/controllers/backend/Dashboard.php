<?php
class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Setting_model', 'Users_model', 'Coin_plan_model','Retailer_model']);
    }

    public function index()
    {
        redirect('backend/dashboard/admin');
    }

    public function admin()
    {
        $data = [
            'title' => 'Dashboard',
            'AdminCoins' => $this->Setting_model->Setting()->admin_coin,
            'ActiveUser' => $this->Users_model->ActiveUser(),
            'AllUserList' => $this->Users_model->AllUserList(),
             'ActiveRetailer' => $this->Users_model->ActiveRetailer(),
            'AllRetailerList' => $this->Users_model->AllRetailerList(),
            'TotalCoins' => $this->Coin_plan_model->GetTotalPurchase(),
              'RetailerCoin' => $this->Retailer_model->RetailerCoin(),
        ];
        // $data['ActiveUser'];
        // exit;
        template('dashboard/manufacturer', $data);
    }
}
