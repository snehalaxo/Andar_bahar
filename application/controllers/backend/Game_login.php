<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Game_login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array('Auth_model'));
    }

    public function login() {
        $data['title'] = 'Sign In';
        $this->load->view('Game_login', $data);
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('web/web');
        }
        // <editor-fold defaultstate="collapsed" desc="login ">
        $data['title'] = 'Sign In';
        if ($this->form_validation->run('login') === FALSE) {
            $this->load->view('Game_login', $data);
        } else {
            // Get email
            $username = $this->input->post('email');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));
            // Login user

            $data = $this->Auth_model->login($username, $password);
         // var_dump($data->role);die();
            if ($data) {
                
                    // Create session
                    $user_data = array(
                        'admin_id' => $data->id,
                        'email' => $data->email_id,
                        'name' => $data->first_name,                    
                        'logged_in' => true,
                        'role' => $data->role
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('msg', array('message' => 'You are now logged in', 'class' => 'success', 'position' => 'top-right'));
                    redirect('web/web');
                
            } else {
                $this->session->set_flashdata('msg', array('message' => 'Invalid credentials', 'class' => 'error', 'position' => 'top-right'));
                redirect('backend/Game_login/login');
            }
        }
        // </editor-fold>
    }

    // Log user out
    public function logout() {
        // <editor-fold defaultstate="collapsed" desc="Logout">

        $user_data = array(
            'admin_id' => '',
            'email' => '',
            'name' => '',
            'image' => '',
            'logged_in' => '',
            'role' => '',
        );
        $this->session->unset_userdata($user_data);
        $this->session->sess_destroy();
        redirect('backend/Game_login');
 
    }

    

}
